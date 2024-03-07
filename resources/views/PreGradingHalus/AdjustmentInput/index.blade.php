@extends('layouts.master1')
@section('menu')
    Pre Grading Halus
@endsection
@section('title')
    Adjustment Input
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card mt-2 border border-primary border-3">
            <div class="card-body">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            <div class="col-sm-12 d-flex justify-content-between">
                                Data Adjustment Input
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
                                        <th scope="col" class="text-center">Nomor Adding</th>
                                        <th scope="col" class="text-center">Pcs Adding</th>
                                        <th scope="col" class="text-center">Jenis Adjustment</th>
                                        <th scope="col" class="text-center">Berat Adjustment</th>
                                        <th scope="col" class="text-center">Pcs Adjustment</th>
                                        <th scope="col" class="text-center">Keterangan</th>
                                        <th scope="col" class="text-center">Modal</th>
                                        <th scope="col" class="text-center">Total Modal</th>
                                        <th scope="col" class="text-center">Ketegori Susut</th>
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
                                        <th scope="col" class="text-center">Fix Total Hpp</th>
                                        <th scope="col" class="text-center">User Created</th>
                                        <th scope="col" class="text-center">User Updated</th>
                                        <th scope="col" class="text-center">Created At</th>
                                        <th scope="col" class="text-center">Updated At</th>
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($adjustment_inputs as $ADJI)
                                        <tr>
                                            <td class="text-center">{{ $i++ }}</td>
                                            <td class="text-center">{{ $ADJI->id_box_grading_halus }}</td>
                                            <td class="text-center">{{ $ADJI->nomor_adjustment }}</td>
                                            <td class="text-center">{{ $ADJI->nomor_batch }}</td>
                                            <td class="text-center">{{ number_format($ADJI->berat_adding, 0, ',', '.') }}
                                            </td>
                                            <td class="text-center">{{ number_format($ADJI->pcs_adding, 0, ',', '.') }}</td>
                                            <td class="text-center">{{ $ADJI->jenis_adjustment }}</td>
                                            <td class="text-center">
                                                {{ number_format($ADJI->berat_adjustment, 0, ',', '.') }}</td>
                                            <td class="text-center">{{ number_format($ADJI->pcs_adjustment, 0, ',', '.') }}
                                            </td>
                                            <td class="text-center">{{ $ADJI->keterangan }}</td>
                                            <td class="text-center">{{ number_format($ADJI->modal, 2, ',', '.') }}</td>
                                            <td class="text-center">{{ number_format($ADJI->total_modal, 2, ',', '.') }}
                                            </td>
                                            <td class="text-center">{{ $ADJI->kategori_susut }}</td>
                                            <td class="text-center">{{ number_format($ADJI->susut_depan, 2, ',', '.') }}
                                            </td>
                                            <td class="text-center">{{ number_format($ADJI->susut_belakang, 2, ',', '.') }}
                                            </td>
                                            <td class="text-center">{{ number_format($ADJI->biaya_produksi, 2, ',', '.') }}
                                            </td>
                                            <td class="text-center">{{ number_format($ADJI->kontribusi, 2, ',', '.') }}
                                            </td>
                                            <td class="text-center">
                                                {{ number_format($ADJI->harga_estimasi, 2, ',', '.') }}</td>
                                            <td class="text-center">{{ number_format($ADJI->total_harga, 2, ',', '.') }}
                                            </td>
                                            <td class="text-center">
                                                {{ number_format($ADJI->nilai_laba_rugi, 2, ',', '.') }}</td>
                                            <td class="text-center">
                                                {{ number_format($ADJI->nilai_prosentase_total_keuntungan, 2, ',', '.') }}
                                            </td>
                                            <td class="text-center">
                                                {{ number_format($ADJI->nilai_dikurangi_keuntungan, 2, ',', '.') }}</td>
                                            <td class="text-center">
                                                {{ number_format($ADJI->prosentase_harga_gramasi, 2, ',', '.') }}</td>
                                            <td class="text-center">
                                                {{ number_format($ADJI->selisih_laba_rugi_kg, 2, ',', '.') }}</td>
                                            <td class="text-center">
                                                {{ number_format($ADJI->selisih_laba_rugi_per_gram, 2, ',', '.') }}</td>
                                            <td class="text-center">{{ number_format($ADJI->hpp, 2, ',', '.') }}</td>
                                            <td class="text-center">{{ number_format($ADJI->total_hpp, 2, ',', '.') }}
                                            </td>
                                            <td class="text-center">{{ number_format($ADJI->fix_total_hpp, 2, ',', '.') }}
                                            </td>
                                            <td class="text-center">{{ $ADJI->user_created }}</td>
                                            <td class="text-center">{{ $ADJI->user_updated }}</td>
                                            <td class="text-center">{{ $ADJI->created_at }}</td>
                                            <td class="text-center">{{ $ADJI->updated_at }}</td>
                                            <td class="text-center">
                                                <div class="form-button-action">
                                                    <form style="display: flex" id="deleteForm{{ $ADJI->id }}"
                                                        action="{{ route('AdjustmentInput.destroy', $ADJI->id) }}"
                                                        method="POST">
                                                        <a href="{{ route('AdjustmentInput.show', $ADJI->id) }}"
                                                            class="btn btn-link" title="View"
                                                            data-original-title="View">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        @csrf
                                                        @method('DELETE')
                                                        {{-- <button type="button" class="btn btn-link"
                                                            data-original-title="Remove"
                                                            onclick="confirmDelete({{ $ADJI->id }})">
                                                            <i class="bi bi-trash3 text-danger"></i>
                                                        </button> --}}
                                                        <button type="button" class="btn btn-link"
                                                            data-original-title="Remove"
                                                            onclick="confirmDelete({{ $ADJI->id }})">
                                                            <i class="bi bi-trash3 text-danger"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <div class="alert alert-danger">
                                            Data Adjustment Input belum Tersedia.
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
            window.location.href = "{{ url('/adjustment_input/create') }}";
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
