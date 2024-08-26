@extends('layouts.master1')
@section('menu')
    Master
@endsection
@section('title')
    Update Master Batch
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card border border-primary border-3 shadow-sm rounded">
                    <div class="card-header">
                        <h4>UPDATE DATA MASTER BATCH</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('MasterBatch.update', $MasterBatch->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label><strong>Nomor Batch</strong></label>
                                <input type="text" class="form-control" name="nomor_batch"
                                    value="{{ old('nomor_batch', $MasterBatch->nomor_batch) }}">
                                <!-- error message -->
                                @error('nomor_batch')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label><strong>NIP Admin</strong></label>
                                <input type="text" name="user_created" placeholder="Masukkan User Updated"
                                    class="form-control" value="{{ auth()->user()->nip }}" readonly>
                                <!-- error message -->
                                @error('user_created')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label><strong>Status</strong></label>
                                <select class="form-control" @error('status') is-invalid @enderror" name="status">
                                    <option value="1" {{ $MasterBatch->status == 1 ? 'selected' : '' }}>Aktif
                                    </option>
                                    <option value="0" {{ $MasterBatch->status == 0 ? 'selected' : '' }}>Tidak
                                        Aktif
                                    </option>
                                </select>
                            </div>
                            <div class="col-12 mt-2">
                                <button type="submit" class="btn btn-md btn-primary">UPDATE</button>
                                <button type="reset" class="btn btn-md btn-warning" onclick="reset()">RESET</button>
                                <a href="{{ Route('MasterBatch.index') }}" type="button" class="btn btn-danger"
                                    data-dismiss="modal">CANCEL</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
