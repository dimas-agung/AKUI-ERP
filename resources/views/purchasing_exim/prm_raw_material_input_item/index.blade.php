@extends('layouts.template')
@section('content')
    <div class="col-md-12">
        <div class="card mt-2 border border-primary border-3">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Data Purchasing Raw Material Input Item</h4>
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
                {{-- #Modal# --}}
                {{-- <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
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
                                <form action="{{ route('purchasingexim/prm_raw_material_input.store') }}" method="POST">
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
                                            <div class="col-md-6">
                                                <label for="basic-usage" class="form-label">Pilih Nama Supplier :</label>
                                                <select class="form-select select2 select2-hidden-accessible"
                                                    style="width: 100%;" tabindex="-1" aria-hidden="true"
                                                    name="nama_supplier" data-placeholder="Pilih Nama Supplier">
                                                    @foreach ($master_supplier_raw_materials as $MasterSPRM)
                                                        <option value="{{ $MasterSPRM->nama_supplier }}">
                                                            {{ $MasterSPRM->nama_supplier }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="font-weight-bold">Keterangan</label>
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
                </div> --}}
                <div class="card-body" style="overflow: auto;">
                    <div class="table-responsive">
                        <table id="table1" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">No Doc</th>
                                    <th scope="col">Jenis</th>
                                    <th scope="col">Berat Nota</th>
                                    <th scope="col">Berat Kotor</th>
                                    <th scope="col">Berat Bersih</th>
                                    <th scope="col">Selisih Berat</th>
                                    <th scope="col">Kadar Air</th>
                                    <th scope="col">Id Box</th>
                                    <th scope="col">Harga Nota</th>
                                    <th scope="col">Total Harga Nota</th>
                                    <th scope="col">Harga Deal</th>
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
                                <th scope="col">Jenis</th>
                                <th scope="col">Berat Nota</th>
                                <th scope="col">Berat Kotor</th>
                                <th scope="col">Berat Bersih</th>
                                <th scope="col">Selisih Berat</th>
                                <th scope="col">Kadar Air</th>
                                <th scope="col">Id Box</th>
                                <th scope="col">Harga Nota</th>
                                <th scope="col">Total Harga Nota</th>
                                <th scope="col">Harga Deal</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">User Created</th>
                                <th scope="col">User Updated</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Updated At</th>
                                <th scope="col">Actions</th>
                            </tfoot>
                            <tbody>
                                @forelse ($prm_raw_material_input_items as $MasterPRIMI)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $MasterPRIMI->no_doc }}</td>
                                        <td>{{ $MasterPRIMI->jenis }}</td>
                                        <td>{{ $MasterPRIMI->berat_nota }}</td>
                                        <td>{{ $MasterPRIMI->berat_kotor }}</td>
                                        <td>{{ $MasterPRIMI->berat_bersih }}</td>
                                        <td>{{ $MasterPRIMI->selisih_berat }}</td>
                                        <td>{{ $MasterPRIMI->kadar_air }}</td>
                                        <td>{{ $MasterPRIMI->id_box }}</td>
                                        <td>{{ $MasterPRIMI->harga_nota }}</td>
                                        <td>{{ $MasterPRIMI->total_harga_nota }}</td>
                                        <td>{{ $MasterPRIMI->harga_deal }}</td>
                                        <td>{{ $MasterPRIMI->keterangan }}</td>
                                        <td>{{ $MasterPRIMI->user_created }}</td>
                                        <td>{{ $MasterPRIMI->user_updated }}</td>
                                        <td>{{ $MasterPRIMI->created_at }}</td>
                                        <td>{{ $MasterPRIMI->updated_at }}</td>
                                        <td class="text-center">
                                            <div class="form-button-action">
                                                <form style="display: flex"
                                                    onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                    action="{{ route('purchasingexim/prm_raw_material_input.destroy', $MasterPRIMI->id) }}"
                                                    method="POST">
                                                    <a href="{{ route('purchasingexim/prm_raw_material_input.edit', $MasterPRIMI->id) }}"
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
