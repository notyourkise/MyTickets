<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'airline',
        'flight_number',
        'origin_city',
        'origin_airport',
        'destination_city',
        'destination_airport',
        'departure_time',
        'arrival_time',
        'duration_minutes',
        'aircraft_type',
        'price_economy',
        'price_business',
        'price_first',
        'seats_economy',
        'seats_business',
        'seats_first',
        'available_economy',
        'available_business',
        'available_first',
        'is_active'
    ];
    
    protected $casts = [
        'departure_time' => 'datetime',
        'arrival_time' => 'datetime',
        'price_economy' => 'decimal:2',
        'price_business' => 'decimal:2',
        'price_first' => 'decimal:2',
        'is_active' => 'boolean'
    ];
    
    public function bookings()
    {
        return $this->morphMany(Booking::class, 'bookable');
    }
    
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
    
    public function scopeSearch($query, $origin, $destination, $date)
    {
        return $query->where('origin_city', 'like', '%' . $origin . '%')
                    ->where('destination_city', 'like', '%' . $destination . '%')
                    ->whereDate('departure_time', $date);
    }
}
