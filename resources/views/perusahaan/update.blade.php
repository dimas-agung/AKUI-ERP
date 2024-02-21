@extends('layouts.master1')
@section('menu')
    Master
@endsection
@section('title')
    Update Data Perusahan
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card border border-primary border-3 shadow-sm rounded">
                    <div class="card-header">
                        <h4>UPDATE DATA Perusahaan</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('Perusahaan.update', $Perusahaan->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="font-weight-bold">Nama Perusahaan</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    name="nama" value="{{ old('nama', $Perusahaan->nama) }}">
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Plant</label>
                                <input type="text" class="form-control @error('plant') is-invalid @enderror"
                                    name="plant" value="{{ old('plant', $Perusahaan->plant) }}">
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Status</label>
                                <select class="form-control" @error('status') is-invalid @enderror" name="status">
                                    <option value="1" {{ $Perusahaan->status == 1 ? 'selected' : '' }}>AKTIF</option>
                                    <option value="0" {{ $Perusahaan->status == 0 ? 'selected' : '' }}>TIDAK AKTIF
                                    </option>
                                </select>
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
