<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\ActivityLog;
use Livewire\WithPagination;

class ActivityLogs extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.admin.activity-logs', [
            'logs' => ActivityLog::with('user')->latest()->paginate(20)
        ]);
    }
}
