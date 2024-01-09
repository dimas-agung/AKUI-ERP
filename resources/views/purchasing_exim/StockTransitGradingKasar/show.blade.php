@extends('layouts.master1')
@section('menu')
    Master
@endsection
@section('title')
    Detail Data Stock Transit Grading Kasar
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="card border-0 shadow-sm rounded">
            <div class="card-header">
                <h4>Detail Data Stock Transit Grading Kasar</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">ID</th>
                                <th class="text-center" scope="col">Nomor BTSB</th>
                                <th class="text-center" scope="col">Nama Supplier</th>
                                <th class="text-center" scope="col">Jenis</th>
                                <th class="text-center" scope="col">Berat</th>
                                <th class="text-center" scope="col">Kadar Air</th>
                                <th class="text-center" scope="col">Tujuan Kirim</th>
                                <th class="text-center" scope="col">Letak Tujuan</th>
                                <th class="text-center" scope="col">Inisial Tujuan</th>
                                <th class="text-center" scope="col">Modal</th>
                                <th class="text-center" scope="col">Total Modal</th>
                                <th class="text-center" scope="col">Keterangan</th>
                                <th class="text-center" scope="col">User Created</th>
                                <th class="text-center" scope="col">User Updated</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">{{ $stockTGK->id }}</td>
                                <td class="text-center">{{ $stockTGK->nomor_bstb }}</td>
                                <td class="text-center">{{ $stockTGK->nama_supplier }}</td>
                                <td class="text-center">{{ $stockTGK->jenis }}</td>
                                <td class="text-center">{{ $stockTGK->berat }}</td>
                                <td class="text-center">{{ $stockTGK->kadar_air }}</td>
                                <td class="text-center">{{ $stockTGK->tujuan_kirim }}</td>
                                <td class="text-center">{{ $stockTGK->letak_tujuan }}</td>
                                <td class="text-center">{{ $stockTGK->inisial_tujuan }}</td>
                                <td class="text-center">{{ $stockTGK->modal }}</td>
                                <td class="text-center">{{ $stockTGK->total_modal }}</td>
                                <td class="text-center">{{ $stockTGK->keterangan }}</td>
                                <td class="text-center">{{ $stockTGK->user_created }}</td>
                                <td class="text-center">{{ $stockTGK->user_updated }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
