@extends('layouts.master1')
@section('title')
    Update Prm Raw Material Output Header
@endsection
@section('content')
    {{-- <div class="container mt-5 mb-5"> --}}
    <div class="row">
        {{-- <div class="col-md-12"> --}}
        <div class="card border-0 shadow-sm rounded">
            <div class="card-header">
                <h4>Update Data Prm Raw Material Output Header</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('PrmRawMaterialOutputHeader.update', $PrmRawMOH->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Nomor Dokument</label>
                        <input type="text" class="form-control @error('doc_no') is-invalid @enderror" name="doc_no"
                            value="{{ old('doc_no', $PrmRawMOH->doc_no) }}" placeholder="Masukkan nomor Dokument">
                        <!-- error message untuk title -->
                        @error('doc_no')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Nomor BTSB</label>
                        <input type="text" class="form-control @error('nomor_bstb') is-invalid @enderror"
                            name="nomor_bstb" value="{{ old('nomor_bstb', $PrmRawMOH->nomor_bstb) }}"
                            placeholder="Masukkan nomor bstb">
                        <!-- error message untuk title -->
                        @error('nomor_bstb')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Nomor Batch</label>
                        <input type="text" class="form-control @error('nomor_batch') is-invalid @enderror"
                            name="nomor_batch" value="{{ old('nomor_batch', $PrmRawMOH->nomor_batch) }}"
                            placeholder="Masukkan nomor Batch">
                        <!-- error message untuk title -->
                        @error('nomor_batch')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <input type="text" class="form-control @error('keterangan') is-invalid @enderror"
                            name="keterangan" value="{{ old('keterangan', $PrmRawMOH->keterangan) }}"
                            placeholder="Masukkan keterangan">
                        <!-- error message untuk title -->
                        @error('keterangan')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>User Created</label>
                        <input type="text" class="form-control @error('user_created') is-invalid @enderror"
                            name="user_created" value="{{ old('user_created', $PrmRawMOH->user_created) }}"
                            placeholder="Masukkan user created">
                        <!-- error message untuk title -->
                        @error('user_created')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>User Updated</label>
                        <input type="text" class="form-control @error('user_updated') is-invalid @enderror"
                            name="user_updated" value="{{ old('user_updated', $PrmRawMOH->user_updated) }}"
                            placeholder="Masukkan user updated">
                        <!-- error message untuk title -->
                        @error('user_updated')
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
