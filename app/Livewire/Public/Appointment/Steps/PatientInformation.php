<?php

namespace App\Livewire\Public\Appointment\Steps;

use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Doctor;

class PatientInformation extends Component
{
    public $appointmentData = [];
    public $patient = [
        'name' => '',
        'email' => '',
        'phone' => '',
        'age' => '',
        'gender' => '',
        'pincode' => '',
        'address' => '',
        'district' => '',
        'state' => '',
    ];
    public $notes = '';
    public $isProcessing = false;
    
    protected $listeners = ['validateAndProceed'];
    
    protected $rules = [
        'patient.name' => 'required|string|min:3|max:255',
        'patient.email' => 'nullable|email|max:255',
        'patient.phone' => 'required|string|digits:10|regex:/^[6-9]\d{9}$/',
        'patient.age' => 'required|integer|min:1|max:120',
        'patient.gender' => 'required|string|in:male,female,other',
        'patient.pincode' => 'required|digits:6',
        'patient.address' => 'required|string|min:10|max:500',
        'patient.district' => 'required|string|max:100',
        'patient.state' => 'required|string|max:100',
        'notes' => 'nullable|string|max:1000',
    ];

    protected $messages = [
        'patient.name.required' => 'Patient name is required.',
        'patient.name.min' => 'Name must be at least 3 characters.',
        'patient.phone.required' => 'Phone number is required.',
        'patient.phone.digits' => 'Phone number must be exactly 10 digits.',
        'patient.phone.regex' => 'Phone number must start with 6, 7, 8 or 9.',
        'patient.age.required' => 'Age is required.',
        'patient.age.min' => 'Age must be at least 1 year.',
        'patient.age.max' => 'Age must be less than 120 years.',
        'patient.gender.required' => 'Gender is required.',
        'patient.pincode.required' => 'Pincode is required.',
        'patient.pincode.digits' => 'Pincode must be 6 digits.',
        'patient.address.required' => 'Address is required.',
        'patient.address.min' => 'Address must be at least 10 characters.',
        'patient.district.required' => 'District is required.',
        'patient.state.required' => 'State is required.',
    ];
    
    public function mount($appointmentData = [])
    {
        $this->appointmentData = $appointmentData;
        
        // If user is logged in, pre-fill the form with their information
        if (Auth::check() && Auth::user()->role === 'patient') {
            $existingPatient = Patient::where('user_id', Auth::id())->first();
            
            if ($existingPatient) {
                $this->patient = [
                    'name' => $existingPatient->name,
                    'email' => $existingPatient->email ?? Auth::user()->email,
                    'phone' => $existingPatient->phone ?? Auth::user()->phone,
                    'age' => $existingPatient->age,
                    'gender' => $existingPatient->gender ?? Auth::user()->gender,
                    'pincode' => $existingPatient->pincode,
                    'address' => $existingPatient->address,
                    'district' => $existingPatient->district,
                    'state' => $existingPatient->state,
                ];
            } else {
                $this->patient['name'] = Auth::user()->name;
                $this->patient['email'] = Auth::user()->email;
                $this->patient['phone'] = Auth::user()->phone;
                $this->patient['gender'] = Auth::user()->gender;
            }
        }
        
        // Pre-fill from appointmentData if available (e.g., from a previous step)
        if (isset($appointmentData['patient'])) {
            $this->patient = array_merge($this->patient, $appointmentData['patient']);
        }
        
        if (isset($appointmentData['notes'])) {
            $this->notes = $appointmentData['notes'];
        }

        // Ensure selected_doctor is a Doctor model instance
        if (isset($appointmentData['selected_doctor']) && !$appointmentData['selected_doctor'] instanceof Doctor) {
            $this->appointmentData['selected_doctor'] = Doctor::find($appointmentData['selected_doctor']['id']);
        }
    }
    
    public function updated($propertyName)
    {
        if (strpos($propertyName, 'patient.pincode') === 0 && strlen($this->patient['pincode']) === 6) {
            $this->validatePincode();
        } else {
            $this->validateOnly($propertyName);
        }
    }
    
    public function validatePincode()
    {
        $this->validateOnly('patient.pincode');
        
        if (empty($this->patient['pincode']) || strlen($this->patient['pincode']) !== 6) {
            return;
        }
        
        $this->isProcessing = true;
        
        try {
            $url = "https://api.postalpincode.in/pincode/{$this->patient['pincode']}";
            $context = stream_context_create([
                'http' => [
                    'timeout' => 5,
                ]
            ]);
            $response = file_get_contents($url, false, $context);

            if ($response === false) {
                $this->addError('patient.pincode', 'Failed to connect to the API');
                $this->isProcessing = false;
                return;
            }

            $data = json_decode($response, true);
            if (isset($data[0]['Status']) && $data[0]['Status'] === 'Success' && !empty($data[0]['PostOffice'])) {
                $postOffice = $data[0]['PostOffice'][0];
                $this->patient['district'] = $postOffice['District'] ?? '';
                $this->patient['state'] = $postOffice['State'] ?? '';
                $this->resetErrorBag('patient.pincode');
            } else {
                $this->addError('patient.pincode', 'Invalid PIN code or no data found');
            }
        } catch (\Exception $e) {
            $this->addError('patient.pincode', 'Unable to verify PIN code: ' . $e->getMessage());
        }

        $this->isProcessing = false;
    }
    
    public function validateAndProceed()
    {
        $this->validate();
        
        $this->dispatch('step-validated', [
            'patient' => $this->patient,
            'notes' => $this->notes,
        ]);
    }

    public function render()
    {
        return view('livewire.public.appointment.steps.patient-information');
    }
}
