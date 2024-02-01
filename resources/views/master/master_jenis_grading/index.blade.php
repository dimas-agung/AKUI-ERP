@extends('layouts.master1')
{{-- @extends('layouts.template') --}}
@section('menu')
    Master
@endsection
@section('title')
    Master Jenis Grading
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card mt-2">
            <div class="card-body">
                <div class="card">
                    {{-- card header --}}
                    <div class="card-header">
                        <h5 class="card-title">
                            <div class="col-sm-12 d-flex justify-content-between">
                                Data Master Jenis Grading
                                <button type="button" class="btn btn-outline-success rounded-pill" data-bs-toggle="modal"
                                    data-bs-target="#inlineForm">
                                    <strong><i class="bi bi-plus-circle"></i> Add Data <i
                                            class="bi bi-plus-circle"></i></strong>
                                </button>
                            </div>
                        </h5>
                    </div>
                    {{-- Modal Tambah --}}
                    <div class="modal fade text-left modal-borderless" id="inlineForm" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel33" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h4 class="modal-title white" id="myModalLabel33">Input Data Master Jenis Grading</h4>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                                <form action="{{ route('master_jenis_grading.store') }}" method="POST">
                                    <div class="modal-body">
                                        @csrf
                                        <label><strong>Nama</strong></label>
                                        <div class="form-group">
                                            <input type="text" name="nama" placeholder="Masukkan Nama"
                                                class="form-control @error('nama') is-invalid @enderror">
                                        </div>
                                        <label><strong>Pilih Unit ID</strong></label>
                                        <select id="unit_id" class="choices form-select" name="unit_id"
                                            data-placeholder="Pilih Id Box">
                                            <option></option>
                                            @foreach ($unit as $MasterJGD)
                                                <option value="{{ $MasterJGD->id }}">
                                                    {{ $MasterJGD->nama }}</option>
                                            @endforeach
                                        </select>
                                        <label><strong>Nip Admin</strong></label>
                                        <div class="form-group">
                                            <input type="text" name="user_created" placeholder="Masukkan NIP Admin"
                                                class="form-control @error('user_created') is-invalid @enderror">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                            <i class="bx bx-x d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Batal</span>
                                        </button>
                                        <button type="submit" id="toast-success" class="btn btn-primary ms-1">
                                            <span id="toast-success" class="d-none d-sm-block">Tambah</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- card body --}}
                    <div class="card-body" style="overflow: auto;">
                        <div class="table-responsive">
                            <table id="table1" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">No</th>
                                        <th scope="col" class="text-center">Nama</th>
                                        <th scope="col" class="text-center">Unit ID</th>
                                        <th scope="col" class="text-center">Status</th>
                                        <th scope="col" class="text-center">User Created</th>
                                        <th scope="col" class="text-center">User Updated</th>
                                        <th scope="col" class="text-center">Tanggal Buat</th>
                                        <th scope="col" class="text-center">Tanggal Update</th>
                                        <th scope="col" class="text-center">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($master_jenis_gradings as $MasterJGD)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $MasterJGD->nama }}</td>
                                            <td>{{ $MasterJGD->unit->nama }}</td>
                                            <td>
                                                @if ($MasterJGD->status == 1)
                                                    Aktif
                                                @else
                                                    Tidak Aktif
                                                @endif
                                            </td>
                                            <td>{{ $MasterJGD->user_created }}</td>
                                            <td>{{ $MasterJGD->user_updated }}</td>
                                            <td>{{ $MasterJGD->created_at }}</td>
                                            <td>{{ $MasterJGD->updated_at }}</td>
                                            <td class="text-center">
                                                <div class="form-button-action">
                                                    <form style="display: flex" id="deleteForm{{ $MasterJGD->id }}"
                                                        action="{{ route('master_jenis_grading.destroy', $MasterJGD->id) }}"
                                                        method="POST">
                                                        <a href="{{ route('master_jenis_grading.edit', $MasterJGD->id) }}"
                                                            class="btn btn-link" title="Edit Task"
                                                            data-original-title="Edit Task">
                                                            <i class="bi bi-pencil-square text-success"></i>
                                                        </a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-link"
                                                            data-original-title="Remove"
                                                            onclick="confirmDelete({{ $MasterJGD->id }})">
                                                            <i class="bi bi-trash3 text-danger"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <div class="alert alert-danger">
                                            Data Master Jenis Grading belum Tersedia.
                                        </div>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Anda yakin ingin menghapus data ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d61609',
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
