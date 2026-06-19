<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Companion extends Model
{
    protected $fillable = [
        'reservation_id',
        'full_name',
        'national_code',
        'phone',
    ];
    
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}