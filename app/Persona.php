<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    //
    protected $fillable = ['dpi','nombre','apellido','direccion','telefono','correo','estado'];

    public function solicitudfactibilidades()
    {
        return $this->hasMany('App\Solicitudfactibilidad');
    }
}
