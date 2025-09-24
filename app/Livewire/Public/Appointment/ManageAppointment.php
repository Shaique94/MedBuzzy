<?php

namespace App\Livewire\Public\Appointment;

use App\Jobs\SendBookingConfirmationEmail;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Book Appointment')]
class ManageAppointment extends Component
{
    public $step = 1;
    public $doctors;
    public $departments;
    public $selectedDepartment = null;
    public $doctor_id;
    public $selectedDoctor;
    public $appointment_date;
    public $appointment_time;
    public $availableSlots = [];
    public $appointmentId;
    public $newPatient = [
        'name' => '',
        'email' => '',
        'phone' => '',
        'gender' => 'male',
    ];

    // Add booking_for: 'self' | 'other'
    public $booking_for = 'self';

    public $notes;
    public $slot_enabled = true;
    public $currentMonth;
    public $activeTimeTab = 'morning'; // Track active time tab (morning/afternoon/evening)
    public $availableDates = []; // To store available dates for tabs

    protected $rules = [
        'doctor_id' => 'required|exists:doctors,id',
        'appointment_date' => 'required|date|after_or_equal:today',
        'appointment_time' => 'required_if:slot_enabled,true',
        'newPatient.name' => 'required|string|min:3|max:255',
        'newPatient.email' => 'nullable|email|max:255',
        'newPatient.phone' => 'required|string|digits:10|regex:/^[6-9]\d{9}$/',
        'newPatient.gender' => 'required|string|in:male,female,other',
        'notes' => 'nullable|string|max:500',
    ];

    protected $messages = [
        'doctor_id.required' => 'Please select a doctor.',
        'appointment_date.required' => 'Please select an appointment date.',
        'appointment_date.after_or_equal' => 'Appointment date must be today or in the future.',
        'appointment_time.required_if' => 'Please select an appointment time.',
        'newPatient.name.required' => 'Patient name is required.',
        'newPatient.name.min' => 'Name must be at least 3 characters.',
        'newPatient.phone.required' => 'Phone number is required.',
        'newPatient.phone.digits' => 'Phone number must be exactly 10 digits',
        'newPatient.phone.regex' => 'Phone number must start with 6,7,8 or 9',
        'newPatient.gender.required' => 'Gender is required.',
        'newPatient.email.email' => 'Please enter a valid email address.',
    ];

    public function mount($doctor_slug = null)
    {
        $this->currentMonth = now()->startOfMonth()->format('Y-m-d');

        if ($doctor_slug) {
            $this->selectedDoctor = Doctor::with(['user:id,name', 'department:id,name'])->where('slug', $doctor_slug)->first();
            if ($this->selectedDoctor) {
                $this->doctor_id = $this->selectedDoctor->id;
                $this->selectedDepartment = $this->selectedDoctor->department_id;
                $this->step = 2;
            }
        }
        // Handle legacy doctor_id query parameter for backward compatibility
        elseif (request()->has('doctor_id')) {
            $this->doctor_id = request()->query('doctor_id');
            $this->selectedDoctor = Doctor::with(['user:id,name', 'department:id,name'])->find($this->doctor_id);
            if ($this->selectedDoctor) {
                $this->selectedDepartment = $this->selectedDoctor->department_id;
                $this->step = 2;
            }
        }

        // When mounting with a selected doctor, prepare the available dates
        if ($this->selectedDoctor) {
            $this->prepareAvailableDates();

            // Default to today's date and a morning slot when arriving from a doctor link
            if (empty($this->appointment_date)) {
                $today = Carbon::today()->format('Y-m-d');
                $this->setAppointmentDate($today, true);
            }
        }

        // If user wants "self" and is authenticated, pre-fill
        if ($this->booking_for === 'self' && Auth::check()) {
            $this->fillPatientFromAuth();
        }
    }
   
    public function updated($propertyName)
    {
        if (in_array($propertyName, ['appointment_date'])) {
            return;
        }

        $this->validateOnly($propertyName);
    }

