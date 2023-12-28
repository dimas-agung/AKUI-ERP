@extends('layouts.master2')
{{-- @extends('layouts.template') --}}
@section('Menu')
    Master
@endsection

@section('title')
    Master Tujuan Kirim Raw Material
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card mt-2">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Data Master Tujuan Kirim Raw Material</h4>
                    <button href="{{ route('master_tujuan_kirim_raw_material.create') }}"
                        class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
                        <i class="fa fa-plus"></i> Tambah Data
                    </button>
                </div>
            </div>
            <div class="card-body">
                {{-- @include('sweetalert::alert') --}}
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        <strong>Sukses: </strong>{{ session()->get('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul><strong>
                                @foreach ($errors->all() as $error)
                                    <li> {{ $error }} </li>
                                @endforeach
                            </strong>
                        </ul>
                        <p>Mohon periksa kembali formulir Anda.</p>
                    </div>
                @endif

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
                                    <td class="text-center">
                                        <div class="form-button-action">
                                            <form style="display: flex" onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('master_tujuan_kirim_raw_material.destroy', $MasterTJRM->id) }}"
                                                method="POST">
                                                <a href="{{ route('master_tujuan_kirim_raw_material.edit', $MasterTJRM->id) }}"
                                                    class="btn btn-link" title="Edit Task"
                                                    data-original-title="Edit Task"><i class="fa fa-edit"></i></a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" data-toggle="tooltip"
                                                    class="btn btn-link btn-danger"data-original-title="Remove"><i
                                                        class="fa fa-times"></i></button>
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
    </div>
@endsection
