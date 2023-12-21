@extends('layouts.master2')
@section('title')
    Detail Biaya HPP
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="card border-0 shadow-sm rounded">
            <div class="card-header">
                <h4>Detail Data Biaya HPP</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center" scope="col">ID</th>
                            <th class="text-center" scope="col">Jenis Biaya</th>
                            <th class="text-center" scope="col">Biaya PerGram</th>
                            <th class="text-center" scope="col">Nama Unit</th>
                            <th class="text-center" scope="col">Status</th>
                            <th class="text-center" scope="col">Waktu Buat</th>
                            <th class="text-center" scope="col">Waktu Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">{{ $biaya->id }}</td>
                            <td class="text-center">{{ $biaya->jenis_biaya }}</td>
                            <td class="text-center">{{ $biaya->biaya_per_gram }}</td>
                            <td class="text-center">{{ $biaya->unit->nama }}</td>
                            {{-- <td class="text-center">{{ $biaya->status }}</td> --}}
                            <td>
                                @if ($biaya->status == 1)
                                    Aktif
                                @else
                                    Tidak Aktif
                                @endif
                            </td>
                            <td class="text-center">{{ $biaya->created_at }}</td>
                            <td class="text-center">{{ $biaya->updated_at }}</td>
                        </tr>
                    </tbody>
                </table>
                <div class=" d-flex justify-content-end model-footer no-bd">
                    <a href="{{ url('/biayahpp') }}" type="button" class="btn btn-danger" data-dismiss="modal">Close</a>
                </div>
            </div>
        </div>
    </div>
@endsection
