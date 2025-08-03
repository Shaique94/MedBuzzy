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
        $Names = [
            'Rahul Sharma',
            'Anita Verma',
            'Vikram Singh',
            'Priya Mehta',
            'Arjun Patel',
            'Neha Gupta',
        ];

        // Create users with Indian names
        $users = [];
        foreach ($Names as $name) {
            $user = User::create([
                'name' => $name,
                'email' => strtolower(str_replace(' ', '.', $name)) . '@example.com',
                'password' => bcrypt('password'),
                "gender" => 'male',
                "role" => 'doctor', // Assuming role is needed
            ]);
            $users[] = $user->id;
        }

        // Get departments
        $departments = DB::table('departments')->pluck('id', 'name');

        // Create doctors array with Indian names
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
            ],
        ];

        DB::table('doctors')->insert($doctors);
    }
}