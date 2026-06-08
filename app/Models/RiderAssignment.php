<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiderAssignment extends Model
{
    /** @use HasFactory<\Database\Factories\RiderAssignmentFactory> */
    use HasFactory;

    protected $fillable = [
        'order_id', 'rider_id', 'status', 
        'assigned_at', 'accepted_at', 'completed_at'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function rider()
    {
        return $this->belongsTo(Rider::class);
    }
}
