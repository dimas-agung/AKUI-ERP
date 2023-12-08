@extends('layouts.admin')
@section('content')
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <h4>{{ $MasterSPR->nama_supplier }}</h4>
                        <h4>{{ $MasterSPR->inisial_supplier }}</h4>
                        <h4>{{ $MasterSPR->status }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
