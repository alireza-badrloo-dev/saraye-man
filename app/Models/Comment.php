<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user_id',
        'accommodation_id',
        'title',
        'comment',
        'rating',
        'positive_points',
        'negative_points',
        'status'
    ];

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
}
