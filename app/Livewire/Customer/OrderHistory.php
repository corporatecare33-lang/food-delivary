<?php

namespace App\Livewire\Customer;

use Livewire\Component;

class OrderHistory extends Component
{
    use \Livewire\WithPagination;

    public function render()
    {
        $orders = \App\Models\Order::where('user_id', auth()->id())
            ->with(['merchant', 'riderAssignment.rider.user'])
            ->latest()
            ->paginate(10);

        return view('livewire.customer.order-history', [
            'orders' => $orders,
        ])->layout('layouts.app');
    }
}
