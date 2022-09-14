<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsuariosCtrl extends Controller
{
    public function index()
    {
        $data = User::with('roles')->get();
        return Inertia::render('Usuarios/Index', [
            'data' => $data
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $data = User::find($id);
        $data->empresas;
        $data->syncPermissions = array_merge($data->permissions->toArray(), $data->getAllPermissions()->toArray());


        $roles = Role::with('permissions')->get(['name', 'description']);
        $permissions = Permission::all(['name', 'description']);
        return Inertia::render('Usuarios/Show', [
            'data' => $data,
            'roles' => $roles,
            'permissions' => $permissions,
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
