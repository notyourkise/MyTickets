<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'hotel_name',
        'city',
        'address',
        'star_rating',
        'description',
        'facilities',
        'image_url',
        'rating',
        'total_reviews',
        'is_active'
    ];
    
    protected $casts = [
        'facilities' => 'array',
        'rating' => 'decimal:1',
        'is_active' => 'boolean'
    ];
    
    public function rooms()
    {
        return $this->hasMany(HotelRoom::class);
    }
    
    public function bookings()
    {
        return $this->morphMany(Booking::class, 'bookable');
    }
    
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
    
    public function scopeSearch($query, $city, $checkin, $checkout)
    {
        return $query->where('city', 'like', '%' . $city . '%');
    }
}
