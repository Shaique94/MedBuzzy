<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Example user
        // User::factory()->create([
        //     'name' => ' user',
        //     'email' => 'user@example.com',
        //     'password' => bcrypt('password'), // password
        // ]);

        // Call PatientSeeder
        // $this->call(PatientSeeder::class);
        // //call appoinment
        // $this->call(AppointmentSeeder::class);

        $this->call([

            DepartmentsSeeder::class,
            AdminSeeder::class,
            
            DoctorsSeeder::class,
            
        ]);
    }
}
