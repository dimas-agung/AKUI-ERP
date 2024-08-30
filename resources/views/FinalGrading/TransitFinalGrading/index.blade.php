@extends('layouts.master1')
@section('menu')
    Final Grading
@endsection
@section('title')
    Transit Final Grading
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card mt-2 border border-primary border-3">
            <div class="card-body">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            <div class="col-sm-12 d-flex justify-content-between">
                                Transit Final Grading
                            </div>
                        </h5>
                    </div>
                    <div class="card-body" style="overflow: auto;">
                        <div class="table-responsive">
                            <table id="table1" class="display data-table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">No</th>
                                        <th scope="col" class="text-center">Unit</th>
                                        <th scope="col" class="text-center">Nomor Job</th>
                                        <th scope="col" class="text-center">Nomor Batch</th>
                                        <th scope="col" class="text-center">Tujuan Kirim</th>
                                        <th scope="col" class="text-center">Job Order</th>
                                        <th scope="col" class="text-center">Jenis Grading</th>
                                        <th scope="col" class="text-center">Berat Grading</th>
                                        <th scope="col" class="text-center">Pcs Grading</th>
                                        @role('admin')
                                        <th scope="col" class="text-center">Modal Per Jenis</th>
                                        <th scope="col" class="text-center">Total Modal Per Jenis</th>
                                        @endrole
                                        <th scope="col" class="text-center">Status</th>
                                        <th scope="col" class="text-center">Created At</th>
                                        <th scope="col" class="text-center">Updated At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($transit_final_grading as $item)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">{{ $item->unit }}</td>
                                            <td class="text-center">{{ $item->nomor_job }}</td>
                                            <td class="text-center">{{ $item->nomor_batch }}</td>
                                            <td class="text-center">{{ $item->tujuan_kirim }}</td>
                                            <td class="text-center">{{ $item->job_order }}</td>
                                            <td class="text-center">{{ $item->jenis_grading }}</td>
                                            <td class="text-center">{{ $item->berat_grading }}</td>
                                            <td class="text-center">{{ $item->pcs_grading }}</td>
                                            <td class="text-center">{{ $item->modal_per_jenis }}</td>
                                            <td class="text-center">{{ $item->total_modal_per_jenis }}</td>
                                            <td class="text-center">{{ $item->status }}</td>
                                            <td class="text-center">{{ $item->created_at }}</td>
                                            <td class="text-center">
                                                {{ $item->created_at != $item->updated_at ? $item->updated_at : '' }}
                                            </td>
                                        </tr>
                                    @empty
                                        <div class="alert alert-danger">
                                            Data Transit Final Grading belum Tersedia.
                                        </div>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
