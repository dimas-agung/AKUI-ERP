@extends('layouts.master1')
@section('Menu')
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
                    {{-- <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
                        <i class="fa fa-plus"></i>
                        Add Data
                    </button> --}}
                </div>
            </div>
            <div class="card-body">
                {{-- Create Data --}}
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        <strong>Sukses: </strong>{{ session()->get('success') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul><strong>
                                @foreach ($errors->all() as $error)
                                    <li> {{ $error }} </li>
                                @endforeach
                            </strong>
                        </ul>
                        <p>Mohon periksa kembali formulir Anda.</p>
                    </div>
                @endif

                <div class="table-responsive">
                    <table id="table1" class="display table table-striped table-hover">
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
                        <tfoot>
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
                            {{-- <th class="text-center">Action</th> --}}
                        </tfoot>
                        <tbody>
                            @forelse ($stockTGK as $post)
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
                                    {{-- <td class="text-center">
                                        <div class="form-button-action">
                                            <form style="display: flex" onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('StockTransitGradingKasar.destroy', $post->id) }}"
                                                method="POST">
                                                <a href="{{ route('StockTransitGradingKasar.show', $post->id) }}"
                                                    class="btn btn-link btn-info" title="Show Task"
                                                    data-original-title="Show"><i class="fa fa-file"></i></a>
                                                <a href="{{ route('StockTransitGradingKasar.edit', $post->id) }}"
                                                    class="btn btn-link btn-primary" title="Edit Task"
                                                    data-original-title="Edit Task"><i class="fa fa-edit"></i></a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" data-toggle="tooltip"
                                                    class="btn btn-link btn-danger"data-original-title="Remove"><i
                                                        class="fa fa-times"></i></button>
                                            </form>
                                        </div>
                                    </td> --}}
                                </tr>
                            @empty
                                <div class="alert alert-danger">
                                    Data Stock Transit Grading Kasar belum Tersedia.
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
