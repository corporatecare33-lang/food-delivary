<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    /** @use HasFactory<\Database\Factories\MenuItemFactory> */
    use HasFactory;

    protected $fillable = [
        'merchant_menu_id', 'name', 'slug', 'description', 
        'price', 'image', 'is_available', 'is_featured'
    ];

    public function menu()
    {
        return $this->belongsTo(MerchantMenu::class, 'merchant_menu_id');
    }
}
