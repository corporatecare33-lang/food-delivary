<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class AssignRider extends Component
{
    public $orderId;
    public $selectedRider = '';

    public function mount($orderId)
    {
        $this->orderId = $orderId;
        $order = \App\Models\Order::find($orderId);
        if ($order && $order->riderAssignment) {
            $this->selectedRider = $order->riderAssignment->rider_id;
        }
    }

    public function assign()
    {
        if (!$this->selectedRider) return;

        \App\Models\RiderAssignment::updateOrCreate(
            ['order_id' => $this->orderId],
            [
                'rider_id' => $this->selectedRider,
                'status' => 'assigned',
                'assigned_at' => now()
            ]
        );

        $this->dispatch('rider-assigned');
    }

    public function render()
    {
        $riders = \App\Models\Rider::where('application_status', 'approved')
            ->with('user')
            ->get();

        return view('livewire.admin.assign-rider', [
            'riders' => $riders
        ]);
    }
}
