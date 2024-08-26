<?php

namespace App\Http\Controllers\Moulding;


use App\Http\Controllers\Controller;
use App\Models\GradingWarnaStock;
use App\Models\MasterJobMoulding;
use App\Models\MouldingPersiapan;
use App\Services\DryAOutputHancuranService;
use App\Services\MouldingPersiapanService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class MouldingPersiapanController extends Controller
{
        protected $MouldingPersiapanService;

        public function __construct(MouldingPersiapanService $MouldingPersiapanService)
        {
            $this->MouldingPersiapanService = $MouldingPersiapanService;
        }

        public function index(Request $request){
            $i = 1;
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');

            $query = MouldingPersiapan::query();


            if ($startDate && $endDate) {
                $query->whereBetween(MouldingPersiapan::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), [$startDate, $endDate]);
                $PreCleaningI = $query->where('tujuan_kirim',Auth::user()->plant)->get();
            }else{
                $PreCleaningI = MouldingPersiapan::limit(1000)->where('tujuan_kirim',Auth::user()->plant)
                ->latest()
                ->get();
            }
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
            // $PreCleaningI = MouldingPersiapan::get();
            $MasTujKir = MasterJobMoulding::get();
            $stockTGK = GradingWarnaStock::where('tujuan_kirim',Auth::user()->plant)->get();
            // return $stockTGK;
            return view('Moulding.MouldingPenerimaan.create', compact('stockTGK', 'MasTujKir'));
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

        public function CeksendData(Request $request)
        {
            // Ambil id box dari request dan konversi ke dalam array
            $idBoxes = json_decode($request->idBoxes);

            // Cek ketersediaan id box dalam database
            $unavailableBoxes = GradingWarnaStock::whereIn('id_box_grading_warna', $idBoxes)->pluck('id_box_grading_warna')->toArray();

            // Filter id box yang tidak tersedia
            $availableBoxes = array_diff($idBoxes, $unavailableBoxes);

            // Kembalikan daftar id box yang tidak tersedia sebagai respons
            return response()->json(['unavailableBoxes' => $availableBoxes]);
        }

        public function store(Request $request)
        {
            return $this->MouldingPersiapanService->store($request);
        }
        public function destroy($nomor_job): RedirectResponse
        {
            return $this->MouldingPersiapanService->destroy($nomor_job);
        }
}
