<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Talla;

class TallaController extends Controller
{
    public function index()
    {
        $tallas = Talla::all();
        return view('admin.tallas.index', compact('tallas'));
    }

    public function create()
    {
        return view('admin.tallas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'etiqueta' => 'required|string|max:20|unique:tallas,etiqueta',
        ]);

        Talla::create([
            'etiqueta' => $request->etiqueta,
        ]);

        return redirect()->route('admin.tallas.index')->with('success', 'Talla creada correctamente.');
    }

    public function edit(Talla $talla)
    {
        return view('admin.tallas.edit', compact('talla'));
    }

    public function update(Request $request, Talla $talla)
    {
        $request->validate([
            'etiqueta' => 'required|string|max:20|unique:tallas,etiqueta,' . $talla->id,
        ]);

        $talla->update([
            'etiqueta' => $request->etiqueta,
        ]);

        return redirect()->route('admin.tallas.index')->with('success', 'Talla actualizada correctamente.');
    }

    public function destroy(Talla $talla)
    {
        $talla->delete();
        return redirect()->route('admin.tallas.index')->with('success', 'Talla eliminada.');
    }
}
