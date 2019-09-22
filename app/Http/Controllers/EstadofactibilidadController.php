<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estadofactibilidad;

class EstadofactibilidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar == ''){
            $estadofactibilidades = Estadofactibilidad::orderby('id', 'desc')->paginate(5);
        }
        else{
            $estadofactibilidades = Estadofactibilidad::where($criterio, 'like', '%'. $buscar . '%')->orderby('id', 'desc')->paginate(5);
        }

        return [
            'pagination' => [
                'total'         => $estadofactibilidades->total(),
                'current_page'  => $estadofactibilidades->currentPage(),
                'per_page'      => $estadofactibilidades->perPage(),
                'last_page'     => $estadofactibilidades->lastPage(),
                'from'          => $estadofactibilidades->firstItem(),
                'to'            => $estadofactibilidades->lastItem(),
            ],
            'estadofactibilidades' => $estadofactibilidades
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $estadofactibilidades = new Estadofactibilidad();
        $estadofactibilidades->nombre = $request->nombre;
        $estadofactibilidades->estado = '1';
        $estadofactibilidades->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        if (!$request->ajax()) return redirect('/');
        $estadofactibilidades = Estadofactibilidad::findOrFail($request->id);
        $estadofactibilidades->nombre = $request->nombre;
        $estadofactibilidades->estado = '1';
        $estadofactibilidades->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $estadofactibilidades = Estadofactibilidad::findOrFail($request->id);
        $estadofactibilidades->estado = '0';
        $estadofactibilidades->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $estadofactibilidades = Estadofactibilidad::findOrFail($request->id);
        $estadofactibilidades->estado = '1';
        $estadofactibilidades->save();
    }
}
