<?php

namespace App\Http\Controllers\PurchasingExim;

use App\Http\Controllers\Controller;
use App\Models\PrmRawMaterialAdjustment;
use App\Models\PrmRawMaterialStock;
use App\Services\PrmRawMaterialInputService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PrmRawMaterialAdjustmentController extends Controller
{


    //index
    public function index()
    {
        $i = 1;

        $PrmRawMaterialAdjustment= PrmRawMaterialAdjustment::all();

        // return $PrmRawMaterialInput;
        // return $MasterSupplierRawMaterial;
        // return $MasterJenisRawMaterial;
        return response()->view('purchasing_exim.prm_raw_material_adjustment.index', [
            'PrmRawMaterialAdjustment'       => $PrmRawMaterialAdjustment,
            'i' => $i,
        ]);
    }
    // create

    public function create()
    {
        // Mendapatkan nomor dokumen terbaru
        $PrmRawMaterialStock = PrmRawMaterialStock::all();

        // Mendapatkan tanggal hari ini dalam format YYYYMMDD

        return view('purchasing_exim/prm_raw_material_adjustment.create', [
            'PrmRawMaterialStock' => $PrmRawMaterialStock,
        ]);
    }


    // get Data Supplier
    public function getDataStock(Request $request)
    {
        $id_box_raw_material = $request->id_box_raw_material;
        $data = PrmRawMaterialStock::where('id_box', $id_box_raw_material)->first();

        // Kembalikan nomor batch sebagai respons
        return response()->json($data);
    }


    public function store(
        Request $request,
        PrmRawMaterialInputService $PrmRawMaterialInputService
    )
    // public function simpanData(Request $request)
    {
        $dataArray = json_decode($request->input('data'));
        try {
            DB::beginTransaction();

            foreach($dataArray as $item){
                // calculate modal
                $total_modal_saldo_terakhir = $item->berat_saldo_terakhir * $item->modal;
                $modal_saldo_awal =  $total_modal_saldo_terakhir /$item->berat_saldo_awal;
                $PrmRawMaterialAdjustment = PrmRawMaterialAdjustment::create([
                    'id_box_raw_material' =>  $item->id_box_raw_material,
                    'nomor_adjustment' =>  $item->nomor_adjustment,
                    'tanggal_adjustment' =>  $item->tanggal_adjustment,
                    'nama_supplier' =>  $item->berat_saldo_awal,
                    'nomor_batch_adjustment' =>  $item->nomor_batch_adjustment,
                    'nomor_batch' =>  $item->nomor_batch,
                    'jenis' =>  $item->berat_saldo_awal,
                    'berat_adjustment' =>  $item->berat_adjustment,
                    'berat_saldo_awal' =>  $item->berat_saldo_awal,
                    'berat_saldo_terakhir' =>  $item->berat_saldo_terakhir,
                    'modal_saldo_terakhir' => $item->modal,
                    'berat_saldo_awal' => $item->berat_saldo_awal,
                    'modal_saldo_awal' => $modal_saldo_awal,
                    'total_modal_saldo_awal' => $modal_saldo_awal *  $item->berat_saldo_awal,
                    'total_modal_saldo_terakhir' => $total_modal_saldo_terakhir,
                    'keterangan' => $item->keterangan,
                    'user_created' => Auth::user()->nip,
                ]);
                $PrmRawMaterialStock = PrmRawMaterialStock::where('id_box', $PrmRawMaterialAdjustment->id_box_raw_material)->first();
                $sisa_berat_stock =  $PrmRawMaterialStock->sisa_berat -  $PrmRawMaterialAdjustment->berat_adjustment;
                $PrmRawMaterialStock->update([
                    'sisa_berat' => $sisa_berat_stock,
                    'berat_adjustment' =>   $PrmRawMaterialStock->berat_adjustment + $PrmRawMaterialAdjustment->berat_adjustment ,
                    'total_modal' => $PrmRawMaterialStock->modal * (int)$sisa_berat_stock,
                ]);
            }
            DB::commit();

            return [
                'success' => true,
                'message' => 'Data berhasil disimpan!',
                'redirectTo' => route('PrmRawMaterialInput.index'), // Ganti dengan nama route yang sesuai
            ];
        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'success' => false,
                'error' => 'Gagal menyimpan data. ' . $e->getMessage(),
            ];
        }

    }


    // test
    public function destroy($id)
    {

        try {
            // Gunakan transaksi database untuk memastikan konsistensi
            DB::beginTransaction();
            // Temukan record berdasarkan ID
            $PrmRawMaterialAdjustment = PrmRawMaterialAdjustment::findOrFail($id);
            $PrmRawMaterialStock = PrmRawMaterialStock::where('id_box', $PrmRawMaterialAdjustment->id_box_raw_material)->first();
                $sisa_berat_stock =  $PrmRawMaterialStock->berat_masuk - $PrmRawMaterialStock->berat_keluar - ($PrmRawMaterialStock->berat_adjustment - $PrmRawMaterialAdjustment->berat_adjustment);
                $PrmRawMaterialStock->update([
                    'sisa_berat' => $sisa_berat_stock,
                    'berat_adjustment' =>  ($PrmRawMaterialStock->berat_adjustment - $PrmRawMaterialAdjustment->berat_adjustment),
                    'total_modal' =>  $PrmRawMaterialStock->modal * $sisa_berat_stock,
                ]);
            // Simpan id_box dari input yang akan dihapus
            $PrmRawMaterialAdjustment->delete();

            // Jika tidak ada kesalahan, komit transaksi
            DB::commit();

            // Kembali ke halaman index dengan pesan sukses
            return redirect()->route('PrmRawMaterialAdjustment.index')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, rollback transaksi
            DB::rollback();

            // Kembali ke halaman index dengan pesan error
            return redirect()->route('PrmRawMaterialAdjustment.index')->with('error', 'Gagal menghapus data');
        }
    }


}
