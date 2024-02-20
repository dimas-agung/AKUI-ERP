@extends('layouts.master1')
@section('menu')
    Master
@endsection
@section('title')
    Detail Workstation
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="card border-0 shadow-sm rounded">
            <div class="card-header">
                <h4>Detail Workstation</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center" scope="col">ID</th>
                            <th class="text-center" scope="col">Nama</th>
                            <th class="text-center" scope="col">Status</th>
                            <th class="text-center" scope="col">Waktu Buat</th>
                            <th class="text-center" scope="col">Waktu Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">{{ $workstation->id }}</td>
                            <td class="text-center">{{ $workstation->nama }}</td>
                            <td class="text-center">{{ $workstation->status }}</td>
                            <td class="text-center">{{ $workstation->created_at }}</td>
                            <td class="text-center">{{ $workstation->updated_at }}</td>
                        </tr>
                    </tbody>
                </table>
                <div class=" d-flex justify-content-end model-footer no-bd">
                    <a href="{{ Route('Workstation.index') }}" type="button" class="btn btn-danger"
                        data-dismiss="modal">Close</a>
                </div>
            </div>
        </div>
    </div>
@endsection
