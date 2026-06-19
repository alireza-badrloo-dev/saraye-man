<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'rooms';
    protected $guarded = [];

    public function accommodation()
    {
        return $this->belongsTo(Accommodation::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    // بررسی اینکه اتاق در بازه تاریخی رزرو شده یا نه
    public function isBooked($checkIn, $checkOut)
    {
        return $this->reservations()
            ->where('status', '!=', 'cancelled')
            ->where(function($q) use ($checkIn, $checkOut) {
                $q->whereBetween('check_in', [$checkIn, $checkOut])
                  ->orWhereBetween('check_out', [$checkIn, $checkOut])
                  ->orWhere(function($sq) use ($checkIn, $checkOut) {
                      $sq->where('check_in', '<=', $checkIn)
                         ->where('check_out', '>=', $checkOut);
                  });
            })
            ->exists();
    }
    
    // وضعیت فعلی اتاق
    public function getStatusAttribute()
    {
        $now = now();
        
        $activeReservation = $this->reservations()
            ->where('status', 'confirmed')
            ->where('check_in', '<=', $now)
            ->where('check_out', '>=', $now)
            ->exists();
        
        if ($activeReservation) {
            return 'occupied';
        }
        
        $futureReservation = $this->reservations()
            ->where('status', 'confirmed')
            ->where('check_in', '>', $now)
            ->exists();
        
        if ($futureReservation) {
            return 'reserved';
        }
        
        return 'available';
    }
    
    public function getStatusTextAttribute()
    {
        $statuses = [
            'occupied' => 'در حال استفاده',
            'reserved' => 'رزرو شده',
            'available' => 'موجود',
        ];
        
        return $statuses[$this->status] ?? 'نامشخص';
    }
    
    public function getStatusClassAttribute()
    {
        $classes = [
            'occupied' => 'bg-red-100 text-red-700',
            'reserved' => 'bg-yellow-100 text-yellow-700',
            'available' => 'bg-green-100 text-green-700',
        ];
        
        return $classes[$this->status] ?? 'bg-gray-100 text-gray-700';
    }
}