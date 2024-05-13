@extends('layouts.master1')
@section('menu')
    Master
@endsection
@section('title')
    Update Master Jenis Rambang
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card border border-primary border-3 shadow-sm rounded">
                    <div class="card-header">
                        <h4>UPDATE DATA MASTER JENIS RAMBANG</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('MasterJenisRambang.update', $MasterJenisRambang->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label><strong>Jenis</strong></label>
                                <input type="text" class="form-control" name="jenis"
                                    value="{{ old('jenis', $MasterJenisRambang->jenis) }}">
                                <!-- error message -->
                                @error('jenis')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label><strong>Kategori Susut</strong></label>
                                <input type="text" class="form-control" name="kategori_susut"
                                    value="{{ old('kategori_susut', $MasterJenisRambang->kategori_susut) }}">
                                <!-- error message -->
                                @error('kategori_susut')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label><strong>Upah Operator</strong></label>
                                <input type="text" class="form-control" name="upah_operator"
                                    value="{{ old('upah_operator', $MasterJenisRambang->upah_operator) }}">
                                <!-- error message -->
                                @error('upah_operator')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label><strong>Pengurangan Harga</strong></label>
                                <input type="text" class="form-control" name="pengurangan_harga"
                                    value="{{ old('pengurangan_harga', $MasterJenisRambang->pengurangan_harga) }}">
                                <!-- error message -->
                                @error('pengurangan_harga')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label><strong>Harga Estimasi</strong></label>
                                <input type="text" class="form-control" name="harga_estimasi"
                                    value="{{ old('harga_estimasi', $MasterJenisRambang->harga_estimasi) }}">
                                <!-- error message -->
                                @error('harga_estimasi')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label><strong>NIP Admin</strong></label>
                                <input type="text" name="user_created" placeholder="Masukkan User Updated"
                                    class="form-control" value="{{ old('nama', $MasterJenisRambang->user_created) }}">
                                <!-- error message -->
                                @error('user_created')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label><strong>Status</strong></label>
                                <select class="form-control" @error('status') is-invalid @enderror" name="status">
                                    <option value="1" {{ $MasterJenisRambang->status == 1 ? 'selected' : '' }}>Aktif
                                    </option>
                                    <option value="0" {{ $MasterJenisRambang->status == 0 ? 'selected' : '' }}>Tidak
                                        Aktif
                                    </option>
                                </select>
                            </div>
                            <div class="col-12 mt-2">
                                <button type="submit" class="btn btn-md btn-primary">UPDATE</button>
                                <button type="reset" class="btn btn-md btn-warning" onclick="reset()">RESET</button>
                                <a href="{{ Route('MasterJenisRambang.index') }}" type="button" class="btn btn-danger"
                                    data-dismiss="modal">CANCEL</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
