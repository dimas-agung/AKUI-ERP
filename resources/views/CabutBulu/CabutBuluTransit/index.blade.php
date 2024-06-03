@extends('layouts.master1')
@section('menu')
    Cabut Bulu
@endsection
@section('title')
    Transit Cabut Bulu Stock
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card border border-primary border-3 mt-2">
            <div class="card-body">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            <div class="col-sm-12 d-flex justify-content-between">
                                Data Transit Cabut Bulu Stock
                            </div>
                        </h5>
                    </div>
                    <div class="card-body" style="overflow: auto;">
                        <div class="table-responsive">
                            <table id="table1" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">No</th>
                                        <th scope="col" class="text-center">Nomor Job</th>
                                        <th scope="col" class="text-center">Nomor Batch</th>
                                        <th scope="col" class="text-center">Jenis job</th>
                                        <th scope="col" class="text-center">Berat job</th>
                                        <th scope="col" class="text-center">Pcs job</th>
                                        <th scope="col" class="text-center">Tujuan Kirim</th>
                                        <th scope="col" class="text-center">Keterangan</th>
                                        <th scope="col" class="text-center">Nama Operator</th>
                                        <th scope="col" class="text-center">NIP Operator</th>
                                        <th scope="col" class="text-center">Grade Operator</th>
                                        <th scope="col" class="text-center">Nama Team Leader</th>
                                        @role('admin')
                                            <th scope="col" class="text-center">Modal</th>
                                            <th scope="col" class="text-center">Total Modal</th>
                                        @endrole
                                        <th scope="col" class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($transit_pre_cleaning_stocks as $TPCS): ?>
                                    <?php if($TPCS->berat_job != 0 || $TPCS->status != 0): ?>
                                    <tr>
                                        <td class="text-center">{{ $i++ }}</td>
                                        <td class="text-center">{{ $TPCS->nomor_job }}</td>
                                        <td class="text-center">{{ $TPCS->nomor_batch }}</td>
                                        <td class="text-center">{{ $TPCS->jenis_job }}</td>
                                        <td class="text-center">{{ $TPCS->berat_job }}</td>
                                        <td class="text-center">{{ $TPCS->pcs_job }}</td>
                                        <td class="text-center">{{ $TPCS->tujuan_kirim }}</td>
                                        <td class="text-center">{{ $TPCS->keterangan }}</td>
                                        <td class="text-center">{{ $TPCS->nama_operator }}</td>
                                        <td class="text-center">{{ $TPCS->nip_operator }}</td>
                                        <td class="text-center">{{ $TPCS->grade_operator }}</td>
                                        <td class="text-center">{{ $TPCS->nama_team_leader }}</td>
                                        @role('admin')
                                            <td class="text-center">{{ number_format($TPCS->modal, 2, ',', '.') }}</td>
                                            <td class="text-center">{{ number_format($TPCS->total_modal, 2, ',', '.') }}</td>
                                        @endrole
                                        {{-- <td class="text-center">{{ $TPCS->status }}</td> --}}
                                        <td class="text-center">
                                            @if ($TPCS->status == 1)
                                                Aktif
                                            @endif
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php endforeach; ?>
                                    <?php if (empty($transit_pre_cleaning_stocks)): ?>
                                    <div class="alert alert-danger">
                                        Data Transit Cabut Bulu Stock belum Tersedia.
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
