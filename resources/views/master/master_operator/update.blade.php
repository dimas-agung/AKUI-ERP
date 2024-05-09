@extends('layouts.master1')
@section('menu')
    Master
@endsection
@section('title')
    Master Operator
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card border border-primary border-3">
                    <div class="card-header">
                        <h4>UPDATE DATA MASTER OPERATOR</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('MasterOperator.update', $MasterOP->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label class="font-weight-bold">Nama</label>
                                <input id="nama" type="text"
                                    class="form-control @error('nama') is-invalid @enderror" name="nama"
                                    value="{{ old('nama', $MasterOP->nama) }}" placeholder="Masukkan jenis">
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">NIP</label>
                                <input id="nip" type="text" class="form-control @error('nip') is-invalid @enderror"
                                    name="nip" value="{{ old('nip', $MasterOP->nip) }}"
                                    placeholder="Masukan Kategori Susut">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Perusahaan</label>
                                <select class="select2 form-select" name="perusahaan_id" id="perusahaan_id">
                                    @foreach ($perusahaan as $post)
                                        <option value="{{ $post->plant }}"
                                            {{ $MasterOP->plant == $post->plant ? 'selected' : '' }}>
                                            {{ old('plant', $post->nama) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Divisi</label>
                                <input id="divisi" type="text"
                                    class="form-control @error('divisi') is-invalid @enderror" name="divisi"
                                    value="{{ old('divisi', $MasterOP->divisi) }}" placeholder="Masukan Kategori Susut">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Departemen</label>
                                <input id="departemen" type="text"
                                    class="form-control @error('departemen') is-invalid @enderror" name="departemen"
                                    value="{{ old('departemen', $MasterOP->departemen) }}"
                                    placeholder="Masukan Kategori Susut">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Bagian</label>
                                <input id="bagian" type="text"
                                    class="form-control @error('bagian') is-invalid @enderror" name="bagian"
                                    value="{{ old('bagian', $MasterOP->bagian) }}" placeholder="Masukan Kategori Susut">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Workstation</label>
                                <select class="select2 form-select" name="workstation_id" id="workstation_id">
                                    @foreach ($workstation as $post)
                                        <option value="{{ $post->nama }}"
                                            {{ $MasterOP->workstation == $post->id ? 'selected' : '' }}>
                                            {{ old('workstation', $post->nama) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Unit</label>
                                <select class="select2 form-select" name="unit_id" id="unit_id">
                                    @foreach ($unit as $post)
                                        <option value="{{ $post->nama }}"
                                            {{ $MasterOP->unit == $post->nama ? 'selected' : '' }}>
                                            {{ old('unit', $post->nama) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Grade Operator</label>
                                <input id="grade_operator" type="text"
                                    class="form-control @error('grade_operator') is-invalid @enderror" name="grade_operator"
                                    value="{{ old('grade_operator', $MasterOP->grade_operator) }}"
                                    placeholder="Masukan Grade Operator">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Nama Team Leader</label>
                                <input id="nama_team_leader" type="text"
                                    class="form-control @error('nama_team_leader') is-invalid @enderror"
                                    name="nama_team_leader"
                                    value="{{ old('nama_team_leader', $MasterOP->nama_team_leader) }}"
                                    placeholder="Masukkan Nama Team Leader">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Job</label>
                                <input id="job" type="text" class="form-control @error('job') is-invalid @enderror"
                                    name="job" value="{{ old('job', $MasterOP->job) }}"
                                    placeholder="Masukan Kategori Susut">
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
