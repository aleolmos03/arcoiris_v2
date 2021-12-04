<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    Public function address()
    {
        // un evento tiene una direccion
        return $this->hasOne(Address::class);
    }

    Public function event_type()
    {
        // un evento tiene un tipo de evento
        return $this->hasOne(EventType::class);
    }

    Public function user()
    {
        // una evento tiene un usuario creador
        return $this->hasOne(User::class);
    }

    Public function users()
    {
        // un evento tiene muchas(asisten) usuarios
        return $this->belongsToMany('App\User', 'user_events');
    }


}
