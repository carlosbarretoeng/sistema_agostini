<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductRecipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ProductRecipeController extends Controller
{
    function destroy(Request | null $request, ProductRecipe $productRecipe){
        $product_id = $productRecipe->product_id;
        $productRecipe->delete();

        (new ProductionOrderProductController())->refillProductionOrderPartsByProductRecipe($productRecipe);

        return Redirect::route('product.show', $product_id);
    }

    function store(Request $request) {

        $attrs = $request->all();

        $productRecipe = new ProductRecipe();

        $productRecipe->product_id = $attrs['product_id'];
        $productRecipe->part_id = $attrs['part_id'];
        $productRecipe->quantity = $attrs['quantity'];
        $productRecipe->order = $attrs['order'];

        $productRecipe->save();

        return Redirect::route('product.show', $attrs['product_id']);
    }

    function update(Request $request) {
        $attrs = $request->all();

        $productRecipe = ProductRecipe::find($attrs['id']);

        $productRecipe->order = $attrs['order'];

        $productRecipe->save();

        return Redirect::route('product.show', $attrs['product_id']);
    }

    function getPartsByProduct(Product $product)
    {
        $productRecipes = ProductRecipe::where('product_id', $product->id)->orderBy('order')->get()->toArray();

        $productRecipes = array_map(function ($entry) {
            return [
                "id" => $entry['id'],
                "order" => $entry['order'],
                "productId" => $entry['product']['id'],
                "productName" => $entry['product']['name'],
                "partId" => $entry['part']['id'],
                "partName" => $entry['part']['name'],
                "partAverageProductionTime" => $entry['part']['partAverageProductionTime'] ?? null,
                "machineryId" => $entry['part']['machinery']['id'] ?? null,
                "machineryName" => $entry['part']['machinery']['name'] ?? null,
                "quantity" => $entry['quantity'],
            ];
        }, $productRecipes);

        return $productRecipes;
    }
}
