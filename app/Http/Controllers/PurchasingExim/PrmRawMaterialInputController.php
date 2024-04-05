<?php

namespace App\Http\Controllers\PurchasingExim;

use Illuminate\Http\Request;
use App\Imports\prmExcelImport;
use Illuminate\Support\Facades\DB;
use App\Models\PrmRawMaterialInput;
use App\Models\PrmRawMaterialStock;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\RedirectResponse;
use App\Models\MasterJenisRawMaterial;
use App\Models\PrmRawMaterialInputItem;
use App\Models\MasterSupplierRawMaterial;
use App\Models\PrmRawMaterialStockHistory;
use App\Http\Requests\PrmRawMaterialRequest;
use App\Services\PrmRawMaterialInputService;
use App\Http\Requests\PrmRawMaterialItemRequest;
use App\Services\PrmRawMaterialInputItemService;
use Symfony\Component\HttpFoundation\Session\Session;


class PrmRawMaterialInputController extends Controller
{
    // import
    // public function importExcel(Request $request)
    // {
    //     Excel::import(new prmExcelImport, $request->file('file'));

    //     return redirect()->route('PrmRawMaterialInput.index')->with('success', 'All good!');
    // }

    public function importExcel(Request $request)
    {
        Excel::import(new prmExcelImport, $request->file('file'), null, \Maatwebsite\Excel\Excel::XLSX);
        // return response()->json($data);
        return redirect()->route('PrmRawMaterialInput.index')->with('success', 'Data Berhasil di Import!');
    }

    //index
    public function index()
    {
        $i = 1;
        $MasterSupplierRawMaterial = MasterSupplierRawMaterial::with('PrmRawMaterialInput')->get();
        $MasterJenisRawMaterial = MasterJenisRawMaterial::with('PrmRawMaterialInputItem')->get();
        $PrmRawMaterialInputItem = PrmRawMaterialInputItem::with('PrmRawMaterialInput')->get();
        $PrmRawMaterialInput = PrmRawMaterialInput::with(['MasterSupplierRawMaterial', 'PrmRawMaterialStock'])->get();
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
    // public function create()
    // {
    //     $MasterSupplierRawMaterial = MasterSupplierRawMaterial::with('PrmRawMaterialInput')->get();
    //     $MasterJenisRawMaterial = MasterJenisRawMaterial::with('PrmRawMaterialInputItem')->get();
    //     return view('purchasing_exim/prm_raw_material_input.create', [
    //         'master_supplier_raw_materials' => $MasterSupplierRawMaterial,
    //         'master_jenis_raw_materials'    => $MasterJenisRawMaterial,
    //     ]);
    // }
    public function create()
    {
        // Mendapatkan nomor dokumen terbaru
        $latestDocumentNumber = PrmRawMaterialInput::latest('doc_no')->value('doc_no');

        // Mendapatkan tanggal hari ini dalam format YYYYMMDD
        $currentDate = date('Ymd');

        // Mendapatkan angka berikutnya yang belum digunakan
        $nextDocumentNumber = $this->getNextDocumentNumber($latestDocumentNumber, $currentDate);

        $MasterSupplierRawMaterial = MasterSupplierRawMaterial::with('PrmRawMaterialInput')->get();
        $MasterJenisRawMaterial = MasterJenisRawMaterial::with('PrmRawMaterialInputItem')->get();
        return view('purchasing_exim/prm_raw_material_input.create', [
            'master_supplier_raw_materials' => $MasterSupplierRawMaterial,
            'master_jenis_raw_materials'    => $MasterJenisRawMaterial,
            'next_document_number'          => $nextDocumentNumber,
        ]);
    }

    // Fungsi untuk mendapatkan angka berikutnya yang belum digunakan
    private function getNextDocumentNumber($latestDocumentNumber, $currentDate)
    {
        // Jika tidak ada nomor dokumen sebelumnya, gunakan tanggal hari ini dengan angka 01
        if (!$latestDocumentNumber || strpos($latestDocumentNumber, $currentDate) === false) {
            return $currentDate . '01';
        }

        // Jika sudah ada nomor dokumen sebelumnya, tambahkan 1 ke nomor sebelumnya
        $lastNumber = intval(substr($latestDocumentNumber, -2));
        $nextNumber = $lastNumber + 1;
        return $currentDate . sprintf('%02d', $nextNumber);
    }



    public function detail()
    {
        $i = 1;
        $prmRawMaterialInputs = PrmRawMaterialInput::with('prmRawMaterialInputItem')->get();
        return view('purchasing_exim.prm_raw_material_input.detail', [
            'prm_raw_material_inputs' => $prmRawMaterialInputs,
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
}
