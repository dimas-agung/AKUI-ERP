<?php

namespace App\Http\Controllers\PurchasingExim;

use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Models\PrmRawMaterialOutputHeader;
use App\Models\PrmRawMaterialOutputItem;
use App\Models\PrmRawMaterialStock;
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
    public function index(){
        $i =1;
        $PrmRawMOH = PrmRawMaterialOutputHeader::with('PrmRawMaterialOutputItem')->get();
        $PrmRawMOIC = PrmRawMaterialOutputItem::with('PrmRawMaterialOutputHeader')->get();
        // return $PrmRawMOIC;
        return response()->view('purchasing_exim.PrmRawMaterialOutput.index', [
            'PrmRawMOIC' => $PrmRawMOIC,
            'PrmRawMOH' => $PrmRawMOH,
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
        $data = PrmRawMaterialStock::where('id_box',$id_box)->first();

        // Kembalikan nomor batch sebagai respons
        return response()->json($data);
    }

    public function setpcc(Request $request)
    {
        $tujuan_kirim = $request->tujuan_kirim;
        // Lakukan logika untuk mengatur nomor batch berdasarkan tujuan_kirim
        $data = MasterTujuanKirimRawMaterial::where('tujuan_kirim',$tujuan_kirim)->first();

        // Kembalikan nomor batch sebagai respons
        return response()->json($data);
    }

    // Contoh controller
    public function sendData(
        PrmRawMaterialOutputRequest $request,
        PrmRawMaterialOutputService $prmRawMaterialOutputService)
    {
    $dataArray = json_decode($request->input('data'));
    // $dataStock = json_decode($request->input('dataStock'));
    $dataHeader = json_decode($request->input('dataHeader'));

        // $result = $this->$prmRawMaterialOutputService->sendData($dataHeader[0], $dataArray);
        $result = $prmRawMaterialOutputService->sendData($dataHeader[0], $dataArray);

        if ($result['success']) {
            return response()->json($result);
        } else {
            return response()->json($result, 500);
        }

    }

    //     //validate form
    //     $this->validate($request, [
    //         'doc_no.*'       => 'required',
    //         'nomor_bstb.*'   => 'required|unique',
    //         'nomor_batch.*'  => 'required',
    //         'id_box'       => 'required',
    //         'nama_supplier'=> 'required',
    //         'jenis'        => 'required',
    //         'berat'        => 'required',
    //         'kadar_air'    => 'required',
    //         'tujuan_kirim' => 'required',
    //         'letak_tujuan' => 'required',
    //         'inisial_tujuan'=> 'required',
    //         'modal'        => 'required',
    //         'total_modal'  => 'required',
    //         'keterangan'   => 'required',
    //         'keterangan_item'   => 'required',
    //         'user_created.*'    => 'required',
    //         'user_updated.*'    => 'required'
    //     ]);

    //     //create post
    //     PrmRawMaterialOutputItem::create([
    //         'doc_no'        => $request->doc_no,
    //         'nomor_bstb'    => $request->nomor_bstb,
    //         'nomor_batch'   => $request->nomor_batch,
    //         'id_box'        => $request->id_box,
    //         'nama_supplier' => $request->nama_supplier,
    //         'jenis'         => $request->jenis,
    //         'berat'         => $request->berat,
    //         'kadar_air'     => $request->kadar_air,
    //         'tujuan_kirim'  => $request->tujuan_kirim,
    //         'letak_tujuan'  => $request->letak_tujuan,
    //         'inisial_tujuan'=> $request->inisial_tujuan,
    //         'modal'         => $request->modal,
    //         'total_modal'   => $request->total_modal,
    //         'keterangan_item'=> $request->keterangan_item,
    //         'user_created'  => $request->user_created,
    //         'user_updated'  => $request->user_updated
    //     ]);
    //     PrmRawMaterialOutputHeader::create([
    //         'doc_no'        => $request->doc_no,
    //         'nomor_bstb'    => $request->nomor_bstb,
    //         'nomor_batch'   => $request->nomor_batch,
    //         'keterangan'    => $request->keterangan,
    //         'user_created'  => $request->user_created,
    //         'user_updated'  => $request->user_updated
    //     ]);

    //     //redirect to index
    //     return redirect()->route('PrmRawMaterialOutput.index')->with(['success' => 'Data Berhasil Disimpan!']);
    // }

    // Show
    public function show(string $id)
    {
        //get post by ID
        $i =1;
        // $PrmRawMOIC = PrmRawMaterialOutputItem::findOrFail($id);
        $headers = PrmRawMaterialOutputHeader::findOrFail($id);
        $items = $headers->PrmRawMaterialOutputItem;

        //render view with post
        return view('purchasing_exim.PrmRawMaterialOutput.show', compact('items', 'i'));
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
        // return $PrmRawMO;
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
        //get post by ID
        $PrmRawMOIC = PrmRawMaterialOutputItem::findOrFail($id);

        //delete post
        $PrmRawMOIC->delete();

        //redirect to index
        return redirect()->route('PrmRawMaterialOutput.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
    public function destroyHead($id): RedirectResponse
    {
        //get post by ID\
        $PrmRawMOH = PrmRawMaterialOutputHeader::findOrFail($id);
        $PrmRawMOH->delete();

        //redirect to index
        return redirect()->route('PrmRawMaterialOutput.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
