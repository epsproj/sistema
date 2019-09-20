<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tipoobra;

class TipoobraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
        $tipoobras = Tipoobra::paginate(5);
        return [
            'pagination' => [
                'total'         => $tipoobras->total(),
                'current_page'  => $tipoobras->currentPage(),
                'per_page'      => $tipoobras->perPage(),
                'last_page'     => $tipoobras->lastPage(),
                'from'          => $tipoobras->firstItem(),
                'to'            => $tipoobras->lastItem(),
            ],
            'tipoobras' => $tipoobras
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
        $tipoobra = new Tipoobra();
        $tipoobra->nombre = $request->nombre;
        $tipoobra->estado = '1';
        $tipoobra->save();
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
        $tipoobra = Tipoobra::findOrFail($request->id);
        $tipoobra->nombre = $request->nombre;
        $tipoobra->estado = '1';
        $tipoobra->save();
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
        $tipoobra = Tipoobra::findOrFail($request->id);
        $tipoobra->estado = '0';
        $tipoobra->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $tipoobra = Tipoobra::findOrFail($request->id);
        $tipoobra->estado = '1';
        $tipoobra->save();
    }
    
}
