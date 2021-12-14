<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    //public $timestamps = false;

    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function adminlte_image()
    {
        $file=Person::find(auth()->user()->person_id);

        return $file->file;
        //return 'https://picsum.photos/300/300';

    }

    public function adminlte_desc()
    {
        $nombre_rol=Role::find(auth()->user()->role_id);

        return $nombre_rol->name;
    }

    public function adminlte_profile_url()
    {
        return 'perfil/';
    }

    public function user_name()
    {
        $nombre_rol=Person::find(auth()->user()->person_id);

        return $nombre_rol->name;
    }

    public function user_last_name()
    {
        $nombre_rol=Person::find(auth()->user()->person_id);

        return $nombre_rol->last_name;
    }



    public function role()
    {
        //un usuario tiene un rol
        return $this->hasMany(Role::class);
    }

    Public function logins()
    {
        // un usuario tiene muchos Login
        return $this->hasMany(Login::class);
    }

    Public function backups()
    {
        // un usuario tiene muchos backup
        return $this->hasMany(Backup::class);
    }

    Public function medical_controls()
    {
        // un usuario registra muchos medical_controls
        return $this->hasMany(MedicalControl::class);
    }

    Public function donations()
    {
        // un usuario registra muchos donations
        return $this->hasMany(Donation::class);
    }

    Public function Events()
    {
        // un usuario registra muchos eventos
        return $this->hasMany(Event::class);
    }

    Public function people()
    {
        // un usuario registra muchos personas
        return $this->hasMany(Person::class);
    }


}
