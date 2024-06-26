<?php

namespace App\Http\Controllers\DryAWaste;

// use DataTables;
use Illuminate\Http\Request;
use App\Models\DryAWasteInput;
use App\Models\DryAWasteStock;
use Yajra\DataTables\DataTables;
use App\Models\MasterJenisWaste;
use App\Http\Controllers\Controller;
use App\Services\DryAWasteInputService;

class DryAWasteInputController extends Controller
{
    // Test ServerSide
    // public function index(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $data = DryAWasteInput::select('*');
    //         return DataTables::of($data)
    //             ->addIndexColumn()
    //             ->addColumn('action', function ($row) {

    //                 // $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
    //                 $btn = '<form style="display: flex" id="deleteForm' . $row->id . '"
    //                         action="' . route('DryAWasteInput.destroy', $row->id) . '"
    //                         method="POST">
    //                         ' . csrf_field() . '
    //                         ' . method_field('DELETE') . '
    //                         <button type="button" class="btn btn-link" data-original-title="Remove"
    //                             onclick="confirmDelete(' . $row->id . ')">
    //                             <i class="bi bi-trash3 text-danger"></i>
    //                         </button>
    //                     </form>';

    //                 return $btn;
    //             })
    //             ->rawColumns(['action'])
    //             ->make(true);
    //     }

    //     return view('DryAWaste.DryAWasteInput.index');
    // }

    protected $dryAWasteInputs = null;
    protected $masterJenisWastes = null;
    protected $DryAWasteInputService;

    public function getdryAWasteInputs()
    {
        if ($this->dryAWasteInputs === null) {
            $this->dryAWasteInputs = DryAWasteInput::all();
        }
        return $this->dryAWasteInputs;
    }

    public function getmasterJenisWastes()
    {
        if ($this->masterJenisWastes === null) {
            $this->masterJenisWastes = MasterJenisWaste::where('status', 1)->get();
        }
        return $this->masterJenisWastes;
    }

    public function __construct(DryAWasteInputService $DryAWasteInputService)
    {
        $this->DryAWasteInputService = $DryAWasteInputService;
    }

    // Index
    public function index()
    {
        return response()->view('DryAWaste.DryAWasteInput.index', [
            'dry_a_waste_input'     => $this->getdryAWasteInputs()
        ]);
    }
    // create
    public function create()
    {
        $MasterJenisWaste = $this->getmasterJenisWastes();
        return view('DryAWaste.DryAWasteInput.create', [
            'master_jenis_waste'    => $MasterJenisWaste,
        ]);
    }
    // set Master Jenis
    public function setJenis(Request $request)
    {
        $jenis_waste = $request->jenis_waste;
        $data = $this->getmasterJenisWastes()->where('jenis', $jenis_waste)->first();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        return $this->DryAWasteInputService->store($request);
    }


    public function destroy($id)
    {
        return $this->DryAWasteInputService->destroy($id);
    }
}
