@extends('layouts.master1')
@section('menu')
    Grading Halus
@endsection
@section('title')
    Grading Halus Stock
@endsection
@section('content')
    <div class="section">
        <div class="card border border-primary border-3">
            <div class="card-header">
                <div class="col-sm-12 d-flex justify-content-between">
                    <h4 class="card-title">Data Grading Halus Stock</h4>
                </div>
            </div>
            <div class="card-body" style="overflow: auto;">
                <div class="table-responsive">
                    <table id="table1" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">No</th>
                                <th class="text-center" scope="col">Unit</th>
                                <th class="text-center" scope="col">Id Box Grading Halus</th>
                                <th class="text-center" scope="col">Nomor Batch</th>
                                <th class="text-center">Jenis</th>
                                <th class="text-center">Berat Masuk</th>
                                <th class="text-center">Berat Keluar</th>
                                <th class="text-center">Sisa Berat</th>
                                <th class="text-center">Pcs Masuk</th>
                                <th class="text-center">Pcs Keluar</th>
                                <th class="text-center">Sisa Pcs</th>
                                <th class="text-center">Modal</th>
                                <th class="text-center">Total Modal</th>
                                {{-- <th class="text-center">Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($grading_halus_stocks as $item)
                                <tr>
                                    <td class="text-center">{{ $i++ }}</td>
                                    <td class="text-center">{{ $item->unit }}</td>
                                    <td class="text-center">{{ $item->id_box_grading_halus }}</td>
                                    <td class="text-center">{{ $item->nomor_batch }}</td>
                                    <td class="text-center">{{ $item->jenis }}</td>
                                    <td class="text-center">{{ $item->berat_masuk }}</td>
                                    <td class="text-center">{{ $item->berat_keluar }}</td>
                                    <td class="text-center">{{ $item->sisa_berat }}</td>
                                    <td class="text-center">{{ $item->pcs_masuk }}</td>
                                    <td class="text-center">{{ $item->pcs_keluar }}</td>
                                    <td class="text-center">{{ $item->sisa_pcs }}</td>
                                    <td class="text-center">{{ number_format($item->modal, 2, ',', '.') }}</td>
                                    <td class="text-center">{{ number_format($item->total_modal, 2, ',', '.') }}</td>
                                </tr>
                            @empty
                                <div class="alert alert-danger">
                                    Data Grading Halus Stock belum Tersedia.
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
