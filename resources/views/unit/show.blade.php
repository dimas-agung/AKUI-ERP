@extends('layouts.master1')
@section('title')
    Detail Unit
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="card border-0 shadow-sm rounded">
            <div class="card-header">
                <h4>Detail Unit</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center" scope="col">ID</th>
                            <th class="text-center" scope="col">Workstation ID</th>
                            <th class="text-center" scope="col">Nama Workstation</th>
                            <th class="text-center" scope="col">Nama Unit</th>
                            <th class="text-center" scope="col">Status</th>
                            <th class="text-center" scope="col">Waktu Buat</th>
                            <th class="text-center" scope="col">Waktu Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">{{ $unit->id }}</td>
                            <td class="text-center">{{ $unit->workstation_id }}</td>
                            <td class="text-center">{{ $unit->workstation->nama }}</td>
                            <td class="text-center">{{ $unit->nama }}</td>
                            <td class="text-center">{{ $unit->status }}</td>
                            <td class="text-center">{{ $unit->created_at }}</td>
                            <td class="text-center">{{ $unit->updated_at }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection