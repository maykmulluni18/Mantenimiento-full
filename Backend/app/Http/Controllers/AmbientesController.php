<?php

namespace App\Http\Controllers;

use App\Models\Ambientes;
use Illuminate\Http\Request;

class AmbientesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Ambientes::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre_ambiente' => 'required'
        ]);

        return Ambientes::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try{

        }catch(error){

        }
        $ambiente = Ambientes::find($id);
        if (!$ambiente) {
            return response()->json(['message' => 'Ambiente no encontrado'], 404);
        }
        return response()->json($ambiente, 200);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ambientes $ambientes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_ambiente' => 'required'
        ]);

        $ambiente = Ambientes::findOrFail($id);

        $ambiente->update($request->all());

        return $ambiente;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ambiente = Ambientes::find($id);

        if (!$ambiente) {
            return response()->json(['error' => 'Ambiente no encontrado'], 404);
        }

        $ambiente->delete();

        return response()->json(['message' => 'Ambiente eliminado correctamente'],200);
    }
}
