<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Backup extends Model
{
    use HasFactory;

    public $timestamps = false;

    Public function user()
    {
        // una backup tiene un usuario
        return $this->hasOne(User::class);
    }
}
