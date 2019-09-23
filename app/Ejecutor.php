<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ejecutor extends Model
{
    //
    protected $table='ejecutores';

    protected $fillable = ['idcargoejecutor','nombre','direccion','estado'];

    public function cargoejecutor(){
        return $this->belongsTo('App\Cargoejecutor');
    }

    public function solicitudfactibilidades()
    {
        return $this->hasMany('App\Solicitudfactibilidad');
    }
}
