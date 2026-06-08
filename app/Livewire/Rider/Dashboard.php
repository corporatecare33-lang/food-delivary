<?php

namespace App\Livewire\Rider;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Order;
use App\Models\RiderAssignment;
use Carbon\Carbon;

class Dashboard extends Component
{
    public $rider;
    public $isOnline = true;
    public $currentTab = 'overview';
    public $selectedAssignment = null;

    public function mount()
    {
        $this->rider = auth()->user()->rider;
        if (!$this->rider) {
            return redirect()->route('home');
        }
        $this->isOnline = $this->rider->status !== 'offline';
    }

    public function toggleOnlineStatus()
    {
        $this->isOnline = !$this->isOnline;
        $newStatus = $this->isOnline ? 'idle' : 'offline';
        $this->rider->update(['status' => $newStatus]);
        
        $message = $this->isOnline ? 'You are now ONLINE and ready to receive orders!' : 'You are now OFFLINE';
        session()->flash('message', $message);
    }

    public function setTab($tab)
    {
        $this->currentTab = $tab;
    }

    public function acceptOrder($assignmentId)
    {
        $assignment = RiderAssignment::where('rider_id', $this->rider->id)
            ->where('id', $assignmentId)
            ->firstOrFail();
        
        $assignment->update([
            'status' => 'accepted',
            'accepted_at' => now()
        ]);
        
        $assignment->order->update(['status' => 'on_the_way']);
        $this->rider->update(['status' => 'busy']);
        
        session()->flash('message', 'Order accepted successfully!');
    }

    public function rejectOrder($assignmentId)
    {
        $assignment = RiderAssignment::where('rider_id', $this->rider->id)
            ->where('id', $assignmentId)
            ->firstOrFail();
        
        $assignment->update(['status' => 'rejected']);
        
        session()->flash('message', 'Order rejected.');
    }

    public function markPickedUp($assignmentId)
    {
        $assignment = RiderAssignment::where('rider_id', $this->rider->id)
            ->where('id', $assignmentId)
            ->firstOrFail();
        
        $assignment->update(['status' => 'picked_up']);
        $assignment->order->update(['status' => 'on_the_way']);
        
        session()->flash('message', 'Order marked as picked up!');
    }

    public function startDelivery($assignmentId)
    {
        $assignment = RiderAssignment::where('rider_id', $this->rider->id)
            ->where('id', $assignmentId)
            ->firstOrFail();
        
        $assignment->update(['status' => 'in_delivery']);
        $assignment->order->update(['status' => 'on_the_way']);
        
        session()->flash('message', 'Delivery started!');
    }

    public function completeDelivery($assignmentId)
    {
        $assignment = RiderAssignment::where('rider_id', $this->rider->id)
            ->where('id', $assignmentId)
            ->firstOrFail();
        
        $assignment->update([
            'status' => 'completed',
            'completed_at' => now()
        ]);
        
        $assignment->order->update([
            'status' => 'delivered',
            'delivered_at' => now()
        ]);
        
        $this->rider->update(['status' => 'idle']);
        
        session()->flash('message', 'Delivery completed successfully! ৳50 earned.');
    }

    #[On('echo:orders,OrderAssigned')]
    public function orderAssigned($data)
    {
        // Real-time order notification
        $this->dispatch('new-order-notification', [
            'title' => 'New Order Assigned!',
            'message' => 'Order #' . $data['order_number']
        ]);
    }

