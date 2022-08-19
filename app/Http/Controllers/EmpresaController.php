<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $empresas = Empresa::all();
        return Inertia::render(
            'Empresa/Index',
            [
                'empresas' => $empresas
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $empresa = new Empresa();
        $podeAdicionar = true;
        return Inertia::render('Empresa/Edit', compact('empresa', 'podeAdicionar'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $dados = $request->all();
        $empresa = new Empresa();
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Empresa $empresa)
    {
        return Inertia::render('Empresa/Edit', compact('empresa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        Empresa::destroy($id);
        return redirect()->route('empresa.index');
    }
}
