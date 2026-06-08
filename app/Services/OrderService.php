<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Commission;

class OrderService
{
    public function completeOrder(Order $order)
    {
        if ($order->status === 'delivered') {
            return;
        }

        $order->update([
            'status' => 'delivered',
            'delivered_at' => now(),
            'payment_status' => 'completed',
        ]);

        $this->calculateCommission($order);
    }

    protected function calculateCommission(Order $order)
    {
        $merchant = $order->merchant;
        $commissionRate = $merchant->commission_rate; // e.g. 15.00
        
        $adminCommission = ($order->subtotal * $commissionRate) / 100;
        $merchantPayable = $order->subtotal - $adminCommission;
        $riderFee = 40; // Flat rider fee for demo

        Commission::create([
            'order_id' => $order->id,
            'merchant_id' => $order->merchant_id,
            'order_total' => $order->total_amount,
            'admin_commission' => $adminCommission,
            'merchant_payable' => $merchantPayable,
            'rider_fee' => $riderFee,
            'status' => 'pending',
        ]);
    }
}