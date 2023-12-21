@extends('layouts.template')
@section('content')
    <div class="col-md-12">
        <div class="card mt-2">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Data Purchasing Raw Material</h4>
                    {{-- <button href="{{ url('purchasing_exim/prm_raw_material_input/create') }}"
                        class="btn btn-primary btn-round ml-auto">
                        <i class="fa fa-plus"></i> Tambah Data
                    </button> --}}
                    <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
                        <a href="{{ url('/purchasing_exim/prm_raw_material_input/create') }}"
                            style="text-decoration: none; color:aliceblue">
                            <i class="fa fa-plus"></i>
                            <span class="sub-item">Add Data</span>
                        </a>
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
                                    <td>{{ $MasterPRIM->keterangan }}</td>
                                    <td>{{ $MasterPRIM->user_created }}</td>
                                    <td>{{ $MasterPRIM->user_updated }}</td>
                                    <td>{{ $MasterPRIM->created_at }}</td>
                                    <td>{{ $MasterPRIM->updated_at }}</td>
                                    <td class="text-center">
                                        <div class="form-button-action">
                                            <form style="display: flex" onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('purchasing_exim/prm_raw_material_input.destroy', $MasterPRIM->id) }}"
                                                method="POST">
                                                <a href="{{ route('purchasing_exim/prm_raw_material_input.edit', $MasterPRIM->id) }}"
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
                                    Data Purchasing belum Tersedia.
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
