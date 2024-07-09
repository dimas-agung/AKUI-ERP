@extends('layouts.master1')
@section('menu')
    Grading Warna Penerimaan
@endsection
@section('title')
    Grading Warna Penerimaan Stock
@endsection
@section('content')
    <div class="section">
        <div class="card border border-primary border-3">
            <div class="card-header">
                <div class="col-sm-12 d-flex justify-content-between">
                    <h4 class="card-title">Data Grading Warna Penerimaan Stock</h4>
                </div>
            </div>
            <div class="card-body" style="overflow: auto;">
                <div class="table-responsive">
                    <table id="table1" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">No</th>
                                <th class="text-center" scope="col">Unit</th>
                                <th class="text-center" scope="col">Nomor Job</th>
                                <th class="text-center" scope="col">Nomor BSTB</th>
                                <th class="text-center" scope="col">Nomor Batch</th>
                                <th class="text-center" scope="col">Tujuan Kirim</th>
                                <th class="text-center" scope="col">Keterangan</th>
                                <th class="text-center">Berat Kotor</th>
                                <th class="text-center">Jenis Grading</th>
                                <th class="text-center">Berat 1 Grading</th>
                                <th class="text-center">Pcs 1 Grading</th>
                                <th class="text-center">Berat 2 Grading</th>
                                @role('admin')
                                    <th class="text-center">Modal</th>
                                    <th class="text-center">Total Modal</th>
                                @endrole
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            $dataFound = false; ?>
                            <?php foreach ($grading_halus_stocks as $item): ?>
                            <?php $dataFound = true; ?>
                            <tr>
                                <td class="text-center">{{ $i++ }}</td>
                                <td class="text-center">{{ $item->unit }}</td>
                                <td class="text-center">{{ $item->nomor_job }}</td>
                                <td class="text-center">{{ $item->nomor_bstb }}</td>
                                <td class="text-center">{{ $item->nomor_batch }}</td>
                                <td class="text-center">{{ $item->tujuan_kirim }}</td>
                                <td class="text-center">{{ $item->keterangan }}</td>
                                <td class="text-center">{{ $item->berat_kotor }}</td>
                                <td class="text-center">{{ $item->jenis_grading }}</td>
                                <td class="text-center">{{ $item->berat_1_grading }}</td>
                                <td class="text-center">{{ $item->pcs_1_grading }}</td>
                                <td class="text-center">{{ $item->berat_2_grading }}</td>
                                @role('admin')
                                    <td class="text-center">{{ number_format($item->modal, 2, ',', '.') }}</td>
                                    <td class="text-center">{{ number_format($item->total_modal, 2, ',', '.') }}</td>
                                @endrole
                            </tr>
                            <?php endforeach; ?>
                            <?php if (!$dataFound): ?>
                            <div class="alert alert-danger">
                                Data Grading Warna Penerimaan Stock belum Tersedia.
                            </div>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
