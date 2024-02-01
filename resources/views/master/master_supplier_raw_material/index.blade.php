@extends('layouts.master1')
{{-- @extends('layouts.template') --}}
@section('menu')
    Master
@endsection
@section('title')
    Master Supplier Raw Material
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
                                Data Master Supplier Raw Material
                                <button href="{{ route('master_supplier_raw_material.create') }}" type="button"
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
                                    <h4 class="modal-title white" id="myModalLabel33">Input Data Master Supplier</h4>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                                <form action="{{ route('master_supplier_raw_material.store') }}" method="POST">
                                    <div class="modal-body">
                                        @csrf
                                        <label><strong>Nama Supplier</strong></label>
                                        <div class="form-group">
                                            <input type="text" name="nama_supplier" placeholder="Masukkan Nama Supplier"
                                                class="form-control @error('nama_supplier') is-invalid @enderror" required
                                                oninvalid="this.setCustomValidity('Mohon isi Nama Supplier')"
                                                oninput="this.setCustomValidity('')">
                                        </div>
                                        <label><strong>Inisial Supplier</strong></label>
                                        <div class="form-group">
                                            <input type="text" name="inisial_supplier"
                                                placeholder="Masukan Inisial Supplier"
                                                class="form-control @error('inisial_supplier') is-invalid @enderror"
                                                required oninvalid="this.setCustomValidity('Mohon isi Inisial Supplier')"
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
                    <!-- Modal Edit Post -->
                    <div class="modal fade" id="editPostModal" tabindex="-1" role="dialog"
                        aria-labelledby="editPostModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h4 class="modal-title white" id="editPostModalLabel">Edit Data Master Supplier</h4>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                                <form id="editForm" method="POST" action="">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <label><strong>Nama Supplier</strong></label>
                                        <div class="form-group">
                                            <input type="text" id="editNamaSupplier" name="nama_supplier"
                                                class="form-control @error('nama_supplier') is-invalid @enderror">
                                        </div>
                                        {{--  --}}
                                        {{-- <label class="font-weight-bold">Nama Supplier</label>
                                        <input type="text"
                                            class="form-control @error('nama_supplier') is-invalid @enderror"
                                            name="nama_supplier"
                                            value="{{ old('nama_supplier', $MasterSupplierRawMaterial->nama_supplier) }}"> --}}
                                        {{--  --}}
                                        <label><strong>Inisial Supplier</strong></label>
                                        <div class="form-group">
                                            <input type="text" id="editInisialSupplier" name="inisial_supplier"
                                                class="form-control @error('inisial_supplier') is-invalid @enderror">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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
                                        <th scope="col" class="text-center">Nama Supplier</th>
                                        <th scope="col" class="text-center">Inisial supplier</th>
                                        <th scope="col" class="text-center">Status</th>
                                        <th scope="col" class="text-center">Tanggal Buat</th>
                                        <th scope="col" class="text-center">Tanggal Update</th>
                                        <th scope="col" class="text-center">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($MasterSupplierRawMaterial as $MasterSPR)
                                        <tr>
                                            <td class="text-center">{{ $i++ }}</td>
                                            <td class="text-center">{{ $MasterSPR->nama_supplier }}</td>
                                            <td class="text-center">{{ $MasterSPR->inisial_supplier }}</td>
                                            <td class="text-center">
                                                @if ($MasterSPR->status == 1)
                                                    Aktif
                                                @else
                                                    Tidak Aktif
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $MasterSPR->created_at }}</td>
                                            <td class="text-center">{{ $MasterSPR->updated_at }}</td>
                                            <td class="text-center">
                                                <div class="form-button-action">
                                                    <form style="display: flex" id="deleteForm{{ $MasterSPR->id }}"
                                                        action="{{ route('master_supplier_raw_material.destroy', $MasterSPR->id) }}"
                                                        method="POST">
                                                        <a href="{{ route('master_supplier_raw_material.edit', $MasterSPR->id) }}"
                                                            class="btn btn-link" title="Edit Task"
                                                            data-original-title="Edit Task">
                                                            <i class="bi bi-pencil-square text-success"></i>
                                                        </a>
                                                        {{-- <a href="#" class="btn btn-link edit-button"
                                                            title="Edit Task" data-original-title="Edit Task"
                                                            onclick="editSupplier({{ $MasterSPR->id }})">
                                                            <i class="bi bi-pencil-square text-warning"></i>
                                                        </a> --}}
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-link"
                                                            data-original-title="Remove"
                                                            onclick="confirmDelete({{ $MasterSPR->id }})">
                                                            <i class="bi bi-trash3 text-danger"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <div class="alert alert-danger">
                                            Data Master Supplier Raw Material belum Tersedia.
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
@section('script')
    <script>
        function editSupplier(id) {
            $.get(`/master_supplier_raw_material/edit/${id}`, function(data) {
                $('#editNamaSupplier').val(data.nama_supplier);
                $('#editInisialSupplier').val(data.inisial_supplier);
                $('#editForm').attr('action', `/master_supplier_raw_material/edit/${id}`);
                $('#editPostModal').modal('show');
            });
        }

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
@endsection
