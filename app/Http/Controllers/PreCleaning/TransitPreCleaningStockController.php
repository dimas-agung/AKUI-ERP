<?php

namespace App\Http\Controllers\PreCleaning;

use App\Http\Controllers\Controller;
use App\Models\PreCleaningOutput;
use App\Models\TransitPreCleaningStock;
use Illuminate\Http\Request;

class TransitPreCleaningStockController extends Controller
{
    protected $TransitPreCleaningStock = null;

    public function getTransitPreCleaningStock()
    {
        if ($this->TransitPreCleaningStock === null) {
            // $this->TransitPreCleaningStock = TransitPreCleaningStock::where('sisa_berat', '!=', 0);
            $this->TransitPreCleaningStock = TransitPreCleaningStock::all();
        }
        return $this->TransitPreCleaningStock;
    }
    //index
    public function index()
    {
        return response()->view('PreCleaning.TransitPreCleaningStock.index', [
            'transit_pre_cleaning_stocks' => $this->getTransitPreCleaningStock(),
        ]);
    }
}
