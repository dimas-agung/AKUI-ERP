@extends('layouts.master1')
@section('title')
    Workstation
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Data Workstation</h4>
                    <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
                        <i class="fa fa-plus"></i>
                        Add Data
                    </button>
                </div>
            </div>
            <div class="card-body">
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
                {{-- <a href="{{ route('workstation.create') }}" class="btn btn-md btn-success mb-3">TAMBAH POST</a> --}}
                <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header no-bd">
                                <h5 class="modal-title">
                                    <span class="fw-mediumbold">
                                        Input</span>
                                    <span class="fw-light">
                                        Workstation
                                    </span>
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p class="small">Create a new unit using this form, make sure you fill them all</p>
                                <form action="{{ route('workstation.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group form-group-default">
                                                <label>Nama</label>
                                                <input id="addPosition" type="text"
                                                    class="form-control @error('nama') is-invalid @enderror" name="nama"
                                                    value="{{ old('nama') }}" placeholder="Masukkan Nama">

                                                <!-- error message untuk title -->
                                                @error('nama')
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
                                <th class="text-center" scope="col">ID</th>
                                <th class="text-center" scope="col">Nama</th>
                                <th class="text-center" scope="col">Status</th>
                                <th class="text-center" scope="col">Tgl Buat</th>
                                <th class="text-center" scope="col">Tgl Update</th>
                                <th class="text-center" scope="col">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($workstation as $post)
                                <tr>
                                    <td class="text-center">{{ $i++ }}</td>
                                    <td class="text-center">{!! $post->nama !!}</td>
                                    {{-- <td class="text-center">{!! $post->status !!}</td> --}}
                                    <td>
                                        @if ($post->status == 1)
                                            Aktif
                                        @else
                                            Tidak Aktif
                                        @endif
                                    </td>
                                    <td class="text-center">{!! $post->created_at !!}</td>
                                    <td class="text-center">{!! $post->updated_at !!}</td>
                                    <td class="text-center">
                                        {{-- <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                            action="{{ route('workstation.destroy', $post->id) }}" method="POST">
                                            <a href="{{ route('workstation.show', $post->id) }}"
                                                class="btn btn-sm btn-dark">SHOW</a>
                                            <a href="{{ route('workstation.edit', $post->id) }}"
                                                class="btn btn-sm btn-primary">EDIT</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                        </form> --}}
                                        <div class="form-button-action">
                                            <form style="display: flex" onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('workstation.destroy', $post->id) }}" method="POST">
                                                <a href="{{ route('workstation.show', $post->id) }}"
                                                    class="btn btn-link btn-info" title="Show Task"
                                                    data-original-title="Show"><i class="fa fa-file"></i></a>
                                                <a href="{{ route('workstation.edit', $post->id) }}"
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
                                    Data Workstation belum Tersedia.
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{-- {{ $posts->links() }} --}}
            </div>
        </div>
    </div>
@endsection
