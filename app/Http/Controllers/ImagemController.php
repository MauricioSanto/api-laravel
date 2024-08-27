<?php

namespace App\Http\Controllers;

use App\Models\Imagem;
use Illuminate\Http\Request;

class ImagemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /**$imagem = Imagem::all();

        return response()->json([
            'status' => true,
            'imagem' => $imagem
        ]);*/
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $imagem = Imagem::find($id);
        return response()->json(['url'=> $imagem->url]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Imagem $imagem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Imagem $imagem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Imagem $imagem)
    {
        //
    }
}
