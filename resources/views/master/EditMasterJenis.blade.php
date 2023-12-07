@extends('layouts.admin')
@section('content')
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('master_jenis.update', $MasJen->id) }}" method="POST">
                            @csrf
                            @method('PUT')


                            <div class="form-group">
                                <label class="font-weight-bold">Waktu</label>
                                <input type="date" class="form-control @error('datetime') is-invalid @enderror"
                                    name="datetime" value="{{ old('datetime', $MasJen->datetime) }}">

                                <!-- error message untuk title -->
                                @error('datetime')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Jenis</label>
                                <input type="text" class="form-control @error('jenis') is-invalid @enderror"
                                    name="jenis" value="{{ old('jenis', $MasJen->jenis) }}" placeholder="Masukkan jenis">

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
                                    name="kategori_susut" value="{{ old('kategori_susut', $MasJen->kategori_susut) }}"
                                    placeholder="Masukan Kategori Susut">

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
                                    name="upah_operator" value="{{ old('upah_operator', $MasJen->upah_operator) }}"
                                    placeholder="Masukan Upah Operator">

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
                                    name="pengurangan_harga"
                                    value="{{ old('pengurangan_harga', $MasJen->pengurangan_harga) }}"
                                    placeholder="Masukan Pengurangan Harga">

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
                                    name="harga_estimasi" value="{{ old('harga_estimasi', $MasJen->harga_estimasi) }}"
                                    placeholder="Masukan Harga Estimasi">

                                <!-- error message untuk title -->
                                @error('harga_estimasi')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Status</label>
                                {{-- <select name="" id=""></select> --}}
                                <input type="text" class="form-control @error('status') is-invalid @enderror"
                                    name="status" value="{{ old('status', $MasJen->status) }}"
                                    placeholder="Masukan Status">

                                <!-- error message untuk title -->
                                @error('status')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>



                            <button type="submit" class="btn btn-md btn-primary">UPDATE</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
