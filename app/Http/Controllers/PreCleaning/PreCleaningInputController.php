<?php

namespace App\Http\Controllers\PreCleaning;

use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use App\Models\PreCleaningInput;
use App\Models\StockTransitGradingKasar;
use App\Models\PreCleaningStock;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
//return type View
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PreCleaningInputController extends Controller
{
    //Index
    public function index(){
        $i =1;
        $PreCleaningI = PreCleaningInput::with('StockTransitGradingKasar')->get();

        // return $GradingKI;
        return response()->view('PreCleaning.PreCleaningInput.index', [
            'PreCleaningI' => $PreCleaningI,
            'i' => $i,
        ]);
    }

        /**
     * Create
     */
    public function create(): View
    {
        $PreCleaningI = PreCleaningInput::with('StockTransitGradingKasar')->get();
        $stockTGK = StockTransitGradingKasar::with('PreCleaningInput')->get();
        // return $PrmRawMOIC;
        return view('PreCleaning.PreCleaningInput.create', compact('stockTGK', 'PreCleaningI'));
    }

    public function set(Request $request)
    {
        $nomor_bstb = $request->nomor_bstb;
        $data = StockTransitGradingKasar::where('nomor_bstb',$nomor_bstb)->first();
        $data = StockTransitGradingKasar::where('nomor_bstb',$nomor_bstb)->get();

        // Kembalikan nomor batch sebagai respons
        return response()->json($data);
    }

    // Contoh controller
    public function store(Request $request)
    {
        // Decode JSON string to associative array
        $dataArray = json_decode($request->input('dataArray'), true);

        // Validate other form fields
        $validatedData = $request->validate([
            'doc_no' => 'required',
            'user_created' => 'required',
            'user_updated' => 'required',
            'keterangan' => 'required',
        ]);

        // Check if $dataArray is empty
        if (empty($dataArray)) {
            return response()->json([
                'success' => false,
                'message' => 'Data array kosong. Tidak ada data untuk disimpan.',
            ], 400);
        }

        // Loop melalui setiap item dalam dataArray
        foreach ($dataArray as $data) {
            // Gabungkan data dari $validatedData dan $data
            $mergedData = array_merge($validatedData, $data);

            // Validasi untuk setiap item dalam dataArray
            $validator = Validator::make($mergedData, [
                'nomor_bstb' => 'required', // Ganti dengan nama field yang sesuai
                // ... tambahkan validasi lain sesuai kebutuhan
            ]);

            // Jika validasi gagal, kembalikan pesan error
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal: ' . $validator->errors()->first(),
                ], 400);
            } else {
                try {
                    DB::beginTransaction();

                    // Buat instansi PreCleaningInput
                    PreCleaningInput::create($mergedData);

                    PreCleaningStock::create([
                        'nomor_job'    => $mergedData['nomor_job'],
                        'id_box_grading_kasar'    => $mergedData['id_box_grading_kasar'],
                        'nomor_bstb'    => $mergedData['nomor_bstb'],
                        'nomor_batch'   => $mergedData['nomor_batch'],
                        'nama_supplier' => $mergedData['nama_supplier'],
                        'id_box_raw_material'         => $mergedData['id_box_raw_material'],
                        'jenis_raw_material'         => $mergedData['jenis_raw_material'],
                        'avg_kadar_air'     => $mergedData['kadar_air'],
                        'tujuan_kirim'  => $mergedData['tujuan_kirim'],
                        'jenis_kirim'  => $mergedData['jenis_kirim'],
                        'berat_keluar'=> $mergedData['berat_kirim'] ?? 0,
                        'berat_masuk'=> $mergedData['berat_keluar'] ?? 0,
                        'pcs_keluar'=> $mergedData['pcs_keluar'] ?? 0,
                        'pcs_masuk'=> $mergedData['pcs_keluar'] ?? 0,
                        'nomor_grading'=> $mergedData['pcs_kirim'],
                        'modal'         => $mergedData['modal'],
                        'total_modal'         => $mergedData['total_modal'],
                        'keterangan'         => $mergedData['keterangan'],
                        'user_created'  => $mergedData['user_created'],
                        'user_update'  => $mergedData['user_updated'] ?? "There isn't any",
                        'nomor_nota_internal'   => $mergedData['nomor_nota_internal']
                    ]);

                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();

                    return [
                        'success' => false,
                        'error' => 'Gagal menyimpan data. ' . $e->getMessage(),
                    ];
                }
            }
        }

        // Kembalikan data yang baru dibuat sebagai respons
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil disimpan!',
            'redirectTo' => route('PreCleaningInput.index')
        ], 201);
    }
    public function destroy($id): RedirectResponse
    {
        try {
            // Gunakan transaksi database untuk memastikan konsistensi
            DB::beginTransaction();
            //get post by ID
            $PreCleaningI = PreCleaningInput::findOrFail($id);
            $PreCleaningS = PreCleaningStock::where('id_box_grading_kasar', '=', $PreCleaningI->id_box_grading_kasar)
            ->where('id_box_raw_material', $PreCleaningI->id_box_raw_material)
            ->first();

            //delete post
            $PreCleaningI->delete();
            $PreCleaningS->delete();

            //redirect to index
            DB::commit();
            return redirect()->route('PreCleaningInput.index')->with(['success' => 'Data Berhasil Dihapus!']);

        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();

            // Redirect ke index dengan pesan error
            return redirect()->route('PreCleaningInput.create')->with(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
