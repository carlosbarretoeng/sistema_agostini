<?php

namespace App\Http\Controllers;

use App\Models\ProductionOrderPart;
use Illuminate\Http\Request;

class ProductionOrderPartController extends Controller
{
    function incrementDone($id, $quantidade){
        $production_order_part = ProductionOrderPart::find($id);
        $production_order_part->done = $production_order_part->done + $quantidade;
        $production_order_part->save();
        return $production_order_part;
    }

    function done($id){
        $production_order_part = ProductionOrderPart::find($id);
        $production_order_part->done = $production_order_part->quantity;
        $production_order_part->save();
        return $production_order_part;
    }
}
