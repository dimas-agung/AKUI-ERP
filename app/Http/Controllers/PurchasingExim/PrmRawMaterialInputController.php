<?php

namespace App\Http\Controllers\PurchasingExim;

use App\Models\PrmRawMaterialInput;
use App\Models\PrmRawMaterialInputItem;
use App\Models\PrmRawMaterialStock;
use App\Models\PrmRawMaterialStockHistory;
use App\Http\Controllers\Controller;
use App\Http\Requests\PrmRawMaterialRequest;
use App\Http\Requests\PrmRawMaterialItemRequest;
use App\Models\MasterJenisRawMaterial;
use Illuminate\Http\Request;
use App\Models\MasterSupplierRawMaterial;
use Illuminate\Http\RedirectResponse;
use App\Services\PrmRawMaterialInputService;
use App\Services\PrmRawMaterialInputItemService;
use Illuminate\Support\Facades\DB;


class PrmRawMaterialInputController extends Controller
{
    //index
    public function index()
    {
        $i = 1;
        $MasterSupplierRawMaterial = MasterSupplierRawMaterial::with('PrmRawMaterialInput')->get();
        $MasterJenisRawMaterial = MasterJenisRawMaterial::with('PrmRawMaterialInputItem')->get();
        $PrmRawMaterialInputItem = PrmRawMaterialInputItem::with('PrmRawMaterialInput')->get();
        $PrmRawMaterialInput = PrmRawMaterialInput::with('MasterSupplierRawMaterial')->get();
        // return $PrmRawMaterialInput;
        // return $MasterSupplierRawMaterial;
        // return $MasterJenisRawMaterial;
        return response()->view('purchasing_exim.prm_raw_material_input.index', [
            'prm_raw_material_inputs'       => $PrmRawMaterialInput,
            'master_supplier_raw_materials' => $MasterSupplierRawMaterial,
            'master_jenis_raw_materials'    => $MasterJenisRawMaterial,
            'prm_raw_material_input_items'  => $PrmRawMaterialInputItem,
            'i' => $i,
        ]);
    }
    // create
    public function create()
    {
        $MasterSupplierRawMaterial = MasterSupplierRawMaterial::with('PrmRawMaterialInput')->get();
        $MasterJenisRawMaterial = MasterJenisRawMaterial::with('PrmRawMaterialInputItem')->get();
        return view('purchasing_exim/prm_raw_material_input.create', [
            'master_supplier_raw_materials' => $MasterSupplierRawMaterial,
            'master_jenis_raw_materials'    => $MasterJenisRawMaterial,
        ]);
    }
    public function detail()
    {
        $i = 1;

        // $PrmRawMaterialInputItem = PrmRawMaterialInputItem::with('PrmRawMaterialInput')->get();
        $PrmRawMaterialInputItem = PrmRawMaterialInputItem::all();
        // return $PrmRawMaterialInputItem;
        return response()->view('purchasing_exim.prm_raw_material_input.detail', [
            'prm_raw_material_input_items'  => $PrmRawMaterialInputItem,
            'i' => $i,
        ]);
    }

    // get Data Supplier
    public function getDataSupplier(Request $request)
    {
        $nama_supplier = $request->nama_supplier;
        // Menggunakan where untuk memfilter berdasarkan nama_supplier dan status aktif
        $data = MasterSupplierRawMaterial::where('nama_supplier', $nama_supplier)
            ->where('status', 1) // Gantilah 'status' dengan kolom yang sesuai dengan model Anda
            ->first();

        // Kembalikan nomor batch sebagai respons
        return response()->json($data);
    }
    // get Data Jenis
    public function getDataJenis(Request $request)
    {
        $jenis = $request->jenis;
        $data = MasterJenisRawMaterial::where('jenis', $jenis)
            ->where('status', 1)
            ->first();

        return response()->json($data);
    }

    public function simpanData(
        PrmRawMaterialRequest $request,
        PrmRawMaterialInputService $PrmRawMaterialInputService
    )
    // public function simpanData(Request $request)
    {
        $dataArray = json_decode($request->input('data'));
        $dataHeader = json_decode($request->input('dataHeader'));
        // return $dataArray;
        // var_dump($dataArray[0]);
        // return $dataStock;
        // return $dataHeader[0];
        // return $dataStockHistory[0];
        // Pastikan doc_no ada dan merupakan string sebelum menggunakan substr

        // $result = $PrmRawMaterialInputService->simpanData($dataHeader[0], $dataArray, $dataStock);
        $result = $PrmRawMaterialInputService->simpanData($dataHeader[0], $dataArray);
        // $result = $PrmRawMaterialInputService->simpanData($dataHeader[0], $dataArray, $dataStock, $dataStockHistory);

        // if (is_array($result) && isset($result['success']) && $result['success']) {
        //     return response()->json($result);
        // } else {
        //     return response()->json($result, 500);
        // }

        if ($result['success']) {
            return response()->json($result);
        } else {
            return response()->json($result, 500);
        }
    }

