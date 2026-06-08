<?php

namespace App\Livewire\Admin;

use Livewire\Component;

use App\Livewire\Actions\Logout;

class LogoutButton extends Component
{
    public function logout(Logout $logout)
    {
        $logout();

        return redirect('/');
    }

    public function render()
    {
        return <<<'HTML'
        <button wire:click="logout" class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
            Sign out
        </button>
        HTML;
    }
}
