@extends('layouts.admin')
@section('content')
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Tujuan Kirim</th>
                                    <th scope="col">Letak Tujuan</th>
                                    <th scope="col">Inisial Kirim</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Tanggal Buat</th>
                                    <th scope="col">Tanggal Update</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $MasterTJRM->id }}</td>
                                    <td>{{ $MasterTJRM->tujuan_kirim }}</td>
                                    <td>{{ $MasterTJRM->letak_tujuan }}</td>
                                    <td>{{ $MasterTJRM->inisial_tujuan }}</td>
                                    <td>{{ $MasterTJRM->status }}</td>
                                    <td>{{ $MasterTJRM->created_at }}</td>
                                    <td>{{ $MasterTJRM->updated_at }}</td>
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
