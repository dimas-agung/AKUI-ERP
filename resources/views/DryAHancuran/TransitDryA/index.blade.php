@extends('layouts.master1')
@section('menu')
    Transit Dry A
@endsection
@section('title')
    Transit Dry A Hancuran
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card border border-primary border-3 mt-2">
            <div class="card-body">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            <div class="col-sm-12 d-flex justify-content-between">
                                Data Transit Dry A Hancuran
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
                                        <th scope="col" class="text-center">Berat Job</th>
                                        <th scope="col" class="text-center">Nomor Job</th>
                                        <th scope="col" class="text-center">Nomor BSTB</th>
                                        <th scope="col" class="text-center">Tujuan Kirim</th>
                                        @role('admin')
                                        <th class="text-center" scope="col">Modal</th>
                                        <th class="text-center" scope="col">Total Modal</th>
                                        @endrole
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @forelse ($transit_pre_cleaning_stocks as $TPCS)
                                        @if ($item->tujuan_kirim != Auth::user()->plant)
                                            @php
                                                continue;
                                            @endphp
                                        @endif
                                        @if ($TPCS->berat_job != 0)
                                            <tr>
                                                <td class="text-center">{{ $i++ }}</td>
                                                <td class="text-center">{{ $TPCS->unit }}</td>
                                                <td class="text-center">{{ $TPCS->jenis_grading }}</td>
                                                <td class="text-center">{{ $TPCS->berat_job }}</td>
                                                <td class="text-center">{{ $TPCS->nomor_job }}</td>
                                                <td class="text-center">{{ $TPCS->nomor_bstb }}</td>
                                                <td class="text-center">{{ $TPCS->tujuan_kirim }}</td>
                                                @role('admin')
                                                <td class="text-center">{{ $TPCS->modal }}</td>
                                                <td class="text-center">{{ $TPCS->total_modal }}</td>
                                                @endrole
                                            </tr>
                                        @endif
                                    @empty
                                        <div class="alert alert-danger">
                                            Data Transit Dry A Hancuran belum Tersedia.
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
