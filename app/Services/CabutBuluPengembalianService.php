<?php

namespace App\Services;

use App\Models\CabutBuluPengembalian;
use App\Models\TransitCabutBulu;
use Illuminate\Http\Request;
use App\Models\PreWashOutput;
use App\Models\CabutBuluPenerimaan;
use App\Models\CabutBuluPenyebaran;
use App\Models\CabutBuluStock;
use App\Models\TransitPreWash;
use Carbon\Carbon;
use DateTime;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;

class CabutBuluPengembalianService
{
    public function store(Request $request)
    {
        // Decode JSON string to associative array
        $dataArray = json_decode($request->input('dataArray'), true);

        // Validate other form fields
        $validatedData = $request->validate([
            'user_created' => 'required',
            'waktu_pengembalian' => 'required', // Menambahkan validasi waktu penyebaran
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
                    // Ubah format tanggal waktu_pengembalian menjadi Y-m-d H:i:s
                    $waktuPengembalianFormatted = date("Y-m-d H:i:s", strtotime($mergedData['waktu_pengembalian']));

                    // Pastikan timestamp dalam format yang benar
                    $waktuPenyebaran = new DateTime($mergedData['waktu_penyebaran']);// Buat objek DateTime dari tanggal yang diformat
                    $waktuPengembalian = DateTime::createFromFormat('Y-m-d H:i:s', $waktuPengembalianFormatted);

                    // Jika salah satu waktu tidak valid, lempar pengecualian
                    if (!$waktuPenyebaran || !$waktuPengembalian) {
                        throw new Exception("Format waktu tidak valid.");
                    }

                    // Debugging: Pastikan bahwa nilai timestamp benar
                    // if ($waktuPenyebaran >= $waktuPengembalian) {
                    //     throw new Exception("Timestamp penyebaran harus lebih kecil dari timestamp pengembalian.");
                    // }
                    // Buat objek DateTime dari timestamp
                    // $waktuPenyebaran = (new DateTime())->setTimestamp($waktuPenyebaranTimestamp);
                    // $waktuPengembalian = (new DateTime())->setTimestamp($waktuPengembalianTimestamp);

                    // Menghitung selisih waktu dalam detik
                    $t1 = Carbon::parse($mergedData['waktu_penyebaran']);
                    $t2 = Carbon::parse(date('Y-m-d H:i:s'));
                    $interval = $t1->diff($t2);
                    // $interval = $waktuPenyebaran->diff($waktuPengembalian);
                    $selisihDetik = $interval->days * 24 * 60 * 60 + $interval->h * 60 * 60 + $interval->i * 60 + $interval->s;
                    // $selisihDetik = $waktuPengembalianTimestamp - $waktuPenyebaranTimestamp;
                    // Debugging: Pastikan bahwa selisih detik dihitung dengan benar
                                // Menghitung selisih waktu dalam detik
            // $selisihDetik = $waktuPengembalian->getTimestamp() - $waktuPenyebaran->getTimestamp();


                    // Tambahkan selisih detik ke data yang akan disimpan
                    $mergedData['lama_pengerjaan'] = $selisihDetik;

                    DB::beginTransaction();

                    // Buat instansi PreCleaningInput
                    // CabutBuluPengembalian::create(array_merge($mergedData, ['waktu_pengembalian' => $validatedData['waktu_pengembalian']]));
                    CabutBuluPengembalian::create($mergedData);

                    TransitCabutBulu::create([
                        'workstation'           => $mergedData['workstation'] ?? 'Cleaning',
                        'unit'                  => $mergedData['unit'] ?? 'Cabut Bulu',
                        'nomor_job'             => $mergedData['nomor_job'],
                        'nomor_batch'           => $mergedData['nomor_batch'],
                        'jenis_job'             => $mergedData['jenis_job'],
                        'berat_job'             => $mergedData['berat_job'] ?? 0,
                        'pcs_job'               => $mergedData['pcs_job'] ?? 0,
                        'upah_operator'          => $mergedData['upah_operator'] ?? 0,
                        'tujuan_kirim'          => $mergedData['tujuan_kirim'] ?? 0,
                        'keterangan'            => $mergedData['keterangan_2'] ?? 0,
                        'nama_operator'         => $mergedData['nama_operator'] ?? 0,
                        'nip_operator'          => $mergedData['nip_operator'] ?? 0,
                        'grade_operator'        => $mergedData['grade_operator'] ?? 0,
                        'nama_team_leader'      => $mergedData['nama_team_leader'] ?? 0,
                        'modal'                 => $mergedData['modal'] ?? 0,
                        'total_modal'           => $mergedData['total_modal'] ?? 0,
                        'status'                => $mergedData['status'] ?? 1,
                    ]);

                    $itemObject = (object) $mergedData;

                    // Update status di CabutBuluStock
                    $cabutBuluStockItems = CabutBuluStock::where('nomor_job', $itemObject->nomor_job)->get();

                    foreach ($cabutBuluStockItems as $cabutBuluStockItem) {
                        $cabutBuluStockItem->update([
                            'status' => CabutBuluStock::STATUS_FINISHED,
                        ]);
                    }

                    // Update status di CabutBuluPenyebaran
                    $cabutBuluPenyebaranItems = CabutBuluPenyebaran::where('nomor_job', $itemObject->nomor_job)->get();

                    foreach ($cabutBuluPenyebaranItems as $cabutBuluPenyebaranItem) {
                        $cabutBuluPenyebaranItem->update([
                            'status' => CabutBuluPenyebaran::STATUS_FINISHED,
                        ]);
                    }


                    DB::commit();
                } catch (Exception $e) {
                    DB::rollBack();

                    return response()->json([
                        'success' => false,
                        'error' => 'Gagal menyimpan data. ' . $e->getMessage(),
                        'redirectTo' => route('CabutBuluPenyebaran.create')
                    ], 504);
                }
            }
        }

