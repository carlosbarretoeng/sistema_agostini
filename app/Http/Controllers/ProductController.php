<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Machinery;
use App\Models\Part;
use App\Models\Product;
use App\Models\TimesPerProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class ProductController extends Controller
{
    function index(Request $request) {
        $data = [
            'products' => Product::inCompany(auth()->user())->orderBy('name')->get()
        ];
        return Inertia::render('Product/Index', $data);
    }

    function create(Request $request) {
        return $this->createOrShowOrEdit($request, null, 'create');
    }

    function show(Request $request, Product $product) {
        return $this->createOrShowOrEdit($request, $product, 'show');
    }

    function edit(Request $request, Product $product) {
        return $this->createOrShowOrEdit($request, $product, 'edit');
    }

    function createOrShowOrEdit(Request $request, Product | null $product, String $context) {
        $data = [
            'context' => $context,
            'id' => $product->id ?? null,
            'company_id' => $product->company_id ?? null,
            'name' => $product->name ?? null,
            'productAverageProductionTime' => $product->productAverageProductionTime ?? null,
            'productRecipe' => $product !== null ? (new ProductRecipeController())->getPartsByProduct($product) : [],
            'companies' => Company::inCompany(auth()->user())->get(['id','name']),
            'machineries' => Machinery::inCompany(auth()->user())->get(['id','name']),
            'parts' => Part::inCompany(auth()->user())->get(['id','name']),
            'times_per_products' => array_map(function($el){
                return [
                    "datetime" => $el['created_at'],
                    "value" => $el['productAverageProductionTime']
                ];
            },
                TimesPerProduct::query()
                    ->where('product_id', $product->id)
                    ->where('created_at', '>', Carbon::today()->subDays(365))
                    ->get(['created_at', 'productAverageProductionTime'])->toArray())
        ];
        return Inertia::render('Product/Info', $data);
    }

    function store(Request $request) {
        $rules = [
            'company_id' => 'required',
            'name' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('product.create')->withErrors($validator);
        } else {
            $attrs = $request->all();

            $product = new Product();

            $product->company_id = $attrs['company_id'];
            $product->name = $attrs['name'];

            $product->save();

            return Redirect::route('product.index');
        }
    }

    function update(Request $request) {
        $rules = [
            'id' => 'required',
            'company_id' => 'required',
            'name' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::route('product.create')->withErrors($validator);
        } else {
            $attrs = $request->all();

            $product = Product::find($attrs['id']);

            $product->company_id = $attrs['company_id'];
            $product->name = $attrs['name'];

            $product->save();

            return Redirect::route('product.index');
        }
    }

    function destroy(Request | null $request, Product $product){
        $product->delete();
        return Redirect::route('product.index');
    }
}
