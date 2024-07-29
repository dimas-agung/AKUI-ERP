@extends('layouts.master1')
@section('menu')
    Pre Grading Halus
@endsection
@section('title')
    Pre Grading Halus Stock
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card border border-primary border-3 mt-2">
            <div class="card-body">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            <div class="col-sm-12 d-flex justify-content-between">
                                Data Pre Grading Halus Stock
                            </div>
                        </h5>
                    </div>
                    <div class="card-body" style="overflow: auto;">
                        <div class="table-responsive">
                            <table id="table1" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">No</th>
                                        <th scope="col" class="text-center">Nomor Job</th>
                                        <th scope="col" class="text-center">ID Box Grading Kasar</th>
                                        <th scope="col" class="text-center">Nomor BSTB</th>
                                        <th scope="col" class="text-center">Nomor Batch</th>
                                        <th scope="col" class="text-center">Nama Supplier</th>
                                        <th scope="col" class="text-center">Nomor Nota Internal</th>
                                        <th scope="col" class="text-center">ID Box Raw Material</th>
                                        <th scope="col" class="text-center">Jenis Raw Material</th>
                                        <th scope="col" class="text-center">Jenis Kirim</th>
                                        <th scope="col" class="text-center">Berat Masuk</th>
                                        <th scope="col" class="text-center">Pcs Masuk</th>
                                        <th scope="col" class="text-center">Berat Keluar</th>
                                        <th scope="col" class="text-center">Pcs Keluar</th>
                                        <th scope="col" class="text-center">Sisa Berat</th>
                                        <th scope="col" class="text-center">Sisa Pcs</th>
                                        <th scope="col" class="text-center">Kadar Air</th>
                                        <th scope="col" class="text-center">Tujuan Kirim</th>
                                        @role('admin')
                                            <th scope="col" class="text-center">Modal</th>
                                            <th scope="col" class="text-center">Total Modal</th>
                                        @endrole
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($PGHS as $PreGradingHalusStock)
                                        <tr>
                                            <td class="text-center">{{ $i++ }}</td>
                                            <td class="text-center">{{ $PreGradingHalusStock->nomor_job }}</td>
                                            <td class="text-center">{{ $PreGradingHalusStock->id_box_grading_kasar }}</td>
                                            <td class="text-center">{{ $PreGradingHalusStock->nomor_bstb }}</td>
                                            <td class="text-center">{{ $PreGradingHalusStock->nomor_batch }}</td>
                                            <td class="text-center">{{ $PreGradingHalusStock->nama_supplier }}</td>
                                            <td class="text-center">{{ $PreGradingHalusStock->nomor_nota_internal }}</td>
                                            <td class="text-center">{{ $PreGradingHalusStock->id_box_raw_material }}</td>
                                            <td class="text-center">{{ $PreGradingHalusStock->jenis_raw_material }}</td>
                                            <td class="text-center">{{ $PreGradingHalusStock->jenis_kirim }}</td>
                                            <td class="text-center">{{ $PreGradingHalusStock->berat_masuk }}
                                            </td>
                                            <td class="text-center">{{ $PreGradingHalusStock->pcs_masuk }}</td>
                                            <td class="text-center">{{ $PreGradingHalusStock->berat_keluar }}
                                            </td>
                                            <td class="text-center">{{ $PreGradingHalusStock->pcs_keluar }}
                                            </td>
                                            <td class="text-center">{{ $PreGradingHalusStock->sisa_berat }}
                                            </td>
                                            <td class="text-center">{{ $PreGradingHalusStock->sisa_pcs }}</td>
                                            <td class="text-center">{{ $PreGradingHalusStock->kadar_air }}</td>
                                            <td class="text-center">{{ $PreGradingHalusStock->tujuan_kirim }}</td>
                                            @role('admin')
                                                <td class="text-center">
                                                    {{ number_format($PreGradingHalusStock->modal, 2, ',', '.') }}</td>
                                                <td class="text-center">
                                                    {{ number_format($PreGradingHalusStock->total_modal, 2, ',', '.') }}
                                                </td>
                                            @endrole
                                        </tr>
                                    @empty
                                        <div class="alert alert-danger">
                                            Data Pre Grading Halus Output belum Tersedia.
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
