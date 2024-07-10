@extends('layouts.master1')
@section('menu')
    Moulding
@endsection
@section('title')
    Moulding Stock
@endsection
@section('content')
    <div class="section">
        <div class="card border border-primary border-3">
            <div class="card-header">
                <div class="col-sm-12 d-flex justify-content-between">
                    <h4 class="card-title">Data Moulding Stock</h4>
                </div>
            </div>
            <div class="card-body" style="overflow: auto;">
                <div class="table-responsive">
                    <table id="table1" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">No</th>
                                <th class="text-center" scope="col">Unit</th>
                                <th class="text-center" scope="col">Nomor Job</th>
                                <th class="text-center" scope="col">Nomor Batch</th>
                                <th class="text-center" scope="col">Tujuan Kirim</th>
                                <th class="text-center" scope="col">Job Order</th>
                                <th class="text-center" scope="col">Berat Job</th>
                                <th class="text-center" scope="col">Pcs Job</th>
                                @role('admin')
                                    <th class="text-center" scope="col">Modal Nomor Job</th>
                                    <th class="text-center" scope="col">Total Modal Nomor Job</th>
                                    <th class="text-center" scope="col">Upah Operator</th>
                                @endrole
                                <th class="text-center" scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($moulding_stock as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $item->unit }}</td>
                                    <td class="text-center">{{ $item->nomor_job }}</td>
                                    <td class="text-center">{{ $item->nomor_batch }}</td>
                                    <td class="text-center">{{ $item->tujuan_kirim }}</td>
                                    <td class="text-center">{{ $item->job_order }}</td>
                                    <td class="text-center">{{ $item->berat_job }}</td>
                                    <td class="text-center">{{ $item->pcs_job }}</td>
                                    @role('admin')
                                        <td class="text-center">{{ number_format($item->modal_nomor_job, 2, ',', '.') }}</td>
                                        <td class="text-center">{{ number_format($item->total_modal_nomor_job, 2, ',', '.') }}
                                        </td>
                                        <td class="text-center">{{ number_format($item->upah_operator, 2, ',', '.') }}</td>
                                    @endrole
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
                                    Data Moulding Stock belum Tersedia.
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
