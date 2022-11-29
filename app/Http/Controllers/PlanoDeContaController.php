<?php

namespace App\Http\Controllers;

use App\Models\PlanoDeConta;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PlanoDeContaController extends Controller
{
    function index(Request $request) {
        $data = [
            'plano_de_contas' => PlanoDeConta::inCompany(auth()->user())
                // ->whereNull('superior')
                ->get()
                ->toArray(),
        ];
        return Inertia::render('PlanoDeContas/Index', $data);
    }
}
