@extends('layouts.master1')
@section('menu')
    Report Transit Grading Kasar
@endsection
@section('title')
    Report Transit Grading Kasar
@endsection
@section('content')
    <div class="section">
        <div class="card border border-primary border-3">
            <div class="card-header">
                <div class="col-sm-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Data Report Transit Grading Kasar</span>
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
                                    <th class="text-center">Nomor Job</th>
                                    <th class="text-center">ID Box Grading Kasar</th>
                                    <th class="text-center">Nomor BTSB</th>
                                    <th class="text-center">Nomor Batch</th>
                                    <th class="text-center">Nama Supplier</th>
                                    <th class="text-center">ID Box Raw Material</th>
                                    <th class="text-center">Jenis Raw Material</th>
                                    <th class="text-center">Jenis Grading</th>
                                    <th class="text-center">Berat Keluar</th>
                                    <th class="text-center">PCS Keluar</th>
                                    <th class="text-center">AVG Kadar Air</th>
                                    <th class="text-center">Tujuan Kirim</th>
                                    <th class="text-center">Nomor Grading</th>
                                    @role('admin')
                                        <th class="text-center">Modal</th>
                                        <th class="text-center">Total Modal</th>
                                    @endrole
                                    <th class="text-center">Biaya Produksi</th>
                                    <th class="text-center">Fix Total Modal</th>
                                    <th class="text-center">Keterangan</th>
                                    <th class="text-center">NIP Admin</th>
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

            fetch(`{{ route('ReportGradingKasar.filterT') }}`, {
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
                            item.nomor_job,
                            item.id_box_grading_kasar,
                            item.nomor_bstb,
                            item.nomor_batch,
                            item.nama_supplier,
                            item.id_box_raw_material,
                            item.jenis_raw_material,
                            item.jenis_grading,
                            item.berat_keluar,
                            item.pcs_keluar,
                            item.avg_kadar_air,
                            item.tujuan_kirim,
                            item.nomor_grading,
                            @role('admin')
                                item.modal,
                                    item.total_modal,
                            @endrole
                            item.biaya_produksi,
                            item.fix_total_modal,
                            item.keterangan,
                            item.user_created
                        ]).draw(false);
                    });
                })
                .catch(error => console.error('Error:', error));
        }
    </script>
@endsection
