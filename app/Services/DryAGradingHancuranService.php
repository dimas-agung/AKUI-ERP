<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\InputRambangBasah;
use App\Models\RambangBasahStock;
use App\Models\RambangKeringInput;
use App\Models\RambangKeringStock;
use Illuminate\Support\Facades\DB;
use App\Models\DryAGradingHancuran;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;
use App\Models\DryAPenerimaanHancuran;
use App\Models\DryAGradingHancuranStock;
use Illuminate\Support\Facades\Validator;
use App\Models\DryAPenerimaanHancuranStock;

class DryAGradingHancuranService
{
    public function store(Request $request)
    {
        // Decode JSON string to associative array
        $dataArray = json_decode($request->input('dataArray'), true);

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
            $mergedData = array_merge($data);

            // Validasi untuk setiap item dalam dataArray
            $validator = Validator::make($mergedData, [
                'nomor_job' => 'required', // Ganti dengan nama field yang sesuai
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
                    DryAGradingHancuran::create($mergedData);

                    // DryAGradingHancuranStock::create([
                    //     'unit'                  => $mergedData['unit'] ?? 'Dry A',
                    //     'jenis_grading'         => $mergedData['jenis_grading'],
                    //     'berat_masuk'           => $mergedData['berat_grading'],
                    //     'berat_keluar'          => $mergedData['berat_keluar'] ?? 0,
                    //     'sisa_berat'            => $mergedData['berat_grading'],
                    //     'modal'                 => $mergedData['modal'] ?? 0,
                    //     'total_modal'           => $mergedData['total_modal'] ?? 0,
                    // ]);

                    // Tambahkan Jika Butuh Update
                    $DryAGradingHancuran = (object) $mergedData;

                    // Ambil semua item yang sesuai dengan kriteria
                    $DryAGradingHancuranStock = DryAGradingHancuranStock::where('jenis_grading', $DryAGradingHancuran->jenis_grading)
                        ->get();

                    $found = false;

                    foreach ($DryAGradingHancuranStock as $item) {
                        $found = true;

                        // Hitung sisa berat
                        $beratMasuk = $item->berat_masuk + ($DryAGradingHancuran->berat_grading ?? 0);
                        $sisaBerat = $beratMasuk;
                        $totalModal = $item->modal * $sisaBerat;

                        // Update data dengan nilai baru
                        $item->update([
                            'berat_masuk'  => $beratMasuk,
                            'sisa_berat'   => $sisaBerat,
                            'total_modal'  => $totalModal,
                            'user_updated' => $DryAGradingHancuran->user_created ?? "There isn't any",
                        ]);
                    }

                    if (!$found) {
                        DryAGradingHancuranStock::create([
                            'unit'                  => $mergedData['unit'] ?? 'Dry A',
                            'jenis_grading'         => $mergedData['jenis_grading'],
                            'berat_masuk'           => $mergedData['berat_grading'],
                            'berat_keluar'          => $mergedData['berat_keluar'] ?? 0,
                            'sisa_berat'            => $mergedData['berat_grading'],
                            'modal'                 => $mergedData['modal'] ?? 0,
                            'total_modal'           => $mergedData['total_modal'] ?? 0,
                        ]);
                    }

                    // Ambil semua item yang sesuai dengan kriteria
                    $DryAPenerimaanHancuranStock = DryAPenerimaanHancuranStock::where('nomor_job', $DryAGradingHancuran->nomor_job)
                        ->where('jenis_rambang', $DryAGradingHancuran->jenis_rambang)
                        ->get();

                    foreach ($DryAPenerimaanHancuranStock as $item) {

                        // Update data dengan nilai baru
                        $item->update([
                            'status'        => 0,
                        ]);
                    }

                    // Ambil semua item yang sesuai dengan kriteria
                    $DryAPenerimaanHancuran = DryAPenerimaanHancuran::where('nomor_job', $DryAGradingHancuran->nomor_job)
                        ->where('jenis_rambang', $DryAGradingHancuran->jenis_rambang)
                        ->get();

                    foreach ($DryAPenerimaanHancuran as $item) {

                        // Update data dengan nilai baru
                        $item->update([
                            'status'        => 0,
                        ]);
                    }

                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();

                    return response()->json([
                        'success' => false,
                        'error' => 'Gagal menyimpan data. ' . $e->getMessage(),
                        'redirectTo' => route('DryAGradingHancuran.create')
                    ], 504);
                }
            }
        }

