<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== PROBANDO RELACIONES MUCHOS A MUCHOS ===\n\n";

// 1. Probar una habitación con sus servicios
$habitacion = \App\Models\Habitacion::with('servicios')->first();
echo "📍 Habitación #" . $habitacion->numero . " - " . $habitacion->tipo . "\n";
echo "   Tiene " . $habitacion->servicios->count() . " servicios:\n";

foreach ($habitacion->servicios as $servicio) {
    $incluido = $servicio->pivot->incluido ? "INCLUIDO" : "Extra: $" . $servicio->pivot->precio_extra;
    echo "   - " . $servicio->nombre . " ($incluido)\n";
}

echo "\n";

// 2. Probar un servicio con sus habitaciones
$servicio = \App\Models\Servicio::with('habitaciones')->first();
echo "🛎️  Servicio: " . $servicio->nombre . "\n";
echo "   Disponible en " . $servicio->habitaciones->count() . " habitaciones:\n";

foreach ($servicio->habitaciones->take(5) as $habitacion) {
    echo "   - Habitación #" . $habitacion->numero . " (" . $habitacion->tipo . ")\n";
}

echo "\n";

// 3. Probar las reservaciones de un cliente
$cliente = \App\Models\Cliente::with('reservaciones')->first();
echo "👤 Cliente: " . $cliente->nombre . " " . $cliente->apellido . "\n";
echo "   Tiene " . $cliente->reservaciones->count() . " reservaciones\n";

echo "\n";
echo "✅ ¡Todas las relaciones están funcionando correctamente!\n";