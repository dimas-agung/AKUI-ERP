<?php

namespace App\Http\Controllers\TransitGradingKasar;

use App\Http\Controllers\Controller;
use App\Http\Requests\GradingKasarInputRequest;
use App\Models\GradingKasarHasil;
use App\Models\GradingKasarInput;
use App\Models\StockTransitRawMaterial;
use App\Models\PrmRawMaterialOutputItem;
use App\Services\GradingKasarInputService;
use Illuminate\Http\Request;
//return type View
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

//return type redirectResponse
use Illuminate\Http\RedirectResponse;

class GradingKasarInputController extends Controller
{
    public function index(){
        $i =1;
        $GradingKI = GradingKasarInput::with('StockTransitRawMaterial')->get();
        $GradingKH = GradingKasarHasil::with('GradingKasarInput')->first();
        // return $GradingKH;

        // return $GradingKI;
        return response()->view('transit_grading.GradingKasarInput.index', [
            'GradingKI' => $GradingKI,
            'GradingKH' => $GradingKH,
            'i' => $i,
        ]);
    }

    /**
     * Create
     */
    public function create(): View
    {
        $stockTGK = StockTransitRawMaterial::with('PramRawMaterialOutputItems')->get();
        $GradingKI = GradingKasarInput::with('StockTransitRawMaterial')->get();
        // return $PrmRawMOIC;
        return view('transit_grading.GradingKasarInput.create', compact('stockTGK', 'GradingKI'));
    }

    public function set(Request $request)
    {
        $nomor_bstb = $request->nomor_bstb;
        $data = StockTransitRawMaterial::where('nomor_bstb',$nomor_bstb)->first();

        // Kembalikan nomor batch sebagai respons
        return response()->json($data);
    }

    // Contoh controller
    public function sendData(
        GradingKasarInputRequest $request,
        GradingKasarInputService $prmRawMaterialOutputService)
    { try {
        $dataArray = json_decode($request->input('data'));

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

    /**
     * edit
     */
    public function edit(string $id)
    {
        //get post by ID
        $GradingKI = GradingKasarInput::with('StockTransitRawMaterial')->find($id);
        $data = StockTransitRawMaterial::with('GradingKasarInput')->get();
        // return $GradingKI;

        //render view with post
        return view('transit_grading.GradingKasarInput.update', compact('GradingKI', 'data'));
    }

    /**
     * update
     */
    public function update(Request $request, $id)
    {
        $prmRawMaterialOutputService = app(GradingKasarInputService::class);

        // Lakukan sesuatu dengan layanan
        $result = $prmRawMaterialOutputService->updateItem($request, $id);

        // Lakukan sesuatu dengan hasil
        return $result;
    }

    /**
     * destroy
     */
    public function destroy($id): RedirectResponse {
        try {
            // Gunakan transaksi database untuk memastikan konsistensi
            DB::beginTransaction();

            // Ambil data GradingKasarInput yang akan dihapus
            $gradingKI = GradingKasarInput::findOrFail($id);

             // Periksa apakah nomor_bstb sudah ada di GradingKasarHasil
            $gradingKasarHasil = GradingKasarHasil::where('id_box_raw_material', $gradingKI->id_box)->first();
            if ($gradingKasarHasil) {
                // Rollback transaksi jika nomor_bstb sudah ada di GradingKasarHasil
                DB::rollback();
                // return redirect()->route('GradingKasarInput.index')->with(['error' => 'Nomor BSTB sudah berada di GradingKasarHasil. Data tidak dapat dihapus.']);
                return redirect()->route('GradingKasarInput.index')->with([
                    'success' => false,
                    'notification' => [
                        'type' => 'error',
                        'title' => 'Gagal Menghapus Data',
                        'text' => 'Data sudah berada di Grading Kasar Hasil. Data tidak dapat dihapus.'
                    ]
                ]);
            }
            // Ambil data StockTransitRawMaterial berdasarkan nomor_bstb
            $stockPrmRawMaterial = StockTransitRawMaterial::where('nomor_bstb', '=', $gradingKI->nomor_bstb)->first();

            if ($stockPrmRawMaterial) {
                // Simpan nilai sebelum dihapus
                $beratSebelumnya = $gradingKI->berat;
                $totalModalSebelumnya = $gradingKI->total_modal;

                $dataToUpdate = [
                    'nomor_bstb' => $gradingKI->nomor_bstb,
                    'berat' => $beratSebelumnya,
                    'total_modal' => $totalModalSebelumnya,
                ];

                if ($stockPrmRawMaterial) {
                    // Ambil berat sebelumnya
                    $beratSebelumnya = $stockPrmRawMaterial->berat;

                    // Hitung total modal baru berdasarkan perbedaan berats
                    $perbedaanBerat = $beratSebelumnya - $gradingKI->berat;
                    $totalModalBaru = $perbedaanBerat * $gradingKI->modal;
                    // $totalModalBaru = $stockPrmRawMaterial->total_modal + ($perbedaanBerat * $itemObject->modal);

                    // Update data dengan berat dan total modal yang baru
                    $dataToUpdate['berat'] = abs($perbedaanBerat);
                    $dataToUpdate['total_modal'] = abs($totalModalBaru);

                    // Perbarui data
                    $stockPrmRawMaterial->update($dataToUpdate);
                } else {
                    // Jika item tidak ada, buat item baru dengan nilai lainnya tetap sama
                    StockTransitRawMaterial::create(array_merge($dataToUpdate, [
                        'id_box'               => $gradingKI->id_box,
                        'nomor_batch'          => $gradingKI->nomor_batch,
                        'jenis'                => $gradingKI->jenis,
                        'kadar_air'            => $gradingKI->kadar_air,
                        'tujuan_kirim'         => $gradingKI->tujuan_kirim,
                        'letak_tujuan'         => $gradingKI->letak_tujuan,
                        'inisial_tujuan'       => $gradingKI->inisial_tujuan,
                        'modal'                => $gradingKI->modal,
                        'keterangan'           => $gradingKI->keterangan,
                        'user_created'         => $gradingKI->user_updated ?? "There isn't any",
                        'nomor_nota_internal'  => $gradingKI->nomor_nota_internal,
                        // Sesuaikan dengan kolom-kolom lain di tabel item Anda
                    ]));
                }
            }

            // Hapus data GradingKasarInput
            $gradingKI->delete();

            // Commit transaksi
            DB::commit();

            // Redirect ke index dengan pesan sukses
            return redirect()->route('GradingKasarInput.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollback();

            // Redirect ke index dengan pesan error
            return redirect()->route('GradingKasarInput.index')->with(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
