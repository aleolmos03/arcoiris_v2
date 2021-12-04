<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relationship extends Model
{
    use HasFactory;

    public $timestamps = false;

    Public function relatives()
    {
        // un parentezco tiene muchos familiares
        return $this->hasMany(Relative::class);
    }
}
