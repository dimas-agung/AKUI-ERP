@extends('layouts.master1')
@section('menu')
    Master
@endsection
@section('title')
    Master Tujuan Kirim Waste
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card border border-primary border-3 mt-2">
            <div class="card-body">
                <div class="card">
                    {{-- card header --}}
                    <div class="card-header">
                        <h5 class="card-title">
                            <div class="col-sm-12 d-flex justify-content-between">
                                Data Master Tujuan Kirim Waste
                                <button href="{{ route('MasterTujuanKirimWaste.store') }}" type="button"
                                    class="btn btn-outline-success rounded-pill" data-bs-toggle="modal"
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
                                    <h4 class="modal-title white" id="myModalLabel33">Input Data Master Tujuan Kirim</h4>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                                <form action="{{ route('MasterTujuanKirimWaste.store') }}" method="POST">
                                    <div class="modal-body">
                                        @csrf
                                        <label><strong>Tujuan Kirim</strong></label>
                                        <div class="form-group">
                                            <input type="text" name="tujuan_kirim" placeholder="Masukkan Tujuan Kirim"
                                                class="form-control @error('tujuan_kirim') is-invalid @enderror"
                                                value="{{ old('tujuan_kirim') }}">
                                        </div>
                                        <label><strong>Letak Tujuan</strong></label>
                                        <div class="form-group">
                                            <input type="text" name="letak_tujuan" placeholder="Masukan Letak Tujuan"
                                                class="form-control @error('letak_tujuan') is-invalid @enderror"
                                                value="{{ old('letak_tujuan') }}">
                                        </div>
                                        <label><strong>Inisial Tujuan</strong></label>
                                        <div class="form-group">
                                            <input type="text" name="inisial_tujuan" placeholder="Masukan Inisial Tujuan"
                                                class="form-control @error('inisial_tujuan') is-invalid @enderror"
                                                value="{{ old('inisial_tujuan') }}">
                                            <!-- error message -->
                                            @error('inisial_tujuan')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <label><strong>Nip Admin</strong></label>
                                        <div class="form-group">
                                            <input type="text" name="user_created" placeholder="Masukkan NIP Admin"
                                                class="form-control @error('user_created') is-invalid @enderror" required
                                                oninvalid="this.setCustomValidity('Mohon isi NIP Admin')"
                                                oninput="this.setCustomValidity('')" value="{{ auth()->user()->nip }}"
                                                readonly>
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
                                        <th scope="col" class="text-center">Tujuan Kirim</th>
                                        <th scope="col" class="text-center">Letak Tujuan</th>
                                        <th scope="col" class="text-center">Inisial Kirim</th>
                                        <th scope="col" class="text-center">Status</th>
                                        <th scope="col" class="text-center">User Created</th>
                                        <th scope="col" class="text-center">User Updated</th>
                                        <th scope="col" class="text-center">Tanggal Buat</th>
                                        <th scope="col" class="text-center">Tanggal Update</th>
                                        <th scope="col" class="text-center">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($master_tujuan_kirim_waste as $item)
                                        <tr>
                                            <td class="text-center">{{ $i++ }}</td>
                                            <td class="text-center">{{ $item->tujuan_kirim }}</td>
                                            <td class="text-center">{{ $item->letak_tujuan }}</td>
                                            <td class="text-center">{{ $item->inisial_tujuan }}</td>
                                            <td class="text-center">
                                                @if ($item->status == 1)
                                                    Aktif
                                                @else
                                                    Tidak Aktif
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $item->user_created }}</td>
                                            <td class="text-center">{{ $item->user_updated }}</td>
                                            <td class="text-center">{{ $item->created_at }}</td>
                                            <td class="text-center">
                                                {{ $item->created_at != $item->updated_at ? $item->updated_at : '' }}
                                            </td>
                                            <td class="text-center">
                                                <div class="form-button-action">
                                                    <form style="display: flex" id="deleteForm{{ $item->id }}"
                                                        action="{{ route('MasterTujuanKirimWaste.destroy', $item->id) }}"
                                                        method="POST">
                                                        <a href="{{ route('MasterTujuanKirimWaste.edit', $item->id) }}"
                                                            class="btn btn-link" title="Edit Task"
                                                            data-original-title="Edit Task">
                                                            <i class="bi bi-pencil-square text-success"></i>
                                                        </a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-link"
                                                            data-original-title="Remove"
                                                            onclick="confirmDelete({{ $item->id }})">
                                                            <i class="bi bi-trash3 text-danger"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <div class="alert alert-danger">
                                            Data Master Tujuan Kirim Waste belum Tersedia.
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
