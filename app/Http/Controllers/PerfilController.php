<?php

namespace App\Http\Controllers;

use App\Models\Perfil as PerfilModel;

class PerfilController extends Controller
{
    public function __construct()
    {
        parent::__construct('Perfil', 'perfil', PerfilModel::class);
    }
}
