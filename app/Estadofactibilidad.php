<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estadofactibilidad extends Model
{
    //
    protected $table='estadofactibilidades';
    protected $fillable = ['nombre','estado'];

    public function solicitudfactibilidades()
    {
        return $this->hasMany('App\Solicitudfactibilidad');
    }
}
