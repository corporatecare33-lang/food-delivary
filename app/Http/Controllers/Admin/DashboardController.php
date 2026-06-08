<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $view = 'admin.dashboard';
        $data = [];

        // Dynamic stats for overview
        $data['stats'] = [
            'today_orders' => \App\Models\Order::whereDate('created_at', today())->count(),
            'revenue' => \App\Models\Order::whereDate('created_at', today())->sum('total_amount'),
            'active_merchants' => \App\Models\Merchant::where('status', 'approved')->count(),
            'riders_on_duty' => \App\Models\Rider::where('status', 'idle')->orWhere('status', 'busy')->count(),
        ];

        // Weekly orders for chart
        $data['chart_data'] = [
            'labels' => [],
            'data' => []
        ];

        for ($i = 6; $i >= 0; $i--) {
            $date = today()->subDays($i);
            $data['chart_data']['labels'][] = $date->format('D');
            $data['chart_data']['data'][] = \App\Models\Order::whereDate('created_at', $date)->count();
        }

        $route = $request->route()->getName();

        if ($route === 'admin.orders') {
            $view = 'admin.orders';
            $data['orders'] = \App\Models\Order::with(['merchant', 'customer', 'riderAssignment.rider.user'])->latest()->paginate(10);
        } elseif ($route === 'admin.merchants') {
            $view = 'admin.merchants';
        } elseif ($route === 'admin.riders') {
            $view = 'admin.riders';
        } elseif ($route === 'admin.customers') {
            $view = 'admin.customers';
            $data['customers'] = \App\Models\User::whereHas('role', function($q) {
                $q->where('slug', 'customer');
            })->latest()->paginate(10);
        } elseif ($route === 'admin.commission') {
            $view = 'admin.commission';
        } elseif ($route === 'admin.settings') {
            $view = 'admin.settings';
        } elseif ($route === 'admin.logs') {
            $view = 'admin.logs';
        } else {
            $data['recent_orders'] = \App\Models\Order::with('merchant')->latest()->take(5)->get();
        }

        return view($view, $data);
    }
}
