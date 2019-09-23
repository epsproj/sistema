<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Ejecutor;
use Illuminate\Support\Facades\DB;

class EjecutorController extends Controller
{
    public function index(Request $request)
    {
        //
       //if(!$request->ajax()) return redirect('/');

       $buscar = $request->buscar;
       $criterio = $request->criterio;

       if ($buscar==''){
         $ejecutores = Ejecutor::join('cargoejecutores','ejecutores.idcargoejecutor','=','cargoejecutores.id')
         ->select('ejecutores.id','ejecutores.idcargoejecutor','ejecutores.nombre','ejecutores.direccion','cargoejecutores.nombre as nombre_cargoejecutor','ejecutores.estado')
         ->orderBy('ejecutores.id', 'desc')->paginate(3);
        }
        else{
            $ejecutores = Ejecutor::join('cargoejecutores','ejecutores.idcargoejecutor','=','cargoejecutores.id')
            ->select('ejecutores.id','ejecutores.idcargoejecutor','ejecutores.nombre','ejecutores.direccion','cargoejecutores.nombre as nombre_cargoejecutor','ejecutores.estado')
            ->where('ejecutores.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('ejecutores.id', 'desc')->paginate(3);

            //$ejecutores = Ejecutor::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'desc')->paginate(3);
        }
       //$ejecutores=Ejecutor::paginate(2);
        //return $ejecutores;
        return [
            'pagination' => [
                'total'        => $ejecutores->total(),
                'current_page' => $ejecutores->currentPage(),
                'per_page'     => $ejecutores->perPage(),
                'last_page'    => $ejecutores->lastPage(),
                'from'         => $ejecutores->firstItem(),
                'to'           => $ejecutores->lastItem(),
            ],
            'ejecutores' => $ejecutores
        ];
    }

    public function selectEjecutor(Request $request){
        if(!$request->ajax()) return redirect('/');
        $ejecutores=Ejecutor::where('estado','=','1')
        ->select('id','nombre')->orderBy('nombre','asc')->get();

        return ['ejecutores'=> $ejecutores];
    }


    public function store(Request $request)
    {
        if(!$request->ajax()) return redirect('/');

        $ejecutor=new Ejecutor();
        $ejecutor->idcargoejecutor=$request->idcargoejecutor;
        $ejecutor->nombre=$request->nombre;
        $ejecutor->direccion=$request->direccion;
        $ejecutor->estado='1';
        $ejecutor->save();
    }

    public function update(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $ejecutor=Ejecutor::findOrFail($request->id);
        $ejecutor->idcargoejecutor=$request->idcargoejecutor;
        $ejecutor->nombre=$request->nombre;
        $ejecutor->direccion=$request->direccion;
        $ejecutor->estado='1';
        $ejecutor->save();
    }

    public function desactivar(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $ejecutor=Ejecutor::findOrFail($request->id);
        $ejecutor->estado='0';
        $ejecutor->save();
    }

    public function activar(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $ejecutor=Ejecutor::findOrFail($request->id);
        $ejecutor->estado='1';
        $ejecutor->save();
    }
}
