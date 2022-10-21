<?php

namespace App\Http\Controllers;

use App\Models\Part;
use App\Models\ProductionOrder;
use App\Models\TimesPerPart;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TimesPerPartController extends Controller
{
    function avaliateAvgTime(int $part, int $lastDays = 365){
        $avg = floor(TimesPerPart::query()
            ->where('part_id', $part)
            ->where('created_at', '>', Carbon::today()->subDays($lastDays))
            ->avg('partAverageProductionTime'));



        $part = Part::find($part);

        $part->partAverageProductionTime =$avg;
        $part->save();

        return $avg;
    }

    function startProduction(Request $request){
        $attr = $request->all();

//        $timesPerPart = new TimesPerPart();
//        $timesPerPart->part_id = 1;
//        $timesPerPart->user_id = auth()->user()->id;
//        $timesPerPart->start = Carbon::now()->toDateTimeString();
//        $timesPerPart->type = TimesPerPart::TYPE_PRODUCAO;
//        $timesPerPart->save();
//
        $productionOrder = ProductionOrder::find($attr['productionOrderId']);

        return (new ProductionOrderController())->current($request, $productionOrder);
    }
}
