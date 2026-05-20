<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{
    protected $table = 'accommodations';
    protected $guarded = [];

    protected $casts = [
        'images' => 'array',
        'general_facilities' => 'array',
        'room_facilities' => 'array',
        'private_facilities' => 'array',
        'leisure_facilities' => 'array',
        'entertainment_facilities' => 'array',
    ];

    // ========== متدهای کمکی برای تصاویر ==========
    public function getFirstImageAttribute()
    {
        $images = $this->images ?? [];
        $first = $images[0] ?? null;
        return $first ? asset('storage/uplouds/' . $first) : asset('images/default.jpg');
    }

    // ========== متدهای کمکی برای facilities ==========
    public function getGeneralFacilitiesListAttribute()
    {
        return $this->general_facilities ?? [];
    }

    public function getRoomFacilitiesListAttribute()
    {
        return $this->room_facilities ?? [];
    }

    public function getPrivateFacilitiesListAttribute()
    {
        return $this->private_facilities ?? [];
    }

    public function getLeisureFacilitiesListAttribute()
    {
        return $this->leisure_facilities ?? [];
    }

    public function getEntertainmentFacilitiesListAttribute()
    {
        return $this->entertainment_facilities ?? [];
    }

    // رابطه‌ها
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->where('status', 'approved');
    }

    public function allComments()
    {
        return $this->hasMany(Comment::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
