<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
     public function accommodations()
    {
        return $this->hasMany(Accommodation::class);
    }
}
