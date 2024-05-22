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
                                    @php $iteration = 1; @endphp
                                    @forelse ($pre_grading_halus_adding_stocks as $item)
                                        @if ($item->status_stock != 0)
                                            <tr>
                                                <td class="text-center">{{ $iteration }}</td>
                                                <td class="text-center">{{ $item->unit }}</td>
                                                <td class="text-center">{{ $item->nomor_grading }}</td>
                                                <td class="text-center">{{ $item->nomor_batch }}</td>
                                                <td class="text-center">{{ $item->nomor_nota_internal }}</td>
                                                <td class="text-center">{{ $item->nama_supplier }}</td>
                                                <td class="text-center">{{ $item->jenis_raw_material }}</td>
                                                <td class="text-center">{{ $item->kadar_air }}</td>
                                                <td class="text-center">{{ $item->berat_adding }}
                                                </td>
                                                <td class="text-center">{{ $item->pcs_adding }}
                                                </td>
                                                @role('admin')
                                                    <td class="text-center">{{ number_format($item->modal, 2, ',', '.') }}</td>
                                                    <td class="text-center">
                                                        {{ number_format($item->total_modal, 2, ',', '.') }}
                                                    </td>
                                                @endrole
                                                <td class="text-center">{{ $item->status_stock }}</td>
                                                <td class="text-center">{{ $item->created_at }}</td>
                                                <td class="text-center">
                                                    {{ $item->created_at != $item->updated_at ? $item->updated_at : '' }}
                                                </td>

                                            </tr>
                                            @php $iteration++; @endphp
                                        @endif
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
