@extends('layouts.admin')
@section('content')
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('master_tujuan_kirim_raw_material.store') }}" method="POST">

                            @csrf

                            <div class="form-group">
                                <label class="font-weight-bold">Tujuan Kirim</label>
                                <input type="text" class="form-control @error('tujuan_kirim') is-invalid @enderror"
                                    name="tujuan_kirim" placeholder="Masukkan Tujuan Kirim">

                                <!-- error message untuk title -->
                                @error('tujuan_kirim')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Letak Tujuan</label>
                                <input type="text" class="form-control @error('letak_tujuan') is-invalid @enderror"
                                    name="letak_tujuan" placeholder="Masukkan Letak Tujuan">

                                <!-- error message untuk title -->
                                @error('letak_tujuan')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Inisial Tujuan</label>
                                <input type="text" class="form-control @error('inisial_tujuan') is-invalid @enderror"
                                    name="inisial_tujuan" placeholder="Masukkan Letak Tujuan">

                                <!-- error message untuk title -->
                                @error('inisial_tujuan')
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
