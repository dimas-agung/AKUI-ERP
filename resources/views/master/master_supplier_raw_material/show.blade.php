@extends('layouts.admin')
@section('content')
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border border-primary border-3 shadow-sm rounded">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Nama Supplier</th>
                                    <th scope="col">Inisial supplier</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Tanggal Buat</th>
                                    <th scope="col">Tanggal Update</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $MasterSPR->id }}</td>
                                    <td>{{ $MasterSPR->nama_supplier }}</td>
                                    <td>{{ $MasterSPR->inisial_supplier }}</td>
                                    <td>{{ $MasterSPR->status }}</td>
                                    <td>{{ $MasterSPR->created_at }}</td>
                                    <td>{{ $MasterSPR->updated_at }}</td>
                                </tr>
                                <div class="alert alert-info">
                                    Detail Data.
                                </div>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
