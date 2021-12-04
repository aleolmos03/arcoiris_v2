<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    Public function address()
    {
        // una persona tiene una direccion
        return $this->hasOne(Address::class);
    }

    Public function blood_type()
    {
        // una persona tiene un grupo sanguineo
        return $this->hasOne(BloodType::class);
    }

    Public function patient()
    {
        // una persona tiene un paciente
        return $this->hasOne(Patient::class);
    }

    Public function relative()
    {
        // una persona tiene un familiar
        return $this->hasOne(Relative::class);
    }

    Public function user()
    {
        // una persona tiene un usuario
        return $this->hasOne(User::class);
    }


}
