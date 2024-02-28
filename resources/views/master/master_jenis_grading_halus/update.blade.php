@extends('layouts.master1')
@section('menu')
    Master
@endsection
@section('title')
    Update Master Jenis Grading Halus
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card border border-primary border-3 shadow-sm rounded">
                    <div class="card-header">
                        <h4>UPDATE DATA MASTER JENIS GRADING Halus</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('MasterJenisGradingHalus.update', $MasterJGK->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label><strong>Jenis</strong></label>
                                <input type="text" class="form-control @error('jenis') is-invalid @enderror"
                                    name="jenis" value="{{ old('jenis', $MasterJGK->jenis) }}">
                            </div>
                            <div class="form-group">
                                <label><strong>Kategori Susut</strong></label>
                                <input type="text" class="form-control @error('kategori_susut') is-invalid @enderror"
                                    name="kategori_susut" value="{{ old('kategori_susut', $MasterJGK->kategori_susut) }}">
                            </div>
                            <div class="form-group">
                                <label><strong>Upah Operator</strong></label>
                                <input type="text" class="form-control @error('upah_operator') is-invalid @enderror"
                                    name="upah_operator" value="{{ old('upah_operator', $MasterJGK->upah_operator) }}">
                            </div>
                            <div class="form-group">
                                <label><strong>Pengurangan Harga</strong></label>
                                <input type="text" class="form-control @error('pengurangan_harga') is-invalid @enderror"
                                    name="pengurangan_harga"
                                    value="{{ old('pengurangan_harga', $MasterJGK->pengurangan_harga) }}">
                            </div>
                            <div class="form-group">
                                <label><strong>Harga Estimasi</strong></label>
                                <input type="text" class="form-control @error('harga_estimasi') is-invalid @enderror"
                                    name="harga_estimasi" value="{{ old('harga_estimasi', $MasterJGK->harga_estimasi) }}">
                            </div>
                            <div class="form-group">
                                <label><strong>NIP Admin</strong></label>
                                <input type="text" name="user_created" placeholder="Masukkan User Updated"
                                    class="form-control @error('user_created') is-invalid @enderror"
                                    value="{{ old('nama', $MasterJGK->user_created) }}">
                            </div>
                            <div class="form-group">
                                <label><strong>Status</strong></label>
                                <select class="form-control" @error('status') is-invalid @enderror" name="status">
                                    <option value="1" {{ $MasterJGK->status == 1 ? 'selected' : '' }}>Aktif</option>
                                    <option value="0" {{ $MasterJGK->status == 0 ? 'selected' : '' }}>Tidak Aktif
                                    </option>
                                </select>
                            </div>
                            <div class="col-12 mt-2">
                                <button type="submit" class="btn btn-md btn-primary">UPDATE</button>
                                <button type="reset" class="btn btn-md btn-warning" onclick="reset()">RESET</button>
                                <button type="button" class="btn btn-danger" onclick="goBack()">CANCEL</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
