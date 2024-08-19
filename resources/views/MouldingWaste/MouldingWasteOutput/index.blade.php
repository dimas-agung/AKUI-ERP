@extends('layouts.master1')
@section('menu')
    Moulding Waste
@endsection
@section('title')
    Moulding Waste Output
@endsection
@section('content')
    <div class="section">
        <div class="card border border-primary border-3">
            <div class="card-header">
                <div class="col-sm-12 d-flex justify-content-between">
                    <h4 class="card-title">Data Moulding Waste Output</h4>
                    <div style="position: absolute;right: 25px;">
                        <a class="btn btn-outline-warning rounded-pill" style="margin-right: 10px" onclick="toggleFilter()">
                            <strong>Filter</strong>
                        </a>
                        <a href="{{ route('MouldingWasteOutput.create') }}" class="btn btn-outline-success rounded-pill">
                            <i class="fa fa-plus"></i>
                            Add Data
                        </a>
                    </div>
                </div>
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
                                <th class="text-center" scope="col">No</th>
                                <th class="text-center" scope="col">Asal Stock</th>
                                <th class="text-center" scope="col">Id Box</th>
                                <th class="text-center" scope="col">Jenis</th>
                                <th class="text-center" scope="col">Berat</th>
                                <th class="text-center" scope="col">Pcs</th>
                                <th class="text-center" scope="col">Tujuan Kirim</th>
                                <th class="text-center" scope="col">Nomor Job</th>
                                <th class="text-center" scope="col">Nomor BSTB</th>
                                <th class="text-center" scope="col">Keterangan</th>
                                <th class="text-center" scope="col">Modal</th>
                                <th class="text-center" scope="col">Total Modal</th>
                                <th class="text-center" scope="col">NIP Admin</th>
                                <th class="text-center" scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($PreGHI as $item)
                            @if (!str_contains($item->id_box_waste_moulding,'_'.Auth::user()->plant))
                                @continue
                            @endif
                                <tr>
                                    <td class="text-center">{{ $i++ }}</td>
                                    <td class="text-center">
                                        @if ($item->asal_stock == 'warna')
                                            Grading Warna Stock
                                        @else
                                            Moulding Waste Stock
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $item->id_box_waste_moulding }}</td>
                                    <td class="text-center">{{ $item->jenis }}</td>
                                    <td class="text-center">{{ $item->berat }}</td>
                                    <td class="text-center">{{ $item->pcs }}</td>
                                    <td class="text-center">{{ $item->tujuan_kirim }}</td>
                                    <td class="text-center">{{ $item->nomor_job }}</td>
                                    <td class="text-center">{{ $item->nomor_bstb }}</td>
                                    <td class="text-center">{{ $item->keterangan }}</td>
                                    <td class="text-center">{{ $item->modal }}</td>
                                    <td class="text-center">{{ $item->total_modal }}</td>
                                    <td class="text-center">{{ $item->user_created }}</td>
                                    <td class="text-center">
                                        <div class="form-button-action">
                                            @if ($item->status == 1)
                                                <form style="display: flex" id="deleteForm{{ $item->id_box_waste_moulding }}"
                                                    action="{{ route('MouldingWasteOutput.destroy', $item->id_box_waste_moulding) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-link" data-original-title="Remove"
                                                        onclick="confirmDelete('{{ $item->id_box_waste_moulding }}')">
                                                        <i class="bi bi-trash3 text-danger"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <div class="alert alert-danger">
                                    Data Dry A Waste Output belum Tersedia.
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
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
            var url = '{{ route('MouldingWasteOutput.index') }}';

            // url = url.replace(':slug', slug);
            url = url + '?start_date=' + start_date + '&end_date=' + end_date;
            window.location.href = url;

        }
    </script>
@endsection
