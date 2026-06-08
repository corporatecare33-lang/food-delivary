<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Roles
        $adminRole = \App\Models\Role::create(['name' => 'Admin', 'slug' => 'admin']);
        $merchantRole = \App\Models\Role::create(['name' => 'Merchant', 'slug' => 'merchant']);
        $riderRole = \App\Models\Role::create(['name' => 'Rider', 'slug' => 'rider']);
        $customerRole = \App\Models\Role::create(['name' => 'Customer', 'slug' => 'customer']);

        // Create Admin User
        User::factory()->create([
            'name' => 'Foosto Admin',
            'email' => 'admin@foosto.com',
            'password' => bcrypt('password'),
            'role_id' => $adminRole->id,
            'mobile' => '01700000000',
        ]);

        $this->call([
            MerchantSeeder::class,
            RiderSeeder::class,
            OrderSeeder::class,
        ]);
    }
}
