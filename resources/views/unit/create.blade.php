@extends('layout.Unit')
@section('judul')
    <h3 class="text-center my-4">Membuat Data Unit AKUI-ERP</h3>
@section('con')
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <form action="{{ route('index.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="font-weight-bold">Workstation ID</label>
                            <input type="text" class="form-control @error('workstation_id') is-invalid @enderror"
                                name="workstation_id" value="{{ old('workstation_id') }}"
                                placeholder="Masukan Workstation ID">
                            <!-- error message untuk title -->
                            @error('nama')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Nama</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                                value="{{ old('nama') }}" placeholder="Masukkan Nama">

                            <!-- error message untuk title -->
                            @error('nama')
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

    @yield('script')
    <script>
        CKEDITOR.replace('content');
    </script>
@endsection
