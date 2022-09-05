<?php

namespace App\Http\Controllers;

use App\Models\Empresa as EmpresaModel;

class EmpresaController extends Controller
{

    public function __construct()
    {
        parent::__construct('Empresa', 'empresa', EmpresaModel::class);
    }
}
