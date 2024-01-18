@extends('layouts.master1')
@section('Menu')
    Transit Grading Kasar
@endsection
@section('title')
    Grading Kasar Output
@endsection
@section('content')
    <div class="section">
        <div class="card">
            <div class="card-header">
                <div class="col-sm-12 d-flex justify-content-between">
                    <h4 class="card-title">Data Grading Kasar Output</h4>
                    <a href="{{ url('/GradingKasarOutput/create') }}" class="btn btn-outline-success rounded-pill">
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
                                <th class="text-center" scope="col">ID Box Grading Kasar</th>
                                <th class="text-center" scope="col">Nomor Job</th>
                                <th class="text-center" scope="col">Nomor Batch</th>
                                <th class="text-center" scope="col">Nama Supplier</th>
                                <th class="text-center" scope="col">ID Box Raw Material</th>
                                <th class="text-center" scope="col">Jenis Raw Material</th>
                                <th class="text-center" scope="col">Jenis Grading</th>
                                <th class="text-center" scope="col">Berat Keluar</th>
                                <th class="text-center" scope="col">PCS Keluar</th>
                                <th class="text-center" scope="col">AVG Kadar Air</th>
                                <th class="text-center" scope="col">Tujuan Kirim</th>
                                <th class="text-center" scope="col">Nomor Grading</th>
                                <th class="text-center" scope="col">Modal</th>
                                <th class="text-center" scope="col">Total Modal</th>
                                <th class="text-center" scope="col">Biaya Produksi</th>
                                <th class="text-center" scope="col">Fix Total Modal</th>
                                <th class="text-center" scope="col">Keterangan</th>
                                <th class="text-center" scope="col">NIP Admin</th>
                                <th class="text-center" scope="col">User Updated</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <th class="text-center">No</th>
                            <th class="text-center">Nomor BSTB</th>
                            <th class="text-center">ID Box Grading Kasar</th>
                            <th class="text-center">Nomor Job</th>
                            <th class="text-center">Nomor Batch</th>
                            <th class="text-center">Nama Supplier</th>
                            <th class="text-center">ID Box Raw Material</th>
                            <th class="text-center">Jenis Raw Material</th>
                            <th class="text-center">Jenis Grading</th>
                            <th class="text-center">Berat Keluar</th>
                            <th class="text-center">PCS Keluar</th>
                            <th class="text-center">AVG Kadar Air</th>
                            <th class="text-center">Tujuan Kirim</th>
                            <th class="text-center">Nomor Grading</th>
                            <th class="text-center">Modal</th>
                            <th class="text-center">Total Modal</th>
                            <th class="text-center">Biaya Produksi</th>
                            <th class="text-center">Fix Total Modal</th>
                            <th class="text-center">Keterangan</th>
                            <th class="text-center">NIP Admin</th>
                            <th class="text-center">User Updated</th>
                            <th class="text-center">Action</th>
                        </tfoot>
                        <tbody>
                            @forelse ($GradingKO as $item)
                                <tr>
                                    <td class="text-center">{{ $i++ }}</td>
                                    <td class="text-center">{!! $item->nomor_bstb !!}</td>
                                    <td class="text-center">{!! $item->id_box_grading_kasar !!}</td>
                                    <td class="text-center">{!! $item->nomor_job !!}</td>
                                    <td class="text-center">{!! $item->nomor_batch !!}</td>
                                    <td class="text-center">{!! $item->nama_supplier !!}</td>
                                    <td class="text-center">{!! $item->id_box_raw_material !!}</td>
                                    <td class="text-center">{!! $item->jenis_raw_material !!}</td>
                                    <td class="text-center">{!! $item->jenis_grading !!}</td>
                                    <td class="text-center">{!! $item->berat_keluar !!}</td>
                                    <td class="text-center">{!! $item->pcs_keluar !!}</td>
                                    <td class="text-center">{!! $item->avg_kadar_air !!}</td>
                                    <td class="text-center">{!! $item->tujuan_kirim !!}</td>
                                    <td class="text-center">{!! $item->nomor_grading !!}</td>
                                    <td class="text-center">{!! $item->modal !!}</td>
                                    <td class="text-center">{!! $item->total_modal !!}</td>
                                    <td class="text-center">{!! $item->biaya_produksi !!}</td>
                                    <td class="text-center">{!! $item->fix_total_modal !!}</td>
                                    <td class="text-center">{!! $item->keterangan !!}</td>
                                    <td class="text-center">{!! $item->user_created !!}</td>
                                    <td class="text-center">{!! $item->user_updated !!}</td>
                                    <td class="text-center">
                                        <div class="form-button-action">
                                            <form style="display: flex" id="deleteForm{{ $item->id }}"
                                                action="{{ route('GradingKasarOutput.destroy', $item->id) }}"
                                                method="POST">
                                                <a href="{{ route('GradingKasarOutput.edit', $item->id) }}"
                                                    class="btn btn-link btn-primary" title="Edit Task"
                                                    data-original-title="Edit Task"><i
                                                        class="bi bi-pencil-square"></i></a>
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
                                    Data Grading Kasar Output belum Tersedia.
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