    public function render()
    {
        // Today's date range
        $today = Carbon::today();
        $weekStart = Carbon::now()->startOfWeek();
        $monthStart = Carbon::now()->startOfMonth();
        
        // Calculate earnings
        $todayEarnings = RiderAssignment::where('rider_id', $this->rider->id)
            ->where('status', 'completed')
            ->whereDate('completed_at', $today)
            ->count() * 50;
        
        $weeklyEarnings = RiderAssignment::where('rider_id', $this->rider->id)
            ->where('status', 'completed')
            ->where('completed_at', '>=', $weekStart)
            ->count() * 50;
        
        $monthlyEarnings = RiderAssignment::where('rider_id', $this->rider->id)
            ->where('status', 'completed')
            ->where('completed_at', '>=', $monthStart)
            ->count() * 50;
        
        $totalEarnings = RiderAssignment::where('rider_id', $this->rider->id)
            ->where('status', 'completed')
            ->count() * 50;

        // Deliveries count
        $todayDeliveries = RiderAssignment::where('rider_id', $this->rider->id)
            ->where('status', 'completed')
            ->whereDate('completed_at', $today)
            ->count();
        
        $totalDeliveries = RiderAssignment::where('rider_id', $this->rider->id)
            ->where('status', 'completed')
            ->count();
        
        // Active orders
        $activeOrders = RiderAssignment::where('rider_id', $this->rider->id)
            ->whereIn('status', ['assigned', 'accepted', 'picked_up', 'in_delivery'])
            ->count();
        
        // Calculate rates
        $totalAssigned = RiderAssignment::where('rider_id', $this->rider->id)->count();
        $totalAccepted = RiderAssignment::where('rider_id', $this->rider->id)
            ->whereIn('status', ['accepted', 'picked_up', 'in_delivery', 'completed'])
            ->count();
        
        $acceptanceRate = $totalAssigned > 0 ? round(($totalAccepted / $totalAssigned) * 100) : 0;
        $completionRate = $totalAccepted > 0 ? round(($totalDeliveries / $totalAccepted) * 100) : 0;

        // Get orders by status
        $assignedOrders = RiderAssignment::where('rider_id', $this->rider->id)
            ->where('status', 'assigned')
            ->with(['order.merchant', 'order.customer'])
            ->latest()
            ->get();
        
        $acceptedOrders = RiderAssignment::where('rider_id', $this->rider->id)
            ->where('status', 'accepted')
            ->with(['order.merchant', 'order.customer'])
            ->latest()
            ->get();
        
        $pickedOrders = RiderAssignment::where('rider_id', $this->rider->id)
            ->where('status', 'picked_up')
            ->with(['order.merchant', 'order.customer'])
            ->latest()
            ->get();
        
        $inDeliveryOrders = RiderAssignment::where('rider_id', $this->rider->id)
            ->where('status', 'in_delivery')
            ->with(['order.merchant', 'order.customer'])
            ->latest()
            ->get();
        
        $completedOrders = RiderAssignment::where('rider_id', $this->rider->id)
            ->where('status', 'completed')
            ->with(['order.merchant', 'order.customer'])
            ->latest()
            ->take(20)
            ->get();
        
        $cancelledOrders = RiderAssignment::where('rider_id', $this->rider->id)
            ->where('status', 'rejected')
            ->with(['order.merchant', 'order.customer'])
            ->latest()
            ->take(20)
            ->get();

        // Daily earnings for chart (last 7 days)
        $dailyEarnings = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            $earnings = RiderAssignment::where('rider_id', $this->rider->id)
                ->where('status', 'completed')
                ->whereDate('completed_at', $date)
                ->count() * 50;
            $dailyEarnings[] = [
                'date' => $date->format('M d'),
                'amount' => $earnings
            ];
        }

        return view('livewire.rider.dashboard', [
            'todayEarnings' => $todayEarnings,
            'weeklyEarnings' => $weeklyEarnings,
            'monthlyEarnings' => $monthlyEarnings,
            'totalEarnings' => $totalEarnings,
            'todayDeliveries' => $todayDeliveries,
            'totalDeliveries' => $totalDeliveries,
            'activeOrders' => $activeOrders,
            'acceptanceRate' => $acceptanceRate,
            'completionRate' => $completionRate,
            'assignedOrders' => $assignedOrders,
            'acceptedOrders' => $acceptedOrders,
            'pickedOrders' => $pickedOrders,
            'inDeliveryOrders' => $inDeliveryOrders,
            'completedOrders' => $completedOrders,
            'cancelledOrders' => $cancelledOrders,
            'dailyEarnings' => $dailyEarnings,
        ])->layout('layouts.rider');
    }
}
