<?php

namespace App\Http\Controllers;

use App\Models\Habitacion;
use App\Models\Servicio;
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
        // Listar servicios para checkboxes
        $servicios = Servicio::all();
        return view('habitaciones.create', compact('servicios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'numero' => 'required|unique:habitaciones',
            'tipo' => 'required',
            'descripcion' => 'nullable',
            'precio' => 'required|numeric',
            'capacidad' => 'required|integer',
            'estado' => 'required',
            'archivo' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',

            // Validación RELACIÓN M:M
            'servicios' => 'nullable|array',
            'servicios.*' => 'integer|exists:servicios,id',
        ]);

        $rutaArchivo = null;

        if ($request->hasFile('archivo')) {
            $rutaArchivo = $request->file('archivo')->store('habitaciones', 'public');
        }

        $habitacion = Habitacion::create([
            'numero' => $request->numero,
            'tipo' => $request->tipo,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'capacidad' => $request->capacidad,
            'estado' => $request->estado,
            'archivo' => $rutaArchivo
        ]);

        // 🔥 Sincronizar servicios M:M
        if ($request->filled('servicios')) {
            $habitacion->servicios()->sync($request->servicios);
        }

        return redirect()->route('habitaciones.index')
                        ->with('success', 'Habitación creada correctamente.');
    }

    public function edit(Habitacion $habitacione)
    {
        $servicios = Servicio::all();
        return view('habitaciones.edit', [
            'habitacion' => $habitacione,
            'servicios' => $servicios
        ]);
    }

    public function update(Request $request, Habitacion $habitacione)
    {
        $request->validate([
            'numero' => 'required|unique:habitaciones,numero,' . $habitacione->id,
            'tipo' => 'required',
            'descripcion' => 'nullable',
            'precio' => 'required|numeric',
            'capacidad' => 'required|integer',
            'estado' => 'required',
            'archivo' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',

            // Validación RELACIÓN M:M
            'servicios' => 'nullable|array',
            'servicios.*' => 'integer|exists:servicios,id',
        ]);

        if ($request->hasFile('archivo')) {
            if ($habitacione->archivo && Storage::disk('public')->exists($habitacione->archivo)) {
                Storage::disk('public')->delete($habitacione->archivo);
            }

            $habitacione->archivo = $request->file('archivo')->store('habitaciones', 'public');
        }

        $habitacione->numero = $request->numero;
        $habitacione->tipo = $request->tipo;
        $habitacione->descripcion = $request->descripcion;
        $habitacione->precio = $request->precio;
        $habitacione->capacidad = $request->capacidad;
        $habitacione->estado = $request->estado;
        $habitacione->save();

        // 🔥 Actualizar relación M:M
        $habitacione->servicios()->sync($request->input('servicios', []));

        return redirect()->route('habitaciones.index')
                        ->with('success', 'Habitación actualizada correctamente.');
    }

    public function catalogo()
    {
        $habitaciones = Habitacion::with('servicios')->get();
        return view('habitaciones.catalogo', compact('habitaciones'));
    }

    public function mostrar($id)
    {
        $habitacion = Habitacion::with('servicios')->findOrFail($id);
        return view('habitaciones.mostrar', compact('habitacion'));
    }

    public function destroy(Habitacion $habitacione)
    {
        if ($habitacione->archivo && Storage::disk('public')->exists($habitacione->archivo)) {
            Storage::disk('public')->delete($habitacione->archivo);
        }

        // 🔥 Borrar relaciones en la tabla pivot
        $habitacione->servicios()->detach();

        $habitacione->delete();

        return redirect()->route('habitaciones.index')
                        ->with('success', 'Habitación eliminada.');
    }
}
