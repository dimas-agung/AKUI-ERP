@extends('layouts.master1')
@section('menu')
    Master
@endsection
@section('title')
    Master Jenis Grading Halus
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card mt-2 border border-primary border-3">
            <div class="card-body">
                <div class="card">
                    {{-- card header --}}
                    <div class="card-header">
                        <h5 class="card-title">
                            <div class="col-sm-12 d-flex justify-content-between">
                                Data Master Jenis Grading Halus
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
                                    <h4 class="modal-title white" id="myModalLabel33">Input Data Master Jenis Grading Halus
                                    </h4>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                                <form action="{{ route('MasterJenisGradingHalus.store') }}" method="POST">
                                    <div class="modal-body">
                                        @csrf
                                        <label><strong>Jenis</strong></label>
                                        <div class="form-group">
                                            <input type="text" name="jenis" placeholder="Masukkan jenis"
                                                class="form-control @error('jenis') is-invalid @enderror" required
                                                oninvalid="this.setCustomValidity('Mohon isi jenis')"
                                                oninput="this.setCustomValidity('')">
                                        </div>
                                        <label><strong>Kategori Susut</strong></label>
                                        <div class="form-group">
                                            <input type="text" name="kategori_susut"
                                                placeholder="Masukkan Kategori Susut"
                                                class="form-control @error('kategori_susut') is-invalid @enderror">
                                        </div>
                                        <label><strong>Upah Operator</strong></label>
                                        <div class="form-group">
                                            <input type="text" pattern="[0-9.]*" inputmode="numeric"
                                                onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                                                name="upah_operator" placeholder="Masukkan Upah Operator"
                                                class="form-control @error('upah_operator')
is-invalid
@enderror">
                                        </div>
                                        <label><strong>Pengurangan Harga</strong></label>
                                        <div class="form-group">
                                            <input type="text" pattern="[0-9.]*" inputmode="numeric"
                                                onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                                                name="pengurangan_harga" placeholder="Masukkan Pengurangan Harga"
                                                class="form-control @error('pengurangan_harga')
is-invalid
@enderror">
                                        </div>
                                        <label><strong>Harga Estimasi</strong></label>
                                        <div class="form-group">
                                            <input type="text" pattern="[0-9.]*" inputmode="numeric"
                                                onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                                                name="harga_estimasi" placeholder="Masukkan Harga Estimasi"
                                                class="form-control @error('harga_estimasi')
is-invalid
@enderror" required
                                                oninvalid="this.setCustomValidity('Mohon isi Harga Estimasi')"
                                                oninput="this.setCustomValidity('')">
                                        </div>
                                        <label><strong>Nip Admin</strong></label>
                                        <div class="form-group">
                                            <input type="text" name="user_created" placeholder="Masukkan NIP Admin"
                                                class="form-control @error('user_created') is-invalid @enderror" required
                                                oninvalid="this.setCustomValidity('Mohon isi NIP Admin')"
                                                oninput="this.setCustomValidity('')">
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
                                        <th scope="col" class="text-center">Jenis</th>
                                        <th scope="col" class="text-center">Katergori Susut</th>
                                        <th scope="col" class="text-center">Upah Operator</th>
                                        <th scope="col" class="text-center">Pengurangan Harga</th>
                                        <th scope="col" class="text-center">Estimasi Harga</th>
                                        <th scope="col" class="text-center">Status</th>
                                        <th scope="col" class="text-center">User Created</th>
                                        <th scope="col" class="text-center">User Updated</th>
                                        <th scope="col" class="text-center">Tanggal Buat</th>
                                        <th scope="col" class="text-center">Tanggal Update</th>
                                        <th scope="col" class="text-center">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($master_jenis_grading_halus as $MasterJGK)
                                        <tr>
                                            <td class="text-center">{{ $i++ }}</td>
                                            <td class="text-center">{{ $MasterJGK->jenis }}</td>
                                            <td class="text-center">{{ $MasterJGK->kategori_susut }}</td>
                                            <td class="text-center">
                                                {{ number_format($MasterJGK->upah_operator, 0, ',', '.') }}</td>
                                            <td class="text-center">
                                                @if ($MasterJGK->pengurangan_harga == '')
                                                @else
                                                    {{ $MasterJGK->pengurangan_harga }} %
                                                @endif
                                            </td>
                                            {{-- <td>{{ $MasterJGK->pengurangan_harga }}</td> --}}
                                            <td class="text-center">
                                                {{ number_format($MasterJGK->harga_estimasi, 0, ',', '.') }}</td>
                                            <td class="text-center">
                                                @if ($MasterJGK->status == 1)
                                                    Aktif
                                                @else
                                                    Tidak Aktif
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $MasterJGK->user_created }}</td>
                                            <td class="text-center">{{ $MasterJGK->user_updated }}</td>
                                            <td class="text-center">{{ $MasterJGK->created_at }}</td>
                                            <td class="text-center">{{ $MasterJGK->updated_at }}</td>
                                            <td class="text-center">
                                                <div class="form-button-action">
                                                    <form style="display: flex" id="deleteForm{{ $MasterJGK->id }}"
                                                        action="{{ route('MasterJenisGradingHalus.destroy', $MasterJGK->id) }}"
                                                        method="POST">
                                                        <a href="{{ route('MasterJenisGradingHalus.edit', $MasterJGK->id) }}"
                                                            class="btn btn-link" title="Edit Task"
                                                            data-original-title="Edit Task">
                                                            <i class="bi bi-pencil-square text-success"></i>
                                                        </a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-link"
                                                            data-original-title="Remove"
                                                            onclick="confirmDelete({{ $MasterJGK->id }})">
                                                            <i class="bi bi-trash3 text-danger"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <div class="alert alert-danger">
                                            Data Master Jenis Grading Halus belum Tersedia.
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
