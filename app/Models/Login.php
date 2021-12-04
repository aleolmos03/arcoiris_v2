<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    use HasFactory;

    public $timestamps = false;

    Public function user()
    {
        // una login tiene un usuario
        return $this->hasOne(User::class);
    }
}
