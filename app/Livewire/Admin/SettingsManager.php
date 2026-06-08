<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Setting;

class SettingsManager extends Component
{
    public $settings = [];

    public function mount()
    {
        $allSettings = Setting::all();
        
        // Default settings if not exists
        $defaults = [
            'app_name' => 'Foosto',
            'admin_commission_rate' => '10',
            'delivery_fee_per_km' => '20',
            'min_order_amount' => '100',
            'contact_email' => 'admin@foosto.com',
            'contact_phone' => '+880123456789',
        ];

        foreach ($defaults as $key => $value) {
            $setting = $allSettings->where('key', $key)->first();
            $this->settings[$key] = $setting ? $setting->value : $value;
        }
    }

    public function save()
    {
        foreach ($this->settings as $key => $value) {
            Setting::set($key, $value);
        }

        session()->flash('message', 'Settings saved successfully.');
    }

    public function render()
    {
        return view('livewire.admin.settings-manager');
    }
}
