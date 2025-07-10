<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Booking extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'booking_code',
        'user_id',
        'booking_type',
        'bookable_id',
        'bookable_type',
        'passenger_details',
        'travel_date',
        'return_date',
        'class_type',
        'quantity',
        'total_price',
        'payment_status',
        'booking_status',
        'paid_at'
    ];
    
    protected $casts = [
        'passenger_details' => 'array',
        'travel_date' => 'date',
        'return_date' => 'date',
        'total_price' => 'decimal:2',
        'paid_at' => 'datetime'
    ];
    
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($booking) {
            $booking->booking_code = 'MYT-' . strtoupper(Str::random(8));
        });
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function bookable()
    {
        return $this->morphTo();
    }
    
    public function scopePaid($query)
    {
        return $query->where('payment_status', 'paid');
    }
    
    public function scopePending($query)
    {
        return $query->where('payment_status', 'pending');
    }
}
