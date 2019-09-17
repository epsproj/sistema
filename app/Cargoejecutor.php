<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cargoejecutor extends Model
{
    //
    protected $table='cargoejecutores';
    //protected $primaryKey='id'

    protected $fillable = ['nombre','estado'];

    public function ejecutores()
    {
        return $this->hasMany('App\Ejecutor');
    }
}
