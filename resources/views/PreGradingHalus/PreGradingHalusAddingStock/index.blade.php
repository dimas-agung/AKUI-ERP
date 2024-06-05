@extends('layouts.master1')
@section('menu')
    Pre Grading Halus
@endsection
@section('title')
    Pre Grading Halus Adding Stock
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card mt-2 border border-primary border-3">
            <div class="card-body">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            <div class="col-sm-12 d-flex justify-content-between">
                                Data Pre Grading Halus Adding Stock
                            </div>
                        </h5>
                    </div>
                    <div class="card-body" style="overflow: auto;">
                        <div class="table-responsive">
                            <table id="table1" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">No</th>
                                        <th scope="col" class="text-center">Unit</th>
                                        <th scope="col" class="text-center">Nomor Grading</th>
                                        <th scope="col" class="text-center">Nomor Batch</th>
                                        <th scope="col" class="text-center">Nomor Nota Internal</th>
                                        <th scope="col" class="text-center">Nama Supplier</th>
                                        <th scope="col" class="text-center">Jenis Raw Material</th>
                                        <th scope="col" class="text-center">Kadar Air</th>
                                        <th scope="col" class="text-center">Berat Adding</th>
                                        <th scope="col" class="text-center">Pcs Adding</th>
                                        @role('admin')
                                            <th scope="col" class="text-center">Modal</th>
                                            <th scope="col" class="text-center">Total Modal</th>
                                        @endrole
                                        <th scope="col" class="text-center">Status Stock</th>
                                        <th scope="col" class="text-center">Created At</th>
                                        <th scope="col" class="text-center">Updated At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($pre_grading_halus_adding_stocks as $key=> $PGHAS)
                                        <tr>
                                            <td class="text-center">{{ $key+1 }}</td>
                                            <td class="text-center">{{ $PGHAS->unit }}</td>
                                            <td class="text-center">{{ $PGHAS->nomor_grading }}</td>
                                            <td class="text-center">{{ $PGHAS->nomor_batch }}</td>
                                            <td class="text-center">{{ $PGHAS->nomor_nota_internal }}</td>
                                            <td class="text-center">{{ $PGHAS->nama_supplier }}</td>
                                            <td class="text-center">{{ $PGHAS->jenis_raw_material }}</td>
                                            <td class="text-center">{{ $PGHAS->kadar_air }}</td>
                                            <td class="text-center">{{ $PGHAS->berat_adding }}
                                            </td>
                                            {{-- <td class="text-center">{{ $PGHAS->pcs_adding }}</td> --}}
                                            <td class="text-center">{{ number_format($PGHAS->pcs_adding, 0, ',', '.') }}
                                            </td>
                                            @role('admin')
                                                <td class="text-center">{{ number_format($PGHAS->modal, 2, ',', '.') }}</td>
                                                {{-- <td class="text-center">{{ $PGHAS->total_modal }}</td> --}}
                                                <td class="text-center">{{ number_format($PGHAS->total_modal, 2, ',', '.') }}
                                                </td>
                                            @endrole
                                            <td class="text-center">{{ $PGHAS->status }}</td>
                                            <td class="text-center">{{ $PGHAS->created_at }}</td>
                                            <td class="text-center">{{ $PGHAS->updated_at }}</td>
                                            </tr>
                                            {{-- @php $iteration++; @endphp --}}
                                        {{-- @endif --}}
                                    @empty
                                        <div class="alert alert-danger">
                                            Data Pre Grading Halus Adding Stock belum Tersedia.
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
