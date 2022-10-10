<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Product;
use App\Models\ProductionOrder;
use App\Models\ProductionOrderAction;
use App\Models\ProductionOrderPart;
use App\Models\ProductionOrderProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ProductionOrderController extends Controller
{
    function index(Request $request) {
        $data = [
            'production_orders' => ProductionOrder::inCompany(auth()->user())->orderBy('status')->orderBy('created_at', 'desc')->get()
        ];
        return Inertia::render('ProductionOrder/Index', $data);
    }

    function create(Request $request) {
        return $this->createOrShowOrEdit($request, null, 'create');
    }

    function show(Request $request, ProductionOrder $productionOrder) {
        return $this->createOrShowOrEdit($request, $productionOrder, 'show');
    }

    function edit(Request $request, ProductionOrder $productionOrder) {
        return $this->createOrShowOrEdit($request, $productionOrder, 'edit');
    }

    function update(Request $request) {
        $attrs = $request->all();

        $productionOrder = ProductionOrder::find($attrs['id']);

        $productionOrder->company_id = $attrs['company_id'];
        $productionOrder->date_start = Carbon::createFromFormat('d/m/Y', $attrs['date_start'])->format('Y-m-d');
        $productionOrder->date_finish = Carbon::createFromFormat('d/m/Y', $attrs['date_finish'])->format('Y-m-d');;
        $productionOrder->status = $attrs['status'];

        $productionOrder->save();

        return Redirect::route('production_order.index');
    }

    function store(Request $request) {
        $attrs = $request->all();

        $productionOrder = new ProductionOrder();

        $productionOrder->company_id = $attrs['company_id'];
        $productionOrder->date_start = Carbon::createFromFormat('d/m/Y', $attrs['date_start'])->format('Y-m-d');
        $productionOrder->date_finish = Carbon::createFromFormat('d/m/Y', $attrs['date_finish'])->format('Y-m-d');;
        $productionOrder->status = $attrs['status'];

        $productionOrder->save();

        return Redirect::route('production_order.index');
    }

    function createOrShowOrEdit(Request $request, ProductionOrder | null $productionOrder, String $context) {
        $production_order_products = [];

        if(isset($productionOrder->id)){
            $production_order_products = ProductionOrderProduct::inCompany(auth()->user())->where('production_order_id', $productionOrder->id)->get()->toArray();
            usort($production_order_products, function ($a, $b){
                return strcmp($a['product']['name'], $b['product']['name']);
            });
        }

        $production_order_parts = [];

        if(isset($productionOrder->id)){
            $production_order_parts = ProductionOrderPart::inCompany(auth()->user())->where('production_order_id', $productionOrder->id)->get()->toArray();
            usort($production_order_parts, function ($a, $b){
                return strcmp($a['product_recipe']['part']['name'], $b['product_recipe']['part']['name']);
            });
        }

        $data = [
            'context' => $context,
            'id' => $productionOrder->id ?? null,
            'company_id' => $productionOrder->company_id ?? null,
            'date_start' => $productionOrder->date_start ?? null,
            'date_finish' => $productionOrder->date_start ?? null,
            'status' => $productionOrder->status ?? null,
            'companies' => Company::inCompany(auth()->user())->get(['id','name']),
            'products' => Product::inCompany(auth()->user())->get(['id','name']),
            'production_order_products' => $production_order_products,
            'production_order_parts' => $production_order_parts,
            'production_order_actions' => [],
        ];

        return Inertia::render('ProductionOrder/Info', $data);
    }

    function print(Request $request, ProductionOrder $productionOrder) {
        return Inertia::render('ProductionOrder/Print', [
            ...$productionOrder->toArray(),
            'production_order_products' => isset($productionOrder->id) ? ProductionOrderProduct::inCompany(auth()->user())
                ->where('production_order_id', $productionOrder->id)->get()->toArray() : [],
            'production_order_parts' => isset($productionOrder->id) ? ProductionOrderPart::inCompany(auth()->user())
                ->where('production_order_id', $productionOrder->id)->get()->toArray() : [],
            'production_order_actions' => [],
        ]);
    }
}
