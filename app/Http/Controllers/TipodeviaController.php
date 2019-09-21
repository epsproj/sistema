<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tipodevia;

class TipodeviaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipodevia = Tipodevia::all();
        return $tipodevia;
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
        $tipodevia = new Tipodevia();
        $tipodevia->nombre = $request->nombre;
        $tipodevia->descripcion = $request->descripcion;
        $tipodevia->condicion = '1';
        $tipodevia->save();
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
        $tipodevia = Tipodevia::findOrFail($request->id);
        $tipodevia->nombre = $request->nombre;
        $tipodevia->descripcion = $request->descripcion;
        $tipodevia->condicion = '1';
        $tipodevia->save();
        //
    }

    public function desactivar(Request $request)
    {
        $tipodevia = Tipodevia::findOrFail($request->id);
        $tipodevia->condicion = '0';
        $tipodevia->save();
        //
    }

    public function activar(Request $request)
    {
        $tipodevia = Tipodevia::findOrFail($request->id);
        $tipodevia->condicion = '1';
        $tipodevia->save();
        //
    }


}
