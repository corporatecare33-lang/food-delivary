<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    protected $fillable = [
        'order_number', 'user_id', 'merchant_id', 'subtotal', 
        'delivery_fee', 'tax', 'total_amount', 'status', 
        'payment_method', 'payment_status', 'delivery_address', 
        'notes', 'delivered_at'
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function riderAssignment()
    {
        return $this->hasOne(RiderAssignment::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function commission()
    {
        return $this->hasOne(Commission::class);
    }
}
