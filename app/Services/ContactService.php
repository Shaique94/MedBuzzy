<?php

namespace App\Services;

class ContactService
{
    /**
     * Get all contact details from configuration
     */
    public static function getContactDetails(): array
    {
        return [
            'address' => config('contact.address'),
            'phone' => config('contact.phone'),
            'email' => config('contact.email'),
            'working_hours' => config('contact.working_hours'),
            'emergency_phone' => config('contact.emergency_phone'),
        ];
    }

    /**
     * Get specific contact detail
     */
    public static function getContactDetail(string $key): ?string
    {
        return config("contact.{$key}");
    }

    /**
     * Get contact address
     */
    public static function getAddress(): string
    {
        return config('contact.address');
    }

    /**
     * Get contact phone
     */
    public static function getPhone(): string
    {
        return config('contact.phone');
    }

    /**
     * Get contact email
     */
    public static function getEmail(): string
    {
        return config('contact.email');
    }

    /**
     * Get working hours
     */
    public static function getWorkingHours(): string
    {
        return config('contact.working_hours');
    }

    /**
     * Get emergency phone
     */
    public static function getEmergencyPhone(): string
    {
        return config('contact.emergency_phone');
    }
}
