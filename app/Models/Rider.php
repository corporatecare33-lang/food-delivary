<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rider extends Model
{
    /** @use HasFactory<\Database\Factories\RiderFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id', 'vehicle_type', 'vehicle_number', 
        'status', 'application_status', 'identity_proof', 'current_balance'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assignments()
    {
        return $this->hasMany(RiderAssignment::class);
    }
}
