@extends('layouts.master1')
@section('menu')
    Dry A
@endsection
@section('title')
    Dry A Grading Hancuran
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card mt-2 border border-primary border-3">
            <div class="card-body">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            <div class="col-sm-12 d-flex justify-content-between">
                                Data Dry A Grading Hancuran
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
                                        <th scope="col" class="text-center">Jenis Rambang</th>
                                        <th scope="col" class="text-center">Upah Operator</th>
                                        <th scope="col" class="text-center">Berat</th>
                                        <th scope="col" class="text-center">Nama Operator</th>
                                        <th scope="col" class="text-center">Nip Operator</th>
                                        <th scope="col" class="text-center">Grade Operator</th>
                                        <th scope="col" class="text-center">Nama Team Leader</th>
                                        <th scope="col" class="text-center">Waktu Penyebaran</th>
                                        <th scope="col" class="text-center">Waktu Pengembalian</th>
                                        <th scope="col" class="text-center">Jenis Grading</th>
                                        <th scope="col" class="text-center">Berat Grading</th>
                                        <th scope="col" class="text-center">Kontribusi</th>
                                        <th scope="col" class="text-center">Susut Belakang</th>
                                        <th scope="col" class="text-center">Status</th>
                                        <th scope="col" class="text-center">User Created</th>
                                        <th scope="col" class="text-center">User Updated</th>
                                        <th scope="col" class="text-center">Created At</th>
                                        <th scope="col" class="text-center">Updated At</th>
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($dry_a_grading_hancuran as $item)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">{{ $item->nomor_job }}</td>
                                            <td class="text-center">{{ $item->jenis_rambang }}</td>
                                            <td class="text-center">
                                                {{ number_format($item->upah_operator, 2, ',', '.') }}
                                            </td>
                                            <td class="text-center">{{ $item->berat }}</td>
                                            <td class="text-center">{{ $item->nama_operator }}</td>
                                            <td class="text-center">{{ $item->nip_operator }}</td>
                                            <td class="text-center">{{ $item->grade_operator }}</td>
                                            <td class="text-center">{{ $item->nama_team_leader }}</td>
                                            <td class="text-center">{{ $item->waktu_penyebaran }}</td>
                                            <td class="text-center">{{ $item->waktu_pengembalian }}</td>
                                            <td class="text-center">{{ $item->jenis_grading }}</td>
                                            <td class="text-center">{{ $item->berat_grading }}</td>
                                            <td class="text-center">
                                                {{ number_format($item->kontribusi, 2, ',', '.') }}
                                            </td>
                                            <td class="text-center">{{ $item->susut_belakang }}</td>
                                            <td class="text-center">{{ $item->status }}</td>
                                            <td class="text-center">{{ $item->user_created }}</td>
                                            <td class="text-center">{{ $item->user_updated }}</td>
                                            <td class="text-center">{{ $item->created_at }}</td>
                                            <td class="text-center">
                                                {{ $item->created_at != $item->updated_at ? $item->updated_at : '' }}
                                            </td>
                                            <td class="text-center">
                                                <div class="form-button-action">
                                                    @if ($item->status == 1)
                                                        <form style="display: flex" id="deleteForm{{ $item->nomor_job }}"
                                                            action="{{ route('DryAGradingHancuran.destroy', $item->nomor_job) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-link"
                                                                data-original-title="Remove"
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
                                            Data Dry A Grading Hancuran belum Tersedia.
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
            window.location.href = "{{ route('DryAGradingHancuran.create') }}";
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
