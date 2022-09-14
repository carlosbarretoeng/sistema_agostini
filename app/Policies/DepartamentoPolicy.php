<?php

namespace App\Policies;

use App\Models\Departamento;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class DepartamentoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Departamento $departamento
     * @return Response|bool
     */
    public function view(User $user, Departamento $departamento)
    {
        // dd($user, $departamento);
        return true; // $user->empresas()->id === $departamento->empresas()->id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Departamento $departamento
     * @return Response|bool
     */
    public function update(User $user, Departamento $departamento)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Departamento $departamento
     * @return Response|bool
     */
    public function delete(User $user, Departamento $departamento)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Departamento $departamento
     * @return Response|bool
     */
    public function restore(User $user, Departamento $departamento)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Departamento $departamento
     * @return Response|bool
     */
    public function forceDelete(User $user, Departamento $departamento)
    {
        //
    }
}
