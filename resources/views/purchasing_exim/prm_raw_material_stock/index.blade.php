@extends('layouts.master1')
@section('Menu')
    Purchasing & EXIM
@endsection
@section('title')
    Purchasing Raw Material Stock
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Data Purchasing Raw Material Stock</h4>
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
                    <table id="table1" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">No</th>
                                <th scope="col" class="text-center">Id Box</th>
                                <th scope="col" class="text-center">Nomor Batch</th>
                                <th scope="col" class="text-center">Nomor Nota</th>
                                <th scope="col" class="text-center">Nama Supplier</th>
                                <th scope="col" class="text-center">Jenis</th>
                                <th scope="col" class="text-center">Berat Masuk</th>
                                <th scope="col" class="text-center">Berat Keluar</th>
                                <th scope="col" class="text-center">Sisa Berat</th>
                                <th scope="col" class="text-center">Avg Kadar Air</th>
                                <th scope="col" class="text-center">Modal</th>
                                <th scope="col" class="text-center">Total Modal</th>
                                <th scope="col" class="text-center">Keterangan</th>
                                <th scope="col" class="text-center">User Created</th>
                                <th scope="col" class="text-center">User Updated</th>
                                <th scope="col" class="text-center">Created At</th>
                                <th scope="col" class="text-center">Updated At</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($PrmRawMaterialStock as $MasterStock)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $MasterStock->id_box }}</td>
                                    <td>{{ $MasterStock->nomor_batch }}</td>
                                    <td>{{ $MasterStock->nomor_nota_internal }}</td>
                                    <td>{{ $MasterStock->nama_supplier }}</td>
                                    <td>{{ $MasterStock->jenis }}</td>
                                    <td>{{ $MasterStock->berat_masuk }}</td>
                                    <td>{{ $MasterStock->berat_keluar }}</td>
                                    <td>{{ $MasterStock->sisa_berat }}</td>
                                    <td>{{ $MasterStock->avg_kadar_air }}</td>
                                    <td>{{ $MasterStock->modal }}</td>
                                    <td>{{ $MasterStock->total_modal }}</td>
                                    <td>{{ $MasterStock->keterangan }}</td>
                                    <td>{{ $MasterStock->user_created }}</td>
                                    <td>{{ $MasterStock->user_updated }}</td>
                                    <td>{{ $MasterStock->created_at }}</td>
                                    <td>{{ $MasterStock->updated_at }}</td>
                                    <td class="text-center">
                                        <div class="form-button-action">
                                            <form action="">
                                                <a href="{{ route('prm_raw_material_stock.show', $MasterStock->id_box) }}"
                                                    class="btn btn-link btn-info" title="Show History"
                                                    data-original-title="Show Detail"><i class="bi bi-file-earmark"></i></a>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <div class="alert alert-danger">
                                    Data Purchasing Raw Material Stock belum Tersedia.
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
