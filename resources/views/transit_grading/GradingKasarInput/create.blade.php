@extends('layouts.master1')
@section('Menu')
    Grading Kasar
@endsection
@section('title')
    Input Grading Kasar
@endsection
@section('content')
    {{-- <div class="container"> --}}
    <div class="card mt-2">
        <form action="{{ route('PrmRawMaterialOutput.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 shadow-sm rounded">
                        <div class="card-header">
                            <h4>Input Grading Kasar</h4>
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
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>NIP Admin</label>
                                        <input type="text" id="user_created" class="form-control" name="user_created"
                                            value="{{ old('user_created') }}" placeholder="Masukkan User Created">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>No BSTB</label>
                                        <select id="nomor_bstb" class="choices form-select" name="nomor_bstb"
                                            data-placeholder="Pilih No BSTB">
                                            <option></option>
                                            @foreach ($GradingKI as $post)
                                                <option value="{{ $post->nomor_bstb }}">
                                                    {{ old('nomor_bstb', $post->nomor_bstb) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Id Box</label>
                                        <input type="text" class="form-control" id="id_box" name="id_box"
                                            onchange="handleChange(this.{{ old('id_box') }})" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Kadar Air</label>
                                        <input type="text" class="form-control" id="kadar_air" name="kadar_air"
                                            onchange="handleChange(this.{{ old('kadar_air') }})" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nama Supplier</label>
                                        <input type="text" class="form-control" id="nama_supplier" name="nama_supplier"
                                            onchange="handleChange(this.{{ old('nama_supplier') }})" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nomor Batch</label>
                                        <input type="text" class="form-control" id="nomor_batch" name="nomor_batch"
                                            onchange="handleChange(this.{{ old('nomor_batch') }})" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Berat</label>
                                        <input type="text" id="berat" class="form-control" name="berat"
                                            value="{{ old('berat') }}" onchange="handleChange(this)" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Jenis</label>
                                        <input type="text" class="form-control" id="jenis" name="jenis"
                                            onchange="handleChange(this.{{ old('jenis') }})" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Modal</label>
                                        <input type="text" id="modal" class="form-control" name="modal"
                                            value="{{ old('modal') }}" onchange="handleChange(this)" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Berat keluar</label>
                                        <input type="text" id="berat_keluar" pattern="[0-9]*" inputmode="numeric"
                                            onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                            class="form-control" name="berat_keluar" value="{{ old('berat_keluar') }}"
                                            placeholder="Masukkan berat_keluar">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Total Modal</label>
                                        <input type="text" id="total_modal" class="form-control" name="total_modal"
                                            value="{{ old('total_modal') }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <input type="text" id="keterangan_item" class="form-control"
                                            name="keterangan_item" value="{{ old('keterangan_item') }}"
                                            placeholder="Masukkan keterangan">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="button" class="btn btn-primary" onclick="addRow()">Add</button>
                                <a href="{{ url('/PrmRawMaterialOutput') }}" type="button" class="btn btn-danger"
                                    data-dismiss="modal">Close</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Validasi Data Input</div>
                </div>
                <div class="card-body" style="overflow: scroll" content="{{ csrf_token() }}">
                    <table class="table table-striped mt-3">
                        <thead>
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">No Document</th>
                                <th class="text-center">No BSTB</th>
                                <th class="text-center">Nomor Batch</th>
                                <th class="text-center">Nama Supplier</th>
                                <th class="text-center">Jenis</th>
                                <th class="text-center">Berat</th>
                                <th class="text-center">Kadar Air</th>
                                <th class="text-center">Nomor Grading</th>
                                <th class="text-center">Modal</th>
                                <th class="text-center">Total Modal</th>
                                <th class="text-center">Keterangan</th>
                                <th class="text-center">NIP Admin</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                        </tbody>
                    </table>
                    <a href="#" class="btn btn-primary" onclick="sendData()">Submit</a>
                </div>
            </div>
        </div>
    </div>
    </form>

@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
        $('#nomor_bstb').on('change', function() {
            // Mengambil nilai nomor_bstb yang dipilih
            let selectedIdBox = $(this).val();
            // Melakukan permintaan AJAX ke controller untuk mendapatkan nomor batch
            $.ajax({
                url: `{{ route('PrmRawMaterialOutput.set') }}`,
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
                    $('#berat').val(response.berat);
                    $('#kadar_air').val(response.avg_kadar_air);
                    $('#modal').val(response.modal);
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });

        // Fungsi generateNomorBSTB (letakkan di sini atau muat dari file eksternal)
        function generateNomorBSTB(inisial_tujuan) {
            const inisialTujuan = document.getElementById('inisial_tujuan').value;
            const now = new Date();
            const tahun = now.getFullYear().toString().substr(-2);
            const bulan = ('0' + (now.getMonth() + 1)).slice(-2);
            const tanggal = ('0' + now.getDate()).slice(-2);
            const jam = ('0' + now.getHours()).slice(-2);
            const menit = ('0' + now.getMinutes()).slice(-2);
            const detik = ('0' + now.getSeconds()).slice(-2);

            const nomor_bstb = `BSTB_PNE_${tanggal}${bulan}${tahun}-${jam}${menit}${detik}_${inisial_tujuan}`;

            // Menampilkan hasil ke dalam elemen HTML dengan ID 'hasil_nomor_bstb'
            // $('#hasil_nomor_bstb').text(nomor_bstb);
            return nomor_bstb;
            console.log(nomor_bstb);
        }

        // Event listener untuk perubahan nilai pada total modal
        $('#modal').on('input', updateTotalmodal);
        $('#berat').on('input', updateTotalmodal);

        function updateTotalmodal() {
            // Mendapatkan nilai berat nota dan berat bersih
            const modal = parseFloat($('#modal').val());
            const berat = parseFloat($('#berat').val());

            // Melakukan perhitungan selisih berat
            const totalmodal = berat * modal;

            // Memasukkan hasil perhitungan ke dalam input selisih berat
            $('#total_modal').val(isNaN(totalmodal) ? '' : totalmodal);
        }

        // Event listener untuk perubahan nilai pada berat nota atau berat bersih
        $('#berat_masuk').on('change', updateSelisihBerat);
        $('#berat').on('input', updateSelisihBerat);

        function updateSelisihBerat() {
            // Mendapatkan nilai berat nota dan berat bersih
            const berat_masuk = parseFloat($('#berat_masuk').val());
            const berat = parseFloat($('#berat').val());
            const selisihBerat = berat_masuk - berat;

            // Memasukkan hasil perhitungan ke dalam input selisih berat
            $('#selisih_berat').val(isNaN(selisihBerat) ? '' : selisihBerat);
        }

        var dataArray = [];
        var dataStock = [];

        function addRow() {
            // Mengambil nilai dari input
            var nomor_bstb = $('#nomor_bstb').val();
            var doc_no = $('#doc_no').val();
            var nomor_batch = $('#nomor_batch').val();
            var id_box = $('#id_box').val();
            var nama_supplier = $('#nama_supplier').val();
            var jenis = $('#jenis').val();
            var berat_masuk = $('#berat_masuk').val();
            var berat = $('#berat_keluar').val();
            var selisih_berat = $('#selisih_berat').val();
            var kadar_air = $('#kadar_air').val();
            var nomor_grading = $('#nomor_grading').val();
            var modal = $('#modal').val();
            var total_modal = $('#total_modal').val();
            var keterangan_item = $('#keterangan_item').val();
            var user_created = $('#user_created').val();

            // Validasi input (sesuai kebutuhan)
            if (!id_box || !nomor_batch) {
                alert('ID and nomor_batch are required.');
                return;
            }

            // Memanggil fungsi generateNomorBSTB untuk mendapatkan nomor_bstb
            var nomor_bstb = generateNomorBSTB(inisial_tujuan);

            // Menambahkan data ke dalam tabel
            var newRow = '<tr><td>' + nomor_bstb + '</td><td>' + doc_no + '</td><td>' + nomor_bstb + '</td><td>' +
                nomor_batch + '</td><td>' + id_box +
                '</td><td>' + nama_supplier + '</td><td>' + jenis + '</td><td>' + berat_masuk + '</td><td>' +
                berat_keluar + '</td><td>' + selisih_berat + '</td><td>' + kadar_air + '</td><td>' + nomor_grading +
                '</td><td>' +
                total_modal + '</td><td>' + keterangan_item + '</td><td>' + user_created +
                '</td></tr>';

            $('#tableBody').append(newRow);

            // Menambahkan data ke dalam array
            dataArray.push({
                doc_no: doc_no,
                nomor_bstb: nomor_bstb,
                nomor_batch: nomor_batch,
                id_box: id_box,
                nama_supplier: nama_supplier,
                jenis: jenis,
                berat_masuk: berat_masuk,
                berat: berat,
                selisih_berat: selisih_berat,
                kadar_air: kadar_air,
                nomor_grading: nomor_grading,
                modal: modal,
                total_modal: total_modal,
                keterangan_item: keterangan_item,
                user_created: user_created,
            });
            dataStock = [];
            dataStock.push({
                id_box: id_box,
                doc_no: doc_no,
                // berat_masuk: berat_masuk,
                berat: berat,
                selisih_berat: selisih_berat,
                kadar_air: kadar_air,
                modal: modal,
                total_modal: total_modal,
                keterangan_item: keterangan_item,
                user_created: user_created,
            });
            console.log(dataStock);
            // Membersihkan nilai input setelah ditambahkan
            $('#id_box').val('<option></option>');
            $('#nomor_batch').val('');
            $('#nama_supplier').val('');
            $('#jenis').val('');
            $('#berat_masuk').val('');
            $('#berat').val('');
            $('#selisih_berat').val('');
            $('#kadar_air').val('');
            $('#tujuan_kirim').val('');
            $('#letak_tujuan').val('');
            $('#inisial_tujuan').val('');
            $('#modal').val('');
            $('#total_modal').val('');
            $('#keterangan_item').val('');
            // Menonaktif kan nilai input ketika ditambah
            $('#doc_no').prop('readonly', true);
            $('#nomor_bstb').prop('readonly', true);
            $('#nomor_batch').prop('readonly', true);
            $('#keterangan').prop('readonly', true);
            $('#user_created').prop('readonly', true);
        }

        function getArray() {
            // Menampilkan array di konsol untuk tujuan debugging
            console.log(dataArray);
        }

        function sendData() {
            console.log(dataArray);
            // Mengirim data ke server menggunakan AJAX
            $.ajax({
                url: `{{ route('PrmRawMaterialOutput.sendData') }}`, // Ganti dengan URL endpoint yang sesuai
                method: 'POST',
                data: {
                    data: JSON.stringify(dataArray),
                    dataStock: JSON.stringify(dataStock),
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json', // payload is json,
                success: function(response) {
                    // alert('Success: ' + response.message); // Tampilkan pesan berhasil
                    // window.location.href = response.redirectTo; // Redirect ke halaman lain
                    Swal.fire({
                        title: 'Success!',
                        text: 'Data berhasil disimpan.',
                        icon: 'success'
                    }).then((result) => {
                        // Redirect ke halaman lain setelah menekan tombol "OK" pada SweetAlert
                        if (result.isConfirmed) {
                            window.location.href = response
                                .redirectTo; // Ganti dengan URL tujuan redirect Anda
                        }
                    });
                },
                error: function(error) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Terjadi kesalahan. Silakan coba lagi.',
                        icon: 'error'
                    });
                    console.log('Validation Errors:', response.responseJSON.errors);
                }
            });

            // Membersihkan array setelah data dikirim
            // dataArray = [];
        }
    </script>
@endsection
