@extends('layouts.master2')
{{-- @extends('layouts.template') --}}
@section('Menu')
    Purchasing & EXIM
@endsection
@section('title')
    Purchasing Raw Material Stock History
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Data Purchasing Raw Material Stock History</h4>
                </div>
            </div>
            <div class="card-body">
                {{-- Create Data --}}
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        <strong>Sukses: </strong>{{ session()->get('success') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul><strong>
                                @foreach ($errors->all() as $error)
                                    <li> {{ $error }} </li>
                                @endforeach
                            </strong>
                        </ul>
                        <p>Mohon periksa kembali formulir Anda.</p>
                    </div>
                @endif
                <div class="table-responsive">
                    <table id="add-row" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">No</th>
                                <th scope="col" class="text-center">Id Box</th>
                                <th scope="col" class="text-center">Doc No</th>
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
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $MasterStock->id_box }}</td>
                                    <td>{{ $MasterStock->doc_no }}</td>
                                    <td>{{ $MasterStock->berat_masuk }}</td>
                                    <td>{{ $MasterStock->berat_keluar }}</td>
                                    <td>{{ $MasterStock->sisa_berat }}</td>
                                    <td>{{ $MasterStock->avg_kadar_air }}</td>
                                    <td>{{ $MasterStock->modal }}</td>
                                    <td>{{ $MasterStock->total_modal }}</td>
                                    <td>{{ $MasterStock->keterangan }}</td>
                                    <td>{{ $MasterStock->user_created }}</td>
                                    <td>{{ $MasterStock->created_at }}</td>
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
                    <a href="{{ url('/purchasing_exim/prm_raw_material_stock') }}" type="button" class="btn btn-danger"
                        data-dismiss="modal">Close</a>
                </div>
            </div>
        </div>
    </div>
@endsection
