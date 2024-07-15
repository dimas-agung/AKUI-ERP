
@extends('layouts.master1')
{{-- @extends('layouts.template') --}}
@section('menu')
    Purchasing & EXIM
@endsection
@section('title')
    Grading Kasar Input
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card mt-2 border border-primary bord    er-3">
            <div class="card-body">
                <div class="card">
                    {{-- card header --}}
                    <div class="card-header">
                        <h5 class="card-title">
                            <div class="col-sm-12">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span>Data Grading Kasar Adjustment</span>
                                    <div>





                                        <button onclick="redirectToPage('create')" type="button"
                                            class="btn btn-outline-success rounded-pill"><strong><i
                                                    class="bi bi-plus-circle"></i> Add Data <i
                                                    class="bi bi-plus-circle"></i></strong></button>
                                    </div>
                                </div>
                            </div>


                        </h5>
                    </div>
                    {{-- card body --}}
                    <div class="card-body" style="overflow: auto;">
                        <div class="table-responsive">
                            <table id="table1" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">No</th>
                                        <th scope="col" class="text-center">No Adjustment</th>
                                        <th scope="col" class="text-center">Id Box Raw Material</th>
                                        <th scope="col" class="text-center">Tanggal Adjustment</th>
                                        <th scope="col" class="text-center">Nomor Batch</th>
                                        <th scope="col" class="text-center">Nama Supplier</th>
                                        <th scope="col" class="text-center">Jenis</th>
                                        <th scope="col" class="text-center">Nomor Batch Adjustment</th>
                                        <th scope="col" class="text-center">Berat Adjustment</th>
                                        <th scope="col" class="text-center">Berat Saldo Terakhir</th>
                                        <th scope="col" class="text-center">Modal Saldo Terakhir</th>
                                        <th scope="col" class="text-center">Total Modal Saldo Terakhir</th>
                                        <th scope="col" class="text-center">Berat Saldo Awal</th>
                                        <th scope="col" class="text-center">Modal Saldo Awal</th>
                                        <th scope="col" class="text-center">Total Modal Saldo Awal</th>
                                        <th scope="col" class="text-center">Keterangan</th>
                                        <th scope="col" class="text-center">User Created</th>
                                        <th scope="col" class="text-center">Created At</th>
                                        <th scope="col" class="text-center">Updated At</th>
                                        <th scope="col" class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse ($GradingKasarAdjustment as $MasterPRIM)
                                    <tr>
                                        <td class="text-center">{{ $i++ }}</td>
                                        <td class="text-center">{{ $MasterPRIM->nomor_adjustment }}</td>
                                        <td class="text-center">{{ $MasterPRIM->id_box_raw_material }}</td>
                                        <td class="text-center">{{ $MasterPRIM->tanggal_adjustment }}</td>
                                        <td class="text-center">{{ $MasterPRIM->nomor_batch }}</td>
                                        <td class="text-center">{{ $MasterPRIM->nama_supplier }}</td>
                                        <td class="text-center">{{ $MasterPRIM->jenis_grading }}</td>
                                        <td class="text-center">{{ $MasterPRIM->nomor_batch_adjustment }}</td>
                                        <td class="text-center">{{ $MasterPRIM->berat_adjustment }}</td>
                                        <td class="text-center">{{ $MasterPRIM->berat_saldo_terakhir }}</td>
                                        <td class="text-center">{{ $MasterPRIM->modal_saldo_terakhir }}</td>
                                        <td class="text-center">{{ $MasterPRIM->total_modal_saldo_terakhir }}</td>
                                        <td class="text-center">{{ $MasterPRIM->berat_saldo_awal }}</td>
                                        <td class="text-center">{{ $MasterPRIM->modal_saldo_awal }}</td>
                                        <td class="text-center">{{ $MasterPRIM->total_modal_saldo_awal }}</td>
                                        <td class="text-center">{{ $MasterPRIM->keterangan }}</td>
                                        <td class="text-center">{{ $MasterPRIM->user_created }}</td>
                                        <td class="text-center">{{ $MasterPRIM->created_at }}</td>
                                        <td class="text-center">
                                            {{ $MasterPRIM->created_at != $MasterPRIM->updated_at ? $MasterPRIM->updated_at : '' }}
                                        </td>

                                        <td class="text-center">
                                            <div class="form-button-action">

                                                <form style="display: flex" id="deleteForm{{ $MasterPRIM->id }}"
                                                    action="{{ route('GradingKasarAdjustment.destroy', $MasterPRIM->id) }}"
                                                    method="POST">

                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-link"
                                                        data-original-title="Remove"
                                                        onclick="confirmDelete({{ $MasterPRIM->id }})">
                                                        <i class="bi bi-trash3 text-danger"></i>
                                                    </button>
                                                </form>

                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <div class="alert alert-danger">
                                        Data Adjustment Raw Material belum Tersedia.
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
<script>
    function redirectToPage(pageType) {
        if (pageType === 'create') {
            window.location.href = "{{ route('GradingKasarAdjustment.create') }}";
        }
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
