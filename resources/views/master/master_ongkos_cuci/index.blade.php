@extends('layouts.master1')
{{-- @extends('layouts.template') --}}
@section('menu')
    Master
@endsection
@section('title')
    Master Ongkos Cuci
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
                                Data Master Ongkos Cuci
                                <button href="{{ route('MasterOngkosCuci.create') }}" type="button"
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
                                    <h4 class="modal-title white" id="myModalLabel33">Input Data Master Ongkos Cuci</h4>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                                <form action="{{ route('MasterOngkosCuci.store') }}" method="POST">
                                    <div class="modal-body">
                                        @csrf
                                        <label><strong>Unit</strong></label>
                                        <div class="form-group">
                                            <input type="text" name="unit" placeholder="Masukkan Unit"
                                                class="form-control @error('unit') is-invalid @enderror" required
                                                oninvalid="this.setCustomValidity('Mohon isi unit')"
                                                oninput="this.setCustomValidity('')">
                                        </div>
                                        <label><strong>Jenis Bulu</strong></label>
                                        <div class="form-group">
                                            <input type="text" name="jenis_bulu" placeholder="Masukan Jenis Bulu"
                                                class="form-control @error('jenis_bulu') is-invalid @enderror" required
                                                oninvalid="this.setCustomValidity('Mohon isi Jenis Bulu')"
                                                oninput="this.setCustomValidity('')">
                                            @error('jenis_bulu')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <label><strong>Biaya Per Gram</strong></label>
                                        <div class="form-group">
                                            <input type="text" name="biaya_per_gram" placeholder="Masukan Biaya Per Gram"
                                                class="form-control @error('biaya_per_gram') is-invalid @enderror" required
                                                oninvalid="this.setCustomValidity('Mohon isi Biaya Per Gram')"
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
                                        <th scope="col" class="text-center">Unit</th>
                                        <th scope="col" class="text-center">Jenis Bulu</th>
                                        <th scope="col" class="text-center">Biaya Per Gram</th>
                                        <th scope="col" class="text-center">Status</th>
                                        <th scope="col" class="text-center">User Created</th>
                                        <th scope="col" class="text-center">User Updated</th>
                                        <th scope="col" class="text-center">Tanggal Buat</th>
                                        <th scope="col" class="text-center">Tanggal Update</th>
                                        <th scope="col" class="text-center">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($MasterOngkosCuci as $MasterOC)
                                        <tr>
                                            <td class="text-center">{{ $i++ }}</td>
                                            <td class="text-center">{{ $MasterOC->unit }}</td>
                                            <td class="text-center">{{ $MasterOC->jenis_bulu }}</td>
                                            <td class="text-center">Rp
                                                {{ number_format($MasterOC->biaya_per_gram, 0, ',', '.') }}</td>
                                            <td class="text-center">
                                                @if ($MasterOC->status == 1)
                                                    Aktif
                                                @else
                                                    Tidak Aktif
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $MasterOC->user_created }}</td>
                                            <td class="text-center">{{ $MasterOC->user_updated }}</td>
                                            <td class="text-center">{{ $MasterOC->created_at }}</td>
                                            <td class="text-center">{{ $MasterOC->updated_at }}</td>
                                            <td class="text-center">
                                                <div class="form-button-action">
                                                    <form style="display: flex" id="deleteForm{{ $MasterOC->id }}"
                                                        action="{{ route('MasterOngkosCuci.destroy', $MasterOC->id) }}"
                                                        method="POST">
                                                        <a href="{{ route('MasterOngkosCuci.edit', $MasterOC->id) }}"
                                                            class="btn btn-link" title="Edit Task"
                                                            data-original-title="Edit Task">
                                                            <i class="bi bi-pencil-square text-success"></i>
                                                        </a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-link"
                                                            data-original-title="Remove"
                                                            onclick="confirmDelete({{ $MasterOC->id }})">
                                                            <i class="bi bi-trash3 text-danger"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <div class="alert alert-danger">
                                            Data Master Ongkos Cuci belum Tersedia.
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
