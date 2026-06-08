<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class OrderManager extends Component
{
    use \Livewire\WithPagination;

    public $selectedOrder = null;
    public $showDetails = false;

    public function viewDetails($orderId)
    {
        $this->selectedOrder = \App\Models\Order::with(['merchant', 'customer', 'items.menuItem', 'riderAssignment.rider.user'])->findOrFail($orderId);
        $this->showDetails = true;
    }

    public function closeDetails()
    {
        $this->showDetails = false;
        $this->selectedOrder = null;
    }

    public function updateStatus($orderId, $status)
    {
        $order = \App\Models\Order::findOrFail($orderId);
        $order->update(['status' => $status]);
        
        if ($status === 'delivered') {
            app(\App\Services\OrderService::class)->completeOrder($order);
        }

        \App\Models\ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'ORDER_STATUS_UPDATE',
            'description' => "Updated order #{$order->order_number} status to {$status}",
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        session()->flash('message', 'Order status updated to ' . $status);
    }

    public function render()
    {
        return view('livewire.admin.order-manager', [
            'orders' => \App\Models\Order::with(['merchant', 'customer', 'riderAssignment.rider.user'])->latest()->paginate(10)
        ]);
    }
}
