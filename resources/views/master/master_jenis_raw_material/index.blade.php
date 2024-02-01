@extends('layouts.master1')
@section('Menu')
    Master
@endsection
@section('title')
    Master Jenis Raw Material
@endsection

@section('content')
    <div class="col-md-12">
        <div class="card mt-2">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Data Master Jenis Raw Material</h4>
                    <button href="{{ route('master_jenis_raw_material.create') }}" class="btn btn-primary btn-round ml-auto"
                        data-toggle="modal" data-target="#addRowModal">
                        <i class="fa fa-plus"></i> Tambah Data
                    </button>
                </div>
            </div>
            <div class="card-body">
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
                                                <input type="text" pattern="[0-9]*" inputmode="numeric"
                                                    onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                                    class="form-control @error('upah_operator')
is-invalid
@enderror"
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
                                                <input type="text" pattern="[0-9]*" inputmode="numeric"
                                                    onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                                    class="form-control @error('pengurangan_harga')
is-invalid
@enderror"
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
                                                <input type="text" pattern="[0-9]*" inputmode="numeric"
                                                    onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                                    class="form-control @error('harga_estimasi')
is-invalid
@enderror"
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
                                <th scope="col" class="text-center">No</th>
                                <th scope="col" class="text-center">Jenis</th>
                                <th scope="col" class="text-center">Kategori Susut</th>
                                <th scope="col" class="text-center">Upah Operator</th>
                                <th scope="col" class="text-center">Pengurangan harga</th>
                                <th scope="col" class="text-center">Harga Estimasi</th>
                                <th scope="col" class="text-center">Status</th>
                                <th scope="col" class="text-center">Tanggal Buat</th>
                                <th scope="col" class="text-center">Tanggal Update</th>
                                <th scope="col" class="text-center">AKSI</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <th scope="col" class="text-center">No</th>
                            <th scope="col" class="text-center">Jenis</th>
                            <th scope="col" class="text-center">Kategori Susut</th>
                            <th scope="col" class="text-center">Upah Operator</th>
                            <th scope="col" class="text-center">Pengurangan harga</th>
                            <th scope="col" class="text-center">Harga Estimasi</th>
                            <th scope="col" class="text-center">Status</th>
                            <th scope="col" class="text-center">Tanggal Buat</th>
                            <th scope="col" class="text-center">Tanggal Update</th>
                            <th scope="col" class="text-center">AKSI</th>
                        </tfoot>
                        <tbody>
                            @forelse ($MasterJenisRawMaterial as $MasterJRM)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $MasterJRM->jenis }}</td>
                                    <td>{{ $MasterJRM->kategori_susut }}</td>
                                    <td>{{ $MasterJRM->upah_operator }}</td>
                                    <td>
                                        @if ($MasterJRM->pengurangan_harga == '')
                                        @else
                                            {{ $MasterJRM->pengurangan_harga }} %
                                        @endif
                                    </td>
                                    <td>{{ $MasterJRM->harga_estimasi }}</td>
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
                                            <form style="display: flex" onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('master_jenis_raw_material.destroy', $MasterJRM->id) }}"
                                                method="POST">
                                                <a href="{{ route('master_jenis_raw_material.edit', $MasterJRM->id) }}"
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
