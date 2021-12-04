<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodType extends Model
{
    use HasFactory;

    public $timestamps = false;

    Public function people()
    {
        // una grupo sanguineo tiene muchas personas
        return $this->hasMany(Person::class);
    }
}
