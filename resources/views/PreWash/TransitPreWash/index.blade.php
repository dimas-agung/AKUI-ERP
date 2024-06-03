@extends('layouts.master1')
@section('menu')
    Transit
@endsection
@section('title')
    Transit Pre Wash
@endsection
@section('content')
    <div class="section">
        <div class="card border border-primary border-3">
            <div class="card-header">
                <div class="col-sm-12 d-flex justify-content-between">
                    <h4 class="card-title">Data Transit Pre Wash</h4>
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
                                <th class="text-center" scope="col">Nomor Batch</th>
                                <th class="text-center">Jenis Job</th>
                                <th class="text-center">Berat Job</th>
                                <th class="text-center">Pcs Job</th>
                                <th class="text-center">Berat Bersih</th>
                                <th class="text-center">Pcs Bersih</th>
                                <th class="text-center">Upah Operator Kotor</th>
                                <th class="text-center">Upah Operator Bersih</th>
                                <th class="text-center">Tujuan Kirim</th>
                                <th class="text-center">Keterangan</th>
                                @role('admin')
                                    <th class="text-center">Modal</th>
                                    <th class="text-center">Total Modal</th>
                                @endrole
                                <th class="text-center">NIP Admin</th>
                                {{-- <th class="text-center">Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($transitprewash as $item): ?>
                            <?php if($item->berat_job != 0): ?>
                            <tr>
                                <td class="text-center">{{ $i++ }}</td>
                                <td class="text-center">{{ $item->unit }}</td>
                                <td class="text-center">{{ $item->nomor_job }}</td>
                                <td class="text-center">{{ $item->nomor_batch }}</td>
                                <td class="text-center">{{ $item->jenis_job }}</td>
                                <td class="text-center">{{ $item->berat_job }}</td>
                                <td class="text-center">{{ $item->pcs_job }}</td>
                                <td class="text-center">{{ $item->PreWashOutput->berat_bersih }}</td>
                                <td class="text-center">{{ $item->PreWashOutput->pcs_bersih }}</td>
                                <td class="text-center">{{ $item->PreWashOutput->upah_operator }}</td>
                                <td class="text-center">{{ $item->PreWashOutput->upah_operator_bersih }}</td>
                                <td class="text-center">{{ $item->tujuan_kirim }}</td>
                                <td class="text-center">{{ $item->keterangan }}</td>
                                @role('admin')
                                    <td class="text-center">{{ number_format($item->modal, 2, ',', '.') }}</td>
                                    <td class="text-center">{{ number_format($item->total_modal, 2, ',', '.') }}</td>
                                @endrole
                                <td class="text-center">{{ $item->user_created }}</td>
                            </tr>
                            <?php endif; ?>
                            <?php endforeach; ?>
                            <?php if (empty($transitprewash)): ?>
                            <div class="alert alert-danger">
                                Data Transit Pre Wash belum Tersedia.
                            </div>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
