<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Product;
use App\Models\Department;
use App\Models\Machinery;
use App\Models\ProductionOrder;
use App\Models\Times;
use App\Models\User;
use Illuminate\Support\Carbon;
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
                case 'app_tempos':
                return $this->indexAppTempos();
        }
    }

    function indexSuperAdmin () {
        $data = [
            'users_number' => User::count(),
            'company_number' => Company::count(),
            'department_number' => Department::count(),
            'product_number' => Product::count(),
            'machinery_number' => Machinery::count(),
            'production_order_number' => ProductionOrder::count(),
        ];
        return Inertia::render('Dashboard/SuperAdmin', $data);
    }

    function indexAdmin () {
        $tempos = array_map(function($el){
            return [
                "id" => $el['id'],
                "datetime" => $el['created_at'],
                "type" => $el['type'],
                "value" => $el['avgTime']
            ];
        },
        Times::inCompany(auth()->user())
            ->where('times.created_at', '>', Carbon::today()->subDays(365))
            ->whereNotNull('times.finish')
            ->get(['times.id', 'times.type', 'times.created_at', DB::raw('TIMESTAMPDIFF(SECOND,times.start,times.finish) as avgTime')])
            ->toArray()
        );

        $data = [
            'department_number' => Department::inCompany(auth()->user())->count(),
            'product_number' => Product::inCompany(auth()->user())->count(),
            'machinery_number' => Machinery::inCompany(auth()->user())->count(),
            'production_order_number' => ProductionOrder::inCompany(auth()->user())->count(),
            'users_number' => User::where('company_id', auth()->user()->company_id)->count(),
            'tempos' => $tempos
        ];
        
        return Inertia::render('Dashboard/Admin', $data);
    }

    function indexAppTempos () {
        $data = [
            'production_orders' => ProductionOrder::inCompany(auth()->user())
                ->whereIn('status', ['waiting', 'in_production'])
                ->orderBy('status')
                ->orderBy('created_at', 'desc')
                ->get(['id','company_id','progress','status','date_start','date_finish'])
                ->toArray(),
            'productions_with_open_time' => Times::inCompany(auth()->user())
                ->where('user_id', auth()->user()->id)
                ->whereIn('status', ['in_production'])
                ->whereNull('finish')
                ->join('product_recipes', 'product_recipe_id', '=', 'product_recipes.id')
                ->join('parts', 'parts.id', '=', 'part_id')
                ->groupBy('production_order_id', 'name', 'type')
                ->get([
                    'production_order_id as id',
                    'name',
                    'type',
                    DB::raw('CONCAT(sum(production_order_parts.quantity) - sum(production_order_parts.done), "x ", name) as item'),
                    //DB::raw('CONCAT(production_order_parts.quantity - production_order_parts.done, "x ", name) as item')
                ])
                // ->get()
                ->toArray(),
        ];
        return Inertia::render('Dashboard/AppTempos', $data);
    }
}
