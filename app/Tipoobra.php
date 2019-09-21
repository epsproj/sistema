<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipoobra extends Model
{
    protected $table='tipoobra';
    //protected $primaryKey='id'

    protected $fillable = ['nombre', 'estado'];
}
