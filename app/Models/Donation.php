<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;

    Public function type_donation()
    {
        // Una donacion tiene un tipo donscion
        return $this->hasOne(DonationType::class);
    }

    Public function patient()
    {
        // Una donacion tiene un paciente
        return $this->hasOne(Patient::class);
    }

    Public function user()
    {
        // Una donacion tiene un usuario
        return $this->hasOne(User::class);
    }
}
