@extends('layouts.master1')
@section('menu')
    Dry A
@endsection
@section('title')
    Dry A Grading Hancuran Stock
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card mt-2 border border-primary border-3">
            <div class="card-body">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            <div class="col-sm-12 d-flex justify-content-between">
                                Data Dry A Grading Hancuran Stock
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
                                        <th scope="col" class="text-center">Jenis Grading</th>
                                        <th scope="col" class="text-center">Berat Masuk</th>
                                        <th scope="col" class="text-center">Berat Keluar</th>
                                        <th scope="col" class="text-center">Sisa Berat</th>
                                        @role('admin')
                                        <th scope="col" class="text-center">Modal</th>
                                        <th scope="col" class="text-center">Total Modal</th>
                                        @endrole
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($dry_a_grading_hancuran_stock as $item)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">{{ $item->unit }}</td>
                                            <td class="text-center">{{ $item->jenis_grading }}</td>
                                            <td class="text-center">{{ $item->berat_masuk }}</td>
                                            <td class="text-center">{{ $item->berat_keluar }}</td>
                                            <td class="text-center">{{ $item->sisa_berat }}</td>
                                            @role('admin')
                                            <td class="text-center">{{ $item->modal }}</td>
                                            <td class="text-center">{{ $item->total_modal }}</td>
                                            @endrole
                                        </tr>
                                    @empty
                                        <div class="alert alert-danger">
                                            Data Dry A Grading Hancuran Stock belum Tersedia.
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
