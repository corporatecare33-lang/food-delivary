<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class RiderManager extends Component
{
    use \Livewire\WithPagination;

    public function approve($id)
    {
        $rider = \App\Models\Rider::findOrFail($id);
        $rider->update(['application_status' => 'approved', 'status' => 'idle']);
        session()->flash('message', 'Rider approved successfully.');
    }

    public function reject($id)
    {
        $rider = \App\Models\Rider::findOrFail($id);
        $rider->update(['application_status' => 'rejected']);
        session()->flash('message', 'Rider application rejected.');
    }

    public function delete($id)
    {
        $rider = \App\Models\Rider::findOrFail($id);
        $rider->delete();
        session()->flash('message', 'Rider deleted.');
    }

    public function render()
    {
        return view('livewire.admin.rider-manager', [
            'riders' => \App\Models\Rider::with('user')->latest()->paginate(10)
        ]);
    }
}
