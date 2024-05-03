@extends('layouts.master1')
@section('menu')
    Cabut Bulu
@endsection
@section('title')
    Cabut Bulu Penyebaran
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card mt-2 border border-primary border-3">
            <div class="card-body">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            <div class="col-sm-12 d-flex justify-content-between">
                                Data Cabut Bulu Penyebaran
                                <button onclick="redirectToPage()" type="button" class="btn btn-outline-success rounded-pill">
                                    <strong><i class="bi bi-plus-circle"></i> Add Data <i
                                            class="bi bi-plus-circle"></i></strong>
                                </button>
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
                                        <th scope="col" class="text-center">Jenis Job</th>
                                        <th scope="col" class="text-center">Berat Job</th>
                                        <th scope="col" class="text-center">Pcs Job</th>
                                        <th scope="col" class="text-center">Tujuan Kirim</th>
                                        <th scope="col" class="text-center">Keterangan</th>
                                        <th scope="col" class="text-center">Modal</th>
                                        <th scope="col" class="text-center">Total Modal</th>
                                        <th scope="col" class="text-center">Waktu Penyebaran</th>
                                        <th scope="col" class="text-center">Nama Operator</th>
                                        <th scope="col" class="text-center">Nip Operator</th>
                                        <th scope="col" class="text-center">Grade Operator</th>
                                        <th scope="col" class="text-center">Nama Team Leader</th>
                                        <th scope="col" class="text-center">Keterangan 2</th>
                                        <th scope="col" class="text-center">User Created</th>
                                        <th scope="col" class="text-center">User Updated</th>
                                        <th scope="col" class="text-center">Created At</th>
                                        <th scope="col" class="text-center">Updated At</th>
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($cabut_bulu_penyebarans as $item)
                                        <tr>
                                            <td class="text-center">{{ $i++ }}</td>
                                            <td class="text-center">{{ $item->nomor_job }}</td>
                                            <td class="text-center">{{ $item->nomor_batch }}</td>
                                            <td class="text-center">{{ $item->jenis_job }}</td>
                                            <td class="text-center">{{ $item->berat_job }}</td>
                                            <td class="text-center">{{ $item->pcs_job }}</td>
                                            <td class="text-center">{{ $item->tujuan_kirim }}</td>
                                            <td class="text-center">{{ $item->keterangan }}</td>
                                            <td class="text-center">{{ number_format($item->modal, 2, ',', '.') }}</td>
                                            <td class="text-center">{{ number_format($item->total_modal, 2, ',', '.') }}
                                            </td>
                                            <td class="text-center">{{ $item->waktu_penyebaran }}</td>
                                            <td class="text-center">{{ $item->nama_operator }}</td>
                                            <td class="text-center">{{ $item->nip_operator }}</td>
                                            <td class="text-center">{{ $item->grade_operator }}</td>
                                            <td class="text-center">{{ $item->nama_team_leader }}</td>
                                            <td class="text-center">{{ $item->keterangan_2 }}</td>
                                            <td class="text-center">{{ $item->user_created }}</td>
                                            <td class="text-center">{{ $item->user_updated }}</td>
                                            <td class="text-center">{{ $item->created_at }}</td>
                                            <td class="text-center">
                                                {{ $item->created_at != $item->updated_at ? $item->updated_at : '' }}
                                            </td>
                                            <td class="text-center">
                                                <div class="form-button-action">
                                                    <form style="display: flex" id="deleteForm{{ $item->nomor_job }}"
                                                        action="{{ route('CabutBuluPenyebaran.destroy', $item->nomor_job) }}"
                                                        method="POST">
                                                        {{-- <a href="{{ route('CabutBuluPenyebaran.show', $item->nomor_job) }}"
                                                            class="btn btn-link" title="View" data-original-title="View">
                                                            <i class="bi bi-eye"></i>
                                                        </a> --}}
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-link"
                                                            data-original-title="Remove"
                                                            onclick="confirmDelete('{{ $item->nomor_job }}')">
                                                            <i class="bi bi-trash3 text-danger"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <div class="alert alert-danger">
                                            Data Cabut Bulu Penyebaran belum Tersedia.
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
        function redirectToPage() {
            window.location.href = "{{ route('CabutBuluPenyebaran.create') }}";
        }

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
