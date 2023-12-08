@extends('layout.master')
@section('con')
    <div class="card border-0 shadow-sm rounded">
        <div class="card-header text-center">
            <h4>Data Workstation AKUI-ERP</h4>
        </div>
        <div class="card-body">
            <a href="{{ route('workstation.create') }}" class="btn btn-md btn-success mb-3">TAMBAH POST</a>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center" scope="col">ID</th>
                        <th class="text-center" scope="col">Nama</th>
                        <th class="text-center" scope="col">Status</th>
                        <th class="text-center" scope="col">Tgl Buat</th>
                        <th class="text-center" scope="col">Tgl Update</th>
                        <th class="text-center" scope="col">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($workstation as $post)
                        <tr>
                            <td class="text-center">{{ $post->id }}</td>
                            <td class="text-center">{!! $post->nama !!}</td>
                            <td class="text-center">{!! $post->status !!}</td>
                            <td class="text-center">{!! $post->created_at !!}</td>
                            <td class="text-center">{!! $post->updated_at !!}</td>
                            <td class="text-center">
                                <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                    action="{{ route('workstation.destroy', $post->id) }}" method="POST">
                                    <a href="{{ route('workstation.show', $post->id) }}"
                                        class="btn btn-sm btn-dark">SHOW</a>
                                    <a href="{{ route('workstation.edit', $post->id) }}"
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
            {{-- {{ $posts->links() }} --}}
        </div>
    </div>
@endsection
