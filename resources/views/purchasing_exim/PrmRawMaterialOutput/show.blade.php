@extends('layouts.master1')
@section('title')
    Detail Data Prm Raw Material Output Item
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="card border-0 shadow-sm rounded">
            <div class="card-header">
                <h4>Detail Data Prm Raw Material Output Item</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">ID</th>
                                <th class="text-center" scope="col">Nomor Dokument</th>
                                <th class="text-center" scope="col">Nomor BTSB</th>
                                <th class="text-center">Nomor Batch</th>
                                <th class="text-center">Id Box</th>
                                <th class="text-center">Nama Supplier</th>
                                <th class="text-center">Jenis</th>
                                <th class="text-center">Berat</th>
                                <th class="text-center">Kadar Air</th>
                                <th class="text-center">Tujuan Kirim</th>
                                <th class="text-center">Letak Tujuan</th>
                                <th class="text-center">Inisial Tujuan</th>
                                <th class="text-center">Modal</th>
                                <th class="text-center">Total Modal</th>
                                <th class="text-center" scope="col">Keterangan</th>
                                <th class="text-center" scope="col">User Created</th>
                                <th class="text-center" scope="col">User Updated</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">{{ $PrmRawMOIC->id }}</td>
                                <td class="text-center">{{ $PrmRawMOIC->doc_no }}</td>
                                <td class="text-center">{{ $PrmRawMOIC->nomor_bstb }}</td>
                                <td class="text-center">{{ $PrmRawMOIC->nomor_batch }}</td>
                                <td class="text-center">{{ $PrmRawMOIC->id_box }}</td>
                                <td class="text-center">{{ $PrmRawMOIC->nama_supplier }}</td>
                                <td class="text-center">{{ $PrmRawMOIC->jenis }}</td>
                                <td class="text-center">{{ $PrmRawMOIC->berat }}</td>
                                <td class="text-center">{{ $PrmRawMOIC->kadar_air }}</td>
                                <td class="text-center">{{ $PrmRawMOIC->tujuan_kirim }}</td>
                                <td class="text-center">{{ $PrmRawMOIC->letak_tujuan }}</td>
                                <td class="text-center">{{ $PrmRawMOIC->inisial_tujuan }}</td>
                                <td class="text-center">{{ $PrmRawMOIC->modal }}</td>
                                <td class="text-center">{{ $PrmRawMOIC->total_modal }}</td>
                                <td class="text-center">{{ $PrmRawMOIC->keterangan }}</td>
                                <td class="text-center">{{ $PrmRawMOIC->user_created }}</td>
                                <td class="text-center">{{ $PrmRawMOIC->user_updated }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
