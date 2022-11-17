<?php

namespace App\Actions\ProductionOrder;

use App\Http\Controllers\ProductionOrderProductController;
use App\Models\ProductionOrder;
use App\Models\ProductionOrderProduct;

class CreateNewProductionOrder
{
    public function create(
        int $company,
        string $dataStart,
        string $dataFinish,
        Array $productsAndQuantities
    )
    {
        $productionOrder = new ProductionOrder();
        $productionOrder->company_id = $company;
        $productionOrder->date_start = $dataStart;
        $productionOrder->date_finish = $dataFinish;
        $productionOrder->status = 'draft';
        $productionOrder->save();

        foreach ($productsAndQuantities as $key => $productAndQuantity) {
            $productionOrderProduct = new ProductionOrderProduct();
            $productionOrderProduct->production_order_id = $productionOrder->id;
            $productionOrderProduct->product_id = $productAndQuantity[0];
            $productionOrderProduct->quantity = $productAndQuantity[1];
            $productionOrderProduct->save();

            (new ProductionOrderProductController())->refillProductionOrderParts($productionOrder->id);
        }
    }
}