    public function show(string $id)
    {
        $i = 1;
        // $MasterSupplierRawMaterial = MasterSupplierRawMaterial::with('PrmRawMaterialInput')->get();
        // $MasterJenisRawMaterial = MasterJenisRawMaterial::with('PrmRawMaterialInputItem')->get();
        //get by ID
        $MasterPRIM = PrmRawMaterialInput::findOrFail($id);
        $MasterPRIM = PrmRawMaterialInput::with('PrmRawMaterialInputItem')
            ->where(['id' => $id])
            ->first();


        return response()->view('purchasing_exim.prm_raw_material_input.show', compact('MasterPRIM', 'i'));
    }

    // edit
    public function edit(string $id)
    {
        $MasterSupplierRawMaterial = MasterSupplierRawMaterial::with('PrmRawMaterialInput')->get();
        $MasterJenisRawMaterial = MasterJenisRawMaterial::with('PrmRawMaterialInputItem')->get();
        $PrmRawMaterialInputItem = PrmRawMaterialInputItem::with('PrmRawMaterialInput')->find($id);
        $PrmRawMaterialInput = PrmRawMaterialInput::with('MasterSupplierRawMaterial')->find($id);
        // return $MasterPRM;
        return view('purchasing_exim.prm_raw_material_input.update', [
            'master_supplier_raw_materials'    => $MasterSupplierRawMaterial,
            'master_jenis_raw_materials'       => $MasterJenisRawMaterial,
            'prm_raw_material_input_items'     => $PrmRawMaterialInputItem,
            'prm_raw_material_inputs'          => $PrmRawMaterialInput,
        ]);
    }
    // test
    public function destroyInput($id): RedirectResponse
    {

        try {
            // Gunakan transaksi database untuk memastikan konsistensi
            DB::beginTransaction();

            // Temukan record berdasarkan ID
            $prmRawMaterialInput = PrmRawMaterialInput::findOrFail($id);

            // Simpan id_box dari input yang akan dihapus
            $idBoxToDelete = $prmRawMaterialInput->id_box;

            // Hitung total kadar air untuk id_box sebelum item dihapus
            $totalKadarAirSebelumnya = PrmRawMaterialStockHistory::where('id_box', $idBoxToDelete)->sum('avg_kadar_air');

            // Hitung jumlah baris untuk id_box sebelum item dihapus
            $jumlahBarisSebelumnya = PrmRawMaterialStockHistory::where('id_box', $idBoxToDelete)->count();

            // Hapus semua item terkait
            $prmRawMaterialInput->PrmRawMaterialInputItem()->delete();
            $prmRawMaterialInput->PrmRawMaterialStock()->delete();
            $prmRawMaterialInput->PrmRawMaterialStockHistory()->delete();

            // Hitung total kadar air untuk id_box setelah item dihapus
            $totalKadarAirSesudah = PrmRawMaterialStockHistory::where('id_box', $idBoxToDelete)->sum('avg_kadar_air');

            // Hitung jumlah baris untuk id_box setelah item dihapus
            $jumlahBarisSesudah = PrmRawMaterialStockHistory::where('id_box', $idBoxToDelete)->count();

            // Hitung ulang rata-rata kadar air untuk id_box yang terpengaruh
            $averageKadarAir = 0;
            if ($jumlahBarisSesudah > 0) {
                $averageKadarAir = ($totalKadarAirSebelumnya - $totalKadarAirSesudah) / ($jumlahBarisSebelumnya - $jumlahBarisSesudah);
            }

            $prmStock = PrmRawMaterialStock::where('id_box', $idBoxToDelete)->first();
            if ($prmStock) {
                // Pastikan nilai avg_kadar_air di-format sebagai desimal sebelum disimpan
                $prmStock->avg_kadar_air = number_format($averageKadarAir, 2); // Format dengan 2 digit desimal
                $prmStock->save();
            }

            // Hapus record utama
            $prmRawMaterialInput->delete();

            // Jika tidak ada kesalahan, komit transaksi
            DB::commit();

            // Kembali ke halaman index dengan pesan sukses
            return redirect()->route('PrmRawMaterialInput.index')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, rollback transaksi
            DB::rollback();

            // Kembali ke halaman index dengan pesan error
            return redirect()->route('PrmRawMaterialInput.index')->with('error', 'Gagal menghapus data');
        }
    }

