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
                                    <strong><i class="bi bi-plus-circle"></i> Add Data <i
                                            class="bi bi-plus-circle"></i></strong>
                                </button>
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
                                        <th scope="col" class="text-center">No Doc</th>
                                        <th scope="col" class="text-center">Nomor Grading</th>
                                        <th scope="col" class="text-center">Id Box Raw Material</th>
                                        <th scope="col" class="text-center">Id Box Grading Kasar</th>
                                        <th scope="col" class="text-center">Nomor Batch</th>
                                        <th scope="col" class="text-center">Nama Supplier</th>
                                        <th scope="col" class="text-center">Status</th>
                                        <th scope="col" class="text-center">Nomor Nota Internal</th>
                                        <th scope="col" class="text-center">Jenis Raw Material</th>
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
                                    @forelse ($grading_kasar_hasils as $GradingKH)
                                        <tr>
                                            <td class="text-center">{{ $i++ }}</td>
                                            <td class="text-center">{{ $GradingKH->doc_no }}</td>
                                            <td class="text-center">{{ $GradingKH->nomor_grading }}</td>
                                            <td class="text-center">{{ $GradingKH->id_box_raw_material }}</td>
                                            <td class="text-center">{{ $GradingKH->id_box_grading_kasar }}</td>
                                            <td class="text-center">{{ $GradingKH->nomor_batch }}</td>
                                            <td class="text-center">{{ $GradingKH->nama_supplier }}</td>
                                            <td class="text-center">
                                                @if ($GradingKH->status == 1)
                                                    <span>Aktif</span>
                                                @elseif($GradingKH->status == 0)
                                                    <span class="badge badge-secondary"
                                                        style="text-shadow: 1px 1px 6px #000000;">Tidak Aktif</span>
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $GradingKH->nomor_nota_internal }}</td>
                                            <td class="text-center">{{ $GradingKH->jenis_raw_material }}</td>
                                            <td class="text-center">{{ $GradingKH->berat }}</td>
                                            <td class="text-center">{{ $GradingKH->kadar_air }}</td>
                                            <td class="text-center">{{ $GradingKH->jenis_grading }}</td>
                                            <td class="text-center">{{ $GradingKH->berat_grading }}</td>
                                            <td class="text-center">{{ $GradingKH->pcs_grading }}</td>
                                            <td class="text-center">{{ $GradingKH->susut }}</td>
                                            <td class="text-center">{{ $GradingKH->modal }}</td>
                                            <td class="text-center">{{ $GradingKH->total_modal }}</td>
                                            <td class="text-center">{{ $GradingKH->biaya_produksi }}</td>
                                            <td class="text-center">{{ $GradingKH->harga_estimasi }}</td>
                                            <td class="text-center">{{ $GradingKH->total_harga }}</td>
                                            <td class="text-center">{{ $GradingKH->nilai_laba_rugi }}</td>
                                            <td class="text-center">{{ $GradingKH->nilai_prosentase_total_keuntungan }}
                                            </td>
                                            <td class="text-center">{{ $GradingKH->nilai_dikurangi_keuntungan }}</td>
                                            <td class="text-center">{{ $GradingKH->prosentase_harga_gramasi }}</td>
                                            <td class="text-center">{{ $GradingKH->selisih_laba_rugi_kg }}</td>
                                            <td class="text-center">{{ $GradingKH->selisih_laba_rugi_gram }}</td>
                                            <td class="text-center">{{ $GradingKH->hpp }}</td>
                                            <td class="text-center">{{ $GradingKH->total_hpp }}</td>
                                            <td class="text-center">{{ $GradingKH->keterangan }}</td>
                                            <td class="text-center">{{ $GradingKH->user_created }}</td>
                                            <td class="text-center">{{ $GradingKH->user_updated }}</td>
                                            <td class="text-center">{{ $GradingKH->created_at }}</td>
                                            <td class="text-center">{{ $GradingKH->updated_at }}</td>
                                            <td class="text-center">
                                                <div class="form-button-action">
                                                    @if ($GradingKH->status == 1)
                                                        <form style="display: flex" id="deleteForm{{ $GradingKH->id }}"
                                                            action="{{ route('GradingKasarHasil.destroyInput', $GradingKH->id) }}"
                                                            method="POST">
                                                            <a href="{{ route('GradingKasarHasil.show', $GradingKH->id) }}"
                                                                class="btn btn-link" title="View"
                                                                data-original-title="View">
                                                                <i class="bi bi-eye"></i>
                                                            </a>
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-link"
                                                                data-original-title="Remove"
                                                                onclick="confirmDelete({{ $GradingKH->id }})">
                                                                <i class="bi bi-trash3 text-danger"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <div class="alert alert-danger">
                                            Data Grading Kasar Hasil belum Tersedia.
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
    function redirectToPage() {
        window.location.href = "{{ Route('GradingKasarHasil.create') }}";
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
