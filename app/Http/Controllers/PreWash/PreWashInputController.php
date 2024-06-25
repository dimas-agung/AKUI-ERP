<?php

namespace App\Http\Controllers\PreWash;

use App\Models\PreWashInput;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\TransitGradingHalus;
use App\Http\Controllers\Controller;
use App\Models\GradingHalusOutput;
use App\Models\PreWashStock;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class PreWashInputController extends Controller
{
    //index
    public function index(Request $request)
    {
        $i = 1;
        // $PreWashInput = PreWashInput::all();
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = PreWashInput::query();


        if ($startDate && $endDate) {
            $query->whereBetween(PreWashInput::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), [$startDate, $endDate]);
            $PreWashInput = $query->get();
        }else{
            $PreWashInput = PreWashInput::limit(1000)
            ->latest()
            ->get();
        }
        return response()->view('PreWash.PreWashInput.index', [
            'pre_wash_inputs' => $PreWashInput,
            'i' => $i,
        ]);
    }

    // create
    // public function create()
    // {
    //     $PreWashInput = PreWashInput::with('TransitGradingHalus')->get();
    //     return response()->view('PreWash.PreWashInput.create', compact('PreWashInput'));
    // }
    // create
    public function create()
    {
        // $PreWashInput = PreWashInput::with('TransitGradingHalus')->get();
        $TransitGradingHalus = TransitGradingHalus::where('status',1)->get();
        return view('PreWash.PreWashInput.create', [
            // 'pre_grading_halus_stocks' => $AdjustmentAdding,
            // 'grading_halus_stocks' => $PreWashInput,
            'transit_grading_haluses' => $TransitGradingHalus,
        ]);
    }
    // Set Nomor BSTB
    public function set(Request $request)
    {
        $nomor_bstb = $request->nomor_bstb;
        $data = TransitGradingHalus::where('nomor_bstb', $nomor_bstb)->get();

        return response()->json($data);
    }

    public function CeksendData(Request $request)
    {
        // Ambil id box dari request dan konversi ke dalam array
        $idNomorBSTB = json_decode($request->idNomorBSTB);

        // Cek ketersediaan id box dalam database
        $unavailableNomorBSTB = TransitGradingHalus::whereIn('nomor_bstb', $idNomorBSTB)->pluck('nomor_bstb')->toArray();
        // return $unavailableNomorBSTB;
        // Filter id box yang tidak tersedia
        $availableNomorBSTB = array_diff($idNomorBSTB, $unavailableNomorBSTB);
        // return $availableNomorBSTB;
        // Kembalikan daftar id box yang tidak tersedia sebagai respons
        return response()->json(['unavailableNomorBSTB' => $availableNomorBSTB]);
    }

    // Contoh controller
    public function store(Request $request)
    {
        // Decode JSON string to associative array
        $dataArray = json_decode($request->input('dataArray'), true);

        // Validate other form fields
        $validatedData = $request->validate([
            // 'doc_no'            => 'required',
            'user_created'      => 'required',
            'user_updated'      => 'sometimes',
            'keterangan'        => 'sometimes',
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
                    PreWashInput::create($mergedData);

                    PreWashStock::create([
                        'unit'                  => 'Pre Wash',
                        'nomor_job'             => $mergedData['nomor_job'],
                        'nomor_batch'           => $mergedData['nomor_batch'],
                        'jenis_job'             => $mergedData['jenis_job'],
                        'berat_job'             => $mergedData['berat_job'],
                        'pcs_job'               => $mergedData['pcs_job'],
                        'upah_operator'         => $mergedData['upah_operator'],
                        'tujuan_kirim'          => $mergedData['tujuan_kirim'],
                        'modal'                 => $mergedData['modal'],
                        'total_modal'           => $mergedData['total_modal'],
                        'keterangan'            => $mergedData['keterangan'] ?? 0,
                        'user_created'          => $mergedData['user_created'],
                        'user_update'           => $mergedData['user_updated'] ?? `"There isn't any"`,
                    ]);

                    // Tambahkan Jika Butuh Update
                    $itemObject = (object) $mergedData;

                    // Ambil semua item yang sesuai dengan kriteria
                    $existingItems = TransitGradingHalus::where('nomor_job', $itemObject->nomor_job)
                        ->where('nomor_bstb', $itemObject->nomor_bstb)
                        ->get();

                    foreach ($existingItems as $existingItem) {

                        // Update data dengan nilai baru
                        $existingItem->update([
                            'status'      => 0,
                            // 'user_updated' => $itemObject->user_created ?? " ",
                        ]);
                    }

                    // Ambil semua item yang sesuai dengan kriteria
                    $GradingHalusOutput = GradingHalusOutput::where('nomor_job', $itemObject->nomor_job)
                        ->where('nomor_bstb', $itemObject->nomor_bstb)
                        ->get();

                    foreach ($GradingHalusOutput as $item) {

                        // Update data dengan nilai baru
                        $item->update([
                            'status'      => 0,
                            // 'user_updated' => $itemObject->user_created ?? " ",
                        ]);
                    }

                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();

                    return response()->json([
                        'success' => false,
                        'error' => 'Gagal menyimpan data. ' . $e->getMessage(),
                        'redirectTo' => route('PreWashInput.create')
                    ], 504);
                }
            }
        }

        // Kembalikan data yang baru dibuat sebagai respons
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil disimpan!',
            'redirectTo' => route('PreWashInput.index')
        ], 201);
    }


    public function destroy($nomor_bstb)
    {
        try {
            // Begin transaction
            DB::beginTransaction();

            // Temukan semua record berdasarkan nomor_bstb
            $pengirimanWastes = PreWashInput::where('nomor_bstb', $nomor_bstb)->get();

            if ($pengirimanWastes->isEmpty()) {
                throw new \Exception('Data tidak ditemukan');
            }

            foreach ($pengirimanWastes as $RambangPengirimanWaste) {
                // Hapus semua item terkait di TransitRambangWaste
                $stockTrans = PreWashStock::where('nomor_job', '=', $RambangPengirimanWaste->nomor_job)->first();
                // $stockTrans->delete();
                if ($stockTrans) {
                    // Jika berat atau total modal dari StockTransitRawMaterial bernilai 0, maka hapus data
                    if ($stockTrans->status === 1) {
                        $stockTrans->delete();
                    } else {
                    }
                }

                // Temukan semua item terkait di RambangKeringStock
                $existingItems = TransitGradingHalus::where('nomor_job', $RambangPengirimanWaste->nomor_job)
                    ->where('nomor_bstb', $RambangPengirimanWaste->nomor_bstb)
                    ->get();

                // Logika Update Status
                foreach ($existingItems as $existingItem) {
                    if ($existingItem) {

                        $existingItem->update(['status' => 1]);
                    }
                }

                $GradingHalusOutput = GradingHalusOutput::where('nomor_job', $RambangPengirimanWaste->nomor_job)
                    ->where('nomor_bstb', $RambangPengirimanWaste->nomor_bstb)
                    ->get();

                // Logika Update Status
                foreach ($GradingHalusOutput as $item) {
                    if ($item) {

                        $item->update(['status' => 1]);
                    }
                }

                // Hapus record utama
                $RambangPengirimanWaste->delete();
            }

            // Jika tidak ada kesalahan, komit transaksi
            DB::commit();

            return redirect()->route('PreWashInput.index')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, rollback transaksi
            DB::rollback();

            return redirect()->route('PreWashInput.index')->with('error', 'Gagal menghapus data');
        }
    }
}
