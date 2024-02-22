@extends('layouts.master1')
@section('menu')
    Grading Halus
@endsection
@section('title')
    Grading Halus Input
@endsection
@section('content')
    <div class="section">
        <div class="card border border-primary border-3">
            <div class="card-header">
                <div class="col-sm-12 d-flex justify-content-between">
                    <h4 class="card-title">Data Grading Halus Input</h4>
                    <a href="{{ route('GradingHalusInput.create') }}" class="btn btn-outline-success rounded-pill">
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
                                <th class="text-center" scope="col">Nomor grading</th>
                                <th class="text-center" scope="col">Id Box Raw Material</th>
                                <th class="text-center" scope="col">Nomor Batch</th>
                                <th class="text-center" scope="col">Nomor Nota Internal</th>
                                <th class="text-center" scope="col">Nama Supplier</th>
                                <th class="text-center" scope="col">Status</th>
                                <th class="text-center" scope="col">Jenis Raw Material</th>
                                <th class="text-center" scope="col">Kadar Air</th>
                                <th class="text-center" scope="col">Berat Adding</th>
                                <th class="text-center" scope="col">Pcs Adding</th>
                                <th class="text-center" scope="col">Keterangan</th>
                                <th class="text-center" scope="col">Modal</th>
                                <th class="text-center" scope="col">Total Modal</th>
                                <th class="text-center" scope="col">Kategori Susut</th>
                                <th class="text-center" scope="col">Id Box Grading Halus</th>
                                <th class="text-center" scope="col">Susut Depan</th>
                                <th class="text-center" scope="col">Susut Belakang</th>
                                <th class="text-center" scope="col">Biaya Produksi</th>
                                <th class="text-center" scope="col">kontribusi</th>
                                <th class="text-center" scope="col">harga_estimasi</th>
                                <th class="text-center" scope="col">total_harga</th>
                                <th class="text-center" scope="col">nilai_laba_rugi</th>
                                <th class="text-center" scope="col">nilai_prosentase_total_keuntungan</th>
                                <th class="text-center" scope="col">prosentase_harga_gramasi</th>
                                <th class="text-center" scope="col">selisih_laba_rugi_kg</th>
                                <th class="text-center" scope="col">selisih_laba_rugi_per_gram</th>
                                <th class="text-center" scope="col">hpp</th>
                                <th class="text-center" scope="col">total_hpp</th>
                                <th class="text-center" scope="col">fix_hpp</th>
                                <th class="text-center" scope="col">fix_total_hpp</th>
                                <th class="text-center" scope="col">NIP Admin</th>
                                <th class="text-center" scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($PreGHI as $item)
                                <tr>
                                    <td class="text-center">{{ $i++ }}</td>
                                    <td class="text-center">{{ $item->nomor_grading }}</td>
                                    <td class="text-center">{{ $item->id_box_raw_material }}</td>
                                    <td class="text-center">{{ $item->nomor_batch }}</td>
                                    <td class="text-center">{{ $item->nomor_nota_internal }}</td>
                                    <td class="text-center">{{ $item->nama_supplier }}</td>
                                    <td class="text-center">
                                        @if ($item->status == 1)
                                            <span>Aktif</span>
                                        @elseif($item->status == 0)
                                            <span class="badge badge-secondary"
                                                style="text-shadow: 1px 1px 6px #000000;">Tidak Aktif</span>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $item->jenis_raw_material }}</td>
                                    <td class="text-center">{{ $item->kadar_air }}</td>
                                    <td class="text-center">{{ $item->berat_adding }}</td>
                                    <td class="text-center">{{ $item->pcs_adding }}</td>
                                    <td class="text-center">{{ $item->jenis_grading }}</td>
                                    <td class="text-center">{{ $item->berat_grading }}</td>
                                    <td class="text-center">{{ $item->pcs_grading }}</td>
                                    <td class="text-center">{{ $item->keterangan }}</td>
                                    <td class="text-center">{{ $item->modal }}</td>
                                    <td class="text-center">{{ $item->total_modal }}</td>
                                    <td class="text-center">{{ $item->kategori_susut }}</td>
                                    <td class="text-center">{{ $item->id_box_grading_halus }}</td>
                                    <td class="text-center">{{ $item->susut_depan }}</td>
                                    <td class="text-center">{{ $item->susut_belakang }}</td>
                                    <td class="text-center">{{ $item->biaya_produksi }}</td>
                                    <td class="text-center">{{ $item->kontribusi }}</td>
                                    <td class="text-center">{{ $item->harga_estimasi }}</td>
                                    <td class="text-center">{{ $item->total_harga }}</td>
                                    <td class="text-center">{{ $item->nilai_laba_rugi }}</td>
                                    <td class="text-center">{{ $item->nilai_prosentase_total_keuntungan }}</td>
                                    <td class="text-center">{{ $item->prosentase_harga_gramasi }}</td>
                                    <td class="text-center">{{ $item->selisih_laba_rugi_kg }}</td>
                                    <td class="text-center">{{ $item->selisih_laba_rugi_per_gram }}</td>
                                    <td class="text-center">{{ $item->hpp }}</td>
                                    <td class="text-center">{{ $item->total_hpp }}</td>
                                    <td class="text-center">{{ $item->fix_hpp }}</td>
                                    <td class="text-center">{{ $item->fix_total_hpp }}</td>
                                    <td class="text-center">{{ $item->user_created }}</td>
                                    <td class="text-center">
                                        <div class="form-button-action">
                                            @if ($item->status == 1)
                                                <form style="display: flex" id="deleteForm{{ $item->nomor_bstb }}"
                                                    action="{{ route('GradingHalusInput.destroy', $item->nomor_bstb) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-link"
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
                                    Data Grading Halus Input belum Tersedia.
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
