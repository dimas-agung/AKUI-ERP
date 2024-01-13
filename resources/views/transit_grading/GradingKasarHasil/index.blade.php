@extends('layouts.master1')
@section('menu')
    Grading Kasar Transit
@endsection
@section('title')
    Grading Kasar Hasil
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card mt-2">
            <div class="card-body">
                <div class="card">
                    {{-- card header --}}
                    <div class="card-header">
                        <h5 class="card-title">
                            <div class="col-sm-12 d-flex justify-content-between">
                                Data Grading Kasar Hasil
                                <button onclick="redirectToPage()" type="button" class="btn btn-outline-success rounded-pill">
                                    <strong>Add Data</strong>
                                </button>
                            </div>
                        </h5>
                    </div>
                    {{-- card body --}}
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id="table1">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">No</th>
                                        <th scope="col" class="text-center">No Doc</th>
                                        <th scope="col" class="text-center">Nomor Grading</th>
                                        <th scope="col" class="text-center">Id Box Grading Kasar</th>
                                        <th scope="col" class="text-center">Nomor Batch</th>
                                        <th scope="col" class="text-center">Nama Supplier</th>
                                        <th scope="col" class="text-center">Jenis</th>
                                        <th scope="col" class="text-center">Berat</th>
                                        <th scope="col" class="text-center">Kadar Air</th>
                                        <th scope="col" class="text-center">Jenis Grading</th>
                                        <th scope="col" class="text-center">Berat Grading</th>
                                        <th scope="col" class="text-center">Pcs Grading</th>
                                        <th scope="col" class="text-center">Susut</th>
                                        <th scope="col" class="text-center">Modal</th>
                                        <th scope="col" class="text-center">Total Modal</th>
                                        <th scope="col" class="text-center">Biaya Produksi</th>
                                        <th scope="col" class="text-center">Harga Estimasi</th>
                                        <th scope="col" class="text-center">Total Harga</th>
                                        <th scope="col" class="text-center">Nilai Laba Rugi</th>
                                        <th scope="col" class="text-center">Nilai Prosentase Total Keuntungan</th>
                                        <th scope="col" class="text-center">Nilai Dikurangi Keuntungan</th>
                                        <th scope="col" class="text-center">Prosentase Harga Gramasi</th>
                                        <th scope="col" class="text-center">Selisih Laba Rugi Kg</th>
                                        <th scope="col" class="text-center">Selisih Laba Rugi Gram</th>
                                        <th scope="col" class="text-center">Hpp</th>
                                        <th scope="col" class="text-center">Total Hpp</th>
                                        <th scope="col" class="text-center">Keterangan</th>
                                        <th scope="col" class="text-center">User Created</th>
                                        <th scope="col" class="text-center">User Updated</th>
                                        <th scope="col" class="text-center">Created At</th>
                                        <th scope="col" class="text-center">Updated At</th>
                                        <th scope="col" class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @forelse ($prm_raw_material_inputs as $MasterPRIM)
                                        <tr>
                                            <td class="text-center">{{ $i++ }}</td>
                                            <td class="text-center">{{ $MasterPRIM->doc_no }}</td>
                                            <td class="text-center">{{ $MasterPRIM->nomor_po }}</td>
                                            <td class="text-center">{{ $MasterPRIM->nomor_batch }}</td>
                                            <td class="text-center">{{ $MasterPRIM->nomor_nota_supplier }}</td>
                                            <td class="text-center">{{ $MasterPRIM->nomor_nota_internal }}</td>
                                            <td class="text-center">{{ $MasterPRIM->nama_supplier }}</td>
                                            <td class="text-center">{{ $MasterPRIM->keterangan }}</td>
                                            <td class="text-center">{{ $MasterPRIM->user_created }}</td>
                                            <td class="text-center">{{ $MasterPRIM->user_updated }}</td>
                                            <td class="text-center">{{ $MasterPRIM->created_at }}</td>
                                            <td class="text-center">{{ $MasterPRIM->updated_at }}</td>
                                            <td class="text-center">
                                                <div class="form-button-action">
                                                    <form style="display: flex" id="deleteForm{{ $MasterPRIM->id }}"
                                                        action="{{ route('prm_raw_material_input.destroyInput', $MasterPRIM->id) }}"
                                                        method="POST">
                                                        <a href="{{ route('prm_raw_material_input.show', $MasterPRIM->id) }}"
                                                            class="btn btn-link" title="View" data-original-title="View">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
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
                                            Data Master Supplier Raw Material belum Tersedia.
                                        </div>
                                    @endforelse --}}
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
    function redirectToPage() {
        window.location.href = "{{ url('/transit_grading_kasar/grading_kasar_hasil/create') }}";
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
