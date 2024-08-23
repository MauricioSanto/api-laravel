<?php

namespace App\Http\Controllers;

use App\Models\Servico;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Validator;

class ServicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$servicos = Servico::all();
        $servicos = Servico::with('empresa','categoria')->get();

        return response()->json([
            'status' => true,
            'servicos' => $servicos
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
       $servico = Servico::create($request->all());
      
        return response()->json([
            'status' => true,
            'message' => "Serviço Criado com sucesso!",
            'servico' => $servico
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $servico = Servico::with('empresa','categoria')->find($id);
        return response()->json([
            'status'=>True,
            'servico'=>$servico
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Servico $servico)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $servicos = Servico::find($id);

        if (!$servicos){
            return response ()->json(['message'=>'Serviço não encontrado'], 404);

        }
        
        $Validator = Validator ::make($request->all(),[
            'tipo'=>'string |max:255',
            'valor'=>'numeric',
            'empresa_id'=>'integer',
            'categoria_id'=>'integer',
        ]);
        if ($Validator->fails()) {
            return response()->json(['errors'=>$Validator->errors()],422);
        }
        $servicos->update($request->all());

        return response()->json([
            'status'=> true,
            'message'=>'Serviço atualizado com sucesso',
            'serviço'=> $servicos

        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id )
    {
        $servicos = Servico::find($id);
        if (!$servicos) {
            return response()->json(['message'=>'Serviço não encontrado'], 404);

        }
        $servicos->delete();
        return response()->json(['message'=> "Serviço excluido"],200);
    }
}
