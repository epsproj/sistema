<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipodevia extends Model
{
    protected $table = 'tipodevia';
    //protected $pri
    //
    protected $fillable = ['nombre',
    'descripcion',
    'condicion'];
}
