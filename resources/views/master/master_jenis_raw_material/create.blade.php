@extends('layouts.admin')
@section('content')
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-header">
                        <h4>CREATE DATA MASTER JENIS RAW MATERIAL</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('master_jenis_raw_material.store') }}" method="POST">

                            @csrf

                            <div class="form-group">
                                <label class="font-weight-bold">Jenis</label>
                                <input type="text" class="form-control @error('jenis') is-invalid @enderror"
                                    name="jenis" placeholder="Masukkan jenis">

                                <!-- error message untuk title -->
                                @error('jenis')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Kategori Susut</label>
                                {{-- <select name="" id=""></select> --}}
                                <input type="text" class="form-control @error('kategori_susut') is-invalid @enderror"
                                    name="kategori_susut" placeholder="Masukan Kategori Susut">

                                <!-- error message untuk title -->
                                @error('kategori_susut')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Upah Operator</label>
                                {{-- <select name="" id=""></select> --}}
                                <input type="text" class="form-control @error('upah_operator') is-invalid @enderror"
                                    name="upah_operator" placeholder="Masukan Upah Operator">

                                <!-- error message untuk title -->
                                @error('upah_operator')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Pengurangan Harga</label>
                                {{-- <select name="" id=""></select> --}}
                                <input type="text" class="form-control @error('pengurangan_harga') is-invalid @enderror"
                                    name="pengurangan_harga" placeholder="Masukan Pengurangan Harga">

                                <!-- error message untuk title -->
                                @error('pengurangan_harga')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Harga Estimasi</label>
                                {{-- <select name="" id=""></select> --}}
                                <input type="text" class="form-control @error('harga_estimasi') is-invalid @enderror"
                                    name="harga_estimasi" placeholder="Masukan Harga Estimasi">

                                <!-- error message untuk title -->
                                @error('harga_estimasi')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
