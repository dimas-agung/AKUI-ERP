@extends('layouts.master2')
@section('title')
    PRM Raw Material Output
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Data PRM Raw Material Output</h4>
                    <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
                        <a href="{{ url('/PrmRawMaterialOutput/create') }}" style="text-decoration: none; color:aliceblue">
                            <i class="fa fa-plus"></i>
                            <span class="sub-item">Add Data</span>
                        </a>
                    </button>
                </div>
            </div>
            <div class="card-body">
                {{-- Create Data --}}
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        <strong>Sukses: </strong>{{ session()->get('success') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul><strong>
                                @foreach ($errors->all() as $error)
                                    <li> {{ $error }} </li>
                                @endforeach
                            </strong>
                        </ul>
                        <p>Mohon periksa kembali formulir Anda.</p>
                    </div>
                @endif
                <div class="table-responsive">
                    <table id="add-row" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nomor Doc</th>
                                <th class="text-center">Nomor BTSB</th>
                                <th class="text-center">Nomor Batch</th>
                                <th class="text-center">Keterangan</th>
                                <th class="text-center">NIP Admin</th>
                                <th style="width: 10%" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <th class="text-center">No</th>
                            <th class="text-center">Nomor Doc</th>
                            <th class="text-center">Nomor BTSB</th>
                            <th class="text-center">Nomor Batch</th>
                            <th class="text-center">Keterangan</th>
                            <th class="text-center">NIP Admin</th>
                            <th class="text-center">Action</th>
                        </tfoot>
                        <tbody>
                            @forelse ($PrmRawMOH as $post)
                                <tr>
                                    <td class="text-center">{{ $i++ }}</td>
                                    <td class="text-center">{!! $post->doc_no !!}</td>
                                    <td class="text-center">{!! $post->nomor_bstb !!}</td>
                                    <td class="text-center">{!! $post->nomor_batch !!}</td>
                                    <td class="text-center">{!! $post->keterangan !!}</td>
                                    <td class="text-center">{!! $post->user_created !!}</td>
                                    <td class="text-center">
                                        <div class="form-button-action">
                                            <form style="display: flex" onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('PrmRawMaterialOutput.destroyHead', $post->id) }}"
                                                method="POST">
                                                <a href="{{ route('PrmRawMaterialOutput.show', $post->id) }}"
                                                    class="btn btn-link btn-info" title="Show Task"
                                                    data-original-title="Show"><i class="fa fa-file"></i></a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" data-toggle="tooltip"
                                                    class="btn btn-link btn-danger"data-original-title="Remove"><i
                                                        class="fa fa-times"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <div class="alert alert-danger">
                                    Data PRM Raw Material Output belum Tersedia.
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
