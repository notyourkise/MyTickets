<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Train extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'train_name',
        'train_number',
        'origin_station',
        'destination_station',
        'departure_time',
        'arrival_time',
        'duration_minutes',
        'price_economy',
        'price_business',
        'price_executive',
        'seats_economy',
        'seats_business',
        'seats_executive',
        'available_economy',
        'available_business',
        'available_executive',
        'days_of_week',
        'is_active'
    ];
    
    protected $casts = [
        'departure_time' => 'datetime:H:i',
        'arrival_time' => 'datetime:H:i',
        'price_economy' => 'decimal:2',
        'price_business' => 'decimal:2',
        'price_executive' => 'decimal:2',
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
        
        return $query->where('origin_station', 'like', '%' . $origin . '%')
                    ->where('destination_station', 'like', '%' . $destination . '%')
                    ->whereJsonContains('days_of_week', $dayOfWeek);
    }
}
