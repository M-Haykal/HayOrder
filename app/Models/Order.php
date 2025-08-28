<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    protected $fillable = [
        'name',
        'total_price',
        'status',
        'code_order',
        'note_order',
        'restaurant_id',
        'table_id',
    ];

    protected $uniqueKey = 'code_order';

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function table()
    {
        return $this->belongsTo(Table::class);
    }

            // public static function boot()
            // {
            //     parent::boot();

            //     static::creating(function ($order) {
            //         $order->code_order = (string) Str::uuid();
            //         while (static::where($this->uniqueKey, $order->code_order)->exists()) {
            //             $order->code_order = (string) Str::uuid();
            //         }
            //     });
            // }
}
