<?php

namespace App\Http\Controllers;

use App\Models\Habitacion;
use Illuminate\Http\Request;

class HabitacionController extends Controller
{
    public function index()
    {
        $habitaciones = Habitacion::all();
        return view('habitaciones.index', compact('habitaciones'));
    }

    public function create()
    {
        return view('habitaciones.create');
    }

    public function store(Request $request)
{
    
    $request->validate([
        'tipo' => 'required|string|max:255',
        'descripcion' => 'nullable|string',
        'precio' => 'required|numeric|min:0',
        'capacidad' => 'required|integer|min:1'
    ]);
    
    
    $ultimoNumero = \App\Models\Habitacion::max('numero') ?? 0;
    $nuevoNumero = $ultimoNumero + 1;
    
    
    $habitacion = \App\Models\Habitacion::create([
        'numero' => $nuevoNumero, 
        'tipo' => $request->tipo,
        'descripcion' => $request->descripcion,
        'precio' => $request->precio,
        'capacidad' => $request->capacidad,
        'estado' => 'disponible' 
    ]);
    
    return redirect()->route('habitaciones.index')
                     ->with('success', "Habitación {$nuevoNumero} creada correctamente");
}

    public function edit(Habitacion $habitacione)
    {
        return view('habitaciones.edit', ['habitacion' => $habitacione]);
    }

    public function update(Request $request, Habitacion $habitacione)
    {
        $request->validate([
            'numero' => 'required',
            'tipo' => 'required',
            'precio' => 'required|numeric',
            'capacidad' => 'required|integer',
            'estado' => 'required'
        ]);

        $habitacione->update($request->all());

        return redirect()->route('habitaciones.index')
                        ->with('success', 'Habitación actualizada correctamente.');
    }

    public function destroy(Habitacion $habitacione)
    {
        $habitacione->delete();
        return redirect()->route('habitaciones.index')
                        ->with('success', 'Habitación eliminada.');
    }
}
