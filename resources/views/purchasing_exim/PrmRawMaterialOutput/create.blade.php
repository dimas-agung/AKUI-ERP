@extends('layouts.master2')
@section('title')
    Inout Data PRM Raw Material Output
@endsection
@section('content')
    <div class="container">
        <div class="card mt-2">
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 shadow-sm rounded">
                        <div class="card-header">
                            <h4>Input Data Prm Raw Material Output Header</h4>
                        </div>
                        <div class="card-body">

                            {{-- Create Data --}}
                            @if (session()->has('success'))
                                <div class="alert alert-success">
                                    <strong>Sukses: </strong>{{ session()->get('success') }}
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul><strong>
                                            @foreach ($errors->all() as $error)
                                                <li> {{ $error }} </li>
                                            @endforeach
                                        </strong>
                                    </ul>
                                    <p>Mohon periksa kembali formulir Anda.</p>
                                </div>
                            @endif
                            {{-- <form action="{{ route('PrmRawMaterialOutputHeader.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label class="font-weight-bold">Unit ID</label>
                                    <input type="text" class="form-control @error('unit_id') is-invalid @enderror"
                                        name="unit_id" value="{{ old('unit_id') }}" placeholder="Masukkan Unit ID">

                                    <!-- error message untuk title -->
                                    @error('unit_id')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">Jenis Biaya</label>
                                    <input type="text" class="form-control @error('jenis_biaya') is-invalid @enderror"
                                        name="jenis_biaya" value="{{ old('jenis_biaya') }}"
                                        placeholder="Masukkan Jenis Biaya">

                                    <!-- error message untuk title -->
                                    @error('jenis_biaya')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">Biaya PerGram</label>
                                    <input type="text" class="form-control @error('biaya_per_gram') is-invalid @enderror"
                                        name="biaya_per_gram" value="{{ old('biaya_per_gram') }}"
                                        placeholder="Masukkan Biaya PerGram">

                                    <!-- error message untuk title -->
                                    @error('biaya_per_gram')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                                <button type="reset" class="btn btn-md btn-warning">RESET</button>

                            </form> --}}
                            <form action="{{ route('PrmRawMaterialOutputHeader.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 pr-0">
                                        <div class="form-group">
                                            <label>Nomer Dokument</label>
                                            <input type="text" class="form-control @error('doc_no') is-invalid @enderror"
                                                name="doc_no" value="{{ old('doc_no') }}"
                                                placeholder="Masukkan Nomer Dokument">
                                            <!-- error message untuk title -->
                                            @error('doc_no')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Nomor BTSB</label>
                                            <input type="text"
                                                class="form-control @error('nomor_bstb') is-invalid @enderror"
                                                name="nomor_bstb" value="{{ old('nomor_bstb') }}"
                                                placeholder="Masukkan nomor_bstb">
                                            <!-- error message untuk title -->
                                            @error('nomor_bstb')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Nomor Batch</label>
                                            <input type="text"
                                                class="form-control @error('nomor_batch') is-invalid @enderror"
                                                name="nomor_batch" value="{{ old('nomor_batch') }}"
                                                placeholder="Masukkan Nomor Batch">
                                            <!-- error message untuk title -->
                                            @error('nomor_batch')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 pr-0">
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <input type="text"
                                                class="form-control @error('keterangan') is-invalid @enderror"
                                                name="keterangan" value="{{ old('keterangan') }}"
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
                                            <input type="text"
                                                class="form-control @error('user_created') is-invalid @enderror"
                                                name="user_created" value="{{ old('user_created') }}"
                                                placeholder="Masukkan User Created">
                                            <!-- error message untuk title -->
                                            @error('user_created')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>User Updated</label>
                                            <input type="text"
                                                class="form-control @error('user_updated') is-invalid @enderror"
                                                name="user_updated" value="{{ old('user_updated') }}"
                                                placeholder="Masukkan User Updated">
                                            <!-- error message untuk title -->
                                            @error('user_updated')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="modal-footer no-bd">
                                        <button type="submit" class="btn btn-primary">Add</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
