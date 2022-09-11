<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

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
        $data = User::with('roles')->find($id)->get();
        return Inertia::render('Usuarios/Show', [
            'data' => $data
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
