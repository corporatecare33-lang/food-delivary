<?php

namespace App\Livewire\Merchant;

use Livewire\Component;

class Dashboard extends Component
{
    public $merchant;

    public function mount()
    {
        $this->merchant = auth()->user()->merchant;
    }

    public function render()
    {
        $stats = [
            'today_orders' => \App\Models\Order::where('merchant_id', $this->merchant->id)->whereDate('created_at', today())->count(),
            'pending_orders' => \App\Models\Order::where('merchant_id', $this->merchant->id)->where('status', 'pending')->count(),
            'total_sales' => \App\Models\Order::where('merchant_id', $this->merchant->id)->where('status', 'delivered')->sum('total_amount'),
            'total_items' => \App\Models\MenuItem::whereIn('merchant_menu_id', $this->merchant->menus->pluck('id'))->count(),
        ];

        $top_items = \App\Models\OrderItem::whereHas('order', function($q) {
                $q->where('merchant_id', $this->merchant->id)->where('status', 'delivered');
            })
            ->select('menu_item_id', \DB::raw('SUM(quantity) as total_qty'), \DB::raw('SUM(total) as total_sales'))
            ->groupBy('menu_item_id')
            ->orderByDesc('total_qty')
            ->take(5)
            ->with('menuItem')
            ->get();

        // Monthly sales data for chart
        $chart_data = [
            'labels' => [],
            'data' => []
        ];

        for ($i = 6; $i >= 0; $i--) {
            $date = today()->subDays($i);
            $chart_data['labels'][] = $date->format('D');
            $chart_data['data'][] = \App\Models\Order::where('merchant_id', $this->merchant->id)
                ->whereDate('created_at', $date)
                ->sum('total_amount');
        }

        $recent_orders = \App\Models\Order::where('merchant_id', $this->merchant->id)
            ->with('customer')
            ->latest()
            ->take(5)
            ->get();

        return view('livewire.merchant.dashboard', [
            'stats' => $stats,
            'recent_orders' => $recent_orders,
            'chart_data' => $chart_data,
            'top_items' => $top_items,
        ])->layout('layouts.app');
    }
}
