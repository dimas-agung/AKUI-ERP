<?php

namespace App\Http\Controllers\TransitGradingKasar;

use App\Http\Controllers\Controller;
use App\Models\GradingKasarAdjustment;
use App\Models\GradingKasarStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GradingKasarAdjustmentController extends Controller
{


    //index
    public function index()
    {
        $i = 1;

        $GradingKasarAdjustment= GradingKasarAdjustment::all();

        // return $PrmRawMaterialInput;
        // return $MasterSupplierRawMaterial;
        // return $MasterJenisRawMaterial;
        return response()->view('transit_grading.GradingKasarAdjustment.index', [
            'GradingKasarAdjustment'       => $GradingKasarAdjustment,
            'i' => $i,
        ]);
    }
    // create

    public function create()
    {
        // Mendapatkan nomor dokumen terbaru
        $GradingKasarStock = GradingKasarStock::all();

        // Mendapatkan tanggal hari ini dalam format YYYYMMDD

        return view('transit_grading.GradingKasarAdjustment.create', [
            'GradingKasarStock' => $GradingKasarStock,
        ]);
    }


    // get Data Supplier
    public function getDataStock(Request $request)
    {
        $id_box_grading_kasar = $request->id_box_grading_kasar;
        $data = GradingKasarStock::where('id_box_grading_kasar', $id_box_grading_kasar)->first();

        // Kembalikan nomor batch sebagai respons
        return response()->json($data);
    }


    public function store(
        Request $request,
    )
    // public function simpanData(Request $request)
    {
        $dataArray = json_decode($request->input('data'));
        try {
            DB::beginTransaction();

            foreach($dataArray as $item){
                // calculate modal
                $total_modal_saldo_terakhir = $item->berat_saldo_terakhir * $item->modal;
                $modal_saldo_awal =  $item->berat_saldo_awal == 0? 0:$total_modal_saldo_terakhir /$item->berat_saldo_awal;
                $dataInsert = [
                    'nomor_adjustment' =>  $item->nomor_adjustment,
                    'nomor_batch' =>  $item->nomor_batch,
                    'nomor_batch_adjustment' =>  $item->nomor_batch_adjustment,
                    'tanggal_adjustment' =>  $item->tanggal_adjustment,
                    'id_box_raw_material' =>  $item->id_box_raw_material,
                    'id_box_grading_kasar' =>  $item->id_box_grading_kasar,
                    'nama_supplier' =>  $item->nama_supplier,
                    'jenis_raw_material' =>  $item->jenis_raw_material,
                    'jenis_grading' =>  $item->jenis_grading,
                    'kadar_air' =>  $item->kadar_air,
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
                ];
                // return $dataInsert;
                $GradingKasarAdjustment = GradingKasarAdjustment::create($dataInsert);
                $GradingKasarStock = GradingKasarStock::where('id_box_grading_kasar', $GradingKasarAdjustment->id_box_grading_kasar)->first();
                $sisa_berat_stock =  $GradingKasarStock->berat_masuk -  $GradingKasarAdjustment->berat_adjustment - $GradingKasarStock->berat_keluar;
                $modal = $sisa_berat_stock == 0 ? 0 :$GradingKasarAdjustment->total_modal_saldo_terakhir / $sisa_berat_stock;
                $GradingKasarStock->update([
                    // 'sisa_berat' => $sisa_berat_stock,
                    'berat_adjustment' =>   $GradingKasarStock->berat_adjustment + $GradingKasarAdjustment->berat_adjustment ,
                    'modal' => $modal,
                    'total_modal' => $GradingKasarAdjustment->total_modal_saldo_terakhir,
                ]);
            }
            DB::commit();

            return [
                'success' => true,
                'message' => 'Data berhasil disimpan!',
                // 'redirectTo' => route('PrmRawMaterialInput.index'), // Ganti dengan nama route yang sesuai
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
            $GradingKasarAdjustment = GradingKasarAdjustment::findOrFail($id);
            $GradingKasarStock = GradingKasarStock::where('id_box_grading_kasar', $GradingKasarAdjustment->id_box_grading_kasar)->first();
                $sisa_berat_stock =  $GradingKasarStock->berat_masuk - $GradingKasarStock->berat_keluar - ($GradingKasarStock->berat_adjustment - $GradingKasarAdjustment->berat_adjustment);
                $modal = $sisa_berat_stock == 0 ? 0 :$GradingKasarStock->total_modal / $sisa_berat_stock;

                $GradingKasarStock->update([
                    // 'sisa_berat' => $sisa_berat_stock,
                    'berat_adjustment' =>  ($GradingKasarStock->berat_adjustment - $GradingKasarAdjustment->berat_adjustment),
                    'modal' =>  $modal,
                    // 'total_modal' =>  $GradingKasarStock->modal * $sisa_berat_stock,
                ]);
            // Simpan id_box dari input yang akan dihapus
            $GradingKasarAdjustment->delete();

            // Jika tidak ada kesalahan, komit transaksi
            DB::commit();

            // Kembali ke halaman index dengan pesan sukses
            return redirect()->route('GradingKasarAdjustment.index')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, rollback transaksi
            DB::rollback();

            // Kembali ke halaman index dengan pesan error
            return redirect()->route('GradingKasarAdjustment.index')->with('error', 'Gagal menghapus data');
        }
    }


}
