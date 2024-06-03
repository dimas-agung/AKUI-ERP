@extends('layouts.master1')
@section('menu')
    Dry A
@endsection
@section('title')
    Transit Dry A Cabut
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card border border-primary border-3 mt-2">
            <div class="card-body">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            <div class="col-sm-12 d-flex justify-content-between">
                                Data Transit Dry A Cabut
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
                                        <th scope="col" class="text-center">Nomor Job</th>
                                        <th scope="col" class="text-center">Nomor BSTB</th>
                                        <th scope="col" class="text-center">Nomor Batch</th>
                                        <th scope="col" class="text-center">Tujuan Kirim</th>
                                        <th scope="col" class="text-center">Keterangan</th>
                                        <th scope="col" class="text-center">Berat Kotor</th>
                                        <th scope="col" class="text-center">Jenis Grading</th>
                                        <th scope="col" class="text-center">Berat 1 Grading</th>
                                        <th scope="col" class="text-center">Pcs 1 Grading</th>
                                        <th scope="col" class="text-center">Berat 2 Grading</th>
                                        @role('admin')
                                            <th scope="col" class="text-center">Modal</th>
                                            <th scope="col" class="text-center">Total Modal</th>
                                        @endrole
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @forelse ($transit_pre_cleaning_stocks as $TPCS)
                                        @if ($TPCS->berat_kotor != 0 || $TPCS->total_modal != 0)
                                            <tr>
                                                <td class="text-center">{{ $i++ }}</td>
                                                <td class="text-center">{{ $TPCS->unit }}</td>
                                                <td class="text-center">{{ $TPCS->nomor_job }}</td>
                                                <td class="text-center">{{ $TPCS->nomor_bstb }}</td>
                                                <td class="text-center">{{ $TPCS->nomor_batch }}</td>
                                                <td class="text-center">{{ $TPCS->tujuan_kirim }}</td>
                                                <td class="text-center">{{ $TPCS->keterangan }}</td>
                                                <td class="text-center">{{ $TPCS->berat_kotor }}</td>
                                                <td class="text-center">{{ $TPCS->jenis_grading }}</td>
                                                <td class="text-center">{{ $TPCS->berat_1_grading }}</td>
                                                <td class="text-center">{{ $TPCS->pcs_1_grading }}</td>
                                                <td class="text-center">{{ $TPCS->berat_2_grading }}</td>
                                                <td class="text-center">{{ number_format($TPCS->modal, 2, ',', '.') }}</td>
                                                <td class="text-center">
                                                    {{ number_format($TPCS->total_modal, 2, ',', '.') }}</td>
                                            </tr>
                                        @endif
                                    @empty
                                        <div class="alert alert-danger">
                                            Data Transit Dry A Cabut belum Tersedia.
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
