<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Validator;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::all();

        return response()->json([
            'status' => true,
            'clientes' => $clientes
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
        $clientes = Cliente::create($request->all());

        return response()->json([
            'status' => true,
            'message' => "Cliente Cadastrado com sucesso!",
            'cliente' => $clientes
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        $clientes = Cliente::find($id);

        if (!$clientes){
            return response ()->json(['message'=>'Cliente não encontrado'], 404);

        }

        return response ()->json([
            'status'=> true,
            'cliente'=>$clientes
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $clientes = Cliente::find($id);
        if (!$clientes){
            return response ()->json(['message'=>'Cliente não encontrado'], 404);

        }
        
        $validator = Validator ::make($request->all(),[
            'nome'=>'string |max:255',
            'data_nascimento'=>'required|date',
            'foto'=>'string',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()],422);
        }
        $clientes->update($request->all());

        return response()->json([
            'status'=> true,
            'message'=>'Cliente atualizado com sucesso',
            'cliente'=> $clientes

        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id )
    {
        $clientes = Cliente::find($id);
        if (!$clientes) {
            return response()->json(['message'=>'Cliente não encontrado'], 404);

        }
        $clientes->delete();
        return response()->json(['message'=> "Cliente excluido"],200);
    }
}
