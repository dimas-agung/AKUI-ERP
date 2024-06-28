<?php

namespace App\Http\Controllers\DryAHancuran;

use App\Http\Controllers\Controller;
use App\Models\DryAGradingHancuranStock;
use Illuminate\Http\Request;

class DryAGradingHancuranStockController extends Controller
{
    protected $DryAGradingHancuranStock = null;

    public function getDryAGradingHancuranStock()
    {
        if ($this->DryAGradingHancuranStock === null) {
            $this->DryAGradingHancuranStock = DryAGradingHancuranStock::where('sisa_berat', '!=', 0)->get();
        }
        return $this->DryAGradingHancuranStock;
    }
    //index
    public function index()
    {
        // $DryAGradingHancuranStock = DryAGradingHancuranStock::all();
        return response()->view('DryAHancuran.DryAGradingHancuranStock.index', [
            'dry_a_grading_hancuran_stock' => $this->getDryAGradingHancuranStock(),
        ]);
    }
}
