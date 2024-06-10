@extends('layouts.master1')
@section('menu')
    Pre-Cleaning
@endsection
@section('title')
    Data Pre-Cleaning Output Report
@endsection
@section('content')
    <div class="section">
        <div class="card border border-primary border-3">
            <div class="card-header">
                <div class="col-sm-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Data Pre-Cleaning Output Report</h4>
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
                                @foreach ($PreCleaningOutput as $item)
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
                                    <th scope="col" class="text-center">No</th>
                                    <th scope="col" class="text-center">Nomor Job</th>
                                    <th scope="col" class="text-center">ID Box Grading Kasar</th>
                                    <th scope="col" class="text-center">Nomor BSTB</th>
                                    <th scope="col" class="text-center">ID Box Raw Material</th>
                                    <th scope="col" class="text-center">Nomor Batch</th>
                                    <th scope="col" class="text-center">Nomor Nota Internal</th>
                                    <th scope="col" class="text-center">Nama Supplier</th>
                                    <th scope="col" class="text-center">Jenis Raw Material</th>
                                    <th scope="col" class="text-center">Jenis Kirim</th>
                                    <th scope="col" class="text-center">Berat Kirim</th>
                                    <th scope="col" class="text-center">Pcs Kirim</th>
                                    <th scope="col" class="text-center">Modal</th>
                                    <th scope="col" class="text-center">Total Modal</th>
                                    <th scope="col" class="text-center">Operator Flek & Kompresor</th>
                                    <th scope="col" class="text-center">Operator Flek & Poles</th>
                                    <th scope="col" class="text-center">Operator Cutter</th>
                                    <th scope="col" class="text-center">Kuningan</th>
                                    <th scope="col" class="text-center">Sterofoam</th>
                                    <th scope="col" class="text-center">Karat</th>
                                    <th scope="col" class="text-center">Rontokan Fisik</th>
                                    <th scope="col" class="text-center">Rontokan Bahan</th>
                                    <th scope="col" class="text-center">Rontokan Serabut</th>
                                    <th scope="col" class="text-center">WS-0-0-0</th>
                                    <th scope="col" class="text-center">Berat Pre Cleaning</th>
                                    <th scope="col" class="text-center">Pcs</th>
                                    <th scope="col" class="text-center">Susut</th>
                                    <th scope="col" class="text-center">User Created</th>
                                    <th scope="col" class="text-center">User Updated</th>
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
                url: '{{ route('PreCleaningReport.outputFilter') }}',
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
                            item.nomor_job,
                            item.id_box_grading_kasar,
                            item.nomor_bstb,
                            item.id_box_raw_material,
                            item.nomor_batch,
                            item.nomor_nota_internal,
                            item.nama_supplier,
                            item.jenis_raw_material,
                            item.jenis_kirim,
                            item.berat_kirim,
                            item.pcs_kirim,
                            // item.modal,
                            // item.total_modal,
                            parseFloat(item.modal).toLocaleString('id-ID', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            }),
                            parseFloat(item.total_modal).toLocaleString('id-ID', {
                                minimumFractionDigits: 2,
                                maximumFractionDigits: 2
                            }),
                            item.operator_sikat_n_kompresor,
                            item.operator_flek_n_poles,
                            item.operator_cutter,
                            item.kuningan,
                            item.sterofoam,
                            item.karat,
                            item.rontokan_flek,
                            item.rontokan_bahan,
                            item.rontokan_serabut,
                            item.ws_0_0_0,
                            item.berat_pre_cleaning,
                            item.pcs_pre_cleaning,
                            item.susut,
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
