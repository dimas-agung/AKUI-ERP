<?php

namespace App\Http\Controllers\DryAWaste;

use App\Http\Controllers\Controller;
use App\Models\DryAWasteInput;
use App\Models\DryAWasteStock;
use Illuminate\Http\Request;

class DryAWasteInputController extends Controller
{
    protected $dryAWasteInputs = null;

    public function getdryAWasteInputs()
    {
        if ($this->dryAWasteInputs === null) {
            $this->dryAWasteInputs = DryAWasteInput::all();
        }
        return $this->dryAWasteInputs;
    }

    // Index
    public function index()
    {
        return response()->view('DryAWaste.DryAWasteInput.index', [
            'dry_a_waste_input' => $this->getdryAWasteInputs()
        ]);
    }
    // create
    // public function create()
    // {
    //     $preCleaningStock = $this->getPreCleaningStock()->where('sisa_berat', '!=', 0);
    //     $MasterOperator = MasterOperator::where('status', 1)->get();
    //     $Perusahaan = Perusahaan::where('status', 1)->get();
    //     return view('PreCleaning.PreCleaningOutput.create', [
    //         'pre_cleaning_stocks'       => $preCleaningStock,
    //         'master_operators'          => $MasterOperator,
    //         'perusahaan'                => $Perusahaan,
    //     ]);
    // }
}
