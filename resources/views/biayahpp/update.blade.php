@extends('layouts.master2')
@section('title')
    Update Biaya HPP
@endsection
@section('content')
    {{-- <div class="container mt-5 mb-5"> --}}
    <div class="row">
        {{-- <div class="col-md-12"> --}}
        <div class="card border-0 shadow-sm rounded">
            <div class="card-header">
                <h4>Update Data Biaya HPP</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('biaya.update', $biaya->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="basic-usage" class="font-weight-bold">Pilih Unit ID:</label>
                        <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1"
                            aria-hidden="true" name="unit_id" data-placeholder="Pilih Unit ID">
                            @foreach ($unit as $post)
                                <option value="{{ $post->id }}" {{ $biaya->unit_id == $post->id ? 'selected' : '' }}>
                                    {{ old('unit_id', $post->nama) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Jenis Biaya</label>
                        <input type="text" class="form-control @error('jenis_biaya') is-invalid @enderror"
                            name="jenis_biaya" value="{{ old('jenis_biaya', $biaya->jenis_biaya) }}"
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
                            name="biaya_per_gram" value="{{ old('biaya_per_gram', $biaya->biaya_per_gram) }}"
                            placeholder="Masukkan Biaya PerGram">
                        <!-- error message untuk title -->
                        @error('biaya_per_gram')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="font-weight-bold">Status</label>
                        <select class="form-control @error('status') is-invalid @enderror" name="status"
                            value="{{ old('status', $biaya->status) }}">
                            <option value="1" {{ $biaya->status == 1 ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ $biaya->status == 0 ? 'selected' : '' }}>Tidak Aktif</option>
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
@section('script')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endsection
