<?php

namespace App\Traits;

use App\Services\PincodeService;
use Illuminate\Support\Facades\Log;

trait DoctorFormTrait
{
    /**
     * Fetch city and state details from pincode
     */
    public function fetchPincodeDetails($pincode)
    {
        Log::info('Fetching pincode details', [
            'pincode' => $pincode,
            'component' => class_basename($this)
        ]);

        // Set processing state if the property exists
        if (property_exists($this, 'isProcessing')) {
            $this->isProcessing = true;
        }

        $result = PincodeService::getLocationByPincode($pincode);

        Log::info('PincodeService result', [
            'result' => $result,
            'component' => class_basename($this)
        ]);

        if ($result['success']) {
            $this->city = $result['data']['city'];
            $this->state = $result['data']['state'];
            $this->resetErrorBag('pincode');
            
            Log::info('Successfully updated location', [
                'city' => $this->city,
                'state' => $this->state,
                'component' => class_basename($this)
            ]);
        } else {
            Log::error('Failed to fetch pincode details', [
                'pincode' => $pincode,
                'error' => $result['error'],
                'component' => class_basename($this)
            ]);
            
            $this->addError('pincode', $result['error']);
            $this->city = '';
            $this->state = '';
        }

        // Reset processing state if the property exists
        if (property_exists($this, 'isProcessing')) {
            $this->isProcessing = false;
        }
    }

    /**
     * Process comma-separated string fields into arrays
     */
    protected function processArrayFields()
    {
        return [
            'qualifications' => $this->qualification ? 
                array_filter(array_map('trim', explode(',', $this->qualification))) : 
                null,
            'languages' => $this->languages_spoken ? 
                array_filter(array_map('trim', explode(',', $this->languages_spoken))) : 
                null,
            'achievements' => $this->achievements_awards ? 
                array_filter(array_map('trim', explode(',', $this->achievements_awards))) : 
                null,
        ];
    }

    /**
     * Process social media links
     */
    protected function processSocialMedia()
    {
        if (!$this->social_media_links) {
            return null;
        }

        $socialMedia = [];
        foreach ($this->social_media_links as $link) {
            if (!empty($link['platform']) && !empty($link['url'])) {
                $socialMedia[$link['platform']] = $link['url'];
            }
        }

        return empty($socialMedia) ? null : $socialMedia;
    }

    /**
     * Add a new social media link
     */
    public function addSocialMediaLink()
    {
        $this->social_media_links[] = ['platform' => '', 'url' => ''];
    }

    /**
     * Remove a social media link by index
     */
    public function removeSocialMediaLink($index)
    {
        unset($this->social_media_links[$index]);
        $this->social_media_links = array_values($this->social_media_links);
    }

    /**
     * Update handlers for pincode, city, and state
     */
    public function updatedPincode($value)
    {
        if (strlen($value) === 6 && is_numeric($value)) {
            $this->fetchPincodeDetails($value);
        } else {
            if (strlen($value) < 6) {
                $this->resetErrorBag('pincode');
                $this->city = '';
                $this->state = '';
            }
        }
    }

    public function updatedCity($value)
    {
        $this->resetErrorBag('pincode');
    }

    public function updatedState($value)
    {
        $this->resetErrorBag('pincode');
    }

    /**
     * Get common validation rules
     */
    protected function getCommonValidationRules()
    {
        return [
            'name' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
            'available_days' => 'required|array|min:1',
            'available_days.*' => 'in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'status' => 'required|in:0,1,2',
            'phone' => 'required|string|digits:10|regex:/^[6-9]\d{9}$/',
            'fee' => 'required|numeric|min:0',
            'qualification' => 'nullable|string|max:255',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'slot_duration_minutes' => 'required|integer|min:5|max:120',
            'patients_per_slot' => 'required|integer|min:1|max:10',
            'max_booking_days' => 'required|integer|min:1|max:30',
            'pincode' => 'required|digits:6',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'gender' => 'required|in:male,female,other',
            'experience' => 'required|integer|min:0|max:50',
            'languages_spoken' => 'nullable|string|max:255',
            'clinic_hospital_name' => 'nullable|string|max:100',
            'professional_bio' => 'nullable|string|max:65535',
            'achievements_awards' => 'nullable|string|max:255',
            'social_media_links.*.platform' => 'nullable|in:twitter,facebook,instagram',
            'social_media_links.*.url' => 'nullable|url|max:255',
        ];
    }
}
