<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'is_read'
    ];

    // اسکوپ برای پیام‌های خوانده نشده
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    // اسکوپ برای پیام‌های خوانده شده
    public function scopeRead($query)
    {
        return $query->where('is_read', true);
    }
}