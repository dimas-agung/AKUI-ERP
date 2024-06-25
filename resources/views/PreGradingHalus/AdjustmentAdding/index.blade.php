@extends('layouts.master1')
@section('menu')
    Pre Grading Halus
@endsection
@section('title')
    Grading Halus Adjustment Adding
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card mt-2 border border-primary border-3">
            <div class="card-body">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            <div class="col-sm-12 d-flex justify-content-between">
                                Data Grading Halus Adjustment Adding
                                <div style="position: absolute;right: 0px;">

                                    <a class="btn btn-outline-warning rounded-pill" style="margin-right: 10px" onclick="toggleFilter()">
                                        <strong>Filter</strong>
                                    </a>
                                    <button onclick="redirectToPage()" type="button" class="btn btn-outline-success rounded-pill">
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
                                        <th scope="col" class="text-center">ID Box Grading Halus</th>
                                        <th scope="col" class="text-center">Nomor Adjustment</th>
                                        <th scope="col" class="text-center">Nomor Batch</th>
                                        <th scope="col" class="text-center">Jenis Adding</th>
                                        <th scope="col" class="text-center">Berat Adding</th>
                                        <th scope="col" class="text-center">Pcs Adding</th>
                                        <th scope="col" class="text-center">Keterangan</th>
                                        @role('admin')
                                            <th scope="col" class="text-center">Modal</th>
                                            <th scope="col" class="text-center">Total Modal</th>
                                        @endrole
                                        <th scope="col" class="text-center">User Created</th>
                                        <th scope="col" class="text-center">User Updated</th>
                                        <th scope="col" class="text-center">Created At</th>
                                        <th scope="col" class="text-center">Updated At</th>
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($grading_halus_adjustment_addings as $item)
                                        <tr>
                                            <td class="text-center">{{ $i++ }}</td>
                                            <td class="text-center">{{ $item->id_box_grading_halus }}</td>
                                            <td class="text-center">{{ $item->nomor_adjustment }}</td>
                                            <td class="text-center">{{ $item->nomor_batch }}</td>
                                            <td class="text-center">{{ $item->jenis_adding }}</td>
                                            <td class="text-center">{{ $item->berat_adding }}</td>
                                            <td class="text-center">{{ $item->pcs_adding }}</td>
                                            <td class="text-center">{{ $item->keterangan }}</td>
                                            @role('admin')
                                                <td class="text-center">{{ number_format($item->modal, 2, ',', '.') }}</td>
                                                <td class="text-center">{{ number_format($item->total_modal, 2, ',', '.') }}
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
                                                        <form style="display: flex" id="deleteForm{{ $item->id }}"
                                                            action="{{ route('GradingHalusAdjustmentAdding.destroy', $item->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-link"
                                                                data-original-title="Remove"
                                                                onclick="confirmDelete({{ $item->id }})">
                                                                <i class="bi bi-trash3 text-danger"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <div class="alert alert-danger">
                                            Data Grading Halus Adjustment Adding belum Tersedia.
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
            window.location.href = "{{ route('GradingHalusAdjustmentAdding.create') }}";
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
            var url = '{{ route("GradingHalusAdjustmentAdding.index") }}';

            // url = url.replace(':slug', slug);
            url = url+'?start_date='+start_date+'&end_date='+end_date ;
            window.location.href=url;

        }
    </script>
@endsection
