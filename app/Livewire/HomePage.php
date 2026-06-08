<?php

namespace App\Livewire;

use Livewire\Component;

class HomePage extends Component
{
    public $search = '';

    public function render()
    {
        $merchants = \App\Models\Merchant::where('status', 'approved')
            ->when($this->search, function($query) {
                $query->where('business_name', 'like', '%' . $this->search . '%');
            })
            ->take(8)
            ->get();

        $lunchItems = \App\Models\MenuItem::where('is_available', true)
            ->whereHas('menu', function($query) {
                $query->where('name', 'like', '%Lunch%');
            })
            ->when($this->search, function($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->with('menu.merchant')
            ->latest()
            ->take(12)
            ->get();

        return view('livewire.home-page', [
            'merchants' => $merchants,
            'lunchItems' => $lunchItems,
        ])->layout('layouts.guest');
    }
}
