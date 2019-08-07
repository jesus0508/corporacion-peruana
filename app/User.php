<?php

namespace CorporacionPeru;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombres','apellido_paterno','apellido_materno','telefono','fecha_nacimiento', 'email', 'password',
    ];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setFechaNacimientoAttribute($value){ 
        $this->attributes['fecha_nacimiento']=Carbon::createFromFormat('d/m/Y',$value)->format('Y-m-d');
    }

    public function getFechaNacimientoAttribute($value){ 
        return $value ? Carbon::createFromFormat('Y-m-d',$value)->format('d/m/Y') : $value;
    }

    public function setPasswordAttribute($value){ 
        $this->attributes['password']=bcrypt($value);
    }
}
