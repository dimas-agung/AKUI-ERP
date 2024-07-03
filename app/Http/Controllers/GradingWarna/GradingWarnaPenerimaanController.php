<?php

namespace App\Http\Controllers\GradingWarna;

use App\Http\Controllers\Controller;
use App\Models\DryAOutputCabut;
use App\Models\DryAOutputHancuran;
use App\Models\GradingWarnaPenerimaan;
use App\Models\GradingWarnaPenerimaanStock;
use Illuminate\Http\RedirectResponse;
use App\Models\TransitDryACabut;
use App\Models\TransitDryAHancuran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class GradingWarnaPenerimaanController extends Controller
{
    public function index(){
        $i =1;
        $PreGHI = GradingWarnaPenerimaan::get();
        // return $GradingKI;

        return response()->view('GradingWarna.GradingWarnaPenerimaan.index', [
            'PreGHI' => $PreGHI,
            'i' => $i,
        ]);
    }

    public function create(): View
    {
        $stockTGK = TransitDryAHancuran::get();
        $stockT = TransitDryACabut::get();
        // return $PrmRawMOIC;
        return view('GradingWarna.GradingWarnaPenerimaan.create', compact('stockTGK', 'stockT'));
    }

    public function getDataHancuran()
    {
        $data = TransitDryAHancuran::where('status','=','1')->get();

        // Kembalikan nomor batch sebagai respons
        return response()->json($data);
    }
    public function getDataCabut()
    {
        $data = TransitDryACabut::where('status','=','1')->get();

        // Kembalikan nomor batch sebagai respons
        return response()->json($data);
    }

    public function setHancuran(Request $request)
    {
        $nomor_bstb = $request->nomor_bstb;
        $data = TransitDryAHancuran::where('nomor_bstb',$nomor_bstb)->first();
        $data = TransitDryAHancuran::where('nomor_bstb',$nomor_bstb)->get();

        // Kembalikan nomor batch sebagai respons
        return response()->json($data);
    }
    public function setCabut(Request $request)
    {
        $nomor_bstb = $request->nomor_bstb;
        $data = TransitDryACabut::where('nomor_bstb',$nomor_bstb)->first();
        $data = TransitDryACabut::where('nomor_bstb',$nomor_bstb)->get();

        // Kembalikan nomor batch sebagai respons
        return response()->json($data);
    }

    public function CeksendData(Request $request)
    {
        // Ambil id box dari request dan konversi ke dalam array
        $idBoxes = json_decode($request->idBoxes);
        $typeTransit = $request->typeTransit;

        // Cek ketersediaan id box dalam database berdasarkan jenis transit
        if ($typeTransit === 'hancuran') {
            $unavailableBoxes = TransitDryAHancuran::whereIn('nomor_bstb', $idBoxes)->pluck('nomor_bstb')->toArray();
        } else if ($typeTransit === 'cabut') {
            $unavailableBoxes = TransitDryACabut::whereIn('nomor_bstb', $idBoxes)->pluck('nomor_bstb')->toArray();
        } else {
            $unavailableBoxes = [];
        }

        // Filter id box yang tidak tersedia
        $availableBoxes = array_diff($idBoxes, $unavailableBoxes);

        // Kembalikan daftar id box yang tidak tersedia sebagai respons
        return response()->json(['unavailableBoxes' => $availableBoxes]);
    }

    // Contoh controller
    public function store(Request $request)
    {
        // Decode JSON string to associative array
        $dataArray = json_decode($request->input('dataArray'), true);

        // Validate other form fields
        $validatedData = $request->validate([
            'nomor_bstb' => 'required',
            'user_created' => 'required',
            'user_updated' => 'sometimes',
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
                    // GradingWarnaPenerimaan::create($mergedData);
                    GradingWarnaPenerimaan::create([
                        'nomor_job'             => $mergedData['nomor_job'],
                        'nomor_bstb'            => $mergedData['nomor_bstb'],
                        'nomor_batch'           => $mergedData['nomor_batch'] ?? 0,
                        'tujuan_kirim'          => $mergedData['tujuan_kirim'],
                        'keterangan'            => $mergedData['keterangan'] ?? '',
                        'berat_kotor'           => $mergedData['berat_kotor'] ?? 0,
                        'jenis_grading'       => $mergedData['jenis_grading'],
                        'berat_1_grading'      => $mergedData['berat_1_grading'] ?? 0,
                        'pcs_1_grading'      => $mergedData['pcs_1_grading'] ?? 0,
                        'berat_2_grading'      => $mergedData['berat_2_grading'] ?? 0,
                        'modal'             => $mergedData['modal'],
                        'total_modal'       => $mergedData['total_modal'],
                        'user_created'  => $mergedData['user_created'],
                        'user_update'   => $mergedData['user_updated'] ?? '',
                    ]);

                    GradingWarnaPenerimaanStock::create([
                        'unit'                  => 'Grading Warna',
                        'nomor_job'             => $mergedData['nomor_job'],
                        'nomor_bstb'            => $mergedData['nomor_bstb'],
                        'nomor_batch'           => $mergedData['nomor_batch'] ?? 0,
                        'tujuan_kirim'          => $mergedData['tujuan_kirim'],
                        'keterangan'            => $mergedData['keterangan'] ?? '',
                        'berat_kotor'           => $mergedData['berat_kotor'],
                        'jenis_grading'       => $mergedData['jenis_grading'],
                        'berat_1_grading'      => $mergedData['berat_1_grading'] ?? 0,
                        'pcs_1_grading'      => $mergedData['pcs_1_grading'] ?? 0,
                        'berat_2_grading'      => $mergedData['berat_2_grading'] ?? 0,
                        'modal'             => $mergedData['modal'],
                        'total_modal'       => $mergedData['total_modal'],
                        'user_created'  => $mergedData['user_created'],
                        'user_update'   => $mergedData['user_updated'] ?? '',
                        'status'   => $mergedData['user_updated'] ?? 1,
                    ]);

                    $itemObject = (object) $mergedData;
                    // Ambil semua item yang sesuai dengan kriteria
                    $existingItems = TransitDryAHancuran::where('nomor_bstb', $itemObject->nomor_bstb)
                        ->get();

                    foreach ($existingItems as $existingItem) {

                        // Update data dengan nilai baru
                        $existingItem->update([
                            'status' => $itemObject->status ?? 0,
                        ]);
                    }


                    $itemObject = (object) $mergedData;
                    $existingItem = DryAOutputHancuran::where('nomor_bstb', $itemObject->nomor_bstb)
                        ->get();

                    $dataToUpdate = [
                        'status'                => $itemObject->status ?? 0,
                    ];

                    if ($existingItem) {
                            foreach ($existingItem as $existingItems) {
                                // Perbarui data untuk setiap item yang ada
                                $existingItems->update($dataToUpdate);
                            }
                    }

                    $itemObject = (object) $mergedData;
                    // Ambil semua item yang sesuai dengan kriteria
                    $TransitDryACabut = TransitDryACabut::where('nomor_bstb', $itemObject->nomor_bstb)
                        ->get();

                    foreach ($TransitDryACabut as $DryACabut) {

                        // Update data dengan nilai baru
                        $DryACabut->update([
                            'status' => $itemObject->status ?? 0,
                        ]);
                    }


                    $itemObject = (object) $mergedData;
                    $DryACabut = DryAOutputCabut::where('nomor_bstb', $itemObject->nomor_bstb)
                        ->get();

                    $dataToUpdate = [
                        'status'    => $itemObject->status ?? 0,
                    ];

                    if ($DryACabut) {
                            foreach ($DryACabut as $TransitDryACabut) {
                                // Perbarui data untuk setiap item yang ada
                                $TransitDryACabut->update($dataToUpdate);
                            }
                    }

                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();

                    return response()->json([
                        'success' => false,
                        'error' => 'Gagal menyimpan data. ' . $e->getMessage(),
                        'redirectTo' => route('GradingWarnaPenerimaan.create')
                    ],504);
                }
            }
        }

        // Kembalikan data yang baru dibuat sebagai respons
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil disimpan!',
            'redirectTo' => route('GradingWarnaPenerimaan.index')
        ], 201);
    }

    public function destroy($nomor_bstb): RedirectResponse
    {
        try {
            // Gunakan transaksi database untuk memastikan konsistensi
            DB::beginTransaction();

            // Ambil data GradingWarnaPenerimaan berdasarkan nomor_bstb
            $gradingWarnaPenerimaans = GradingWarnaPenerimaan::where('nomor_bstb', '=', $nomor_bstb)->get();

            if ($gradingWarnaPenerimaans->isEmpty()) {
                // Redirect ke index dengan pesan error jika data tidak ditemukan
                return redirect()->route('GradingWarnaPenerimaan.index')->with(['error' => 'Data tidak ditemukan!']);
            }

            foreach ($gradingWarnaPenerimaans as $gradingWarnaPenerimaan) {
                // Ambil data GradingWarnaPenerimaanStock berdasarkan nomor_bstb
                $gradingWarnaPenerimaanStock = GradingWarnaPenerimaanStock::where('nomor_bstb', '=', $gradingWarnaPenerimaan->nomor_bstb)->first();

                if ($gradingWarnaPenerimaanStock) {
                    // Ambil data TransitDryAHancuran dan TransitDryACabut berdasarkan nomor_bstb
                    $transitDryAHancuran = TransitDryAHancuran::where('nomor_bstb', '=', $gradingWarnaPenerimaan->nomor_bstb)->first();
                    $transitDryACabut = TransitDryACabut::where('nomor_bstb', '=', $gradingWarnaPenerimaan->nomor_bstb)->first();

                    // Update status jika data TransitDryAHancuran dan TransitDryACabut ada
                    if ($transitDryAHancuran) {
                        $transitDryAHancuran->update([
                            'status' => max($gradingWarnaPenerimaan->statuss, 1),
                        ]);
                    }
                    if ($transitDryACabut) {
                        $transitDryACabut->update([
                            'status' => max($gradingWarnaPenerimaan->statuss, 1),
                        ]);
                    }
                }

                // Hapus data GradingWarnaPenerimaan dan GradingWarnaPenerimaanStock
                $gradingWarnaPenerimaan->delete();
                if ($gradingWarnaPenerimaanStock) {
                    $gradingWarnaPenerimaanStock->delete();
                }

                // Kembalikan nilai status sebelum dihapus
                if ($transitDryAHancuran) {
                    $transitDryAHancuran->update([
                        'status' => $transitDryAHancuran->status ?? 1,
                    ]);
                }
                if ($transitDryACabut) {
                    $transitDryACabut->update([
                        'status' => $transitDryACabut->status ?? 1,
                    ]);
                }

                // Update status DryAOutputHancuran
                $dryAOutputHancurans = DryAOutputHancuran::where('nomor_bstb', $gradingWarnaPenerimaan->nomor_bstb)->get();
                foreach ($dryAOutputHancurans as $dryAOutputHancuran) {
                    $dryAOutputHancuran->update(['status' => 1]);
                }

                // Update status DryAOutputCabut
                $dryAOutputCabuts = DryAOutputCabut::where('nomor_bstb', $gradingWarnaPenerimaan->nomor_bstb)->get();
                foreach ($dryAOutputCabuts as $dryAOutputCabut) {
                    $dryAOutputCabut->update(['status' => 1]);
                }
            }

            // Commit transaksi
            DB::commit();

            // Redirect ke index dengan pesan sukses
            return redirect()->route('GradingWarnaPenerimaan.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();

            // Redirect ke index dengan pesan error
            return redirect()->route('GradingWarnaPenerimaan.index')->with(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

}
