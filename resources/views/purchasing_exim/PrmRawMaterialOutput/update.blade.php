@extends('layouts.master1')
@section('title')
    Update Data Prm Raw Material Output Item
@endsection
@section('content')
    {{-- <div class="container mt-5 mb-5"> --}}
    <div class="col-md-12">
        <div class="card mt-2">
            {{-- <div class="row"> --}}
            <div class="card border-0 shadow-sm rounded">
                <div class="card-header">
                    <h4>Update Data Prm Raw Material Output Item</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('PrmRawMaterialOutputItem.update', $PrmRawMOIC->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nomor Dokument</label>
                                    <input type="text" class="form-control @error('doc_no') is-invalid @enderror"
                                        name="doc_no" value="{{ old('doc_no', $PrmRawMOIC->doc_no) }}"
                                        placeholder="Masukkan nomor Dokument">
                                    <!-- error message untuk title -->
                                    @error('doc_no')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nomor BTSB</label>
                                    <input type="text" class="form-control @error('nomor_bstb') is-invalid @enderror"
                                        name="nomor_bstb" value="{{ old('nomor_bstb', $PrmRawMOIC->nomor_bstb) }}"
                                        placeholder="Masukkan nomor bstb">
                                    <!-- error message untuk title -->
                                    @error('nomor_bstb')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nomor Batch</label>
                                    <input type="text" class="form-control @error('nomor_batch') is-invalid @enderror"
                                        name="nomor_batch" value="{{ old('nomor_batch', $PrmRawMOIC->nomor_batch) }}"
                                        placeholder="Masukkan nomor Batch">
                                    <!-- error message untuk title -->
                                    @error('nomor_batch')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Id Box</label>
                                    <input type="text" class="form-control @error('id_box') is-invalid @enderror"
                                        name="id_box" value="{{ old('id_box', $PrmRawMOIC->id_box) }}"
                                        placeholder="Masukkan id box">
                                    <!-- error message untuk title -->
                                    @error('id_box')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nama Supplier</label>
                                    <input type="text" class="form-control @error('nama_supplier') is-invalid @enderror"
                                        name="nama_supplier" value="{{ old('nama_supplier', $PrmRawMOIC->nama_supplier) }}"
                                        placeholder="Masukkan nama supplier">
                                    <!-- error message untuk title -->
                                    @error('nama_supplier')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Jenis</label>
                                    <input type="text" class="form-control @error('jenis') is-invalid @enderror"
                                        name="jenis" value="{{ old('jenis', $PrmRawMOIC->jenis) }}"
                                        placeholder="Masukkan jenis">
                                    <!-- error message untuk title -->
                                    @error('jenis')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Berat</label>
                                    <input type="text" class="form-control @error('berat') is-invalid @enderror"
                                        name="berat" value="{{ old('berat', $PrmRawMOIC->berat) }}"
                                        placeholder="Masukkan berat">
                                    <!-- error message untuk title -->
                                    @error('berat')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Kadar Air</label>
                                    <input type="text" class="form-control @error('kadar_air') is-invalid @enderror"
                                        name="kadar_air" value="{{ old('kadar_air', $PrmRawMOIC->kadar_air) }}"
                                        placeholder="Masukkan kadar air">
                                    <!-- error message untuk title -->
                                    @error('kadar_air')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tujuan Kirim</label>
                                    <input type="text" class="form-control @error('tujuan_kirim') is-invalid @enderror"
                                        name="tujuan_kirim" value="{{ old('tujuan_kirim', $PrmRawMOIC->tujuan_kirim) }}"
                                        placeholder="Masukkan tujuan kirim">
                                    <!-- error message untuk title -->
                                    @error('tujuan_kirim')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Letak Tujuan</label>
                                    <input type="text" class="form-control @error('letak_tujuan') is-invalid @enderror"
                                        name="letak_tujuan" value="{{ old('letak_tujuan', $PrmRawMOIC->letak_tujuan) }}"
                                        placeholder="Masukkan letak tujuan">
                                    <!-- error message untuk title -->
                                    @error('letak_tujuan')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Inisial Tujuan</label>
                                    <input type="text"
                                        class="form-control @error('inisial_tujuan') is-invalid @enderror"
                                        name="inisial_tujuan"
                                        value="{{ old('inisial_tujuan', $PrmRawMOIC->inisial_tujuan) }}"
                                        placeholder="Masukkan inisial tujuan">
                                    <!-- error message untuk title -->
                                    @error('inisial_tujuan')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Modal</label>
                                    <input type="text" class="form-control @error('modal') is-invalid @enderror"
                                        name="modal" value="{{ old('modal', $PrmRawMOIC->modal) }}"
                                        placeholder="Masukkan modal">
                                    <!-- error message untuk title -->
                                    @error('modal')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Total Modal</label>
                                    <input type="text" class="form-control @error('total_modal') is-invalid @enderror"
                                        name="total_modal" value="{{ old('total_modal', $PrmRawMOIC->total_modal) }}"
                                        placeholder="Masukkan total modal">
                                    <!-- error message untuk title -->
                                    @error('total_modal')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <input type="text" class="form-control @error('keterangan') is-invalid @enderror"
                                        name="keterangan" value="{{ old('keterangan', $PrmRawMOIC->keterangan) }}"
                                        placeholder="Masukkan keterangan">
                                    <!-- error message untuk title -->
                                    @error('keterangan')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>User Created</label>
                                    <input type="text"
                                        class="form-control @error('user_created') is-invalid @enderror"
                                        name="user_created" value="{{ old('user_created', $PrmRawMOIC->user_created) }}"
                                        placeholder="Masukkan user created">
                                    <!-- error message untuk title -->
                                    @error('user_created')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>User Updated</label>
                                    <input type="text"
                                        class="form-control @error('user_updated') is-invalid @enderror"
                                        name="user_updated" value="{{ old('user_updated', $PrmRawMOIC->user_updated) }}"
                                        placeholder="Masukkan user updated">
                                    <!-- error message untuk title -->
                                    @error('user_updated')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-md btn-primary">UPDATE</button>
                        <button type="reset" class="btn btn-md btn-warning">RESET</button>
                    </form>
                </div>
            </div>
            {{-- </div> --}}
        </div>
    </div>
@endsection
