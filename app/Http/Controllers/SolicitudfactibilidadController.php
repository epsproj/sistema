<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Solicitudfactibilidad;
use App\Persona;
use App\Tipoobra;
use App\Estadofactibilidad;
use App\Ejecutor;
use Illuminate\Support\Facades\DB;

class SolicitudfactibilidadController extends Controller
{

    public function index(Request $request)
    {
        //
       //if(!$request->ajax()) return redirect('/');

       $buscar = $request->buscar;
       $criterio = $request->criterio;

       if ($buscar==''){
  

        $solicitudfactibilidades=Solicitudfactibilidad::join('ejecutores','solicitudfactibilidades.idejecutor','=','ejecutores.id')
        ->join('personas','solicitudfactibilidades.idpersona','=','personas.id')
        ->join('tipoobra','solicitudfactibilidades.idtipoobra','=','tipoobra.id')
        ->join('estadofactibilidades','solicitudfactibilidades.idestadofactibilidad','=','estadofactibilidades.id')
        ->select('personas.nombre as nombre_persona','tipoobra.nombre as nombre_tipoobra','estadofactibilidades.nombre as nombre_estadofactibilidad',
        'ejecutores.nombre as nombre_ejecutor','solicitudfactibilidades.direccionobra','solicitudfactibilidades.codigoinmueble',
        'solicitudfactibilidades.noexpediente','solicitudfactibilidades.noexpedienteinterno','solicitudfactibilidades.nofinca',
        'solicitudfactibilidades.nofolio',
        'solicitudfactibilidades.libro','solicitudfactibilidades.nocatastral','solicitudfactibilidades.solvenciamunicipal',
        'solicitudfactibilidades.observacion','solicitudfactibilidades.longitud','solicitudfactibilidades.ancho',
        'solicitudfactibilidades.profundidad',
        'solicitudfactibilidades.diametrotubo','solicitudfactibilidades.diametrocolector',
        'solicitudfactibilidades.idejecutor','solicitudfactibilidades.idpersona',
        'solicitudfactibilidades.idtipoobra','solicitudfactibilidades.idestadofactibilidad')
        ->orderBy('solicitudfactibilidades.id','desc')->paginate(3);
        }
        else{
            $solicitudfactibilidades=Solicitudfactibilidad::join('ejecutores','solicitudfactibilidades.idejecutor','=','ejecutores.id')
            ->join('personas','solicitudfactibilidades.idpersona','=','personas.id')
            ->join('tipoobra','solicitudfactibilidades.idtipoobra','=','tipoobra.id')
            ->join('estadofactibilidades','solicitudfactibilidades.idestadofactibilidad','=','estadofactibilidades.id')
            ->select('personas.nombre as nombre_persona','tipoobra.nombre as nombre_tipoobra','estadofactibilidades.nombre as nombre_estadofactibilidad',
            'ejecutores.nombre as nombre_ejecutor','solicitudfactibilidades.direccionobra','solicitudfactibilidades.codigoinmueble',
            'solicitudfactibilidades.noexpediente','solicitudfactibilidades.noexpedienteinterno','solicitudfactibilidades.nofinca',
            'solicitudfactibilidades.nofolio',
            'solicitudfactibilidades.libro','solicitudfactibilidades.nocatastral','solicitudfactibilidades.solvenciamunicipal',
            'solicitudfactibilidades.observacion','solicitudfactibilidades.longitud','solicitudfactibilidades.ancho',
            'solicitudfactibilidades.profundidad',
            'solicitudfactibilidades.diametrotubo','solicitudfactibilidades.diametrocolector',
            'solicitudfactibilidades.idejecutor','solicitudfactibilidades.idpersona',
            'solicitudfactibilidades.idtipoobra','solicitudfactibilidades.idestadofactibilidad')
            ->where('solicitudfactibilidades.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('solicitudfactibilidades.id','desc')->paginate(3);

           /* $ejecutores = Ejecutor::join('cargoejecutores','ejecutores.idcargoejecutor','=','cargoejecutores.id')
            ->select('ejecutores.id','ejecutores.idcargoejecutor','ejecutores.nombre','ejecutores.direccion','cargoejecutores.nombre as nombre_cargoejecutor','ejecutores.estado')
            ->where('ejecutores.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('ejecutores.id', 'desc')->paginate(3);*/

            //$ejecutores = Ejecutor::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'desc')->paginate(3);
        }
       //$ejecutores=Ejecutor::paginate(2);
        //return $ejecutores;
        return [
            'pagination' => [
                'total'        => $solicitudfactibilidades->total(),
                'current_page' => $solicitudfactibilidades->currentPage(),
                'per_page'     => $solicitudfactibilidades->perPage(),
                'last_page'    => $solicitudfactibilidades->lastPage(),
                'from'         => $solicitudfactibilidades->firstItem(),
                'to'           => $solicitudfactibilidades->lastItem(),
            ],
            'solicitudfactibilidades' => $solicitudfactibilidades
        ];
    }

    

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $solicitudfactibilidad=new Solicitudfactibilidad();
        $solicitudfactibilidad->direccionobra=$request->direccionobra;
        $solicitudfactibilidad->codigoinmueble=$request->codigoinmueble;
        $solicitudfactibilidad->noexpediente=$request->noexpediente;
        $solicitudfactibilidad->noexpedienteinterno=$request->noexpedienteinterno;
        $solicitudfactibilidad->nofinca=$request->nofinca;
        $solicitudfactibilidad->nofolio=$request->nofolio;
        $solicitudfactibilidad->libro=$request->libro;
        $solicitudfactibilidad->nocatastral=$request->nocatastral;
        $solicitudfactibilidad->solvenciamunicipal=$request->solvenciamunicipal;
        $solicitudfactibilidad->observacion=$request->observacion;
        $solicitudfactibilidad->longitud=$request->longitud;
        $solicitudfactibilidad->ancho=$request->ancho;
        $solicitudfactibilidad->profundidad=$request->profundidad;
        $solicitudfactibilidad->diametrotubo=$request->diametrotubo;
        $solicitudfactibilidad->diametrocolector=$request->diametrocolector;
        $solicitudfactibilidad->idtipoobra=$request->idtipoobra;
        $solicitudfactibilidad->idejecutor=$request->idejecutor;
        $solicitudfactibilidad->idpersona=$request->idpersona;
        $solicitudfactibilidad->idestadofactibilidad=$request->idestadofactibilidad;
        $solicitudfactibilidad->save();
    }


    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $solicitudfactibilidad=Solicitudfactibilidad::findOrFail($request->id);
        $solicitudfactibilidad->direccionobra=$request->direccionobra;
        $solicitudfactibilidad->codigoinmueble=$request->codigoinmueble;
        $solicitudfactibilidad->noexpediente=$request->noexpediente;
        $solicitudfactibilidad->noexpedienteinterno=$request->noexpedienteinterno;
        $solicitudfactibilidad->nofinca=$request->nofinca;
        $solicitudfactibilidad->nofolio=$request->nofolio;
        $solicitudfactibilidad->libro=$request->libro;
        $solicitudfactibilidad->nocatastral=$request->nocatastral;
        $solicitudfactibilidad->solvenciamunicipal=$request->solvenciamunicipal;
        $solicitudfactibilidad->observacion=$request->observacion;
        $solicitudfactibilidad->longitud=$request->longitud;
        $solicitudfactibilidad->ancho=$request->ancho;
        $solicitudfactibilidad->profundidad=$request->profundidad;
        $solicitudfactibilidad->diametrotubo=$request->diametrotubo;
        $solicitudfactibilidad->diametrocolector=$request->diametrocolector;
        $solicitudfactibilidad->idtipoobra=$request->idtipoobra;
        $solicitudfactibilidad->idejecutor=$request->idejecutor;
        $solicitudfactibilidad->idpersona=$request->idpersona;
        $solicitudfactibilidad->idestadofactibilidad=$request->idestadofactibilidad;
        $solicitudfactibilidad->save();
    }
}
