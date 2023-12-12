@extends('layouts.master1')
@section('title')
    Update Unit
@endsection
@section('content')
    <div class="row">
        <div class="card border-0 shadow-sm rounded">
            <div class="card-header">
                <h4>Update Data Unit</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('unit.update', $unit->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label class="font-weight-bold">Workstation ID</label>
                        <input type="text" class="form-control @error('workstation_id') is-invalid @enderror"
                            name="workstation_id" value="{{ old('workstation_id', $unit->workstation_id) }}"
                            placeholder="Masukkan workstation_id Post">
                        <!-- error message untuk workstation_id -->
                        @error('workstation_id')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Nama</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                            value="{{ old('nama', $unit->nama) }}" placeholder="Masukkan Nama Post">
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
                            <option value="">Silahkan Pilih</option>
                            <option value="1">Aktif</option>
                            <option value="0">Tidak</option>
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
    </div>
@endsection
