<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RestaurantDocument extends Model
{
    protected $table = 'restaurant_documents';

    protected $fillable = [
        'document_type',
        'file_path',
        'restaurant_id',
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
