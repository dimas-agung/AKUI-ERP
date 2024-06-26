<?php

namespace App\Http\Controllers\PreGradingHalus;

use App\Http\Controllers\Controller;
use App\Models\PreGradingHalusAddingStock;
use Illuminate\Http\Request;

class PreGradingHalusAddingStockController extends Controller
{
    protected $PreGradingHalusAddingStock = null;

    public function getPreGradingHalusAddingStock()
    {
        if ($this->PreGradingHalusAddingStock === null) {
            // $this->PreGradingHalusAddingStock = PreGradingHalusAddingStock::where('status_stock', 1);
            $this->PreGradingHalusAddingStock = PreGradingHalusAddingStock::all();
        }
        return $this->PreGradingHalusAddingStock;
    }
    //index
    public function index()
    {
        return response()->view('PreGradingHalus.PreGradingHalusAddingStock.index', [
            'pre_grading_halus_adding_stocks' => $this->getPreGradingHalusAddingStock(),
        ]);
    }
}
