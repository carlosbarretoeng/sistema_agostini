<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Product;
use App\Models\ProductionOrder;
use App\Models\Times;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DashboardController extends Controller
{
    function index(){
        switch(auth()->user()->roles[0]->name) {
            case 'super-admin':
                return $this->indexColaborator();
                // return $this->indexSuperAdmin();
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
        $data = [
            'production_orders' => ProductionOrder::inCompany(auth()->user())
                ->whereIn('status', ['waiting', 'in_production'])
                ->orderBy('status')
                ->orderBy('created_at', 'desc')
                ->get(['id','company_id','progress','status','date_start','date_finish'])
                ->toArray(),
            'production_orders_started' => array_unique(
                array_map(
                    function($el){ return $el["production_order_id"]; },
                    Times::query()
                        ->where('user_id', auth()->user()->id)
                        ->where('type', Times::TYPE_PRODUCAO)
                        ->whereNull('finish')
                        ->join('production_order_parts', 'production_order_part_id', '=', 'production_order_parts.id')
                        ->get('production_order_id')
                        ->toArray()
                )
            )
        ];
        // dd($data);
        return Inertia::render('Dashboard/Colaborator', $data);
    }
}
