<?php

namespace CorporacionPeru;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $fillable= ['id','nombre','descripcion'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
