@extends('layouts.master1')
@section('menu')
    Dry A Waste
@endsection
@section('title')
    Transit Dry A Waste
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card border border-primary border-3 mt-2">
            <div class="card-body">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            <div class="col-sm-12 d-flex justify-content-between">
                                Data Transit Dry A Waste
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
                                        <th scope="col" class="text-center">Jenis Waste</th>
                                        <th scope="col" class="text-center">Berat</th>
                                        <th scope="col" class="text-center">Pcs</th>
                                        <th scope="col" class="text-center">Tujuan Kirim</th>
                                        <th scope="col" class="text-center">Nomor Job</th>
                                        <th scope="col" class="text-center">Nomor BSTB</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($transit_pre_cleaning_stocks as $TPCS): ?>
                                    <?php if($TPCS->status != 0): ?>
                                    <tr>
                                        <td class="text-center">{{ $i++ }}</td>
                                        <td class="text-center">{{ $TPCS->unit }}</td>
                                        <td class="text-center">{{ $TPCS->jenis_waste }}</td>
                                        <td class="text-center">{{ $TPCS->berat }}</td>
                                        <td class="text-center">{{ $TPCS->pcs }}</td>
                                        <td class="text-center">{{ $TPCS->tujuan_kirim }}</td>
                                        <td class="text-center">{{ $TPCS->nomor_job }}</td>
                                        <td class="text-center">{{ $TPCS->nomor_bstb }}</td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php endforeach; ?>
                                    <?php if (empty($transit_pre_cleaning_stocks)): ?>
                                    <div class="alert alert-danger">
                                        Data Dry A Waste belum Tersedia.
                                    </div>
                                    <?php endif; ?>
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
        // function redirectToPage() {
        //     window.location.href = "{{ url('/transit_pre_cleaning_stock/create') }}";
        // }

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
