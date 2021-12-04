<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model
{
    use HasFactory;

    public $timestamps = false;

    Public function patient()
    {
        //un diagnostico pertenece a un paciente
        return $this->belongsTo(Patient::class);
    }
}
