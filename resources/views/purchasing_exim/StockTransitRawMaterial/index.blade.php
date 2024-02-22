@extends('layouts.master1')
@section('Menu')
    Stock Transit Raw Material
@endsection
@section('title')
    Data Stock Transit Raw Material
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card border border-primary border-3">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Data Stock Transit Raw Material</h4>
                    {{-- <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
                        <i class="fa fa-plus"></i>
                        Add Data
                    </button> --}}
                </div>
            </div>
            <div class="card-body" style="overflow: auto;">
                <div class="table-responsive">
                    <table id="table1" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">ID Box</th>
                                <th class="text-center">Nomor BTSB</th>
                                <th class="text-center">Nama Supplier</th>
                                <th class="text-center">Jenis</th>
                                <th class="text-center">Berat</th>
                                <th class="text-center">Kadar Air</th>
                                <th class="text-center">Tujuan Kirim</th>
                                <th class="text-center">Letak Tujuan</th>
                                <th class="text-center">Inisial Tujuan</th>
                                <th class="text-center">Modal</th>
                                <th class="text-center">Total Modal</th>
                                <th class="text-center">Keterangan</th>
                                <th class="text-center">NIP Admin</th>
                                <th class="text-center">User Updated</th>
                                {{-- <th style="width: 10%" class="text-center">Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($stockTGK as $post): ?>
                            <?php if($post->berat != 0 || $post->total_modal != 0): ?>
                            <tr>
                                <td class="text-center">{{ $i++ }}</td>
                                <td class="text-center">{!! $post->id_box !!}</td>
                                <td class="text-center">{!! $post->nomor_bstb !!}</td>
                                <td class="text-center">{!! $post->nama_supplier !!}</td>
                                <td class="text-center">{!! $post->jenis !!}</td>
                                <td class="text-center">{!! $post->berat !!}</td>
                                <td class="text-center">{!! $post->kadar_air !!}</td>
                                <td class="text-center">{!! $post->tujuan_kirim !!}</td>
                                <td class="text-center">{!! $post->letak_tujuan !!}</td>
                                <td class="text-center">{!! $post->inisial_tujuan !!}</td>
                                <td class="text-center">{!! $post->modal !!}</td>
                                <td class="text-center">{!! $post->total_modal !!}</td>
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
