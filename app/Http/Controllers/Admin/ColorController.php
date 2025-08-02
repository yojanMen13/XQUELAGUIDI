<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Color;
class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $colores = Color::all();
    return view('admin.colores.index', compact('colores'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('admin.colores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validación opcional
    $request->validate([
        'nombre' => 'required|string|max:255',
        'codigo_hex' => 'nullable|string|max:10',
    ]);

    // Guardar en la base de datos
    Color::create([
        'nombre' => $request->nombre,
        'codigo_hex' => $request->codigo_hex,
    ]);

    return redirect()->route('admin.colores.index')->with('success', 'Color creado correctamente.');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
