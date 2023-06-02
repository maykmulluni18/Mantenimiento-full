<?php

namespace App\Http\Controllers;

use App\Models\FacultadOficina;
use Illuminate\Http\Request;
use App\Models\Ambientes;

class FacultadOficinaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //return FacultadOficina::all();
        $facultadOficinas = FacultadOficina::with('ambientes')->get();

       /* $data = [
            $facultadOficina,
            $facultadOficina->ambientes,
         ];*/
         return response()->json($facultadOficinas);

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
            'cod_facultadOfi',
            'nombre_facultad_oficina',
            'nombre_escuela'
        ]);

        return FacultadOficina::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
       // $facultadOficina = FacultadOficina::find($id);
       // $data = $facultadOficina->ambientes;
        /*$data = [
            $facultadOficina,
            $facultadOficina->ambientes,
         ];

        return response()->json($data);*/
        $facultadOficina = FacultadOficina::find($id);
        if (!$facultadOficina) {
            return response()->json(['message' => 'No encontrado'], 404);
        }
        $data = [
            $facultadOficina,
            $facultadOficina->ambientes,
         ];

        return response()->json($data[0]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FacultadOficina $facultadOficina)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'cod_facultadOfi',
            'nombre_facultad_oficina',
            'nombre_escuela',
            'ambientes_id'
        ]);

        $faculamb = FacultadOficina::findOrFail($id);
        $faculamb->update($request->all());

        return response()->json($faculamb);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $faculamb = FacultadOficina::find($id);
        if(!$faculamb){
            return response()->json(['error' => 'Ambiente no encontrado'], 404);
        }
        $faculamb->delete();

        return response()->json(['message' => 'Ambiente eliminado correctamente'], 200);
    }
}
