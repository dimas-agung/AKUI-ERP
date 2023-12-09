@extends('layout.master')
@section('con')
    <div class="card border-0 shadow-sm rounded">
        <div class="card-header text-center">
            <h4>Data Biaya HPP</h4>
        </div>
        <div class="card-body">
            <a href="{{ route('biaya.create') }}" class="btn btn-md btn-success mb-3">TAMBAH POST</a>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center" scope="col">ID</th>
                        <th class="text-center" scope="col">Jenis Biaya</th>
                        <th class="text-center" scope="col">Biaya PerGram</th>
                        <th class="text-center" scope="col">Unit ID</th>
                        <th class="text-center" scope="col">Status</th>
                        <th class="text-center" scope="col">Tgl Buat</th>
                        <th class="text-center" scope="col">Tgl Update</th>
                        <th class="text-center" scope="col">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($biaya as $post)
                        <tr>
                            <td class="text-center">{{ $post->id }}</td>
                            <td class="text-center">{!! $post->jenis_biaya !!}</td>
                            <td class="text-center">{!! $post->biaya_per_gram !!}</td>
                            <td class="text-center">{!! $post->unit_id !!}</td>
                            <td class="text-center">{!! $post->status !!}</td>
                            <td class="text-center">{!! $post->created_at !!}</td>
                            <td class="text-center">{!! $post->updated_at !!}</td>
                            <td class="text-center">
                                <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                    action="{{ route('biaya.destroy', $post->id) }}" method="POST">
                                    <a href="{{ route('biaya.show', $post->id) }}" class="btn btn-sm btn-dark">SHOW</a>
                                    <a href="{{ route('biaya.edit', $post->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <div class="alert alert-danger">
                            Data Biaya HPP belum Tersedia.
                        </div>
                    @endforelse
                </tbody>
            </table>
            {{ $biaya->links() }}
        </div>
    </div>
@endsection
