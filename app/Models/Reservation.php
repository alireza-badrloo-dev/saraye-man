<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use PhpMonsters\Larapay\Payable;

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

    

    public function getAmount()
    {
        // محاسبه مبلغ تراکنش بر اساس رزرو (در اینجا return $this->total_price * 10)
        return intval($this->total_price) * 10;
    }


    // ========== متدهای کمکی ==========

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
}
