<?php

namespace App\Policies;

use App\Models\Reservacion;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ReservacionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // Todos los usuarios autenticados pueden ver la lista
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Reservacion $reservacion): bool
    {
        return $user->id === $reservacion->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true; // Todos los usuarios autenticados pueden crear reservaciones
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Reservacion $reservacion): bool
    {
        return $user->id === $reservacion->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Reservacion $reservacion): bool
    {
        return $user->id === $reservacion->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Reservacion $reservacion): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Reservacion $reservacion): bool
    {
        return false;
    }
}