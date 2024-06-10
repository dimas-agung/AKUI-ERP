@extends('layouts.master1')
@section('menu')
    Report Input Grading Kasar
@endsection
@section('title')
    Report Input Grading Kasar
@endsection
@section('content')
    {{-- <div class="col-md-12">
        <div class="card border border-primary border-3">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Report Input Grading Kasar</h4>
                </div>
            </div>
            <div class="card-body" style="overflow: auto;">
                <div class="table-responsive">
                    <table id="table1" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">No</th>
                                <th class="text-center" scope="col">Nomor BSTB</th>
                                <th class="text-center" scope="col">Nomor Batch</th>
                                <th class="text-center" scope="col">Id Box</th>
                                <th class="text-center">Nama Supplier</th>
                                <th class="text-center">Jenis Raw Material</th>
                                <th class="text-center">Berat</th>
                                <th class="text-center">Kadar Air</th>
                                <th class="text-center">Nomor Grading</th>
                                @role('admin')
                                    <!-- Jika pengguna adalah admin -->
                                    <th class="text-center">Modal</th>
                                    <th class="text-center">Total Modal</th>
                                @endrole
                                <th class="text-center" scope="col">Keterangan</th>
                                <th class="text-center" scope="col">NIP Admin</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($GradingKI as $item)
                                <tr>
                                    <td class="text-center">{{ $i++ }}</td>
                                    <td class="text-center">{{ $item->nomor_bstb }}</td>
                                    <td class="text-center">{{ $item->nomor_batch }}</td>
                                    <td class="text-center">{{ $item->id_box }}</td>
                                    <td class="text-center">{{ $item->nama_supplier }}</td>
                                    <td class="text-center">{{ $item->jenis_raw_material }}</td>
                                    <td class="text-center">{{ $item->berat }}</td>
                                    <td class="text-center">{{ $item->kadar_air }}</td>
                                    <td class="text-center">{{ $item->nomor_grading }}</td>
                                    @role('admin')
                                        <!-- Jika pengguna adalah admin -->
                                        <td class="text-center">{{ number_format($item->modal, 2, ',', '.') }}</td>
                                        <td class="text-center">{{ number_format($item->total_modal, 2, ',', '.') }}</td>
                                    @endrole
                                    <td class="text-center">{{ $item->keterangan }}</td>
                                    <td class="text-center">{{ $item->user_created }}</td>
                                    <td class="text-center">
                                        <div class="form-button-action">
                                            @php
                                                $gradingKasarHasilCount = $GradingKH
                                                    ? $GradingKH
                                                        ->where('id_box_raw_material', $item->id_box)
                                                        ->where('nomor_grading', $item->nomor_grading)
                                                        ->count()
                                                    : 0;
                                            @endphp

                                            @if ($gradingKasarHasilCount == 0)
                                                <form style="display: flex" id="deleteForm{{ $item->nomor_bstb }}"
                                                    action="{{ route('GradingKasarInput.destroy', $item->nomor_bstb) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-link btn-danger"
                                                        data-original-title="Remove"
                                                        onclick="confirmDelete('{{ $item->nomor_bstb }}')">
                                                        <i class="bi bi-trash3 text-danger"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <div class="alert alert-danger">
                                    Data Grading Kasar Input belum Tersedia.
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="section">
        <div class="card border border-primary border-3">
            <div class="card-header">
                <div class="col-sm-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Data Report Input Grading Kasar</span>
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
                                    <th class="text-center">No</th>
                                    <th class="text-center">Nomor BSTB</th>
                                    <th class="text-center">Nomor Batch</th>
                                    <th class="text-center">Id Box</th>
                                    <th class="text-center">Nama Supplier</th>
                                    <th class="text-center">Jenis Raw Material</th>
                                    <th class="text-center">Berat</th>
                                    <th class="text-center">Kadar Air</th>
                                    <th class="text-center">Nomor Grading</th>
                                    @role('admin')
                                        <th class="text-center">Modal</th>
                                        <th class="text-center">Total Modal</th>
                                    @endrole
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

            fetch(`{{ route('ReportGradingKasar.filter') }}`, {
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
                            item.nomor_bstb,
                            item.nomor_batch,
                            item.id_box,
                            item.nama_supplier,
                            item.jenis_raw_material,
                            item.berat,
                            item.kadar_air,
                            item.nomor_grading,
                            @role('admin')
                                item.modal,
                                    item.total_modal,
                            @endrole
                            item.keterangan,
                            item.user_created
                        ]).draw(false);
                    });
                })
                .catch(error => console.error('Error:', error));
        }
    </script>
@endsection
