<?php

namespace App\Livewire;

use Livewire\Component;

class MerchantDetails extends Component
{
    public $merchant;

    public function mount($slug)
    {
        $this->merchant = \App\Models\Merchant::where('slug', $slug)
            ->with(['menus.items'])
            ->firstOrFail();
    }

    public function render()
    {
        return view('livewire.merchant-details')->layout('layouts.guest');
    }
}
