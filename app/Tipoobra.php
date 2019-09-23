<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipoobra extends Model
{
    protected $table='tipoobra';
    public $timestamps = false;
    protected $primaryKey='id';

    protected $fillable = ['nombre', 'estado'];

    public function solicitudfactibilidades()
    {
        return $this->hasMany('App\Solicitudfactibilidad');
    }
}
