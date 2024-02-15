<?php

namespace App\Http\Controllers\PreGradingHalus;

use App\Http\Controllers\Controller;
use App\Models\PreGradingHalusAdding;
use App\Models\PreGradingHalusStock;
use Illuminate\Http\Request;

class PreGradingHalusAddingController extends Controller
{
    //index
    public function index()
    {
        $i = 1;
        $PreGradingHalusAdding = PreGradingHalusAdding::all();
        return response()->view('PreGradingHalus.PreGradingHalusAdding.index', [
            'pre_grading_halus_addings' => $PreGradingHalusAdding,
            'i' => $i,
        ]);
    }
    // create
    public function create()
    {
        $PreGradingHalusStock = PreGradingHalusStock::with('PreGradingHalusAdding')->get();
        return view('PreGradingHalus.PreGradingHalusAdding.create', [
            'pre_grading_halus_stocks' => $PreGradingHalusStock,
        ]);
    }
    // set
    public function set(Request $request)
    {
        $nomor_job = $request->nomor_job;
        $data = PreGradingHalusStock::where('nomor_job', $nomor_job)
            ->whereRaw('berat_masuk - berat_keluar != 0') // Tambahkan kondisi ini
            ->first();
        return $data;
        // Kembalikan nomor job sebagai respons
        return response()->json($data);
    }
}
