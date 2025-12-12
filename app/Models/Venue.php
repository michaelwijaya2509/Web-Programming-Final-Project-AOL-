<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Venue extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'location',
        'description',
        'price_per_hour',
        'venue_image',
    ];

      protected $casts = [
        'is_active' => 'boolean',
        'price_per_hour' => 'decimal:2',
    ];

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function averageRating()
    {
        return $this->ratings()->avg('rating');
    }

    public function courts()
    {
        return $this->hasMany(Court::class);
    }
}
