@extends('layouts.admin')
@section('content')
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <h4>{{ $MasterJRM->jenis }}</h4>
                        <h4>{{ $MasterJRM->kategori_susut }}</h4>
                        <h4>{{ $MasterJRM->upah_operator }}</h4>
                        <h4>{{ $MasterJRM->pengurangan_harga }}</h4>
                        <h4>{{ $MasterJRM->harga_estimasi }}</h4>
                        <h4>{{ $MasterJRM->status }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
