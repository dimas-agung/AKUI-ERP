@extends('layouts.master1')
@section('menu')
    Master
@endsection
@section('title')
    Update Master Tujuan Kirim Raw Material
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-header">
                        <h4>UPDATE DATA MASTER TUJUAN KIRIM RAW MATERIAL</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('MasterTujuanKirimRawMaterial.update', $MasterTJRM->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label class="font-weight-bold">Tujuan Kirim</label>
                                <input type="text" class="form-control @error('tujuan_kirim') is-invalid @enderror"
                                    name="tujuan_kirim" value="{{ old('tujuan_kirim', $MasterTJRM->tujuan_kirim) }}"
                                    placeholder="Masukkan Tujuan Kirim">

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
                                    name="letak_tujuan" value="{{ old('letak_tujuan', $MasterTJRM->letak_tujuan) }}"
                                    placeholder="Masukkan Letak Tujuan">

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
                                    name="inisial_tujuan" value="{{ old('inisial_tujuan', $MasterTJRM->inisial_tujuan) }}"
                                    placeholder="Masukkan Letak Tujuan">

                                <!-- error message untuk title -->
                                @error('inisial_tujuan')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Status</label>
                                <select class="form-control" @error('status') is-invalid @enderror" name="status"
                                    value="{{ old('status', $MasterTJRM->status) }}">
                                    <option value="1" {{ $MasterTJRM->status == 1 ? 'selected' : '' }}>AKTIF</option>
                                    <option value="0" {{ $MasterTJRM->status == 0 ? 'selected' : '' }}>TIDAK AKTIF
                                    </option>
                                </select>
                                <!-- error message untuk title -->
                                @error('status')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>



                            <button type="submit" class="btn btn-md btn-primary">UPDATE</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>
                            <button type="button" class="btn btn-danger" onclick="goBack()">CANCEL</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
