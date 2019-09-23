<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Persona;
use Illuminate\Support\Facades\DB;

class PersonaController extends Controller
{
    public function index(Request $request)
    {
        //
       if(!$request->ajax()) return redirect('/');

       $buscar = $request->buscar;
       $criterio = $request->criterio;

       if ($buscar==''){
        $personas = Persona::orderBy('id', 'desc')->paginate(3);
        }
        else{
            $personas = Persona::where($criterio, 'like', '%'. $buscar . '%')->orderBy('id', 'desc')->paginate(3);
        }
       //$personas=Cargoejecutor::paginate(2);
        //return $personas;
        return [
            'pagination' => [
                'total'        => $personas->total(),
                'current_page' => $personas->currentPage(),
                'per_page'     => $personas->perPage(),
                'last_page'    => $personas->lastPage(),
                'from'         => $personas->firstItem(),
                'to'           => $personas->lastItem(),
            ],
            'personas' => $personas
        ];
    }

    public function selectCargoejecutor(Request $request){
        if(!$request->ajax()) return redirect('/');
        $cargoejecutores=Cargoejecutor::where('estado','=','1')
        ->select('id','nombre')->orderBy('nombre','asc')->get();

        return ['cargoejecutores'=> $cargoejecutores];
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
        $persona=new Persona();
        $persona->nombre=$request->nombre;
        $persona->apellido=$request->apellido;
        $persona->direccion=$request->direccion;
        $persona->telefono=$request->telefono;
        $persona->correo=$request->correo;
        $persona->estado='1';
        $persona->save();
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
        $persona=Persona::findOrFail($request->id);
        $persona->nombre=$request->nombre;
        $persona->apellido=$request->apellido;
        $persona->direccion=$request->direccion;
        $persona->telefono=$request->telefono;
        $persona->correo=$request->correo;
        $persona->estado='1';
        $persona->save();
    }

    public function desactivar(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $persona=Persona::findOrFail($request->id);
        $persona->estado='0';
        $persona->save();
    }

    public function activar(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $persona=Persona::findOrFail($request->id);
        $persona->estado='1';
        $persona->save();
    }

}
