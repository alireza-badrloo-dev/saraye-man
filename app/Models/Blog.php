<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'summary',
        'content',
        'image',
        'category',
        'status',
        'views',
        'accommodation_id',
        'city_id',
        'author',
        
    ];

    protected $casts = [
        'views' => 'integer'
    ];

    // روابط
    public function accommodation()
    {
        return $this->belongsTo(Accommodation::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    // اسکوپ‌ها
    public function scopePublished($query)
    {
        return $query->where('status', 'created_at');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}