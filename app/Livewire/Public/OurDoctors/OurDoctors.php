<?php

namespace App\Livewire\Public\OurDoctors;

use App\Models\Department;
use App\Models\Doctor;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Our Doctors')]
class OurDoctors extends Component
{
    use WithPagination;
    
    public $departments;
    public $selectedDepartmentSlug = '';

    #[Url(as: 'department')]
       public $departmentSlug = null;

    #[Url(as: 'search')]
    public $searchQuery = '';

    #[Url(as: 'sort')]
    public $sortBy = 'name';
    
    #[Url(as: 'gender')]
    public $genderFilter = [];
    
    #[Url(as: 'exp')]
    public $minExperience = 0;
    
    #[Url(as: 'rating')]
    public $minRating = 0;
    
    #[Url(as: 'fee_min')]
    public $minFee = 0;
    
    #[Url(as: 'fee_max')]
    public $maxFee = 5000;

    public function mount($department = null)
    {
        $this->departments = Department::all();
        
        // Set default fee max if not provided
        if ($this->maxFee == 0) {
            $this->maxFee = 5000;
        }

        // Handle department slug from URL
    if ($department) {
        $dept = Department::where('slug', $department)->first();
        if ($dept) {
            $this->departmentSlug = $dept->slug;
        }
    }
    }

    #[On('usercreated')]
    public function handleUser(){
        $this->resetPage();
    }

    public function updatedSearchQuery()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->departmentSlug = null;
        $this->genderFilter = [];
        $this->minExperience = 0;
        $this->minRating = 0;
        $this->minFee = 0;
        $this->maxFee = 5000;
        $this->sortBy = 'name';
        $this->resetPage();
    }

    public function loadDoctors()
    {
        $this->resetPage();
    }
    
    public function getHasActiveFiltersProperty()
    {
        return $this->departmentSlug || 
               count($this->genderFilter) > 0 && count($this->genderFilter) < 2 ||
               $this->minExperience > 0 ||
               $this->minRating > 0 ||
               $this->minFee > 0 ||
               $this->maxFee < 5000;
    }

    #[Layout('layouts.public')]
    public function render()
    {
        $query = Doctor::query()
            ->join('users', 'doctors.user_id', '=', 'users.id')
            ->with(['user', 'department', 'reviews' => function($query) {
                $query->where('approved', true);
            }])
            ->select('doctors.*')
            ->withAvg(['reviews' => function($query) {
                $query->where('approved', true);
            }], 'rating')
            ->withCount(['reviews' => function($query) {
                $query->where('approved', true);
            }]);

      if (!empty($this->departmentSlug)) {
    $query->whereHas('department', function($q) {
        $q->where('slug', $this->departmentSlug);
    });
}

        if (!empty($this->searchQuery)) {
            $query->where(function ($q) {
                $q->where('users.name', 'like', '%' . $this->searchQuery . '%')
                  ->orWhere('users.email', 'like', '%' . $this->searchQuery . '%')
                  ->orWhere('doctors.slug', 'like', '%' . $this->searchQuery . '%')
                  ->orWhereJsonContains('doctors.qualification', $this->searchQuery)
                  ->orWhereHas('department', function ($subq) {
                      $subq->where('name', 'like', '%' . $this->searchQuery . '%');
                  });
            });
        }
        
        // Gender filter - UPDATED to use users table
        if (!empty($this->genderFilter) && count($this->genderFilter) < 2) {
            $query->where('users.gender', $this->genderFilter[0]);
        }
        
        // Experience filter
        if ($this->minExperience > 0) {
            // Convert experience string to integer for proper numeric comparison
            $query->where(function($q) {
                $q->whereRaw('CAST(doctors.experience AS SIGNED) >= ?', [$this->minExperience])
                  ->orWhere(function($q2) {
                      // Handle experience values with '+' suffix like "5+"
                      $q2->where('doctors.experience', 'LIKE', '%+%')
                         ->whereRaw('CAST(REPLACE(doctors.experience, "+", "") AS SIGNED) >= ?', [$this->minExperience]);
                  });
            });
        }
        
        // Rating filter
        if ($this->minRating > 0) {
            $query->having('reviews_avg_rating', '>=', $this->minRating);
        }
        
        // Fee range filter
        if ($this->minFee > 0) {
            $query->where('doctors.fee', '>=', $this->minFee);
        }
        
        if ($this->maxFee < 5000) {
            $query->where('doctors.fee', '<=', $this->maxFee);
        }
        
        // Sorting
        switch ($this->sortBy) {
            case 'rating':
                $query->orderByDesc('reviews_avg_rating');
                break;
            case 'experience':
                $query->orderByDesc('doctors.experience');
                break;
            case 'fee_low':
                $query->orderBy('doctors.fee', 'asc');
                break;
            case 'fee_high':
                $query->orderBy('doctors.fee', 'desc');
                break;
            default:
                $query->orderBy('users.name', 'asc');
                break;
        }

        $doctors = $query->paginate(10);

        return view('livewire.public.our-doctors.our-doctors', [
            'doctors' => $doctors,
            'hasActiveFilters' => $this->hasActiveFilters
        ]);
    }
}