@extends('layouts.template')
@section('content')
    <div class="col-md-12">
        <div class="card mt-2">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Data Purchasing Raw Material Input</h4>
                    <button href="" class="btn btn-primary btn-round ml-auto" data-toggle="modal"
                        data-target="#addRowModal">
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
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header no-bd">
                                <h5 class="modal-title">
                                    <span class="fw-mediumbold">
                                        Input Data Purchasing Raw Material Input</span>
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Doc No</label>
                                                <input type="text"
                                                    class="form-control @error('doc_no') is-invalid @enderror"
                                                    name="doc_no" placeholder="Masukkan Doc No">
                                                <!-- error message untuk title -->
                                                @error('doc_no')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="font-weight-bold">Nomor PO</label>
                                                <input type="text"
                                                    class="form-control @error('nomor_po') is-invalid @enderror"
                                                    name="nomor_po" placeholder="Masukan Nomor PO">

                                                <!-- error message untuk title -->
                                                @error('nomor_po')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="font-weight-bold">Nomor Batch</label>
                                                <input type="text"
                                                    class="form-control @error('nomor_batch') is-invalid @enderror"
                                                    name="nomor_batch" placeholder="Masukan Nomor Batch">

                                                <!-- error message untuk title -->
                                                @error('nomor_batch')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="font-weight-bold">Nomor Nota Supplier</label>
                                                {{-- <select name="" id=""></select> --}}
                                                <input type="text"
                                                    class="form-control @error('nomor_nota_supplier') is-invalid @enderror"
                                                    name="nomor_nota_supplier" placeholder="Masukan Nomor Nota Supplier">

                                                <!-- error message untuk title -->
                                                @error('nomor_nota_supplier')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Nomor Nota Internal</label>
                                                {{-- <select name="" id=""></select> --}}
                                                <input type="text"
                                                    class="form-control @error('nomor_nota_internal') is-invalid @enderror"
                                                    name="nomor_nota_internal" placeholder="Masukan Nota Internal">

                                                <!-- error message untuk title -->
                                                @error('nomor_nota_internal')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="font-weight-bold">Nama Supplier</label>
                                                {{-- <select name="" id=""></select> --}}
                                                <input type="text"
                                                    class="form-control @error('nama_supplier') is-invalid @enderror"
                                                    name="nama_supplier" placeholder="Masukan Nama Supplier">

                                                <!-- error message untuk title -->
                                                @error('nama_supplier')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="font-weight-bold">Keterangan</label>
                                                {{-- <select name="" id=""></select> --}}
                                                <input type="text"
                                                    class="form-control @error('keterangan') is-invalid @enderror"
                                                    name="keterangan" placeholder="Masukan Keterangan">

                                                <!-- error message untuk title -->
                                                @error('keterangan')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="font-weight-bold">User</label>
                                                <input type="text"
                                                    class="form-control @error('user_created') is-invalid @enderror"
                                                    name="user_created" placeholder="Masukan Nama User">

                                                <!-- error message untuk title -->
                                                @error('user_created')
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
                                <th scope="col">No Doc</th>
                                <th scope="col">Nomor PO</th>
                                <th scope="col">Nomor Batch</th>
                                <th scope="col">Nomor Nota Supplier</th>
                                <th scope="col">Nomor Nota Internal</th>
                                <th scope="col">Nama Supplier</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">User Created</th>
                                <th scope="col">User Updated</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Updated At</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <th scope="col">No</th>
                            <th scope="col">No Doc</th>
                            <th scope="col">Nomor PO</th>
                            <th scope="col">Nomor Batch</th>
                            <th scope="col">Nomor Nota Supplier</th>
                            <th scope="col">Nomor Nota Internal</th>
                            <th scope="col">Nama Supplier</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">User Created</th>
                            <th scope="col">User Updated</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Updated At</th>
                            {{-- <th scope="col">Actions</th> --}}
                        </tfoot>
                        <tbody>
                            @forelse ($prm_raw_material_inputs as $MasterPRIM)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $MasterPRIM->doc_no }}</td>
                                    <td>{{ $MasterPRIM->nomor_po }}</td>
                                    <td>{{ $MasterPRIM->nomor_batch }}</td>
                                    <td>{{ $MasterPRIM->nomor_nota_supplier }}</td>
                                    <td>{{ $MasterPRIM->nomor_nota_internal }}</td>
                                    <td>{{ $MasterPRIM->nama_supplier }}</td>
                                    <td>{{ $MasterPRIM->keterangan }}</td>
                                    <td>{{ $MasterPRIM->user_created }}</td>
                                    <td>{{ $MasterPRIM->user_updated }}</td>
                                    <td>{{ $MasterPRIM->created_at }}</td>
                                    <td>{{ $MasterPRIM->updated_at }}</td>
                                    <td class="text-center">
                                        <div class="form-button-action">
                                            {{-- <form style="display: flex" onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('purchasingexim/prm_raw_material_input.destroy', $MasterPRIM->id) }}"
                                                method="POST">
                                                <a href="{{ route('purchasingexim/prm_raw_material_input.edit', $MasterPRIM->id) }}"
                                                    class="btn btn-link" title="Edit Task"
                                                    data-original-title="Edit Task"><i class="fa fa-edit"></i></a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" data-toggle="tooltip"
                                                    class="btn btn-link btn-danger"data-original-title="Remove"><i
                                                        class="fa fa-times"></i></button>
                                            </form> --}}
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
