@extends('layouts.master1')
@section('menu')
    Grading Kasar
@endsection
@section('title')
    Grading Kasar Stock
@endsection
@section('content')
    <div class="section">
        <div class="card border border-primary border-3">
            <div class="card-header">
                <div class="col-sm-12 d-flex justify-content-between">
                    <h4 class="card-title">Data Grading Kasar Stock</h4>
                    {{-- <a href="{{ url('/GradingKasarStock/create') }}" class="btn btn-outline-success rounded-pill">
                        <i class="fa fa-plus"></i>
                        Add Data
                    </a> --}}
                </div>
            </div>
            <div class="card-body" style="overflow: auto;">
                <div class="table-responsive">
                    <table id="table1" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">No</th>
                                <th class="text-center" scope="col">Nomor Document</th>
                                <th class="text-center" scope="col">Id Box Grading Kasar</th>
                                <th class="text-center" scope="col">Nomor Batch</th>
                                <th class="text-center">Nama Supplier</th>
                                <th class="text-center">Nomor Nota Internal</th>
                                <th class="text-center">Jenis Raw Material</th>
                                <th class="text-center">Jenis Grading</th>
                                <th class="text-center">Id Box Raw Material</th>
                                <th class="text-center">Berat Masuk</th>
                                <th class="text-center">Berat Keluar</th>
                                <th class="text-center">Pcs Masuk</th>
                                <th class="text-center">Pcs Keluar</th>
                                <th class="text-center">Avg Kadar Air</th>
                                <th class="text-center">Nomor Grading</th>
                                <th class="text-center">Modal</th>
                                <th class="text-center">Total Modal</th>
                                <th class="text-center" scope="col">Keterangan</th>
                                <th class="text-center" scope="col">User Created</th>
                                <th class="text-center" scope="col">User Updated</th>
                                {{-- <th class="text-center">Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($grading_kasar_stocks as $GradingKS)
                                <tr>
                                    <td class="text-center">{{ $i++ }}</td>
                                    <td class="text-center">{{ $GradingKS->doc_no }}</td>
                                    <td class="text-center">{{ $GradingKS->id_box_grading_kasar }}</td>
                                    <td class="text-center">{{ $GradingKS->nomor_batch }}</td>
                                    <td class="text-center">{{ $GradingKS->nama_supplier }}</td>
                                    <td class="text-center">{{ $GradingKS->nomor_nota_internal }}</td>
                                    <td class="text-center">{{ $GradingKS->jenis_raw_material }}</td>
                                    <td class="text-center">{{ $GradingKS->jenis_grading }}</td>
                                    <td class="text-center">{{ $GradingKS->id_box_raw_material }}</td>
                                    {{-- <td class="text-center">{{ $GradingKS->berat_masuk }}</td> --}}
                                    <td class="text-center">{{ number_format($GradingKS->berat_masuk, 0, ',', '.') }}</td>
                                    {{-- <td class="text-center">{{ $GradingKS->berat_keluar }}</td> --}}
                                    <td class="text-center">{{ number_format($GradingKS->berat_keluar, 0, ',', '.') }}</td>
                                    {{-- <td class="text-center">{{ $GradingKS->pcs_masuk }}</td> --}}
                                    <td class="text-center">{{ number_format($GradingKS->pcs_masuk, 0, ',', '.') }}</td>
                                    {{-- <td class="text-center">{{ $GradingKS->pcs_keluar }}</td> --}}
                                    <td class="text-center">{{ number_format($GradingKS->pcs_keluar, 0, ',', '.') }}</td>
                                    {{-- <td class="text-center">{{ $GradingKS->avg_kadar_air }}</td> --}}
                                    <td class="text-center">{{ number_format($GradingKS->avg_kadar_air, 2, ',', '.') }}
                                    </td>
                                    <td class="text-center">{{ $GradingKS->nomor_grading }}</td>
                                    {{-- <td class="text-center">{{ $GradingKS->modal }}</td> --}}
                                    <td class="text-center">{{ number_format($GradingKS->modal, 2, ',', '.') }}</td>
                                    {{-- <td class="text-center">{{ $GradingKS->total_modal }}</td> --}}
                                    <td class="text-center">{{ number_format($GradingKS->total_modal, 2, ',', '.') }}</td>
                                    <td class="text-center">{{ $GradingKS->keterangan }}</td>
                                    <td class="text-center">{{ $GradingKS->user_created }}</td>
                                    <td class="text-center">{{ $GradingKS->user_updated }}</td>
                                    {{-- <td class="text-center">
                                        <div class="form-button-action">
                                            <form style="display: flex" id="deleteForm{{ $GradingKS->id }}"
                                                action="{{ route('GradingKasarInput.destroy', $GradingKS->id) }}"
                                                method="POST">
                                                <a href="{{ route('GradingKasarInput.edit', $GradingKS->id) }}"
                                                    class="btn btn-link btn-primary" title="Edit Task"
                                                    data-original-title="Edit Task"><i class="bi bi-pencil-square"></i></a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-link btn-danger"
                                                    data-original-title="Remove"
                                                    onclick="confirmDelete({{ $GradingKS->id }})">
                                                    <i class="bi bi-trash3 text-danger"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td> --}}
                                </tr>
                            @empty
                                <div class="alert alert-danger">
                                    Data Grading Kasar Stock belum Tersedia.
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
@endsection
