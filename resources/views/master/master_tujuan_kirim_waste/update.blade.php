@extends('layouts.master1')
@section('menu')
    Master
@endsection
@section('title')
    Update Master Tujuan Kirim Waste
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card border border-primary border-3 shadow-sm rounded">
                    <div class="card-header">
                        <h4>UPDATE DATA MASTER TUJUAN KIRIM WASTE</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('MasterTujuanKirimWaste.update', $MasterTujuanKirimWaste->id) }}"
                            method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label class="font-weight-bold">Tujuan Kirim</label>
                                <input type="text" class="form-control @error('tujuan_kirim') is-invalid @enderror"
                                    name="tujuan_kirim"
                                    value="{{ old('tujuan_kirim', $MasterTujuanKirimWaste->tujuan_kirim) }}"
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
                                    name="letak_tujuan"
                                    value="{{ old('letak_tujuan', $MasterTujuanKirimWaste->letak_tujuan) }}"
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
                                    name="inisial_tujuan"
                                    value="{{ old('inisial_tujuan', $MasterTujuanKirimWaste->inisial_tujuan) }}"
                                    placeholder="Masukkan Letak Tujuan">

                                <!-- error message untuk title -->
                                @error('inisial_tujuan')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label><strong>NIP Admin</strong></label>
                                <input type="text" name="user_created" placeholder="Masukkan User Updated"
                                    class="form-control @error('user_created') is-invalid @enderror"
                                    value="{{ old('nama', $MasterTujuanKirimWaste->user_created) }}">

                                <!-- error message untuk title -->
                                @error('user_created')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>



                            <div class="form-group">
                                <label class="font-weight-bold">Status</label>
                                <select class="form-control" @error('status') is-invalid @enderror" name="status"
                                    value="{{ old('status', $MasterTujuanKirimWaste->status) }}">
                                    <option value="1" {{ $MasterTujuanKirimWaste->status == 1 ? 'selected' : '' }}>
                                        AKTIF</option>
                                    <option value="0" {{ $MasterTujuanKirimWaste->status == 0 ? 'selected' : '' }}>
                                        TIDAK AKTIF
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
                            <a href="{{ Route('MasterTujuanKirimWaste.index') }}" type="button" class="btn btn-danger"
                                data-dismiss="modal">CANCEL</a>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
