@extends('layouts.master1')
@section('menu')
    Dry A
@endsection
@section('title')
    Dry A Waste Input
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card mt-2 border border-primary border-3">
            <div class="card-body">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            <div class="col-sm-12 d-flex justify-content-between">
                                Data Dry A Waste Input
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
                                        <th scope="col" class="text-center">Tanggal Cabut</th>
                                        <th scope="col" class="text-center">Jenis Waste</th>
                                        <th scope="col" class="text-center">Berat</th>
                                        <th scope="col" class="text-center">Pcs</th>
                                        @role('admin')
                                        <th scope="col" class="text-center">Harga Estimasi</th>
                                        <th scope="col" class="text-center">Modal</th>
                                        <th scope="col" class="text-center">Total Modal</th>
                                        @endrole
                                        <th scope="col" class="text-center">Keterangan</th>
                                        {{-- <th scope="col" class="text-center">Status</th> --}}
                                        <th scope="col" class="text-center">User Created</th>
                                        <th scope="col" class="text-center">User Updated</th>
                                        <th scope="col" class="text-center">Created At</th>
                                        <th scope="col" class="text-center">Updated At</th>
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($dry_a_waste_input as $item)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">{{ $item->tanggal_cabut }}</td>
                                            <td class="text-center">{{ $item->jenis_waste }}</td>
                                            <td class="text-center">{{ $item->berat }}</td>
                                            <td class="text-center">{{ $item->pcs }}</td>
                                            @role('admin')
                                            <td class="text-center">{{ $item->harga_estimasi }}</td>
                                            <td class="text-center">{{ $item->modal }}</td>
                                            <td class="text-center">{{ $item->total_modal }}</td>
                                            @endrole
                                            <td class="text-center">{{ $item->keterangan }}</td>
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
                                                            action="{{ route('DryAWasteInput.destroy', $item->id) }}"
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
                                            Data Dry A Waste Input belum Tersedia.
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
        // $(function() {

        //     // if (!$.fn.DataTable.isDataTable('.data-table')) {
        //     if (!$.fn.DataTable.isDataTable('#table1')) {

        //         // let table = $('.data-table').DataTable({
        //         let table = $('table1').DataTable({
        //             ajax: "{{ route('DryAWasteInput.index') }}",
        //             columns: [
        //                 // {
        //                 //     data: 'id',
        //                 //     name: 'id'
        //                 // },
        //                 {
        //                     data: 'DT_RowIndex',
        //                     name: 'DT_RowIndex'
        //                 },
        //                 {
        //                     data: 'tanggal_cabut',
        //                     name: 'tanggal_cabut'
        //                 },
        //                 {
        //                     data: 'jenis_waste',
        //                     name: 'jenis_waste'
        //                 },
        //                 {
        //                     data: 'berat',
        //                     name: 'berat'
        //                 },
        //                 {
        //                     data: 'pcs',
        //                     name: 'pcs'
        //                 },
        //                 {
        //                     data: 'keterangan',
        //                     name: 'keterangan'
        //                 },
        //                 {
        //                     data: 'status',
        //                     name: 'status'
        //                 },
        //                 {
        //                     data: 'user_created',
        //                     name: 'user_created'
        //                 },
        //                 {
        //                     data: 'user_updated',
        //                     name: 'user_updated'
        //                 },
        //                 {
        //                     data: 'created_at',
        //                     name: 'created_at'
        //                 },
        //                 {
        //                     data: 'updated_at',
        //                     name: 'updated_at'
        //                 },
        //                 {
        //                     data: 'action',
        //                     name: 'action',
        //                     orderable: false,
        //                     searchable: false
        //                 },
        //             ]
        //         });
        //     }

        // });
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
            var url = '{{ route('DryAWasteInput.index') }}';

            // url = url.replace(':slug', slug);
            url = url + '?start_date=' + start_date + '&end_date=' + end_date;
            window.location.href = url;

        }

        function redirectToPage() {
            window.location.href = "{{ route('DryAWasteInput.create') }}";
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
