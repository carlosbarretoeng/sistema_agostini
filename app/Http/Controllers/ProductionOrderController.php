<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Product;
use App\Models\ProductionOrder;
use App\Models\ProductionOrderPart;
use App\Models\ProductionOrderProduct;
use Illuminate\Http\Request;
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

    function createOrShowOrEdit(Request $request, ProductionOrder | null $productionOrder, String $context) {
        $data = [
            'context' => $context,
            'id' => $productionOrder->id ?? null,
            'company_id' => $productionOrder->company_id ?? null,
            'date_start' => $productionOrder->date_start ?? null,
            'date_finish' => $productionOrder->date_start ?? null,
            'status' => $productionOrder->status ?? null,
            'companies' => Company::inCompany(auth()->user())->get(['id','name']),
            'products' => Product::inCompany(auth()->user())->get(['id','name']),
            'production_order_products' => isset($productionOrder->id) ? ProductionOrderProduct::inCompany(auth()->user())->get()->toArray() : [],
            'production_order_parts' => isset($productionOrder->id) ? ProductionOrderPart::inCompany(auth()->user())->get()->toArray() : []
        ];

        return Inertia::render('ProductionOrder/Info', $data);
    }

    function print(Request $request, ProductionOrder $productionOrder) {
        return Inertia::render('ProductionOrder/Print', [
            'id' => $productionOrder->id ?? null,
            'company_id' => $productionOrder->company_id ?? null,
            'date_start' => $productionOrder->date_start ?? null,
            'date_finish' => $productionOrder->date_start ?? null,
            'status' => $productionOrder->status ?? null,
            'production_order_products' => isset($productionOrder->id) ? ProductionOrderProduct::inCompany(auth()->user())->get()->toArray() : [],
            'production_order_parts' => isset($productionOrder->id) ? ProductionOrderPart::inCompany(auth()->user())->get()->toArray() : []
        ]);
    }
}
