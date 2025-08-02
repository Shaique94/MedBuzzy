<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Doctor;
use App\Models\User;
use App\Models\Department;
use Illuminate\Support\Facades\Hash;

class DoctorLocationSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Get or create a department
        $department = Department::firstOrCreate(
            ['name' => 'General Medicine'],
            ['description' => 'General medical consultation and treatment']
        );

        // Create a test doctor user
        $user = User::firstOrCreate(
            ['email' => 'test.doctor@example.com'],
            [
                'name' => 'Dr. Test Kumar',
                'phone' => '+919876543210',
                'password' => Hash::make('password'),
                'role' => 'doctor',
            ]
        );

        // Update or create doctor with location information
        Doctor::updateOrCreate(
            ['user_id' => $user->id],
            [
                'manager_id' => 1,
                'department_id' => $department->id,
                'fee' => 500,
                'status' => 1,
                'available_days' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
                'qualification' => ['MBBS', 'MD'],
                'start_time' => '09:00:00',
                'end_time' => '17:00:00',
                'slot_duration_minutes' => 30,
                'patients_per_slot' => 1,
                'max_booking_days' => 7,
                'pincode' => '854301',
                'city' => 'Purnea',
                'state' => 'Bihar',
                'slug' => 'dr-test-kumar',
            ]
        );

        // Create another test doctor
        $user2 = User::firstOrCreate(
            ['email' => 'test.doctor2@example.com'],
            [
                'name' => 'Dr. Priya Sharma',
                'phone' => '+919876543211',
                'password' => Hash::make('password'),
                'role' => 'doctor',
            ]
        );

        Doctor::updateOrCreate(
            ['user_id' => $user2->id],
            [
                'manager_id' => 1,
                'department_id' => $department->id,
                'fee' => 600,
                'status' => 1,
                'available_days' => ['Monday', 'Wednesday', 'Friday', 'Saturday'],
                'qualification' => ['MBBS', 'MS'],
                'start_time' => '10:00:00',
                'end_time' => '18:00:00',
                'slot_duration_minutes' => 30,
                'patients_per_slot' => 2,
                'max_booking_days' => 14,
                'pincode' => '110001',
                'city' => 'New Delhi',
                'state' => 'Delhi',
                'slug' => 'dr-priya-sharma',
            ]
        );

        $this->command->info('Test doctors with location data seeded successfully!');
    }
}
