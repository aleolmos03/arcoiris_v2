<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEvent extends Model
{
    use HasFactory;

    public $timestamps = false;

    Public function events()
    {
        // tiene muchas Eventos
        return $this->hasMany(Event::class);
    }

    Public function users()
    {
        // tiene muchas usuarios
        return $this->hasMany(User::class);
    }
}
