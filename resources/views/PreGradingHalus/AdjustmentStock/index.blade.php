@extends('layouts.master1')
@section('menu')
    Pre Grading Halus
@endsection
@section('title')
    Grading Halus Adjustment Stock
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card mt-2 border border-primary border-3">
            <div class="card-body">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            <div class="col-sm-12 d-flex justify-content-between">
                                Data Grading Halus Adjustment Stock
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
                                        <th scope="col" class="text-center">Nomor Adjustment</th>
                                        <th scope="col" class="text-center">Nomor Batch</th>
                                        <th scope="col" class="text-center">Berat Adding</th>
                                        <th scope="col" class="text-center">Pcs Adding</th>
                                        <th scope="col" class="text-center">Rasio</th>
                                        @role('admin')
                                            <th scope="col" class="text-center">Modal</th>
                                            <th scope="col" class="text-center">Total Modal</th>
                                        @endrole
                                        <th scope="col" class="text-center">Status</th>
                                        <th scope="col" class="text-center">Created At</th>
                                        <th scope="col" class="text-center">Updated At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($grading_halus_adjustment_stocks as $item)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">{{ $item->unit }}</td>
                                            <td class="text-center">{{ $item->nomor_adjustment }}</td>
                                            <td class="text-center">{{ $item->nomor_batch }}</td>
                                            <td class="text-center">{{ $item->berat_adding }}</td>
                                            <td class="text-center">{{ $item->pcs_adding }}</td>
                                            <td class="text-center">{{ $item->modal * 0.0000196841305522212 }}</td>
                                            @role('admin')
                                                <td class="text-center">{{ $item->modal }}</td>
                                                <td class="text-center">{{ $item->total_modal }}</td>
                                            @endrole
                                            <td class="text-center">
                                                @if ($item->status == 1)
                                                    Aktif
                                                @else
                                                    Tidak Aktif
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $item->created_at }}</td>
                                            <td class="text-center">
                                                {{ $item->created_at != $item->updated_at ? $item->updated_at : '' }}
                                            </td>
                                        </tr>
                                    @empty
                                        <div class="alert alert-danger">
                                            Data Grading Halus Adjustment Stock belum Tersedia.
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
        function redirectToPage() {
            window.location.href = "{{ route('GradingHalusAdjustmentStock.create') }}";
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
@endsection
