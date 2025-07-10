<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'bus_company',
        'bus_type',
        'origin_terminal',
        'destination_terminal',
        'departure_time',
        'arrival_time',
        'duration_minutes',
        'price',
        'total_seats',
        'available_seats',
        'facilities',
        'days_of_week',
        'is_active'
    ];
    
    protected $casts = [
        'departure_time' => 'datetime:H:i',
        'arrival_time' => 'datetime:H:i',
        'price' => 'decimal:2',
        'facilities' => 'array',
        'days_of_week' => 'array',
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
        $dayOfWeek = strtolower(date('l', strtotime($date)));
        
        return $query->where('origin_terminal', 'like', '%' . $origin . '%')
                    ->where('destination_terminal', 'like', '%' . $destination . '%')
                    ->whereJsonContains('days_of_week', $dayOfWeek);
    }
}
