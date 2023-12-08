@extends('layout.master')
@section('con')
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-header">
                        <h4>Update Data Biaya HPP</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('biaya.update', $biaya->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label class="font-weight-bold">Unit ID</label>
                                <input type="text" class="form-control @error('unit_id') is-invalid @enderror"
                                    name="unit_id" value="{{ old('unit_id', $biaya->unit_id) }}"
                                    placeholder="Masukkan Unit ID">

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
        </div>
    </div>

@section('script')
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection
