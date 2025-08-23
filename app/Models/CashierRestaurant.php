<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class CashierRestaurant extends Authenticatable
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
}
