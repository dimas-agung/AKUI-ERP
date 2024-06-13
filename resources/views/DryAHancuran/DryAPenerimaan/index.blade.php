@extends('layouts.master1')
@section('menu')
    Dry A
@endsection
@section('title')
    Dry A Penerimaan Hancuran
@endsection
@section('content')
    <div class="section">
        <div class="card border border-primary border-3">
            <div class="card-header">
                <div class="col-sm-12 d-flex justify-content-between">
                    <h4 class="card-title">Data Dry A Penerimaan Hancuran</h4>
                    <a href="{{ route('DryAPenerimaanHancuran.create') }}" class="btn btn-outline-success rounded-pill">
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
                                <th class="text-center" scope="col">Jenis Rambang</th>
                                <th class="text-center" scope="col">Upah Operator</th>
                                <th class="text-center" scope="col">Berat</th>
                                <th class="text-center" scope="col">Nama Operator</th>
                                <th class="text-center" scope="col">NIP Operator</th>
                                <th class="text-center" scope="col">Grade Operator</th>
                                <th class="text-center" scope="col">Nama Team Leader</th>
                                <th class="text-center" scope="col">Waktu Penyebaran</th>
                                <th class="text-center" scope="col">Waktu Pengembalian</th>
                                <th class="text-center" scope="col">NIP Admin</th>
                                <th class="text-center" scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($PreGHI as $item)
                                <tr>
                                    <td class="text-center">{{ $i++ }}</td>
                                    <td class="text-center">{{ $item->nomor_job }}</td>
                                    <td class="text-center">{{ $item->jenis_rambang }}</td>
                                    <td class="text-center">{{ $item->upah_operator }}</td>
                                    <td class="text-center">{{ $item->berat }}</td>
                                    <td class="text-center">{{ $item->nama_operator }}</td>
                                    <td class="text-center">{{ $item->nip_operator }}</td>
                                    <td class="text-center">{{ $item->grade_operator }}</td>
                                    <td class="text-center">{{ $item->nama_team_leader }}</td>
                                    <td class="text-center">{{ $item->waktu_penyebaran }}</td>
                                    <td class="text-center">{{ $item->waktu_pengembalian }}</td>
                                    <td class="text-center">{{ $item->user_created }}</td>
                                    <td class="text-center">
                                        <div class="form-button-action">
                                            @if ($item->status == 1)
                                                <form style="display: flex" id="deleteForm{{ $item->nomor_job }}"
                                                    action="{{ route('DryAPenerimaanHancuran.destroy', $item->nomor_job) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-link" data-original-title="Remove"
                                                        onclick="confirmDelete('{{ $item->nomor_job }}')">
                                                        <i class="bi bi-trash3 text-danger"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <div class="alert alert-danger">
                                    Data Dry A Penerimaan Hancuran belum Tersedia.
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
