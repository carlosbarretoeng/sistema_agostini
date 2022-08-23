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
        $readOnly = false;
        return Inertia::render('Empresa/Create', compact('empresa', 'readOnly'));
    }

    public function store(Request $request): RedirectResponse
    {
        $attr = $request->all();

        $team = new Team();
        $team->user_id = 1;
        $team->name = "team_" . str_replace(array('.','-','/', ' '),'',$attr['cnpj']);
        $team->personal_team = false;
        $team->save();

        $empresa = new Empresa();
        $empresa->team_id = $team->id;
        $empresa->cnpj = str_replace(array('.','-','/', ' '),'',$attr['cnpj']);
        $empresa->logo = $attr['logo'];
        $empresa->razao_social = $attr['razao_social'];
        $empresa->nome_fantasia = $attr['nome_fantasia'];
        $empresa->cep = str_replace(array('.','-','/', ' '), '', $attr['cep']);
        $empresa->logradouro = $attr['logradouro'];
        $empresa->numero = $attr['numero'];
        $empresa->complemento = $attr['complemento'];
        $empresa->bairro = $attr['bairro'];
        $empresa->cidade = $attr['cidade'];
        $empresa->uf = $attr['uf'];
        $empresa->email = $attr['email'];
        $empresa->telefone = str_replace(array('.','-','/', '(', ')', ' '), '', $attr['telefone']);
        $empresa->save();
        return redirect()->route('empresa.index');
    }

    public function show(Empresa $empresa): Response
    {
        $readOnly = true;
        return Inertia::render('Empresa/Show', compact('empresa', 'readOnly'));
    }

    public function edit(Empresa $empresa): Response
    {
        $readOnly = false;
        return Inertia::render('Empresa/Edit', compact('empresa', 'readOnly'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $oldEmpresa = Empresa::find($id);
        $attrs = $request->all();
        $toReplace = array('.','-','/', '(', ')', ' ');
        if($oldEmpresa) {
            foreach (array_keys($attrs) as $k){
                if(str_replace($toReplace, '', $oldEmpresa[$k]) !== str_replace($toReplace, '', $attrs[$k])){
                    $oldEmpresa[$k] = $attrs[$k];
                }
            }
            $oldEmpresa->save();
        }
        return redirect()->route('empresa.index');
    }

    public function destroy($id): RedirectResponse
    {
        Empresa::destroy($id);
        return redirect()->route('empresa.index');
    }
}
