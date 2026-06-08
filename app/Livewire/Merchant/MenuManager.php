<?php

namespace App\Livewire\Merchant;

use Livewire\Component;

class MenuManager extends Component
{
    use \Livewire\WithFileUploads;

    public $merchant;
    public $name, $price, $description, $image, $menu_id;
    public $is_available = true;

    public function mount()
    {
        $this->merchant = auth()->user()->merchant;
    }

    public function addItem()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:1024',
            'menu_id' => 'required|exists:merchant_menus,id',
        ]);

        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('menu-items', 'public');
            $imagePath = '/storage/' . $imagePath;
        }

        \App\Models\MenuItem::create([
            'merchant_menu_id' => $this->menu_id,
            'name' => $this->name,
            'slug' => \Illuminate\Support\Str::slug($this->name . '-' . uniqid()),
            'price' => $this->price,
            'description' => $this->description,
            'image' => $imagePath ?? 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?auto=format&fit=crop&q=80&w=500',
            'is_available' => $this->is_available,
        ]);

        $this->reset(['name', 'price', 'description', 'image', 'menu_id']);
        session()->flash('message', 'Item added successfully!');
    }

    public function toggleAvailability($id)
    {
        $item = \App\Models\MenuItem::findOrFail($id);
        $item->update(['is_available' => !$item->is_available]);
    }

    public function deleteItem($id)
    {
        \App\Models\MenuItem::findOrFail($id)->delete();
        session()->flash('message', 'Item deleted!');
    }

    public function render()
    {
        $menus = $this->merchant->menus;
        $items = \App\Models\MenuItem::whereIn('merchant_menu_id', $menus->pluck('id'))->latest()->get();

        return view('livewire.merchant.menu-manager', [
            'menus' => $menus,
            'items' => $items,
        ])->layout('layouts.app');
    }
}
