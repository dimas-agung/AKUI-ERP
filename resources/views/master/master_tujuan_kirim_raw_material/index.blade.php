{{-- @extends('layouts.admin')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-header">
                        <h4>DATA MASTER TUJUAN KIRIM RAW MATERIAL</h4>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('master_tujuan_kirim_raw_material.create') }}"
                            class="btn btn-md btn-success mb-3">TAMBAH
                            POST</a>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Tujuan Kirim</th>
                                    <th scope="col">Letak Tujuan</th>
                                    <th scope="col">Inisial Kirim</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Tanggal Buat</th>
                                    <th scope="col">Tanggal Update</th>
                                    <th scope="col">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($MasterTujuanKirimRawMaterial as $MasterTJRM)
                                    <tr>
                                        <td>{{ $MasterTJRM->id }}</td>
                                        <td>{{ $MasterTJRM->tujuan_kirim }}</td>
                                        <td>{{ $MasterTJRM->letak_tujuan }}</td>
                                        <td>{{ $MasterTJRM->inisial_tujuan }}</td>
                                        <td>{{ $MasterTJRM->status }}</td>
                                        <td>{{ $MasterTJRM->created_at }}</td>
                                        <td>{{ $MasterTJRM->updated_at }}</td>
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('master_tujuan_kirim_raw_material.destroy', $MasterTJRM->id) }}"
                                                method="POST">
                                                <a href="{{ route('master_tujuan_kirim_raw_material.show', $MasterTJRM->id) }}"
                                                    class="btn btn-sm btn-dark">SHOW</a>
                                                <a href="{{ route('master_tujuan_kirim_raw_material.edit', $MasterTJRM->id) }}"
                                                    class="btn btn-sm btn-primary">EDIT</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <div class="alert alert-danger">
                                        Data Post belum Tersedia.
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection --}}
@extends('layouts.admin')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Data Master Tujuan Kirim Raw Material</h4>
                    <button href="{{ route('master_tujuan_kirim_raw_material.create') }}"
                        class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
                        <i class="fa fa-plus"> Tambah Data </i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                {{-- Modal --}}
                <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header no-bd">
                                <h5 class="modal-title">
                                    <span class="fw-mediumbold">
                                        Input Data Master Tujuan Kirim Raw Material</span>
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('master_tujuan_kirim_raw_material.store') }}" method="POST">
                                    @csrf
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
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="add-row" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Tujuan Kirim</th>
                                <th scope="col">Letak Tujuan</th>
                                <th scope="col">Inisial Kirim</th>
                                <th scope="col">Status</th>
                                <th scope="col">Tanggal Buat</th>
                                <th scope="col">Tanggal Update</th>
                                <th scope="col">AKSI</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <th scope="col">No</th>
                            <th scope="col">Tujuan Kirim</th>
                            <th scope="col">Letak Tujuan</th>
                            <th scope="col">Inisial Kirim</th>
                            <th scope="col">Status</th>
                            <th scope="col">Tanggal Buat</th>
                            <th scope="col">Tanggal Update</th>
                            <th scope="col">AKSI</th>
                        </tfoot>
                        <tbody>
                            @forelse ($MasterTujuanKirimRawMaterial as $MasterTJRM)
                                <tr>
                                    <td>{{ $MasterTJRM->id }}</td>
                                    <td>{{ $MasterTJRM->tujuan_kirim }}</td>
                                    <td>{{ $MasterTJRM->letak_tujuan }}</td>
                                    <td>{{ $MasterTJRM->inisial_tujuan }}</td>
                                    <td>{{ $MasterTJRM->status }}</td>
                                    <td>{{ $MasterTJRM->created_at }}</td>
                                    <td>{{ $MasterTJRM->updated_at }}</td>
                                    <td class="text-center">
                                        <div class="form-button-action">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('master_tujuan_kirim_raw_material.destroy', $MasterTJRM->id) }}"
                                                method="POST">
                                                <a href="{{ route('master_tujuan_kirim_raw_material.show', $MasterTJRM->id) }}"
                                                    class="btn btn-sm btn-dark">SHOW</a>
                                                <a href="{{ route('master_tujuan_kirim_raw_material.edit', $MasterTJRM->id) }}"
                                                    class="btn btn-sm btn-primary">EDIT</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                            </form>
                                        </div>
                                        <div class="form-button-action">
                                            <button type="button" data-toggle="tooltip" title=""
                                                class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"
                                                data-target="#UpModal">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button type="button" data-toggle="tooltip" title=""
                                                class="btn btn-link btn-danger" data-original-title="Remove">
                                                <i class="fa fa-times"></i>
                                            </button>
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
    </div>
@endsection
