<?php

namespace App\Services;

use App\Models\KedatanganOutput;
use App\Models\TransitKedatangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class KedatanganOutputService
{
    public function store(Request $request)
    {
        // Decode JSON string to associative array
        $dataArray = json_decode($request->input('dataArray'), true);

        // Check if $dataArray or $tableDataArray is empty
        if (empty($dataArray)) {
            return response()->json([
                'success' => false,
                'message' => 'Data array kosong. Tidak ada data untuk disimpan.',
            ], 400);
        }

        // Loop through each item in dataArray
        foreach ($dataArray as $data) {

            $validator = Validator::make($data, [
                'nomor_batch' => 'required',
                'nomor_bstb' => 'required',
            ]);

            // If validation fails, return error message
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed: ' . $validator->errors()->first(),
                ], 400);
            } else {
                try {
                    DB::beginTransaction();

                    KedatanganOutput::create($data);

                    TransitKedatangan::create([
                        'unit'              => $data['unit'] ?? 'Kedatangan',
                        'nomor_batch'       => $data['nomor_batch'],
                        'jenis'             => $data['jenis'],
                        'berat'             => $data['berat'],
                        'pcs'               => $data['pcs'],
                        'tujuan_kirim'      => $data['tujuan_kirim'],
                        'keterangan'        => $data['keterangan'],
                        'nomor_job'         => $data['nomor_job'],
                        'nomor_bstb'        => $data['nomor_bstb'],
                        'modal'             => $data['modal'] ?? 0,
                        'total_modal'       => $data['total_modal'] ?? 0,
                    ]);

                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();

                    return response()->json([
                        'success' => false,
                        'error' => 'Failed to save data. ' . $e->getMessage(),
                        'redirectTo' => route('KedatanganOutput.create')
                    ], 504);
                }
            }
        }
        // Return newly created data as response
        return response()->json([
            'success' => true,
            'message' => 'Data successfully saved!',
            'redirectTo' => route('KedatanganOutput.index')
        ], 201);
    }

    public function destroy($id): RedirectResponse
    {
        try {
            // Mulai transaksi database
            DB::beginTransaction();

            // Ambil data item berdasarkan id
            $KedatanganOutput = KedatanganOutput::find($id);

            if (!$KedatanganOutput) {
                // Redirect ke index dengan pesan error jika data tidak ditemukan
                return redirect()->route('KedatanganOutput.index')->with(['error' => 'Data tidak ditemukan!']);
            }

            // Ambil semua data dengan nomor_batch dan nomor_bstb yang sama dari tabel TransitKedatangan
            $TransitKedatangan = TransitKedatangan::where('nomor_batch', '=', $KedatanganOutput->nomor_batch)
                ->where('nomor_job', '=', $KedatanganOutput->nomor_job)
                ->get();

            // Hapus data dari tabel TransitKedatangan
            foreach ($TransitKedatangan as $item) {
                $item->delete();
            }

            // Hapus data dari tabel KedatanganOutput
            $KedatanganOutput->delete();

            // Commit transaksi
            DB::commit();

            // Redirect ke index dengan pesan sukses
            return redirect()->route('KedatanganOutput.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();

            // Redirect ke index dengan pesan error
            return redirect()->route('KedatanganOutput.index')->with(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
