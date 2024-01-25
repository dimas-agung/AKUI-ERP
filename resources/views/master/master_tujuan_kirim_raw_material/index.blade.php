@extends('layouts.master1')
@section('menu')
    Master
@endsection
@section('title')
    Master Tujuan Kirim Raw Material
@endsection
@section('content')
    {{-- <div class="col-md-12"> --}}
    <div class="card">
        <div class="card-header">
            <div class="col-sm-12 d-flex justify-content-between">
                <h4 class="card-title">Data Master Tujuan Kirim Raw Material</h4>
                <button type="button" class="btn btn-outline-success rounded-pill" data-bs-toggle="modal"
                    data-bs-target="#inlineForm">
                    {{-- <strong><i class="bi bi-plus-circle"></i></strong> --}}
                    Add Data
                </button>
            </div>
        </div>
        <div class="card-body">
            {{-- Modal --}}
            <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel33">
                                <span class="fw-mediumbold">
                                    Input Data Master Tujuan Kirim Raw Material</span>
                            </h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('master_tujuan_kirim_raw_material.store') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="font-weight-bold">Tujuan Kirim</label>
                                            <input type="text"
                                                class="form-control @error('tujuan_kirim') is-invalid @enderror"
                                                name="tujuan_kirim" placeholder="Masukkan Tujuan Kirim">

                                            <!-- error message untuk title -->
                                            @error('tujuan_kirim')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="font-weight-bold">Letak Tujuan</label>
                                            <input type="text"
                                                class="form-control @error('letak_tujuan') is-invalid @enderror"
                                                name="letak_tujuan" placeholder="Masukkan Letak Tujuan">

                                            <!-- error message untuk title -->
                                            @error('letak_tujuan')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="font-weight-bold">Inisial Tujuan</label>
                                            <input type="text"
                                                class="form-control @error('inisial_tujuan') is-invalid @enderror"
                                                name="inisial_tujuan" placeholder="Masukkan Letak Tujuan">

                                            <!-- error message untuk title -->
                                            @error('inisial_tujuan')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer no-bd">
                                    <button type="submit" class="btn btn-primary">Tambah</button>
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table id="add-row" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">No</th>
                            <th scope="col" class="text-center">Tujuan Kirim</th>
                            <th scope="col" class="text-center">Letak Tujuan</th>
                            <th scope="col" class="text-center">Inisial Kirim</th>
                            <th scope="col" class="text-center">Status</th>
                            <th scope="col" class="text-center">Tanggal Buat</th>
                            <th scope="col" class="text-center">Tanggal Update</th>
                            <th scope="col" class="text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <th scope="col" class="text-center">No</th>
                        <th scope="col" class="text-center">Tujuan Kirim</th>
                        <th scope="col" class="text-center">Letak Tujuan</th>
                        <th scope="col" class="text-center">Inisial Kirim</th>
                        <th scope="col" class="text-center">Status</th>
                        <th scope="col" class="text-center">Tanggal Buat</th>
                        <th scope="col" class="text-center">Tanggal Update</th>
                        <th scope="col" class="text-center">AKSI</th>
                    </tfoot>
                    <tbody>
                        @forelse ($MasterTujuanKirimRawMaterial as $MasterTJRM)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $MasterTJRM->tujuan_kirim }}</td>
                                <td>{{ $MasterTJRM->letak_tujuan }}</td>
                                <td>{{ $MasterTJRM->inisial_tujuan }}</td>
                                <td>
                                    @if ($MasterTJRM->status == 1)
                                        Aktif
                                    @else
                                        Tidak Aktif
                                    @endif
                                </td>
                                <td>{{ $MasterTJRM->created_at }}</td>
                                <td>{{ $MasterTJRM->updated_at }}</td>
                                {{-- <td class="text-center">
                                    <div class="form-button-action">
                                        <form style="display: flex" onsubmit="return confirm('Apakah Anda Yakin ?');"
                                            action="{{ route('master_tujuan_kirim_raw_material.destroy', $MasterTJRM->id) }}"
                                            method="POST">
                                            <a href="{{ route('master_tujuan_kirim_raw_material.edit', $MasterTJRM->id) }}"
                                                class="btn btn-link" title="Edit Task" data-original-title="Edit Task"><i
                                                    class="fa fa-edit"></i></a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" data-toggle="tooltip"
                                                class="btn btn-link btn-danger"data-original-title="Remove"><i
                                                    class="fa fa-times"></i></button>
                                        </form>
                                    </div>
                                </td> --}}
                                <td class="text-center">
                                    <div class="form-button-action">
                                        <form style="display: flex" id="deleteForm{{ $MasterTJRM->id }}"
                                            action="{{ route('master_tujuan_kirim_raw_material.destroy', $MasterTJRM->id) }}"
                                            method="POST">
                                            <a href="{{ route('master_tujuan_kirim_raw_material.edit', $MasterTJRM->id) }}"
                                                class="btn btn-link btn-primary" title="Edit Task"
                                                data-original-title="Edit Task"><i class="bi bi-pencil-square"></i></a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" data-toggle="tooltip"
                                                class="btn btn-link btn-danger text-danger" data-original-title="Remove"
                                                onclick="confirmDelete({{ $MasterTJRM->id }})"><i
                                                    class="bi bi-trash3"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <div class="alert alert-danger">
                                Data Master Tujuan Kirim Raw Material belum Tersedia.
                            </div>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- </div> --}}
@endsection
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
