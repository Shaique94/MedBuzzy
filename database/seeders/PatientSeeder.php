<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run(): void
    {
        Patient::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '9876543210',
            'age' => 35,
            'gender' => 'male',
            'pincode' => '110001',
            'address' => '123 Main Street',
            'city' => 'New Delhi',
            'state' => 'Delhi',
            'country' => 'India',
        ]);

        Patient::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'phone' => '9123456789',
            'age' => 28,
            'gender' => 'female',
            'pincode' => '560001',
            'address' => '456 MG Road',
            'city' => 'Bengaluru',
            'state' => 'Karnataka',
            'country' => 'India',
        ]);

        Patient::create([
            'name' => 'Amit Kumar',
            'email' => 'amit@example.com',
            'phone' => '9988776655',
            'age' => 42,
            'gender' => 'male',
            'pincode' => '400001',
            'address' => '789 Marine Drive',
            'city' => 'Mumbai',
            'state' => 'Maharashtra',
            'country' => 'India',
        ]);

        // Add more dummy patients as needed!
    }
}
