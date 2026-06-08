<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merchant extends Model
{
    /** @use HasFactory<\Database\Factories\MerchantFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id', 'business_name', 'slug', 'description', 'address', 
        'logo', 'banner', 'commission_rate', 'status', 'is_featured'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function menus()
    {
        return $this->hasMany(MerchantMenu::class);
    }

    public function menuItems()
    {
        return $this->hasManyThrough(MenuItem::class, MerchantMenu::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
