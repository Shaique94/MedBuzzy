<?php

namespace App\Livewire\Doctor\Section\Manager;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Payment;
use App\Models\Doctor;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\DB;

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
        $this->reset(['search', 'dateFrom', 'dateTo', 'status', 'method', 'sortField', 'sortDirection']);
        $this->resetPage();
    }

  public function render()
{
    $doctorId = $this->getDoctorId();
    
    if (!$doctorId) {
        return view('livewire.doctor.section.manager.payment-list', [
            'payments' => collect([]),
            'stats' => $this->getEmptyStats(),
            'statuses' => ['pending', 'paid', 'failed'],
            'methods' => ['cash', 'card', 'upi'],
            'hasFilters' => false
        ]);
    }
    
    $stats = $this->getPaymentStats($doctorId);
    $payments = $this->getFilteredPayments($doctorId);

    return view('livewire.doctor.section.manager.payment-list', [
        'payments' => $payments,
        'stats' => $stats,
        'statuses' => ['pending', 'paid', 'failed'],
        'methods' => ['cash', 'card', 'upi'],
        'hasFilters' => $this->hasFilters()
    ]);
}

    protected function getEmptyStats()
    {
        return ['total' => 0, 'paid' => 0, 'pending' => 0, 'amount' => 0];
    }

    protected function getDoctorId()
    {
        $user = auth()->user();
        return $user && $user->doctor ? $user->doctor->id : null;
    }

    protected function getPaymentStats($doctorId)
    {
        $stats = DB::table('payments')
            ->selectRaw('
                COUNT(*) as total,
                SUM(CASE WHEN status = "paid" THEN 1 ELSE 0 END) as paid,
                SUM(CASE WHEN status = "pending" THEN 1 ELSE 0 END) as pending,
                SUM(CASE WHEN status = "paid" THEN amount ELSE 0 END) as amount
            ')
            ->whereExists(function ($query) use ($doctorId) {
                $query->select(DB::raw(1))
                      ->from('appointments')
                      ->whereColumn('payments.appointment_id', 'appointments.id')
                      ->where('appointments.doctor_id', $doctorId)
                      ->whereNotNull('appointments.patient_id')
                      ->whereNotNull('appointments.doctor_id');
            })
            ->first();

        return [
            'total' => $stats->total ?? 0,
            'paid' => $stats->paid ?? 0,
            'pending' => $stats->pending ?? 0,
            'amount' => $stats->amount ?? 0
        ];
    }

    protected function getFilteredPayments($doctorId)
    {
        $query = Payment::with([
                'patient.user:id,name,phone,email',
                'appointment:id,appointment_date,doctor_id'
            ])
            ->whereHas('appointment', fn($q) => $q->where('doctor_id', $doctorId))
            ->when($this->search, function ($query) {
                $searchTerm = '%' . $this->search . '%';
                $query->where(function ($q) use ($searchTerm) {
                    $q->whereHas('patient.user', function($q) use ($searchTerm) {
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
            ->orderBy($this->sortField, $this->sortDirection);

        return $query->paginate(10);
    }

    public function hasFilters()
    {
        return $this->search || $this->dateFrom || $this->dateTo || $this->status || $this->method;
    }
}