@extends('layouts.admin')
@section('content')
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Jenis</th>
                                    <th scope="col">Kategori Susut</th>
                                    <th scope="col">Upah Operator</th>
                                    <th scope="col">Pengurangan harga</th>
                                    <th scope="col">Harga Estimasi</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Tanggal Buat</th>
                                    <th scope="col">Tanggal Update</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $MasterJRM->id }}</td>
                                    <td>{{ $MasterJRM->jenis }}</td>
                                    <td>{{ $MasterJRM->kategori_susut }}</td>
                                    <td>{{ $MasterJRM->upah_operator }}</td>
                                    <td>{{ $MasterJRM->pengurangan_harga }}</td>
                                    <td>{{ $MasterJRM->harga_estimasi }}</td>
                                    <td>{{ $MasterJRM->status }}</td>
                                    <td>{{ $MasterJRM->created_at }}</td>
                                    <td>{{ $MasterJRM->updated_at }}</td>
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
