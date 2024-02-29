@extends('layouts.master1')
@section('menu')
    Master
@endsection
@section('title')
    Update Workstation
@endsection
@section('content')
    {{-- <div class="container mt-5 mb-5"> --}}
    <div class="row">
        {{-- <div class="col-md-12"> --}}
        <div class="card border border-primary border-3 shadow-sm rounded">
            <div class="card-header">
                <h4>Update Workstation</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('Workstation.update', $workstation->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label class="font-weight-bold">Nama</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                            value="{{ old('nama', $workstation->nama) }}" placeholder="Masukkan Nama Post">

                        <!-- error message untuk nama -->
                        @error('nama')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Status</label>
                        <select class="form-control @error('status') is-invalid @enderror" name="status"
                            value="{{ old('status') }}">
                            <option value="1" {{ $workstation->status == 1 ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ $workstation->status == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                        <!-- error message untuk status -->
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
        {{-- </div> --}}
    </div>
    {{-- </div> --}}
@endsection
