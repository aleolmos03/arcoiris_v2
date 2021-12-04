<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    public $timestamps = false;

    Public function person()
    {
        // Un paciente tiene una persona
        return $this->hasOne(Person::class);
    }

    Public function diagnosis()
    {
         // Un paciente tiene un diagnostico
        return $this->hasOne(Diagnosis::class);
    }

    Public function donations()
    {
        // Un paciente tiene muchas donaciones
        return $this->hasMany(Donation::class);
    }

    Public function medical_controls()
    {
        // Un paciente tiene muchos Controles
        return $this->hasMany(MedicalControl::class);
    }


}
