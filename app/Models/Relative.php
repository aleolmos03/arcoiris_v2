<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relative extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function person()
    {
        // Un familiar tiene una persona
        return $this->hasOne(Person::class);
    }

    public function pacient()
    {
        //un familiar tiene un paciente
        return $this->hasOne(Patient::class);
    }

    public function relationship()
    {
        //un paciente tiene untipo de parentezco
        return $this->hasMany(Relationship::class);
    }
}
