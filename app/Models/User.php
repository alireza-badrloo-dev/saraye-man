<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $table = 'users';
    protected $fillable = [
        'email',
        'password',
        'mobile',
        'first_name',
        'last_name',
        'nationality',
        'national_id',
        'postal_code',
        'gender',
        'birth_date',
        'address',
        'favourites',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'favourites' => 'array',  // این رو اضافه کن
        ];
    }

    // ========== متدهای علاقه‌مندی ==========

    public function addFavourite($id)
    {
        $favourites = $this->favourites ?? [];
        if (!in_array($id, $favourites)) {
            $favourites[] = $id;
            $this->favourites = $favourites;
            $this->save();
        }
    }

    public function removeFavourite($id)
    {
        $favourites = $this->favourites ?? [];
        if (($key = array_search($id, $favourites)) !== false) {
            unset($favourites[$key]);
            $this->favourites = array_values($favourites);
            $this->save();
        }
    }

    public function hasFavourite($id)
    {
        $favourites = $this->favourites ?? [];
        return in_array($id, $favourites);
    }

    public function getFavourites()
    {
        $ids = $this->favourites ?? [];
        return Accommodation::whereIn('id', $ids)->get();
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
