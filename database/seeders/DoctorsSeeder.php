<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class DoctorsSeeder extends Seeder
{
    public function run(): void
    {
        // Define Indian names for users and doctors
        $names = [
            'Rahul Sharma',
            'Anita Verma',
            'Vikram Singh',
            'Priya Mehta',
            'Arjun Patel',
            'Neha Gupta',
        ];

        // Create users with Indian names
        $users = [];
        foreach ($names as $index => $name) {
            $user = User::create([
                'name' => $name,
                'email' => strtolower(str_replace(' ', '.', $name)) . '@example.com',
                'password' => bcrypt('password'),
                'gender' => $index % 2 == 0 ? 'male' : 'female',
                'role' => 'doctor',
            ]);
            $users[] = $user->id;
        }

        // Get departments
        $departments = DB::table('departments')->pluck('id', 'name')->toArray();

        // Define common Indian languages
        $languages = ['English', 'Hindi', 'Tamil', 'Telugu', 'Bengali'];

        // Create doctors array with Indian names and Purnea, Bihar address
        $doctors = [
            [
                'user_id' => $users[0] ?? 1,
                'department_id' => $departments['General Medicine'] ?? null,
                'fee' => 500,
                'status' => 1,
                'qualification' => json_encode(['MBBS', 'MD']),
                'slug' => 'dr-rahul-sharma',
                'created_at' => now(),
                'updated_at' => now(),
                'experience' => '5 years',
                'available_days' => json_encode(['Monday', 'Tuesday', 'Wednesday', 'Friday']),
                'start_time' => '09:00:00',
                'end_time' => '17:00:00',
                'slot_duration_minutes' => 30,
                'patients_per_slot' => 2,
                'languages_spoken' => json_encode(['English', 'Hindi', 'Maithili']),
                'clinic_hospital_name' => 'Sharma Clinic',
                'city' => 'Purnea',
                'state' => 'Bihar',
                'pincode' => '854301',
            ],
            [
                'user_id' => $users[1] ?? 1,
                'department_id' => $departments['Cardiology'] ?? null,
                'fee' => 800,
                'status' => 1,
                'qualification' => json_encode(['MBBS', 'DM Cardiology']),
                'slug' => 'dr-anita-verma',
                'created_at' => now(),
                'updated_at' => now(),
                'experience' => '6 years',
                'available_days' => json_encode(['Monday', 'Thursday', 'Friday', 'Saturday']),
                'start_time' => '10:00:00',
                'end_time' => '18:00:00',
                'slot_duration_minutes' => 20,
                'patients_per_slot' => 1,
                'languages_spoken' => json_encode(['English', 'Hindi']),
                'clinic_hospital_name' => 'Verma Heart Care',
                'city' => 'Purnea',
                'state' => 'Bihar',
                'pincode' => '854301',
            ],
            [
                'user_id' => $users[2] ?? 1,
                'department_id' => $departments['Dermatology'] ?? null,
                'fee' => 600,
                'status' => 1,
                'qualification' => json_encode(['MBBS', 'DDVL']),
                'slug' => 'dr-vikram-singh',
                'created_at' => now(),
                'updated_at' => now(),
                'experience' => '7 years',
                'available_days' => json_encode(['Tuesday', 'Wednesday', 'Thursday', 'Saturday']),
                'start_time' => '09:30:00',
                'end_time' => '16:30:00',
                'slot_duration_minutes' => 30,
                'patients_per_slot' => 2,
                'languages_spoken' => json_encode(['English', 'Hindi', 'Maithili']),
                'clinic_hospital_name' => 'Singh Skin Clinic',
                'city' => 'Purnea',
                'state' => 'Bihar',
                'pincode' => '854301',
            ],
            [
                'user_id' => $users[3] ?? 1,
                'department_id' => $departments['Pediatrics'] ?? null,
                'fee' => 550,
                'status' => 1,
                'qualification' => json_encode(['MBBS', 'DCH']),
                'slug' => 'dr-priya-mehta',
                'created_at' => now(),
                'updated_at' => now(),
                'experience' => '8 years',
                'available_days' => json_encode(['Monday', 'Wednesday', 'Friday', 'Saturday']),
                'start_time' => '08:30:00',
                'end_time' => '16:30:00',
                'slot_duration_minutes' => 25,
                'patients_per_slot' => 2,
                'languages_spoken' => json_encode(['English', 'Hindi']),
                'clinic_hospital_name' => 'Mehta Child Care',
                'city' => 'Purnea',
                'state' => 'Bihar',
                'pincode' => '854301',
            ],
            [
                'user_id' => $users[4] ?? 1,
                'department_id' => $departments['Orthopedics'] ?? null,
                'fee' => 700,
                'status' => 1,
                'qualification' => json_encode(['MBBS', 'MS Ortho']),
                'slug' => 'dr-arjun-patel',
                'created_at' => now(),
                'updated_at' => now(),
                'experience' => '9 years',
                'available_days' => json_encode(['Tuesday', 'Thursday', 'Friday', 'Saturday']),
                'start_time' => '10:00:00',
                'end_time' => '18:00:00',
                'slot_duration_minutes' => 30,
                'patients_per_slot' => 1,
                'languages_spoken' => json_encode(['English', 'Hindi']),
                'clinic_hospital_name' => 'Patel Ortho Center',
                'city' => 'Purnea',
                'state' => 'Bihar',
                'pincode' => '854301',
            ],
            [
                'user_id' => $users[5] ?? 1,
                'department_id' => $departments['Neurology'] ?? null,
                'fee' => 900,
                'status' => 1,
                'qualification' => json_encode(['MBBS', 'DM Neurology']),
                'slug' => 'dr-neha-gupta',
                'created_at' => now(),
                'updated_at' => now(),
                'experience' => '10 years',
                'available_days' => json_encode(['Monday', 'Tuesday', 'Thursday', 'Friday']),
                'start_time' => '09:00:00',
                'end_time' => '17:00:00',
                'slot_duration_minutes' => 40,
                'patients_per_slot' => 1,
                'languages_spoken' => json_encode(['English', 'Hindi', 'Bengali']),
                'clinic_hospital_name' => 'Gupta Neuro Care',
                'city' => 'Purnea',
                'state' => 'Bihar',
                'pincode' => '854301',
            ],
        ];

        // Validate department IDs
        foreach ($doctors as $doctor) {
            if (!$doctor['department_id']) {
                \Log::warning("Department not found for doctor: {$doctor['slug']}");
                continue;
            }
            DB::table('doctors')->insert($doctor);
        }
    }
}