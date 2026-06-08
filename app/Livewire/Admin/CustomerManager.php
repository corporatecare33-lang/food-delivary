<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class CustomerManager extends Component
{
    use WithPagination;

    public $search = '';

    protected $updatesQueryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function toggleStatus($userId)
    {
        $user = User::findOrFail($userId);
        // Assuming there's a status column or we use another way to deactivate
        // For now, let's just use a simple logic if status column exists or add it
        // If no status column, we might need a migration, but let's check User model first
    }

    public function render()
    {
        $customers = User::whereHas('role', function($q) {
                $q->where('slug', 'customer');
            })
            ->where(function($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%')
                  ->orWhere('mobile', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);

        return view('livewire.admin.customer-manager', [
            'customers' => $customers
        ]);
    }
}