    // test
    // public function destroyInput($id): RedirectResponse
    // {
    //     try {
    //         // Gunakan transaksi database untuk memastikan konsistensi
    //         DB::beginTransaction();

    //         // Temukan record berdasarkan ID
    //         $prmRawMaterialInput = PrmRawMaterialInput::findOrFail($id);

    //         // Simpan id_box dari input yang akan dihapus
    //         $idBoxToDelete = $prmRawMaterialInput->id_box;

    //         // Hitung total kadar air untuk id_box sebelum item dihapus
    //         $totalKadarAirSebelumnya = PrmRawMaterialStockHistory::where('id_box', $idBoxToDelete)->sum('avg_kadar_air');

    //         // Hitung jumlah baris untuk id_box sebelum item dihapus
    //         $jumlahBarisSebelumnya = PrmRawMaterialStockHistory::where('id_box', $idBoxToDelete)->count();

    //         // Hapus semua item terkait
    //         $prmRawMaterialInput->PrmRawMaterialInputItem()->delete();
    //         $prmRawMaterialInput->PrmRawMaterialStock()->delete();
    //         $prmRawMaterialInput->PrmRawMaterialStockHistory()->delete();

    //         // Hitung total kadar air untuk id_box setelah item dihapus
    //         $totalKadarAirSesudah = PrmRawMaterialStockHistory::where('id_box', $idBoxToDelete)->sum('avg_kadar_air');

    //         // Hitung jumlah baris untuk id_box setelah item dihapus
    //         $jumlahBarisSesudah = PrmRawMaterialStockHistory::where('id_box', $idBoxToDelete)->count();

    //         // Hitung ulang rata-rata kadar air untuk id_box yang terpengaruh
    //         $averageKadarAir = 0;
    //         if ($jumlahBarisSesudah > 0) {
    //             $averageKadarAir = ($totalKadarAirSebelumnya - $totalKadarAirSesudah) / ($jumlahBarisSebelumnya - $jumlahBarisSesudah);
    //         }

    //         $prmStock = PrmRawMaterialStock::where('id_box', $idBoxToDelete)->first();
    //         if ($prmStock) {
    //             // Pastikan nilai avg_kadar_air di-format sebagai desimal sebelum disimpan
    //             $prmStock->avg_kadar_air = number_format($averageKadarAir, 2); // Format dengan 2 digit desimal
    //             $prmStock->save();
    //         }

    //         // Hapus record utama
    //         $prmRawMaterialInput->delete();

    //         // Jika tidak ada kesalahan, komit transaksi
    //         DB::commit();

    //         // Kembali ke halaman index dengan pesan sukses
    //         return redirect()->route('PrmRawMaterialInput.index')->with('success', 'Data berhasil dihapus');
    //     } catch (\Exception $e) {
    //         // Jika terjadi kesalahan, rollback transaksi
    //         DB::rollback();

    //         // Kembali ke halaman index dengan pesan error
    //         return redirect()->route('PrmRawMaterialInput.index')->with('error', 'Gagal menghapus data');
    //     }
    // }
    // test

    // hapus item
    public function destroyItem($id): RedirectResponse
    {
        try {
            // Temukan record berdasarkan ID
            $PrmRawMaterialInputItem = PrmRawMaterialInputItem::findOrFail($id);

            // Hapus semua item terkait
            $PrmRawMaterialInputItem->PrmRawMaterialStock()->delete();
            $PrmRawMaterialInputItem->PrmRawMaterialStockHistory()->delete();

            // Hapus record utama
            $PrmRawMaterialInputItem->delete();

            // Jika tidak ada kesalahan, komit transaksi
            DB::commit();

            return redirect()->route('PrmRawMaterialInput.index')->with('success', 'Data berhasil dihapus');
            // return redirect()->route('PrmRawMaterialInput.show')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, rollback transaksi
            DB::rollback();

            return redirect()->route('PrmRawMaterialInput.index')->with('error', 'Gagal menghapus data');
            // return redirect()->route('PrmRawMaterialInput.show')->with('error', 'Gagal menghapus data');
        }
    }
    // test

    // protected $prmRawMaterialInputService;

    // public function __construct(PrmRawMaterialInputService $prmRawMaterialInputService)
    // {
    //     $this->prmRawMaterialInputService = $prmRawMaterialInputService;
    // }

    // // Metode lainnya di controller

    // public function destroy($id)
    // {
    //     // Panggil fungsi hapusData dari PrmRawMaterialInputService
    //     $result = $this->prmRawMaterialInputService->hapusData($id);

