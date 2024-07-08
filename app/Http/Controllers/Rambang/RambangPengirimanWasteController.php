<?php

namespace App\Http\Controllers\Rambang;

use App\Models\Perusahaan;
use Illuminate\Http\Request;
use App\Models\RambangKeringInput;
use App\Models\RambangKeringStock;
use Illuminate\Support\Facades\DB;
use App\Models\TransitRambangWaste;
use App\Models\TransitWasteRambang;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Models\RambangPengirimanWaste;
use Illuminate\Support\Facades\Validator;

class RambangPengirimanWasteController extends Controller
{
    // index
    public function index(Request $request)
    {
        $i = 1;
        // $RambangPengirimanWaste = RambangPengirimanWaste::all();
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
    
        $query = RambangPengirimanWaste::query();
    
    
        if ($startDate && $endDate) {
            $query->whereBetween(RambangPengirimanWaste::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), [$startDate, $endDate]);
            $RambangPengirimanWaste = $query->get();
        }else{
            $RambangPengirimanWaste = RambangPengirimanWaste::limit(1000)
            ->latest()
            ->get();
        }
        return response()->view('Rambang.RambangPengirimanWaste.index', [
            'rambang_pengiriman_waste' => $RambangPengirimanWaste,
            'i' => $i,
        ]);
    }

    // create
    public function create()
    {
        $i = 1;
        $RambangKeringStock = RambangKeringStock::all();
        $Perusahaan = Perusahaan::all();
        return response()->view('Rambang.RambangPengirimanWaste.create', [
            'rambang_kering_stock' => $RambangKeringStock,
            'perusahaan' => $Perusahaan,
            'i' => $i,
        ]);
    }

    // Set ID Box Hancuran Kotor
    public function set(Request $request)
    {
        $id_box_hcr_kotor = $request->id_box_hcr_kotor;
        $data = RambangKeringStock::where('id_box_hcr_kotor', $id_box_hcr_kotor)->get();

        return response()->json($data);
    }
    // cekSendData
    public function CeksendData(Request $request)
    {
        // Ambil id box dari request dan konversi ke dalam array
        $idNomorBSTB = json_decode($request->idNomorBSTB);

        // Cek ketersediaan id box dalam database
        $unavailableNomorBSTB = RambangKeringStock::whereIn('id_box_hcr_kotor', $idNomorBSTB)->pluck('id_box_hcr_kotor')->toArray();
        // return $unavailableNomorBSTB;
        // Filter id box yang tidak tersedia
        $availableNomorBSTB = array_diff($idNomorBSTB, $unavailableNomorBSTB);
        // return $availableNomorBSTB;
        // Kembalikan daftar id box yang tidak tersedia sebagai respons
        return response()->json(['unavailableNomorBSTB' => $availableNomorBSTB]);
    }

    public function store(Request $request)
    {
        // Decode JSON string to associative array
        $dataArray = json_decode($request->input('dataArray'), true);

        // Validate other form fields
        $validatedData = $request->validate([
            // 'doc_no'            => 'required',
            'user_created'      => 'required',
            'user_updated'      => 'sometimes',
            'keterangan'        => 'sometimes',
            'nomor_bstb'        => 'sometimes',
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
                'id_box_hcr_kotor' => 'required', // Ganti dengan nama field yang sesuai
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
                    RambangPengirimanWaste::create($mergedData);

                    TransitRambangWaste::create([
                        'unit'                  => 'Cleaning',
                        'nomor_bstb'            => $mergedData['nomor_bstb'],
                        'jenis_rambang'         => $mergedData['jenis_rambang'],
                        'berat'                 => $mergedData['berat'],
                        'status'                => '1',
                    ]);

                    $itemObject = (object) $mergedData;

                    // Ambil semua item yang sesuai dengan kriteria
                    $existingItems = RambangKeringStock::where('id_box_hcr_kotor', $itemObject->id_box_hcr_kotor)
                        ->where('jenis_rambang', $itemObject->jenis_rambang)
                        ->get();

                    foreach ($existingItems as $existingItem) {

                        $sisaBerat = $existingItem->berat_masuk - $itemObject->berat;

                        // Update data dengan nilai baru
                        $existingItem->update([
                            'berat_keluar' => $itemObject->berat,
                            'sisa_berat'   => $sisaBerat,
                        ]);
                    }

                    $RambangKeringInput = RambangKeringInput::where('id_box_hcr_kotor', $itemObject->id_box_hcr_kotor)
                        ->where('jenis_rambang', $itemObject->jenis_rambang)
                        ->get();

                    foreach ($RambangKeringInput as $item) {
                        $item->update([
                            'status'   => 0,
                        ]);
                    }

                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();

                    return response()->json([
                        'success' => false,
                        'error' => 'Gagal menyimpan data. ' . $e->getMessage(),
                        'redirectTo' => route('RambangPengirimanWaste.create')
                    ], 504);
                }
            }
        }

        // Kembalikan data yang baru dibuat sebagai respons
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil disimpan!',
            'redirectTo' => route('RambangPengirimanWaste.index')
        ], 201);
    }

    public function destroy($nomor_bstb)
    {
        try {
            // Begin transaction
            DB::beginTransaction();

            // Temukan semua record berdasarkan nomor_bstb
            $pengirimanWastes = RambangPengirimanWaste::where('nomor_bstb', $nomor_bstb)->get();

            if ($pengirimanWastes->isEmpty()) {
                throw new \Exception('Data tidak ditemukan');
            }

            foreach ($pengirimanWastes as $RambangPengirimanWaste) {
                // Hapus semua item terkait di TransitRambangWaste
                $stockTrans = TransitRambangWaste::where('nomor_bstb', '=', $RambangPengirimanWaste->nomor_bstb)->first();

                if ($stockTrans) {
                    // Jika berat atau total modal dari StockTransitRawMaterial bernilai 0, maka hapus data
                    if ($stockTrans->berat === 0) {
                        $stockTrans->delete();
                    } else {
                        // Jika berat yang dimasukkan lebih besar atau sama dengan berat stock, hapus data
                        if ($RambangPengirimanWaste->berat >= $stockTrans->berat) {
                            $stockTrans->delete();
                        } else {
                            // Jika berat yang dimasukkan kurang dari berat stock, lakukan update sesuai kebutuhan
                            // $stockTrans->berat -= $RambangPengirimanWaste->berat;
                            // $stockTrans->save();
                        }
                    }
                }

                // Temukan semua item terkait di RambangKeringStock
                $existingItems = RambangKeringStock::where('id_box_hcr_kotor', $RambangPengirimanWaste->id_box_hcr_kotor)
                    ->where('jenis_rambang', $RambangPengirimanWaste->jenis_rambang)
                    ->get();

                // Logika Update Status
                foreach ($existingItems as $existingItem) {
                    if ($existingItem) {
                        $beratSebelumnya = $existingItem->berat_keluar;

                        // Hitung total modal baru berdasarkan perbedaan berat
                        $perbedaanBerat = $beratSebelumnya - $RambangPengirimanWaste->berat;
                        $sisaBerat = $existingItem->berat_keluar - $perbedaanBerat;

                        $existingItem->update(['berat_keluar' => $perbedaanBerat]);
                        $existingItem->update(['sisa_berat' => $sisaBerat]);
                    }
                }

                // Temukan semua item terkait di RambangKeringStock
                $RambangKeringInput = RambangKeringInput::where('id_box_hcr_kotor', $RambangPengirimanWaste->id_box_hcr_kotor)
                    ->where('jenis_rambang', $RambangPengirimanWaste->jenis_rambang)
                    ->get();
                foreach ($RambangKeringInput as $item) {
                    if ($item) {
                        $item->update(['status' => 1]);
                    }
                }


                // Hapus record utama
                $RambangPengirimanWaste->delete();
            }

            // Jika tidak ada kesalahan, komit transaksi
            DB::commit();

            return redirect()->route('RambangPengirimanWaste.index')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, rollback transaksi
            DB::rollback();

            return redirect()->route('RambangPengirimanWaste.index')->with('error', 'Gagal menghapus data');
        }
    }
}
