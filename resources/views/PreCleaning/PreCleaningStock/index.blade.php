@extends('layouts.master1')
@section('Menu')
    Grading Kasar
@endsection
@section('title')
    Grading Kasar Stock
@endsection
@section('content')
    <div class="section">
        <div class="card">
            <div class="card-header">
                <div class="col-sm-12 d-flex justify-content-between">
                    <h4 class="card-title">Data Grading Kasar Stock</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table1" class="table">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">No</th>
                                <th class="text-center" scope="col">Nomor Job</th>
                                <th class="text-center" scope="col">Nomor BSTB</th>
                                <th class="text-center" scope="col">Id Box Grading Kasar</th>
                                <th class="text-center" scope="col">Nomor Batch</th>
                                <th class="text-center">Nama Supplier</th>
                                <th class="text-center">Nomor Nota Internal</th>
                                <th class="text-center">Id Box Raw Material</th>
                                <th class="text-center">Jenis Raw Material</th>
                                <th class="text-center">Jenis Kirim</th>
                                <th class="text-center">Berat Masuk</th>
                                <th class="text-center">Berat Keluar</th>
                                <th class="text-center">Pcs Masuk</th>
                                <th class="text-center">Pcs Keluar</th>
                                <th class="text-center">Avg Kadar Air</th>
                                <th class="text-center">Nomor Grading</th>
                                <th class="text-center">Tujuan Kirim</th>
                                <th class="text-center">Modal</th>
                                <th class="text-center">Total Modal</th>
                                <th class="text-center" scope="col">Keterangan</th>
                                <th class="text-center" scope="col">NIP Admin</th>
                                <th class="text-center" scope="col">User Updated</th>
                                {{-- <th class="text-center">Action</th> --}}
                            </tr>
                        </thead>
                        <tfoot>
                            <th class="text-center">No</th>
                            <th class="text-center">Nomor Job</th>
                            <th class="text-center">Nomor BSTB</th>
                            <th class="text-center">Id Box Grading Kasar</th>
                            <th class="text-center">Nomor Batch</th>
                            <th class="text-center">Nama Supplier</th>
                            <th class="text-center">Nomor Nota Internal</th>
                            <th class="text-center">Id Box Raw Material</th>
                            <th class="text-center">Jenis Raw Material</th>
                            <th class="text-center">Jenis Kirim</th>
                            <th class="text-center">Berat Masuk</th>
                            <th class="text-center">Berat Keluar</th>
                            <th class="text-center">Pcs Masuk</th>
                            <th class="text-center">Pcs Keluar</th>
                            <th class="text-center">Avg Kadar Air</th>
                            <th class="text-center">Nomor Grading</th>
                            <th class="text-center">Tujuan Kirim</th>
                            <th class="text-center">Modal</th>
                            <th class="text-center">Total Modal</th>
                            <th class="text-center">Keterangan</th>
                            <th class="text-center">NIP Admin</th>
                            <th class="text-center">User Updated</th>
                            {{-- <th class="text-center">Action</th> --}}
                        </tfoot>
                        <tbody>
                            @forelse ($PCStock as $item)
                                <tr>
                                    <td class="text-center">{{ $i++ }}</td>
                                    <td class="text-center">{{ $item->nomor_job }}</td>
                                    <td class="text-center">{{ $item->nomor_bstb }}</td>
                                    <td class="text-center">{{ $item->id_box_grading_kasar }}</td>
                                    <td class="text-center">{{ $item->nomor_batch }}</td>
                                    <td class="text-center">{{ $item->nama_supplier }}</td>
                                    <td class="text-center">{{ $item->nomor_nota_internal }}</td>
                                    <td class="text-center">{{ $item->id_box_raw_material }}</td>
                                    <td class="text-center">{{ $item->jenis_raw_material }}</td>
                                    <td class="text-center">{{ $item->jenis_kirim }}</td>
                                    <td class="text-center">{{ $item->berat_masuk }}</td>
                                    <td class="text-center">{{ $item->berat_keluar }}</td>
                                    <td class="text-center">{{ $item->pcs_masuk }}</td>
                                    <td class="text-center">{{ $item->pcs_keluar }}</td>
                                    <td class="text-center">{{ $item->avg_kadar_air }}</td>
                                    <td class="text-center">{{ $item->nomor_grading }}</td>
                                    <td class="text-center">{{ $item->tujuan_kirim }}</td>
                                    <td class="text-center">{{ $item->modal }}</td>
                                    <td class="text-center">{{ $item->total_modal }}</td>
                                    <td class="text-center">{{ $item->keterangan }}</td>
                                    <td class="text-center">{{ $item->user_created }}</td>
                                    <td class="text-center">{{ $item->user_updated }}</td>
                                </tr>
                            @empty
                                <div class="alert alert-danger">
                                    Data Pre-Cleaning Stock belum Tersedia.
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
