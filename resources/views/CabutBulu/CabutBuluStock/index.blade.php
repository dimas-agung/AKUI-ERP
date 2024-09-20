@extends('layouts.master1')
@section('menu')
    Cabut Bulu
@endsection
@section('title')
    Cabut Bulu Stock
@endsection
@section('content')
    <div class="section">
        <div class="card border border-primary border-3">
            <div class="card-header">
                <div class="col-sm-12 d-flex justify-content-between">
                    <h4 class="card-title">Data Cabut Bulu Stock</h4>
                </div>
            </div>
            <div class="card-body" style="overflow: auto;">
                <div class="table-responsive">
                    <table id="table1" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">No</th>
                                <th class="text-center" scope="col">Workstation</th>
                                <th class="text-center" scope="col">Unit</th>
                                <th class="text-center" scope="col">Nomor Job</th>
                                <th class="text-center" scope="col">Nomor Batch</th>
                                <th class="text-center">Jenis Job</th>
                                <th class="text-center">Berat Job</th>
                                <th class="text-center">Pcs Job</th>
                                <th class="text-center">Upah Operator</th>
                                <th class="text-center">Berat Bersih</th>
                                <th class="text-center">Upah Operator Bersih</th>
                                <th class="text-center">Tujuan Kirim</th>
                                <th class="text-center" scope="col">Keterangan</th>
                                @role('admin')
                                    <th class="text-center" scope="col">Modal</th>
                                    <th class="text-center" scope="col">Total Modal</th>
                                    <th class="text-center" scope="col">Upah Operator</th>
                                @endrole
                                <th scope="col" class="text-center">Trial</th>
                                <th class="text-center" scope="col">Status</th>
                                <th class="text-center" scope="col">Created At</th>
                                <th class="text-center" scope="col">Updated At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($cabut_bulu_stock as $item)
                                @php
                                    $berat_bersih = generate_berat_bersih($item->berat_job);
                                    $upah_bersih = $item->upah_operator /$item->berat_job * $berat_bersih;
                                @endphp
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $item->workstation }}</td>
                                    <td class="text-center">{{ $item->unit }}</td>
                                    <td class="text-center">{{ $item->nomor_job }}</td>
                                    <td class="text-center">{{ $item->nomor_batch }}</td>
                                    <td class="text-center">{{ $item->jenis_job }}</td>
                                    <td class="text-center">{{ $item->berat_job }}</td>
                                    <td class="text-center">{{ $item->pcs_job }}</td>
                                    <td class="text-center">{{ $item->upah_operator }}</td>
                                    <td class="text-center">{!! $berat_bersih !!}</td>
                                    <td class="text-center">{!! $upah_bersih !!}</td>
                                    <td class="text-center">{{ $item->tujuan_kirim }}</td>
                                    <td class="text-center">{{ $item->keterangan }}</td>
                                    @role('admin')
                                        <td class="text-center">{{ number_format($item->modal, 2, ',', '.') }}</td>
                                        <td class="text-center">{{ number_format($item->total_modal, 2, ',', '.') }}</td>
                                        <td class="text-center">{{ number_format($item->upah_operator, 2, ',', '.') }}</td>
                                    @endrole
                                    <td class="text-center">{{ $item->is_trial == 1 ?'Ya':'Tidak' }}</td>
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
                                    <td class="text-center">{{ $item->created_at }}</td>
                                    <td class="text-center">
                                        {{ $item->created_at != $item->updated_at ? $item->updated_at : '' }}
                                    </td>
                                </tr>
                            @empty
                                <div class="alert alert-danger">
                                    Data Cabut Bulu Stock belum Tersedia.
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
