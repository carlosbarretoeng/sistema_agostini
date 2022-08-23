<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Setor;
use App\Models\Team;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class EmpresaController extends Controller
{
    public function index(): Response
    {
        $empresas = Empresa::all();
        return Inertia::render(
            'Empresa/Index',
            [
                'empresas' => $empresas
            ]
        );
    }

    public function create(): Response
    {
        $empresa = new Empresa();
        $canSave = true;
        return Inertia::render('Empresa/Edit', compact('empresa', 'canSave'));
    }

    public function store(Request $request): RedirectResponse
    {
        $dados = $request->all();

        $team = new Team();
        $team->user_id = 1;
        $team->name = "team_" . str_replace(array('.','-','/', ' '),'',$dados['cnpj']);
        $team->personal_team = false;
        $team->save();

        $empresa = new Empresa();
        $empresa->team_id = $team->id;
        $empresa->cnpj = str_replace(array('.','-','/', ' '),'',$dados['cnpj']);
        $empresa->logo = $dados['logo'];
        $empresa->razao_social = $dados['razao_social'];
        $empresa->nome_fantasia = $dados['nome_fantasia'];
        $empresa->cep = str_replace(array('.','-','/', ' '), '', $dados['cep']);
        $empresa->logradouro = $dados['logradouro'];
        $empresa->numero = $dados['numero'];
        $empresa->complemento = $dados['complemento'];
        $empresa->bairro = $dados['bairro'];
        $empresa->cidade = $dados['cidade'];
        $empresa->uf = $dados['uf'];
        $empresa->email = $dados['email'];
        $empresa->telefone = str_replace(array('.','-','/', '(', ')', ' '), '', $dados['telefone']);
        $empresa->save();
        return redirect()->route('empresa.index');
    }

    public function show(Empresa $empresa): Response
    {
        $canSave = false;
        $setores = Setor::where('empresa_id', $empresa->id)->get();
        return Inertia::render('Empresa/Edit', compact('empresa', 'canSave', 'setores'));
    }

    public function edit(Empresa $empresa): Response
    {
        $canSave = true;
        return Inertia::render('Empresa/Edit', compact('empresa', 'canSave'));
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id): RedirectResponse
    {
        Empresa::destroy($id);
        return redirect()->route('empresa.index');
    }
}
