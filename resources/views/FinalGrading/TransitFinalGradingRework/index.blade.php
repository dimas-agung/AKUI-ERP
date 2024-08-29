@extends('layouts.master1')
@section('menu')
    Transit Final Grading
@endsection
@section('title')
    Transit Final Grading Rework
@endsection
@section('content')
    <div class="section">
        <div class="card border border-primary border-3">
            <div class="card-header">
                <div class="col-sm-12 d-flex justify-content-between">
                    <h4 class="card-title">Data Transit Final Grading Rework</h4>
                </div>
            </div>
            <div class="card-body" style="overflow: auto;">
                <div class="table-responsive">
                    <table id="table1" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">No</th>
                                <th class="text-center" scope="col">Unit</th>
                                <th class="text-center" scope="col">Nomor Job Rework</th>
                                <th class="text-center" scope="col">Nomor Batch</th>
                                <th class="text-center" scope="col">Tujuan Kirim</th>
                                <th class="text-center">Job Order</th>
                                <th class="text-center">Berat Job</th>
                                <th class="text-center">Pcs Job</th>
                                @role('admin')
                                    <th class="text-center">Modal Per Jenis</th>
                                    <th class="text-center">Total Modal Per Jenis</th>
                                @endrole
                                <th class="text-center" scope="col">Nama Operator</th>
                                <th class="text-center" scope="col">Nip Operator</th>
                                <th class="text-center" scope="col">Grade Operator</th>
                                <th class="text-center" scope="col">Nama Team Leader</th>
                                <th class="text-center" scope="col">Status</th>
                                {{-- <th class="text-center">Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i=1;
                            @endphp
                            @forelse ($transit_final_grading_rework as $item)
                                <tr>
                                    <td class="text-center">{{ $i++ }}</td>
                                    <td class="text-center">{{ $item->unit }}</td>
                                    <td class="text-center">{{ $item->nomor_job_rework }}</td>
                                    <td class="text-center">{{ $item->nomor_batch }}</td>
                                    <td class="text-center">{{ $item->tujuan_kirim }}</td>
                                    <td class="text-center">{{ $item->job_order }}</td>
                                    <td class="text-center">{{ $item->berat_job }}</td>
                                    <td class="text-center">{{ $item->pcs_job }}</td>
                                    @role('admin')
                                        <td class="text-center">{{ number_format($item->modal_per_jenis, 2, ',', '.') }}</td>
                                        <td class="text-center">{{ number_format($item->total_modal_per_jenis, 2, ',', '.') }}
                                        </td>
                                    @endrole
                                    <td class="text-center">{{ $item->nama_operator }}</td>
                                    <td class="text-center">{{ $item->nip_operator }}</td>
                                    <td class="text-center">{{ $item->grade_operator }}</td>
                                    <td class="text-center">{{ $item->nama_team_leader }}</td>
                                    <td>
                                        @if ($item->status == 0)
                                            Non-Aktif
                                        @elseif ($item->status == 1)
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
                                    Data Transit Final Grading Rework belum Tersedia.
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
<<<<<<< HEAD
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
=======
>>>>>>> dev-helmi
