<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class FinancialManager extends Component
{
    use \Livewire\WithPagination;

    public function settle($id)
    {
        $commission = \App\Models\Commission::findOrFail($id);
        $commission->update(['status' => 'settled']);
        session()->flash('message', 'Commission settled successfully.');
    }

    public function render()
    {
        $totalCommission = \App\Models\Commission::sum('admin_commission');
        $pendingSettlement = \App\Models\Commission::where('status', 'pending')->sum('merchant_payable');

        return view('livewire.admin.financial-manager', [
            'commissions' => \App\Models\Commission::with(['merchant', 'order'])->latest()->paginate(10),
            'totalCommission' => $totalCommission,
            'pendingSettlement' => $pendingSettlement
        ]);
    }
}
