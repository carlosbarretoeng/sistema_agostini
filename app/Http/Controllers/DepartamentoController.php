<?php

namespace App\Http\Controllers;

use App\Models\Departamento as DepartamentoModel;

class DepartamentoController extends Controller
{
    public function __construct()
    {
        parent::__construct('Departamento', 'departamento', DepartamentoModel::class);
    }
}
