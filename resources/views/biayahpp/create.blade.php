@extends('layout.BiayaHpp')
@section('judul')
    <h3 class="text-center my-4">Memasukan Data Biaya Hpp AKUI-ERP</h3>
@section('con')
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <form action="{{ route('biaya.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="font-weight-bold">Unit ID</label>
                            <input type="text" class="form-control @error('unit_id') is-invalid @enderror" name="unit_id"
                                value="{{ old('unit_id') }}" placeholder="Masukkan Unit ID">

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
                                name="jenis_biaya" value="{{ old('jenis_biaya') }}" placeholder="Masukkan Jenis Biaya">

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

                    </form>
                </div>
            </div>
        </div>
    </div>
@section('script')
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection
