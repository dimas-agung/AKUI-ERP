@extends('layouts.master1')
@section('menu')
    Purchasing & EXIM
@endsection
@section('title')
    Purchasing Raw Material Input
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
                                Data Purchasing Input Item
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
                                        <th scope="col" class="text-center">Jenis</th>
                                        <th scope="col" class="text-center">Berat Nota</th>
                                        <th scope="col" class="text-center">Berat kotor</th>
                                        <th scope="col" class="text-center">Berat Bersih</th>
                                        <th scope="col" class="text-center">Selisih Berat</th>
                                        <th scope="col" class="text-center">Kadar Air</th>
                                        <th scope="col" class="text-center">Id Box</th>
                                        <th scope="col" class="text-center">Harga Nota</th>
                                        <th scope="col" class="text-center">Total Harga Nota</th>
                                        <th scope="col" class="text-center">Harga Deal</th>
                                        <th scope="col" class="text-center">Keterangan</th>
                                        <th scope="col" class="text-center">User Created</th>
                                        <th scope="col" class="text-center">User Updated</th>
                                        <th scope="col" class="text-center">Created At</th>
                                        <th scope="col" class="text-center">Updated At</th>
                                        <th scope="col" class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @forelse ($PrmInput->PrmRawMaterialInputItem as $MasterPRIM) --}}
                                    @forelse ($MasterPRIM->PrmRawMaterialInputItem as $MasterPRIM)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $MasterPRIM->doc_no }}</td>
                                            <td>{{ $MasterPRIM->jenis }}</td>
                                            <td>{{ $MasterPRIM->berat_nota }}</td>
                                            <td>{{ $MasterPRIM->berat_kotor }}</td>
                                            <td>{{ $MasterPRIM->berat_bersih }}</td>
                                            <td>{{ $MasterPRIM->selisih_berat }}</td>
                                            <td>{{ $MasterPRIM->kadar_air }}</td>
                                            <td>{{ $MasterPRIM->id_box }}</td>
                                            <td>{{ $MasterPRIM->harga_nota }}</td>
                                            <td>{{ $MasterPRIM->total_harga_nota }}</td>
                                            <td>{{ $MasterPRIM->harga_deal }}</td>
                                            <td>{{ $MasterPRIM->keterangan }}</td>
                                            <td>{{ $MasterPRIM->user_created }}</td>
                                            <td>{{ $MasterPRIM->user_updated }}</td>
                                            <td>{{ $MasterPRIM->created_at }}</td>
                                            <td>{{ $MasterPRIM->updated_at }}</td>
                                            <td class="text-center">
                                                <div class="form-button-action">
                                                    <form style="display: flex" id="deleteForm{{ $MasterPRIM->id }}"
                                                        action="{{ route('PrmRawMaterialInput.destroyItem', $MasterPRIM->id) }}"
                                                        method="POST">
                                                        <a href="{{ route('PrmRawMaterialInput.edit', $MasterPRIM->id) }}"
                                                            class="btn btn-link" title="Edit Task"
                                                            data-original-title="Edit Task">
                                                            <i class="bi bi-pencil-square text-success"></i>
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
                                            Data Purchasing Input belum Tersedia.
                                        </div>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class=" d-flex justify-content-end model-footer no-bd">
                            <a href="{{ url('/prm_raw_material_input') }}" type="button" class="btn btn-danger mt-3"
                                data-dismiss="modal">Close</a>
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
