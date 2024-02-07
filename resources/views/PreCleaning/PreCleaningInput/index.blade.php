@extends('layouts.master1')
@section('Menu')
    Pre-Cleaning
@endsection
@section('title')
    Data Pre-Cleaning Input
@endsection
@section('content')
    <div class="section">
        <div class="card">
            <div class="card-header">
                <div class="col-sm-12 d-flex justify-content-between">
                    <h4 class="card-title">Data Pre-Cleaning Input</h4>
                    <a href="{{ url('/PreCleaningInput/create') }}" class="btn btn-outline-success rounded-pill">
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
                                <th class="text-center" scope="col">Nomor Doc</th>
                                <th class="text-center" scope="col">Nomor Job</th>
                                <th class="text-center" scope="col">ID Box Grading Kasar</th>
                                <th class="text-center" scope="col">Nomor BTSB</th>
                                <th class="text-center" scope="col">Nomor Batch</th>
                                <th class="text-center" scope="col">Nama Supplier</th>
                                <th class="text-center" scope="col">Status</th>
                                <th class="text-center" scope="col">Nomor Nota Internal</th>
                                <th class="text-center" scope="col">ID Box Raw Material</th>
                                <th class="text-center" scope="col">Jenis Raw Material</th>
                                <th class="text-center" scope="col">Jenis Kirim</th>
                                <th class="text-center" scope="col">Berat Kirim</th>
                                <th class="text-center" scope="col">PCS Kirim</th>
                                <th class="text-center" scope="col">Kadar Air</th>
                                <th class="text-center" scope="col">Tujuan Kirim</th>
                                <th class="text-center" scope="col">Nomor Grading</th>
                                <th class="text-center" scope="col">Modal</th>
                                <th class="text-center" scope="col">Total Modal</th>
                                <th class="text-center" scope="col">Keterangan</th>
                                <th class="text-center" scope="col">NIP Admin</th>
                                <th class="text-center" scope="col">User Updated</th>
                                <th class="text-center" scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($PreCleaningI as $item)
                                <tr>
                                    <td class="text-center">{{ $i++ }}</td>
                                    <td class="text-center">{!! $item->doc_no !!}</td>
                                    <td class="text-center">{!! $item->nomor_job !!}</td>
                                    <td class="text-center">{!! $item->id_box_grading_kasar !!}</td>
                                    <td class="text-center">{!! $item->nomor_bstb !!}</td>
                                    <td class="text-center">{!! $item->nomor_batch !!}</td>
                                    <td class="text-center">{!! $item->nama_supplier !!}</td>
                                    <td class="text-center">
                                        @if ($item->status == 1)
                                            <span>Aktif</span>
                                        @elseif($item->status == 0)
                                            <span class="badge badge-secondary"
                                                style="text-shadow: 1px 1px 6px #000000;">Tidak Aktif</span>
                                        @endif
                                    </td>
                                    <td class="text-center">{!! $item->nomor_nota_internal !!}</td>
                                    <td class="text-center">{!! $item->id_box_raw_material !!}</td>
                                    <td class="text-center">{!! $item->jenis_raw_material !!}</td>
                                    <td class="text-center">{!! $item->jenis_kirim !!}</td>
                                    <td class="text-center">{!! $item->berat_kirim !!}</td>
                                    <td class="text-center">{!! $item->pcs_kirim !!}</td>
                                    <td class="text-center">{!! $item->kadar_air !!}</td>
                                    <td class="text-center">{!! $item->tujuan_kirim !!}</td>
                                    <td class="text-center">{!! $item->nomor_grading !!}</td>
                                    <td class="text-center">{!! $item->modal !!}</td>
                                    <td class="text-center">{!! $item->total_modal !!}</td>
                                    <td class="text-center">{!! $item->keterangan !!}</td>
                                    <td class="text-center">{!! $item->user_created !!}</td>
                                    <td class="text-center">{!! $item->user_updated !!}</td>
                                    {{-- <td class="text-center">{{ $item->user_updated }}</td> --}}
                                    <td class="text-center">
                                        <div class="form-button-action">
                                            @if ($item->status == 1)
                                                <form style="display: flex" id="deleteForm{{ $item->nomor_bstb }}"
                                                    action="{{ route('PreCleaningInput.destroy', $item->nomor_bstb) }}"
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
                                    Data Pre-Cleaning Input belum Tersedia.
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
