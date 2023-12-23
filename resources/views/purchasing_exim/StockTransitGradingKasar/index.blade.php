@extends('layouts.master2')
@section('title')
    Data Stock Transit Grading Kasar
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Data Stock Transit Grading Kasar</h4>
                    {{-- <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
                        <i class="fa fa-plus"></i>
                        Add Data
                    </button> --}}
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
                {{-- <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header no-bd">
                                <h5 class="modal-title">
                                    <span class="fw-mediumbold">
                                        Input</span>
                                    <span class="fw-light">
                                        Data Stock Transit Grading Kasar
                                    </span>
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p class="small">Create a new unit using this form, make sure you fill them all</p>
                                <form action="{{ route('StockTransitGradingKasar.store') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4 pr-0">
                                            <div class="form-group">
                                                <label>Nomor BTSB</label>
                                                <input type="text"
                                                    class="form-control @error('nomor_bstb') is-invalid @enderror"
                                                    name="nomor_bstb" value="{{ old('nomor_bstb') }}"
                                                    placeholder="Masukkan nomor_bstb">
                                                <!-- error message untuk title -->
                                                @error('nomor_bstb')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Nama Supplier</label>
                                                <input type="text"
                                                    class="form-control @error('nama_supplier') is-invalid @enderror"
                                                    name="nama_supplier" value="{{ old('nama_supplier') }}"
                                                    placeholder="Masukkan Nama Supplier">
                                                <!-- error message untuk title -->
                                                @error('nama_supplier')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Jenis</label>
                                                <input type="text"
                                                    class="form-control @error('jenis') is-invalid @enderror" name="jenis"
                                                    value="{{ old('jenis') }}" placeholder="Masukkan jenis">
                                                <!-- error message untuk title -->
                                                @error('jenis')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Berat</label>
                                                <input type="text"
                                                    class="form-control @error('berat') is-invalid @enderror" name="berat"
                                                    value="{{ old('berat') }}" placeholder="Masukkan berat">
                                                <!-- error message untuk title -->
                                                @error('berat')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Kadar Air</label>
                                                <input type="text"
                                                    class="form-control @error('kadar_air') is-invalid @enderror"
                                                    name="kadar_air" value="{{ old('kadar_air') }}"
                                                    placeholder="Masukkan kadar air">
                                                <!-- error message untuk title -->
                                                @error('kadar_air')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4 pr-0">
                                            <div class="form-group">
                                                <label>Tujuan Kirim</label>
                                                <input type="text"
                                                    class="form-control @error('tujuan_kirim') is-invalid @enderror"
                                                    name="tujuan_kirim" value="{{ old('tujuan_kirim') }}"
                                                    placeholder="Masukkan tujuan kirim">
                                                <!-- error message untuk title -->
                                                @error('tujuan_kirim')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Letak Tujuan</label>
                                                <input type="text"
                                                    class="form-control @error('letak_tujuan') is-invalid @enderror"
                                                    name="letak_tujuan" value="{{ old('letak_tujuan') }}"
                                                    placeholder="Masukkan letak_tujuan">
                                                <!-- error message untuk title -->
                                                @error('letak_tujuan')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Inisial Tujuan</label>
                                                <input type="text"
                                                    class="form-control @error('inisial_tujuan') is-invalid @enderror"
                                                    name="inisial_tujuan" value="{{ old('inisial_tujuan') }}"
                                                    placeholder="Masukkan inisial_tujuan">
                                                <!-- error message untuk title -->
                                                @error('inisial_tujuan')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Modal</label>
                                                <input type="text"
                                                    class="form-control @error('modal') is-invalid @enderror" name="modal"
                                                    value="{{ old('modal') }}" placeholder="Masukkan modal">
                                                <!-- error message untuk title -->
                                                @error('modal')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4 pr-0">
                                            <div class="form-group">
                                                <label>Total Modal</label>
                                                <input type="text"
                                                    class="form-control @error('total_modal') is-invalid @enderror"
                                                    name="total_modal" value="{{ old('total_modal') }}"
                                                    placeholder="Masukkan total modal">
                                                <!-- error message untuk title -->
                                                @error('total_modal')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>Keterangan</label>
                                                <input type="text"
                                                    class="form-control @error('keterangan') is-invalid @enderror"
                                                    name="keterangan" value="{{ old('keterangan') }}"
                                                    placeholder="Masukkan keterangan">
                                                <!-- error message untuk title -->
                                                @error('keterangan')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>User Created</label>
                                                <input type="text"
                                                    class="form-control @error('user_created') is-invalid @enderror"
                                                    name="user_created" value="{{ old('user_created') }}"
                                                    placeholder="Masukkan user created">
                                                <!-- error message untuk title -->
                                                @error('user_created')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>User Updated</label>
                                                <input type="text"
                                                    class="form-control @error('user_updated') is-invalid @enderror"
                                                    name="user_updated" value="{{ old('user_updated') }}"
                                                    placeholder="Masukkan user updated">
                                                <!-- error message untuk title -->
                                                @error('user_updated')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="modal-footer no-bd">
                                            <button type="submit" class="btn btn-primary">Add</button>
                                            <button type="button" class="btn btn-danger"
                                                data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <div class="table-responsive">
                    <table id="add-row" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nomor BTSB</th>
                                {{-- <th class="text-center">Nama Supplier</th>
                                <th class="text-center">Jenis</th>
                                <th class="text-center">Berat</th>
                                <th class="text-center">Kadar Air</th>
                                <th class="text-center">Tujuan Kirim</th>
                                <th class="text-center">Letak Tujuan</th>
                                <th class="text-center">Inisial Tujuan</th>
                                <th class="text-center">Modal</th>
                                <th class="text-center">Total Modal</th> --}}
                                <th class="text-center">Keterangan</th>
                                <th class="text-center">User Created</th>
                                <th class="text-center">User Updated</th>
                                {{-- <th style="width: 10%" class="text-center">Action</th> --}}
                            </tr>
                        </thead>
                        <tfoot>
                            <th class="text-center">No</th>
                            <th class="text-center">Nomor BTSB</th>
                            {{-- <th class="text-center">Nama Supplier</th>
                            <th class="text-center">Jenis</th>
                            <th class="text-center">Berat</th>
                            <th class="text-center">Kadar Air</th>
                            <th class="text-center">Tujuan Kirim</th>
                            <th class="text-center">Letak Tujuan</th>
                            <th class="text-center">Inisial Tujuan</th>
                            <th class="text-center">Modal</th>
                            <th class="text-center">Total Modal</th> --}}
                            <th class="text-center">Keterangan</th>
                            <th class="text-center">User Created</th>
                            <th class="text-center">User Updated</th>
                            {{-- <th class="text-center">Action</th> --}}
                        </tfoot>
                        <tbody>
                            @forelse ($PrmRawMOH as $post)
                                <tr>
                                    <td class="text-center">{{ $i++ }}</td>
                                    <td class="text-center">{!! $post->nomor_bstb !!}</td>
                                    {{-- <td class="text-center">{!! $post->nama_supplier !!}</td> --}}
                                    {{-- <td class="text-center">{!! $post->jenis !!}</td>
                                    <td class="text-center">{!! $post->berat !!}</td>
                                    <td class="text-center">{!! $post->kadar_air !!}</td>
                                    <td class="text-center">{!! $post->tujuan_kirim !!}</td>
                                    <td class="text-center">{!! $post->letak_tujuan !!}</td>
                                    <td class="text-center">{!! $post->inisial_tujuan !!}</td>
                                    <td class="text-center">{!! $post->modal !!}</td>
                                    <td class="text-center">{!! $post->total_modal !!}</td> --}}
                                    <td class="text-center">{!! $post->keterangan !!}</td>
                                    <td class="text-center">{!! $post->user_created !!}</td>
                                    <td class="text-center">{!! $post->user_updated !!}</td>
                                    {{-- <td class="text-center">
                                        <div class="form-button-action">
                                            <form style="display: flex" onsubmit="return confirm('Apakah Anda Yakin ?');"
                                                action="{{ route('StockTransitGradingKasar.destroy', $post->id) }}"
                                                method="POST">
                                                <a href="{{ route('StockTransitGradingKasar.show', $post->id) }}"
                                                    class="btn btn-link btn-info" title="Show Task"
                                                    data-original-title="Show"><i class="fa fa-file"></i></a>
                                                <a href="{{ route('StockTransitGradingKasar.edit', $post->id) }}"
                                                    class="btn btn-link btn-primary" title="Edit Task"
                                                    data-original-title="Edit Task"><i class="fa fa-edit"></i></a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" data-toggle="tooltip"
                                                    class="btn btn-link btn-danger"data-original-title="Remove"><i
                                                        class="fa fa-times"></i></button>
                                            </form>
                                        </div>
                                    </td> --}}
                                </tr>
                            @empty
                                <div class="alert alert-danger">
                                    Data Biaya HPP belum Tersedia.
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
