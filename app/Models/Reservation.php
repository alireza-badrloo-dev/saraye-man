<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'user_id',
        'accommodation_id',
        'room_id',
        'check_in',
        'check_out',
        'nights',
        'guests',
        'price_per_night',
        'total_price',
        'tracking_code',
        'status',
        'notes',
        'authority',
        'ref_id',
        'transaction_id',

    ];

    protected $casts = [
        'check_in' => 'date',
        'check_out' => 'date',
    ];

    public static function generateTrackingCode()
    {
        return 'RES-' . strtoupper(uniqid()) . '-' . rand(1000, 9999);
    }

    // ========== رابطه‌ها ==========

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function accommodation()
    {
        return $this->belongsTo(Accommodation::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }



    

    public function companions()
    {
        return $this->hasMany(Companion::class);
    }
    // ========== اسکوپ‌ها ==========

    public function scopeCheckOverlap($query, $roomId, $checkIn, $checkOut)
    {
        return $query->where('room_id', $roomId)
            ->where('status', '!=', 'cancelled')
            ->where(function ($q) use ($checkIn, $checkOut) {
                $q->whereBetween('check_in', [$checkIn, $checkOut])
                    ->orWhereBetween('check_out', [$checkIn, $checkOut])
                    ->orWhere(function ($sq) use ($checkIn, $checkOut) {
                        $sq->where('check_in', '<=', $checkIn)
                            ->where('check_out', '>=', $checkOut);
                    });
            });
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'confirmed')
            ->where('check_in', '<=', now())
            ->where('check_out', '>=', now());
    }

    public function scopeUpcoming($query)
    {
        return $query->where('status', 'confirmed')
            ->where('check_in', '>', now());
    }

    // ========== متدهای وضعیت ==========

    public function getStatusTextAttribute()
    {
        $statuses = [
            'pending' => 'در انتظار پرداخت',
            'confirmed' => 'تایید شده',
            'cancelled' => 'لغو شده',
            'completed' => 'تکمیل شده',
        ];

        return $statuses[$this->status] ?? 'نامشخص';
    }

    public function getStatusClassAttribute()
    {
        $classes = [
            'pending' => 'bg-yellow-100 text-yellow-700',
            'confirmed' => 'bg-green-100 text-green-700',
            'cancelled' => 'bg-red-100 text-red-700',
            'completed' => 'bg-blue-100 text-blue-700',
        ];

        return $classes[$this->status] ?? 'bg-gray-100 text-gray-700';
    }
}
