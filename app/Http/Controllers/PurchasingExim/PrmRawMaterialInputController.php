<?php

namespace App\Http\Controllers\PurchasingExim;

use App\Models\PrmRawMaterialInput;
use App\Models\PrmRawMaterialInputItem;
use App\Models\PrmRawMaterialStock;
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
        // $dataStock = json_decode($request->input('dataStock'));
        $dataHeader = json_decode($request->input('dataHeader'));
        // $dataStockHistory = json_decode($request->input('dataStockHistory'));
        // $dataStockHistory = json_decode($request->input('dataStockHistory'));
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
    // show
    // public function show(string $id_box)
    // {
    //     $i = 1;
    //     $outputData = PrmRawMaterialInput::with('PrmRawMaterialInputItem')->where('nomor_nota_internal', $id_box)->get();
    //     $inputData = PrmRawMaterialInputItem::with('PrmRawMaterialInputItem')->where('id_box', $id_box)->get();

    //     // return $inputData;
    //     // Gabungkan dan susun data berdasarkan waktu
    //     $PrmItem = $inputData->merge($outputData)->sortBy('id_box')
    //         ->pluck('PrmRawMaterialInputItem') // Ambil relasi PrmRawMaterialStockHistory
    //         ->collapse(); // Gabungkan koleksi hasil pluck menjadi satu
    //     return $PrmItem;

    //     return response()->view('purchasing_exim.prm_raw_material_input.show', compact('PrmItem', 'i'));
    // }
    // public function show(string $nomor_nota_internal)
    // {
    //     $i = 1;
    //     $outputData = PrmRawMaterialInputItem::with('PrmRawMaterialInput')->where('nomor_nota_internal', $nomor_nota_internal)->get();
    //     // return $outputData;
    //     $inputData = PrmRawMaterialInputItem::with('PrmRawMaterialInput')->where('id_box', $nomor_nota_internal)->get();
    //     // return $inputData;
    //     // Gabungkan dan susun data berdasarkan waktu
    //     $PrmItem = $inputData->merge($outputData)->sortBy('id_box')
    //         ->pluck('PrmRawMaterialInput') // Ganti 'namaRelasiYangBenar' dengan nama relasi yang sesuai pada model PrmRawMaterialInputItem
    //         ->collapse(); // Gabungkan koleksi hasil pluck menjadi satu

    //     // Kembalikan hasilnya setelah proses penggabungan dan penyusunan data
    //     return response()->view('purchasing_exim.prm_raw_material_input.show', compact('PrmItem', 'i'));
    // }

    // Show
    // public function show(string $created_at)
    // {
    //     $i = 1;
    //     $inputData = PrmRawMaterialInput::with('PrmRawMaterialInputItem')->where('created_at', $created_at)->get();
    //     // $outputData = PrmRawMaterialStock::with('PrmRawMaterialStockHistory')->where('doc_no', $doc_no)->get();

    //     return $inputData;
    //     // Gabungkan dan susun data berdasarkan waktu
    //     // $stockHistory = $inputData->merge($outputData)->sortBy('doc_no')
    //     //     ->pluck('PrmRawMaterialStockHistory') // Ambil relasi PrmRawMaterialStockHistory
    //     //     ->collapse(); // Gabungkan koleksi hasil pluck menjadi satu
    //     // $stockHistory = $stockHist->PrmRawMaterialStockHistory;
    //     // return $stockHistory;

    //     // Kirim data ke tampilan
    //     return view('purchasing_exim.prm_raw_material_input.index', compact('stockHistory', 'i'));
    // }
    // public function show(string $nomor_nota_internal)
    // {
    //     $i = 1;
    //     $inputData = PrmRawMaterialInputItem::with('PrmRawMaterialInput')->get();
    //     $outputData = PrmRawMaterialInput::with('PrmRawMaterialInputItem')->where('nomor_nota_internal', $nomor_nota_internal)->get();

    //     // return $inputData;
    //     // return $outputData;

    //     // Gabungkan dan susun data berdasarkan waktu
    //     $prmItems = $inputData->merge($outputData)->sortBy('id_box')
    //         ->pluck('PrmRawMaterialInputItem') // Ambil relasi PrmRawMaterialStockHistory
    //         ->collapse(); // Gabungkan koleksi hasil pluck menjadi satu
    //     // return $prmItems;

    //     // Kirim data ke tampilan
    //     return view('purchasing_exim.prm_raw_material_input.show', compact('prmItems', 'i'));
    // }
    // public function show(string $nomor_nota_internal)
    // {
    //     $i = 1;

    //     // Ambil data input berdasarkan nomor nota internal
    //     $inputData = PrmRawMaterialInputItem::whereHas('PrmRawMaterialInput', function ($query) use ($nomor_nota_internal) {
    //         $query->where('nomor_nota_internal', $nomor_nota_internal);
    //     })->get();

    //     // Ambil data output berdasarkan nomor nota internal
    //     $outputData = PrmRawMaterialInput::where('nomor_nota_internal', $nomor_nota_internal)->get();

    //     // Gabungkan data input dan output
    //     $prmItems = $inputData->merge($outputData)
    //         ->sortBy('id_box')
    //         ->pluck('PrmRawMaterialInputItem')
    //         ->collapse();

    //     // Kirim data ke tampilan
    //     return view('purchasing_exim.prm_raw_material_input.show', compact('prmItems', 'i'));
    // }
    // public function show(string $nomor_nota_internal)
    // {
    //     $i = 1;

    //     // Ambil data input berdasarkan nomor nota internal
    //     $inputData = PrmRawMaterialInputItem::whereHas('PrmRawMaterialInput', function ($query) use ($nomor_nota_internal) {
    //         $query->where('nomor_nota_internal', $nomor_nota_internal);
    //     })->get();

    //     // return $inputData;

    //     // Ambil data output berdasarkan nomor nota internal
    //     $outputData = PrmRawMaterialInput::where('nomor_nota_internal', $nomor_nota_internal)->get();
    //     return $outputData;
    //     // Gabungkan data input dan output
    //     $prmItems = $inputData->merge($outputData)
    //         ->sortBy('id_box')
    //         ->pluck('PrmRawMaterialInputItem')
    //         ->collapse();

    //     // Kirim data ke tampilan
    //     return view('purchasing_exim.prm_raw_material_input.show', compact('prmItems', 'i'));
    // }
    // public function show(string $nomor_nota_internal)
    // {
    //     $i = 1;

    //     // Ambil data input berdasarkan nomor nota internal
    //     $inputData = PrmRawMaterialInputItem::whereHas('PrmRawMaterialInput', function ($query) use ($nomor_nota_internal) {
    //         $query->where('nomor_nota_internal', $nomor_nota_internal);
    //     })->get();
    //     // return $inputData;
    //     // Ambil data output berdasarkan nomor nota internal
    //     $outputData = PrmRawMaterialInput::where('nomor_nota_internal', $nomor_nota_internal)->get();
    //     return $outputData;
    //     // Gabungkan data input dan output
    //     $prmItems = $inputData->merge($outputData)
    //         ->sortBy('id_box')
    //         ->pluck('PrmRawMaterialInputItem')
    //         ->collapse();

    //     // Kirim data ke tampilan
    //     return view('purchasing_exim.prm_raw_material_input.show', compact('prmItems', 'i'));
    // }
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
    // destroy
    public function destroyInput($id): RedirectResponse
    {
        try {
            // Temukan record berdasarkan ID
            $PrmRawMaterialInput = PrmRawMaterialInput::findOrFail($id);

            // Hapus semua item terkait
            $PrmRawMaterialInput->PrmRawMaterialInputItem()->delete();
            $PrmRawMaterialInput->PrmRawMaterialStock()->delete();
            $PrmRawMaterialInput->PrmRawMaterialStockHistory()->delete();

            // Hapus record utama
            $PrmRawMaterialInput->delete();

            // Jika tidak ada kesalahan, komit transaksi
            DB::commit();

            return redirect()->route('prm_raw_material_input.index')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, rollback transaksi
            DB::rollback();

            return redirect()->route('prm_raw_material_input.index')->with('error', 'Gagal menghapus data');
        }
    }
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

            return redirect()->route('prm_raw_material_input.index')->with('success', 'Data berhasil dihapus');
            // return redirect()->route('prm_raw_material_input.show')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, rollback transaksi
            DB::rollback();

            return redirect()->route('prm_raw_material_input.index')->with('error', 'Gagal menghapus data');
            // return redirect()->route('prm_raw_material_input.show')->with('error', 'Gagal menghapus data');
        }
    }
    // test
    // public function destroy($id): RedirectResponse
    // {
    //     try {
    //         // Gunakan transaksi database untuk memastikan konsistensi
    //         DB::beginTransaction();

    //         // Ambil data GradingKasarInput yang akan dihapus
    //         $gradingKI = PrmRawMaterialOutputItem::findOrFail($id);

    //         // Ambil data StockTransitRawMaterial berdasarkan nomor_bstb
    //         $stockPrmRawMaterial = PrmRawMaterialStock::where('id_box', '=', $gradingKI->id_box)->first();

    //         if ($stockPrmRawMaterial) {
    //             // Simpan nilai sebelum dihapus
    //             $beratTadi = $gradingKI->berat;
    //             $beratSebelumnya = $stockPrmRawMaterial->berat_keluar;
    //             $beratMasuk = $stockPrmRawMaterial->berat_masuk;
    //             $Modal = $gradingKI->modal;
    //             $Beratkeluar = $beratSebelumnya - $beratTadi;
    //             $sisaBerat = $beratMasuk - $Beratkeluar;
    //             $TotalModal = $Beratkeluar * $Modal;

    //             // Update data pada PrmRawMaterialStock
    //             $dataToUpdate = [
    //                 'berat_keluar' => $Beratkeluar,
    //                 'sisa_berat' => $sisaBerat,
    //                 'total_modal' => $TotalModal,
    //             ];

    //             // Perbarui data pada PrmRawMaterialStock
    //             $stockPrmRawMaterial->update($dataToUpdate);
    //         }

    //         // Ambil data StockTransitRawMaterial berdasarkan tujuan_kirim dan id_box
    //         $stockPRM = StockTransitRawMaterial::where('tujuan_kirim', '=', $gradingKI->tujuan_kirim)
    //             ->where('id_box', $gradingKI->id_box)
    //             ->first();

    //         if ($stockPRM) {
    //             // Jika berat atau total modal dari StockTransitRawMaterial bernilai 0, maka hapus data
    //             if ($stockPRM->berat === 0) {
    //                 $stockPRM->delete();
    //             } else {
    //                 // Jika berat yang dimasukkan lebih besar atau sama dengan berat stock, hapus data
    //                 if ($gradingKI->berat_masuk >= $stockPRM->berat) {
    //                     $stockPRM->delete();
    //                 } else {
    //                     // Ambil berat sebelumnya
    //                     $beratSebelumnya = $stockPRM->berat;
    //                     $beratMasuk = $stockPRM->berat_masuk;

    //                     // Hitung total modal baru berdasarkan perbedaan berats
    //                     $perbedaanBerat = $beratSebelumnya - $gradingKI->berat;
    //                     $sisaBerat = $beratMasuk - $beratSebelumnya;
    //                     $totalModalBaru = $sisaBerat * $gradingKI->modal;

    //                     // Update data dengan berat dan total modal yang baru
    //                     $dataToUpdate = [
    //                         'berat' => abs($perbedaanBerat),
    //                         'total_modal' => abs($totalModalBaru),
    //                     ];

    //                     // Perbarui data
    //                     $stockPRM->update($dataToUpdate);
    //                 }
    //             }
    //         }


    //         // Hapus data GradingKasarInput
    //         $gradingKI->delete();

    //         // Commit transaksi
    //         DB::commit();

    //         // Redirect ke index dengan pesan sukses
    //         return redirect()->route('PrmRawMaterialOutput.index')->with(['success' => 'Data Berhasil Dihapus!']);
    //     } catch (\Exception $e) {
    //         // Rollback transaksi jika terjadi kesalahan
    //         DB::rollback();

    //         // // Redirect ke index dengan pesan error
    //         // return redirect()->route('PrmRawMaterialOutput.index')->with(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
    //         // Tambahkan notifikasi SweetAlert bahwa data tidak dapat dihapus
    //         return redirect()->route('PrmRawMaterialOutput.index')->with([
    //             'success' => false,
    //             'error' => $e->getMessage(),
    //             'notification' => [
    //                 'type' => 'error',
    //                 'title' => 'Gagal Menghapus Data',
    //                 'text' => 'Data tidak dapat dihapus karena berat atau total modal dari StockTransitRawMaterial bernilai 0.'
    //             ]
    //         ]);
    //     }
    // }
}
