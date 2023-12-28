@extends('layouts.master2')
{{-- @extends('layouts.template') --}}
@section('content')
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-header">
                        <h4>UPDATE DATA MASTER SUPPLIER RAW MATERIAL</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('master_supplier_raw_material.update', $MasterSPR->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="font-weight-bold">Nama Supplier</label>
                                <input type="text" class="form-control @error('nama_supplier') is-invalid @enderror"
                                    name="nama_supplier" value="{{ old('nama_supplier', $MasterSPR->nama_supplier) }}">

                                <!-- error message untuk title -->
                                @error('inisial_supplier')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Inisial Supplier</label>
                                <input type="text" class="form-control @error('inisial_supplier') is-invalid @enderror"
                                    name="inisial_supplier"
                                    value="{{ old('inisial_supplier', $MasterSPR->inisial_supplier) }}">

                                <!-- error message untuk title -->
                                @error('inisial_supplier')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Status</label>
                                <select class="form-control" @error('status') is-invalid @enderror" name="status">
                                    <option value="1" {{ $MasterSPR->status == 1 ? 'selected' : '' }}>AKTIF</option>
                                    <option value="0" {{ $MasterSPR->status == 0 ? 'selected' : '' }}>TIDAK AKTIF
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
