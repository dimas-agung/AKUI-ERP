@extends('layouts.master1')
@section('menu')
    Pre Grading Halus
@endsection
@section('title')
    Pre Grading Halus Adding Stock
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card mt-2 border border-primary border-3">
            <div class="card-body">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            <div class="col-sm-12 d-flex justify-content-between">
                                Data Pre Grading Halus Adding Stock
                            </div>
                        </h5>
                    </div>
                    <div class="card-body" style="overflow: auto;">
                        <div class="table-responsive">
                            <table id="table1" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">No</th>
                                        <th scope="col" class="text-center">Unit</th>
                                        <th scope="col" class="text-center">Nomor Grading</th>
                                        <th scope="col" class="text-center">ID Box Grading Kasar</th>
                                        <th scope="col" class="text-center">Nomor Batch</th>
                                        <th scope="col" class="text-center">Nomor Nota Internal</th>
                                        <th scope="col" class="text-center">Nama Supplier</th>
                                        <th scope="col" class="text-center">Jenis Raw Material</th>
                                        <th scope="col" class="text-center">Kadar Air</th>
                                        <th scope="col" class="text-center">Berat Adding</th>
                                        <th scope="col" class="text-center">Pcs Adding</th>
                                        <th scope="col" class="text-center">Modal</th>
                                        <th scope="col" class="text-center">Total Modal</th>
                                        <th scope="col" class="text-center">Status Stock</th>
                                        <th scope="col" class="text-center">Created At</th>
                                        <th scope="col" class="text-center">Updated At</th>
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($pre_grading_halus_adding_stocks as $PGHAS)
                                        <tr>
                                            <td class="text-center">{{ $i++ }}</td>
                                            <td class="text-center">{{ $PGHAS->unit }}</td>
                                            <td class="text-center">{{ $PGHAS->nomor_grading }}</td>
                                            <td class="text-center">{{ $PGHAS->id_box_grading_kasar }}</td>
                                            <td class="text-center">{{ $PGHAS->nomor_batch }}</td>
                                            <td class="text-center">{{ $PGHAS->nomor_nota_internal }}</td>
                                            <td class="text-center">{{ $PGHAS->nama_supplier }}</td>
                                            <td class="text-center">{{ $PGHAS->jenis_raw_material }}</td>
                                            <td class="text-center">{{ $PGHAS->kadar_air }}</td>
                                            <td class="text-center">{{ $PGHAS->berat_adding }}</td>
                                            <td class="text-center">{{ $PGHAS->pcs_adding }}</td>
                                            <td class="text-center">{{ $PGHAS->modal }}</td>
                                            <td class="text-center">{{ $PGHAS->total_modal }}</td>
                                            <td class="text-center">{{ $PGHAS->status_stock }}</td>
                                            <td class="text-center">{{ $PGHAS->created_at }}</td>
                                            <td class="text-center">{{ $PGHAS->updated_at }}</td>
                                            <td class="text-center">
                                                <div class="form-button-action">
                                                    <form style="display: flex" id="deleteForm{{ $PGHAS->id }}"
                                                        action="{{ route('PreGradingHalusAddingStock.destroy', $PGHAS->id) }}"
                                                        method="POST">
                                                        <a href="{{ route('PreGradingHalusAddingStock.show', $PGHAS->id) }}"
                                                            class="btn btn-link" title="View" data-original-title="View">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-link"
                                                            data-original-title="Remove"
                                                            onclick="confirmDelete({{ $PGHAS->id }})">
                                                            <i class="bi bi-trash3 text-danger"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <div class="alert alert-danger">
                                            Data Pre Grading Halus Adding Stock belum Tersedia.
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
