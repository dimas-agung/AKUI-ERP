@extends('layouts.master1')
@section('Menu')
    Purchasing & EXIM
@endsection
@section('title')
    Update Data Prm Raw Material Output
@endsection
@section('content')
    <div class="card">
        <div class="card border border-primary border-3">
            <div class="card-header">
                <h4>Update Data Prm Raw Material Output</h4>
            </div>
            <div class="card-body">
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
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nomor BTSB</label>
                                <input type="text" class="form-control @error('nomor_bstb') is-invalid @enderror"
                                    name="nomor_bstb" value="{{ old('nomor_bstb', $PrmRawMOIC->nomor_bstb) }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>User Created</label>
                                <input type="text" class="form-control @error('user_created') is-invalid @enderror"
                                    name="user_created" value="{{ old('user_created', $PrmRawMOIC->user_created) }}"
                                    placeholder="Masukkan user created" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>User Updated</label>
                                <input type="text" class="form-control @error('user_updated') is-invalid @enderror"
                                    name="user_updated" value="{{ old('user_updated', $PrmRawMOIC->user_updated) }}"
                                    placeholder="Masukkan user updated">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Id Box</label>
                                <select id="id_box" class="choices form-select" name="id_box"
                                    data-placeholder="Pilih Id Box">
                                    <option></option>
                                    @foreach ($PrmRawMS as $post)
                                        <option value="{{ $post->id_box }}"
                                            {{ $post->id_box == $PrmRawMOIC->id_box ? 'selected' : '' }}>
                                            {{ old('id_box', $post->id_box) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nomor Batch</label>
                                <input type="text" class="form-control" id="nomor_batch" name="nomor_batch"
                                    value="{{ old('nomor_batch', $PrmRawMOIC->nomor_batch) }}"
                                    placeholder="Masukkan nomor batch">
                            </div>
                        </div>
                        {{-- </div> --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Berat Masuk</label>
                                <input type="text" class="form-control" id="berat_masuk"
                                    value="{{ old('berat_masuk', $beratMasuk) }}" placeholder="Masukkan Berat Masuk">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nama Supplier</label>
                                <input type="text" class="form-control" id="nama_supplier" name="nama_supplier"
                                    value="{{ old('nama_supplier', $PrmRawMOIC->nama_supplier) }}"
                                    placeholder="Masukkan nama supplier">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Jenis</label>
                                <input type="text" class="form-control" id="jenis" name="jenis"
                                    value="{{ old('jenis', $PrmRawMOIC->jenis) }}" placeholder="Masukkan jenis">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Berat Keluar</label>
                                <input type="text" id="berat" pattern="[0-9]*" inputmode="numeric"
                                    onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control"
                                    name="berat" value="{{ old('berat', $PrmRawMOIC->berat) }}"
                                    placeholder="Masukkan berat keluar">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Kadar Air</label>
                                <input type="text" class="form-control @error('kadar_air') is-invalid @enderror"
                                    name="kadar_air" value="{{ old('kadar_air', $PrmRawMOIC->kadar_air) }}"
                                    placeholder="Masukkan kadar air">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tujuan Kirim</label>
                                <select id="tujuan_kirim" class="choices form-select" name="tujuan_kirim"
                                    data-placeholder="Pilih Tujuan Kirim">
                                    <option></option>
                                    @foreach ($MasTujKir as $post)
                                        <option value="{{ $post->tujuan_kirim }}"
                                            {{ $post->tujuan_kirim == $PrmRawMOIC->tujuan_kirim ? 'selected' : '' }}>
                                            {{ old('tujuan_kirim', $post->tujuan_kirim) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Sisa Berat</label>
                                <input type="text" id="selisih_berat" pattern="[0-9]*" inputmode="numeric"
                                    onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control"
                                    name="selisih_berat" value="{{ old('sisa_berat', $sisaberat) }}"
                                    placeholder="Masukkan sisa berat">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Letak Tujuan</label>
                                <input type="text" id="letak_tujuan" class="form-control" name="letak_tujuan"
                                    value="{{ old('letak_tujuan', $PrmRawMOIC->letak_tujuan) }}"
                                    placeholder="Masukkan letak tujuan">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Inisial Tujuan</label>
                                <input type="text" id="inisial_tujuan" class="form-control" name="inisial_tujuan"
                                    value="{{ old('inisial_tujuan', $PrmRawMOIC->inisial_tujuan) }}"
                                    placeholder="Masukkan inisial tujuan">
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
                        <div class="col-md-4">
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
                        <div class="col-md-4">
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
                    <button type="reset" class="btn btn-md btn-warning" onclick="reset()">RESET</button>
                </form>
            </div>
        </div>
        {{-- </div> --}}
    </div>
    {{-- </div> --}}
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
                    $('#berat_masuk').val(response.berat_masuk);
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });

        $('#tujuan_kirim').on('change', function() {
            // Mengambil nilai id_box yang dipilih
            let selectedPcc = $(this).val();
            // Melakukan permintaan AJAX ke controller untuk mendapatkan nomor batch
            $.ajax({
                url: `{{ route('PrmRawMaterialOutput.setpcc') }}`,
                method: 'GET',
                data: {
                    tujuan_kirim: selectedPcc
                },
                success: function(response) {
                    console.log(response);
                    // Mengatur nilai Nomor Batch sesuai dengan respons dari server
                    $('#letak_tujuan').val(response.letak_tujuan);
                    $('#inisial_tujuan').val(response.inisial_tujuan);
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });

        // Event listener untuk perubahan nilai pada berat nota atau berat bersih
        $('#berat_masuk').on('change', updateSelisihBerat);
        $('#berat').on('input', updateSelisihBerat);

        function updateSelisihBerat() {
            // Mendapatkan nilai berat nota dan berat bersih
            const berat_masuk = parseFloat($('#berat_masuk').val());
            const berat = parseFloat($('#berat').val());

            // Melakukan perhitungan selisih berat
            const selisihBerat = berat_masuk - berat;

            // Memasukkan hasil perhitungan ke dalam input selisih berat
            $('#selisih_berat').val(isNaN(selisihBerat) ? '' : selisihBerat);
        }
    </script>
@endsection
