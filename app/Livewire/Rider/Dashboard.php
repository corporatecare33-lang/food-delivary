<?php

namespace App\Livewire\Rider;

use Livewire\Component;
use App\Models\Order;
use App\Models\RiderAssignment;

class Dashboard extends Component
{
    public $rider;

    public function mount()
    {
        $this->rider = auth()->user()->rider;
        if (!$this->rider) {
            return redirect()->route('home');
        }
    }

    public function updateAssignmentStatus($assignmentId, $status)
    {
        $assignment = RiderAssignment::where('rider_id', $this->rider->id)->findOrFail($assignmentId);
        $assignment->update(['status' => $status]);

        if ($status === 'accepted') {
            $assignment->update(['accepted_at' => now()]);
            $assignment->order->update(['status' => 'on_the_way']);
        } elseif ($status === 'completed') {
            $assignment->update(['completed_at' => now()]);
            $assignment->order->update(['status' => 'delivered', 'delivered_at' => now()]);
            $this->rider->update(['status' => 'idle']);
        }

        session()->flash('message', 'Status updated successfully.');
    }

    public function render()
    {
        $stats = [
            'active_delivery' => RiderAssignment::where('rider_id', $this->rider->id)->whereIn('status', ['assigned', 'accepted'])->count(),
            'total_completed' => RiderAssignment::where('rider_id', $this->rider->id)->where('status', 'completed')->count(),
            'total_earnings' => RiderAssignment::where('rider_id', $this->rider->id)->where('status', 'completed')->count() * 50, // Static delivery fee for now
        ];

        $active_orders = RiderAssignment::where('rider_id', $this->rider->id)
            ->whereIn('status', ['assigned', 'accepted'])
            ->with(['order.merchant', 'order.customer'])
            ->latest()
            ->get();

        $past_orders = RiderAssignment::where('rider_id', $this->rider->id)
            ->where('status', 'completed')
            ->with(['order.merchant'])
            ->latest()
            ->take(10)
            ->get();

        return view('livewire.rider.dashboard', [
            'stats' => $stats,
            'active_orders' => $active_orders,
            'past_orders' => $past_orders,
        ])->layout('layouts.app');
    }
}
