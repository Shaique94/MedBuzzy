<?php
namespace App\Livewire\Admin\Payment;

use App\Models\Payment;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class ManagePayment extends Component
{
    use WithPagination;

    public $totalRevenue;
    public $failedPayment;
    public $successRate;
    public $successfulTransactions;
    
    // Counts for each tab
    public $totalPaymentsCount;
    public $successfulPaymentsCount;
    public $failedPaymentsCount;
    public $pendingPaymentsCount;
    public $refundedPaymentsCount;
    
    // Filters
    public $search = '';
    public $activeTab = 'all';
    public $methodFilter = '';
    public $dateRange = '';

    #[Title('Payment Management')]
    public function mount()
    {
        $this->loadPaymentStats();
    }

    public function loadPaymentStats()
    {
        // Calculate total paid and failed amounts
        $this->totalRevenue = Payment::where('status', 'paid')->sum('amount');
        $this->failedPayment = Payment::where('status', 'failed')->sum('amount');
        
        // Calculate counts for each tab
        $this->totalPaymentsCount = Payment::count();
        $this->successfulPaymentsCount = Payment::where('status', 'paid')->count();
        $this->failedPaymentsCount = Payment::where('status', 'failed')->count();
        $this->pendingPaymentsCount = Payment::where('status', 'pending')->count();
        $this->refundedPaymentsCount = Payment::where('status', 'refunded')->count();
        
        // Calculate success rate
        $totalTransactions = $this->totalPaymentsCount;
        $this->successfulTransactions = $this->successfulPaymentsCount;
        $this->successRate = $totalTransactions > 0 ? round(($this->successfulTransactions / $totalTransactions) * 100, 2) : 0;
    }

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
        $this->resetPage();
    }

    public function updated()
    {
        // Reset to first page whenever any filter changes
        $this->resetPage();
    }

   public function resetFilters()
{
    $this->reset(['search', 'dateRange', 'methodFilter']);
    $this->activeTab = 'all'; // Optionally reset the active tab to 'all'
}

    #[Layout('layouts.admin')]
    public function render()
    {
        $query = Payment::with(['patient', 'appointment'])
            ->orderBy('created_at', 'desc');

        // Apply active tab filter
        if ($this->activeTab !== 'all') {
            $query->where('status', $this->activeTab);
        }

        // Apply search filter
        if ($this->search) {
            $query->where(function($q) {
                $q->where('transaction_id', 'like', '%' . $this->search . '%')
                  ->orWhereHas('patient', function($patientQuery) {
                      $patientQuery->where('name', 'like', '%' . $this->search . '%')
                                  ->orWhere('email', 'like', '%' . $this->search . '%');
                  });
            });
        }

        // Apply payment method filter
        if ($this->methodFilter) {
            $query->where('method', $this->methodFilter);
        }

        // Apply date range filter
        if ($this->dateRange) {
            $now = now();
            switch ($this->dateRange) {
                case '7days':
                    $query->where('created_at', '>=', $now->subDays(7));
                    break;
                case '30days':
                    $query->where('created_at', '>=', $now->subDays(30));
                    break;
                case '90days':
                    $query->where('created_at', '>=', $now->subDays(90));
                    break;
            }
        }

        $payments = $query->paginate(10);

        return view('livewire.admin.payment.manage-payment', [
            'payments' => $payments,
        ]);
    }
}