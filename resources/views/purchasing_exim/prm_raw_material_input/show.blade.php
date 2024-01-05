@extends('layouts.master1')
@section('title')
    Detail Data Prm Raw Material Input
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Detail Data Prm Raw Material Input</h4>
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
                        <tbody>
                            @forelse ($items as $item)
                                <tr>
                                    <td class="text-center">{{ $i++ }}</td>
                                    <td class="text-center">{{ $item->doc_no }}</td>
                                    <td class="text-center">{{ $item->jenis }}</td>
                                    <td class="text-center">{{ $item->berat_nota }}</td>
                                    <td class="text-center">{{ $item->berat_kotor }}</td>
                                    <td class="text-center">{{ $item->berat_bersih }}</td>
                                    <td class="text-center">{{ $item->selisih_berat }}</td>
                                    <td class="text-center">{{ $item->kadar_air }}</td>
                                    <td class="text-center">{{ $item->id_box }}</td>
                                    <td class="text-center">{{ $item->harga_nota }}</td>
                                    <td class="text-center">{{ $item->total_harga_nota }}</td>
                                    <td class="text-center">{{ $item->harga_deal }}</td>
                                    <td class="text-center">{{ $item->keterangan }}</td>
                                    <td class="text-center">{{ $item->user_created }}</td>
                                    <td class="text-center">{{ $item->user_updated }}</td>
                                    <td class="text-center">{{ $item->created_at }}</td>
                                    <td class="text-center">{{ $item->updated_at }}</td>
                                    <td class="text-center">
                                        <div class="form-button-action">
                                            <form style="display: flex" onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('PrmRawMaterialOutput.destroy', $item->id) }}"
                                                method="POST">
                                                {{-- <a href="{{ route('PrmRawMaterialOutput.edit', $item->id) }}"
                                                    class="btn btn-link btn-primary" title="Edit Task"
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
                                    Data PRM Raw Material Output belum Tersedia.
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                    {{-- <div class="col-md-12"> --}}
                    {{-- </div> --}}
                </div>
                <div class=" d-flex justify-content-end model-footer no-bd">
                    <a href="{{ url('/purchasing_exim/prm_raw_material_input') }}" type="button" class="btn btn-danger"
                        data-dismiss="modal">Close</a>
                </div>
            </div>
        </div>
    </div>
@endsection
