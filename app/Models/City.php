<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{

protected $fillable = [
        'name',
        'image'
    ];

     public function accommodations()
    {
        return $this->hasMany(Accommodation::class);
    }


    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return asset('images/default-city.jpg');
    }
}
