<?php

namespace App\Livewire\Admin\Sections;

use App\Models\Doctor;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Services\ImageKitService;
use Illuminate\Support\Str;

class EditDoctor extends Component
{
    use WithFileUploads;

    public $doctor;
    public $showModal = false;

    // Doctor Details
    public $name = '';
    public $phone = '';
    public $fee = 500;
    public $qualificationInput = '';
    public $qualification = [];
    public $start_time;
    public $end_time;
    public $slot_duration_minutes = 30;
    public $patients_per_slot = 1;
    public $available_days = [];
    public $max_booking_days;
    public $department_id;
    public $status = 0;
    public $slug;
    public $newImage;
    public $image;
    public $image_id;
    public $imageTimestamp;

    #[On('openModal')]
    public function editDoc($id)
    {
        $this->doctor = Doctor::with('user')->findOrFail($id);

        $this->resetFormFields();

        // Set values from the doctor model
        $this->name = $this->doctor->user->name ?? '';
        $this->phone = $this->doctor->user->phone ?? '';
        $this->fee = $this->doctor->fee ?? 500;
        $this->qualification = is_array($this->doctor->qualification) ? $this->doctor->qualification : [];
        $this->qualificationInput = implode(', ', $this->qualification);
        $this->start_time = $this->doctor->start_time
            ? \Carbon\Carbon::parse($this->doctor->start_time)->format('H:i')
            : null;
        $this->end_time = $this->doctor->end_time
            ? \Carbon\Carbon::parse($this->doctor->end_time)->format('H:i')
            : null;
        $this->slot_duration_minutes = $this->doctor->slot_duration_minutes ?? 30;
        $this->patients_per_slot = $this->doctor->patients_per_slot ?? 1;
        $this->available_days = is_array($this->doctor->available_days) ? $this->doctor->available_days : [];
        $this->max_booking_days = $this->doctor->max_booking_days ?? null;
        $this->department_id = $this->doctor->department_id ?? null;
        $this->status = $this->doctor->status ?? 0;
        $this->slug = $this->doctor->slug ?? null;
        $this->image = $this->doctor->image ?? null;
        $this->image_id = $this->doctor->image_id ?? null;
        $this->imageTimestamp = time();

        $this->showModal = true;
    }

    protected function resetFormFields()
    {
        $this->reset([
            'name',
            'phone',
            'fee',
            'qualificationInput',
            'qualification',
            'start_time',
            'end_time',
            'slot_duration_minutes',
            'patients_per_slot',
            'available_days',
            'max_booking_days',
            'department_id',
            'status',
            'slug',
            'newImage',
            'image',
            'image_id',
            'imageTimestamp',
        ]);
        $this->qualification = [];
        $this->qualificationInput = '';
        $this->available_days = [];
    }

    public function saveDoctor()
    {
        // Convert comma-separated qualification input to array
        $this->qualification = array_filter(array_map('trim', explode(',', $this->qualificationInput)));

        $this->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:15|regex:/^([0-9\s\-\+\(\)]*)$/',
            'fee' => 'required|integer|min:0',
            'qualification' => 'required|array|min:1',
            'qualification.*' => 'string|max:255',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'slot_duration_minutes' => 'required|integer|in:15,30,45,60',
            'patients_per_slot' => 'required|integer|min:1|max:10',
            'available_days' => 'required|array|min:1',
            'available_days.*' => 'in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'max_booking_days' => 'required|integer|min:1|max:30',
            'department_id' => 'nullable|exists:departments,id',
            'status' => 'required|boolean',
            'slug' => 'nullable|string|max:255|unique:doctors,slug,' . $this->doctor->id,
            'newImage' => 'nullable|image|max:10240', // 10MB to match Profile
        ]);

        try {
            \DB::transaction(function () {
                // Initialize with current image data
                $imageUrl = $this->doctor->image;
                $imageId = $this->doctor->image_id;

                // Handle image upload if new image is provided
                if ($this->newImage) {
                    $imageKit = new ImageKitService();

                    // Delete old image if exists
                    if ($imageId) {
                        try {
                            $imageKit->delete($imageId);
                        } catch (\Exception $e) {
                            \Log::error('Failed to delete old image: ' . $e->getMessage());
                        }
                    }

                    // Upload new image
                    $response = $imageKit->upload(
                        fopen($this->newImage->getRealPath(), 'r'),
                        'doctor_' . time() . '.' . $this->newImage->getClientOriginalExtension(),
                        'doctor-profile'
                    );

                    if (!isset($response->result)) {
                        throw new \Exception('Image upload failed - invalid response');
                    }

                    $imageUrl = $response->result->url;
                    $imageId = $response->result->fileId;
                }

                // Update user details
                $user = User::findOrFail($this->doctor->user_id);
                $user->update([
                    'name' => $this->name,
                    'phone' => $this->phone,
                ]);

                // Update doctor details
                $this->doctor->update([
                    'fee' => $this->fee,
                    'qualification' => $this->qualification,
                    'start_time' => $this->start_time,
                    'end_time' => $this->end_time,
                    'slot_duration_minutes' => $this->slot_duration_minutes,
                    'patients_per_slot' => $this->patients_per_slot,
                    'available_days' => $this->available_days,
                    'max_booking_days' => $this->max_booking_days,
                    'department_id' => $this->department_id,
                    'status' => $this->status,
                    'slug' => $this->slug ?? Str::slug($this->name),
                    'image' => $imageUrl,
                    'image_id' => $imageId,
                ]);
            });

            $this->dispatch('notify', [
                'type' => 'success',
                'message' => 'Doctor updated successfully!',
            ]);

            $this->closeModal();
            $this->dispatch('refreshDoctors');

        } catch (\Exception $e) {
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => 'Error updating doctor: ' . $e->getMessage(),
            ]);
        }
    }

    public function closeModal()
    {
        $this->resetFormFields();
        $this->showModal = false;
    }

    #[Layout('layouts.admin')]
    public function render()
    {
        return view('livewire.admin.sections.edit-doctor');
    }
}