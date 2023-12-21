@extends('layouts.master2')
@section('title')
    Update Data Prm Raw Material Output
@endsection
@section('content')
    {{-- <div class="container mt-5 mb-5"> --}}
    <div class="col-md-12">
        <div class="card mt-2">
            {{-- <div class="row"> --}}
            <div class="card border-0 shadow-sm rounded">
                <div class="card-header">
                    <h4>Update Data Prm Raw Material Output</h4>
                </div>
                <div class="card-body">
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
                    <form action="{{ route('PrmRawMaterialOutput.update', $PrmRawMOIC->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nomor Dokument</label>
                                    <input type="text" class="form-control @error('doc_no') is-invalid @enderror"
                                        name="doc_no" value="{{ old('doc_no', $PrmRawMOIC->doc_no) }}" readonly>
                                    <!-- error message untuk title -->
                                    @error('doc_no')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nomor BTSB</label>
                                    <input type="text" class="form-control @error('nomor_bstb') is-invalid @enderror"
                                        name="nomor_bstb" value="{{ old('nomor_bstb', $PrmRawMOIC->nomor_bstb) }}" readonly>
                                    <!-- error message untuk title -->
                                    @error('nomor_bstb')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>User Created</label>
                                    <input type="text" class="form-control @error('user_created') is-invalid @enderror"
                                        name="user_created" value="{{ old('user_created', $PrmRawMOIC->user_created) }}"
                                        placeholder="Masukkan user created" readonly>
                                    <!-- error message untuk title -->
                                    @error('user_created')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>User Updated</label>
                                    <input type="text" class="form-control @error('user_updated') is-invalid @enderror"
                                        name="user_updated" value="{{ old('user_updated', $PrmRawMOIC->user_updated) }}"
                                        placeholder="Masukkan user updated" readonly>
                                    <!-- error message untuk title -->
                                    @error('user_updated')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Id Box</label>
                                <select id="id_box" class="form-control select2 select2-hidden-accessible"
                                    style="width: 100%;" tabindex="-1" aria-hidden="true" name="id_box"
                                    data-placeholder="Pilih Id Box">
                                    <option></option>
                                    @foreach ($PrmRawMS as $post)
                                        <option value="{{ $post->id_box }}"
                                            {{ $post->id_box == $post->id_box ? 'selected' : '' }}>
                                            {{ old('id_box', $post->id_box) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- </div> --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nomor Batch</label>
                                    <input type="text" class="form-control" id="nomor_batch" name="nomor_batch"
                                        onchange="handleChange(this.{{ old('nomor_batch') }})"
                                        placeholder="Masukkan nomor batch">
                                </div>
                            </div>
                            {{-- </div> --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nama Supplier</label>
                                    <input type="text" class="form-control" id="nama_supplier" name="nama_supplier"
                                        onchange="handleChange(this.{{ old('nama_supplier') }})"
                                        placeholder="Masukkan nama supplier">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Jenis</label>
                                    <input type="text" class="form-control" id="jenis" name="jenis"
                                        onchange="handleChange(this.{{ old('jenis') }})" placeholder="Masukkan jenis">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Berat</label>
                                    <input type="text" class="form-control @error('berat') is-invalid @enderror"
                                        name="berat" value="{{ old('berat', $PrmRawMOIC->berat) }}"
                                        placeholder="Masukkan berat">
                                    <!-- error message untuk title -->
                                    @error('berat')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Kadar Air</label>
                                    <input type="text" class="form-control @error('kadar_air') is-invalid @enderror"
                                        name="kadar_air" value="{{ old('kadar_air', $PrmRawMOIC->kadar_air) }}"
                                        placeholder="Masukkan kadar air">
                                    <!-- error message untuk title -->
                                    @error('kadar_air')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tujuan Kirim</label>
                                    <input type="text" class="form-control @error('tujuan_kirim') is-invalid @enderror"
                                        name="tujuan_kirim" value="{{ old('tujuan_kirim', $PrmRawMOIC->tujuan_kirim) }}"
                                        placeholder="Masukkan tujuan kirim">
                                    <!-- error message untuk title -->
                                    @error('tujuan_kirim')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Letak Tujuan</label>
                                    <input type="text" class="form-control @error('letak_tujuan') is-invalid @enderror"
                                        name="letak_tujuan" value="{{ old('letak_tujuan', $PrmRawMOIC->letak_tujuan) }}"
                                        placeholder="Masukkan letak tujuan">
                                    <!-- error message untuk title -->
                                    @error('letak_tujuan')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Inisial Tujuan</label>
                                    <input type="text"
                                        class="form-control @error('inisial_tujuan') is-invalid @enderror"
                                        name="inisial_tujuan"
                                        value="{{ old('inisial_tujuan', $PrmRawMOIC->inisial_tujuan) }}"
                                        placeholder="Masukkan inisial tujuan">
                                    <!-- error message untuk title -->
                                    @error('inisial_tujuan')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Modal</label>
                                    <input type="text" class="form-control @error('modal') is-invalid @enderror"
                                        name="modal" value="{{ old('modal', $PrmRawMOIC->modal) }}"
                                        placeholder="Masukkan modal">
                                    <!-- error message untuk title -->
                                    @error('modal')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Total Modal</label>
                                    <input type="text" class="form-control @error('total_modal') is-invalid @enderror"
                                        name="total_modal" value="{{ old('total_modal', $PrmRawMOIC->total_modal) }}"
                                        placeholder="Masukkan total modal">
                                    <!-- error message untuk title -->
                                    @error('total_modal')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <input type="text" class="form-control @error('keterangan') is-invalid @enderror"
                                        name="keterangan_item"
                                        value="{{ old('keterangan_item', $PrmRawMOIC->keterangan_item) }}"
                                        placeholder="Masukkan keterangan">
                                    <!-- error message untuk title -->
                                    @error('keterangan')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-md btn-primary">UPDATE</button>
                        <button type="reset" class="btn btn-md btn-warning">RESET</button>
                    </form>
                </div>
            </div>
            {{-- </div> --}}
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
        $('#id_box').on('change', function() {
            // Mengambil nilai id_box yang dipilih
            let selectedIdBox = $(this).val();
            // Melakukan permintaan AJAX ke controller untuk mendapatkan nomor batch
            $.ajax({
                url: `{{ route('PrmRawMaterialOutput.set') }}`,
                method: 'GET',
                data: {
                    id_box: selectedIdBox
                },
                success: function(response) {
                    console.log(response);
                    // Mengatur nilai Nomor Batch sesuai dengan respons dari server
                    $('#nomor_batch').val(response.nomor_batch);
                    $('#nama_supplier').val(response.nama_supplier);
                    $('#jenis').val(response.jenis);
                    $('#kadar_air').val(response.avg_kadar_air);
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });
    </script>
@endsection
