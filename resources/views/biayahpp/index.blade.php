@extends('layout.admin')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Data Biaya HPP AKUI-ERP</h4>
                    <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
                        <i class="fa fa-plus"></i>
                        {{-- <a href="{{ route('biaya.create') }}" class="text-light">TAMBAH POST</a> --}}
                        Add Data
                    </button>
                </div>
            </div>
            <div class="card-body">
                {{-- Create Data --}}
                <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header no-bd">
                                <h5 class="modal-title">
                                    <span class="fw-mediumbold">
                                        Input</span>
                                    <span class="fw-light">
                                        Data Biaya Hpp
                                    </span>
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p class="small">Create a new row using this form, make sure you fill them all</p>
                                <form action="{{ route('biaya.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group form-group-default">
                                                <label>Unit ID</label>
                                                <input id="addName" type="text"
                                                    class="form-control @error('unit_id') is-invalid @enderror"
                                                    name="unit_id" value="{{ old('unit_id') }}"
                                                    placeholder="Masukkan Unit ID">

                                                <!-- error message untuk title -->
                                                @error('unit_id')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 pr-0">
                                            <div class="form-group form-group-default">
                                                <label>Jenis Biaya</label>
                                                <input id="addPosition" type="text"
                                                    class="form-control @error('jenis_biaya') is-invalid @enderror"
                                                    name="jenis_biaya" value="{{ old('jenis_biaya') }}"
                                                    placeholder="Masukkan Jenis Biaya">

                                                <!-- error message untuk title -->
                                                @error('jenis_biaya')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-group-default">
                                                <label>Biaya PerGram</label>
                                                <input id="addOffice" type="text"
                                                    class="form-control @error('biaya_per_gram') is-invalid @enderror"
                                                    name="biaya_per_gram" value="{{ old('biaya_per_gram') }}"
                                                    placeholder="Masukkan Biaya PerGram">

                                                <!-- error message untuk title -->
                                                @error('biaya_per_gram')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer no-bd">
                                        <button type="submit" class="btn btn-primary">Add</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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
                                <th class="text-center">ID</th>
                                <th class="text-center">Jenis Biaya</th>
                                <th class="text-center">Biaya PerGram</th>
                                <th class="text-center">Unit ID</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Tgl Buat</th>
                                <th class="text-center">Tgl Update</th>
                                <th style="width: 10%" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <th>ID</th>
                            <th>Jenis Biaya</th>
                            <th>Biaya PerGram</th>
                            <th>Unit ID</th>
                            <th>Status</th>
                            <th>Tgl Buat</th>
                            <th>Tgl Update</th>
                            <th>Action</th>
                        </tfoot>
                        <tbody>
                            @forelse ($biaya as $post)
                                <tr>
                                    <td class="text-center">{{ $post->id }}</td>
                                    <td class="text-center">{!! $post->jenis_biaya !!}</td>
                                    <td class="text-center">{!! $post->biaya_per_gram !!}</td>
                                    <td class="text-center">{!! $post->unit_id !!}</td>
                                    <td class="text-center">{!! $post->status !!}</td>
                                    <td class="text-center">{!! $post->created_at !!}</td>
                                    <td class="text-center">{!! $post->updated_at !!}</td>
                                    <td class="text-center">
                                        <div class="form-button-action">
                                            <form style="display: flex" onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('biaya.destroy', $post->id) }}" method="POST">
                                                <a href="{{ route('biaya.edit', $post->id) }}"
                                                    class="btn btn-link btn-primary" title="Edit Task"
                                                    data-original-title="Edit Task"><i class="fa fa-edit"></i></a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" data-toggle="tooltip" class="btn btn-link btn-danger"
                                                    data-original-title="Remove"><i class="fa fa-times"></i></button>
                                            </form>
                                        </div>
                                        {{-- <div class="form-button-action">
                                            <button type="button" data-toggle="modal" title=""
                                                class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"
                                                data-target="#UpModal">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button type="button" data-toggle="tooltip" title=""
                                                class="btn btn-link btn-danger" data-original-title="Remove">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </div> --}}
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
                {{-- Update Data --}}
                {{-- <div class="modal fade" id="UpModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header no-bd">
                                <h5 class="modal-title">
                                    <span class="fw-mediumbold">
                                        Update</span>
                                    <span class="fw-light">
                                        Data Biaya Hpp
                                    </span>
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p class="small">Create a new row using this form, make sure you fill them all</p>
                                <form action="{{ route('biaya.update') }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group form-group-default">
                                                <label>Unit ID</label>
                                                <input id="addName" type="text"
                                                    class="form-control @error('unit_id') is-invalid @enderror"
                                                    name="unit_id" value="{{ old('unit_id', $biaya->unit_id) }}"
                                                    placeholder="Masukkan Unit ID">

                                                <!-- error message untuk title -->
                                                @error('unit_id')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 pr-0">
                                            <div class="form-group form-group-default">
                                                <label>Jenis Biaya</label>
                                                <input id="addPosition" type="text"
                                                    class="form-control @error('jenis_biaya') is-invalid @enderror"
                                                    name="jenis_biaya"
                                                    value="{{ old('jenis_biaya', $biaya->jenis_biaya) }}"
                                                    placeholder="Masukkan Jenis Biaya">

                                                <!-- error message untuk title -->
                                                @error('jenis_biaya')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-group-default">
                                                <label>Biaya PerGram</label>
                                                <input id="addOffice" type="text"
                                                    class="form-control @error('biaya_per_gram') is-invalid @enderror"
                                                    name="biaya_per_gram"
                                                    value="{{ old('biaya_per_gram', $biaya->biaya_per_gram) }}"
                                                    placeholder="Masukkan Biaya PerGram">

                                                <!-- error message untuk title -->
                                                @error('biaya_per_gram')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer no-bd">
                                        <button type="submit" class="btn btn-primary">Add</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
@endsection
