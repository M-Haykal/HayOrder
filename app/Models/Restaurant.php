<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Restaurant extends Model
{
    protected $table = 'restaurants';

    protected $fillable = [
        'name_restaurant',
        'address',
        'slug',
        'status',
        'verified_at',
        'verification_notes',
        'qr_code_path',
        'owner_id',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }

    public function tables()
    {
        return $this->hasMany(Table::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($restaurant) {
            $restaurant->slug = Str::slug($restaurant->name_restaurant) . '-' . Str::random(10);
        });
    }
}