    //     // Berikan respons berdasarkan hasil pemanggilan fungsi
    //     if ($result['success']) {
    //         return response()->json($result);
    //     } else {
    //         return response()->json($result, 400);
    //     }
    // }

    /**
     * destroy
     */
    // public function destroy($nomor_bstb): RedirectResponse
    // {
    //     try {
    //         // Gunakan transaksi database untuk memastikan konsistensi
    //         DB::beginTransaction();

    //         $gradingKIs = GradingKasarInput::where('nomor_bstb', '=', $nomor_bstb)->get();

    //         if ($gradingKIs->isEmpty()) {
    //             return redirect()->route('GradingKasarInput.index')->with(['error' => 'Data tidak ditemukan!']);
    //         }

    //         foreach ($gradingKIs as $gradingKI) {
    //             $beratSebelumnya = $gradingKI->berat;
    //             $totalModalSebelumnya = $gradingKI->total_modal;

    //             $dataToUpdate = [
    //                 'nomor_bstb' => $gradingKI->nomor_bstb,
    //                 'berat' => $beratSebelumnya,
    //                 'total_modal' => $totalModalSebelumnya,
    //             ];

    //             $stockPrmRawMaterial = StockTransitRawMaterial::where('nomor_bstb', '=', $gradingKI->nomor_bstb)->first();

    //             if ($stockPrmRawMaterial) {
    //                 // Ambil berat sebelumnya
    //                 $beratSebelum = $stockPrmRawMaterial->berat;

    //                 // Hitung total modal baru berdasarkan perbedaan berats
    //                 $perbedaanBerat = $beratSebelum + $gradingKI->berat;
    //                 $totalModalBaru = $perbedaanBerat * $gradingKI->modal;
    //                 // $totalModalBaru = $stockPrmRawMaterial->total_modal + ($perbedaanBerat * $itemObject->modal);

    //                 // Update data dengan berat dan total modal yang baru
    //                 $dataToUpdate['berat'] = abs($perbedaanBerat);
    //                 $dataToUpdate['total_modal'] = abs($totalModalBaru);

    //                 // Perbarui data
    //                 $stockPrmRawMaterial->update($dataToUpdate);
    //             } else {
    //                 // Jika item tidak ada, buat item baru dengan nilai lainnya tetap sama
    //                 StockTransitRawMaterial::create(array_merge($dataToUpdate, [
    //                     'id_box'               => $gradingKI->id_box,
    //                     'nomor_batch'          => $gradingKI->nomor_batch,
    //                     'jenis'                => $gradingKI->jenis,
    //                     'kadar_air'            => $gradingKI->kadar_air,
    //                     'tujuan_kirim'         => $gradingKI->tujuan_kirim,
    //                     'letak_tujuan'         => $gradingKI->letak_tujuan,
    //                     'inisial_tujuan'       => $gradingKI->inisial_tujuan,
    //                     'modal'                => $gradingKI->modal,
    //                     'keterangan'           => $gradingKI->keterangan,
    //                     'user_created'         => $gradingKI->user_updated ?? "There isn't any",
    //                     'nomor_nota_internal'  => $gradingKI->nomor_nota_internal,
    //                     // Sesuaikan dengan kolom-kolom lain di tabel item Anda
    //                 ]));
    //             }

    //             $existingItems = PrmRawMaterialOutputItem::where('id_box', $gradingKI->id_box)
    //                 ->where('nomor_batch', $gradingKI->nomor_batch)
    //                 ->get();

    //             // Logika Update Status
    //             if ($existingItems) {
    //                 foreach ($existingItems as $existingItem) {
    //                     // Perbarui data untuk setiap item yang ada
    //                     $existingItem->update(['status' => 1]);
    //                 }
    //             } else {
    //                 // Jika tidak ada item PrmRawMaterialOutputItem yang sesuai, buat baru dengan status 1
    //                 PrmRawMaterialOutputItem::create([
    //                     'nomor_bstb' => $gradingKI->nomor_bstb,
    //                     'status' => 1,
    //                     // Tambahkan kolom-kolom lain sesuai kebutuhan
    //                 ]);
    //             }
    //         }

    //         // Logika Hapus
    //         $gradingKIs->each->delete();

    //         // Commit transaksi
    //         DB::commit();

    //         // Redirect ke index dengan pesan sukses
    //         return redirect()->route('GradingKasarInput.index')->with(['success' => 'Data Berhasil Dihapus!']);
    //     } catch (\Exception $e) {
    //         // Rollback transaksi jika terjadi kesalahan
    //         DB::rollback();

    //         // Redirect ke index dengan pesan error
    //         return redirect()->route('GradingKasarInput.index')->with(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
    //     }
    // }
}
