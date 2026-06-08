<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $merchants = \App\Models\Merchant::all();
        $customerRole = \App\Models\Role::where('slug', 'customer')->first();
        $customers = \App\Models\User::factory(10)->create(['role_id' => $customerRole->id]);

        $statuses = ['pending', 'confirmed', 'preparing', 'picked_up', 'on_the_way', 'delivered', 'cancelled'];

        for ($i = 0; $i < 50; $i++) {
            $merchant = $merchants->random();
            $customer = $customers->random();
            $subtotal = rand(500, 2000);
            $delivery_fee = 50;
            $total = $subtotal + $delivery_fee;

            \App\Models\Order::create([
                'order_number' => 'ORD-' . rand(1000, 9999),
                'user_id' => $customer->id,
                'merchant_id' => $merchant->id,
                'subtotal' => $subtotal,
                'delivery_fee' => $delivery_fee,
                'total_amount' => $total,
                'status' => $statuses[array_rand($statuses)],
                'payment_method' => ['bKash', 'Nagad', 'COD', 'SSLCommerz'][rand(0, 3)],
                'payment_status' => 'completed',
                'delivery_address' => 'Sample Address, Dhaka',
                'created_at' => now()->subDays(rand(0, 7)),
            ]);
        }
    }
}
