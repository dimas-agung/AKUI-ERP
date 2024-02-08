<?php

namespace App\Http\Controllers\PurchasingExim;

use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Models\PrmRawMaterialOutputItem;
use App\Models\PrmRawMaterialStock;
use App\Models\StockTransitRawMaterial;
use App\Models\StockTransitGradingKasar;
use App\Services\PrmRawMaterialOutputService;
use App\Http\Requests\PrmRawMaterialOutputRequest;
use App\Models\MasterTujuanKirimRawMaterial;
use Illuminate\Http\Request;

//return type redirectResponse
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class PrmRawMaterialOutputController extends Controller
{
    public function index()
    {
        $i = 1;
        $PrmRawMOIC = PrmRawMaterialOutputItem::all();
        // return $PrmRawMOIC;
        return response()->view('purchasing_exim.PrmRawMaterialOutput.index', [
            'PrmRawMOIC' => $PrmRawMOIC,
            'i' => $i,
        ]);
    }

    /**
     * Create
     */
    public function create(): View
    {
        $PrmRawMS = PrmRawMaterialStock::with('PrmRawMaterialOutputItem')->get();
        $MasTujKir = MasterTujuanKirimRawMaterial::with('PrmRawMaterialOutputItem')->get();
        $PrmRawMOIC = PrmRawMaterialOutputItem::with('PrmRawMaterialStock')->get();
        // return $PrmRawMOIC;
        return view('purchasing_exim.PrmRawMaterialOutput.create', compact('PrmRawMOIC', 'PrmRawMS', 'MasTujKir'));
    }

    public function set(Request $request)
    {
        $id_box = $request->id_box;
        // Lakukan logika untuk mengatur nomor batch berdasarkan id_box
        $data = PrmRawMaterialStock::where('id_box', $id_box)->first();

        // Kembalikan nomor batch sebagai respons
        return response()->json($data);
    }

    public function setpcc(Request $request)
    {
        $tujuan_kirim = $request->tujuan_kirim;
        // Lakukan logika untuk mengatur nomor batch berdasarkan tujuan_kirim
        $data = MasterTujuanKirimRawMaterial::where('tujuan_kirim', $tujuan_kirim)->first();

        // Kembalikan nomor batch sebagai respons
        return response()->json($data);
    }

    // Contoh controller
    public function sendData(
        PrmRawMaterialOutputRequest $request,
        PrmRawMaterialOutputService $prmRawMaterialOutputService
    ) {
        try {
            $dataArray = json_decode($request->input('data'));
            // return $request->input('data');
            // $dataStock = json_decode($request->input('dataStock'));

            // Periksa apakah dekoding JSON berhasil
            if (!$dataArray) {
                throw new \InvalidArgumentException('Invalid JSON data.');
            }

            $result = $prmRawMaterialOutputService->sendData($dataArray);

            // Periksa apakah pemrosesan berhasil
            if ($result['success']) {
                return response()->json($result);
            } else {
                return response()->json($result, 500);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        //validate form
        $this->validate($request, [
            'unit_id'   => 'required',
            'jenis_biaya'   => 'required',
            'biaya_per_gram'   => 'required',
            'doc_no'        => 'required',
            'nomor_bstb'    => 'required',
            'nomor_batch'   => 'required',
            'id_box'        => 'required',
            'nama_supplier' => 'required',
            'jenis'         => 'required',
            'berat'         => 'required',
            'kadar_air'     => 'required',
            'tujuan_kirim'  => 'required',
            'letak_tujuan'  => 'required',
            'inisial_tujuan' => 'required',
            'modal'         => 'required',
            'total_modal'   => 'required',
            'keterangan_item' => 'required',
            'user_created'  => 'required'
        ]);

        //create post
        PrmRawMaterialOutputItem::create([
            'doc_no'        => $request->doc_no,
            'nomor_bstb'    => $request->nomor_bstb,
            'nomor_batch'   => $request->nomor_batch,
            'id_box'        => $request->id_box,
            'nama_supplier' => $request->nama_supplier,
            'jenis'         => $request->jenis,
            'berat'         => $request->berat,
            'kadar_air'     => $request->kadar_air,
            'tujuan_kirim'  => $request->tujuan_kirim,
            'letak_tujuan'  => $request->letak_tujuan,
            'inisial_tujuan' => $request->inisial_tujuan,
            'modal'         => $request->modal,
            'total_modal'   => $request->total_modal,
            'keterangan_item' => $request->keterangan_item,
            'user_created'  => $request->user_created,
            'user_updated'  => $request->user_updated ?? "There isn't any",
        ]);

        //redirect to index
        return response()->json(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * edit
     */
    public function edit(string $id)
    {
        //get post by ID
        $PrmRawMOIC = PrmRawMaterialOutputItem::with('PrmRawMaterialStock')->find($id);
        $PrmRawMO = PrmRawMaterialOutputItem::with('PrmRawMaterialStock')->find($id);
        $MasTujKir = MasterTujuanKirimRawMaterial::with('PrmRawMaterialOutputItem')->get();
        $PrmRawMS = PrmRawMaterialStock::with('PrmRawMaterialOutputItem')->get();
        // return $PrmRawMS;
        // Pastikan $PrmRawMO tidak null sebelum mengakses propertinya
        if ($PrmRawMO !== null) {
            // Mengakses berat_masuk dari relasi PrmRawMaterialStock
            $beratMasuk = optional($PrmRawMO->PrmRawMaterialStock)->berat_masuk;
            $sisaberat = optional($PrmRawMO->PrmRawMaterialStock)->sisa_berat;

            // Rest of your code...
        } else {
            // Handle case when the record with the given $id is not found
        }

        //render view with post
        return view('purchasing_exim.PrmRawMaterialOutput.update', compact('PrmRawMOIC', 'PrmRawMS', 'beratMasuk', 'sisaberat', 'PrmRawMO', 'MasTujKir'));
    }

    /**
     * update
     */
    public function update(Request $request, $id)
    {
        $prmRawMaterialOutputService = app(PrmRawMaterialOutputService::class);

        // Lakukan sesuatu dengan layanan
        $result = $prmRawMaterialOutputService->updateItem($request, $id);

        // Lakukan sesuatu dengan hasil
        return $result;
    }

    /**
     * destroy
     */
    public function destroy($id): RedirectResponse
    {
        try {
            // Gunakan transaksi database untuk memastikan konsistensi
            DB::beginTransaction();

            // Ambil data GradingKasarInput yang akan dihapus
            $gradingKI = PrmRawMaterialOutputItem::findOrFail($id);

            // Ambil data StockTransitRawMaterial berdasarkan nomor_bstb
            $stockPrmRawMaterial = PrmRawMaterialStock::where('id_box', '=', $gradingKI->id_box)->first();

            if ($stockPrmRawMaterial) {
                // Simpan nilai sebelum dihapus
                $beratTadi = $gradingKI->berat;
                $beratSebelumnya = $stockPrmRawMaterial->berat_keluar;
                $beratMasuk = $stockPrmRawMaterial->berat_masuk;
                $Modal = $gradingKI->modal;
                $Beratkeluar = $beratSebelumnya - $beratTadi;
                $sisaBerat = $beratMasuk - $Beratkeluar;
                $TotalModal = $Beratkeluar * $Modal;

                // Update data pada PrmRawMaterialStock
                $dataToUpdate = [
                    'berat_keluar' => $Beratkeluar,
                    'sisa_berat' => $sisaBerat,
                    'total_modal' => $TotalModal,
                ];

                // Perbarui data pada PrmRawMaterialStock
                $stockPrmRawMaterial->update($dataToUpdate);
            }

            // Ambil data StockTransitRawMaterial berdasarkan tujuan_kirim dan id_box
            $stockPRM = StockTransitRawMaterial::where('tujuan_kirim', '=', $gradingKI->tujuan_kirim)
            ->where('id_box', $gradingKI->id_box)
            ->first();

            if ($stockPRM) {
                // Jika berat atau total modal dari StockTransitRawMaterial bernilai 0, maka hapus data
                if ($stockPRM->berat === 0) {
                    $stockPRM->delete();
                } else {
                    // Jika berat yang dimasukkan lebih besar atau sama dengan berat stock, hapus data
                    if ($gradingKI->berat >= $stockPRM->berat) {
                        $stockPRM->delete();
                    } else {
                        // Ambil berat sebelumnya
                        $beratSebelumnya = $stockPRM->berat;
                        $beratMasuk = $stockPRM->berat;

                        // Hitung total modal baru berdasarkan perbedaan berats
                        $perbedaanBerat = $beratSebelumnya - $gradingKI->berat;
                        $totalModalBaru = $perbedaanBerat * $gradingKI->modal;

                        // Update data dengan berat dan total modal yang baru
                        $dataToUpdate = [
                            'berat' => abs($perbedaanBerat),
                            'total_modal' => abs($totalModalBaru),
                        ];

                        // Perbarui data
                        $stockPRM->update($dataToUpdate);
                    }
                }
            }

            // if ($stockPRM) {
            //     // Jika berat dari StockTransitRawMaterial bernilai 0, maka hapus data
            //     if ($stockPRM->berat === 0) {
            //         $stockPRM->delete();
            //     } else {
            //         // Jika berat yang dimasukkan lebih besar atau sama dengan berat stock, hapus data
            //         if ($gradingKI->berat_masuk >= $stockPRM->berat) {
            //             $stockPRM->delete();
            //         } else {
            //             // Ambil berat sebelumnya
            //             $beratSebelumnya = $stockPRM->berat;
            //             $beratMasuk = $stockPRM->berat_masuk;

            //             // Hitung total modal baru berdasarkan perbedaan berats
            //             $perbedaanBerat = $gradingKI->berat_masuk - $beratSebelumnya;
            //             $sisaBerat = $beratMasuk - $beratSebelumnya;
            //             $totalModalBaru = $sisaBerat * $gradingKI->modal;

            //             // Periksa apakah berat setelah perubahan menjadi 0, jika ya, hapus data
            //             if ($beratSebelumnya + $perbedaanBerat === 0) {
            //                 $stockPRM->delete();
            //             } else {
            //                 // Update data dengan berat dan total modal yang baru
            //                 $dataToUpdate = [
            //                     'berat' => abs($beratSebelumnya + $perbedaanBerat),
            //                     'total_modal' => abs($totalModalBaru),
            //                 ];

            //                 // Perbarui data
            //                 $stockPRM->update($dataToUpdate);
            //             }
            //         }
            //     }
            // }



            // Hapus data GradingKasarInput
            $gradingKI->delete();

            // Commit transaksi
            DB::commit();

            // Redirect ke index dengan pesan sukses
            return redirect()->route('PrmRawMaterialOutput.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();

            // // Redirect ke index dengan pesan error
            // return redirect()->route('PrmRawMaterialOutput.index')->with(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
            // Tambahkan notifikasi SweetAlert bahwa data tidak dapat dihapus
            return redirect()->route('PrmRawMaterialOutput.index')->with([
                'success' => false,
                'error' => $e->getMessage(),
                'notification' => [
                    'type' => 'error',
                    'title' => 'Gagal Menghapus Data',
                    'text' => 'Data tidak dapat dihapus karena berat atau total modal dari StockTransitRawMaterial bernilai 0.'
                ]
            ]);
        }
    }
}
