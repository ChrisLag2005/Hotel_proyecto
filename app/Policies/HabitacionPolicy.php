<?php

namespace App\Policies;

use App\Models\Habitacion;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class HabitacionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // Todos los usuarios autenticados pueden ver habitaciones
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Habitacion $habitacion): bool
    {
        return true; // Todos pueden ver detalles de habitaciones
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Solo administradores pueden crear habitaciones
        return $user->es_admin ?? false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Habitacion $habitacion): bool
    {
        // Solo administradores pueden editar habitaciones
        return $user->es_admin ?? false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Habitacion $habitacion): bool
    {
        // Solo administradores pueden eliminar habitaciones
        return $user->es_admin ?? false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Habitacion $habitacion): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Habitacion $habitacion): bool
    {
        return false;
    }
}