<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Habitacion;
use App\Models\Reservacion;
use App\Policies\HabitacionPolicy;
use App\Policies\ReservacionPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Mapas de modelos a policies
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Habitacion::class => HabitacionPolicy::class,
        Reservacion::class => ReservacionPolicy::class,
    ];

    /**
     * Registra servicios de autorización
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