        // Kembalikan data yang baru dibuat sebagai respons
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil disimpan!',
            'redirectTo' => route('DryAGradingHancuran.index')
        ], 201);
    }

    public function destroy($nomor_job)
    {
        try {
            // Log::info('Trying to delete job: ' . $nomor_job);

            // Begin transaction
            DB::beginTransaction();

            // Temukan semua record berdasarkan nomor_job
            $DryAGradingHancurans = DryAGradingHancuran::where('nomor_job', $nomor_job)->get();

            if ($DryAGradingHancurans->isEmpty()) {
                throw new \Exception('Record not found for nomor_job: ' . $nomor_job);
            }

            foreach ($DryAGradingHancurans as $DryAGradingHancuran) {
                // Log::info('Found job: ' . $DryAGradingHancuran->nomor_job);

                // Hapus semua item terkait
                $stockDry = DryAGradingHancuranStock::where('jenis_grading', '=', $DryAGradingHancuran->jenis_grading)
                    ->where('created_at', $DryAGradingHancuran->created_at)
                    ->first();

                if ($stockDry) {
                    // Log::info('Found related stock: ' . $stockDry->id);

                    if ($DryAGradingHancuran->berat_grading >= $stockDry->berat_keluar) {
                        // Hitung sisa berat
                        $beratMasuk = $stockDry->berat_masuk - ($DryAGradingHancuran->berat_grading ?? 0);
                        $sisaBerat = $beratMasuk;
                        $totalModal = $stockDry->modal * $sisaBerat;
                        // Log::info('Found related stock: ' . $stockDry->id);
                        if ($stockDry->sisa_berat === 0) {
                            $stockDry->delete();
                        } else {

                            $stockDry->update([
                                'berat_masuk'  => $beratMasuk,
                                'sisa_berat'   => $sisaBerat,
                                'total_modal'  => $totalModal,
                                'user_updated' => $DryAGradingHancuran->user_created ?? "There isn't any",
                            ]);
                        }
                        // Update data dengan nilai baru

                        // Log::info('Deleted related stock due to weight: ' . $stockDry->id);
                    }
                }

                $existingItems = DryAPenerimaanHancuranStock::where('nomor_job', $DryAGradingHancuran->nomor_job)
                    ->where('jenis_rambang', $DryAGradingHancuran->jenis_rambang)
                    ->get();

                foreach ($existingItems as $existingItem) {
                    $existingItem->update(['status' => 1]);
                }

                $DryAPenerimaanHancuran = DryAPenerimaanHancuran::where('nomor_job', $DryAGradingHancuran->nomor_job)
                    ->where('jenis_rambang', $DryAGradingHancuran->jenis_rambang)
                    ->get();

                foreach ($DryAPenerimaanHancuran as $item) {
                    $item->update(['status' => 1]);
                }

                // Hapus record utama
                $DryAGradingHancuran->delete();
            }

            // Jika tidak ada kesalahan, komit transaksi
            DB::commit();

            return redirect()->route('DryAGradingHancuran.index')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            Log::error('Error deleting job: ' . $nomor_job . ', Error: ' . $e->getMessage());

            // Jika terjadi kesalahan, rollback transaksi
            DB::rollback();

            return redirect()->route('DryAGradingHancuran.index')->with('error', 'Gagal menghapus data');
        }
    }
}
