<?php

namespace App\Services;

use DateTime;
use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\MouldingStock;
use App\Models\TransitMoulding;
use App\Models\MouldingPenyebaran;
use Illuminate\Support\Facades\DB;
use App\Models\MouldingPengembalian;
use App\Models\TransitMouldingRework;
use App\Models\MouldingPenyebaranRework;
use Illuminate\Support\Facades\Validator;
use App\Models\MouldingPengembalianRework;
use App\Models\MouldingPersiapanReworkStock;

class MouldingPengembalianReworkService
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
                'nomor_job_rework' => 'required', // Ganti dengan nama field yang sesuai
                'user_created' => 'required', // Ganti dengan nama field yang sesuai
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
                    MouldingPengembalianRework::create($mergedData);

                    TransitMouldingRework::create([
                        'unit'                      => $mergedData['unit'] ?? 'Moulding Rework',
                        'nomor_job_rework'          => $mergedData['nomor_job_rework'],
                        'nomor_batch'               => $mergedData['nomor_batch'],
                        'tujuan_kirim'              => $mergedData['tujuan_kirim'],
                        'job_order'                 => $mergedData['job_order'],
                        'berat_job'                 => $mergedData['berat_job'],
                        'pcs_job'                   => $mergedData['pcs_job'],
                        'modal'                     => $mergedData['modal'],
                        'total_modal'               => $mergedData['total_modal'],
                        'nama_operator'             => $mergedData['nama_operator'],
                        'nip_operator'              => $mergedData['nip_operator'],
                        'grade_operator'            => $mergedData['grade_operator'],
                        'nama_team_leader'          => $mergedData['nama_team_leader'],
                        'keterangan'                => $mergedData['keterangan'],
                    ]);

                    $MouldingPengembalian = (object) $mergedData;

                    // Ambil semua item yang sesuai dengan kriteria
                    $MouldingStock = MouldingPersiapanReworkStock::where('nomor_job_rework', $MouldingPengembalian->nomor_job_rework)
                        ->get();

                    foreach ($MouldingStock as $item) {

                        // Update data dengan nilai baru
                        $item->update([
                            'status'             => MouldingPengembalianRework::STATUS_FINISHED
                        ]);
                    }
                    // Ambil semua item yang sesuai dengan kriteria
                    $MouldingPenyebaran = MouldingPenyebaranRework::where('nomor_job_rework', $MouldingPengembalian->nomor_job_rework)
                        ->get();

                    foreach ($MouldingPenyebaran as $item) {

                        // Update data dengan nilai baru
                        $item->update([
                            'user_updated'       => $MouldingPengembalian->user_created,
                            'status'             => MouldingPengembalianRework::STATUS_NON_AKTIF,
                        ]);
                    }

                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();

                    return response()->json([
                        'success' => false,
                        'error' => 'Gagal menyimpan data. ' . $e->getMessage(),
                        'redirectTo' => route('MouldingReworkPengembalian.create')
                    ], 504);
                }
            }
        }

        // Kembalikan data yang baru dibuat sebagai respons
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil disimpan!',
            'redirectTo' => route('MouldingReworkPengembalian.index')
        ], 201);
    }

    public function destroy($nomor_job_rework)
    {
        try {
            // Gunakan transaksi database untuk memastikan konsistensi
            DB::beginTransaction();

            // Ambil data PreCleaningInput berdasarkan nomor_bstb
            $MouldingPengembalian = MouldingPengembalianRework::where('nomor_job_rework', '=', $nomor_job_rework)->get();

            if ($MouldingPengembalian->isEmpty()) {
                // Redirect ke index dengan pesan error jika data tidak ditemukan
                return redirect()->route('MouldingReworkPengembalian.index')->with(['error' => 'Data tidak ditemukan!']);
            }

            foreach ($MouldingPengembalian as $mouldingPengembalian) {
                // Ambil data TransitMoulding berdasarkan nomor job dan nomor bstb
                $TransitMoulding = TransitMouldingRework::where('nomor_job_rework', '=', $mouldingPengembalian->nomor_job_rework)
                    ->first();

                $mouldingPengembalian->delete();
                if ($TransitMoulding) {
                    $TransitMoulding->delete();
                }

                // Perbarui status PreCleaningOutput jika ada
                $MouldingStock = MouldingPersiapanReworkStock::where('nomor_job_rework', $mouldingPengembalian->nomor_job_rework)
                    ->get();

                // Logika Update Status
                if ($MouldingStock->isNotEmpty()) {
                    foreach ($MouldingStock as $item) {
                        // Perbarui data untuk setiap item yang ada
                        $item->update(['status' => MouldingPengembalianRework::STATUS_ON_STOCK]);
                    }
                }
            }

            // Perbarui status PreCleaningOutput jika ada
            $MouldingPenyebaran = MouldingPenyebaranRework::where('nomor_job_rework', $mouldingPengembalian->nomor_job_rework)
                ->get();

            // Logika Update Status
            if ($MouldingPenyebaran->isNotEmpty()) {
                foreach ($MouldingPenyebaran as $item) {
                    // Perbarui data untuk setiap item yang ada
                    $item->update([
                        'user_updated'       => $mouldingPengembalian->user_created,
                        'status'             => MouldingPengembalianRework::STATUS_ON_STOCK
                    ]);
                }
            }

            // Commit transaksi
            DB::commit();

            // Redirect ke index dengan pesan sukses
            return redirect()->route('MouldingReworkPengembalian.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();

            // Redirect ke index dengan pesan error
            return redirect()->route('MouldingReworkPengembalian.index')->with(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
