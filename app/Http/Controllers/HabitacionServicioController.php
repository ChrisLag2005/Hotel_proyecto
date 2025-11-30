<?php

namespace App\Http\Controllers;

use App\Models\Habitacion;
use App\Models\Servicio;
use Illuminate\Http\Request;

class HabitacionServicioController extends Controller
{
    public function index()
    {
        $habitaciones = Habitacion::with('servicios')
        ->orderBy('numero')
        ->get();
        return view('habitaciones-servicios.index', compact('habitaciones'));
    }
    public function edit(Habitacion $habitacion)
{
    $servicios = Servicio::all(); 
    $serviciosHabitacion = $habitacion->servicios->pluck('id')->toArray();
    
    return view('habitaciones-servicios.edit', compact('habitacion', 'servicios', 'serviciosHabitacion'));
}


    public function update(Request $request, Habitacion $habitacion)
    {
        $request->validate([
            'servicios' => 'nullable|array',
            'servicios.*' => 'exists:servicios,id'
        ]);


        $serviciosData = [];
        if ($request->has('servicios')) {
            foreach ($request->servicios as $servicioId) {
                $serviciosData[$servicioId] = [
                    'incluido' => $request->input("incluido_{$servicioId}", false),
                    'precio_extra' => $request->input("precio_extra_{$servicioId}", 0)
                ];
            }
        }

        $habitacion->servicios()->sync($serviciosData);

        return redirect()->route('habitaciones-servicios.index')
                         ->with('success', 'Servicios actualizados correctamente');
    }
}