    // Generate the available dates for the selected doctor
    public function prepareAvailableDates()
    {
        if (!$this->selectedDoctor) {
            $this->availableDates = [];
            return;
        }

        $today = Carbon::today('Asia/Kolkata');
        $maxBookingDays = $this->selectedDoctor->max_booking_days ?? 30;
        
        $dates = [];
        for ($i = 0; $i < $maxBookingDays; $i++) {
            $date = $today->copy()->addDays($i);
            $dayName = strtolower($date->englishDayOfWeek);
            
            // Get day-specific schedule
            $daySchedule = $this->selectedDoctor->getWorkingHoursForDay($dayName);
            
            // Skip if doctor is not available on this day
            if (!$daySchedule['is_available']) {
                continue;
            }
            
            // Skip if doctor is on leave
            if ($this->selectedDoctor->isOnLeave($date)) {
                continue;
            }
            
            // Get available time slots for this date
            $timeSlots = $this->selectedDoctor->generateTimeSlots($date->format('Y-m-d'));
            
            // Only include dates that have available slots
            if (!empty($timeSlots)) {
                $availableSlots = array_filter($timeSlots, function($slot) {
                    return !$slot['disabled'];
                });
                
                if (!empty($availableSlots)) {
                    $dates[] = [
                        'date' => $date->format('Y-m-d'),
                        'isToday' => $date->isToday(),
                        'dayName' => $date->format('D'),
                        'dayNumber' => $date->format('j'),
                        'monthName' => $date->format('M'),
                        'fullDate' => $date->format('l, F j, Y'),
                        'available_slots' => count($availableSlots)
                    ];
                }
            }
        }
        
        $this->availableDates = $dates;
        
        // If no available dates found, set an empty array
        if (empty($this->availableDates)) {
            $this->availableDates = [];
        }
    }

    /**
     * Set appointment date. $forceMorning will prefer morning tab & auto-select first morning slot.
     */
    public function setAppointmentDate($date, $forceMorning = false)
    {
        $this->appointment_date = $date;
        $this->appointment_time = null;
        $this->validate(['appointment_date' => $this->rules['appointment_date']]);
        $this->generateTimeSlots();

        // If caller requested a morning default, force morning tab. Otherwise keep existing heuristic.
        if ($forceMorning) {
            $this->activeTimeTab = 'morning';
        } else {
            if ($this->appointment_date === Carbon::today()->format('Y-m-d')) {
                $now = Carbon::now('Asia/Kolkata');
                $hour = (int) $now->format('H');
                if ($hour < 12) {
                    $this->activeTimeTab = 'morning';
                } elseif ($hour < 16) {
                    $this->activeTimeTab = 'afternoon';
                } else {
                    $this->activeTimeTab = 'evening';
                }
            } else {
                $this->activeTimeTab = 'morning';
            }
        }

        // If no appointment_time selected, try to auto-select a morning slot (or first available)
        if (empty($this->appointment_time)) {
            $first = $this->pickFirstAvailableSlot($forceMorning ? 'morning' : null);
            if ($first) {
                $this->appointment_time = $first;
            }
        }
    }

    /**
     * Pick first available slot. $preferredTab: 'morning'|'afternoon'|'evening' or null.
     * Returns slot key (H:i) or null.
     */
    protected function pickFirstAvailableSlot($preferredTab = null)
    {
        if (empty($this->availableSlots)) return null;

        // Helper to determine tab for hour
        $tabForHour = fn(int $hour) => ($hour < 12) ? 'morning' : (($hour < 16) ? 'afternoon' : 'evening');

        // If preferred tab given, try to find in that tab first
        if ($preferredTab) {
            foreach ($this->availableSlots as $key => $slot) {
                // key is 'H:i'
                $hour = (int) date('H', strtotime($key));
                if ($tabForHour($hour) === $preferredTab && !$slot['disabled']) {
                    return $key;
                }
            }
        }

        // Otherwise search in order: morning, afternoon, evening
        $order = ['morning', 'afternoon', 'evening'];
        foreach ($order as $tab) {
            foreach ($this->availableSlots as $key => $slot) {
                $hour = (int) date('H', strtotime($key));
                if ($tabForHour($hour) === $tab && !$slot['disabled']) {
                    return $key;
                }
            }
        }

        return null;
    }
  

    public function setActiveTimeTab($tab)
    {
        $this->activeTimeTab = $tab;
    }

  

