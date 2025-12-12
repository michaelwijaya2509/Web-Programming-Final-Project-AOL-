<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'venue_id',
        'court_id',
        'booking_date',
        'start_time',
        'end_time',
        'total_price',
        'status',
        'notes',
    ];

      protected $casts = [
        'booking_date' => 'date',
        'start_time'   => 'datetime:H:i',
        'end_time'     => 'datetime:H:i',
        'duration_hour'=> 'decimal:2',
        'total_price'  => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }
    
    public function court()
    {
        return $this->belongsTo(Court::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function isPaid(): bool
    {
        return $this->status === 'paid' || $this->status === 'completed';
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }
}
