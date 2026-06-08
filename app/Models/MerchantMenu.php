<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantMenu extends Model
{
    /** @use HasFactory<\Database\Factories\MerchantMenuFactory> */
    use HasFactory;

    protected $fillable = ['merchant_id', 'name', 'slug', 'is_active'];

    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    public function items()
    {
        return $this->hasMany(MenuItem::class);
    }
}
