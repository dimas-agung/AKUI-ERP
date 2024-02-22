@extends('layouts.master1')
@section('menu')
    Pre-Grading Halus
@endsection
@section('title')
    Input Pre-Grading Halus
@endsection
@section('content')
    {{-- <div class="container"> --}}
    <div class="card border border-primary border-3 mt-2">
        <form action="{{ route('PreGradingHalusInput.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 shadow-sm rounded">
                        <div class="card-header">
                            <h4>Input Pre-Grading Halus</h4>
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
                                        <label>Unit</label>
                                        <select id="unit" class="select2 form-select" name="unit"
                                            data-placeholder="Pilih Unit">
                                            <option value="">Pilih Unit</option>
                                            @foreach ($Unit as $post)
                                                @php
                                                    $beratMasukShown = false; // Inisialisasi variabel untuk menandai apakah berat_masuk sudah ditampilkan atau belum
                                                @endphp
                                                @foreach ($Unit as $innerPost)
                                                    @if ($innerPost->nama == $post->nama && $innerPost->status > 0)
                                                        @if (!$beratMasukShown)
                                                            <option value="{{ $innerPost->nama }}">
                                                                {{ old('nama', $innerPost->nama) }}
                                                            </option>
                                                            @php
                                                                $beratMasukShown = true; // Set nilai variabel untuk menandai bahwa berat_masuk sudah ditampilkan
                                                            @endphp
                                                        @endif
                                                    @endif
                                                @endforeach
                                                @php
                                                    $selectedUnit = $post->nama; // Set nilai variabel dengan unit yang baru ditampilkan
                                                @endphp
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>No BSTB</label>
                                        <select id="nomor_bstb" class="select2 form-select" name="nomor_bstb"
                                            data-placeholder="Pilih Nomor BSTB">
                                            <option value="">Pilih Nomor BSTB</option>
                                            @php
                                                $selectedNomorBSTB = ''; // Inisialisasi variabel untuk menyimpan nomor_bstb yang sudah ditampilkan
                                            @endphp
                                            @foreach ($TransitPre as $post)
                                                @if ($selectedNomorBSTB != $post->nomor_bstb)
                                                    @php
                                                        $beratMasukShown = false; // Inisialisasi variabel untuk menandai apakah berat_masuk sudah ditampilkan atau belum
                                                    @endphp
                                                    @foreach ($TransitPre as $innerPost)
                                                        @if ($innerPost->nomor_bstb == $post->nomor_bstb && $innerPost->berat_kirim > 0)
                                                            @if (!$beratMasukShown)
                                                                <option value="{{ $innerPost->nomor_bstb }}">
                                                                    {{ old('nomor_bstb', $innerPost->nomor_bstb) }}
                                                                </option>
                                                                @php
                                                                    $beratMasukShown = true; // Set nilai variabel untuk menandai bahwa berat_masuk sudah ditampilkan
                                                                @endphp
                                                            @endif
                                                        @endif
                                                    @endforeach
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
                                            value="{{ old('user_created') }}" placeholder="Masukkan User Created">
                                    </div>
                                </div>
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
                <!-- Elemen dengan ID 'nomor_grading' -->
                <div class="card-body" style="overflow: scroll" content="{{ csrf_token() }}">
                    <table class="table table-striped mt-3">
                        <thead>
                            <tr>
                                <th class="text-center">Unit</th>
                                <th class="text-center">Nomor Job</th>
                                <th class="text-center">ID Box Grading Kasar</th>
                                <th class="text-center">ID Box Raw Material</th>
                                <th class="text-center">Nomor Batch</th>
                                <th class="text-center">Nomor nota internal</th>
                                <th class="text-center">Nama Supplier</th>
                                <th class="text-center">Jenis Raw Material</th>
                                <th class="text-center">Kadar Air</th>
                                <th class="text-center">Jenis Kirim</th>
                                <th class="text-center">Berat Kirim</th>
                                <th class="text-center">Pcs Kirim</th>
                                <th class="text-center">Tujuan Kirim</th>
                                <th class="text-center">Modal</th>
                                <th class="text-center">Total Modal</th>
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
        $('#unit').on('change', function() {
            // Mengambil nilai unit yang dipilih
            let selectedUnit = $(this).val();

            // Melakukan permintaan AJAX ke controller untuk mendapatkan data
            $.ajax({
                url: `{{ route('PreGradingHalusInput.setUnit') }}`,
                method: 'GET',
                data: {
                    unit: selectedUnit
                },
                success: function(response) {

                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });


        let selectedNomorBSTB = ''; // Variabel untuk menyimpan nomor BSTB yang dipilih sebelumnya
        $('#nomor_bstb').on('change', function() {
            // Mengambil nilai nomor_bstb yang dipilih
            let selectedIdBox = $(this).val();
            // Hanya lakukan permintaan AJAX jika nomor BSTB yang baru dipilih tidak sama dengan yang sebelumnya
            if (selectedNomorBSTB !== selectedIdBox) {
                selectedNomorBSTB = selectedIdBox; // Perbarui nomor BSTB yang dipilih sebelumnya

                // Melakukan permintaan AJAX ke controller untuk mendapatkan data
                $.ajax({
                    url: `{{ route('PreGradingHalusInput.set') }}`,
                    method: 'GET',
                    data: {
                        nomor_bstb: selectedIdBox
                    },
                    success: function(response) {
                        // Memeriksa apakah berat lebih dari 0 sebelum mengatur nilai elemen-elemen
                        if (response.length > 0 && response[0].berat_kirim > 0) {
                            var tableBody = $(
                                '#tableBody'
                            );
                            tableBody.empty();
                            // Mengatur nilai elemen-elemen sesuai dengan respons dari server
                            $.each(response, function(index, rowData) {
                                console.log(rowData);
                                var newRow = $('<tr>');
                                newRow.append('<td>' + $('#unit').val() + '</td>');
                                newRow.append('<td>' + rowData.nomor_job + '</td>');
                                newRow.append('<td>' + rowData.id_box_grading_kasar + '</td>');
                                newRow.append('<td>' + rowData.id_box_raw_material + '</td>');
                                newRow.append('<td>' + rowData.nomor_batch + '</td>');
                                newRow.append('<td>' + rowData.nomor_nota_internal + '</td>');
                                newRow.append('<td>' + rowData.nama_supplier + '</td>');
                                newRow.append('<td>' + rowData.jenis_raw_material + '</td>');
                                newRow.append('<td>' + rowData.kadar_air + '</td>');
                                newRow.append('<td>' + rowData.jenis_kirim + '</td>');
                                newRow.append('<td>' + rowData.berat_kirim + '</td>');
                                newRow.append('<td>' + rowData.pcs_kirim + '</td>');
                                newRow.append('<td>' + rowData.tujuan_kirim + '</td>');
                                newRow.append('<td>' + rowData.modal + '</td>');
                                newRow.append('<td>' + rowData.total_modal + '</td>');
                                // Lanjutkan dengan kolom-kolom lain sesuai kebutuhan

                                // Tambahkan baris ke dalam tabel
                                tableBody.append(newRow);
                                // Bersihkan dataArray sebelum menambahkan data baru
                                dataArray = [];
                                // Menyimpan data dalam dataArray
                                dataArray.push({
                                    unit: $('#unit').val(),
                                    nomor_bstb: rowData.nomor_bstb,
                                    nomor_job: rowData.nomor_job,
                                    jenis_kirim: rowData.jenis_kirim,
                                    nomor_batch: rowData.nomor_batch,
                                    id_box_grading_kasar: rowData.id_box_grading_kasar,
                                    nama_supplier: rowData.nama_supplier,
                                    id_box_raw_material: rowData.id_box_raw_material,
                                    jenis_raw_material: rowData.jenis_raw_material,
                                    jenis_kirim: rowData.jenis_kirim,
                                    berat_kirim: rowData.berat_kirim,
                                    pcs_kirim: rowData.pcs_kirim,
                                    tujuan_kirim: rowData.tujuan_kirim,
                                    kadar_air: rowData.kadar_air,
                                    modal: rowData.modal,
                                    total_modal: rowData.total_modal,
                                    nomor_nota_internal: rowData.nomor_nota_internal,
                                    // ... tambahkan properti lain sesuai kebutuhan
                                });
                            });
                            console.log(dataArray);
                        } else {
                            // Berat 0, mencegah pemilihan dan memberikan pesan kepada pengguna
                            // alert("Berat tidak boleh 0. Pilih nomor_bstb lain.");
                            Swal.fire({
                                title: 'Warning!',
                                text: 'Berat tidak boleh 0. Pilih nomor BSTB lain.',
                                icon: 'error'
                            }).then((result) => {
                                // Refresh halaman saat menekan tombol "OK" pada SweetAlert
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            });
                            // Reset nilai dropdown ke default atau sesuaikan dengan kebutuhan Anda
                            $('#nomor_bstb').val('');
                        }
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            }
        });


        function sendData() {
            // Mengirim data ke server menggunakan AJAX
            $.ajax({
                url: '{{ route('PreGradingHalusInput.store') }}',
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
                data: function() {
                    var postData = {
                        dataArray: JSON.stringify(dataArray), // Mengirim dataArray sebagai string JSON
                        user_created: $('#user_created').val() || '',
                        user_updated: 'Asc-186',
                        _token: '{{ csrf_token() }}'
                    };

                    // Hanya mengirim keterangan jika memiliki nilai
                    // if (keterangan.trim() !== '') {
                    //     postData.keterangan = keterangan;
                    // }

                    return postData;
                }(),
                success: function(response) {
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
                        title: 'Failed!',
                        text: 'Terjadi kesalahan. Silakan coba cek data kembali.',
                        icon: 'error'
                    });
                    console.log('Error:', error);
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
