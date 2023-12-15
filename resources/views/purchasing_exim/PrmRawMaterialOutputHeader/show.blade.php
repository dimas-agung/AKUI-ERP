@extends('layouts.master1')
@section('title')
    Detail Data Prm Raw Material Output Header
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="card border-0 shadow-sm rounded">
            <div class="card-header">
                <h4>Detail Data Prm Raw Material Output Header</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">ID</th>
                                <th class="text-center" scope="col">Nomor Dokument</th>
                                <th class="text-center" scope="col">Nomor BTSB</th>
                                <th class="text-center" scope="col">Nomor Batch</th>
                                <th class="text-center" scope="col">Keterangan</th>
                                <th class="text-center" scope="col">User Created</th>
                                <th class="text-center" scope="col">User Updated</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">{{ $PrmRawMOH->id }}</td>
                                <td class="text-center">{{ $PrmRawMOH->doc_no }}</td>
                                <td class="text-center">{{ $PrmRawMOH->nomor_bstb }}</td>
                                <td class="text-center">{{ $PrmRawMOH->nomor_batch }}</td>
                                <td class="text-center">{{ $PrmRawMOH->keterangan }}</td>
                                <td class="text-center">{{ $PrmRawMOH->user_created }}</td>
                                <td class="text-center">{{ $PrmRawMOH->user_updated }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
