@extends('layouts.master1')
@section('menu')
    Purchasing & EXIM
@endsection
@section('title')
    Purchasing Raw Material Stock
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
                                Data Purchasing Raw Material Stock
                            </div>
                        </h5>
                    </div>
                    {{-- card body --}}
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="table1">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">No</th>
                                        <th scope="col" class="text-center">Id Box</th>
                                        <th scope="col" class="text-center">Nomor Batch</th>
                                        <th scope="col" class="text-center">Nama Supplier</th>
                                        <th scope="col" class="text-center">Jenis</th>
                                        <th scope="col" class="text-center">Berat Masuk</th>
                                        <th scope="col" class="text-center">Berat Keluar</th>
                                        <th scope="col" class="text-center">Sisa Berat</th>
                                        <th scope="col" class="text-center">Avg Kadar Air</th>
                                        <th scope="col" class="text-center">Modal</th>
                                        <th scope="col" class="text-center">Total Modal</th>
                                        <th scope="col" class="text-center">Keterangan</th>
                                        <th scope="col" class="text-center">User Created</th>
                                        <th scope="col" class="text-center">User Updated</th>
                                        <th scope="col" class="text-center">Created At</th>
                                        <th scope="col" class="text-center">Updated At</th>
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($PrmRawMaterialStock as $MasterStock)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $MasterStock->id_box }}</td>
                                            <td>{{ $MasterStock->nomor_batch }}</td>
                                            <td>{{ $MasterStock->nama_supplier }}</td>
                                            <td>{{ $MasterStock->jenis }}</td>
                                            <td>{{ $MasterStock->berat_masuk }}</td>
                                            <td>{{ $MasterStock->berat_keluar }}</td>
                                            <td>{{ $MasterStock->sisa_berat }}</td>
                                            <td>{{ $MasterStock->avg_kadar_air }}</td>
                                            <td>{{ $MasterStock->modal }}</td>
                                            <td>{{ $MasterStock->total_modal }}</td>
                                            <td>{{ $MasterStock->keterangan }}</td>
                                            <td>{{ $MasterStock->user_created }}</td>
                                            <td>{{ $MasterStock->user_updated }}</td>
                                            <td>{{ $MasterStock->created_at }}</td>
                                            <td>{{ $MasterStock->updated_at }}</td>
                                            <td class="text-center">
                                                <div class="form-button-action">
                                                    <form>
                                                        <a href="{{ route('prm_raw_material_stock.show', $MasterStock->id_box) }}"
                                                            class="btn btn-link" title="View" data-original-title="View">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        @csrf
                                                        {{-- @method('DELETE')
                                                        <button type="button" class="btn btn-link"
                                                            data-original-title="Remove"
                                                            onclick="confirmDelete({{ $MasterStock->id }})">
                                                            <i class="bi bi-trash3 text-danger"></i>
                                                        </button> --}}
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <div class="alert alert-danger">
                                            Data Purchasing Raw Material Stock belum Tersedia.
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
