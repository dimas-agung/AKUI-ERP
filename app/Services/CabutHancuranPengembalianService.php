<?php

namespace App\Services;

use DateTime;
use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\TransitCabutBuluHancuran;
use App\Models\CabutHancuranPengembalian;
use App\Models\CabutHancuranPenyebaran;
use App\Models\CabutHancuranPersiapanStock;
use Illuminate\Support\Facades\Validator;

class CabutHancuranPengembalianService
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
                    $waktuPenyebaran = new DateTime($mergedData['waktu_penyebaran']); // Buat objek DateTime dari tanggal yang diformat
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
                    // CabutHancuranPengembalian::create(array_merge($mergedData, ['waktu_pengembalian' => $validatedData['waktu_pengembalian']]));
                    CabutHancuranPengembalian::create($mergedData);

                    TransitCabutBuluHancuran::create([
                        'workstation'           => $mergedData['workstation'] ?? 'Cleaning',
                        'unit'                  => $mergedData['unit'] ?? 'Cabut Hancuran',
                        'nomor_job'             => $mergedData['nomor_job'],
                        'jenis_rambang'         => $mergedData['jenis_rambang'],
                        'upah_operator'         => $mergedData['upah_operator'],
                        'berat'                 => $mergedData['berat'] ?? 0,
                        'nama_operator'         => $mergedData['nama_operator'],
                        'nip_operator'          => $mergedData['nip_operator'],
                        'grade_operator'        => $mergedData['grade_operator'],
                        'nama_team_leader'      => $mergedData['nama_team_leader'],
                        'waktu_penyebaran'      => $mergedData['waktu_penyebaran'],
                        'waktu_pengembalian'    => $mergedData['waktu_pengembalian'],
                        'status'                => $mergedData['status'] ?? 1,
                    ]);

                    $itemObject = (object) $mergedData;

                    // Ambil semua item yang sesuai dengan kriteria
                    $existingItems = CabutHancuranPersiapanStock::where('nomor_job', $itemObject->nomor_job)
                        ->get();

                    foreach ($existingItems as $existingItem) {

                        // Update data dengan nilai baru
                        $existingItem->update([
                            'berat_keluar'       => $itemObject->berat,
                            'sisa_berat'         => $itemObject->sisa_berat ?? 0,
                            'status'             => $itemObject->status ?? 3,
                        ]);
                    }
                    // Ambil semua item yang sesuai dengan kriteria
                    $CabutHancuranPenyebaran = CabutHancuranPenyebaran::where('nomor_job', $itemObject->nomor_job)
                        ->get();

                    foreach ($CabutHancuranPenyebaran as $item) {

                        // Update data dengan nilai baru
                        $item->update([
                            'status'             => $itemObject->status ?? 0,
                        ]);
                    }

                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();

                    return response()->json([
                        'success' => false,
                        'error' => 'Gagal menyimpan data. ' . $e->getMessage(),
                        'redirectTo' => route('CabutHancuranPengembalian.create')
                    ], 504);
                }
            }
        }

        // Kembalikan data yang baru dibuat sebagai respons
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil disimpan!',
            'redirectTo' => route('CabutHancuranPengembalian.index')
        ], 201);
    }

    public function destroy($nomor_job)
    {
        try {
            // Gunakan transaksi database untuk memastikan konsistensi
            DB::beginTransaction();

            // Ambil data PreCleaningInput berdasarkan nomor_bstb
            $CabutHancuranPengembalian = CabutHancuranPengembalian::where('nomor_job', '=', $nomor_job)->get();

            if ($CabutHancuranPengembalian->isEmpty()) {
                // Redirect ke index dengan pesan error jika data tidak ditemukan
                return redirect()->route('CabutHancuranPengembalian.index')->with(['error' => 'Data tidak ditemukan!']);
            }

            foreach ($CabutHancuranPengembalian as $CabutHcr) {
                // Ambil data PreCleaningStock berdasarkan nomor job dan nomor bstb
                $PreCleaningS = TransitCabutBuluHancuran::where('nomor_job', '=', $CabutHcr->nomor_job)
                    ->first();

                // Hapus data PreGradingHalusInput dan PreCleaningStock
                $CabutHcr->delete();
                if ($PreCleaningS) {
                    $PreCleaningS->delete();
                }

                // Perbarui status PreCleaningOutput jika ada
                $existingItems = CabutHancuranPersiapanStock::where('nomor_job', $CabutHcr->nomor_job)
                    ->get();

                // Logika Update Status
                if ($existingItems->isNotEmpty()) {
                    foreach ($existingItems as $existingItem) {
                        // Perbarui data untuk setiap item yang ada
                        $existingItem->update(['berat_keluar' => 0]);
                        $existingItem->update(['sisa_berat' => $existingItem->berat_masuk]);
                        $existingItem->update(['status' => 2]);
                    }
                }
            }

            // Perbarui status PreCleaningOutput jika ada
            $CabutHancuranPenyebaran = CabutHancuranPenyebaran::where('nomor_job', $CabutHcr->nomor_job)
                ->get();

            // Logika Update Status
            if ($CabutHancuranPenyebaran->isNotEmpty()) {
                foreach ($CabutHancuranPenyebaran as $item) {
                    // Perbarui data untuk setiap item yang ada
                    $item->update(['status' => 1]);
                }
            }

            // Commit transaksi
            DB::commit();

            // Redirect ke index dengan pesan sukses
            return redirect()->route('CabutHancuranPengembalian.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();

            // Redirect ke index dengan pesan error
            return redirect()->route('CabutHancuranPengembalian.index')->with(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
