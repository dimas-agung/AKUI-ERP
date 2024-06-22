<?php

namespace App\Http\Controllers\DryAWaste;

use App\Http\Controllers\Controller;
use App\Models\DryAWasteStock;
use Illuminate\Http\Request;

class DryAWasteStockController extends Controller
{
    //
    protected $DryAWasteStock;

    public function getDryAWasteStock()
    {
        if ($this->DryAWasteStock === null) {
            $this->DryAWasteStock = DryAWasteStock::all();
        }
        return $this->DryAWasteStock;
    }

    // Index
    public function index()
    {
        return response()->view('DryAWaste.DryAWasteStock.index', [
            'dry_a_waste_stock'     => $this->getDryAWasteStock()
        ]);
    }
}
