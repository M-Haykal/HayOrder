<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';

    protected $fillable = [
        'name',
        'description',
        'price',
        'image_menu',
        'category_id',
        'restaurant_id',
    ];

    protected $casts = [
        'image_menu' => 'json',
    ];


    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
