@extends('layouts.master1')
@section('menu')
    Pre-Cleaning
@endsection
@section('title')
    Data Pre-Cleaning Input Report
@endsection
@section('content')
    <div class="section">
        <div class="card border border-primary border-3">
            <div class="card-header">
                <div class="col-sm-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Data Pre-Cleaning Input Report</h4>
                            </div>
                        </div>
                        <div>
                            <button type="button" class="btn btn-outline-warning rounded-pill" onclick="toggleFilter()">
                                <strong><i class="bi bi-filter-square"></i> Filter</strong>
                            </button>
                            <button type="button" class="btn btn-outline-danger rounded-pill" onclick="goBack()">
                                <strong><i class="bi bi-arrow-left-square"></i> Back</strong>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body" style="overflow: auto;">
                <div id="filterRow" class="row mb-5 mt-3">
                    <div class="col-4">
                        <label class="form-label">Bulan Mulai</label>
                        <div class="input-group">
                            <input type="month" class="form-control " placeholder="Filter by start month..."
                                id="filterInputStartMonth">
                        </div>
                    </div>
                    <div class="col-4">
                        <label class="form-label">Bulan Akhir</label>
                        <div class="input-group">
                            <input type="month" class="form-control " placeholder="Filter by end month..."
                                id="filterInputEndMonth">
                        </div>
                    </div>
                    <div class="col-4">
                        <label class="form-label">Jenis</label>
                        <div class="input-group">
                            <select class="form-select select2 " style="width: 100%;" name="jenis"
                                data-placeholder="Pilih jenis" id="filterInputType">
                                <option value="">Pilih jenis</option>
                                @foreach ($PreCleaningInput as $item)
                                    <option value="{{ $item->jenis_raw_material }}">
                                        {{ $item->jenis_raw_material }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <button type="button" class="btn btn-outline-success rounded-pill" onclick="applyFilter()">
                            <strong><i class="bi bi-funnel"></i> Apply Filter</strong>
                        </button>
                    </div>
                </div>

                <div class="card-body" style="overflow: auto;">
                    <div class="table-responsive">
                        <table id="table1" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col">No</th>
                                    <th class="text-center" scope="col">Nomor Doc</th>
                                    <th class="text-center" scope="col">Nomor Job</th>
                                    <th class="text-center" scope="col">ID Box Grading Kasar</th>
                                    <th class="text-center" scope="col">Nomor BTSB</th>
                                    <th class="text-center" scope="col">Nomor Batch</th>
                                    <th class="text-center" scope="col">Nama Supplier</th>
                                    <th class="text-center" scope="col">Nomor Nota Internal</th>
                                    <th class="text-center" scope="col">ID Box Raw Material</th>
                                    <th class="text-center" scope="col">Jenis Raw Material</th>
                                    <th class="text-center" scope="col">Jenis Kirim</th>
                                    <th class="text-center" scope="col">Berat Kirim</th>
                                    <th class="text-center" scope="col">PCS Kirim</th>
                                    <th class="text-center" scope="col">Kadar Air</th>
                                    <th class="text-center" scope="col">Tujuan Kirim</th>
                                    <th class="text-center" scope="col">Nomor Grading</th>
                                    <th class="text-center" scope="col">Modal</th>
                                    <th class="text-center" scope="col">Total Modal</th>
                                    <th class="text-center" scope="col">Keterangan</th>
                                    <th class="text-center" scope="col">NIP Admin</th>
                                    <th class="text-center" scope="col">User Updated</th>
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
            window.location.href = "{{ route('PreCleaningReport.index') }}";
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
            const startMonth = $('#filterInputStartMonth').val();
            const endMonth = $('#filterInputEndMonth').val();
            const type = $('#filterInputType').val();

            const filters = {
                startMonth: startMonth,
                endMonth: endMonth,
                type: type
            };

            $.ajax({
                url: '{{ route('PreCleaningReport.inputFilter') }}',
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: JSON.stringify(filters),
                success: function(data) {
                    const table = $('#table1').DataTable();
                    table.clear().draw(); // Bersihkan data tabel sebelumnya

                    data.forEach((item, index) => {
                        table.row.add([
                            index + 1,
                            item.doc_no,
                            item.nomor_job,
                            item.id_box_grading_kasar,
                            item.nomor_bstb,
                            item.nomor_batch,
                            item.nama_supplier,
                            item.nomor_nota_internal,
                            item.id_box_raw_material,
                            item.jenis_raw_material,
                            item.jenis_kirim,
                            item.berat_kirim,
                            item.pcs_kirim,
                            item.kadar_air,
                            item.tujuan_kirim,
                            item.nomor_grading,
                            parseFloat(item.modal).toLocaleString('id-ID', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            }),
                            parseFloat(item.total_modal).toLocaleString('id-ID', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            }),
                            item.keterangan,
                            item.user_created,
                            item.user_updated
                        ]).draw(false);
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }

        function confirmDelete(id) {
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Anda yakin ingin menghapus data ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
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
