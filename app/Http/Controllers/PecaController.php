<?php

namespace App\Http\Controllers;

use App\Models\Peca as PecaModel;

class PecaController extends CrudController
{
    public function __construct()
    {
        parent::__construct('Peça', 'peca', PecaModel::class);
    }
}
