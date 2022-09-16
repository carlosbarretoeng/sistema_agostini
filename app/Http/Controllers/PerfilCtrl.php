<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PerfilCtrl extends Controller
{
    public function index()
    {
        $data = Role::all();
        return Inertia::render('Perfil/Index', [
            'data' => $data
        ]);
    }

    public function create()
    {
        $data = Permission::all();
        return Inertia::render('Perfil/Create', [
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        /*$data = User::find($id);
        $data->empresas;
        $data->syncPermissions = array_merge($data->permissions->toArray(), $data->getAllPermissions()->toArray());


        $roles = Role::with('permissions')->get(['name', 'description']);
        $permissions = Permission::all(['name', 'description']);
        return Inertia::render('Usuarios/Show', [
            'data' => $data,
            'roles' => $roles,
            'permissions' => $permissions,
        ]);*/

        $perfil = Role::with('permissions')->find($id);
        $permissoes = Permission::all();
        return Inertia::render('Perfil/Show', [
            'perfil' => $perfil,
            'permissoes' => $permissoes
        ]);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
