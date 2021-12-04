<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    public $timestamps = false;

    Public function city()
    {
        // una direccion Pertenece a una ciudad
        return $this->belongsTo(City::class);
    }

    Public function person()
    {
        // una direccion Pertenece a una perosna
        return $this->belongsTo(Person::class);
    }

    Public function event()
    {
        // una direccion Pertenece a una perosna
        return $this->belongsTo(Event::class);
    }
}
