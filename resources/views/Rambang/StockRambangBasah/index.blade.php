@extends('layouts.master1')
@section('menu')
    Rambang
@endsection
@section('title')
    Rambang Basah Stock
@endsection
@section('content')
    <div class="section">
        <div class="card border border-primary border-3">
            <div class="card-header">
                <div class="col-sm-12 d-flex justify-content-between">
                    <h4 class="card-title">Data Rambang Basah Stock</h4>
                </div>
            </div>
            <div class="card-body" style="overflow: auto;">
                <div class="table-responsive">
                    <table id="table1" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">No</th>
                                <th class="text-center" scope="col">ID Box Hcr Kotor</th>
                                <th class="text-center" scope="col">Tanggal Cabut</th>
                                <th class="text-center" scope="col">Jenis Hcr Kotor</th>
                                <th class="text-center" scope="col">Berat Masuk</th>
                                <th class="text-center" scope="col">Berat Keluar</th>
                                <th class="text-center" scope="col">Sisa Berat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($CBPenerimaan as $item)
                                <tr>
                                    <td class="text-center">{{ $i++ }}</td>
                                    <td class="text-center">{!! $item->unit !!}</td>
                                    <td class="text-center">{!! $item->id_box_hcr_kotor !!}</td>
                                    <td class="text-center">{!! $item->jenis_rambang !!}</td>
                                    <td class="text-center">{!! $item->berat_masuk !!}</td>
                                    <td class="text-center">{!! $item->berat_keluar !!}</td>
                                    <td class="text-center">{!! $item->sisa_berat !!}</td>
                                </tr>
                            @empty
                                <div class="alert alert-danger">
                                    Data Rambang Basah Stock belum Tersedia.
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
