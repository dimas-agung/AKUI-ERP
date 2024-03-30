@extends('layouts.master1')
@section('menu')
    Pre-Wash
@endsection
@section('title')
    Pre-Wash Output
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card border border-primary border-3 mt-2">
            <div class="card-body">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            <div class="col-sm-12 d-flex justify-content-between">
                                Data Pre-Wash Output
                                <a href="{{ route('PreWashOutput.create') }}" class="btn btn-outline-success rounded-pill">
                                    <i class="fa fa-plus"></i>
                                    Add Data
                                </a>
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
                                        <th scope="col" class="text-center">Nomor BSTB</th>
                                        <th scope="col" class="text-center">Operator Perendaman</th>
                                        <th scope="col" class="text-center">Operator Bilas</th>
                                        <th scope="col" class="text-center">Operator Box</th>
                                        <th scope="col" class="text-center">Jenis Job</th>
                                        <th scope="col" class="text-center">Berat Job</th>
                                        <th scope="col" class="text-center">Pcs Job</th>
                                        <th scope="col" class="text-center">Tujuan Kirim</th>
                                        <th scope="col" class="text-center">Keterangan</th>
                                        <th scope="col" class="text-center">Modal</th>
                                        <th scope="col" class="text-center">Total Modal</th>
                                        <th scope="col" class="text-center">NIP Admin</th>
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($pre_cleaning_outputs as $PCO)
                                        <tr>
                                            <td class="text-center">{{ $i++ }}</td>
                                            <td class="text-center">{{ $PCO->nomor_job }}</td>
                                            <td class="text-center">{{ $PCO->nomor_batch }}</td>
                                            <td class="text-center">{{ $PCO->nomor_bstb }}</td>
                                            <td class="text-center">{{ $PCO->operator_perendaman }}</td>
                                            <td class="text-center">{{ $PCO->operator_bilas }}</td>
                                            <td class="text-center">{{ $PCO->operator_box }}</td>
                                            <td class="text-center">{{ $PCO->jenis_job }}</td>
                                            <td class="text-center">{{ $PCO->berat_job }}</td>
                                            <td class="text-center">{{ $PCO->pcs_job }}</td>
                                            <td class="text-center">{{ $PCO->tujuan_kirim }}</td>
                                            <td class="text-center">{{ $PCO->keterangan }}</td>
                                            <td class="text-center">{{ number_format($PCO->modal, 0, ',', '.') }}</td>
                                            <td class="text-center">{{ number_format($PCO->total_modal, 0, ',', '.') }}
                                            </td>
                                            <td class="text-center">{{ $PCO->user_created }}</td>
                                            <td class="text-center">
                                                <div class="form-button-action">
                                                    @if ($PCO->status == 1)
                                                        <form style="display: flex" id="deleteForm{{ $PCO->nomor_bstb }}"
                                                            action="{{ route('PreWashOutput.destroy', $PCO->nomor_bstb) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-link"
                                                                data-original-title="Remove"
                                                                onclick="confirmDelete('{{ $PCO->nomor_bstb }}')">
                                                                <i class="bi bi-trash3 text-danger"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <div class="alert alert-danger">
                                            Data Pre-Wash Output belum Tersedia.
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
            window.location.href = "{{ Route('PreCleaningOutput.create') }}";
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
