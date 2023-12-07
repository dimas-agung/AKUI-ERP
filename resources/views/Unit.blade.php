@extends('layout.crud')
@section('konten')
    <div class="card border-0 shadow-sm rounded">
        <div class="card-body">
            {{-- <a href="{{ route('posts.create') }}" class="btn btn-md btn-success mb-3">TAMBAH POST</a> --}}
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Id Workstation</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($unit as $post)
                        <tr>
                            {{-- <td class="text-center"> --}}
                            {{-- <img src="{{ asset('/storage/posts/' . $post->image) }}" class="rounded" style="width: 150px"> --}}
                            {{-- <td>{!! $post->content !!}</td> --}}
                            <td class="text-center">{{ $post->workstation_id }}</td>
                            <td class="text-center">{{ $post->datetime }}</td>
                            <td class="text-center">{{ $post->workstation->nama }}</td>
                            <td class="text-center">{{ $post->status }}</td>
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
@endsection
