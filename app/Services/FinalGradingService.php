<?php

namespace App\Services;

use Exception;
use App\Models\FinalGrading;
use App\Models\GradingWarna;
use Illuminate\Http\Request;
use App\Models\TransitMoulding;
use App\Models\GradingWarnaStock;
use App\Models\GradingWarnaAdding;
use Illuminate\Support\Facades\DB;
use App\Models\TransitFinalGrading;
use App\Models\TransitMouldingRework;
use Illuminate\Http\RedirectResponse;
use App\Models\GradingWarnaAddingStock;
use Illuminate\Support\Facades\Redirect;
use App\Models\TransitFinalGradingRework;
use Illuminate\Support\Facades\Validator;

class FinalGradingService
{
    protected $HppService;

    public function __construct(HppService $HppService)
    {
        $this->HppService = $HppService;
    }

    public function store(Request $request)
    {
        // Decode JSON string to associative array
        $dataArray = json_decode($request->input('dataArray'), true);

        // Validate if dataArray is empty
        if (empty($dataArray)) {
            return response()->json([
                'success' => false,
                'message' => 'Data array kosong. Tidak ada data untuk disimpan.',
            ], 400);
        }

        foreach ($dataArray as $key => $data) {
            // Calculate HPP values using HppService
            $berat_gradings[] = $data['berat_grading'];
            $harga_estimasi[] = $data['harga_estimasi'];
            $totalModal[] = $data['total_modal'];
            $jenisGradings[] = $data['jenis_grading'];
        }
        $dataHpp = $this->HppService->calculate($berat_gradings, $harga_estimasi, $totalModal, $jenisGradings);

        foreach ($dataArray as $key => $data) {
            // Update data with HPP values
            $data['total_harga'] = $dataHpp[$key]['total_harga'];
            $data['nilai_laba_rugi'] = $dataHpp[$key]['nilai_laba_rugi'];
            $data['nilai_prosentase_total_keuntungan'] = $dataHpp[$key]['nilai_prosentase_total_keuntungan'];
            $data['nilai_dikurangi_keuntungan'] = $dataHpp[$key]['nilai_setelah_dikurangi_keuntungan'];
            $data['prosentase_harga_gramasi'] = $dataHpp[$key]['prosentase_harga_gramasi'];
            $data['selisih_laba_rugi_kg'] = $dataHpp[$key]['selisih_laba_rugi_kg'];
            $data['selisih_laba_rugi_per_gram'] = $dataHpp[$key]['selisih_laba_rugi_gram'];
            $data['hpp'] = $dataHpp[$key]['hpp'];
            $data['total_hpp'] = $dataHpp[$key]['total_hpp'];
            $data['fix_hpp'] = $dataHpp[$key]['fix_hpp'];
            $data['fix_total_hpp'] = $dataHpp[$key]['fix_total_hpp'];

            // Validate each item in dataArray
            $validator = Validator::make($data, [
                'berat_grading' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed: ' . $validator->errors()->first(),
                ], 400);
            }

            try {
                DB::beginTransaction();

                // Create Grading Warna
                FinalGrading::create($data);

                $FinalGrading = (object) $data;

                // Check for rework and nomor_job_rework
                if (!empty($FinalGrading->rework) && !empty($FinalGrading->nomor_job_rework)) {
                    // Handle TransitFinalGradingRework
                    $TransitFinalGradingRework = TransitFinalGradingRework::where('nomor_job_rework', '=', $FinalGrading->nomor_job_rework)
                        ->where('job_order', '=', $FinalGrading->jenis_grading)
                        ->get();

                    $found = false;

                    foreach ($TransitFinalGradingRework as $item) {
                        $found = true;

                        // Update sisa berat and sisa pcs
                        $beratMasuk = $item->berat_job + ($FinalGrading->berat_grading ?? 0);
                        $pcsMasuk = $item->pcs_job + ($FinalGrading->pcs_grading ?? 0);

                        $item->update([
                            'berat_job' => $beratMasuk,
                            'pcs_job' => $pcsMasuk,
                        ]);
                    }

                    if (!$found) {
                        TransitFinalGradingRework::create([
                            'unit'                  => $data['unit'] ?? 'Final Grading',
                            'nomor_job_rework'      => $data['nomor_job_rework'],
                            'nomor_batch'           => $data['nomor_batch'],
                            'tujuan_kirim'          => $data['tujuan_kirim'],
                            'job_order'             => $data['jenis_grading'],
                            'berat_job'             => $data['berat_grading'],
                            'pcs_job'               => $data['pcs_grading'],
                            'modal_per_jenis'       => $data['fix_hpp'],
                            'total_modal_per_jenis' => $data['fix_total_hpp'],
                            'nama_operator'         => $data['nama_operator'],
                            'nip_operator'          => $data['nip_operator'],
                            'grade_operator'        => $data['grade_operator'],
                            'nama_team_leader'      => $data['nama_team_leader'],
                        ]);
                    }
                } else {
                    // Handle TransitFinalGrading
                    $TransitFinalGrading = TransitFinalGrading::where('nomor_job', '=', $FinalGrading->nomor_job)
                        // ->where('rework', '!=', 1)
                        ->get();

                    $found = false;

                    foreach ($TransitFinalGrading as $item) {
                        $found = true;

                        // // Update sisa berat and sisa pcs
                        // $beratMasuk = $item->berat_masuk + ($FinalGrading->berat_grading ?? 0);
                        // $pcsMasuk = $item->pcs_masuk + ($FinalGrading->pcs_grading ?? 0);
                        // $sisaBerat = $beratMasuk;
                        // $sisaPcs = $pcsMasuk;
                        // $totalModal = $item->modal * $sisaBerat;

                        // $item->update([
                        //     'berat_masuk' => $beratMasuk,
                        //     'pcs_masuk' => $pcsMasuk,
                        //     'sisa_berat' => $sisaBerat,
                        //     'sisa_pcs' => $sisaPcs,
                        //     'total_modal' => $totalModal,
                        //     'user_updated' => $FinalGrading->user_created ?? "There isn't any",
                        // ]);
                    }

                    // if (!$found) {
                    TransitFinalGrading::create([
                        'unit'                      => $data['unit'] ?? 'Final Grading',
                        'nomor_job'                 => $data['nomor_job'],
                        'nomor_batch'               => $data['nomor_batch'],
                        'tujuan_kirim'              => $data['tujuan_kirim'],
                        'job_order'                 => $data['job_order'],
                        'jenis_grading'             => $data['jenis_grading'],
                        'berat_grading'             => $data['berat_grading'],
                        'pcs_grading'               => $data['pcs_grading'],
                        'modal_per_jenis'           => $data['fix_hpp'],
                        'total_modal_per_jenis'     => $data['fix_total_hpp'],
                    ]);
                    // }
                }

                // Update Transit Moulding
                $TransitMoulding = TransitMoulding::where('nomor_job', '=', $FinalGrading->nomor_job)
                    ->get();
                foreach ($TransitMoulding as $item) {
                    $item->update([
                        'status' => FinalGrading::STATUS_NON_AKTIF,
                    ]);
                }
                // Update Transit Moulding Rework
                $TransitMouldingRework = TransitMouldingRework::where('nomor_job_rework', '=', $FinalGrading->nomor_job)
                    ->get();
                foreach ($TransitMouldingRework as $item) {
                    $item->update([
                        'status' => FinalGrading::STATUS_NON_AKTIF,
                    ]);
                }

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'error' => 'Failed to save data. ' . $e->getMessage(),
                    'redirectTo' => route('FinalGrading.create')
                ], 504);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Data successfully saved!',
            'redirectTo' => route('FinalGrading.index')
        ], 201);
    }

    public function destroy($id): RedirectResponse
    {
        try {
            // Gunakan transaksi database untuk memastikan konsistensi
            DB::beginTransaction();

            // Ambil data item berdasarkan id
            $FinalGrading = FinalGrading::find($id);

            if (!$FinalGrading) {
                // Redirect ke index dengan pesan error jika data tidak ditemukan
                return redirect()->route('FinalGrading.index')->with(['error' => 'Data tidak ditemukan!']);
            }
            // Transit Final Grading
            $TransitFinalGrading = TransitFinalGrading::where('nomor_job', '=', $FinalGrading->nomor_job)
                ->where('jenis_grading', '=', $FinalGrading->jenis_grading)
                ->first();

            if ($TransitFinalGrading) {

                $TransitFinalGrading->delete();
            }

            // Transit Final Grading
            $TransitFinalGradingRework = TransitFinalGradingRework::where('nomor_job_rework', '=', $FinalGrading->nomor_job_rework)
                ->where('job_order', '=', $FinalGrading->jenis_grading)
                ->first();

            if ($TransitFinalGradingRework) {

                // Simpan nilai sebelum dihapus
                $beratSebelumnya = $TransitFinalGradingRework->berat_job;
                $pcsSebelumnya = $TransitFinalGradingRework->pcs_job;

                // Hitung perbedaan berat dan pcs
                $beratBaru = $beratSebelumnya - $FinalGrading->berat_grading;
                $pcsBaru = $pcsSebelumnya - $FinalGrading->pcs_grading;

                if ($beratBaru <= 0 && $pcsBaru <= 0) {
                    // Hapus data TransitFinalGradingRework jika sisa_berat dan sisa_pcs baru <= 0
                    $TransitFinalGradingRework->delete();
                } else {
                    // Update data TransitFinalGradingRework dengan berat, pcs, dan sisa yang baru
                    $TransitFinalGradingRework->update([
                        'berat_job'   => $beratBaru,
                        'pcs_job'     => $pcsBaru,
                    ]);
                }
            }

            $FinalGrading->delete();

            // Ambil nomor_job dari FinalGrading yang ingin diperiksa
            $nomor_job = $FinalGrading->nomor_job;

            // Periksa apakah nomor_job sudah tidak ada di tabel FinalGrading
            $exists = FinalGrading::where('nomor_job', '=', $nomor_job)->exists();
            // Update Transit Moulding
            if (!$exists) {
                $TransitMoulding = TransitMoulding::where('nomor_job', '=', $FinalGrading->nomor_job)
                    ->get();
                foreach ($TransitMoulding as $item) {
                    $item->update([
                        'status' => FinalGrading::STATUS_AKTIF,
                    ]);
                }
            }
            // Update Transit Moulding Rework
            if (!$exists) {
                $TransitMouldingRework = TransitMouldingRework::where('nomor_job_rework', '=', $FinalGrading->nomor_job)
                    ->get();
                foreach ($TransitMouldingRework as $item) {
                    $item->update([
                        'status' => FinalGrading::STATUS_AKTIF,
                    ]);
                }
            }

            // Commit transaksi
            DB::commit();

            // Redirect ke index dengan pesan sukses
            return redirect()->route('FinalGrading.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();

            // Redirect ke index dengan pesan error
            return redirect()->route('FinalGrading.index')->with(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
