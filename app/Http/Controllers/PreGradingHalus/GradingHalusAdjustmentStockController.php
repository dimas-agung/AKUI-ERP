<?php

namespace App\Http\Controllers\PreGradingHalus;

use App\Http\Controllers\Controller;
use App\Models\GradingHalusAdjustmentStock;
use Illuminate\Http\Request;

class GradingHalusAdjustmentStockController extends Controller
{
    protected $GradingHalusAdjustmentStock = null;

    public function getGradingHalusAdjustmentStock()
    {
        if ($this->GradingHalusAdjustmentStock === null) {
            $this->GradingHalusAdjustmentStock = GradingHalusAdjustmentStock::where('status', 1);
        }
        return $this->GradingHalusAdjustmentStock;
    }

    //index
    public function index()
    {
        return response()->view('PreGradingHalus.AdjustmentStock.index', [
            'grading_halus_adjustment_stocks' => $this->getGradingHalusAdjustmentStock(),
        ]);
    }
}
