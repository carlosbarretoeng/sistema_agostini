<?php

namespace App\Http\Controllers;

use App\Models\Colaborador;
use Illuminate\Http\Request;

class ColaboradorController extends Controller
{
    public function index(Request $request)
    {
        $attr = $request->all();
//        $setores = Colaborador::query()
//            ->join('users', 'user_id', '=', 'users.id')
//            ->whereIn('setor_id', $attr['setor_ids'])->get(['colaboradores.*', 'users.*']);
        $colaboradores = Colaborador::all();
        dd($colaboradores);
        return response()->json($colaboradores);
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
        //
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
