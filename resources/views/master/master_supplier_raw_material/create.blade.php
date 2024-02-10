@extends('layouts.admin')
@section('content')
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-header">
                        <h4>CREATE DATA MASTER SUPPLIER RAW MATERIAL</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('MasterSupplierRawMaterial.store') }}" method="POST">

                            @csrf

                            <div class="form-group">
                                <label class="font-weight-bold">Nama Supplier</label>
                                <input type="text" class="form-control @error('nama_supplier') is-invalid @enderror"
                                    name="nama_supplier" placeholder="Masukkan Nama Supplier">

                                <!-- error message untuk title -->
                                @error('nama_supplier')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Inisial Supplier</label>
                                <input type="text" class="form-control @error('inisial_supplier') is-invalid @enderror"
                                    name="inisial_supplier" placeholder="Masukkan Inisial Supplier">

                                <!-- error message untuk title -->
                                @error('inisial_supplier')
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
