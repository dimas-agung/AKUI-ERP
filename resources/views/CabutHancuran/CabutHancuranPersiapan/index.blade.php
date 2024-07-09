@extends('layouts.master1')
@section('menu')
    Cabut Hancuran
@endsection
@section('title')
    Cabut Hancuran Persiapan
@endsection
@section('content')
    <div class="section">
        <div class="card border border-primary border-3">
            <div class="card-header">
                <div class="col-sm-12 d-flex justify-content-between">
                    <h4 class="card-title">Data Cabut Bulu Persiapan</h4>
                    <a href="{{ Route('CabutHancuranPersiapan.create') }}" class="btn btn-outline-success rounded-pill">
                        <i class="fa fa-plus"></i>
                        Add Data
                    </a>
                </div>
            </div>
            <div class="card-body" style="overflow: auto;">
                <div class="table-responsive">
                    <table id="table1" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">No</th>
                                <th class="text-center" scope="col">ID Stock Hancur Kotor</th>
                                <th class="text-center" scope="col">Jenis Rambang</th>
                                <th class="text-center" scope="col">Berat</th>
                                <th class="text-center" scope="col">Nomor Job</th>
                                <th class="text-center" scope="col">Upah Operator</th>
                                <th class="text-center" scope="col">Status</th>
                                <th class="text-center" scope="col">NIP Admin</th>
                                <th class="text-center" scope="col">User Updated</th>
                                <th class="text-center" scope="col">Created At</th>
                                <th class="text-center" scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($CBPenerimaan as $item)
                                @if (!str_ends_with($item->id_stock_hcr_kotor, Auth::user()->plant))
                                    @php
                                        continue;
                                    @endphp
                                @endif
                                <tr>
                                    <td class="text-center">{{ $i++ }}</td>
                                    <td class="text-center">{!! $item->id_stock_hcr_kotor !!}</td>
                                    <td class="text-center">{!! $item->jenis_rambang !!}</td>
                                    <td class="text-center">{!! $item->berat !!}</td>
                                    <td class="text-center">{!! $item->nomor_job !!}</td>
                                    <td class="text-center">{!! $item->upah_operator !!}</td>
                                    <td class="text-center">{!! $item->status !!}</td>
                                    <td class="text-center">{!! $item->user_created !!}</td>
                                    <td class="text-center">{!! $item->user_updated !!}</td>
                                    <td class="text-center">{!! $item->created_at !!}</td>
                                    {{-- <td class="text-center">{{ $item->user_updated }}</td> --}}
                                    <td class="text-center">
                                        <div class="form-button-action">
                                            @if ($item->status == 1)
                                                <form style="display: flex" id="deleteForm{{ $item->id_stock_hcr_kotor }}"
                                                    action="{{ route('CabutHancuranPersiapan.destroy', $item->id_stock_hcr_kotor) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-link btn-danger"
                                                        data-original-title="Remove"
                                                        onclick="confirmDelete('{{ $item->id_stock_hcr_kotor }}')">
                                                        <i class="bi bi-trash3 text-danger"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <div class="alert alert-danger">
                                    Data Cabut Hancuran Persiapan belum Tersedia.
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
