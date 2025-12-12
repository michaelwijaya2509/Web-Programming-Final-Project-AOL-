<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class court extends Model
{
    protected $fillable = [
        'venue_id',
        'court_name',
        'is_active',
    ];

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
