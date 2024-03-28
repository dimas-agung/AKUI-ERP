@extends('layouts.master1')
{{-- @extends('layouts.template') --}}
@section('menu')
    Purchasing & EXIM
@endsection
@section('title')
    Purchasing Raw Material Input
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card mt-2 border border-primary border-3">
            <div class="card-body">
                <div class="card">
                    {{-- card header --}}
                    <div class="card-header">
                        <h5 class="card-title">
                            <div class="col-sm-12">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>Data Purchasing Raw Material Input</span>
                                    <div>
                                        {{-- <form action="{{ route('PrmRawMaterialInput.importExcel') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input type="file" id="upload-file" name="file"
                                                accept="application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
                                                hidden />
                                            <label class="btn btn-outline-primary rounded-pill" for="upload-file"><strong><i
                                                        class="bi bi-eye"></i> Import Excel</strong></label>
                                            <button type="submit">Import</button>
                                        </form> --}}

                                        <button type="button" class="btn btn-outline-primary rounded-pill"
                                            data-bs-toggle="modal" data-bs-target="#import">
                                            <strong>
                                                <i class="bi bi-file-earmark-excel"></i>
                                                Import Excel
                                            </strong>
                                        </button>
                                        <div class="modal fade text-left" id="import" tabindex="-1" role="dialog"
                                            aria-labelledby="myModalLabel160" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-success">
                                                        <h5 class="modal-title white" id="myModalLabel160">Import Form Excel
                                                        </h5>
                                                        <button type="button" class="close" data-bs-dismiss="modal"
                                                            aria-label="Close">
                                                            <i data-feather="x"></i>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('PrmRawMaterialInput.importExcel') }}"
                                                            method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <input class="form-control" type="file" id="upload-file"
                                                                name="file"
                                                                accept="application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" />
                                                            {{-- <input type="file" id="upload-file" name="file"
                                                                accept="application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" /> --}}
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger"
                                                                    data-bs-dismiss="modal">
                                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                                    <span class="d-none d-sm-block">Close</span>
                                                                </button>
                                                                <button type="submit" class="btn btn-success ms-1">
                                                                    <i class="bx bx-check d-block d-sm-none"></i>
                                                                    <span class="d-none d-sm-block">Import</span>
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <button onclick="redirectToPage('detail')" type="button"
                                            class="btn btn-outline-warning rounded-pill"><strong><i class="bi bi-eye"></i>
                                                Detail Data </strong></button>
                                        <button onclick="redirectToPage('create')" type="button"
                                            class="btn btn-outline-success rounded-pill"><strong><i
                                                    class="bi bi-plus-circle"></i> Add Data <i
                                                    class="bi bi-plus-circle"></i></strong></button>
                                    </div>
                                </div>
                            </div>


                        </h5>
                    </div>
                    {{-- card body --}}
                    <div class="card-body" style="overflow: auto;">
                        <div class="table-responsive">
                            <table id="table1" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">No</th>
                                        <th scope="col" class="text-center">No Doc</th>
                                        <th scope="col" class="text-center">Nomor PO</th>
                                        <th scope="col" class="text-center">Nomor Batch</th>
                                        <th scope="col" class="text-center">Nomor Nota Supplier</th>
                                        <th scope="col" class="text-center">Nomor Nota Internal</th>
                                        <th scope="col" class="text-center">Nama Supplier</th>
                                        <th scope="col" class="text-center">Keterangan</th>
                                        <th scope="col" class="text-center">User Created</th>
                                        <th scope="col" class="text-center">User Updated</th>
                                        <th scope="col" class="text-center">Created At</th>
                                        <th scope="col" class="text-center">Updated At</th>
                                        <th scope="col" class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($prm_raw_material_inputs as $MasterPRIM)
                                        <tr>
                                            <td class="text-center">{{ $i++ }}</td>
                                            <td class="text-center">{{ $MasterPRIM->doc_no }}</td>
                                            <td class="text-center">{{ $MasterPRIM->nomor_po }}</td>
                                            <td class="text-center">{{ $MasterPRIM->nomor_batch }}</td>
                                            <td class="text-center">{{ $MasterPRIM->nomor_nota_supplier }}</td>
                                            <td class="text-center">{{ $MasterPRIM->nomor_nota_internal }}</td>
                                            <td class="text-center">{{ $MasterPRIM->nama_supplier }}</td>
                                            <td class="text-center">{{ $MasterPRIM->keterangan }}</td>
                                            <td class="text-center">{{ $MasterPRIM->user_created }}</td>
                                            <td class="text-center">{{ $MasterPRIM->user_updated }}</td>
                                            <td class="text-center">{{ $MasterPRIM->created_at }}</td>
                                            <td class="text-center">
                                                {{ $MasterPRIM->created_at != $MasterPRIM->updated_at ? $MasterPRIM->updated_at : '' }}
                                            </td>

                                            <td class="text-center">
                                                <div class="form-button-action">
                                                    <form style="display: flex" id="deleteForm{{ $MasterPRIM->id }}"
                                                        action="{{ route('PrmRawMaterialInput.destroyInput', $MasterPRIM->id) }}"
                                                        method="POST">
                                                        <a href="{{ route('PrmRawMaterialInput.show', $MasterPRIM->id) }}"
                                                            class="btn btn-link" title="View"
                                                            data-original-title="View">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-link"
                                                            data-original-title="Remove"
                                                            onclick="confirmDelete({{ $MasterPRIM->id }})">
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
<script>
    function redirectToPage(pageType) {
        if (pageType === 'create') {
            window.location.href = "{{ route('PrmRawMaterialInput.create') }}";
        } else if (pageType === 'detail') {
            window.location.href = "{{ route('PrmRawMaterialInput.detail') }}";
        }
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
