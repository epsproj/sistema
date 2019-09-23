<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitudfactibilidad extends Model
{
    //
    protected $table='solicitudfactibilidades';
    protected $fillable = ['direccionobra','codigoinmueble','noexpediente','noexpedienteinterno','nofinca','nofolio',
    'libro','nocatastral','solvenciamunicipal','observacion','longitud','ancho','profundidad',
    'diametrotubo','diametrocolector','idtipoobra','idejecutor','idpersona','idestadofactibilidad'];

    public function ejecutor(){
        return $this->belongsTo('App\Ejecutor');
    }

    public function tipoobra(){
        return $this->belongsTo('App\Tipoobra');
    }

    public function persona(){
        return $this->belongsTo('App\Persona');
    }

    public function estadofactibilidad(){
        return $this->belongsTo('App\Estadofactibilidad');
    }
}