    public function generateTimeSlots()
    {
        if (!$this->selectedDoctor || !$this->appointment_date) {
            $this->availableSlots = [];
            return;
        }

        $appointmentDate = Carbon::parse($this->appointment_date, 'Asia/Kolkata');
        $dayOfWeek = strtolower($appointmentDate->englishDayOfWeek);
        
        // Get day-specific working hours
        $daySchedule = $this->selectedDoctor->getWorkingHoursForDay($dayOfWeek);
        
        // Check if doctor is available on this day
        if (!$daySchedule['is_available']) {
            $this->availableSlots = [];
            return;
        }

        $startTime = Carbon::parse($daySchedule['start_time']);
        $endTime = Carbon::parse($daySchedule['end_time']);
        $duration = $this->selectedDoctor->slot_duration_minutes;
        $maxPatientsPerSlot = $daySchedule['patients_per_slot'];
        $this->availableSlots = [];
        $currentSlot = $startTime->copy();

        $now = Carbon::now('Asia/Kolkata');
        $isToday = $appointmentDate->isToday();

        while ($currentSlot->lt($endTime)) {
            $slotEnd = $currentSlot->copy()->addMinutes($duration);
            if ($slotEnd->gt($endTime))
                break;

            $timeString = $currentSlot->format('H:i');
            $bookedCount = Appointment::where('doctor_id', $this->selectedDoctor->id)
                ->where('appointment_date', $this->appointment_date)
                ->where('appointment_time', $timeString)
                ->count();

            $remaining = max(0, $maxPatientsPerSlot - $bookedCount);

            $slotTime = Carbon::parse($this->appointment_date . ' ' . $timeString, 'Asia/Kolkata');
            $bufferedNow = $now->copy()->addMinutes(30);
            $disabled = $remaining <= 0 || ($isToday && $slotTime->lt($bufferedNow));

            $this->availableSlots[$timeString] = [
                'start' => $currentSlot->format('h:i A'),
                'end' => $slotEnd->format('h:i A'),
                'disabled' => $disabled,
                'remaining_capacity' => $remaining,
                'max_capacity' => $maxPatientsPerSlot,
                'tooltip' => $disabled ?
                    ($remaining <= 0 ? 'Fully booked' : 'Time slot has passed') :
                    'Available'
            ];
            $currentSlot->addMinutes($duration);
        }

        // After generating slots, check if the selected tab has any slots
        // If not, switch to a tab that does have slots
        $morningSlots = $afternoonSlots = $eveningSlots = 0;

        foreach ($this->availableSlots as $time => $slot) {
            $hour = (int) date('H', strtotime($slot['start']));

            if ($hour < 12) {
                $morningSlots++;
            } elseif ($hour < 16) {
                $afternoonSlots++;
            } else {
                $eveningSlots++;
            }
        }

        // Auto-switch to a tab with slots if current tab has none
        if ($this->activeTimeTab === 'morning' && $morningSlots === 0) {
            if ($afternoonSlots > 0) {
                $this->activeTimeTab = 'afternoon';
            } elseif ($eveningSlots > 0) {
                $this->activeTimeTab = 'evening';
            }
        } elseif ($this->activeTimeTab === 'afternoon' && $afternoonSlots === 0) {
            if ($morningSlots > 0) {
                $this->activeTimeTab = 'morning';
            } elseif ($eveningSlots > 0) {
                $this->activeTimeTab = 'evening';
            }
        } elseif ($this->activeTimeTab === 'evening' && $eveningSlots === 0) {
            if ($morningSlots > 0) {
                $this->activeTimeTab = 'morning';
            } elseif ($afternoonSlots > 0) {
                $this->activeTimeTab = 'afternoon';
            }
        }
    }

    public function selectTimeSlot($time)
    {
        if (isset($this->availableSlots[$time]) && !$this->availableSlots[$time]['disabled']) {
            $this->appointment_time = $time;
            $this->validate(['appointment_time' => $this->rules['appointment_time']]);

            // Automatically proceed to the next step after selecting a time slot
            $this->nextStep();
        }
    }

    public function nextStep()
    {
        $this->validateStep($this->step);
        // Only allow up to step 3 (Doctor -> Date/Time -> Patient+Payment)
        if ($this->step < 3) {
            $this->step++;
        }

        // When arriving to date selection (step 2) ensure date/slots are prepared
        if ($this->step === 2) {
            if (empty($this->appointment_date)) {
                $today = Carbon::today()->format('Y-m-d');
                // prefer morning when entering the date/time step
                $this->setAppointmentDate($today, true);
            } else {
                $this->generateTimeSlots();
                // if still no time selected, attempt to auto-select morning
                if (empty($this->appointment_time)) {
                    $first = $this->pickFirstAvailableSlot('morning');
                    if ($first) $this->appointment_time = $first;
                }
            }
        }
    }

    public function previousStep()
    {
        $this->step--;

        if ($this->step === 2) {
            $this->generateTimeSlots();
        }
    }

    protected function validateStep($step)
    {
        if ($step === 1) {
            $this->validate(['doctor_id' => $this->rules['doctor_id']]);
        } elseif ($step === 2) {
            $this->validate([
                'appointment_date' => $this->rules['appointment_date'],
                'appointment_time' => $this->rules['appointment_time'],
            ]);
        } elseif ($step === 3) {
            // Patient info + notes validated before payment
            $this->validate([
                'newPatient.name' => $this->rules['newPatient.name'],
                'newPatient.phone' => $this->rules['newPatient.phone'],
                'newPatient.gender' => $this->rules['newPatient.gender'],
                'newPatient.email' => $this->rules['newPatient.email'],
                'notes' => $this->rules['notes'],
            ]);
        }
    }

    

