@extends('layouts.master1')
@section('menu')
    Cabut Bulu Hancuran
@endsection
@section('title')
    Cabut Bulu Hancuran Persiapan Stock
@endsection
@section('content')
    <div class="section">
        <div class="card border border-primary border-3">
            <div class="card-header">
                <div class="col-sm-12 d-flex justify-content-between">
                    <h4 class="card-title">Data Cabut Bulu Hancuran Persiapan Stock</h4>
                </div>
            </div>
            <div class="card-body" style="overflow: auto;">
                <div class="table-responsive">
                    <table id="table1" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">No</th>
                                <th class="text-center" scope="col">Nomor Job</th>
                                <th class="text-center" scope="col">Jenis Rambang</th>
                                @role('admin')
                                    <th class="text-center" scope="col">Upah Operator</th>
                                @endrole
                                <th class="text-center" scope="col">Berat Masuk</th>
                                <th class="text-center" scope="col">Berat keluar</th>
                                <th class="text-center" scope="col">Sisa Berat</th>
                                <th class="text-center" scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($cabut_hancuran_persiapan_stocks as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $item->nomor_job }}</td>
                                    <td class="text-center">{{ $item->jenis_rambang }}</td>
                                    @role('admin')
                                        <td class="text-center">{{ number_format($item->upah_operator, 2, ',', '.') }}</td>
                                    @endrole
                                    <td class="text-center">{{ $item->berat_masuk }}</td>
                                    <td class="text-center">{{ $item->berat_keluar }}</td>
                                    <td class="text-center">{{ $item->sisa_berat }}</td>
                                    <td>
                                        @if ($item->status == 1)
                                            On Stock
                                        @elseif ($item->status == 2)
                                            On Process
                                        @elseif ($item->status == 3)
                                            Finished
                                        @else
                                            Unknown Status
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <div class="alert alert-danger">
                                    Data Cabut Bulu Hancuran Persiapan Stock belum Tersedia.
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
