@extends('layouts.master1')
@section('Menu')
    Grading Kasar
@endsection
@section('title')
    Grading Kasar Input
@endsection
@section('content')
    <div class="card">
        <div class="card border-0 shadow-sm rounded">
            <div class="card-header">
                <h4 class="card-title">Data Grading Kasar Input</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('GradingKasarInput.update', $GradingKI->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>User Created</label>
                                <input type="text" class="form-control @error('user_created') is-invalid @enderror"
                                    name="user_created" value="{{ old('user_created', $GradingKI->user_created) }}"
                                    placeholder="Masukkan user created" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>User Updated</label>
                                <input type="text" class="form-control" name="user_updated"
                                    placeholder="Masukkan user updated">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nomor BTSB</label>
                                <select id="nomor_bstb" class="choices form-select" name="nomor_bstb">
                                    @foreach ($data as $post)
                                        <option value="{{ $post->nomor_bstb }}"
                                            {{ $post->nomor_bstb == $GradingKI->nomor_bstb ? 'selected' : '' }}>
                                            {{ old('nomor_bstb', $post->nomor_bstb) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nomor Grading</label>
                                <input type="text" id="nomor_grading" class="form-control" name="nomor_grading"
                                    value="{{ old('nomor_grading', $GradingKI->nomor_grading) }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nama Supplier</label>
                                <input type="text" class="form-control" id="nama_supplier" name="nama_supplier"
                                    value="{{ old('nama_supplier', $GradingKI->nama_supplier) }}"
                                    placeholder="Masukkan nama supplier">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Jenis</label>
                                <input type="text" class="form-control" id="jenis" name="jenis"
                                    value="{{ old('jenis', $GradingKI->jenis) }}" placeholder="Masukkan jenis">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nomor Batch</label>
                                <input type="text" class="form-control" id="nomor_batch" name="nomor_batch"
                                    value="{{ old('nomor_batch', $GradingKI->nomor_batch) }}"
                                    placeholder="Masukkan nomor batch">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Berat</label>
                                <input type="text" id="berat_masuk" pattern="[0-9]*" inputmode="numeric"
                                    onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control"
                                    name="berat_masuk"
                                    value="{{ old('berat', $GradingKI->StockTransitGradingKasar->berat) }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Kadar Air</label>
                                <input type="text" class="form-control @error('kadar_air') is-invalid @enderror"
                                    name="kadar_air" value="{{ old('kadar_air', $GradingKI->kadar_air) }}"
                                    placeholder="Masukkan kadar air">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Modal</label>
                                <input id="modal" type="text" class="form-control" name="modal"
                                    value="{{ old('modal', $GradingKI->modal) }}" placeholder="Masukkan modal">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Berat Keluar</label>
                                <input type="text" id="berat_keluar" pattern="[0-9]*" inputmode="numeric"
                                    onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control"
                                    name="berat_keluar" value="{{ old('berat', $GradingKI->berat) }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Total Modal</label>
                                <input id="total_modal" type="text" class="form-control" name="total_modal"
                                    value="{{ old('total_modal', $GradingKI->total_modal) }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Keterangan</label>
                                <input type="text" class="form-control" name="keterangan"
                                    value="{{ old('keterangan', $GradingKI->keterangan) }}"
                                    placeholder="Masukkan keterangan">
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
        $('#nomor_bstb').on('change', function() {
            // Mengambil nilai id_box yang dipilih
            let selectedIdBox = $(this).val();
            // Melakukan permintaan AJAX ke controller untuk mendapatkan nomor batch
            $.ajax({
                url: `{{ route('GradingKasarInput.set') }}`,
                method: 'GET',
                data: {
                    nomor_bstb: selectedIdBox
                },
                success: function(response) {
                    console.log(response);
                    // Mengatur nilai Nomor Batch sesuai dengan respons dari server
                    $('#id_box').val(response.id_box);
                    $('#nomor_batch').val(response.nomor_batch);
                    $('#nama_supplier').val(response.nama_supplier);
                    $('#jenis').val(response.jenis);
                    $('#berat_masuk').val(response.berat);
                    $('#kadar_air').val(response.kadar_air);
                    $('#modal').val(response.modal);
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });

        // Event listener untuk perubahan nilai pada total modal
        $('#modal, #berat_keluar').on('input', updateTotalmodal);

        function updateTotalmodal() {
            // Mendapatkan nilai modal dan berat_keluar
            const modal = parseFloat($('#modal').val()) || 0; // Jika nilai tidak valid, dianggap sebagai 0
            const berat_keluar = parseFloat($('#berat_keluar').val()) || 0; // Mengganti '#berat_keluar' sebagai selector

            // Melakukan perhitungan total modal
            const totalmodal = berat_keluar * modal;

            // Memasukkan hasil perhitungan ke dalam input total modal
            $('#total_modal').val(isNaN(totalmodal) ? '' : totalmodal.toFixed(2)); // Menampilkan hasil dengan dua desimal
        }
    </script>
@endsection
