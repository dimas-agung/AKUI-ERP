@extends('layouts.admin')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-header">
                        <h4>DATA MASTER TUJUAN KIRIM RAW MATERIAL</h4>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('master_tujuan_kirim_raw_material.create') }}"
                            class="btn btn-md btn-success mb-3">TAMBAH
                            POST</a>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Tujuan Kirim</th>
                                    <th scope="col">Letak Tujuan</th>
                                    <th scope="col">Inisial Kirim</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Tanggal Buat</th>
                                    <th scope="col">Tanggal Update</th>
                                    <th scope="col">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($MasterTujuanKirimRawMaterial as $MasterTJRM)
                                    <tr>
                                        <td>{{ $MasterTJRM->id }}</td>
                                        <td>{{ $MasterTJRM->tujuan_kirim }}</td>
                                        <td>{{ $MasterTJRM->letak_tujuan }}</td>
                                        <td>{{ $MasterTJRM->inisial_tujuan }}</td>
                                        <td>{{ $MasterTJRM->status }}</td>
                                        <td>{{ $MasterTJRM->created_at }}</td>
                                        <td>{{ $MasterTJRM->updated_at }}</td>
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('master_tujuan_kirim_raw_material.destroy', $MasterTJRM->id) }}"
                                                method="POST">
                                                <a href="{{ route('master_tujuan_kirim_raw_material.show', $MasterTJRM->id) }}"
                                                    class="btn btn-sm btn-dark">SHOW</a>
                                                <a href="{{ route('master_tujuan_kirim_raw_material.edit', $MasterTJRM->id) }}"
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