   public function createAppointment()
    {
        $this->validate();

        try {
            // Check slot availability
            $bookedCount = Appointment::where([
                'doctor_id' => $this->doctor_id,
                'appointment_date' => $this->appointment_date,
                'appointment_time' => $this->appointment_time,
            ])->count();

            $maxPatientsPerSlot = $this->selectedDoctor->patients_per_slot ?? 1;
            if ($bookedCount >= $maxPatientsPerSlot) {
                $this->addError('appointment_time', 'This time slot is fully booked. Please select another slot.');
                return;
            }

            DB::beginTransaction();

            // Ensure User exists
            $email = $this->newPatient['email'] ?? 'guest+' . ($this->newPatient['phone'] ?? time()) . '@medbuzzy.local';
            $user = User::firstOrCreate(
                ['phone' => $this->newPatient['phone']],
                [
                    'name' => $this->newPatient['name'],
                    'email' => $email,
                    'gender' => $this->newPatient['gender'],
                    'password' => Hash::make('defaultpassword'),
                    'role' => 'patient'
                ]
            );

            // Ensure Patient exists
            $patient = Patient::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'name' => $this->newPatient['name'],
                    'email' => $email,
                    'gender' => $this->newPatient['gender']
                ]
            );

            $appointment = Appointment::create([
                'patient_id' => $patient->id,
                'doctor_id' => $this->doctor_id,
                'appointment_date' => $this->appointment_date,
                'appointment_time' => $this->appointment_time,
                'status' => 'pending',
                'notes' => $this->notes,
                'created_by' => Auth::id(),
                'is_rescheduled' => false,
            ]);
                
            // Dispatch the email job
            SendBookingConfirmationEmail::dispatch($patient, $appointment);
            
            $this->appointmentId = $appointment->id;

            DB::commit();

            // Redirect to payment page directly
            return redirect()->route('appointment.payment', ['appointment' => $appointment->id]);

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Appointment creation failed: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);
            $this->addError('appointment_error', 'Failed to create appointment: ' . $e->getMessage());
        }
    }

    // Called when booking_for value changes by Livewire (naming convention)
    public function updatedBookingFor($value)
    {
        if ($value === 'self') {
            $this->fillPatientFromAuth();
        } else {
            // Clear patient form for "other" option
            $this->newPatient = [
                'name' => '',
                'email' => '',
                'phone' => '',
                'gender' => 'male',
            ];
            $this->resetErrorBag(['newPatient.*']);
        }
    }

    protected function fillPatientFromAuth()
    {
        if (!Auth::check()) {
            return;
        }

        $user = Auth::user();

        // Basic fields from user model
        $this->newPatient['name'] = $user->name ?? $this->newPatient['name'];
        $this->newPatient['email'] = $user->email ?? $this->newPatient['email'];
        $this->newPatient['phone'] = $user->phone ?? $this->newPatient['phone'];
        $this->newPatient['gender'] = $user->gender ?? $this->newPatient['gender'];

        // If you store patient records, prefer patient's stored details (non-destructive)
        $patient = Patient::where('user_id', $user->id)->first();
        if ($patient) {
            $this->newPatient['name'] = $patient->name ?? $this->newPatient['name'];
            $this->newPatient['email'] = $patient->email ?? $this->newPatient['email'];
            $this->newPatient['phone'] = $patient->user->phone ?? $this->newPatient['phone'];
            $this->newPatient['gender'] = $patient->gender ?? $this->newPatient['gender'];
        }

        // Clear validation errors for patient fields
        $this->resetErrorBag(['newPatient.*']);
    }

    #[Layout('layouts.public')]
    public function render()
    {
        // Provide formatted date/time for the view
        $formattedAppointmentDate = $this->appointment_date 
            ? Carbon::parse($this->appointment_date)->format('l, F j, Y')
            : null;
            
        $formattedAppointmentTime = $this->appointment_time 
            ? Carbon::parse($this->appointment_time)->format('g:i A')
            : null;

        return view('livewire.public.appointment.manage-appointment', [
            'doctors' => $this->doctors,
            'departments' => $this->departments,
            'formattedAppointmentDate' => $formattedAppointmentDate,
            'formattedAppointmentTime' => $formattedAppointmentTime,
            'currentMonth' => $this->currentMonth,
            'availableSlots' => $this->availableSlots,
            'availableDates' => $this->availableDates,
            'activeTimeTab' => $this->activeTimeTab,
            'slot_enabled' => $this->slot_enabled,
        ]);
    }
}