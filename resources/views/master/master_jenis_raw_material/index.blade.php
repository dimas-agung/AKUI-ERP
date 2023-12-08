@extends('layouts.admin')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-header">
                        <h4>DATA MASTER JENIS RAW MATERIAL</h4>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('master_jenis_raw_material.create') }}" class="btn btn-md btn-success mb-3">TAMBAH
                            POST</a>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Jenis</th>
                                    <th scope="col">Kategori Susut</th>
                                    <th scope="col">Upah Operator</th>
                                    <th scope="col">Pengurangan harga</th>
                                    <th scope="col">Harga Estimasi</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Tanggal Buat</th>
                                    <th scope="col">Tanggal Update</th>
                                    <th scope="col">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($MasterJenisRawMaterial as $MasterJRM)
                                    <tr>
                                        <td>{{ $MasterJRM->id }}</td>
                                        <td>{{ $MasterJRM->jenis }}</td>
                                        <td>{{ $MasterJRM->kategori_susut }}</td>
                                        <td>{{ $MasterJRM->upah_operator }}</td>
                                        <td>{{ $MasterJRM->pengurangan_harga }}</td>
                                        <td>{{ $MasterJRM->harga_estimasi }}</td>
                                        <td>{{ $MasterJRM->status }}</td>
                                        <td>{{ $MasterJRM->created_at }}</td>
                                        <td>{{ $MasterJRM->updated_at }}</td>
                                        <td>
                                            <form class="d-flex text-center" style="flex-direction: column;"
                                                onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('master_jenis_raw_material.destroy', $MasterJRM->id) }}"
                                                method="POST">
                                                <a href="{{ route('master_jenis_raw_material.show', $MasterJRM->id) }}"
                                                    class="btn btn-sm btn-dark mb-2">SHOW</a>
                                                <a href="{{ route('master_jenis_raw_material.edit', $MasterJRM->id) }}"
                                                    class="btn btn-sm btn-primary mb-2">EDIT</a>
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
