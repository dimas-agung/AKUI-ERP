<?php

namespace App\Http\Controllers\PreCleaning;

use Illuminate\Http\Request;
use App\Models\PreCleaningStock;
use App\Http\Controllers\Controller;
use App\Models\PreCleaningInput;
use App\Models\PreCleaningOutput;
use App\Models\TransitPreCleaningStock;

class ReportController extends Controller
{
    //index
    public function index()
    {
        $pInput = PreCleaningInput::all();
        $pStock = PreCleaningStock::all();
        $pOutput = PreCleaningOutput::all();
        $pTransit = TransitPreCleaningStock::all();
        return response()->view('PreCleaning.Report.index', [
            'pre_cleaning_input'               => $pInput,
            'pre_cleaning_stock'               => $pStock,
            'pre_cleaning_output'              => $pOutput,
            'transit_pre_cleaning_stock'       => $pTransit,
        ]);
    }

    // Input
    public function input()
    {
        $PreCleaningInput = PreCleaningInput::with('PreCleaningStock')->get();
        // return $PreCleaningInput;
        return response()->view('PreCleaning.Report.input', compact('PreCleaningInput'));
    }
    // Filter Input
    public function inputFilter(Request $request)
    {
        // $year = $request->input('year');
        $startMonth = $request->input('startMonth');
        $endMonth = $request->input('endMonth');
        $type = $request->input('type');

        $query = PreCleaningInput::query();

        // if ($year) {
        //     $query->whereYear('created_at', $year);
        // }

        if ($startMonth && $endMonth) {
            $query->whereBetween(PreCleaningInput::raw('DATE_FORMAT(created_at, "%Y-%m")'), [$startMonth, $endMonth]);
        } elseif ($startMonth) {
            $query->where(PreCleaningInput::raw('DATE_FORMAT(created_at, "%Y-%m")'), '>=', $startMonth);
        } elseif ($endMonth) {
            $query->where(PreCleaningInput::raw('DATE_FORMAT(created_at, "%Y-%m")'), '<=', $endMonth);
        }

        if ($type) {
            $query->where('jenis_raw_material', 'LIKE', "%{$type}%");
        }

        $data = $query->with('PreCleaningStock')->get();

        return response()->json($data);
    }

    // Stock
    public function stock()
    {
        $PreCleaningStock = PreCleaningStock::all();
        // return $PreCleaningStock;
        return response()->view('PreCleaning.Report.stock', compact('PreCleaningStock'));
    }
    // Filter Stock
    public function stockFilter(Request $request)
    {
        // $year = $request->input('year');
        $startMonth = $request->input('startMonth');
        $endMonth = $request->input('endMonth');
        $type = $request->input('type');

        $query = PreCleaningStock::query();

        // if ($year) {
        //     $query->whereYear('created_at', $year);
        // }

        if ($startMonth && $endMonth) {
            $query->whereBetween(PreCleaningStock::raw('DATE_FORMAT(created_at, "%Y-%m")'), [$startMonth, $endMonth]);
        } elseif ($startMonth) {
            $query->where(PreCleaningStock::raw('DATE_FORMAT(created_at, "%Y-%m")'), '>=', $startMonth);
        } elseif ($endMonth) {
            $query->where(PreCleaningStock::raw('DATE_FORMAT(created_at, "%Y-%m")'), '<=', $endMonth);
        }

        if ($type) {
            $query->where('jenis_raw_material', 'LIKE', "%{$type}%");
        }

        $data = $query->get();

        return response()->json($data);
    }

    // Output
    public function output()
    {
        $PreCleaningOutput = PreCleaningOutput::with('PreCleaningStock')->get();
        // return $PreCleaningOutput;
        return response()->view('PreCleaning.Report.output', compact('PreCleaningOutput'));
    }
    // Filter Output
    public function outputFilter(Request $request)
    {
        // $year = $request->input('year');
        $startMonth = $request->input('startMonth');
        $endMonth = $request->input('endMonth');
        $type = $request->input('type');

        $query = PreCleaningOutput::query();

        // if ($year) {
        //     $query->whereYear('created_at', $year);
        // }

        if ($startMonth && $endMonth) {
            $query->whereBetween(PreCleaningOutput::raw('DATE_FORMAT(created_at, "%Y-%m")'), [$startMonth, $endMonth]);
        } elseif ($startMonth) {
            $query->where(PreCleaningOutput::raw('DATE_FORMAT(created_at, "%Y-%m")'), '>=', $startMonth);
        } elseif ($endMonth) {
            $query->where(PreCleaningOutput::raw('DATE_FORMAT(created_at, "%Y-%m")'), '<=', $endMonth);
        }

        if ($type) {
            $query->where('jenis_raw_material', 'LIKE', "%{$type}%");
        }

        $data = $query->with('PreCleaningStock')->get();

        return response()->json($data);
    }

    // Transit
    public function transit()
    {
        $TransitPreCleaningStock = TransitPreCleaningStock::with('PreCleaningOutput')->get();
        // return $TransitPreCleaningStock;
        return response()->view('PreCleaning.Report.transit', compact('TransitPreCleaningStock'));
    }
    // Filter Transit
    public function transitFilter(Request $request)
    {
        // $year = $request->input('year');
        $startMonth = $request->input('startMonth');
        $endMonth = $request->input('endMonth');
        $type = $request->input('type');

        $query = TransitPreCleaningStock::query();

        // if ($year) {
        //     $query->whereYear('created_at', $year);
        // }

        if ($startMonth && $endMonth) {
            $query->whereBetween(TransitPreCleaningStock::raw('DATE_FORMAT(created_at, "%Y-%m")'), [$startMonth, $endMonth]);
        } elseif ($startMonth) {
            $query->where(TransitPreCleaningStock::raw('DATE_FORMAT(created_at, "%Y-%m")'), '>=', $startMonth);
        } elseif ($endMonth) {
            $query->where(TransitPreCleaningStock::raw('DATE_FORMAT(created_at, "%Y-%m")'), '<=', $endMonth);
        }

        if ($type) {
            $query->where('jenis_raw_material', 'LIKE', "%{$type}%");
        }

        $data = $query->with('PreCleaningOutput')->get();

        return response()->json($data);
    }
}
