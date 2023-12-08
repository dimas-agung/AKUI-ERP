@extends('layout.BiayaHpp')
@section('judul')
    <h3 class="text-center my-4">Detail Data Biaya HPP AKUI-ERP</h3>
@section('con')
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col">ID</th>
                                    <th class="text-center" scope="col">Jenis Biaya</th>
                                    <th class="text-center" scope="col">Biaya PerGram</th>
                                    <th class="text-center" scope="col">Nama Unit</th>
                                    <th class="text-center" scope="col">Status</th>
                                    <th class="text-center" scope="col">Waktu Buat</th>
                                    <th class="text-center" scope="col">Waktu Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">{{ $biaya->id }}</td>
                                    <td class="text-center">{{ $biaya->jenis_biaya }}</td>
                                    <td class="text-center">{{ $biaya->biaya_per_gram }}</td>
                                    <td class="text-center">{{ $biaya->unit->nama }}</td>
                                    <td class="text-center">{{ $biaya->status }}</td>
                                    <td class="text-center">{{ $biaya->created_at }}</td>
                                    <td class="text-center">{{ $biaya->updated_at }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
