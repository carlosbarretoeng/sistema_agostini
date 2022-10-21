<?php

namespace App\Http\Controllers;

use App\Models\ProductionOrderPart;
use App\Models\Times;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Ramsey\Uuid\Type\Time;

class TimesController extends Controller
{
    function startProduction(Request $request){
        $attr = $request->all();

        foreach ($attr['production_order_parts'] as $production_order_part_id){
            $this->finish($production_order_part_id);
            $this->start($production_order_part_id, Times::TYPE_PRODUCAO);
        }

        (new ProductionOrderController())->moveStatus($attr['production_order'], 'in_production');

        return Redirect::route('dashboard.index');
    }

    function finalizar(Request $request){
        $attr = $request->all();

        foreach ($attr['quantidades'] as $production_order_parts_id){
            $this->finish(
                $production_order_parts_id['production_order_parts_id'],
                -1,
            );
        }

        return Redirect::route('dashboard.index');
    }

    function interrupt(Request $request){
        $attr = $request->all();

        $motivo = $attr['motivo'];

        foreach ($attr['quantidades'] as $production_order_parts_id){
            $this->finish(
                $production_order_parts_id['production_order_parts_id'],
                $production_order_parts_id['quantidade'],
            );
            $this->start(
                $production_order_parts_id['production_order_parts_id'],
                $motivo
            );
        }

        return Redirect::route('dashboard.index');
    }

    function start($production_order_part_id, $type) {
        $time = new Times();

        $time->production_order_part_id = $production_order_part_id;
        $time->user_id = auth()->user()->id;
        $time->type = $type;
        $time->start = Carbon::now();

        $time->save();
    }

    function finish($production_order_part_id, $quantidade = 0){
        $time = Times::query()
            ->where('production_order_part_id', $production_order_part_id)
            ->whereNull('finish')
            // ->get()->toArray();
            ->latest()->first();

        if(!$time) return;

        $time->finish = Carbon::now()->toDateTimeString();
        $time->save();

        if($time->type === Times::TYPE_PRODUCAO && $quantidade > 0){
            (new ProductionOrderPartController())->incrementDone($production_order_part_id, $quantidade);
        }

        if($time->type === Times::TYPE_PRODUCAO && $quantidade === -1){
            (new ProductionOrderPartController())->done($production_order_part_id);
        }

        $pop = ProductionOrderPart::find($production_order_part_id)->get()->toArray();

        $toBuild = array_reduce($pop, function($ol, $el) { return $ol + ($el["quantity"] - $el["done"]); }, 0);

        if($toBuild === 0){
            // TODO: CALCULATE TIMES
            (new ProductionOrderController())->moveStatus($pop[0]['production_order_id'], 'done');
        }
    }
}
