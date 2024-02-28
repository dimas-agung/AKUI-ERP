@extends('layouts.master1')
@section('menu')
    Master
@endsection
@section('title')
    Master Ongkos Cuci
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card border border-primary border-3">
                    <div class="card-header">
                        <h4>UPDATE DATA MASTER ONGKOS CUCI</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('MasterOngkosCuci.update', $MasterOngkosCuci->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label class="font-weight-bold">Unit</label>
                                <input type="text" class="form-control @error('unit') is-invalid @enderror"
                                    name="unit" value="{{ old('unit', $MasterOngkosCuci->unit) }}"
                                    placeholder="Masukkan unit">
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Jenis Bulu</label>
                                {{-- <select name="" id=""></select> --}}
                                <input type="text" class="form-control @error('jenis_bulu') is-invalid @enderror"
                                    name="jenis_bulu" value="{{ old('jenis_bulu', $MasterOngkosCuci->jenis_bulu) }}"
                                    placeholder="Masukan Kategori Susut">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Biaya Per Gram</label>
                                {{-- <select name="" id=""></select> --}}
                                <input type="text" pattern="[0-9.]*" inputmode="numeric"
                                    onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                                    step="0.01" class="form-control @error('biaya_per_gram')
is-invalid
@enderror"
                                    name="biaya_per_gram"
                                    value="{{ old('biaya_per_gram', $MasterOngkosCuci->biaya_per_gram) }}"
                                    placeholder="Masukan Upah Operator">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Status</label>
                                <select class="form-control" @error('status') is-invalid @enderror" name="status">
                                    <option value="1" {{ $MasterOngkosCuci->status == 1 ? 'selected' : '' }}> AKTIF
                                    </option>
                                    <option value="0" {{ $MasterOngkosCuci->status == 0 ? 'selected' : '' }}> TIDAK
                                        AKTIF
                                    </option>
                                </select>
                                <!-- error message untuk title -->
                                @error('status')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
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
