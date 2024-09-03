<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Validator;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produto = Produto::all();

        return response()->json([
            'status' => true,
            'produtos' => $produto
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
        $produto = Produto::create($request->all());

        return response()->json([
            'status' => true,
            'message' => "Produto Criado com sucesso!",
            'produtos' => $produto
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $produto = Produto::find($id);

        if (!$produto){
            return response ()->json(['message'=>'Produto não encontrado'], 404);

        }

        return response ()->json([
            'status'=> true,
            'produto'=>$produto
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produto $produto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $produto = Produto::find($id);
        if (!$produto){
            return response ()->json(['message'=>'Produto não encontrado'], 404);

        }
        
        $validator = Validator ::make($request->all(),[
            'nome'=>'string |max:255',
            'descricao'=>'string |max:255',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()],422);
        }
        $produto->update($request->all());

        return response()->json([
            'status'=> true,
            'message'=>'Produto atualizado com sucesso',
            'produtos'=> $produto

        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $produto = Produto::find($id);
        if (!$produto) {
            return response()->json(['message'=>'Produto não encontrado'], 404);

        }
        $produto->delete();
        return response()->json(['message'=> "Produto excluido"],200);
    }
}
