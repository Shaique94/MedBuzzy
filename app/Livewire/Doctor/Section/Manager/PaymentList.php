<?php

namespace App\Livewire\Doctor\Section\Manager;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Payment;
use Carbon\Carbon;
 use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.doctor')]
#[Title('Payment Management')]
class PaymentList extends Component
{
   use WithPagination;

    // Search and Filters
    public $search = '';
    public $dateFrom = '';
    public $dateTo = '';
    public $status = '';
    public $method = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    protected $queryString = [
        'search' => ['except' => ''],
        'dateFrom' => ['except' => ''],
        'dateTo' => ['except' => ''],
        'status' => ['except' => ''],
        'method' => ['except' => ''],
        'sortField' => ['except' => 'created_at'],
        'sortDirection' => ['except' => 'desc'],
    ];

    public function updated($property)
    {
        // Reset pagination when any filter changes
        if (in_array($property, ['search', 'dateFrom', 'dateTo', 'status', 'method'])) {
            $this->resetPage();
        }
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }

    public function resetFilters()
    {
        $this->reset([
            'search',
            'dateFrom',
            'dateTo',
            'status',
            'method',
            'sortField',
            'sortDirection'
        ]);
        $this->resetPage();
    }


  public function render()
    {
        $payments = Payment::query()
            ->with(['patient', 'appointment'])
            ->whereHas('appointment', function($query) {
                $query->where('doctor_id', auth()->user()->doctor->id);
            })
            ->when($this->search, function ($query) {
                $searchTerm = '%' . $this->search . '%';
                $query->where(function ($q) use ($searchTerm) {
                    $q->whereHas('patient', function($q) use ($searchTerm) {
                        $q->where('name', 'like', $searchTerm)
                          ->orWhere('phone', 'like', $searchTerm)
                          ->orWhere('email', 'like', $searchTerm);
                    })
                    ->orWhere('transaction_id', 'like', $searchTerm)
                    ->orWhere('amount', 'like', $searchTerm)
                    ->orWhere('method', 'like', $searchTerm)
                    ->orWhere('status', 'like', $searchTerm);
                });
            })
            ->when($this->dateFrom, function ($query) {
                $query->whereDate('created_at', '>=', Carbon::parse($this->dateFrom));
            })
            ->when($this->dateTo, function ($query) {
                $query->whereDate('created_at', '<=', Carbon::parse($this->dateTo));
            })
            ->when($this->status, function ($query) {
                $query->where('status', $this->status);
            })
            ->when($this->method, function ($query) {
                $query->where('method', $this->method);
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        $stats = [
            'total' => Payment::whereHas('appointment', fn($q) => $q->where('doctor_id', auth()->user()->doctor->id))->count(),
            'paid' => Payment::whereHas('appointment', fn($q) => $q->where('doctor_id', auth()->user()->doctor->id))
                ->where('status', 'paid')->count(),
            'pending' => Payment::whereHas('appointment', fn($q) => $q->where('doctor_id', auth()->user()->doctor->id))
                ->where('status', 'pending')->count(),
            'amount' => Payment::whereHas('appointment', fn($q) => $q->where('doctor_id', auth()->user()->doctor->id))
                ->where('status', 'paid')->sum('amount'),
        ];

        return view('livewire.doctor.section.manager.payment-list', [
            'payments' => $payments,
            'stats' => $stats,
            'statuses' => ['pending', 'paid', 'failed'],
            'methods' => ['cash', 'card', 'upi'],
            'hasFilters' => $this->hasFilters()
        ]);
    }

    public function hasFilters()
    {
        return $this->search || $this->dateFrom || $this->dateTo || $this->status || $this->method;
    }
}