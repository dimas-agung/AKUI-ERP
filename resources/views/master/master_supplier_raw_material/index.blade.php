@extends('layouts.template')
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Data Master Supplier Raw Material</h4>
                    <button href="{{ route('master_supplier_raw_material.create') }}"
                        class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
                        <i class="fa fa-plus"></i> Tambah Data
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
                                        Input Data Master Supplier Raw Material</span>
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('master_supplier_raw_material.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="font-weight-bold">Nama Supplier</label>
                                                <input type="text"
                                                    class="form-control @error('nama_supplier') is-invalid @enderror"
                                                    name="nama_supplier" placeholder="Masukkan Nama Supplier">

                                                <!-- error message untuk title -->
                                                @error('nama_supplier')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label class="font-weight-bold">Inisial Supplier</label>
                                                <input type="text"
                                                    class="form-control @error('inisial_supplier') is-invalid @enderror"
                                                    name="inisial_supplier" placeholder="Masukkan Inisial Supplier">

                                                <!-- error message untuk title -->
                                                @error('inisial_supplier')
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
                                <th scope="col">Nama Supplier</th>
                                <th scope="col">Inisial supplier</th>
                                <th scope="col">Status</th>
                                <th scope="col">Tanggal Buat</th>
                                <th scope="col">Tanggal Update</th>
                                <th scope="col">AKSI</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <th scope="col">No</th>
                            <th scope="col">Nama Supplier</th>
                            <th scope="col">Inisial supplier</th>
                            <th scope="col">Status</th>
                            <th scope="col">Tanggal Buat</th>
                            <th scope="col">Tanggal Update</th>
                            <th scope="col">AKSI</th>
                        </tfoot>
                        <tbody>
                            @forelse ($MasterSupplierRawMaterial as $MasterSPR)
                                <tr>
                                    <td>{{ $MasterSPR->id }}</td>
                                    <td>{{ $MasterSPR->nama_supplier }}</td>
                                    <td>{{ $MasterSPR->inisial_supplier }}</td>
                                    {{-- <td>{{ $MasterSPR->status }}</td> --}}
                                    <td>
                                        @if ($MasterSPR->status == 1)
                                            Aktif
                                        @else
                                            Tidak Aktif
                                        @endif
                                    </td>
                                    <td>{{ $MasterSPR->created_at }}</td>
                                    <td>{{ $MasterSPR->updated_at }}</td>
                                    <td>
                                        <div class="form-button-action">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('master_supplier_raw_material.destroy', $MasterSPR->id) }}"
                                                method="POST">
                                                {{-- <a href="{{ route('master_supplier_raw_material.show', $MasterSPR->id) }}"
                                                    class="btn btn-sm btn-dark">SHOW</a> --}}
                                                <a href="{{ route('master_supplier_raw_material.edit', $MasterSPR->id) }}"
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
                                    Data Master Supplier Raw Material belum Tersedia.
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
