<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $table = 'tables';

    protected $fillable = [
        'table_number',
        'restaurant_id',
        'qr_code_path',
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
