<?php

namespace App\Http\Controllers;

use App\Models\Permissao as PermissaoModel;

class PermissaoController extends Controller
{
    public function __construct()
    {
        parent::__construct('Permissão', 'permissao', PermissaoModel::class);
    }
}
