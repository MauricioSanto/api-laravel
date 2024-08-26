<?php

namespace App\Http\Controllers;

use App\Models\OrdemServico;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Validator;

class OrdemServicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ordemservicos = OrdemServico::with('Cliente','Servico','Empresa')->get();

        return response()->json([
            'status' => true,
            'ordemservicos' => $ordemservicos
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
        $ordemservicos = OrdemServico::create($request->all());
      
        return response()->json([
            'status' => true,
            'message' => "Ordem de Serviço Criada com sucesso!",
            'ordemservicos' => $ordemservicos
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $ordemservico = OrdemServico::with('cliente','servico','Empresa')->find($id);
        return response()->json([
            'status'=>True,
            'ordemservico'=>$ordemservico
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrdemServico $ordemServico)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $ordemservicos = OrdemServico::find($id);

        if (!$ordemservicos){
            return response ()->json(['message'=>'Ordem de Serviço não encontrada'], 404);

        }
        
        $Validator = Validator ::make($request->all(),[
            'cliente_id'=>'integer ',
            'servico_id'=>'integer',
            'empresa_id'=>'integer',
            'data'=>'date',
            'data_finalizacao'=>'date',
        
        ]);
        if ($Validator->fails()) {
            return response()->json(['errors'=>$Validator->errors()],422);
        }
        $ordemservicos->update($request->all());

        return response()->json([
            'status'=> true,
            'message'=>'Ordem de Serviço atualizada com sucesso',
            'serviço'=> $ordemservicos

        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ordemservicos = OrdemServico::find($id);
        if (!$ordemservicos) {
            return response()->json(['message'=>'Ordem de Serviço não encontrada'], 404);

        }
        $ordemservicos->delete();
        return response()->json(['message'=> "Ordem de Serviço excluida"],200);
    }
    
}
