<?php

namespace App\Http\Controllers;

use App\Models\Part;

class PartController extends CrudController
{

    public function __construct()
    {
        parent::__construct('Peças', 'part', Part::class);
    }
}
