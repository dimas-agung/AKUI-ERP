@extends('layouts.master1')
@section('menu')
    Pre Wash
@endsection
@section('title')
    Pre Wash Input
@endsection
@section('content')
    <div class="section">
        <div class="card border border-primary border-3">
            <div class="card-header">
                <div class="col-sm-12 d-flex justify-content-between">
                    <h4 class="card-title">Data Pre Wash Input</h4>
                    <a href="{{ route('PreWashInput.create') }}" class="btn btn-outline-success rounded-pill">
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
                                {{-- <th class="text-center" scope="col">Unit</th> --}}
                                <th class="text-center" scope="col">Nomor Job</th>
                                <th class="text-center" scope="col">Nomor Batch</th>
                                <th class="text-center" scope="col">Jenis Job</th>
                                <th class="text-center" scope="col">Berat Job</th>
                                <th class="text-center" scope="col">Pcs Job</th>
                                <th class="text-center" scope="col">Upah Operator</th>
                                <th class="text-center" scope="col">Tujuan Kirim</th>
                                <th class="text-center" scope="col">Keterangan</th>
                                <th class="text-center" scope="col">Nomor BSTB</th>
                                @role('admin')
                                    <th class="text-center" scope="col">Modal</th>
                                    <th class="text-center" scope="col">Total Modal</th>
                                @endrole
                                <th class="text-center" scope="col">Nip Admin</th>
                                <th class="text-center" scope="col">Tanggal Buat</th>
                                <th class="text-center" scope="col">Tanggal Update</th>
                                <th class="text-center" scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pre_wash_inputs as $item)
                                <tr>
                                    <td class="text-center">{{ $i++ }}</td>
                                    {{-- <td class="text-center">{{ $item->unit }}</td> --}}
                                    <td class="text-center">{{ $item->nomor_job }}</td>
                                    <td class="text-center">{{ $item->nomor_batch }}</td>
                                    <td class="text-center">{{ $item->jenis_job }}</td>
                                    <td class="text-center">{{ number_format($item->berat_job, 0, ',', '.') }}</td>
                                    <td class="text-center">{{ number_format($item->pcs_job, 0, ',', '.') }}</td>
                                    <td class="text-center">{{ number_format($item->upah_operator, 2, ',', '.') }}</td>
                                    <td class="text-center">{{ $item->tujuan_kirim }}</td>
                                    <td class="text-center">{{ $item->keterangan }}</td>
                                    <td class="text-center">{{ $item->nomor_bstb }}</td>
                                    @role('admin')
                                        <td class="text-center">{{ number_format($item->modal, 2, ',', '.') }}</td>
                                        <td class="text-center">{{ number_format($item->total_modal, 2, ',', '.') }}</td>
                                    @endrole
                                    <td class="text-center">{{ $item->user_created }}</td>
                                    <td class="text-center">{{ $item->created_at }}</td>
                                    <td class="text-center">
                                             {{ $item->created_at != $item->updated_at ? $item->updated_at : '' }}
                                    </td>
                                    <td class="text-center">
                                        @if ($item->status==1)
                                            
                                        <div class="form-button-action">
                                            <form style="display: flex" id="deleteForm{{ $item->nomor_bstb }}"
                                                action="{{ route('PreWashInput.destroy', $item->nomor_bstb) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-link" data-original-title="Remove"
                                                    onclick="confirmDelete('{{ $item->nomor_bstb }}')">
                                                    <i class="bi bi-trash3 text-danger"></i>
                                                </button>
                                            </form>
                                        </div>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <div class="alert alert-danger">
                                    Data Pre Wash Input belum Tersedia.
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
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
