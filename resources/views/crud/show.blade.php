@extends('layout.crud')
@section('konten')
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col">ID</th>
                                    <th class="text-center" scope="col">Tanggal</th>
                                    <th class="text-center" scope="col">Nama</th>
                                    <th class="text-center" scope="col">Status</th>
                                    <th class="text-center" scope="col">Waktu Buat</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">{{ $workstation->id }}</td>
                                    <td class="text-center">{{ $workstation->datetime }}</td>
                                    <td class="text-center">{{ $workstation->nama }}</td>
                                    <td class="text-center">{{ $workstation->status }}</td>
                                    <td class="text-center">{{ $workstation->created_at }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
