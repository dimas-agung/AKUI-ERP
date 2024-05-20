@extends('layouts.master1')
@section('menu')
    Pre Grading Halus
@endsection
@section('title')
    Grading Halus Adjustment Input
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card mt-2 border border-primary border-3">
            <div class="card-body">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            <div class="col-sm-12 d-flex justify-content-between">
                                Data Grading Halus Adjustment Input
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
                                        <th scope="col" class="text-center">ID Box Grading Halus</th>
                                        <th scope="col" class="text-center">Nomor Adjustment</th>
                                        <th scope="col" class="text-center">Nomor Batch</th>
                                        <th scope="col" class="text-center">Berat Adding</th>
                                        <th scope="col" class="text-center">Pcs Adding</th>
                                        <th scope="col" class="text-center">Jenis Adjustment</th>
                                        <th scope="col" class="text-center">Berat Adjustment</th>
                                        <th scope="col" class="text-center">Pcs Adjustment</th>
                                        <th scope="col" class="text-center">Keterangan</th>
                                        @role('admin')
                                            <th scope="col" class="text-center">Modal</th>
                                            <th scope="col" class="text-center">Total Modal</th>
                                        @endrole
                                        <th scope="col" class="text-center">Ketegori Susut</th>
                                        @role('admin')
                                            <th scope="col" class="text-center">Susut Depan</th>
                                            <th scope="col" class="text-center">Susut Belakang</th>
                                            <th scope="col" class="text-center">Biaya Produksi</th>
                                            <th scope="col" class="text-center">Kontribusi</th>
                                            <th scope="col" class="text-center">Harga Estimasi</th>
                                            <th scope="col" class="text-center">Total Harga</th>
                                            <th scope="col" class="text-center">Nilai Laba Rugi</th>
                                            <th scope="col" class="text-center">Nilai Prosentase Total Keuntungan</th>
                                            <th scope="col" class="text-center">Nilai Dikurangi Keuntungan</th>
                                            <th scope="col" class="text-center">Prosentase Harga Gramasi</th>
                                            <th scope="col" class="text-center">Selisih Labah Rugi Kg</th>
                                            <th scope="col" class="text-center">Selisih Labah Rugi Per Gram</th>
                                            <th scope="col" class="text-center">Hpp</th>
                                            <th scope="col" class="text-center">Total Hpp</th>
                                            <th scope="col" class="text-center">Fix Hpp</th>
                                            <th scope="col" class="text-center">Fix Total Hpp</th>
                                        @endrole
                                        <th scope="col" class="text-center">User Created</th>
                                        <th scope="col" class="text-center">User Updated</th>
                                        <th scope="col" class="text-center">Created At</th>
                                        <th scope="col" class="text-center">Updated At</th>
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($adjustment_inputs as $item)
                                        <tr>
                                            <td class="text-center">{{ $i++ }}</td>
                                            <td class="text-center">{{ $item->id_box_grading_halus }}</td>
                                            <td class="text-center">{{ $item->nomor_adjustment }}</td>
                                            <td class="text-center">{{ $item->nomor_batch }}</td>
                                            <td class="text-center">{{ $item->berat_adding }}
                                            </td>
                                            <td class="text-center">{{ $item->pcs_adding }}</td>
                                            <td class="text-center">{{ $item->jenis_adjustment }}</td>
                                            <td class="text-center">
                                                {{ $item->berat_adjustment }}</td>
                                            <td class="text-center">{{ $item->pcs_adjustment }}
                                            </td>
                                            <td class="text-center">{{ $item->keterangan }}</td>
                                            @role('admin')
                                                <td class="text-center">{{ number_format($item->modal, 2, ',', '.') }}</td>
                                                <td class="text-center">{{ number_format($item->total_modal, 2, ',', '.') }}
                                                </td>
                                            @endrole
                                            <td class="text-center">{{ $item->kategori_susut }}</td>
                                            @role('admin')
                                                <td class="text-center">{{ number_format($item->susut_depan, 2, ',', '.') }}
                                                </td>
                                                <td class="text-center">
                                                    {{ number_format($item->susut_belakang, 2, ',', '.') }}
                                                </td>
                                                <td class="text-center">
                                                    {{ number_format($item->biaya_produksi, 2, ',', '.') }}
                                                </td>
                                                <td class="text-center">{{ number_format($item->kontribusi, 2, ',', '.') }}
                                                </td>
                                                <td class="text-center">
                                                    {{ number_format($item->harga_estimasi, 2, ',', '.') }}</td>
                                                <td class="text-center">{{ number_format($item->total_harga, 2, ',', '.') }}
                                                </td>
                                                <td class="text-center">
                                                    {{ number_format($item->nilai_laba_rugi, 2, ',', '.') }}</td>
                                                <td class="text-center">
                                                    {{ number_format($item->nilai_prosentase_total_keuntungan, 2, ',', '.') }}
                                                </td>
                                                <td class="text-center">
                                                    {{ number_format($item->nilai_dikurangi_keuntungan, 2, ',', '.') }}</td>
                                                <td class="text-center">
                                                    {{ number_format($item->prosentase_harga_gramasi, 2, ',', '.') }}</td>
                                                <td class="text-center">
                                                    {{ number_format($item->selisih_laba_rugi_kg, 2, ',', '.') }}</td>
                                                <td class="text-center">
                                                    {{ number_format($item->selisih_laba_rugi_per_gram, 2, ',', '.') }}</td>
                                                <td class="text-center">{{ number_format($item->hpp, 2, ',', '.') }}</td>
                                                <td class="text-center">{{ number_format($item->total_hpp, 2, ',', '.') }}
                                                </td>
                                                <td class="text-center">{{ number_format($item->fix_hpp, 2, ',', '.') }}
                                                </td>
                                                <td class="text-center">{{ number_format($item->fix_total_hpp, 2, ',', '.') }}
                                                </td>
                                            @endrole
                                            <td class="text-center">{{ $item->user_created }}</td>
                                            <td class="text-center">{{ $item->user_updated }}</td>
                                            <td class="text-center">{{ $item->created_at }}</td>
                                            <td class="text-center">
                                                {{ $item->created_at != $item->updated_at ? $item->updated_at : '' }}
                                            </td>
                                            <td class="text-center">
                                                <div class="form-button-action">
                                                    <form style="display: flex" id="deleteForm{{ $item->id }}"
                                                        action="{{ route('GradingHalusAdjustmentInput.destroy', $item->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-link"
                                                            data-original-title="Remove"
                                                            onclick="confirmDelete({{ $item->id }})">
                                                            <i class="bi bi-trash3 text-danger"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <div class="alert alert-danger">
                                            Data Grading Halus Adjustment Input belum Tersedia.
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
            window.location.href = "{{ route('GradingHalusAdjustmentInput.create') }}";
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
