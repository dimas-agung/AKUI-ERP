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

    //index
    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = DryAWasteInput::query();


        if ($startDate && $endDate) {
            $query->whereBetween(DryAWasteInput::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), [$startDate, $endDate]);
            // $DryAWasteInput = $query->with('DryAPenerimaanCabutStock')->get();
        } else {
            // $DryAWasteInput = DryAWasteInput::with('DryAPenerimaanCabutStock')
            $DryAWasteInput = DryAWasteInput::where('status', 1)
                // ->where('created_at','>=', Carbon::now()->subDays(2))
                ->limit(1000)
                ->latest()
                ->get();
        }

        return response()->view('DryAWaste.DryAWasteInput.index', [
            'dry_a_waste_input' => $DryAWasteInput,
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
