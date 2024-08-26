<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\MouldingPersiapanRework;
use App\Models\MouldingPenyebaranRework;
use Illuminate\Support\Facades\Validator;
use App\Models\MouldingPersiapanReworkStock;
use Illuminate\Support\Facades\Auth;


class MouldingPenyebaranReworkService
{
    public function store(Request $request)
    {
        // Log received data
        Log::info('Received Data:', ['data' => $request->all()]);

        // Decode JSON string to associative array
        $dataArray = json_decode($request->input('dataArray'), true);

        // Log decoded dataArray
        Log::info('Decoded Data Array:', ['dataArray' => $dataArray]);
        // var_dump($request->input('dataArray'));
        // return;
        // Check if $dataArray is empty
        if (empty($dataArray)) {
            return response()->json([
                'success' => false,
                'message' => 'Data array kosong. Tidak ada data untuk disimpan.',
                'receivedData' => $request->all() // Include received data in response
            ], 400);
        }

        foreach ($dataArray as $data) {
            // Log each item in dataArray
            Log::info('Processing Data Item:', ['data' => $data]);

            // Merge data from $dataArray
            $mergedData = array_merge($data);

            // Validate each item in dataArray
            $validator = Validator::make($mergedData, [
                'nomor_job_rework' => 'required',
                'user_created' => 'required',
            ]);

            // If validation fails, log the error and return response
            if ($validator->fails()) {
                Log::error('Validation failed:', ['errors' => $validator->errors()->toArray()]);
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed: ' . $validator->errors()->first(),
                ], 400);
            } else {
                try {
                    DB::beginTransaction();
                    // Create instance of MouldingPenyebaranRework
                    MouldingPenyebaranRework::create($mergedData);

                    $MouldingPenyebaranRework = (object) $mergedData;

                    // Ambil semua item yang sesuai dengan kriteria
                    $MouldingPersiapanStock = MouldingPersiapanReworkStock::where('nomor_job_rework', $MouldingPenyebaranRework->nomor_job_rework)
                        ->get();

                    foreach ($MouldingPersiapanStock as $item) {

                        // Update data dengan nilai baru
                        $item->update([
                            'status'       => MouldingPenyebaranRework::STATUS_ON_PROSES,
                        ]);
                    }

                    // Ambil semua item yang sesuai dengan kriteria
                    $MouldingPersiapan = MouldingPersiapanRework::where('nomor_job_rework', $MouldingPenyebaranRework->nomor_job_rework)
                        ->get();

                    foreach ($MouldingPersiapan as $items) {

                        // Update data dengan nilai baru
                        $items->update([
                            'status'       => MouldingPenyebaranRework::STATUS_NON_AKTIF,
                        ]);
                    }

                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();
                    // Log the exception message
                    Log::error('Failed to save data:', ['error' => $e->getMessage()]);
                    return response()->json([
                        'success' => false,
                        'error' => 'Failed to save data. ' . $e->getMessage(),
                        'redirectTo' => route('MouldingReworkPenyebaran.create')
                    ], 504);
                }
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Data successfully saved!',
            'redirectTo' => route('MouldingReworkPenyebaran.index')
        ], 201);
    }

    public function destroy($nomor_job_rework)
    {
        try {
            // Gunakan transaksi database untuk memastikan konsistensi
            DB::beginTransaction();

            // Ambil data PreCleaningInput berdasarkan nomor_job_rework
            $MouldingPenyebaranRework = MouldingPenyebaranRework::where('nomor_job_rework', '=', $nomor_job_rework)->get();

            if ($MouldingPenyebaranRework->isEmpty()) {
                // Redirect ke index dengan pesan error jika data tidak ditemukan
                return redirect()->route('MouldingReworkPenyebaran.index')->with(['error' => 'Data tidak ditemukan!']);
            }

            foreach ($MouldingPenyebaranRework as $mouldingPenyebaran) {
                // Hapus data PreGradingHalusInput
                $mouldingPenyebaran->delete();

                // Perbarui status PreCleaningOutput jika ada
                $MouldingStock = MouldingPersiapanReworkStock::where('nomor_job_rework', '=', $nomor_job_rework)->get();

                foreach ($MouldingStock as $mouldingStock) {
                    // Update status menjadi 1 pada MouldingStock
                    $mouldingStock->update(['status' => MouldingPenyebaranRework::STATUS_ON_STOCK]);
                }

                // Ambil semua item yang sesuai dengan kriteria
                $MouldingPersiapan = MouldingPersiapanRework::where('nomor_job_rework', $mouldingPenyebaran->nomor_job_rework)
                    ->get();

                foreach ($MouldingPersiapan as $items) {

                    // Update data dengan nilai baru
                    $items->update([
                        'status'       => MouldingPenyebaranRework::STATUS_ON_STOCK,
                    ]);
                }
            }

            // Commit transaksi
            DB::commit();

            // Redirect ke index dengan pesan sukses
            return redirect()->route('MouldingReworkPenyebaran.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();

            // Redirect ke index dengan pesan error
            return redirect()->route('MouldingReworkPenyebaran.index')->with(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
