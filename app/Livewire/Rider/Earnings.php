<?php

namespace App\Livewire\Rider;

use Livewire\Component;
use App\Models\RiderAssignment;
use Carbon\Carbon;

class Earnings extends Component
{
    public $rider;
    public $selectedPeriod = 'week';
    public $startDate;
    public $endDate;

    public function mount()
    {
        $this->rider = auth()->user()->rider;
        
        if (!$this->rider) {
            session()->flash('error', 'Rider profile not found. Please contact support.');
            return redirect()->route('home');
        }
        
        $this->startDate = Carbon::now()->startOfWeek()->format('Y-m-d');
        $this->endDate = Carbon::now()->endOfWeek()->format('Y-m-d');
    }

    public function setPeriod($period)
    {
        $this->selectedPeriod = $period;
        
        switch ($period) {
            case 'today':
                $this->startDate = Carbon::today()->format('Y-m-d');
                $this->endDate = Carbon::today()->format('Y-m-d');
                break;
            case 'week':
                $this->startDate = Carbon::now()->startOfWeek()->format('Y-m-d');
                $this->endDate = Carbon::now()->endOfWeek()->format('Y-m-d');
                break;
            case 'month':
                $this->startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
                $this->endDate = Carbon::now()->endOfMonth()->format('Y-m-d');
                break;
            case 'year':
                $this->startDate = Carbon::now()->startOfYear()->format('Y-m-d');
                $this->endDate = Carbon::now()->endOfYear()->format('Y-m-d');
                break;
        }
    }

    public function render()
    {
        // Calculate various earnings
        $totalEarnings = RiderAssignment::where('rider_id', $this->rider->id)
            ->where('status', 'completed')
            ->count() * 50;
        
        $todayEarnings = RiderAssignment::where('rider_id', $this->rider->id)
            ->where('status', 'completed')
            ->whereDate('completed_at', Carbon::today())
            ->count() * 50;
        
        $weeklyEarnings = RiderAssignment::where('rider_id', $this->rider->id)
            ->where('status', 'completed')
            ->whereBetween('completed_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->count() * 50;
        
        $monthlyEarnings = RiderAssignment::where('rider_id', $this->rider->id)
            ->where('status', 'completed')
            ->whereBetween('completed_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
            ->count() * 50;
        
        $yearlyEarnings = RiderAssignment::where('rider_id', $this->rider->id)
            ->where('status', 'completed')
            ->whereBetween('completed_at', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])
            ->count() * 50;

        // Earnings for selected period
        $periodEarnings = RiderAssignment::where('rider_id', $this->rider->id)
            ->where('status', 'completed')
            ->whereBetween('completed_at', [$this->startDate, $this->endDate])
            ->with(['order.merchant', 'order.customer'])
            ->latest('completed_at')
            ->get();
        
        $periodTotal = $periodEarnings->count() * 50;

        // Monthly earnings for chart (last 12 months)
        $monthlyData = [];
        for ($i = 11; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $earnings = RiderAssignment::where('rider_id', $this->rider->id)
                ->where('status', 'completed')
                ->whereYear('completed_at', $month->year)
                ->whereMonth('completed_at', $month->month)
                ->count() * 50;
            $monthlyData[] = [
                'month' => $month->format('M Y'),
                'amount' => $earnings
            ];
        }

        return view('livewire.rider.earnings', [
            'totalEarnings' => $totalEarnings,
            'todayEarnings' => $todayEarnings,
            'weeklyEarnings' => $weeklyEarnings,
            'monthlyEarnings' => $monthlyEarnings,
            'yearlyEarnings' => $yearlyEarnings,
            'periodEarnings' => $periodEarnings,
            'periodTotal' => $periodTotal,
            'monthlyData' => $monthlyData,
        ])->layout('layouts.rider');
    }
}
