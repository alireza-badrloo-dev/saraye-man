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
}