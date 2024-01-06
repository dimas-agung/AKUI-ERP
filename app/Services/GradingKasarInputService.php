<?php
namespace App\Services;
use App\Models\GradingKasarInput;
use App\Models\StockTransitGradingKasar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GradingKasarInputService
{
    public function sendData($dataArray)
    {
        try {
            DB::beginTransaction();

            foreach ($dataArray as $item) {
                $this->createItem($item);
            }


            DB::commit();

            return [
                'success' => true,
                'message' => 'Data berhasil disimpan!',
                'redirectTo' => route('GradingKasarInput.index'), // Ganti dengan nama route yang sesuai
            ];
        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'success' => false,
                'error' => 'Gagal menyimpan data. ' . $e->getMessage(),
            ];
        }
    }


    private function createItem($item)
    {
        GradingKasarInput::create([
            'nomor_bstb'    => $item->nomor_bstb,
            'id_box'        => $item->id_box,
            'nomor_batch'   => $item->nomor_batch,
            'nama_supplier' => $item->nama_supplier,
            'jenis'         => $item->jenis,
            'kadar_air'     => $item->kadar_air,
            'berat'         => $item->berat,
            'nomor_grading'  => $item->nomor_grading,
            'modal'         => $item->modal,
            'total_modal'   => $item->total_modal,
            'keterangan'=> $item->keterangan,
            'user_created'  => $item->user_created,
            'user_updated'  => $item->user_updated ?? "There isn't any",
            // Sesuaikan dengan kolom-kolom lain di tabel item Anda
        ]);
    }

    public function updateItem($request, $id) {
        try {
            DB::beginTransaction();
            // Update item
            $GradingKI = GradingKasarInput::findOrFail($id);
            $stockTGK = StockTransitGradingKasar::where('id', $id)->first();
            $GradingKI->update($request->all());
            DB::commit();

        return redirect()->route('GradingKasarInput.index')->with(['success' => 'Data Berhasil Diubah!']);
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                'success' => false,
                'error' => 'Gagal menyimpan data. ' . $e->getMessage(),
            ];
        }
    }

    protected function validateRequest(Request $request)
    {
        $request->validate([
            'nomor_bstb'   => 'required',
            'nomor_batch'  => 'required',
            'id_box'       => 'required',
            'nama_supplier'=> 'required',
            'jenis'        => 'required',
            'berat'        => 'required',
            'kadar_air'    => 'required',
            'tujuan_kirim' => 'required',
            'letak_tujuan' => 'required',
            'inisial_tujuan'=> 'required',
            'modal'        => 'required',
            'total_modal'  => 'required',
            'keterangan_item'    => '',
            'user_created' => '',
            'user_updated' => ''
        ], [
            'nomor_bstb.required' => 'Kolom Nomer BSTB Wajib diisi.'
        ]);
    }
}
