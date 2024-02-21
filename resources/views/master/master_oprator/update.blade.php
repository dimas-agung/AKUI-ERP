@extends('layouts.master1')
@section('menu')
    Master
@endsection
@section('title')
    Master Jenis Raw Material
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card border border-primary border-3 shadow-sm rounded">
                    <div class="card-header">
                        <h4>UPDATE DATA MASTER JENIS RAW MATERIAL</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('MasterOperator.update', $MasterOP->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label class="font-weight-bold">Nama</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    name="nama" value="{{ old('nama', $MasterOP->nama) }}" placeholder="Masukkan jenis">
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">NIP</label>
                                <input type="text" class="form-control @error('nip') is-invalid @enderror" name="nip"
                                    value="{{ old('nip', $MasterOP->nip) }}" placeholder="Masukan Kategori Susut">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Plant</label>
                                <input type="text" class="form-control @error('plant') is-invalid @enderror"
                                    name="plant" value="{{ old('plant', $MasterOP->plant) }}"
                                    placeholder="Masukan Kategori Susut">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Divisi</label>
                                <input type="text" class="form-control @error('divisi') is-invalid @enderror"
                                    name="divisi" value="{{ old('divisi', $MasterOP->divisi) }}"
                                    placeholder="Masukan Kategori Susut">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Departemen</label>
                                <input type="text" class="form-control @error('departemen') is-invalid @enderror"
                                    name="departemen" value="{{ old('departemen', $MasterOP->departemen) }}"
                                    placeholder="Masukan Kategori Susut">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Bagian</label>
                                <input type="text" class="form-control @error('bagian') is-invalid @enderror"
                                    name="bagian" value="{{ old('bagian', $MasterOP->bagian) }}"
                                    placeholder="Masukan Kategori Susut">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Workstation</label>
                                <input type="text" class="form-control @error('workstation') is-invalid @enderror"
                                    name="workstation" value="{{ old('workstation', $MasterOP->workstation) }}"
                                    placeholder="Masukan Kategori Susut">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Unit</label>
                                <input type="text" class="form-control @error('unit') is-invalid @enderror"
                                    name="unit" value="{{ old('unit', $MasterOP->unit) }}"
                                    placeholder="Masukan Kategori Susut">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Job</label>
                                <input type="text" class="form-control @error('job') is-invalid @enderror" name="job"
                                    value="{{ old('job', $MasterOP->job) }}" placeholder="Masukan Kategori Susut">
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Status</label>
                                <select class="select2 form-control" @error('status') is-invalid @enderror" name="status">
                                    <option value="1" {{ $MasterOP->status == 1 ? 'selected' : '' }}> AKTIF </option>
                                    <option value="0" {{ $MasterOP->status == 0 ? 'selected' : '' }}> TIDAK AKTIF
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
