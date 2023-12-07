@extends('layouts.admin')
@section('content')
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <h4>{{ $MasJen->datetime }}</h4>
                        <h4>{{ $MasJen->jenis }}</h4>
                        <h4>{{ $MasJen->kategori_susut }}</h4>
                        <h4>{{ $MasJen->upah_operator }}</h4>
                        <h4>{{ $MasJen->pengurangan_harga }}</h4>
                        <h4>{{ $MasJen->harga_estimasi }}</h4>
                        <h4>{{ $MasJen->status }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
