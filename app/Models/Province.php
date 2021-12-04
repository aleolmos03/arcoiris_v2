<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    public $timestamps = false;

    Public function cities()
    {
        // una provincia tiene muchas ciudades
        return $this->hasMany(City::class);
    }
}
