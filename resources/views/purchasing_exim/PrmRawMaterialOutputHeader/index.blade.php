@extends('layouts.master1')
@section('title')
    Prm Raw Material Output Header
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Data Prm Raw Material Output Header</h4>
                    <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
                        <i class="fa fa-plus"></i>
                        Add Data
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
                <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-md" role="document">
                        <div class="modal-content">
                            <div class="modal-header no-bd">
                                <h5 class="modal-title">
                                    <span class="fw-mediumbold">
                                        Input</span>
                                    <span class="fw-light">
                                        Data Prm Raw Material Output Header
                                    </span>
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p class="small">Create a new unit using this form, make sure you fill them all</p>
                                <form action="{{ route('PrmRawMaterialOutputHeader.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 pr-0">
                                            <div class="form-group">
                                                <label>Nomer Dokument</label>
                                                <input type="text"
                                                    class="form-control @error('doc_no') is-invalid @enderror"
                                                    name="doc_no" value="{{ old('doc_no') }}"
                                                    placeholder="Masukkan Nomer Dokument">
                                                <!-- error message untuk title -->
                                                @error('doc_no')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Nomor BTSB</label>
                                                <input type="text"
                                                    class="form-control @error('nomor_bstb') is-invalid @enderror"
                                                    name="nomor_bstb" value="{{ old('nomor_bstb') }}"
                                                    placeholder="Masukkan nomor_bstb">
                                                <!-- error message untuk title -->
                                                @error('nomor_bstb')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Nomor Batch</label>
                                                <input type="text"
                                                    class="form-control @error('nomor_batch') is-invalid @enderror"
                                                    name="nomor_batch" value="{{ old('nomor_batch') }}"
                                                    placeholder="Masukkan Nomor Batch">
                                                <!-- error message untuk title -->
                                                @error('nomor_batch')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 pr-0">
                                            <div class="form-group">
                                                <label>Keterangan</label>
                                                <input type="text"
                                                    class="form-control @error('keterangan') is-invalid @enderror"
                                                    name="keterangan" value="{{ old('keterangan') }}"
                                                    placeholder="Masukkan keterangan">
                                                <!-- error message untuk title -->
                                                @error('keterangan')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>User Created</label>
                                                <input type="text"
                                                    class="form-control @error('user_created') is-invalid @enderror"
                                                    name="user_created" value="{{ old('user_created') }}"
                                                    placeholder="Masukkan User Created">
                                                <!-- error message untuk title -->
                                                @error('user_created')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>User Updated</label>
                                                <input type="text"
                                                    class="form-control @error('user_updated') is-invalid @enderror"
                                                    name="user_updated" value="{{ old('user_updated') }}"
                                                    placeholder="Masukkan User Updated">
                                                <!-- error message untuk title -->
                                                @error('user_updated')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="modal-footer no-bd">
                                            <button type="submit" class="btn btn-primary">Add</button>
                                            <button type="button" class="btn btn-danger"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="add-row" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nomor Dokument</th>
                                <th class="text-center">Nomor BSTB</th>
                                <th class="text-center">Nomor Batch</th>
                                <th class="text-center">Keterangan</th>
                                <th class="text-center">User Created</th>
                                <th class="text-center">User Updated</th>
                                <th style="width: 10%" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <th class="text-center">No</th>
                            <th class="text-center">Nomor Dokument</th>
                            <th class="text-center">Nomor BSTB</th>
                            <th class="text-center">Nomor Batch</th>
                            <th class="text-center">Keterangan</th>
                            <th class="text-center">User Created</th>
                            <th class="text-center">User Updated</th>
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
                                    <td class="text-center">{!! $post->user_updated !!}</td>
                                    <td class="text-center">
                                        <div class="form-button-action">
                                            <form style="display: flex" onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('PrmRawMaterialOutputHeader.destroy', $post->id) }}"
                                                method="POST">
                                                <a href="{{ route('PrmRawMaterialOutputHeader.show', $post->id) }}"
                                                    class="btn btn-link btn-info" title="Show Task"
                                                    data-original-title="Show"><i class="fa fa-file"></i></a>
                                                <a href="{{ route('PrmRawMaterialOutputHeader.edit', $post->id) }}"
                                                    class="btn btn-link btn-primary" title="Edit Task"
                                                    data-original-title="Edit Task"><i class="fa fa-edit"></i></a>
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
                                    Data Biaya HPP belum Tersedia.
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
