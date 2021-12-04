<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventType extends Model
{
    use HasFactory;

    public $timestamps = false;

    Public function events()
    {
        // un tipo de evento tiene muchos eventos
        return $this->hasMany(Event::class);
    }
}
