<?php

namespace App\Http\Controllers;

use App\Models\Maquinario as MaquinarioModel;

class MaquinarioController extends Controller
{
    public function __construct()
    {
        parent::__construct('Maquinário', 'maquinario', MaquinarioModel::class);
    }
}
