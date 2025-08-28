<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class CashierRestaurant extends Authenticatable implements JWTSubject
{
    protected $table = 'cashier_restaurants';

    protected $fillable = [
        'username',
        'image_staff',
        'nik',
        'restaurant_id',
    ];

    protected $hidden = [
        'nik',
    ];

    public function getAuthPassword()
    {
        return $this->nik;
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
