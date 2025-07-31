<?php

namespace App\Livewire\Public\OurDoctors;

use App\Models\Department;
use App\Models\Doctor;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;

#[Title('Our Doctors')]
class OurDoctors extends Component
{
    public $departments;
    public $doctors;

    #[Url(as: 'department_id')]
    public $department_id = null;

    #[Url(as: 'search')]
    public $searchQuery = '';

    #[Url(as: 'sort')]
    public $sortBy = 'name'; // Default sort by name

    public function mount()
    {
        $this->departments = Department::all();
        $this->loadDoctors();
    }

    public function updated($property)
    {
        if (in_array($property, ['department_id', 'searchQuery', 'sortBy'])) {
            $this->loadDoctors();
        }
    }

    public function loadDoctors()
    {
        $query = Doctor::query()
            ->join('users', 'doctors.user_id', '=', 'users.id')
            ->with(['user', 'department', 'reviews' => function($query) {
                $query->where('approved', true);
            }])
            ->select('doctors.*', 'users.email', 'users.name')
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
                  ->orWhereJsonContains('doctors.qualification', $this->searchQuery);
            });
        }

        switch ($this->sortBy) {
            case 'rating':
                $query->orderBy('reviews_avg_rating', 'desc');
                break;
            case 'availability':
                $query->orderBy('doctors.available_days', 'asc');
                break;
            default:
                $query->orderBy('users.name', 'asc');
                break;
        }

        $this->doctors = $query->get();
    }

    #[Layout('layouts.public')]
    public function render()
    {
        return view('livewire.public.our-doctors.our-doctors');
    }
}