<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estadodenuncia extends Model
{
    protected $table = 'estadodenuncia';
    //protected $primaryKey='id'

    protected $fillable = ['nombre','descripcion', 'condicion'];

}
