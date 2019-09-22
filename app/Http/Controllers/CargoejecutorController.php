<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CargoejecutorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        if(!$request->ajax()) return redirect('/');
        $cargoejecutor=new Cargoejecutor();
        $cargoejecutor->nombre=$request->nombre;
        $cargoejecutor->estado='1';
        $cargoejecutor->save();
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
        
        if(!$request->ajax()) return redirect('/');
        $cargoejecutor=Cargoejecutor::findOrFail($request->id);
        $cargoejecutor->nombre=$request->nombre;
        $cargoejecutor->estado='1';
        $cargoejecutor->save();
    }

    public function desactivar(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $cargoejecutor=Cargoejecutor::findOrFail($request->id);
        $cargoejecutor->estado='0';
        $cargoejecutor->save();
    }

    public function activar(Request $request)
    {
        if(!$request->ajax()) return redirect('/');
        $cargoejecutor=Cargoejecutor::findOrFail($request->id);
        $cargoejecutor->estado='1';
        $cargoejecutor->save();
    }
}
