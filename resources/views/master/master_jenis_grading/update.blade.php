@extends('layouts.master1')
@section('menu')
    Master
@endsection
@section('title')
    Update Master Jenis Grading
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-header">
                        <h4>UPDATE DATA MASTER JENIS GRADING</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('master_jenis_grading.update', $MasterJGD->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label><strong>Nama</strong></label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                                    value="{{ old('nama', $MasterJGD->nama) }}">
                            </div>
                            <div class="form-group">
                                <label><strong>Pilih Unit ID</strong></label>
                                <select class="choices form-select" name="unit_id" data-placeholder="Pilih Unit ID">
                                    @foreach ($unit as $post)
                                        <option value="{{ $post->id }}"
                                            {{ $MasterJGD->unit_id == $post->id ? 'selected' : '' }}>
                                            {{ old('unit_id', $post->nama) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label><strong>NIP Admin</strong></label>
                                <input type="text" name="user_created" placeholder="Masukkan User Updated"
                                    class="form-control @error('user_created') is-invalid @enderror"
                                    value="{{ old('nama', $MasterJGD->user_created) }}">
                            </div>
                            <div class="form-group">
                                <label><strong>Status</strong></label>
                                <select class="form-control" @error('status') is-invalid @enderror" name="status">
                                    <option value="1" {{ $MasterJGD->status == 1 ? 'selected' : '' }}>AKTIF</option>
                                    <option value="0" {{ $MasterJGD->status == 0 ? 'selected' : '' }}>TIDAK AKTIF
                                    </option>
                                </select>
                            </div>
                            <div class="col-12 mt-2">
                                <button type="submit" class="btn btn-md btn-primary">UPDATE</button>
                                <button type="reset" class="btn btn-md btn-warning" onclick="reset()">RESET</button>
                                <button type="button" class="btn btn-danger" onclick="goBack()">CANCEL</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    function reset() {
        $('#jenis').val($('#jenis option:first').val()).trigger('change');
    }
</script>
