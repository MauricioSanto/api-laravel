<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Validator;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $empresas = Empresa::all();

        return response()->json([
            'status' => true,
            'empresas' => $empresas
        ]);
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
        $empresa = Empresa::create($request->all());

        return response()->json([
            'status' => true,
            'message' => "Empresa Criada  com sucesso!",
            'empresa' => $empresa
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $empresa = Empresa::find($id);

        if (!$empresa){
            return response ()->json(['message'=>'Empresa não encontrada'], 404);

        }

        return response ()->json([
            'status'=> true,
            'empresa'=>$empresa
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empresa $empresa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $empresa = Empresa::find($id);

        if (!$empresa){
            return response ()->json(['message'=>'Empresa não encontrada'], 404);

        }
        
        $Validator = Validator ::make($request->all(),[
            'razao_social'=>'string |max:255',
            'cnpj'=>'string',
        ]);
        if ($Validator->fails()) {
            return response()->json(['errors'=>$Validator->errors()],422);
        }
        $empresa->update($request->all());

        return response()->json([
            'status'=> true,
            'message'=>'Empresa atualizada com sucesso',
            'empresa'=> $empresa

        ], 200);
    }

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $empresa = Empresa::find($id);
        if (!$empresa) {
            return response()->json(['message'=>'Empresa não encontrada'], 404);

        }
        $empresa->delete();
        return response()->json(['message'=> "Empresa excluida"],200);
    }
}
