@extends('layouts.master1')
@section('Menu')
    Master
@endsection
@section('title')
    Workstation
@endsection
@section('content')
    {{-- <section class="section"> --}}
    <div class="card">
        <div class="card-header">

            <div class="col-sm-12 d-flex justify-content-between">
                <h3 class="card-title">Data Workstation</h3>
                <button type="button" class="btn btn-outline-success rounded-pill" data-bs-toggle="modal"
                    data-bs-target="#inlineForm">
                    <i class="fa fa-plus"></i>
                    Add Data
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel33">
                                <span class="fw-mediumbold">
                                    Input</span>
                                <span class="fw-light">
                                    Workstation
                                </span>
                            </h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('workstation.store') }}" method="POST">
                            @csrf
                            <div class="modal-body">
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
                            </div>
                            <div class="modal-footer">
                                <button id="myButton" type="submit" class="btn btn-primary">Add</button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <div class="table-responsive">
                <table id="table1" class="table">
                    <thead>
                        <tr>
                            <th class="text-center" scope="col">ID</th>
                            <th class="text-center" scope="col">Nama</th>
                            <th class="text-center" scope="col">Status</th>
                            <th class="text-center" scope="col">Tgl Buat</th>
                            <th class="text-center" scope="col">Tgl Update</th>
                            <th class="text-center" scope="col">Action</th>
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
                                    <div class="form-button-action">
                                        <form style="display: flex" id="deleteForm{{ $post->id }}"
                                            action="{{ route('workstation.destroy', $post->id) }}" method="POST">
                                            <a href="{{ route('workstation.show', $post->id) }}"
                                                class="btn btn-link btn-info" title="Show Task"
                                                data-original-title="Show"><i class="bi bi-file-earmark"></i></a>
                                            <a href="{{ route('workstation.edit', $post->id) }}" class="btn btn-link"
                                                title="Edit Task" data-original-title="Edit Task">
                                                <i class="bi bi-pencil-square text-success"></i>
                                            </a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-link btn-danger"
                                                data-original-title="Remove" onclick="confirmDelete({{ $post->id }})">
                                                <i class="bi bi-trash3 text-danger"></i>
                                            </button>

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
        </div>
    </div>
    {{-- </section> --}}
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
