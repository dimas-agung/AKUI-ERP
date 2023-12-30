@extends('layouts.master2')
{{-- @extends('layouts.template') --}}
@section('Menu')
    Purchasing & EXIM
@endsection
@section('title')
    Purchasing Raw Material Input
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Data Purchasing Raw Material Input</h4>
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
                {{-- Create Data --}}
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
                                <th scope="col" class="text-center">No</th>
                                <th scope="col" class="text-center">No Doc</th>
                                <th scope="col" class="text-center">Nomor PO</th>
                                <th scope="col" class="text-center">Nomor Batch</th>
                                <th scope="col" class="text-center">Nomor Nota Supplier</th>
                                <th scope="col" class="text-center">Nomor Nota Internal</th>
                                <th scope="col" class="text-center">Nama Supplier</th>
                                <th scope="col" class="text-center">Keterangan</th>
                                <th scope="col" class="text-center">User Created</th>
                                <th scope="col" class="text-center">User Updated</th>
                                <th scope="col" class="text-center">Created At</th>
                                <th scope="col" class="text-center">Updated At</th>
                                <th scope="col" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <th scope="col" class="text-center">No</th>
                            <th scope="col" class="text-center">No Doc</th>
                            <th scope="col" class="text-center">Nomor PO</th>
                            <th scope="col" class="text-center">Nomor Batch</th>
                            <th scope="col" class="text-center">Nomor Nota Supplier</th>
                            <th scope="col" class="text-center">Nomor Nota Internal</th>
                            <th scope="col" class="text-center">Nama Supplier</th>
                            <th scope="col" class="text-center">Keterangan</th>
                            <th scope="col" class="text-center">User Created</th>
                            <th scope="col" class="text-center">User Updated</th>
                            <th scope="col" class="text-center">Created At</th>
                            <th scope="col" class="text-center">Updated At</th>
                            <th scope="col" class="text-center">Actions</th>
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
                                                action="{{ route('prm_raw_material_input.destroyInput', $MasterPRIM->id) }}"
                                                method="POST">
                                                <a href="{{ route('prm_raw_material_input.show', $MasterPRIM->id) }}"
                                                    class="btn btn-link" title="Show Detail"
                                                    data-original-title="Show Detail"><i class="fa fa-file"></i></a>
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
