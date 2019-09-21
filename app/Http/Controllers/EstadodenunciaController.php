<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estadodenuncia;

class EstadodenunciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estadodenuncias = Estadodenuncia::all();
        return $estadodenuncias;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $estadodenuncia = new  Estadodenuncia();
        $estadodenuncia->nombre = $request->nombre;
        $estadodenuncia->descripcion = $request->descripcion;
        $estadodenuncia->condicion = '1';
        $estadodenuncia->save();
    }

    public function update(Request $request)
    {
        $estadodenuncia =  Estadodenuncia::findOrFail($request->id);
        $estadodenuncia->nombre = $request->nombre;
        $estadodenuncia->descripcion = $request->descripcion;
        $estadodenuncia->condicion = '1';
        $estadodenuncia->save();
    }

    public function desactivar(Request $request)
    {
        $estadodenuncia =  Estadodenuncia::findOrFail($request->id);
        $estadodenuncia->condicion = '0';
        $estadodenuncia->save();
    }
    public function activar(Request $request)
    {
        $estadodenuncia =  Estadodenuncia::findOrFail($request->id);
        $estadodenuncia->condicion = '1';
        $estadodenuncia->save();
    }

}
