<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Posts</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body style="background: lightgray">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h3 class="text-center my-4">Test Baca data</h3>
                    <hr>
                </div>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <a href="{{ route('MasterSupplier.create') }}" class="btn btn-md btn-success mb-3">TAMBAH
                            POST</a>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Tujuan Kirim</th>
                                    <th scope="col">Letak Tujuan</th>
                                    <th scope="col">Inisial Kirim</th>
                                    <th scope="col">Status</th>
                                    {{-- <th scope="col">AKSI</th> --}}
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
                                        {{-- <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('MasterSupplier.destroy', $MasSupp->id) }}"
                                                method="POST">
                                                <a href="{{ route('MasterSupplier.show', $MasSupp->id) }}"
                                                    class="btn btn-sm btn-dark">SHOW</a>
                                                <a href="{{ route('MasterSupplier.edit', $MasSupp->id) }}"
                                                    class="btn btn-sm btn-primary">EDIT</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                            </form>
                                        </td> --}}
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</body>

</html>
