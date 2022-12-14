<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductionOrder;
use App\Models\ProductionOrderPart;
use App\Models\ProductionOrderProduct;
use App\Models\ProductRecipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProductionOrderProductController extends Controller
{
    function  store(Request | null $request) {
        $attr = $request->all();

        $productionOrderProduct = new ProductionOrderProduct();
        $productionOrderProduct->production_order_id = $attr['production_order_id'];
        $productionOrderProduct->product_id = $attr['product_id'];
        $productionOrderProduct->quantity = $attr['quantity'];
        $productionOrderProduct->save();

        $this->refillProductionOrderParts($attr['production_order_id']);
        return Redirect::route('production_order.edit', $attr['production_order_id']);
    }

    function destroy(Request | null $request, ProductionOrderProduct $productionOrderProduct){
        $production_order_id = $productionOrderProduct->production_order_id;

        $productsRecipe = ProductRecipe::query()->where('product_id', $productionOrderProduct->product_id)->get();

        foreach ($productsRecipe as $productRecipe) {
            $productionOrderPart = ProductionOrderPart::query()
                ->where('production_order_id', $production_order_id)
                ->where('product_recipe_id', $productRecipe->id)
                ->first();
            if($productionOrderPart) $productionOrderPart->delete();
        }

        $productionOrderProduct->delete();
        $this->refillProductionOrderParts($production_order_id);
        return Redirect::route('production_order.edit', $production_order_id);
    }

    function increment(Request $request, ProductionOrder $productionOrder){
        $attrs = $request->all();

        $productionOrderProduct = ProductionOrderProduct::where('id', $attrs['production_order_product'])->first();

        $productionOrderProduct->quantity = $productionOrderProduct->quantity + 1;

        $productionOrderProduct->save();

        $this->refillProductionOrderParts($productionOrder->id);

        return Redirect::route('production_order.edit', $productionOrder->id);
    }

    function decrement(Request $request, ProductionOrder $productionOrder){
        $attrs = $request->all();

        $productionOrderProduct = ProductionOrderProduct::where('id', $attrs['production_order_product'])->first();

        if($productionOrderProduct->quantity > 1){
            $productionOrderProduct->quantity = $productionOrderProduct->quantity - 1;
        }

        $productionOrderProduct->save();

        $this->refillProductionOrderParts($productionOrder->id);

        return Redirect::route('production_order.edit', $productionOrder->id);
    }

    public function refillProductionOrderPartsByProductRecipe(ProductRecipe $product_recipe)
    {
        $ordens = ProductionOrderProduct::where("product_id", $product_recipe->product_id)
            ->join("production_orders", "production_order_id", '=', "production_orders.id")
            ->whereNot("status","done")
            ->whereNot("status","canceled")
            ->get(['production_orders.id as id'])->toArray();

        foreach ($ordens as $idx => $ordem) {
            $this->refillProductionOrderParts($ordem['id']);
        }
    }

    public function refillProductionOrderParts(mixed $productionOrderId)
    {
        $productionOrderProducts = ProductionOrderProduct::query()->where('production_order_id', $productionOrderId)->get();

        foreach ($productionOrderProducts as $productionOrderProduct) {
            $quantityOfProducts = $productionOrderProduct->quantity;
            $productsRecipe = ProductRecipe::query()->where('product_id', $productionOrderProduct->product_id)->get();            

            // apaga os outros
            $productionPartsExtras = ProductionOrderPart::query()
                ->where('production_order_id', $productionOrderId)
                ->where('production_order_product_id', $productionOrderProduct->product_id)
                ->whereNotIn('product_recipe_id', array_map(function($el){ return $el['id']; }, $productsRecipe->toArray()))
                ->delete();

            foreach ($productsRecipe as $productRecipe) {
                $quantityOfProductInRecipe = $productRecipe->quantity;
                $finalQuantity = $quantityOfProducts * $quantityOfProductInRecipe;

                $productionOrderPart = ProductionOrderPart::query()
                    ->where('production_order_id', $productionOrderId)
                    ->where('product_recipe_id', $productRecipe->id)
                    ->first();

                if($productionOrderPart) {
                    $productionOrderPart->quantity = $finalQuantity;
                    $productionOrderPart->save();
                }
                else {
                    $newProductionOrderPart = new ProductionOrderPart();

                    $newProductionOrderPart->production_order_id = $productionOrderId;
                    $newProductionOrderPart->production_order_product_id = $productionOrderProduct->product_id;
                    $newProductionOrderPart->product_recipe_id = $productRecipe->id;
                    $newProductionOrderPart->quantity = $finalQuantity;
                    $newProductionOrderPart->done = 0;
                    $newProductionOrderPart->save();
                }
            }
        }
    }
}
