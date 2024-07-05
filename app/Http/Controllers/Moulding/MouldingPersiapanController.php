<?php

namespace App\Http\Controllers\Moulding;


use App\Http\Controllers\Controller;
use App\Models\GradingWarnaStock;
use App\Models\MasterJobMoulding;
use App\Models\MouldingPersiapan;
use App\Services\DryAOutputHancuranService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MouldingPersiapanController extends Controller
{
        //Index
        public function index(){
            $i =1;
            $PreCleaningI = MouldingPersiapan::get();
            // return $existingItem;

            return response()->view('Moulding.MouldingPenerimaan.index', [
                'PreCleaningI' => $PreCleaningI,
                'i' => $i,
            ]);
        }

            /**
         * Create
         */
        public function create(): View
        {
            $PreCleaningI = MouldingPersiapan::get();
            $MasTujKir = MasterJobMoulding::get();
            $stockTGK = GradingWarnaStock::get();
            // return $stockTGK;
            return view('Moulding.MouldingPenerimaan.create', compact('stockTGK', 'PreCleaningI', 'MasTujKir'));
        }
        public function set(Request $request)
        {
            $id_box_grading_warna = $request->id_box_grading_warna;
            $data = GradingWarnaStock::where('id_box_grading_warna', $id_box_grading_warna)->get();

            // Kembalikan data sebagai respons JSON
            return response()->json($data);
        }


        public function setpcc(Request $request)
        {
            $order_job = $request->order_job;
            // Lakukan logika untuk mengatur nomor batch berdasarkan order_job
            $data = MasterJobMoulding::where('jenis',$order_job)->first();

            // Kembalikan nomor batch sebagai respons
            return response()->json($data);
        }
}
