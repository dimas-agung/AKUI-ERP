@extends('layouts.admin')
@section('content')
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <h4>{{ $MasterTJRM->id }}</h4>
                        <h4>{{ $MasterTJRM->tujuan_kirim }}</h4>
                        <h4>{{ $MasterTJRM->letak_tujuan }}</h4>
                        <h4>{{ $MasterTJRM->inisial_tujuan }}</h4>
                        <h4>{{ $MasterTJRM->status }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
