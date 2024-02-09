@extends('layouts.master1')
@section('Menu')
    Master
@endsection
@section('title')
    Biaya HPP
@endsection
@section('content')
    {{-- <div class="col-md-12"> --}}
    <div class="card">
        <div class="card-header">
            <div class="col-sm-12 d-flex justify-content-between">
                <h4 class="card-title">Data Biaya HPP</h4>
                <button type="button" class="btn btn-outline-success rounded-pill" data-bs-toggle="modal"
                    data-bs-target="#inlineForm">
                    {{-- <strong><i class="bi bi-plus-circle"></i></strong> --}}
                    Add Data
                </button>
            </div>
        </div>
        <div class="card-body" style="overflow: auto;">
            {{-- Create Data --}}
            <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel33">
                                <span class="fw-mediumbold">
                                    Input</span>
                                <span class="fw-light">
                                    Data Biaya Hpp
                                </span>
                            </h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('BiayaHpp.store') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Pilih Unit ID:</label>
                                            <select id="unit_id" class="choices form-select" name="unit_id"
                                                data-placeholder="Pilih Id Box">
                                                <option></option>
                                                @foreach ($unit as $post)
                                                    <option value="{{ $post->id }}">
                                                        {{ $post->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                    <div class="col-md-6 pr-0">
                                        <div class="form-group form-group-default">
                                            <label>Jenis Biaya</label>
                                            <input id="addPosition" type="number"
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
                                            <input id="addOffice" type="number"
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
                            </div>
                            <div class="modal-footer no-bd">
                                <button type="submit" class="btn btn-primary">Add</button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table id="table1" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Unit</th>
                            <th class="text-center">Jenis Biaya</th>
                            <th class="text-center">Biaya PerGram</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Tgl Buat</th>
                            <th class="text-center">Tgl Update</th>
                            <th style="width: 10%" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($biaya as $post)
                            <tr>
                                <td class="text-center">{{ $i++ }}</td>

                                <td class="text-center">{{ $post->unit->nama }}</td>

                                <td class="text-center">{!! $post->jenis_biaya !!}</td>
                                <td class="text-center">{!! $post->biaya_per_gram !!}</td>
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
                                    <div class="form-button-action">
                                        <form style="display: flex" id="deleteForm{{ $post->id }}"
                                            action="{{ route('BiayaHpp.destroy', $post->id) }}" method="POST">
                                            <a href="{{ route('BiayaHpp.show', $post->id) }}" class="btn btn-link btn-info"
                                                title="Show Task" data-original-title="Show"><i
                                                    class="bi bi-file-earmark"></i></a>
                                            <a href="{{ route('BiayaHpp.edit', $post->id) }}"
                                                class="btn btn-link btn-primary" title="Edit Task"
                                                data-original-title="Edit Task"><i class="bi bi-pencil-square"></i></a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" data-toggle="tooltip"
                                                class="btn btn-link btn-danger text-danger" data-original-title="Remove"
                                                onclick="confirmDelete({{ $post->id }})"><i
                                                    class="bi bi-trash3"></i></button>
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
    {{-- </div> --}}
@endsection
@section('script')
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Anda yakin ingin menghapus data ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika dikonfirmasi, submit form
                    document.getElementById('deleteForm' + id).submit();
                }
            });
        }
    </script>
@endsection
