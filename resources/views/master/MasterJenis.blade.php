@extends('layouts.admin')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h3 class="text-center my-4">DATA MASTER JENIS RAW MATERIAL</h3>
                    <hr>
                </div>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <a href="{{ route('master_jenis.create') }}" class="btn btn-md btn-success mb-3">TAMBAH POST</a>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Jenis</th>
                                    <th scope="col">Kategori Susut</th>
                                    <th scope="col">Upah Operator</th>
                                    <th scope="col">Pengurangan harga</th>
                                    <th scope="col">Harga Estimasi</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($MasterJenis as $MasJen)
                                    <tr>
                                        <td>{{ $MasJen->id }}</td>
                                        <td>{{ $MasJen->datetime }}</td>
                                        <td>{{ $MasJen->jenis }}</td>
                                        <td>{{ $MasJen->kategori_susut }}</td>
                                        <td>{{ $MasJen->upah_operator }}</td>
                                        <td>{{ $MasJen->pengurangan_harga }}</td>
                                        <td>{{ $MasJen->harga_estimasi }}</td>
                                        <td>{{ $MasJen->status }}</td>
                                        <td>
                                            <form class="d-flex text-center" style="flex-direction: column;"
                                                onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('master_jenis.destroy', $MasJen->id) }}" method="POST">
                                                <a href="{{ route('master_jenis.show', $MasJen->id) }}"
                                                    class="btn btn-sm btn-dark mb-2">SHOW</a>
                                                <a href="{{ route('master_jenis.edit', $MasJen->id) }}"
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
                        {{-- {{ $MasterSupplier->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
