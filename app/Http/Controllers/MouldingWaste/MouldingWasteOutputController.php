<?php

namespace App\Http\Controllers\MouldingWaste;

use App\Http\Controllers\Controller;
use App\Models\GradingWarna;
use App\Models\GradingWarnaStock;
use App\Models\MasterTujuanKirimMoulding;
use App\Models\MouldingWasteInput;
use App\Models\MouldingWasteOutput;
use App\Models\MouldingWasteStock;
use App\Models\TransitMouldingWaste;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;

class MouldingWasteOutputController extends Controller
{
    //Index
    public function index(Request $request){
        $i = 1;
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = MouldingWasteOutput::query();


        if ($startDate && $endDate) {
            $query->whereBetween(MouldingWasteOutput::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), [$startDate, $endDate]);
            $PreGHI = $query->get();
        }else{
            $PreGHI = MouldingWasteOutput::limit(1000)
            ->latest()
            ->get();
        }
        return response()->view('MouldingWaste.MouldingWasteOutput.index', [
            'PreGHI' => $PreGHI,
            'i' => $i,
        ]);
    }

    // Create Moulding
    public function create()
    {
        $MouldingWasteStock = MouldingWasteStock::get();
        $GradingWarnaStock = GradingWarnaStock::get();
        $TujuanKirimGHI = MasterTujuanKirimMoulding::get();
        // return $GradingWarnaStock;
        return view('MouldingWaste.MouldingWasteOutput.create', compact('MouldingWasteStock', 'GradingWarnaStock', 'TujuanKirimGHI'));
    }

    public function getWaste(Request $request)
    {
        $data = MouldingWasteStock::where('sisa_berat','!=','0')->get();

        // Kembalikan nomor batch sebagai respons
        return response()->json($data);
    }
    public function getGrading(Request $request)
    {
        $data = GradingWarnaStock::where('status','=','1')->get();

        // Kembalikan nomor batch sebagai respons
        return response()->json($data);
    }

    public function setWaste(Request $request)
    {
        $id_box = $request->id_box;
        $data = MouldingWasteStock::where('id_box_waste_moulding',$id_box)->first();
        // $data = MouldingWasteStock::where('id_box_waste_moulding',$id_box)->get();

        // Kembalikan nomor batch sebagai respons
        return response()->json($data);
    }
    public function setGrading(Request $request)
    {
        $id_box = $request->id_box;
        $data = GradingWarnaStock::where('id_box_grading_warna',$id_box)->first();
        // $data = GradingWarnaStock::where('id_box_grading_warna',$id_box)->get();

        // Kembalikan nomor batch sebagai respons
        return response()->json($data);
    }


    public function setpcc(Request $request)
    {
        $tujuan_kirim = $request->tujuan_kirim;
        // Lakukan logika untuk mengatur nomor batch berdasarkan tujuan_kirim
        $data = MasterTujuanKirimMoulding::where('tujuan_kirim',$tujuan_kirim)->first();

        // Kembalikan nomor batch sebagai respons
        return response()->json($data);
    }

    public function sendData(Request $request)
    {
        // Ambil id box dari request dan konversi ke dalam array
        $idBoxes = json_decode($request->idBoxes);
        $typeTransit = $request->typeTransit;

        // Cek ketersediaan id box dalam database berdasarkan jenis transit
        if ($typeTransit === 'waste') {
            $unavailableBoxes = MouldingWasteStock::whereIn('id_box_waste_moulding', $idBoxes)->pluck('id_box_waste_moulding')->toArray();
        } else if ($typeTransit === 'warna') {
            $unavailableBoxes = GradingWarnaStock::whereIn('id_box_grading_warna', $idBoxes)->pluck('id_box_grading_warna')->toArray();
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
            'user_created' => 'required',
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
                    DB::beginTransaction();

                    // Buat instansi PreCleaningInput
                    // GradingWarnaPenerimaan::create($mergedData);
                    MouldingWasteOutput::create([
                        'asal_stock'             => $mergedData['asal_stock'],
                        'id_box_waste_moulding'                => $mergedData['id_box'],
                        'nomor_job'             => $mergedData['nomor_job'],
                        'nomor_bstb'            => $mergedData['nomor_bstb'],
                        'jenis'                 => $mergedData['jenis'],
                        'tujuan_kirim'          => $mergedData['tujuan_kirim'],
                        'berat'                 => $mergedData['berat'] ?? 0,
                        'pcs'                   => $mergedData['pcs'] ?? 0,
                        'keterangan'            => $mergedData['keterangan'] ?? '',
                        'status'                => $mergedData['status'] ?? 1,
                        'modal'             => $mergedData['modal'],
                        'total_modal'       => $mergedData['total_modal'],
                        'user_created'  => $mergedData['user_created'],
                        'user_update'   => $mergedData['user_updated'] ?? '',
                    ]);

                    TransitMouldingWaste::create([
                        'unit'                  => 'Moulding Waste',
                        'id_box_waste_moulding' => $mergedData['id_box'] ?? 0,
                        'nomor_job'             => $mergedData['nomor_job'],
                        'nomor_bstb'            => $mergedData['nomor_bstb'],
                        'jenis_waste'           => $mergedData['jenis'],
                        'tujuan_kirim'          => $mergedData['tujuan_kirim'],
                        'pcs'                   => $mergedData['pcs'] ?? 0,
                        'berat'                 => $mergedData['berat'] ?? 0,
                        'modal'                 => $mergedData['modal'],
                        'total_modal'           => $mergedData['total_modal'],
                        'status'                => $mergedData['user_updated'] ?? 1,
                    ]);

                    $itemObject = (object) $mergedData;

                    // Update MouldingWasteStock
                    $existingMouldingWasteStocks = MouldingWasteStock::where('id_box_waste_moulding', $itemObject->id_box)->get();

                    foreach ($existingMouldingWasteStocks as $existingMouldingWasteStock) {
                        // Mengakses properti dari objek individual
                        $beratKeluar = $existingMouldingWasteStock->berat_keluar + ($itemObject->berat ?? 0);
                        $pcsKeluar = $existingMouldingWasteStock->pcs_keluar + ($itemObject->pcs ?? 0);
                        $sisaBerat = $existingMouldingWasteStock->berat_masuk - ($beratKeluar ?? 0);
                        $sisaPcs = $existingMouldingWasteStock->pcs_masuk - ($pcsKeluar ?? 0);
                        $totalModal = $existingMouldingWasteStock->modal * $sisaBerat;

                        // Update data PreGradingHalusAddingStock
                        $existingMouldingWasteStock->update([
                            'berat_keluar' => $beratKeluar ?? 0,
                            'pcs_keluar'   => $pcsKeluar ?? 0,
                            'sisa_berat'   => $sisaBerat,
                            'sisa_pcs'     => $sisaPcs,
                            'total_modal'  => $totalModal,
                            'user_updated' => $itemObject->user_created ?? "",
                        ]);

                        $MouldingWasteInput = MouldingWasteInput::where('id_box_waste_moulding', $itemObject->id_box)->get();
                        foreach ($MouldingWasteInput as $MouldingWasteInputs) {
                            $MouldingWasteInputs->update(['status' => 0]);
                        }
                    }


                    // Update GradingWarnaStock
                    $existingGradingWarnaStocks = GradingWarnaStock::where('id_box_grading_warna', $itemObject->id_box)->get();

                    foreach ($existingGradingWarnaStocks as $existingGradingWarnaStock) {
                        $beratKeluar = $existingGradingWarnaStock->berat_keluar + ($itemObject->berat ?? 0);
                        $pcsKeluar = $existingGradingWarnaStock->pcs_keluar + ($itemObject->pcs ?? 0);
                        $sisaBerat = $existingGradingWarnaStock->berat_masuk - ($beratKeluar ?? 0);
                        $sisaPcs = $existingGradingWarnaStock->pcs_masuk - ($pcsKeluar ?? 0);
                        $totalModal = $existingGradingWarnaStock->modal * $sisaBerat;

                        $existingGradingWarnaStock->update([
                        // Update data PreGradingHalusAddingStock
                        'berat_keluar' => $beratKeluar ?? 0,
                        'pcs_keluar'   => $pcsKeluar ?? 0,
                        'sisa_berat'   => $sisaBerat,
                        'sisa_pcs'     => $sisaPcs,
                        'total_modal'  => $totalModal,
                        'user_updated' => $itemObject->user_created ?? "",
                        'status'   => $itemObject->status ?? 0,
                        ]);

                        $GradingWarna = GradingWarna::where('id_box_grading_warna', $itemObject->id_box)->get();
                        foreach ($GradingWarna as $GradingWarnas) {
                            $GradingWarnas->update(['status' => 0]);
                        }
                    }


                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();

                    return response()->json([
                        'success' => false,
                        'error' => 'Gagal menyimpan data. ' . $e->getMessage(),
                        'redirectTo' => route('MouldingWasteOutput.create')
                    ],504);
                }
            }
        }

        // Kembalikan data yang baru dibuat sebagai respons
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil disimpan!',
            'redirectTo' => route('MouldingWasteOutput.index')
        ], 201);
    }

    public function destroy($id_box): RedirectResponse
    {
        try {
            // Gunakan transaksi database untuk memastikan konsistensi
            DB::beginTransaction();

            $gradingWarnaPenerimaans = MouldingWasteOutput::where('id_box_waste_moulding', '=', $id_box)->get();

            if ($gradingWarnaPenerimaans->isEmpty()) {
                // Redirect ke index dengan pesan error jika data tidak ditemukan
                return redirect()->route('GradingWarnaPenerimaan.index')->with(['error' => 'Data tidak ditemukan!']);
            }

            foreach ($gradingWarnaPenerimaans as $gradingWarnaPenerimaan) {
                // Ambil data GradingWarnaPenerimaanStock berdasarkan id_box
                $gradingWarnaPenerimaanStock = TransitMouldingWaste::where('id_box_waste_moulding', '=', $gradingWarnaPenerimaan->id_box)->first();

                if ($gradingWarnaPenerimaanStock) {
                    // Ambil data TransitDryAHancuran dan TransitDryACabut berdasarkan id_box
                    $transitDryAHancuran = GradingWarnaStock::where('id_box_grading_warna', '=', $gradingWarnaPenerimaan->id_box)->first();
                    $transitDryACabut = MouldingWasteStock::where('id_box_waste_moulding', '=', $gradingWarnaPenerimaan->id_box)->first();

                    // Update atau hapus TransitDryAHancuran berdasarkan sisa_berat
                    if ($transitDryAHancuran) {
                        // Hitung total modal baru
                        $beratKeluar = $transitDryAHancuran->berat_keluar - ($gradingWarnaPenerimaan->berat ?? 0);
                        $pcsKeluar = $transitDryAHancuran->pcs_keluar - ($gradingWarnaPenerimaan->pcs ?? 0);
                        $sisaBerat = $transitDryAHancuran->berat_masuk - $beratKeluar;
                        $sisaPcs = $transitDryAHancuran->pcs_masuk - $pcsKeluar;
                        $totalModal = $transitDryAHancuran->modal * $sisaBerat;

                        $transitDryAHancuran->update([
                            'berat_keluar' => $beratKeluar,
                            'pcs_keluar' => $pcsKeluar,
                            'sisa_berat' => $sisaBerat,
                            'sisa_pcs' => $sisaPcs,
                            'total_modal' => $totalModal,
                            'status' => max($gradingWarnaPenerimaan->status, 0),
                        ]);

                        $GradingWarna = GradingWarna::where('id_box_grading_warna', $gradingWarnaPenerimaan->id_box)->get();
                        foreach ($GradingWarna as $GradingWarnas) {
                            $GradingWarnas->update(['status' => 1]);
                        }
                    }

                    // Update atau hapus TransitDryACabut berdasarkan sisa_berat
                    if ($transitDryACabut) {
                        // Hitung total modal baru
                        $beratKeluar = $transitDryACabut->berat_keluar - ($gradingWarnaPenerimaan->berat ?? 0);
                        $pcsKeluar = $transitDryACabut->pcs_keluar - ($gradingWarnaPenerimaan->pcs ?? 0);
                        $sisaBerat = $transitDryACabut->berat_masuk - $beratKeluar;
                        $sisaPcs = $transitDryACabut->pcs_masuk - $pcsKeluar;
                        $totalModal = $transitDryACabut->modal * $sisaBerat;

                        $transitDryACabut->update([
                            'berat_keluar' => $beratKeluar,
                            'pcs_keluar' => $pcsKeluar,
                            'sisa_berat' => $sisaBerat,
                            'sisa_pcs' => $sisaPcs,
                            'total_modal' => $totalModal,
                        ]);


                        $MouldingWasteInput = MouldingWasteInput::where('id_box_waste_moulding', $gradingWarnaPenerimaan->id_box)->get();
                        foreach ($MouldingWasteInput as $MouldingWasteInputs) {
                            $MouldingWasteInputs->update(['status' => 1]);
                        }
                    }
                }

                // Hapus data GradingWarnaPenerimaan dan GradingWarnaPenerimaanStock
                $gradingWarnaPenerimaan->delete();
                if ($gradingWarnaPenerimaanStock) {
                    $gradingWarnaPenerimaanStock->delete();
                }
            }

            // Commit transaksi
            DB::commit();

            // Redirect ke index dengan pesan sukses
            return redirect()->route('MouldingWasteOutput.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();

            // Redirect ke index dengan pesan error
            return redirect()->route('MouldingWasteOutput.index')->with(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

}
