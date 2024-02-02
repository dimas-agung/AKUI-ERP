@extends('layouts.master1')
@section('menu')
    Pre Cleaning
@endsection
@section('title')
    Transit Pre Cleaning Stock
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card mt-2">
            <div class="card-body">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            <div class="col-sm-12 d-flex justify-content-between">
                                Data Transit Pre Cleaning Stock
                            </div>
                        </h5>
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
                                        <th scope="col" class="text-center">Nama Supplier</th>
                                        <th scope="col" class="text-center">Nomor Nota Internal</th>
                                        <th scope="col" class="text-center">ID Box Raw Material</th>
                                        <th scope="col" class="text-center">Jenis Raw Material</th>
                                        <th scope="col" class="text-center">Jenis Kirim</th>
                                        <th scope="col" class="text-center">Berat Kirim</th>
                                        <th scope="col" class="text-center">Pcs Kirim</th>
                                        <th scope="col" class="text-center">Kadar Air</th>
                                        <th scope="col" class="text-center">Tujuan Kirim</th>
                                        <th scope="col" class="text-center">Nomor Grading</th>
                                        <th scope="col" class="text-center">Modal</th>
                                        <th scope="col" class="text-center">Total Modal</th>
                                        <th scope="col" class="text-center">Keterangan</th>
                                        <th scope="col" class="text-center">User Created</th>
                                        <th scope="col" class="text-center">User Updated</th>
                                        <th scope="col" class="text-center">Created At</th>
                                        <th scope="col" class="text-center">Updated At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($transit_pre_cleaning_stocks as $TPCS)
                                        <tr>
                                            <td class="text-center">{{ $i++ }}</td>
                                            <td class="text-center">{{ $TPCS->nomor_job }}</td>
                                            <td class="text-center">{{ $TPCS->id_box_grading_kasar }}</td>
                                            <td class="text-center">{{ $TPCS->nomor_bstb }}</td>
                                            <td class="text-center">{{ $TPCS->nama_supplier }}</td>
                                            <td class="text-center">{{ $TPCS->nomor_nota_internal }}</td>
                                            <td class="text-center">{{ $TPCS->id_box_raw_material }}</td>
                                            <td class="text-center">{{ $TPCS->jenis_raw_material }}</td>
                                            <td class="text-center">{{ $TPCS->jenis_kirim }}</td>
                                            <td class="text-center">{{ $TPCS->berat_kirim }}</td>
                                            <td class="text-center">{{ $TPCS->pcs_kirim }}</td>
                                            <td class="text-center">{{ $TPCS->kadar_air }}</td>
                                            <td class="text-center">{{ $TPCS->tujuan_kirim }}</td>
                                            <td class="text-center">{{ $TPCS->nomor_grading }}</td>
                                            <td class="text-center">{{ $TPCS->modal }}</td>
                                            <td class="text-center">{{ $TPCS->total_modal }}</td>
                                            <td class="text-center">{{ $TPCS->keterangan }}</td>
                                            <td class="text-center">{{ $TPCS->user_created }}</td>
                                            <td class="text-center">{{ $TPCS->user_updated }}</td>
                                            <td class="text-center">{{ $TPCS->created_at }}</td>
                                            <td class="text-center">{{ $TPCS->updated_at }}</td>
                                        </tr>
                                    @empty
                                        <div class="alert alert-danger">
                                            Data Pre Cleaning Output belum Tersedia.
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
        // function redirectToPage() {
        //     window.location.href = "{{ url('/transit_pre_cleaning_stock/create') }}";
        // }

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
