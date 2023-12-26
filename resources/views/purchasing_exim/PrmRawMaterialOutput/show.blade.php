@extends('layouts.master2')
@section('title')
    Detail Data Prm Raw Material Output
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Detail Data Prm Raw Material Output</h4>
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
                                <th class="text-center" scope="col">No</th>
                                <th class="text-center" scope="col">Nomor Dokument</th>
                                <th class="text-center" scope="col">Nomor BSTB</th>
                                <th class="text-center">Nomor Batch</th>
                                <th class="text-center">Id Box</th>
                                <th class="text-center">Nama Supplier</th>
                                <th class="text-center">Jenis</th>
                                <th class="text-center">Berat</th>
                                <th class="text-center">Kadar Air</th>
                                <th class="text-center">Tujuan Kirim</th>
                                <th class="text-center">Letak Tujuan</th>
                                <th class="text-center">Inisial Tujuan</th>
                                <th class="text-center">Modal</th>
                                <th class="text-center">Total Modal</th>
                                <th class="text-center" scope="col">Keterangan</th>
                                <th class="text-center" scope="col">NIP Admin</th>
                                <th class="text-center" scope="col">User Updated</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($items as $item)
                                <tr>
                                    <td class="text-center">{{ $i++ }}</td>
                                    <td class="text-center">{{ $item->doc_no }}</td>
                                    <td class="text-center">{{ $item->nomor_bstb }}</td>
                                    <td class="text-center">{{ $item->nomor_batch }}</td>
                                    <td class="text-center">{{ $item->id_box }}</td>
                                    <td class="text-center">{{ $item->nama_supplier }}</td>
                                    <td class="text-center">{{ $item->jenis }}</td>
                                    <td class="text-center">{{ $item->berat }}</td>
                                    <td class="text-center">{{ $item->kadar_air }}</td>
                                    <td class="text-center">{{ $item->tujuan_kirim }}</td>
                                    <td class="text-center">{{ $item->letak_tujuan }}</td>
                                    <td class="text-center">{{ $item->inisial_tujuan }}</td>
                                    <td class="text-center">{{ $item->modal }}</td>
                                    <td class="text-center">{{ $item->total_modal }}</td>
                                    <td class="text-center">{{ $item->keterangan_item }}</td>
                                    <td class="text-center">{{ $item->user_created }}</td>
                                    <td class="text-center">{{ $item->user_updated }}</td>
                                    <td class="text-center">
                                        <div class="form-button-action">
                                            <form style="display: flex" onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('PrmRawMaterialOutput.destroy', $item->id) }}"
                                                method="POST">
                                                <a href="{{ route('PrmRawMaterialOutput.edit', $item->id) }}"
                                                    class="btn btn-link btn-primary" title="Edit Task"
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
                                    Data PRM Raw Material Output belum Tersedia.
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                    {{-- <div class="col-md-12"> --}}
                    {{-- </div> --}}
                </div>
                <div class=" d-flex justify-content-end model-footer no-bd">
                    <a href="{{ url('/PrmRawMaterialOutput') }}" type="button" class="btn btn-danger"
                        data-dismiss="modal">Close</a>
                </div>
            </div>
        </div>
    </div>
@endsection
