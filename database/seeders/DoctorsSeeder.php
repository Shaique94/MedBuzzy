<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DoctorsSeeder extends Seeder
{
    public function run(): void
    {
        // Example: get first user and some departments
        $user = DB::table('users')->first();
        $departments = DB::table('departments')->pluck('id', 'name');

        $doctors = [
            [
                'user_id' => $user ? $user->id : 1,
                'department_id' => $departments['General Medicine'] ?? null,
                'fee' => 500,
                'status' => 1,
                'qualification' => json_encode(['MBBS', 'MD']),
                'slug' => 'dr-john-doe',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $user ? $user->id : 1,
                'department_id' => $departments['Cardiology'] ?? null,
                'fee' => 800,
                'status' => 1,
                'qualification' => json_encode(['MBBS', 'DM Cardiology']),
                'slug' => 'dr-jane-smith',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('doctors')->insert($doctors);
    }
}
