<?php

namespace App\Http\Controllers\MouldingWaste;

use App\Http\Controllers\Controller;
use App\Models\MouldingWasteStock;
use Illuminate\Http\Request;

class MouldingWasteStockController extends Controller
{
    //
    protected $DryAWasteStock;

    public function getDryAWasteStock()
    {
        if ($this->DryAWasteStock === null) {
            $this->DryAWasteStock = MouldingWasteStock::all();
        }
        return $this->DryAWasteStock;
    }

    // Index
    public function index()
    {
        return response()->view('MouldingWaste.MouldingWasteStock.index', [
            'dry_a_waste_stock'     => $this->getDryAWasteStock()
        ]);
    }
}
