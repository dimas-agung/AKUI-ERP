@extends('layouts.master1')
@section('menu')
    Master
@endsection
@section('title')
    Update Unit
@endsection
@section('content')
    <div class="row">
        <div class="card border border-primary border-3 shadow-sm rounded">
            <div class="card-header">
                <h4>Update Data Unit</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('Unit.update', $unit->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="basic-usage">Pilih Perusahaan</label>
                        <select class="choices form-select" name="perusahaan_id">
                            @foreach ($perusahaan as $post)
                                <option value="{{ $post->id }}"
                                    {{ $unit->perusahaan_id == $post->id ? 'selected' : '' }}>
                                    {{ old('perusahaan_id', $post->nama) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="basic-usage">Pilih Workstation ID</label>
                        <select class="choices form-select" name="workstation_id">
                            @foreach ($workstation as $post)
                                <option value="{{ $post->id }}"
                                    {{ $unit->workstation_id == $post->id ? 'selected' : '' }}>
                                    {{ old('workstation_id', $post->nama) }}</option>
                            @endforeach
                        </select>
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
                            <option value="1" {{ $unit->status == 1 ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ $unit->status == 0 ? 'selected' : '' }}>Tidak Aktif</option>
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
@section('script')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                closeOnSelect: false
            });
        });
    </script>
@endsection
