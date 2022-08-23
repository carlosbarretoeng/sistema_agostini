<?php

namespace App\Http\Controllers;

use App\Models\Setor;
use Illuminate\Http\Request;

class SetorController extends Controller
{
    public function index(Request $request)
    {
        $attr = $request->all();
        return Setor::all()->where('empresa_id', '=', $attr['empresa_id']);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $attr = $request->all();

        $setor = new Setor();
        $setor->empresa_id = $attr['empresa_id'];
        $setor->nome = $attr['nome'];
        $setor->descricao = $attr['descricao'];
        $setor->save();

        return back();
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
        $oldSetor = Setor::find($id);
        $attrs = $request->all();
        $toReplace = array('.','-','/', '(', ')', ' ');
        if($oldSetor) {
            foreach (array_keys($attrs) as $k){
                if(str_replace($toReplace, '', $oldSetor[$k]) !== str_replace($toReplace, '', $attrs[$k])){
                    $oldSetor[$k] = $attrs[$k];
                }
            }
            $oldSetor->save();
        }
        return back();
    }

    public function destroy($id)
    {
        Setor::destroy($id);
        return back();
    }
}
