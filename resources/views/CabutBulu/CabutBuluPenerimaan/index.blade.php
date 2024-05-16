@extends('layouts.master1')
@section('menu')
    Cabut Bulu
@endsection
@section('title')
    Cabut Bulu Penerimaan
@endsection
@section('content')
    <div class="section">
        <div class="card border border-primary border-3">
            <div class="card-header">
                <div class="col-sm-12 d-flex justify-content-between">
                    <h4 class="card-title">Data Cabut Bulu Penerimaan</h4>
                    <a href="{{ Route('CabutBuluPenerimaan.create') }}" class="btn btn-outline-success rounded-pill">
                        <i class="fa fa-plus"></i>
                        Add Data
                    </a>
                </div>
            </div>
            <div class="card-body" style="overflow: auto;">
                <div class="table-responsive">
                    <table id="table1" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">No</th>
                                <th class="text-center" scope="col">Nomor Job</th>
                                <th class="text-center" scope="col">Nomor BTSB</th>
                                <th class="text-center" scope="col">Nomor Batch</th>
                                <th class="text-center" scope="col">Jenis Job</th>
                                <th class="text-center" scope="col">Berat Job</th>
                                <th class="text-center" scope="col">PCS Job</th>
                                <th class="text-center" scope="col">Tujuan Kirim</th>
                                <th class="text-center" scope="col">Keterangan</th>
                                @role('admin')
                                    <th class="text-center" scope="col">Modal</th>
                                    <th class="text-center" scope="col">Total Modal</th>
                                @endrole
                                <th class="text-center" scope="col">NIP Admin</th>
                                <th class="text-center" scope="col">User Updated</th>
                                <th class="text-center" scope="col">Created At</th>
                                <th class="text-center" scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($CBPenerimaan as $item)
                                <tr>
                                    <td class="text-center">{{ $i++ }}</td>
                                    <td class="text-center">{!! $item->nomor_job !!}</td>
                                    <td class="text-center">{!! $item->nomor_bstb !!}</td>
                                    <td class="text-center">{!! $item->nomor_batch !!}</td>
                                    <td class="text-center">{!! $item->jenis_job !!}</td>
                                    <td class="text-center">{!! $item->berat_job !!}</td>
                                    <td class="text-center">{!! $item->pcs_job !!}</td>
                                    <td class="text-center">{!! $item->tujuan_kirim !!}</td>
                                    <td class="text-center">{!! $item->keterangan !!}</td>
                                    @role('admin')
                                        <td class="text-center">{!! number_format($item->modal, 2, ',', '.') !!}</td>
                                        <td class="text-center">{!! number_format($item->total_modal, 2, ',', '.') !!}</td>
                                    @endrole
                                    <td class="text-center">{!! $item->user_created !!}</td>
                                    <td class="text-center">{!! $item->user_updated !!}</td>
                                    <td class="text-center">{!! $item->created_at !!}</td>
                                    {{-- <td class="text-center">{{ $item->user_updated }}</td> --}}
                                    <td class="text-center">
                                        <div class="form-button-action">
                                            @if ($item->status == 1)
                                                <form style="display: flex" id="deleteForm{{ $item->nomor_bstb }}"
                                                    action="{{ route('CabutBuluPenerimaan.destroy', $item->nomor_bstb) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-link btn-danger"
                                                        data-original-title="Remove"
                                                        onclick="confirmDelete('{{ $item->nomor_bstb }}')">
                                                        <i class="bi bi-trash3 text-danger"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <div class="alert alert-danger">
                                    Data Cabut Bulu Penerimaan belum Tersedia.
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
