@extends('layouts.master1')
@section('Menu')
    Grading Kasar
@endsection
@section('title')
    Grading Kasar Input
@endsection
@section('content')
    <div class="section">
        <div class="card">
            <div class="card-header">
                <div class="col-sm-12 d-flex justify-content-between">
                    <h4 class="card-title">Data Grading Kasar Input</h4>
                    <a href="{{ url('/GradingKasarInput/create') }}" class="btn btn-outline-success rounded-pill">
                        <i class="fa fa-plus"></i>
                        Add Data
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table1" class="table">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">No</th>
                                <th class="text-center" scope="col">Nomor BSTB</th>
                                <th class="text-center" scope="col">Nomor Batch</th>
                                <th class="text-center" scope="col">Id Box</th>
                                <th class="text-center">Nama Supplier</th>
                                <th class="text-center">Jenis</th>
                                <th class="text-center">Berat</th>
                                <th class="text-center">Kadar Air</th>
                                <th class="text-center">Nomor Grading</th>
                                <th class="text-center">Modal</th>
                                <th class="text-center">Total Modal</th>
                                <th class="text-center" scope="col">Keterangan</th>
                                <th class="text-center" scope="col">NIP Admin</th>
                                <th class="text-center" scope="col">User Updated</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <th class="text-center">No</th>
                            <th class="text-center">Nomor BSTB</th>
                            <th class="text-center">Nomor Batch</th>
                            <th class="text-center">Id Box</th>
                            <th class="text-center">Nama Supplier</th>
                            <th class="text-center">Jenis</th>
                            <th class="text-center">Berat</th>
                            <th class="text-center">Kadar Air</th>
                            <th class="text-center">Nomor Grading</th>
                            <th class="text-center">Modal</th>
                            <th class="text-center">Total Modal</th>
                            <th class="text-center">Keterangan</th>
                            <th class="text-center">NIP Admin</th>
                            <th class="text-center">User Updated</th>
                            <th class="text-center">Action</th>
                        </tfoot>
                        <tbody>
                            @forelse ($GradingKI as $item)
                                <tr>
                                    <td class="text-center">{{ $i++ }}</td>
                                    <td class="text-center">{{ $item->nomor_bstb }}</td>
                                    <td class="text-center">{{ $item->nomor_batch }}</td>
                                    <td class="text-center">{{ $item->id_box }}</td>
                                    <td class="text-center">{{ $item->nama_supplier }}</td>
                                    <td class="text-center">{{ $item->jenis }}</td>
                                    <td class="text-center">{{ $item->berat }}</td>
                                    <td class="text-center">{{ $item->kadar_air }}</td>
                                    <td class="text-center">{{ $item->nomor_grading }}</td>
                                    <td class="text-center">{{ $item->modal }}</td>
                                    <td class="text-center">{{ $item->total_modal }}</td>
                                    <td class="text-center">{{ $item->keterangan }}</td>
                                    <td class="text-center">{{ $item->user_created }}</td>
                                    <td class="text-center">{{ $item->user_updated }}</td>
                                    <td class="text-center">
                                        <div class="form-button-action">
                                            <form style="display: flex" id="deleteForm{{ $item->id }}"
                                                action="{{ route('GradingKasarInput.destroy', $item->id) }}"
                                                method="POST">
                                                <a href="{{ route('GradingKasarInput.edit', $item->id) }}"
                                                    class="btn btn-link btn-primary" title="Edit Task"
                                                    data-original-title="Edit Task"><i class="bi bi-pencil-square"></i></a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-link btn-danger"
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
                                    Data PRM Raw Material Output belum Tersedia.
                                </div>
                            @endforelse
                        </tbody>
                    </table>
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
