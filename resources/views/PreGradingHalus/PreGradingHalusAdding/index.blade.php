@extends('layouts.master1')
@section('menu')
    Pre Grading Halus
@endsection
@section('title')
    Pre Grading Halus Adding
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card mt-2 border border-primary border-3">
            <div class="card-body">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            <div class="col-sm-12 d-flex justify-content-between">
                                Data Pre Grading Halus Adding
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
                                        <th scope="col" class="text-center">Nomor Job</th>
                                        <th scope="col" class="text-center">Nomor Grading</th>
                                        <th scope="col" class="text-center">ID Box Grading Kasar</th>
                                        <th scope="col" class="text-center">ID Box Raw Material</th>
                                        <th scope="col" class="text-center">Nomor Batch</th>
                                        <th scope="col" class="text-center">Nomor Nota Internal</th>
                                        <th scope="col" class="text-center">Nama Supplier</th>
                                        <th scope="col" class="text-center">Jenis Raw Material</th>
                                        <th scope="col" class="text-center">Kadar Air</th>
                                        <th scope="col" class="text-center">Jenis Kirim</th>
                                        <th scope="col" class="text-center">Berat Kirim</th>
                                        <th scope="col" class="text-center">Pcs Kirim</th>
                                        <th scope="col" class="text-center">Tujuan Kirim</th>
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
                                    @forelse ($pre_grading_halus_addings as $PGHA)
                                        <tr>
                                            <td class="text-center">{{ $i++ }}</td>
                                            <td class="text-center">{{ $PGHA->nomor_job }}</td>
                                            <td class="text-center">{{ $PGHA->nomor_grading }}</td>
                                            <td class="text-center">{{ $PGHA->id_box_grading_kasar }}</td>
                                            <td class="text-center">{{ $PGHA->id_box_raw_material }}</td>
                                            <td class="text-center">{{ $PGHA->nomor_batch }}</td>
                                            <td class="text-center">{{ $PGHA->nomor_nota_internal }}</td>
                                            <td class="text-center">{{ $PGHA->nama_supplier }}</td>
                                            <td class="text-center">{{ $PGHA->jenis_raw_material }}</td>
                                            <td class="text-center">{{ $PGHA->kadar_air }}</td>
                                            <td class="text-center">{{ $PGHA->jenis_kirim }}</td>
                                            <td class="text-center">{{ $PGHA->berat_kirim }}
                                            </td>
                                            <td class="text-center">{{ $PGHA->pcs_kirim }}</td>
                                            <td class="text-center">{{ $PGHA->tujuan_kirim }}</td>
                                            @role('admin')
                                                <td class="text-center">{{ number_format($PGHA->modal, 2, ',', '.') }}</td>
                                                <td class="text-center">{{ number_format($PGHA->total_modal, 2, ',', '.') }}
                                                </td>
                                            @endrole
                                            <td class="text-center">{{ $PGHA->user_created }}</td>
                                            <td class="text-center">{{ $PGHA->user_updated }}</td>
                                            <td class="text-center">{{ $PGHA->created_at }}</td>
                                            <td class="text-center">
                                                {{ $PGHA->created_at != $PGHA->updated_at ? $PGHA->updated_at : '' }}
                                            </td>
                                            <td class="text-center">
                                                <div class="form-button-action">
                                                    <form style="display: flex" id="deleteForm{{ $PGHA->id }}"
                                                        action="{{ route('PreGradingHalusAdding.destroy', $PGHA->id) }}"
                                                        method="POST">
                                                        {{-- <a href="{{ route('PreGradingHalusAdding.show', $PGHA->id) }}"
                                                            class="btn btn-link" title="View" data-original-title="View">
                                                            <i class="bi bi-eye"></i>
                                                        </a> --}}
                                                        @csrf
                                                        @method('DELETE')
                                                        {{-- <button type="button" class="btn btn-link"
                                                            data-original-title="Remove"
                                                            onclick="confirmDelete({{ $PGHA->id }})">
                                                            <i class="bi bi-trash3 text-danger"></i>
                                                        </button> --}}
                                                        <button type="button" class="btn btn-link"
                                                            data-original-title="Remove"
                                                            onclick="confirmDelete({{ $PGHA->id }})">
                                                            <i class="bi bi-trash3 text-danger"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <div class="alert alert-danger">
                                            Data Pre Grading Halus Adding belum Tersedia.
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
            window.location.href = "{{ route('PreGradingHalusAdding.create') }}";
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
            var url = '{{ route("PreGradingHalusAdding.index") }}';

            // url = url.replace(':slug', slug);
            url = url+'?start_date='+start_date+'&end_date='+end_date ;
            window.location.href=url;

        }
    </script>
@endsection
