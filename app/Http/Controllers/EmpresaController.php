<?php

namespace App\Http\Controllers;

use App\Models\Empresa as EmpresaModel;
use Inertia\Inertia;
use Inertia\Response;

class EmpresaController extends CrudController
{
    public string $label = "Empresa";
    public string $entity = "empresa";
    public string $model = EmpresaModel::class;

    public function __construct()
    {
        parent::__construct($this->label, $this->entity, $this->model);
    }

    /* public function show($id): Response
    {
        $data = parent::obterShowData($id);
        return Inertia::render('Empresa/Show', $data);
    }*/
}
