@extends('layouts.master1')
@section('Menu')
    Pre-Cleaning
@endsection
@section('title')
    Data Pre-Cleaning Input
@endsection
@section('content')
    <div class="container">
        <div class="card mt-2">
            <form action="{{ route('PreCleaningInput.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-0 shadow-sm rounded">
                            <div class="card-header">
                                <h4>Input Data Pre-Cleaning Input</h4>
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
                                            <label>Nomer Document</label>
                                            <input type="text" id="doc_no" class="form-control" name="doc_no"
                                                placeholder="Masukkan Nomer Document">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Nomer BSTB</label>
                                            <select id="nomor_bstb" class="choices form-select" name="nomor_bstb"
                                                data-placeholder="Pilih Nomor Job">
                                                <option value="">Pilih Nomor Job</option>
                                                @php
                                                    $selectedNomorBSTB = ''; // Inisialisasi variabel untuk menyimpan nomor_bstb yang sudah ditampilkan
                                                @endphp
                                                @foreach ($stockTGK as $post)
                                                    @if ($selectedNomorBSTB != $post->nomor_bstb)
                                                        <option value="{{ $post->nomor_bstb }}">
                                                            {{ old('nomor_bstb', $post->nomor_bstb) }}
                                                        </option>
                                                        @php
                                                            $selectedNomorBSTB = $post->nomor_bstb; // Set nilai variabel dengan nomor_bstb yang baru ditampilkan
                                                        @endphp
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>NIP Admin</label>
                                            <input type="text" id="user_created" class="form-control" name="user_created"
                                                placeholder="Masukkan User Created">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Nomor Job</label>
                                            <input type="text" class="form-control" id="nomor_job" name="nomor_job"
                                                onchange="handleChange(this)" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>ID Box Grading Kasar</label>
                                            <input type="text" class="form-control" id="id_box_grading_kasar"
                                                name="id_box_grading_kasar" onchange="handleChange(this)" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tujuan Kirim</label>
                                            <input type="text" class="form-control" id="tujuan_kirim" name="tujuan_kirim"
                                                onchange="handleChange(this)" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Nama Supplier</label>
                                            <input type="text" class="form-control" id="nama_supplier"
                                                name="nama_supplier" onchange="handleChange(this)" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Nomor Batch</label>
                                            <input type="text" class="form-control" id="nomor_batch" name="nomor_batch"
                                                onchange="handleChange(this)" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>ID Box Raw Material</label>
                                            <input type="text" class="form-control" id="id_box_raw_material"
                                                name="id_box_raw_material" onchange="handleChange(this)" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Jenis Raw Material</label>
                                            <input type="text" class="form-control" id="jenis_raw_material"
                                                name="jenis_raw_material" onchange="handleChange(this)" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Jenis Grading</label>
                                            <input type="text" class="form-control" id="jenis_grading"
                                                name="jenis_grading" onchange="handleChange(this)" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Berat Keluar</label>
                                            <input type="text" id="berat_keluar" class="form-control" name="berat_keluar"
                                                onchange="handleChange(this)" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>PCS Keluar</label>
                                            <input type="text" id="pcs_keluar" class="form-control" name="pcs_keluar"
                                                onchange="handleChange(this)" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>AVG Kadar Air</label>
                                            <input type="text" class="form-control" id="avg_kadar_air"
                                                name="avg_kadar_air" onchange="handleChange(this)" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Nomor Grading</label>
                                            <input type="text" id="nomor_grading" class="form-control"
                                                name="nomor_grading" onchange="handleChange(this)" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Modal</label>
                                            <input type="text" id="modal" class="form-control" name="modal"
                                                value="{{ 'modal' }}" onchange="handleChange(this)" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Total Modal</label>
                                            <input type="text" id="total_modal" class="form-control"
                                                name="total_modal" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>No Nota</label>
                                            <input type="text" id="nomor_nota_internal" class="form-control"
                                                name="nomor_nota_internal"
                                                onchange="handleChange(this.{{ 'nomor_nota_internal' }})" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <input type="text" id="keterangan" class="form-control" name="keterangan"
                                            placeholder="Masukkan keterangan">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    {{-- <button type="submit" class="btn btn-primary">Add</button> --}}
                                    <a href="#" class="btn btn-primary" onclick="sendData()">Submit</a>
                                    <a href="{{ url('/PreCleaningInput') }}" type="button" class="btn btn-danger"
                                        data-dismiss="modal">Close</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body" style="overflow: scroll" content="{{ csrf_token() }}">
                                <table class="table table-striped mt-3">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Nomor BSTB</th>
                                            <th class="text-center">ID Box Grading Kasar</th>
                                            <th class="text-center">Nomor Job</th>
                                            <th class="text-center">Nomor Batch</th>
                                            <th class="text-center">Nama Supplier</th>
                                            <th class="text-center">ID Box Raw Material</th>
                                            <th class="text-center">Jenis Raw Material</th>
                                            <th class="text-center">Jenis Grading</th>
                                            <th class="text-center">Berat Keluar</th>
                                            <th class="text-center">PCS Keluar</th>
                                            <th class="text-center">AVG Kadar Air</th>
                                            <th class="text-center">Tujuan Kirim</th>
                                            <th class="text-center">Nomor Grading</th>
                                            <th class="text-center">Modal</th>
                                            <th class="text-center">Total Modal</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableBody">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        // Inisialisasi dataArray
        var dataArray = {};
        $('#nomor_bstb').on('change', function() {
            // Mengambil nilai nomor_bstb yang dipilih
            let selectedIdBox = $(this).val();
            // Melakukan permintaan AJAX ke controller untuk mendapatkan nomor batch
            $.ajax({
                url: `{{ route('PreCleaningInput.set') }}`,
                method: 'GET',
                data: {
                    nomor_bstb: selectedIdBox
                },
                success: function(response) {
                    console.log(response[0]);
                    // Mengatur nilai Nomor Batch sesuai dengan respons dari server
                    $('#nomor_job').val(response[0].nomor_job);
                    $('#id_box_grading_kasar').val(response[0].id_box_grading_kasar);
                    $('#nomor_batch').val(response[0].nomor_batch);
                    $('#nama_supplier').val(response[0].nama_supplier);
                    $('#id_box_raw_material').val(response[0].id_box_raw_material);
                    $('#jenis_raw_material').val(response[0].jenis_raw_material);
                    $('#tujuan_kirim').val(response[0].tujuan_kirim);
                    $('#jenis_grading').val(response[0].jenis_grading);
                    $('#berat_keluar').val(response[0].berat_keluar);
                    $('#pcs_keluar').val(response[0].pcs_keluar);
                    $('#avg_kadar_air').val(response[0].avg_kadar_air);
                    $('#nomor_grading').val(response[0].nomor_grading);
                    $('#modal').val(response[0].modal);
                    $('#total_modal').val(response[0].total_modal);
                    $('#nomor_nota_internal').val(response[0].nomor_nota_internal);
                    // Contoh: Menampilkan data dalam tabel dengan jQuery
                    var tableBody = $(
                        '#tableBody'); // Ganti dengan ID atau selector yang sesuai dengan tabel Anda

                    // Bersihkan isi tabel sebelum menambahkan data baru
                    tableBody.empty();
                    // Loop melalui setiap baris data
                    $.each(response, function(index, rowData) {
                        var newRow = $('<tr>');
                        newRow.append('<td>' + rowData.nomor_job + '</td>');
                        newRow.append('<td>' + rowData.id_box_grading_kasar + '</td>');
                        newRow.append('<td>' + rowData.nomor_batch + '</td>');
                        newRow.append('<td>' + rowData.nama_supplier + '</td>');
                        newRow.append('<td>' + rowData.id_box_raw_material + '</td>');
                        newRow.append('<td>' + rowData.jenis_raw_material + '</td>');
                        newRow.append('<td>' + rowData.tujuan_kirim + '</td>');
                        newRow.append('<td>' + rowData.jenis_grading + '</td>');
                        newRow.append('<td>' + rowData.berat_keluar + '</td>');
                        newRow.append('<td>' + rowData.pcs_keluar + '</td>');
                        newRow.append('<td>' + rowData.avg_kadar_air + '</td>');
                        newRow.append('<td>' + rowData.nomor_grading + '</td>');
                        newRow.append('<td>' + rowData.modal + '</td>');
                        newRow.append('<td>' + rowData.total_modal + '</td>');
                        newRow.append('<td>' + rowData.nomor_nota_internal + '</td>');
                        // Lanjutkan dengan kolom-kolom lain sesuai kebutuhan

                        // Tambahkan baris ke dalam tabel
                        tableBody.append(newRow);
                        // Menyimpan data dalam dataArray
                        dataArray = {
                            nomor_bstb: rowData.nomor_bstb,
                            nomor_job: rowData.nomor_job,
                            jenis_kirim: rowData.jenis_kirim,
                            id_box_grading_kasar: rowData.id_box_grading_kasar,
                            nomor_batch: rowData.nomor_batch,
                            nama_supplier: rowData.nama_supplier,
                            id_box_raw_material: rowData.id_box_raw_material,
                            jenis_raw_material: rowData.jenis_raw_material,
                            tujuan_kirim: rowData.tujuan_kirim,
                            jenis_grading: rowData.jenis_grading,
                            berat_keluar: rowData.berat_keluar,
                            pcs_keluar: rowData.pcs_keluar,
                            avg_kadar_air: rowData.avg_kadar_air,
                            nomor_grading: rowData.nomor_grading,
                            modal: rowData.modal,
                            total_modal: rowData.total_modal,
                            nomor_nota_internal: rowData.nomor_nota_internal,
                            // ... tambahkan properti lain sesuai kebutuhan
                        };
                    });

                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });

        function sendData() {
            var doc_no = $('#doc_no').val() || '';
            var keterangan = $('#keterangan').val() || '';
            var user_created = $('#user_created').val() || '';
            console.log(dataArray);
            // Mengirim data ke server menggunakan AJAX
            $.ajax({
                url: `{{ route('PreCleaningInput.store') }}`, // Ganti dengan URL endpoint yang sesuai
                method: 'POST',
                beforeSend: function() {
                    Swal.fire({
                        title: 'Loading...',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        onBeforeOpen: () => {
                            Swal.showLoading();
                        }
                    });
                },
                data: {
                    nomor_bstb: dataArray.nomor_bstb,
                    nomor_job: dataArray.nomor_job,
                    id_box_grading_kasar: dataArray.id_box_grading_kasar,
                    nomor_batch: dataArray.nomor_batch,
                    nama_supplier: dataArray.nama_supplier,
                    id_box_raw_material: dataArray.id_box_raw_material,
                    jenis_raw_material: dataArray.jenis_raw_material,
                    tujuan_kirim: dataArray.tujuan_kirim,
                    jenis_kirim: dataArray.jenis_grading,
                    berat_kirim: dataArray.berat_keluar,
                    pcs_kirim: dataArray.pcs_keluar,
                    kadar_air: dataArray.avg_kadar_air,
                    nomor_grading: dataArray.nomor_grading,
                    modal: dataArray.modal,
                    total_modal: dataArray.total_modal,
                    nomor_nota_internal: dataArray.nomor_nota_internal,
                    doc_no: doc_no,
                    keterangan: keterangan,
                    user_created: user_created,
                    user_updated: 'Asc-186',
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    Swal.fire({
                        title: 'Alhamdulillah!',
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
                        title: 'Astaghfirullah!',
                        text: 'Terjadi kesalahan. Silakan coba lagi.',
                        icon: 'error'
                    });
                    console.log('Validation Errors:', response.responseJSON.errors);
                }
            });
        }

        // Variabel global untuk menyimpan indeks baris terakhir
        var currentRowIndex = 0;
        var dataStock = [];

        // Mendefinisikan array jika belum
        if (typeof dataArray === 'undefined') {
            var dataArray = [];
        }
    </script>
@endsection
