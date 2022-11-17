<?php

namespace App\Http\Controllers;

use App\Models\ProductionOrder;
use App\Models\ProductionOrderPart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductionOrderPartController extends Controller
{
    function incrementDone($id, $quantidade){
        $production_order_part = ProductionOrderPart::find($id);
        $production_order_part->done = $production_order_part->done + $quantidade;
        $production_order_part->save();

        $this->calculateProductionOrderProgress($production_order_part->production_order_id);

        return $production_order_part;
    }

    function done($id){
        $production_order_part = ProductionOrderPart::find($id);
        $production_order_part->done = $production_order_part->quantity;
        $production_order_part->save();

        $this->calculateProductionOrderProgress($production_order_part->production_order_id);

        return $production_order_part;
    }

    function calculateProductionOrderProgress($production_order_id){
        $production_order_parts = ProductionOrderPart::where('production_order_id', $production_order_id)
            ->select([DB::raw('100 * SUM(done) / SUM(quantity) as progress')])
            ->groupBy('production_order_id')
            ->first()
            ->toArray();

        $production_order = ProductionOrder::find($production_order_id);
        $production_order->progress = $production_order_parts['progress'];
        $production_order->save();
    }
}
