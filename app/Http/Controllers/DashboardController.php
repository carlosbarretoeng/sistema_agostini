<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DashboardController extends Controller
{
    function index(){
        switch(auth()->user()->roles[0]->name) {
            case 'super-admin':
                return $this->indexSuperAdmin();
            case 'admin':
                return $this->indexAdmin();
            default:
                return $this->indexColaborator();
        }
    }

    function indexSuperAdmin () {
        $data = [];
        return Inertia::render('Dashboard/SuperAdmin', $data);
    }

    function indexAdmin () {
        $data = [];
        return Inertia::render('Dashboard/Admin', $data);
    }

    function indexColaborator () {
        $data = [];
        return Inertia::render('Dashboard/Colaborator', $data);
    }
}
