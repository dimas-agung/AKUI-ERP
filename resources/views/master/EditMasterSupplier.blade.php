@extends('layouts.admin')
@section('content')
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('master_supplier.update', $MasSupp->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label class="font-weight-bold">Nama Supplier</label>
                                <input type="text" class="form-control @error('nama_supplier') is-invalid @enderror"
                                    name="nama_supplier" value="{{ old('nama_supplier', $MasSupp->nama_supplier) }}">

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
                                    value="{{ old('inisial_supplier', $MasSupp->inisial_supplier) }}">

                                <!-- error message untuk title -->
                                @error('inisial_supplier')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Status</label>
                                <input type="text" class="form-control @error('status') is-invalid @enderror"
                                    name="status" value="{{ old('status', $MasSupp->status) }}">

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
