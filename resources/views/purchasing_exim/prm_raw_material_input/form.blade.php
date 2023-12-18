@extends('layouts.template')
@section('content')
    <div class="col-md-12">
        <div class="card mt-2">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Input Purchasing Raw Material</h4>
                </div>
                <form action="{{ route('purchasingexim/prm_raw_material_input.store') }}" method="POST" class="row g-3">
                    @csrf
                    {{-- <div class="col-md-4">
                        <label for="no_doc" class="form-label">Nomor DOC</label>
                        <input type="text" class="form-control" id="no_doc">
                    </div> --}}
                    <div class="col-md-4">
                        <label for="nomor_po" class="form-label">Nomor PO</label>
                        <input type="text" class="form-control" id="nomor_po">
                    </div>
                    <div class="col-md-4">
                        <label for="nomor_batch" class="form-label">Nomor Batch</label>
                        <input type="text" class="form-control" id="nomor_batch">
                    </div>
                    <div class="col-4">
                        <label for="nomor_nota_supplier" class="form-label">Nomor Nota Supplier</label>
                        <input type="text" class="form-control" id="nomor_nota_supplier">
                    </div>
                    <div class="col-4">
                        <label for="nomor_nota_internal" class="form-label">Nomor Nota Internal</label>
                        <input type="text" class="form-control" id="nomor_nota_internal">
                    </div>
                    <div class="col-md-4">
                        <label for="basic-usage" class="form-label">Pilih Nama Supplier :</label>
                        <select class="form-select select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1"
                            aria-hidden="true" name="nama_supplier" data-placeholder="Pilih Nama Supplier">
                            @foreach ($master_supplier_raw_materials as $MasterSPRM)
                                <option value="{{ $MasterSPRM->nama_supplier }}">
                                    {{ $MasterSPRM->nama_supplier }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12">
                        <hr>
                    </div>
                    <div class="col-md-3">
                        <label for="basic-usage" class="form-label">Pilih Jenis :</label>
                        <select class="form-select select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1"
                            aria-hidden="true" name="jenis" data-placeholder="Pilih Jenis">
                            @foreach ($master_jenis_raw_materials as $MasterJRM)
                                <option value="{{ $MasterJRM->jenis }}">
                                    {{ $MasterJRM->jenis }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="berat_nota" class="form-label">Berat Nota</label>
                        <input type="text" class="form-control" id="berat_nota">
                    </div>
                    <div class="col-md-3">
                        <label for="berat_kotor" class="form-label">Berat Kotor</label>
                        <input type="text" class="form-control" id="berat_kotor">
                    </div>
                    <div class="col-md-3">
                        <label for="berat_bersih" class="form-label">Berat Bersih</label>
                        <input type="text" class="form-control" id="berat_bersih">
                    </div>
                    <div class="col-md-3">
                        <label for="selisih_berat" class="form-label">Selisih Berat</label>
                        <input type="text" class="form-control" id="selisih_berat">
                    </div>
                    <div class="col-md-3">
                        <label for="kadar_air" class="form-label">Kadar Air</label>
                        <input type="text" class="form-control" id="kadar_air">
                    </div>
                    <div class="col-md-3">
                        <label for="id_box" class="form-label">ID Box</label>
                        <input type="text" class="form-control" id="id_box">
                    </div>
                    <div class="col-md-3">
                        <label for="harga_nota" class="form-label">Harga Nota</label>
                        <input type="text" class="form-control" id="harga_nota">
                    </div>
                    <div class="col-md-3">
                        <label for="total_harga_nota" class="form-label">Total Harga Nota</label>
                        <input type="text" class="form-control" id="total_harga_nota">
                    </div>
                    <div class="col-md-3">
                        <label for="harga_deal" class="form-label">Harga Deal</label>
                        <input type="text" class="form-control" id="harga_deal">
                    </div>
                    <div class="col-md-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan">
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    {{-- table --}}
    <div class="col-md-12">
        <div class="card mt-2">
            <div class="card-header">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Jenis</th>
                            <th scope="col">Berat Nota</th>
                            <th scope="col">Berat Kotor</th>
                            <th scope="col">Berat Bersih</th>
                            <th scope="col">Selisih Berat</th>
                            <th scope="col">Kadar Air</th>
                            <th scope="col">ID Box</th>
                            <th scope="col">Harga Nota</th>
                            <th scope="col">Total Harga Nota</th>
                            <th scope="col">Harga Deal</th>
                            <th scope="col">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @forelse ($PrmRawMaterialInputItem as $PrmRMI)
                            <tr>
                                <th scope="col">{{ $PrmRMI->jenis }}</th>
                                <th scope="col">{{ $PrmRMI->berat_nota }}</th>
                                <th scope="col">{{ $PrmRMI->berat_kotor }}</th>
                                <th scope="col">{{ $PrmRMI->berat_bersih }}</th>
                                <th scope="col">{{ $PrmRMI->selisih_berat }}</th>
                                <th scope="col">{{ $PrmRMI->kadar_air }}</th>
                                <th scope="col">{{ $PrmRMI->id_box }}</th>
                                <th scope="col">{{ $PrmRMI->harga_nota }}</th>
                                <th scope="col">{{ $PrmRMI->total_harga_nota }}</th>
                                <th scope="col">{{ $PrmRMI->harga_deal }}</th>
                                <th scope="col">{{ $PrmRMI->keterangan_item }}</th>
                            </tr>
                        @empty
                        @endforelse --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- data table --}}
    {{-- <div class="col-md-12">
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
                #Modal#
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
                            <th scope="col">Actions</th>
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
                                    <td>{{ $MasterPRIM->prm_raw_material_input->nama_supplier }}</td>
                                    <td>{{ $MasterPRIM->keterangan }}</td>
                                    <td>{{ $MasterPRIM->user_created }}</td>
                                    <td>{{ $MasterPRIM->user_updated }}</td>
                                    <td>{{ $MasterPRIM->created_at }}</td>
                                    <td>{{ $MasterPRIM->updated_at }}</td>
                                    <td class="text-center">
                                        <div class="form-button-action">
                                            <form style="display: flex" onsubmit="return confirm('Apakah Anda Yakin ?');"
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
    </div> --}}
@endsection
@section('script')
    <script>
        var form_header = document.getElementsByClassName('row g-3');
        var form_detail = document.getElementsByClassName('row g-3');
        console.log(form_header);
        console.log(form_detail);
    </script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endsection
