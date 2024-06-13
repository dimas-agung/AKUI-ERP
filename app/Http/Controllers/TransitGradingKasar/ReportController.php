<?php

namespace App\Http\Controllers\TransitGradingKasar;

use App\Http\Controllers\Controller;
use App\Models\GradingKasarHasil;
use App\Models\GradingKasarInput;
use App\Models\GradingKasarOutput;
use App\Models\GradingKasarStock;
use App\Models\StockTransitGradingKasar;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(){
        // return $GradingKI;
        return response()->view('transit_grading.Report.index');
    }

    // Input Report
    public function input(){
        $GradingKI = GradingKasarInput::with('StockTransitRawMaterial')->get();
        // return $GradingKI;
        return response()->view('transit_grading.Report.input', compact('GradingKI'));
    }

    public function filter(Request $request)
    {
        $year = $request->input('year');
        $startMonth = $request->input('startMonth');
        $endMonth = $request->input('endMonth');
        $type = $request->input('type');

        $query = GradingKasarInput::query();

        if ($year) {
            $query->whereYear('created_at', $year);
        }

        if ($startMonth && $endMonth) {
            $query->whereBetween(GradingKasarInput::raw('DATE_FORMAT(created_at, "%Y-%m")'), [$startMonth, $endMonth]);
        } elseif ($startMonth) {
            $query->where(GradingKasarInput::raw('DATE_FORMAT(created_at, "%Y-%m")'), '>=', $startMonth);
        } elseif ($endMonth) {
            $query->where(GradingKasarInput::raw('DATE_FORMAT(created_at, "%Y-%m")'), '<=', $endMonth);
        }

        if ($type) {
            $query->where('jenis_raw_material', 'LIKE', "%{$type}%");
        }

        $data = $query->with('StockTransitRawMaterial')->get();

        return response()->json($data);
    }

    // Hasil Report
    public function hasil(){
        $GradingKI = GradingKasarHasil::with('GradingKasarInput')->get();
        // return $GradingKI;
        return response()->view('transit_grading.Report.hasil', compact('GradingKI'));
    }

    public function filterH(Request $request)
    {
        $year = $request->input('year');
        $startMonth = $request->input('startMonth');
        $endMonth = $request->input('endMonth');
        $type = $request->input('type');

        $query = GradingKasarHasil::query();

        if ($year) {
            $query->whereYear('created_at', $year);
        }

        if ($startMonth && $endMonth) {
            $query->whereBetween(GradingKasarHasil::raw('DATE_FORMAT(created_at, "%Y-%m")'), [$startMonth, $endMonth]);
        } elseif ($startMonth) {
            $query->where(GradingKasarHasil::raw('DATE_FORMAT(created_at, "%Y-%m")'), '>=', $startMonth);
        } elseif ($endMonth) {
            $query->where(GradingKasarHasil::raw('DATE_FORMAT(created_at, "%Y-%m")'), '<=', $endMonth);
        }

        if ($type) {
            $query->where('jenis_raw_material', 'LIKE', "%{$type}%");
        }

        $data = $query->with('GradingKasarInput')->get();

        return response()->json($data);
    }

    // Stock Report
    public function stock(){
        $GradingKI = GradingKasarStock::with('GradingKasarHasil')->get();
        // return $GradingKI;
        return response()->view('transit_grading.Report.stock', compact('GradingKI'));
    }

    public function filterS(Request $request)
    {
        $year = $request->input('year');
        $startMonth = $request->input('startMonth');
        $endMonth = $request->input('endMonth');
        $type = $request->input('type');

        $query = GradingKasarStock::query();

        if ($year) {
            $query->whereYear('created_at', $year);
        }

        if ($startMonth && $endMonth) {
            $query->whereBetween(GradingKasarStock::raw('DATE_FORMAT(created_at, "%Y-%m")'), [$startMonth, $endMonth]);
        } elseif ($startMonth) {
            $query->where(GradingKasarStock::raw('DATE_FORMAT(created_at, "%Y-%m")'), '>=', $startMonth);
        } elseif ($endMonth) {
            $query->where(GradingKasarStock::raw('DATE_FORMAT(created_at, "%Y-%m")'), '<=', $endMonth);
        }

        if ($type) {
            $query->where('jenis_raw_material', 'LIKE', "%{$type}%");
        }

        $data = $query->with('GradingKasarHasil')->get();

        return response()->json($data);
    }

    // Output Report
    public function output(){
        $GradingKI = GradingKasarOutput::with('GradingKasarStock')->get();
        // return $GradingKI;
        return response()->view('transit_grading.Report.output', compact('GradingKI'));
    }

    public function filterO(Request $request)
    {
        $year = $request->input('year');
        $startMonth = $request->input('startMonth');
        $endMonth = $request->input('endMonth');
        $type = $request->input('type');

        $query = GradingKasarOutput::query();

        if ($year) {
            $query->whereYear('created_at', $year);
        }

        if ($startMonth && $endMonth) {
            $query->whereBetween(GradingKasarOutput::raw('DATE_FORMAT(created_at, "%Y-%m")'), [$startMonth, $endMonth]);
        } elseif ($startMonth) {
            $query->where(GradingKasarOutput::raw('DATE_FORMAT(created_at, "%Y-%m")'), '>=', $startMonth);
        } elseif ($endMonth) {
            $query->where(GradingKasarOutput::raw('DATE_FORMAT(created_at, "%Y-%m")'), '<=', $endMonth);
        }

        if ($type) {
            $query->where('jenis_raw_material', 'LIKE', "%{$type}%");
        }

        $data = $query->with('GradingKasarStock')->get();

        return response()->json($data);
    }

    // Transit Report
    public function transit(){
        $GradingKI = StockTransitGradingKasar::with('GradingKasarOutput')->get();
        // return $GradingKI;
        return response()->view('transit_grading.Report.transit', compact('GradingKI'));
    }

    public function filterT(Request $request)
    {
        $year = $request->input('year');
        $startMonth = $request->input('startMonth');
        $endMonth = $request->input('endMonth');
        $type = $request->input('type');

        $query = StockTransitGradingKasar::query();

        if ($year) {
            $query->whereYear('created_at', $year);
        }

        if ($startMonth && $endMonth) {
            $query->whereBetween(StockTransitGradingKasar::raw('DATE_FORMAT(created_at, "%Y-%m")'), [$startMonth, $endMonth]);
        } elseif ($startMonth) {
            $query->where(StockTransitGradingKasar::raw('DATE_FORMAT(created_at, "%Y-%m")'), '>=', $startMonth);
        } elseif ($endMonth) {
            $query->where(StockTransitGradingKasar::raw('DATE_FORMAT(created_at, "%Y-%m")'), '<=', $endMonth);
        }

        if ($type) {
            $query->where('jenis_raw_material', 'LIKE', "%{$type}%");
        }

        $data = $query->with('GradingKasarOutput')->get();

        return response()->json($data);
    }
}
