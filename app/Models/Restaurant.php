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

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($restaurant) {
            $restaurant->slug = Str::slug($restaurant->name_restaurant) . '-' . Str::random(10);
        });
    }

}
