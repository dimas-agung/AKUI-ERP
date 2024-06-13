@extends('layouts.master1')
@section('menu')
    Dry A Penerimaan
@endsection
@section('title')
    Dry A Penerimaan Stock
@endsection
@section('content')
    <div class="section">
        <div class="card border border-primary border-3">
            <div class="card-header">
                <div class="col-sm-12 d-flex justify-content-between">
                    <h4 class="card-title">Data Dry A Penerimaan Stock</h4>
                </div>
            </div>
            <div class="card-body" style="overflow: auto;">
                <div class="table-responsive">
                    <table id="table1" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">No</th>
                                <th class="text-center" scope="col">Nomor Job</th>
                                <th class="text-center">Jenis Rambang</th>
                                <th class="text-center" scope="col">Upah Operator</th>
                                <th class="text-center">Berat</th>
                                <th class="text-center" scope="col">Nama Operator</th>
                                <th class="text-center" scope="col">NIP Operator</th>
                                <th class="text-center" scope="col">Grade Operator</th>
                                <th class="text-center" scope="col">Nama Team Leader</th>
                                <th class="text-center">Waktu Penyebaran</th>
                                <th class="text-center">Waktu Pengembalian</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            $dataFound = false; ?>
                            <?php foreach ($grading_halus_stocks as $item): ?>
                            <?php if($item->berat > 0): ?>
                            <?php $dataFound = true; ?>
                            <tr>
                                <td class="text-center">{{ $i++ }}</td>
                                <td class="text-center">{{ $item->nomor_job }}</td>
                                <td class="text-center">{{ $item->jenis_rambang }}</td>
                                <td class="text-center">{{ $item->upah_operator }}</td>
                                <td class="text-center">{{ $item->berat }}</td>
                                <td class="text-center">{{ $item->nama_operator }}</td>
                                <td class="text-center">{{ $item->nip_operator }}</td>
                                <td class="text-center">{{ $item->grade_operator }}</td>
                                <td class="text-center">{{ $item->nama_team_leader }}</td>
                                <td class="text-center">{{ $item->waktu_penyebaran }}</td>
                                <td class="text-center">{{ $item->waktu_pengembalian }}</td>
                            </tr>
                            <?php endif; ?>
                            <?php endforeach; ?>
                            <?php if (!$dataFound): ?>
                            <div class="alert alert-danger">
                                Data Dry A Penerimaan Stock belum Tersedia.
                            </div>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
