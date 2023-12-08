@extends('layouts.admin')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h3 class="text-center my-4">DATA MASTER TUJUAN KIRIM</h3>
                    <hr>
                </div>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <a href="{{ route('master_tujuan.create') }}" class="btn btn-md btn-success mb-3">TAMBAH
                            POST</a>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Tujuan Kirim</th>
                                    <th scope="col">Letak Tujuan</th>
                                    <th scope="col">Inisial Kirim</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($MasterTujuan as $MasTu)
                                    <tr>
                                        <td>{{ $MasTu->id }}</td>
                                        <td>{{ $MasTu->tujuan_kirim }}</td>
                                        <td>{{ $MasTu->letak_tujuan }}</td>
                                        <td>{{ $MasTu->inisial_tujuan }}</td>
                                        <td>{{ $MasTu->status }}</td>
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('master_tujuan.destroy', $MasTu->id) }}" method="POST">
                                                <a href="{{ route('master_tujuan.show', $MasTu->id) }}"
                                                    class="btn btn-sm btn-dark">SHOW</a>
                                                <a href="{{ route('master_tujuan.edit', $MasTu->id) }}"
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
