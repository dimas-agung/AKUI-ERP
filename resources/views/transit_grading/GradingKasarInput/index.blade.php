@extends('layouts.master1')
@section('menu')
    Grading Kasar
@endsection
@section('title')
    Grading Kasar Input
@endsection
@section('content')
    <div class="section">
        <div class="card border border-primary border-3">
            <div class="card-header">
                <div class="col-sm-12 d-flex justify-content-between">
                    <h4 class="card-title">Data Grading Kasar Input</h4>
                    <a href="{{ Route('GradingKasarInput.create') }}" class="btn btn-outline-success rounded-pill">
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
                                <th class="text-center" scope="col">Nomor BSTB</th>
                                <th class="text-center" scope="col">Nomor Batch</th>
                                <th class="text-center" scope="col">Id Box</th>
                                <th class="text-center">Nama Supplier</th>
                                <th class="text-center">Jenis Raw Material</th>
                                <th class="text-center">Berat</th>
                                <th class="text-center">Kadar Air</th>
                                <th class="text-center">Nomor Grading</th>
                                <th class="text-center">Modal</th>
                                <th class="text-center">Total Modal</th>
                                <th class="text-center" scope="col">Keterangan</th>
                                <th class="text-center" scope="col">NIP Admin</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($GradingKI as $item)
                                <tr>
                                    <td class="text-center">{{ $i++ }}</td>
                                    <td class="text-center">{{ $item->nomor_bstb }}</td>
                                    <td class="text-center">{{ $item->nomor_batch }}</td>
                                    <td class="text-center">{{ $item->id_box }}</td>
                                    <td class="text-center">{{ $item->nama_supplier }}</td>
                                    <td class="text-center">{{ $item->jenis_raw_material }}</td>
                                    <td class="text-center">{{ number_format($item->berat, 2, ',', '.') }}</td>
                                    <td class="text-center">{{ number_format($item->kadar_air, 2, ',', '.') }}</td>
                                    <td class="text-center">{{ $item->nomor_grading }}</td>
                                    <td class="text-center">{{ number_format($item->modal, 0, ',', '.') }}</td>
                                    <td class="text-center">{{ number_format($item->total_modal, 0, ',', '.') }}</td>
                                    <td class="text-center">{{ $item->keterangan }}</td>
                                    <td class="text-center">{{ $item->user_created }}</td>
                                    <td class="text-center">
                                        <div class="form-button-action">
                                            @php
                                                $gradingKasarHasilCount = $GradingKH
                                                    ? $GradingKH
                                                        ->where('id_box_raw_material', $item->id_box)
                                                        ->where('nomor_grading', $item->nomor_grading)
                                                        ->count()
                                                    : 0;
                                            @endphp

                                            @if ($gradingKasarHasilCount == 0)
                                                <form style="display: flex" id="deleteForm{{ $item->nomor_bstb }}"
                                                    action="{{ route('GradingKasarInput.destroy', $item->nomor_bstb) }}"
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
                                    Data Grading Kasar Input belum Tersedia.
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
