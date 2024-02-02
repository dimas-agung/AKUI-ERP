@extends('layouts.master1')
@section('menu')
    Purchasing & EXIM
@endsection
@section('title')
    Purchasing Raw Material Stock History
@endsection
@section('content')
    {{-- <div class="col-md-12"> --}}
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <h4 class="card-title">Data Purchasing Raw Material Stock History</h4>
            </div>
        </div>
        <div class="card-body" style="overflow: auto;">
            <div class="table-responsive">
                <table id="table1" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">No</th>
                            <th scope="col" class="text-center">Id Box</th>
                            <th scope="col" class="text-center">Nomor Document</th>
                            <th scope="col" class="text-center">Berat Masuk</th>
                            <th scope="col" class="text-center">Berat Keluar</th>
                            <th scope="col" class="text-center">Sisa Berat</th>
                            <th scope="col" class="text-center">Avg Kadar Air</th>
                            <th scope="col" class="text-center">Modal</th>
                            <th scope="col" class="text-center">Total Modal</th>
                            <th scope="col" class="text-center">Keterangan</th>
                            <th scope="col" class="text-center">User Created</th>
                            <th scope="col" class="text-center">Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($stockHistory as $MasterStock)
                            <tr>
                                <td class="text-center">{{ $i++ }}</td>
                                <td class="text-center">{{ $MasterStock->id_box }}</td>
                                <td class="text-center">{{ $MasterStock->doc_no }}</td>
                                <td class="text-center">{{ $MasterStock->berat_masuk }}</td>
                                <td class="text-center">{{ $MasterStock->berat_keluar }}</td>
                                <td class="text-center">{{ $MasterStock->sisa_berat }}</td>
                                <td class="text-center">{{ $MasterStock->avg_kadar_air }}</td>
                                <td class="text-center">{{ $MasterStock->modal }}</td>
                                <td class="text-center">{{ $MasterStock->total_modal }}</td>
                                <td class="text-center">{{ $MasterStock->keterangan }}</td>
                                <td class="text-center">{{ $MasterStock->user_created }}</td>
                                <td class="text-center">{{ $MasterStock->created_at }}</td>
                            </tr>
                        @empty
                            <div class="alert alert-danger">
                                Data Purchasing belum Tersedia.
                            </div>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class=" d-flex justify-content-end model-footer no-bd">
                <a href="{{ url('/purchasing_exim/prm_raw_material_stock') }}" type="button" class="btn btn-danger mt-3"
                    data-dismiss="modal">Close</a>
            </div>
        </div>
    </div>
@endsection
