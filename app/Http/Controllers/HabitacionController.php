<?php

namespace App\Http\Controllers;

use App\Models\Habitacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'numero' => 'required|unique:habitaciones',
            'tipo' => 'required',
            'capacidad' => 'required|integer|min:1',
            'precio' => 'required|numeric|min:0',
            'estado' => 'required',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();
        

        if ($request->hasFile('imagen')) {
            $imagenPath = $request->file('imagen')->store('habitaciones', 'public');
            $data['imagen'] = $imagenPath;
            $data['imagen_original'] = $request->file('imagen')->getClientOriginalName();
        }

        Habitacion::create($data);

        return redirect()->route('habitaciones.index')
                       ->with('success', 'Habitación creada exitosamente.');
    }

    public function show(Habitacion $habitacion)
    {
        return view('habitaciones.show', compact('habitacion'));
    }

    public function edit(Habitacion $habitacion)
    {
        return view('habitaciones.edit', compact('habitacion'));
    }

    public function update(Request $request, Habitacion $habitacion)
    {
        $request->validate([
            'numero' => 'required|unique:habitaciones,numero,' . $habitacion->id,
            'tipo' => 'required',
            'capacidad' => 'required|integer|min:1',
            'precio' => 'required|numeric|min:0',
            'estado' => 'required',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();
        

        if ($request->hasFile('imagen')) {
            if ($habitacion->imagen && Storage::disk('public')->exists($habitacion->imagen)) {
                Storage::disk('public')->delete($habitacion->imagen);
            }
            
            $imagenPath = $request->file('imagen')->store('habitaciones', 'public');
            $data['imagen'] = $imagenPath;
            $data['imagen_original'] = $request->file('imagen')->getClientOriginalName();
        } else {
            $data['imagen'] = $habitacion->imagen;
            $data['imagen_original'] = $habitacion->imagen_original;
        }

        $habitacion->update($data);

        return redirect()->route('habitaciones.index')
                       ->with('success', 'Habitación actualizada exitosamente.');
    }

    public function destroy(Habitacion $habitacion)
    {
        if ($habitacion->imagen && Storage::disk('public')->exists($habitacion->imagen)) {
            Storage::disk('public')->delete($habitacion->imagen);
        }

        $habitacion->delete();

        return redirect()->route('habitaciones.index')
                       ->with('success', 'Habitación eliminada exitosamente.');
    }
}