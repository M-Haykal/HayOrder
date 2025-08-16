<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportRestaurant extends Model
{
    protected $table = 'report_restaurants';

    protected $fillable = [
        'email',
        'name',
        'message_report',
        'image_report',
        'status',
        'restaurant_id',
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
