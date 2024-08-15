@extends('layouts.master1')
@section('menu')
    Final Grading
@endsection
@section('title')
    Final Grading
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card mt-2 border border-primary border-3">
            <div class="card-body">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            <div class="col-sm-12 d-flex justify-content-between">
                                Final Grading
                                <div style="position: absolute;right: 0px;">
                                    <a class="btn btn-outline-warning rounded-pill" style="margin-right: 10px"
                                        onclick="toggleFilter()">
                                        <strong>Filter</strong>
                                    </a>
                                    <button onclick="redirectToPage()" type="button"
                                        class="btn btn-outline-success rounded-pill">
                                        <strong><i class="bi bi-plus-circle"></i> Add Data <i
                                                class="bi bi-plus-circle"></i></strong>
                                    </button>
                                </div>
                            </div>
                        </h5>
                    </div>
                    <div class="card-body" style="overflow: auto;">
                        <div id="filterRow" class="row mb-5 mt-3">
                            <div class="col-4">
                                <label class="form-label">Tanggal Mulai</label>
                                <div class="input-group">
                                    <input type="date" class="form-control " placeholder="Filter by start date..."
                                        id="filterInputStartDate">
                                </div>
                            </div>
                            <div class="col-4">
                                <label class="form-label">Tanggal Akhir</label>
                                <div class="input-group">
                                    <input type="date" class="form-control " placeholder="Filter by end date..."
                                        id="filterInputEndDate">
                                </div>
                            </div>

                            <div class="col-4 mt-3" style="margin-top: 10px">
                                <button type="button" class="btn btn-outline-success rounded-pill" onclick="applyFilter()">
                                    <strong><i class="bi bi-funnel"></i> Apply Filter</strong>
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="table1" class="display data-table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">No</th>
                                        <th scope="col" class="text-center">Nomor Job</th>
                                        <th scope="col" class="text-center">Nomor Batch</th>
                                        <th scope="col" class="text-center">Tujuan Kirim</th>
                                        <th scope="col" class="text-center">Job Order</th>
                                        <th scope="col" class="text-center">Berat Job</th>
                                        <th scope="col" class="text-center">Pcs Job</th>
                                        <th scope="col" class="text-center">Upah Operator</th>
                                        <th scope="col" class="text-center">Nama Operator</th>
                                        <th scope="col" class="text-center">NIP Operator</th>
                                        <th scope="col" class="text-center">Grade Operator</th>
                                        <th scope="col" class="text-center">Nama Team Leader</th>
                                        <th scope="col" class="text-center">Jenis Grading</th>
                                        <th scope="col" class="text-center">Berat Grading</th>
                                        <th scope="col" class="text-center">Pcs Grading</th>
                                        <th scope="col" class="text-center">Rework</th>
                                        <th scope="col" class="text-center">Nomor Job Rework</th>
                                        <th scope="col" class="text-center">Kategori Susut</th>
                                        <th scope="col" class="text-center">Susut Depan</th>
                                        <th scope="col" class="text-center">Susut Belakang</th>
                                        <th scope="col" class="text-center">Modal</th>
                                        <th scope="col" class="text-center">Total Modal</th>
                                        <th scope="col" class="text-center">Biaya Produksi</th>
                                        <th scope="col" class="text-center">Kontribusi</th>
                                        <th scope="col" class="text-center">Harga Estimasi</th>
                                        <th scope="col" class="text-center">Total Harga</th>
                                        <th scope="col" class="text-center">Nilai Laba Rugi</th>
                                        <th scope="col" class="text-center">Nilai Prosentase Total Keuntungan</th>
                                        <th scope="col" class="text-center">Nilai Dikurangi Keuntungan</th>
                                        <th scope="col" class="text-center">Prosentase Harga Gramasi</th>
                                        <th scope="col" class="text-center">Selisih Laba Rugi Kg</th>
                                        <th scope="col" class="text-center">Selisih Laba Rugi per Gram</th>
                                        <th scope="col" class="text-center">Hpp</th>
                                        <th scope="col" class="text-center">Total Hpp</th>
                                        <th scope="col" class="text-center">Fix Hpp</th>
                                        <th scope="col" class="text-center">Fix Total Hpp</th>
                                        <th scope="col" class="text-center">Status</th>
                                        <th scope="col" class="text-center">User Created</th>
                                        <th scope="col" class="text-center">User Updated</th>
                                        <th scope="col" class="text-center">Created At</th>
                                        <th scope="col" class="text-center">Updated At</th>
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($final_grading as $item)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">{{ $item->nomor_job }}</td>
                                            <td class="text-center">{{ $item->nomor_batch }}</td>
                                            <td class="text-center">{{ $item->tujuan_kirim }}</td>
                                            <td class="text-center">{{ $item->job_order }}</td>
                                            <td class="text-center">{{ $item->berat_job }}</td>
                                            <td class="text-center">{{ $item->pcs_job }}</td>
                                            <td class="text-center">{{ $item->upah_operator }}</td>
                                            <td class="text-center">{{ $item->nama_operator }}</td>
                                            <td class="text-center">{{ $item->nip_operator }}</td>
                                            <td class="text-center">{{ $item->grade_operator }}</td>
                                            <td class="text-center">{{ $item->nama_team_leader }}</td>
                                            <td class="text-center">{{ $item->jenis_grading }}</td>
                                            <td class="text-center">{{ $item->berat_grading }}</td>
                                            <td class="text-center">{{ $item->pcs_grading }}</td>
                                            <td class="text-center">{{ $item->rework }}</td>
                                            <td class="text-center">{{ $item->nomor_job_rework }}</td>
                                            <td class="text-center">{{ $item->kategori_susut }}</td>
                                            <td class="text-center">{{ $item->susut_depan }}</td>
                                            <td class="text-center">{{ $item->susut_belakang }}</td>
                                            <td class="text-center">{{ $item->modal }}</td>
                                            <td class="text-center">{{ $item->total_modal }}</td>
                                            <td class="text-center">{{ $item->biaya_produksi }}</td>
                                            <td class="text-center">{{ $item->kontribusi }}</td>
                                            <td class="text-center">{{ $item->harga_estimasi }}</td>
                                            <td class="text-center">{{ $item->total_harga }}</td>
                                            <td class="text-center">{{ $item->nilai_laba_rugi }}</td>
                                            <td class="text-center">{{ $item->nilai_prosentase_total_keuntungan }}</td>
                                            <td class="text-center">{{ $item->nilai_dikurangi_keuntungan }}</td>
                                            <td class="text-center">{{ $item->prosentase_harga_gramasi }}</td>
                                            <td class="text-center">{{ $item->selisih_laba_rugi_kg }}</td>
                                            <td class="text-center">{{ $item->selisih_laba_rugi_per_gram }}</td>
                                            <td class="text-center">{{ $item->hpp }}</td>
                                            <td class="text-center">{{ $item->total_hpp }}</td>
                                            <td class="text-center">{{ $item->fix_hpp }}</td>
                                            <td class="text-center">{{ $item->fix_total_hpp }}</td>
                                            <td class="text-center">{{ $item->status }}</td>
                                            <td class="text-center">{{ $item->user_created }}</td>
                                            <td class="text-center">{{ $item->user_updated }}</td>
                                            <td class="text-center">{{ $item->created_at }}</td>
                                            <td class="text-center">
                                                {{ $item->created_at != $item->updated_at ? $item->updated_at : '' }}
                                            </td>
                                            <td class="text-center">
                                                <div class="form-button-action">
                                                    @if ($item->can_delete())
                                                        <form style="display: flex" id="deleteForm{{ $item->id }}"
                                                            action="{{ route('FinalGrading.destroy', $item->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-link"
                                                                data-original-title="Remove"
                                                                onclick="confirmDelete('{{ $item->id }}')">
                                                                <i class="bi bi-trash3 text-danger"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <div class="alert alert-danger">
                                            Data Final Grading belum Tersedia.
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
        function toggleFilter() {
            var filterRow = document.getElementById('filterRow');
            if (filterRow.style.display === 'none' || filterRow.style.display === '') {
                filterRow.style.display = 'flex';
            } else {
                filterRow.style.display = 'none';
            }
        }

        function applyFilter() {

            const start_date = document.getElementById('filterInputStartDate').value;
            const end_date = document.getElementById('filterInputEndDate').value;

            const filters = {
                start_date: start_date,
                end_date: end_date,
            };
            var url = '{{ route('FinalGrading.index') }}';

            // url = url.replace(':slug', slug);
            url = url + '?start_date=' + start_date + '&end_date=' + end_date;
            window.location.href = url;

        }

        function redirectToPage() {
            window.location.href = "{{ route('FinalGrading.create') }}";
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
