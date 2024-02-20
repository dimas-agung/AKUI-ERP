@extends('layouts.master1')
@section('menu')
    Stock Transit Grading
@endsection
@section('title')
    Data Stock Transit Grading Kasar
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Data Stock Transit Grading Kasar</h4>
                </div>
            </div>
            <div class="card-body" style="overflow: auto;">
                <div class="table-responsive">
                    <table id="table1" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nomor Job</th>
                                <th class="text-center">ID Box Grading Kasar</th>
                                <th class="text-center">Nomor BTSB</th>
                                <th class="text-center">Nomor Batch</th>
                                <th class="text-center">Nama Supplier</th>
                                <th class="text-center">ID Box Raw Material</th>
                                <th class="text-center">Jenis Raw Material</th>
                                <th class="text-center">Jenis Grading</th>
                                <th class="text-center">Berat Keluar</th>
                                <th class="text-center">PCS Keluar</th>
                                <th class="text-center">AVG Kadar Air</th>
                                <th class="text-center">Tujuan Kirim</th>
                                <th class="text-center">Nomor Grading</th>
                                <th class="text-center">Modal</th>
                                <th class="text-center">Total Modal</th>
                                <th class="text-center">Biaya Produksi</th>
                                <th class="text-center">Fix Total Modal</th>
                                <th class="text-center">Keterangan</th>
                                <th class="text-center">NIP Admin</th>
                                <th class="text-center">User Updated</th>
                                {{-- <th style="width: 10%" class="text-center">Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($stockTGK as $post): ?>
                            <?php if($post->berat_keluar != 0 || $post->total_modal != 0): ?>
                            <tr>
                                <td class="text-center">{{ $i++ }}</td>
                                <td class="text-center">{!! $post->nomor_job !!}</td>
                                <td class="text-center">{!! $post->id_box_grading_kasar !!}</td>
                                <td class="text-center">{!! $post->nomor_bstb !!}</td>
                                <td class="text-center">{!! $post->nomor_batch !!}</td>
                                <td class="text-center">{!! $post->nama_supplier !!}</td>
                                <td class="text-center">{!! $post->id_box_raw_material !!}</td>
                                <td class="text-center">{!! $post->jenis_raw_material !!}</td>
                                <td class="text-center">{!! $post->jenis_grading !!}</td>
                                <td class="text-center">{!! $post->berat_keluar !!}</td>
                                <td class="text-center">{!! $post->pcs_keluar !!}</td>
                                <td class="text-center">{!! $post->avg_kadar_air !!}</td>
                                <td class="text-center">{!! $post->tujuan_kirim !!}</td>
                                <td class="text-center">{!! $post->nomor_grading !!}</td>
                                <td class="text-center">{!! $post->modal !!}</td>
                                <td class="text-center">{!! $post->total_modal !!}</td>
                                <td class="text-center">{!! $post->biaya_produksi !!}</td>
                                <td class="text-center">{!! $post->fix_total_modal !!}</td>
                                <td class="text-center">{!! $post->keterangan !!}</td>
                                <td class="text-center">{!! $post->user_created !!}</td>
                                <td class="text-center">{!! $post->user_updated !!}</td>
                            </tr>
                            <?php endif; ?>
                            <?php endforeach; ?>
                            <?php if (empty($stockTGK)): ?>
                            <div class="alert alert-danger">
                                Data Stock Transit Grading Kasar belum Tersedia.
                            </div>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
