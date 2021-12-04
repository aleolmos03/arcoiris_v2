<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonationType extends Model
{
    use HasFactory;

    public $timestamps = false;

    Public function donations()
    {
        // un tipo donacion tiene muchas Donaciones
        return $this->hasMany(Donation::class);
    }
}
