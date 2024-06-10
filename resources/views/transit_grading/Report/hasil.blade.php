@extends('layouts.master1')
@section('menu')
    Report Hasil Grading Kasar
@endsection
@section('title')
    Report Hasil Grading Kasar
@endsection
@section('content')
    <div class="section">
        <div class="card border border-primary border-3">
            <div class="card-header">
                <div class="col-sm-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Data Report Hasil Grading Kasar</span>
                        <div>
                            <button type="button" class="btn btn-outline-warning rounded-pill" onclick="toggleFilter()">
                                <strong>Filter</strong>
                            </button>
                            <button type="button" class="btn btn-outline-danger rounded-pill" onclick="goBack()">
                                <strong>Back</strong>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body" style="overflow: auto;">
                <div id="filterRow" class="row mb-5 mt-3">
                    <div class="col-4">
                        <div class="input-group">
                            <input type="month" class="form-control rounded-pill" placeholder="Filter by start month..."
                                id="filterInputStartMonth">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="input-group">
                            <input type="month" class="form-control rounded-pill" placeholder="Filter by end month..."
                                id="filterInputEndMonth">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="input-group">
                            <input type="text" class="form-control rounded-pill" placeholder="Masukan Jenis"
                                id="filterInputType">
                        </div>
                    </div>
                    <div class="col-4">
                        <button type="button" class="btn btn-outline-success rounded-pill ms-2" onclick="applyFilter()">
                            <strong><i class="bi bi-funnel"></i> Filter</strong>
                        </button>
                    </div>
                </div>

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
                                    <th scope="col" class="text-center">Created At</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function goBack() {
            window.location.href = "{{ route('ReportGradingKasar.index') }}";
        }

        function toggleFilter() {
            var filterRow = document.getElementById('filterRow');
            if (filterRow.style.display === 'none' || filterRow.style.display === '') {
                filterRow.style.display = 'flex';
            } else {
                filterRow.style.display = 'none';
            }
        }

        function applyFilter() {
            const year = document.getElementById('filterInputYear').value;
            const startMonth = document.getElementById('filterInputStartMonth').value;
            const endMonth = document.getElementById('filterInputEndMonth').value;
            const type = document.getElementById('filterInputType').value;

            const filters = {
                year: year,
                startMonth: startMonth,
                endMonth: endMonth,
                type: type
            };

            fetch(`{{ route('ReportGradingKasar.filterH') }}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(filters)
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok ' + response.statusText);
                    }
                    return response.json();
                })
                .then(data => {
                    const table = $('#table1').DataTable();
                    table.clear().draw(); // Bersihkan data tabel sebelumnya

                    data.forEach((item, index) => {
                        table.row.add([
                            index + 1,
                            item.doc_no,
                            item.nomor_grading,
                            item.id_box_raw_material,
                            item.id_box_grading_kasar,
                            item.nomor_batch,
                            item.nama_supplier,
                            item.nomor_nota_internal,
                            item.jenis_raw_material,
                            item.berat,
                            item.kadar_air,
                            item.jenis_grading,
                            item.berat_grading,
                            item.susut,
                            item.modal,
                            item.total_modal,
                            item.biaya_produksi,
                            item.harga_estimasi,
                            item.total_harga,
                            item.nilai_laba_rugi,
                            item.nilai_prosentase_total_keuntungan,
                            item.nilai_dikurangi_keuntungan,
                            item.prosentase_harga_gramasi,
                            item.selisih_laba_rugi_kg,
                            item.selisih_laba_rugi_gram,
                            item.hpp,
                            item.total_hpp,
                            item.keterangan,
                            item.user_created,
                            item.created_at
                        ]).draw(false);
                    });
                })
                .catch(error => console.error('Error:', error));
        }
    </script>
@endsection
