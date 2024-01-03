@extends('layouts.master2')
{{-- @extends('layouts.template1') --}}
@section('title')
    Purchasing Raw Material Input
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card mt-2">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Detail Data Purchasing Raw Material</h4>
                    {{-- <button class="btn btn-primary btn-round ml-auto">
                        <a href="{{ url('/purchasing_exim/prm_raw_material_input/create_item') }}"
                            style="text-decoration: none; color:aliceblue">
                            <i class="fa fa-plus"></i>
                            <span class="sub-item">Add Data</span>
                        </a>
                    </button> --}}
                </div>
            </div>
            <div class="card-body">
                {{-- @if (session()->has('success'))
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
                @endif --}}
                <div class="table-responsive">
                    <table id="add-row" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">No</th>
                                <th scope="col" class="text-center">No Doc</th>
                                <th scope="col" class="text-center">Jenis</th>
                                <th scope="col" class="text-center">Berat Nota</th>
                                <th scope="col" class="text-center">Berat kotor</th>
                                <th scope="col" class="text-center">Berat Bersih</th>
                                <th scope="col" class="text-center">Selisih Berat</th>
                                <th scope="col" class="text-center">Kadar Air</th>
                                <th scope="col" class="text-center">Id Box</th>
                                <th scope="col" class="text-center">Harga Nota</th>
                                <th scope="col" class="text-center">Total Harga Nota</th>
                                <th scope="col" class="text-center">Harga Deal</th>
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
                            <th scope="col" class="text-center">Jenis</th>
                            <th scope="col" class="text-center">Berat Nota</th>
                            <th scope="col" class="text-center">Berat kotor</th>
                            <th scope="col" class="text-center">Berat Bersih</th>
                            <th scope="col" class="text-center">Selisih Berat</th>
                            <th scope="col" class="text-center">Kadar Air</th>
                            <th scope="col" class="text-center">Id Box</th>
                            <th scope="col" class="text-center">Harga Nota</th>
                            <th scope="col" class="text-center">Total Harga Nota</th>
                            <th scope="col" class="text-center">Harga Deal</th>
                            <th scope="col" class="text-center">Keterangan</th>
                            <th scope="col" class="text-center">User Created</th>
                            <th scope="col" class="text-center">User Updated</th>
                            <th scope="col" class="text-center">Created At</th>
                            <th scope="col" class="text-center">Updated At</th>
                            <th scope="col" class="text-center">Actions</th>
                        </tfoot>
                        <tbody>
                            @forelse ($MasterPRIM->PrmRawMaterialInputItem as $MasterPRIM)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $MasterPRIM->doc_no }}</td>
                                    <td>{{ $MasterPRIM->jenis }}</td>
                                    <td>{{ $MasterPRIM->berat_nota }}</td>
                                    <td>{{ $MasterPRIM->berat_kotor }}</td>
                                    <td>{{ $MasterPRIM->berat_bersih }}</td>
                                    <td>{{ $MasterPRIM->selisih_berat }}</td>
                                    <td>{{ $MasterPRIM->kadar_air }}</td>
                                    <td>{{ $MasterPRIM->id_box }}</td>
                                    <td>{{ $MasterPRIM->harga_nota }}</td>
                                    <td>{{ $MasterPRIM->total_harga_nota }}</td>
                                    <td>{{ $MasterPRIM->harga_deal }}</td>
                                    <td>{{ $MasterPRIM->keterangan }}</td>
                                    <td>{{ $MasterPRIM->user_created }}</td>
                                    <td>{{ $MasterPRIM->user_updated }}</td>
                                    <td>{{ $MasterPRIM->created_at }}</td>
                                    <td>{{ $MasterPRIM->updated_at }}</td>
                                    <td class="text-center">
                                        <div class="form-button-action">
                                            <form style="display: flex" onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('prm_raw_material_input.destroyItem', $MasterPRIM->id) }}"
                                                method="POST">
                                                {{-- <a href="{{ route('prm_raw_material_input.edit', $MasterPRIM->id) }}"
                                                    class="btn btn-link" title="Edit Task"
                                                    data-original-title="Edit Task"><i class="fa fa-edit"></i></a> --}}
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
                <div class="col-12 mt-2 text-end">
                    <button type="button" class="btn btn-danger mt-2 text-end" onclick="goBack()">Cancel</button>
                </div>

            </div>
        </div>
    </div>
@endsection
