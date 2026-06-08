<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MerchantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $merchants = [
            ['name' => 'Dhaka Hotpot', 'slug' => 'dhaka-hotpot'],
            ['name' => 'Biriyani King', 'slug' => 'biriyani-king'],
            ['name' => 'Mama\'s Kitchen', 'slug' => 'mamas-kitchen'],
            ['name' => 'Spice Factory', 'slug' => 'spice-factory'],
            ['name' => 'Burger House', 'slug' => 'burger-house'],
        ];

        $merchantRole = \App\Models\Role::where('slug', 'merchant')->first();

        foreach ($merchants as $m) {
            $user = \App\Models\User::factory()->create([
                'name' => $m['name'] . ' Owner',
                'email' => $m['slug'] . '@example.com',
                'role_id' => $merchantRole->id,
            ]);

            $merchant = \App\Models\Merchant::create([
                'user_id' => $user->id,
                'business_name' => $m['name'],
                'slug' => $m['slug'],
                'address' => 'Dhaka, Bangladesh',
                'status' => 'approved',
                'commission_rate' => 15.00,
            ]);

            $menu = \App\Models\MerchantMenu::create([
                'merchant_id' => $merchant->id,
                'name' => 'Lunch Special',
                'slug' => $m['slug'] . '-lunch',
            ]);

            $lunchItems = [
                ['name' => 'Beef Tehari', 'price' => 250, 'image' => 'https://images.unsplash.com/photo-1589302168068-964664d93dc0?auto=format&fit=crop&q=80&w=500'],
                ['name' => 'Chicken Biriyani', 'price' => 320, 'image' => 'https://images.unsplash.com/photo-1563379091339-03b21bc4a4f8?auto=format&fit=crop&q=80&w=500'],
                ['name' => 'Mutton Kacchi', 'price' => 450, 'image' => 'https://images.unsplash.com/photo-1633945274405-b6c8069047b0?auto=format&fit=crop&q=80&w=500'],
                ['name' => 'Fish Curry with Rice', 'price' => 180, 'image' => 'https://images.unsplash.com/photo-1626074353765-517a681e40be?auto=format&fit=crop&q=80&w=500'],
            ];

            foreach ($lunchItems as $item) {
                \App\Models\MenuItem::create([
                    'merchant_menu_id' => $menu->id,
                    'name' => $item['name'],
                    'slug' => \Illuminate\Support\Str::slug($m['name'] . '-' . $item['name']),
                    'price' => $item['price'],
                    'image' => $item['image'],
                    'description' => 'Best ' . $item['name'] . ' in town.',
                    'is_available' => true,
                    'is_featured' => true,
                ]);
            }
        }
    }
}
