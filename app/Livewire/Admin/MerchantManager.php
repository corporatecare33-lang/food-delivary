<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class MerchantManager extends Component
{
    use \Livewire\WithPagination;

    public function approve($id)
    {
        $merchant = \App\Models\Merchant::findOrFail($id);
        $merchant->update(['status' => 'approved']);

        \App\Models\ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'MERCHANT_APPROVED',
            'description' => "Approved merchant: {$merchant->business_name}",
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        session()->flash('message', 'Merchant approved successfully.');
    }

    public function reject($id)
    {
        $merchant = \App\Models\Merchant::findOrFail($id);
        $merchant->update(['status' => 'rejected']);

        \App\Models\ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'MERCHANT_REJECTED',
            'description' => "Rejected merchant: {$merchant->business_name}",
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        session()->flash('message', 'Merchant rejected.');
    }

    public function delete($id)
    {
        $merchant = \App\Models\Merchant::findOrFail($id);
        $merchant->delete();
        session()->flash('message', 'Merchant deleted.');
    }

    public function render()
    {
        return view('livewire.admin.merchant-manager', [
            'merchants' => \App\Models\Merchant::with('user')->latest()->paginate(10)
        ]);
    }
}
