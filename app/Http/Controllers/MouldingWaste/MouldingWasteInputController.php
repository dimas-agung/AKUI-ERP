<?php

namespace App\Http\Controllers\MouldingWaste;

use App\Http\Controllers\Controller;
use App\Models\MouldingWasteInput;
use Illuminate\Http\Request;

class MouldingWasteInputController extends Controller
{
    // public function __construct(DryAWasteOutputService $DryAWasteOutputService)
    // {
    //     $this->DryAWasteOutputService = $DryAWasteOutputService;
    // }

    public function index(Request $request){
        $i = 1;
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = MouldingWasteInput::query();


        if ($startDate && $endDate) {
            $query->whereBetween(MouldingWasteInput::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), [$startDate, $endDate]);
            $PreGHI = $query->get();
        }else{
            $PreGHI = MouldingWasteInput::limit(1000)
            ->latest()
            ->get();
        }
        return response()->view('MouldingWaste.MouldingWastesInput.index', [
            'PreGHI' => $PreGHI,
            'i' => $i,
        ]);
    }
}
