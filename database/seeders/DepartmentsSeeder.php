<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentsSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
            'General Medicine',
            'Cardiology',
            'Dermatology',
            'Pediatrics',
            'Orthopedics',
            'Gynecology',
            'Neurology',
            'Dentistry',
            'Psychiatry',
            'ENT',
        ];

        foreach ($departments as $name) {
            DB::table('departments')->updateOrInsert(
                ['name' => $name],
                ['status' => true, 'created_at' => now(), 'updated_at' => now()]
            );
        }
    }
}
