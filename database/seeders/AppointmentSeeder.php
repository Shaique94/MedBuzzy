<?php

namespace Database\Seeders;

use App\Models\Appointment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Appointment::create([
            'patient_id'       => 1,
            'doctor_id'        => 1,
            'status'           => 'pending',
            'notes'            => 'First check-up appointment.',
            'appointment_date' => now()->addDays(2)->format('Y-m-d'),
            'appointment_time' => '10:30:00',
            'created_by'       => 1,
        ]);

        Appointment::create([
            'patient_id'       => 2,
            'doctor_id'        => 1,
            'status'           => 'scheduled',
            'notes'            => 'Follow-up for blood test results.',
            'appointment_date' => now()->addDays(4)->format('Y-m-d'),
            'appointment_time' => '14:00:00',
            'created_by'       => 1,
        ]);

        Appointment::create([
            'patient_id'       => 1,
            'doctor_id'        => 2,
            'status'           => 'completed',
            'notes'            => 'Routine consultation completed.',
            'appointment_date' => now()->subDays(1)->format('Y-m-d'),
            'appointment_time' => '09:00:00',
            'created_by'       => 2,
        ]);

        Appointment::create([
            'patient_id'       => 3,
            'doctor_id'        => 2,
            'status'           => 'cancelled',
            'notes'            => 'Cancelled due to patient illness.',
            'appointment_date' => now()->addDays(3)->format('Y-m-d'),
            'appointment_time' => '11:15:00',
            'created_by'       => 1,
        ]);

        // Add more records if needed
    }
}
