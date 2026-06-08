<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Rider;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RiderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get or create rider role
        $riderRole = Role::where('slug', 'rider')->first();
        
        if (!$riderRole) {
            $riderRole = Role::create([
                'name' => 'Rider',
                'slug' => 'rider'
            ]);
        }

        // Create Test Rider 1
        $rider1User = User::create([
            'name' => 'Karim Rahman',
            'email' => 'rider@foosto.com',
            'password' => Hash::make('password'),
            'role_id' => $riderRole->id,
            'mobile' => '01711111111',
            'is_active' => true,
        ]);

        Rider::create([
            'user_id' => $rider1User->id,
            'vehicle_type' => 'Motorcycle',
            'vehicle_number' => 'DHA-1234',
            'status' => 'idle',
            'application_status' => 'approved',
            'current_balance' => 500.00,
        ]);

        // Create Test Rider 2
        $rider2User = User::create([
            'name' => 'Rahim Mia',
            'email' => 'rider2@foosto.com',
            'password' => Hash::make('password'),
            'role_id' => $riderRole->id,
            'mobile' => '01722222222',
            'is_active' => true,
        ]);

        Rider::create([
            'user_id' => $rider2User->id,
            'vehicle_type' => 'Bicycle',
            'vehicle_number' => 'N/A',
            'status' => 'offline',
            'application_status' => 'approved',
            'current_balance' => 1200.00,
        ]);

        // Create Test Rider 3
        $rider3User = User::create([
            'name' => 'Sabbir Hossain',
            'email' => 'rider3@foosto.com',
            'password' => Hash::make('password'),
            'role_id' => $riderRole->id,
            'mobile' => '01733333333',
            'is_active' => true,
        ]);

        Rider::create([
            'user_id' => $rider3User->id,
            'vehicle_type' => 'Motorcycle',
            'vehicle_number' => 'DHA-5678',
            'status' => 'idle',
            'application_status' => 'approved',
            'current_balance' => 750.00,
        ]);

        $this->command->info('Created 3 test rider users with credentials:');
        $this->command->info('Email: rider@foosto.com | Password: password');
        $this->command->info('Email: rider2@foosto.com | Password: password');
        $this->command->info('Email: rider3@foosto.com | Password: password');
    }
}
