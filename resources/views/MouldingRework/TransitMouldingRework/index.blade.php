@extends('layouts.master1')
@section('menu')
    Moulding Rework
@endsection
@section('title')
    Transit Moulding Rework
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card border border-primary border-3 mt-2">
            <div class="card-body">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            <div class="col-sm-12 d-flex justify-content-between">
                                Data Transit Moulding Rework
                            </div>
                        </h5>
                    </div>
                    <div class="card-body" style="overflow: auto;">
                        <div class="table-responsive">
                            <table id="table1" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">No</th>
                                        <th scope="col" class="text-center">Unit</th>
                                        <th scope="col" class="text-center">Nomor Job Rework</th>
                                        <th scope="col" class="text-center">Nomor Batch</th>
                                        <th scope="col" class="text-center">Tujuan Kirim</th>
                                        <th scope="col" class="text-center">Job Order</th>
                                        <th scope="col" class="text-center">Berat Job</th>
                                        <th scope="col" class="text-center">Pcs Job</th>
                                        <th scope="col" class="text-center">Modal</th>
                                        <th scope="col" class="text-center">Total Modal</th>
                                        <th scope="col" class="text-center">Nama Operator</th>
                                        <th scope="col" class="text-center">NIP Operator</th>
                                        <th scope="col" class="text-center">Grade Operator</th>
                                        <th scope="col" class="text-center">Nama Team Leader</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($transit_moulding_rework as $item): ?>
                                    <?php if($item->status != 0): ?>
                                    <tr>
                                        <td class="text-center">{{ $i++ }}</td>
                                        <td class="text-center">{{ $item->unit }}</td>
                                        <td class="text-center">{{ $item->nomor_job_rework }}</td>
                                        <td class="text-center">{{ $item->nomor_batch }}</td>
                                        <td class="text-center">{{ $item->tujuan_kirim }}</td>
                                        <td class="text-center">{{ $item->job_order }}</td>
                                        <td class="text-center">{{ $item->berat_job }}</td>
                                        <td class="text-center">{{ $item->pcs_job }}</td>
                                        <td class="text-center">{{ $item->modal }}</td>
                                        <td class="text-center">{{ $item->total_modal }}</td>
                                        <td class="text-center">{{ $item->nama_operator }}</td>
                                        <td class="text-center">{{ $item->nip_operator }}</td>
                                        <td class="text-center">{{ $item->grade_operator }}</td>
                                        <td class="text-center">{{ $item->nama_team_leader }}</td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php endforeach; ?>
                                    <?php if (empty($transit_moulding_rework)): ?>
                                    <div class="alert alert-danger">
                                        Data Transit Moulding Rework belum Tersedia.
                                    </div>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
