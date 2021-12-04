<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalControl extends Model
{
    use HasFactory;

    Public function patient()
    {
        // Un Control tiene una persona
        return $this->hasOne(Person::class);
    }

    Public function user()
    {
        // Un control lo registra un usuario
        return $this->hasOne(User::class);
    }


}
