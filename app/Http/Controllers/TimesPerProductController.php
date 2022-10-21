<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductionOrder;
use App\Models\ProductRecipe;
use App\Models\TimesPerPart;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TimesPerProductController extends Controller
{
    function avaliateAvgTime(int $productId){
        $productRecipes = ProductRecipe::query()
            ->where('product_id', $productId)
            ->get()
            ->toArray();

        $avg = array_reduce($productRecipes, function($older, $newer){
            $older += $newer['part']['partAverageProductionTime'] ?? 0;
            return $older;
        }, 0);

        $product = Product::find($productId);
        $product->productAverageProductionTime = $avg;
        $product->save();

        return $avg;
    }
}
