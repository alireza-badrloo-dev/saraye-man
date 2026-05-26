<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'admins';
    
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'mobile',
        'password',
        'role',
        'permissions',
        'profile_image',
        'gender',
        'national_code',
        'birth_date',
        'address',
        'status',
        'last_login_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'permissions' => 'array',
        'last_login_at' => 'datetime',
        'birth_date' => 'date',
    ];

    // متدهای کمکی
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function isSuperAdmin()
    {
        return $this->role === 'super_admin';
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isModerator()
    {
        return $this->role === 'moderator';
    }

    public function isActive()
    {
        return $this->status === 'active';
    }

    public function getStatusTextAttribute()
    {
        $statuses = [
            'active' => 'فعال',
            'inactive' => 'غیرفعال',
            'blocked' => 'مسدود',
        ];
        return $statuses[$this->status] ?? 'نامشخص';
    }

    public function getStatusClassAttribute()
    {
        $classes = [
            'active' => 'bg-green-100 text-green-700',
            'inactive' => 'bg-gray-100 text-gray-700',
            'blocked' => 'bg-red-100 text-red-700',
        ];
        return $classes[$this->status] ?? 'bg-gray-100 text-gray-700';
    }

    public function getRoleTextAttribute()
    {
        $roles = [
            'super_admin' => 'سوپر ادمین',
            'admin' => 'ادمین',
            'moderator' => 'مدیر محتوا',
        ];
        return $roles[$this->role] ?? 'نامشخص';
    }

    public function getGenderTextAttribute()
    {
        if ($this->gender == 'male') return 'مرد';
        if ($this->gender == 'female') return 'زن';
        return 'نامشخص';
    }

    public function hasPermission($permission)
    {
        if ($this->isSuperAdmin()) {
            return true;
        }
        $permissions = $this->permissions ?? [];
        return in_array($permission, $permissions);
    }
}