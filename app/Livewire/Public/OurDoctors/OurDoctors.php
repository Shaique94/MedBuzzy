<?php

namespace App\Livewire\Public\OurDoctors;

use App\Models\Department;
use App\Models\Doctor;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Our Doctors')]
class OurDoctors extends Component
{
    use WithPagination;
    
    public $departments;

    #[Url(as: 'department')]
    public $department_id = null;

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

    public function mount()
    {
        $this->departments = Department::all();
        
        // Set default fee max if not provided
        if ($this->maxFee == 0) {
            $this->maxFee = 5000;
        }
    }

    public function updatedSearchQuery()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->department_id = null;
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
        return $this->department_id || 
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

        if (!empty($this->department_id)) {
            $query->where('doctors.department_id', $this->department_id);
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
        
        // Gender filter
        if (!empty($this->genderFilter) && count($this->genderFilter) < 2) {
            $query->where('doctors.gender', $this->genderFilter[0]);
        }
        
        // Experience filter
        if ($this->minExperience > 0) {
            $query->where('doctors.experience', '>=', $this->minExperience);
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