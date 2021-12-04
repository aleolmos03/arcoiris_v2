<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    public $timestamps = false;

    Public function province()
    {
        // una ciudad Pertenece a una Provincia
        return $this->belongsTo(Province::class);
    }

    Public function addresses()
    {
        //una ciudad tiene muchas direcciones
        return $this->hasMany(Addrres::class);
    }
}