        // Kembalikan data yang baru dibuat sebagai respons
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil disimpan!',
            'redirectTo' => route('CabutBuluPengembalian.index')
        ], 201);
    }

    public function destroy($nomor_job)
    {
        try {
            // Gunakan transaksi database untuk memastikan konsistensi
            DB::beginTransaction();

            // Ambil data PreCleaningInput berdasarkan nomor_bstb
            $PreGradingHalusInputs = CabutBuluPengembalian::where('nomor_job', '=', $nomor_job)->get();
            // $PreGradingHalusInputs = PreGradingHalusInput::findOrFail($id);

            if ($PreGradingHalusInputs->isEmpty()) {
                // Redirect ke index dengan pesan error jika data tidak ditemukan
                // return redirect()->route('CabutBuluPengembalian.index')->with(['error' => 'Data tidak ditemukan!']);
            }

            foreach ($PreGradingHalusInputs as $PreCleaningI) {
                // Ambil data PreCleaningStock berdasarkan nomor job dan nomor bstb
                $PreCleaningS = TransitCabutBulu::where('nomor_job', '=', $PreCleaningI->nomor_job)
                    // ->where('nomor_bstb', '=', $PreCleaningI->nomor_bstb)
                    ->first();

                // if ($PreCleaningS) {
                //     // Ambil data TransitPreCleaningStock berdasarkan nomor job dan nomor bstb
                //     $stockPrmRawMaterial = TransitPreWash::where('nomor_job', '=', $PreCleaningI->nomor_job)
                //         ->where('nomor_bstb', '=', $PreCleaningI->nomor_bstb)
                //         ->first();

                //     if ($stockPrmRawMaterial) {
                //         // Simpan nilai sebelum dihapus
                //         $beratSebelumnya = $stockPrmRawMaterial->berat_job;
                //         $pcsSebelumnya = $stockPrmRawMaterial->pcs_job;

                //         // Hitung total modal baru berdasarkan perbedaan berats
                //         $perbedaanBerat = $beratSebelumnya + $PreCleaningI->berat_job;
                //         $perbedaanPcs = $pcsSebelumnya + $PreCleaningI->pcs_job;
                //         // $totalModalBaru = $perbedaanBerat * $PreCleaningI->modal;

                //         // Update data TransitPreCleaningStock dengan berat, pcs, dan total modal yang baru
                //         $stockPrmRawMaterial->update([
                //             'berat_job' => max($perbedaanBerat, 0),
                //             'pcs_job' => max($perbedaanPcs, 0),
                //             // 'total_modal' => max($totalModalBaru, 0),
                //         ]);
                //     }
                // }

                // Hapus data PreGradingHalusInput dan PreCleaningStock
                $PreCleaningI->delete();
                if ($PreCleaningS) {
                    $PreCleaningS->delete();
                }

                // Perbarui status PreCleaningOutput jika ada
                $existingItems = CabutBuluStock::where('nomor_job', $PreCleaningI->nomor_job)
                    // ->where('nomor_bstb', $PreCleaningI->nomor_bstb)
                    ->get();

                // Logika Update Status
                if ($existingItems->isNotEmpty()) {
                    foreach ($existingItems as $existingItem) {
                        // Perbarui data untuk setiap item yang ada
                        $existingItem->update(['status' => CabutBuluPengembalian::STATUS_ON_PROSES]);
                    }
                }
            }

            // Commit transaksi
            DB::commit();

            // Redirect ke index dengan pesan sukses
            return redirect()->route('CabutBuluPengembalian.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();

            // Redirect ke index dengan pesan error
            return redirect()->route('CabutBuluPengembalian.index')->with(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
