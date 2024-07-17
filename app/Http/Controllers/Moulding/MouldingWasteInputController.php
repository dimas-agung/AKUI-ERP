<?php

namespace App\Http\Controllers\Moulding;

use Illuminate\Http\Request;
use App\Models\MasterJenisWaste;
use App\Models\MouldingWasteInput;
use App\Http\Controllers\Controller;
use App\Models\MasterJenisGradingWarna;
use App\Services\MouldingWasteInputService;

class MouldingWasteInputController extends Controller
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

    protected $MouldingWasteInput = null;
    protected $MasterJenisWaste = null;
    protected $MouldingWasteInputService;

    public function getMouldingWasteInput()
    {
        if ($this->MouldingWasteInput === null) {
            $this->MouldingWasteInput = MouldingWasteInput::all();
        }
        return $this->MouldingWasteInput;
    }

    public function getMasterJenisWaste()
    {
        if ($this->MasterJenisWaste === null) {
            $this->MasterJenisWaste = MasterJenisWaste::where('status', 1)->get();
        }
        return $this->MasterJenisWaste;
    }

    public function __construct(MouldingWasteInputService $MouldingWasteInputService)
    {
        $this->MouldingWasteInputService = $MouldingWasteInputService;
    }

    //index
    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = MouldingWasteInput::query();


        if ($startDate && $endDate) {
            $query->whereBetween(MouldingWasteInput::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'), [$startDate, $endDate]);
            // $MouldingWasteInput = $query->with('DryAPenerimaanCabutStock')->get();
        } else {
            // $MouldingWasteInput = MouldingWasteInput::with('DryAPenerimaanCabutStock')
            $MouldingWasteInput = MouldingWasteInput::where('status', 1)
                // ->where('created_at','>=', Carbon::now()->subDays(2))
                ->limit(1000)
                ->latest()
                ->get();
        }

        return response()->view('Moulding.MouldingWasteInput.index', [
            'moulding_waste_input' => $MouldingWasteInput,
        ]);
    }
    // create
    public function create()
    {
        return view('Moulding.MouldingWasteInput.create', [
            'master_jenis_waste'    => $this->getMasterJenisWaste(),
        ]);
    }
    // set Master Jenis
    public function setJenis(Request $request)
    {
        $jenis_waste = $request->jenis_waste;
        $data = $this->getMasterJenisWaste()->where('jenis', $jenis_waste)->first();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        return $this->MouldingWasteInputService->store($request);
    }

    public function destroy($id)
    {
        return $this->MouldingWasteInputService->destroy($id);
    }
}
