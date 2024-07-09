@extends('layouts.master1')
@section('menu')
    Dry A
@endsection
@section('title')
    Dry A Grading Cabut
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card mt-2 border border-primary border-3">
            <div class="card-body">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            <div class="col-sm-12 d-flex justify-content-between">
                                Data Dry A Grading Cabut
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
                                        <th scope="col" class="text-center">Nama Operator</th>
                                        <th scope="col" class="text-center">Nip Operator</th>
                                        <th scope="col" class="text-center">Grade Operator</th>
                                        <th scope="col" class="text-center">Nama Team Leader</th>
                                        @role('admin')
                                            <th scope="col" class="text-center">Modal</th>
                                            <th scope="col" class="text-center">Total Modal</th>
                                            <th scope="col" class="text-center">Upah Operator</th>
                                        @endrole
                                        <th scope="col" class="text-center">Jenis Grading</th>
                                        <th scope="col" class="text-center">Berat 1 Grading</th>
                                        <th scope="col" class="text-center">Pcs 1 Grading</th>
                                        <th scope="col" class="text-center">Berat 2 Grading</th>
                                        <th scope="col" class="text-center">Kategori Susut</th>
                                        <th scope="col" class="text-center">Susut Depan</th>
                                        <th scope="col" class="text-center">Susut Belakang</th>
                                        @role('admin')
                                            <th scope="col" class="text-center">Biaya Produksi</th>
                                            <th scope="col" class="text-center">Kontribusi</th>
                                            <th scope="col" class="text-center">Harga Estimasi</th>
                                            <th scope="col" class="text-center">Total Harga</th>
                                            <th scope="col" class="text-center">Nilai Laba Rugi</th>
                                            <th scope="col" class="text-center">Nilai Prosentase Total Keuntungan</th>
                                            <th scope="col" class="text-center">Nilai Dikurangi Keuntungan</th>
                                            <th scope="col" class="text-center">Prosentase Harga Gramasi</th>
                                            <th scope="col" class="text-center">Selisi Laba Rugi Kg</th>
                                            <th scope="col" class="text-center">selisi aba Rugi Per Gram</th>
                                            <th scope="col" class="text-center">Hpp</th>
                                            <th scope="col" class="text-center">Total Hpp</th>
                                        @endrole
                                        <th scope="col" class="text-center">User Created</th>
                                        <th scope="col" class="text-center">User Updated</th>
                                        <th scope="col" class="text-center">Created At</th>
                                        <th scope="col" class="text-center">Updated At</th>
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($dry_a_grading_cabut as $item)
                                        @if ($item->tujuan_kirim != Auth::user()->plant)
                                            @php
                                                continue;
                                            @endphp
                                        @endif
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">{{ $item->nomor_job }}</td>
                                            <td class="text-center">{{ $item->nomor_batch }}</td>
                                            <td class="text-center">{{ $item->jenis_job }}</td>
                                            <td class="text-center">{{ $item->berat_job }}</td>
                                            <td class="text-center">{{ $item->pcs_job }}</td>
                                            <td class="text-center">{{ $item->tujuan_kirim }}</td>
                                            <td class="text-center">{{ $item->nama_operator }}</td>
                                            <td class="text-center">{{ $item->nip_operator }}</td>
                                            <td class="text-center">{{ $item->grade_operator }}</td>
                                            <td class="text-center">{{ $item->nama_team_leader }}</td>
                                            @role('admin')
                                                <td class="text-center">
                                                    {{ number_format($item->modal, 1, ',', '.') }}
                                                </td>
                                                <td class="text-center">
                                                    {{ number_format($item->total_modal, 1, ',', '.') }}
                                                </td>
                                                <td class="text-center">
                                                    {{ number_format($item->upah_operator, 1, ',', '.') }}
                                                </td>
                                            @endrole
                                            <td class="text-center">{{ $item->jenis_grading }}</td>
                                            <td class="text-center">{{ $item->berat_1_grading }}</td>
                                            <td class="text-center">{{ $item->pcs_1_grading }}</td>
                                            <td class="text-center">{{ $item->berat_2_grading }}</td>
                                            <td class="text-center">{{ $item->kategori_susut }}</td>
                                            <td class="text-center">{{ $item->susut_depan }}</td>
                                            <td class="text-center">{{ $item->susut_belakang }}</td>
                                            {{-- <td class="text-center">{{ $item->susut_belakang }}</td> --}}
                                            @role('admin')
                                                <td class="text-center">
                                                    {{ number_format(floor($item->biaya_produksi), 1, ',', '.') }}
                                                </td>
                                                <td class="text-center">
                                                    {{ number_format($item->kontribusi, 1, ',', '.') }}
                                                </td>
                                                <td class="text-center">
                                                    {{ number_format($item->harga_estimasi, 1, ',', '.') }}
                                                </td>
                                                <td class="text-center">
                                                    {{ number_format($item->total_harga, 1, ',', '.') }}
                                                </td>
                                                <td class="text-center">
                                                    {{ number_format($item->nilai_laba_rugi, 1, ',', '.') }}
                                                </td>
                                                <td class="text-center">
                                                    {{ number_format($item->nilai_prosentase_total_keuntungan, 1, ',', '.') }}
                                                </td>
                                                <td class="text-center">
                                                    {{ number_format($item->nilai_dikurangi_keuntungan, 1, ',', '.') }}
                                                </td>
                                                <td class="text-center">
                                                    {{ number_format($item->prosentase_harga_gramasi, 1, ',', '.') }}
                                                </td>
                                                <td class="text-center">
                                                    {{ number_format($item->selisih_laba_rugi_kg, 1, ',', '.') }}
                                                </td>
                                                <td class="text-center">
                                                    {{ number_format($item->selisih_laba_rugi_per_gram, 1, ',', '.') }}
                                                </td>
                                                <td class="text-center">
                                                    {{ number_format($item->hpp, 1, ',', '.') }}
                                                </td>
                                                <td class="text-center">
                                                    {{ number_format($item->total_hpp, 1, ',', '.') }}
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
                                                    @if ($item->status == 1)
                                                        <form style="display: flex" id="deleteForm{{ $item->nomor_job }}"
                                                            action="{{ route('DryAGradingCabut.destroy', $item->nomor_job) }}"
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
                                            Data Dry A Grading Cabut belum Tersedia.
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
            var url = '{{ route('DryAGradingCabut.index') }}';

            // url = url.replace(':slug', slug);
            url = url + '?start_date=' + start_date + '&end_date=' + end_date;
            window.location.href = url;

        }

        function redirectToPage() {
            window.location.href = "{{ route('DryAGradingCabut.create') }}";
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
