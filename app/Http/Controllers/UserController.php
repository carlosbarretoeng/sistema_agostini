<?php

namespace App\Http\Controllers;

use App\Models\Permissao;
use App\Models\User as UserModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{

    public function __construct()
    {
        parent::__construct('Usuários', 'usuario', UserModel::class);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->merge([
            'password' => Hash::make($request->input('password'))
        ]);
        return parent::store($request);
    }

    public function edit($id): Response
    {
        $data = parent::obterShowOrEditData($id, 'edit');
        $data['permissoesDisponiveis'] = Permissao::all();
        return Inertia::render('User/Edit', $data);
    }
}
