<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public $timestamps = false;

    Public function users()
    {
        // una rol tiene muchos usarios
        return $this->hasMany(User::class);
    }
}
