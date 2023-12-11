{{-- @extends('layouts.admin')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-header">
                        <h4>DATA MASTER JENIS RAW MATERIAL</h4>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('master_jenis_raw_material.create') }}" class="btn btn-md btn-success mb-3">TAMBAH
                            POST</a>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Jenis</th>
                                    <th scope="col">Kategori Susut</th>
                                    <th scope="col">Upah Operator</th>
                                    <th scope="col">Pengurangan harga</th>
                                    <th scope="col">Harga Estimasi</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Tanggal Buat</th>
                                    <th scope="col">Tanggal Update</th>
                                    <th scope="col">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($MasterJenisRawMaterial as $MasterJRM)
                                    <tr>
                                        <td>{{ $MasterJRM->id }}</td>
                                        <td>{{ $MasterJRM->jenis }}</td>
                                        <td>{{ $MasterJRM->kategori_susut }}</td>
                                        <td>{{ $MasterJRM->upah_operator }}</td>
                                        <td>{{ $MasterJRM->pengurangan_harga }}</td>
                                        <td>{{ $MasterJRM->harga_estimasi }}</td>
                                        <td>{{ $MasterJRM->status }}</td>
                                        <td>{{ $MasterJRM->created_at }}</td>
                                        <td>{{ $MasterJRM->updated_at }}</td>
                                        <td>
                                            <form class="d-flex text-center" style="flex-direction: column;"
                                                onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('master_jenis_raw_material.destroy', $MasterJRM->id) }}"
                                                method="POST">
                                                <a href="{{ route('master_jenis_raw_material.show', $MasterJRM->id) }}"
                                                    class="btn btn-sm btn-dark mb-2">SHOW</a>
                                                <a href="{{ route('master_jenis_raw_material.edit', $MasterJRM->id) }}"
                                                    class="btn btn-sm btn-primary mb-2">EDIT</a>
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
@extends('layouts.template')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Data Master Jenis Raw Material</h4>
                    <button href="{{ route('master_jenis_raw_material.create') }}" class="btn btn-primary btn-round ml-auto"
                        data-toggle="modal" data-target="#addRowModal">
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
                                        Input Data Master Jenis Raw Material</span>
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('master_jenis_raw_material.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Jenis</label>
                                                <input type="text"
                                                    class="form-control @error('jenis') is-invalid @enderror" name="jenis"
                                                    placeholder="Masukkan jenis">

                                                <!-- error message untuk title -->
                                                @error('jenis')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label class="font-weight-bold">Kategori Susut</label>
                                                {{-- <select name="" id=""></select> --}}
                                                <input type="text"
                                                    class="form-control @error('kategori_susut') is-invalid @enderror"
                                                    name="kategori_susut" placeholder="Masukan Kategori Susut">

                                                <!-- error message untuk title -->
                                                @error('kategori_susut')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="font-weight-bold">Upah Operator</label>
                                                {{-- <select name="" id=""></select> --}}
                                                <input type="number"
                                                    class="form-control @error('upah_operator') is-invalid @enderror"
                                                    name="upah_operator" placeholder="Masukan Upah Operator">

                                                <!-- error message untuk title -->
                                                @error('upah_operator')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="font-weight-bold">Pengurangan Harga</label>
                                                {{-- <select name="" id=""></select> --}}
                                                <input type="number"
                                                    class="form-control @error('pengurangan_harga') is-invalid @enderror"
                                                    name="pengurangan_harga" placeholder="Masukan Pengurangan Harga">

                                                <!-- error message untuk title -->
                                                @error('pengurangan_harga')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="font-weight-bold">Harga Estimasi</label>
                                                {{-- <select name="" id=""></select> --}}
                                                <input type="number"
                                                    class="form-control @error('harga_estimasi') is-invalid @enderror"
                                                    name="harga_estimasi" placeholder="Masukan Harga Estimasi">

                                                <!-- error message untuk title -->
                                                @error('harga_estimasi')
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
                                <th scope="col">Jenis</th>
                                <th scope="col">Kategori Susut</th>
                                <th scope="col">Upah Operator</th>
                                <th scope="col">Pengurangan harga</th>
                                <th scope="col">Harga Estimasi</th>
                                <th scope="col">Status</th>
                                <th scope="col">Tanggal Buat</th>
                                <th scope="col">Tanggal Update</th>
                                <th scope="col">AKSI</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <th scope="col">No</th>
                            <th scope="col">Jenis</th>
                            <th scope="col">Kategori Susut</th>
                            <th scope="col">Upah Operator</th>
                            <th scope="col">Pengurangan harga</th>
                            <th scope="col">Harga Estimasi</th>
                            <th scope="col">Status</th>
                            <th scope="col">Tanggal Buat</th>
                            <th scope="col">Tanggal Update</th>
                            <th scope="col">AKSI</th>
                        </tfoot>
                        <tbody>
                            @forelse ($MasterJenisRawMaterial as $MasterJRM)
                                <tr>
                                    <td>{{ $MasterJRM->id }}</td>
                                    <td>{{ $MasterJRM->jenis }}</td>
                                    <td>{{ $MasterJRM->kategori_susut }}</td>
                                    <td>{{ $MasterJRM->upah_operator }}</td>
                                    {{-- <td>{{ $MasterJRM->pengurangan_harga }} %</td> --}}
                                    <td>
                                        @if ($MasterJRM->pengurangan_harga == '')
                                        @else
                                            {{ $MasterJRM->pengurangan_harga }} %
                                        @endif
                                    </td>
                                    <td>{{ $MasterJRM->harga_estimasi }}</td>
                                    {{-- <td>{{ $MasterJRM->status }} </td> --}}
                                    <td>
                                        @if ($MasterJRM->status == 1)
                                            Aktif
                                        @else
                                            Tidak Aktif
                                        @endif
                                    </td>
                                    <td>{{ $MasterJRM->created_at }}</td>
                                    <td>{{ $MasterJRM->updated_at }}</td>
                                    <td class="text-center">
                                        <div class="form-button-action">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('master_jenis_raw_material.destroy', $MasterJRM->id) }}"
                                                method="POST">
                                                {{-- <a href="{{ route('master_jenis_raw_material.show', $MasterJRM->id) }}"
                                                    class="btn btn-sm btn-dark">SHOW</a> --}}
                                                <a href="{{ route('master_jenis_raw_material.edit', $MasterJRM->id) }}"
                                                    class="btn btn-sm btn-primary">EDIT</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                            </form>
                                        </div>
                                        {{-- <div class="form-button-action">
                                            <button type="button" data-toggle="tooltip" title=""
                                                class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"
                                                data-target="#UpModal">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button type="button" data-toggle="tooltip" title=""
                                                class="btn btn-link btn-danger" data-original-title="Remove">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </div> --}}
                                    </td>
                                </tr>
                            @empty
                                <div class="alert alert-danger">
                                    Data Master Jenis Raw Material belum Tersedia.
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
