@extends('layouts.admin')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h3 class="text-center my-4">DATA MASTER SUPPLIER</h3>
                    <hr>
                </div>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <a href="{{ route('master_supplier_raw_material.create') }}"
                            class="btn btn-md btn-success mb-3">TAMBAH
                            POST</a>
                        <table class="table table-bordered">
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
                            <tbody>
                                @forelse ($MasterSupplierRawMaterial as $MasterSPR)
                                    <tr>
                                        <td>{{ $MasterSPR->id }}</td>
                                        <td>{{ $MasterSPR->nama_supplier }}</td>
                                        <td>{{ $MasterSPR->inisial_supplier }}</td>
                                        <td>{{ $MasterSPR->status }}</td>
                                        <td>{{ $MasterSPR->created_at }}</td>
                                        <td>{{ $MasterSPR->updated_at }}</td>
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('master_supplier_raw_material.destroy', $MasterSPR->id) }}"
                                                method="POST">
                                                <a href="{{ route('master_supplier_raw_material.show', $MasterSPR->id) }}"
                                                    class="btn btn-sm btn-dark">SHOW</a>
                                                <a href="{{ route('master_supplier_raw_material.edit', $MasterSPR->id) }}"
                                                    class="btn btn-sm btn-primary">EDIT</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <div class="alert alert-danger">
                                        Data Post belum Tersedia.
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
