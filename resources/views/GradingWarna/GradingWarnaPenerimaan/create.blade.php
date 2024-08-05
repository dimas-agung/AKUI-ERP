@extends('layouts.master1')
@section('menu')
    Grading Warna
@endsection
@section('title')
    Data Grading Warna Penerimaan
@endsection
@section('content')
    <div class="container">
        <div class="card border border-primary border-3 mt-2">
            <form action="{{ route('GradingWarnaPenerimaan.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-0 shadow-sm rounded">
                            <div class="card-header">
                                <h4>Input Data Grading Warna Penerimaan</h4>
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
                                    <!-- Bagian HTML -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="transit_asal">Transit Asal</label>
                                            <select id="transit_asal" class="select2 form-select" name="transit_asal"
                                                data-placeholder="Pilih Transit Asal">
                                                <option value="">Pilih Transit Asal</option>
                                                <option value="hancuran"
                                                    {{ old('transit_asal') == 'hancuran' ? 'selected' : '' }}>Dry A Hancuran
                                                </option>
                                                <option value="cabut"
                                                    {{ old('transit_asal') == 'cabut' ? 'selected' : '' }}>Dry A Cabut
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nomor_bstb">Nomor BSTB</label>
                                            <select id="nomor_bstb" class="select2 form-select" name="nomor_bstb"
                                                data-placeholder="Pilih Nomor BSTB">
                                                <option value="">Pilih Nomor BSTB</option>
                                                {{-- Berada di Transit Asal --}}
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>NIP Admin</label>
                                            <input type="text" id="user_created" class="form-control" name="user_created"
                                                value="{{ auth()->user()->nip }}" readonly>
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
                                                            <th class="text-center">Nomor Job</th>
                                                            <th class="text-center">Nomor BSTB</th>
                                                            <th class="text-center">Nomor Batch</th>
                                                            <th class="text-center">Tujuan Kirim</th>
                                                            <th class="text-center">Keterangan</th>
                                                            <th class="text-center">Berat Kotor</th>
                                                            <th class="text-center">Jenis Grading</th>
                                                            <th class="text-center">Berat 1 Grading</th>
                                                            <th class="text-center">Pcs 1 Grading</th>
                                                            <th class="text-center">Berat 2 Grading</th>
                                                            <th class="text-center">Modal</th>
                                                            <th class="text-center">Total Modal</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tableBody">
                                                    </tbody>
                                                </table>
                                                <div class="col-md-12">
                                                    {{-- <button type="submit" class="btn btn-primary">Add</button> --}}
                                                    <a href="#" class="btn btn-primary"
                                                        onclick="CeksendData()">Submit</a>
                                                    <a href="{{ Route('GradingWarnaPenerimaan.index') }}" type="button"
                                                        class="btn btn-danger" data-dismiss="modal">Close</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
        $(document).ready(function() {
            $('#transit_asal').on('change', function() {
                let typeTransit = $(this).val();
                let targetSelect = $('#nomor_bstb');

                // Clear the options before making the AJAX call
                targetSelect.empty();
                targetSelect.append(
                                            `<option value="">-- Pilih BSTB --</option>`
                );
                switch (typeTransit) {
                    case 'hancuran':
                        $.ajax({
                            url: '{{ route('GradingWarnaPenerimaan.getDataHancuran') }}',
                            method: 'GET',
                            async: false,
                            success: function(response) {
                                let dataTransit = response;
                                let uniqueNomorBstb = new Set();

                                dataTransit.forEach(v => {
                                    if (!uniqueNomorBstb.has(v.nomor_bstb)) {
                                        uniqueNomorBstb.add(v.nomor_bstb);
                                        targetSelect.append(
                                            `<option value="${v.nomor_bstb}" class="hancuran">${v.nomor_bstb}</option>`
                                        );
                                    }
                                });
                            },
                            error: function(error) {
                                console.error('Error fetching data:', error);
                            }
                        });
                        break;
                    case 'cabut':
                        $.ajax({
                            url: '{{ route('GradingWarnaPenerimaan.getDataCabut') }}',
                            method: 'GET',
                            async: false,
                            success: function(response) {
                                let dataTransit = response;
                                let uniqueNomorBstb = new Set();

                                dataTransit.forEach(v => {
                                    if (!uniqueNomorBstb.has(v.nomor_bstb)) {
                                        uniqueNomorBstb.add(v.nomor_bstb);
                                        targetSelect.append(
                                            `<option value="${v.nomor_bstb}" class="cabut">${v.nomor_bstb}</option>`
                                        );
                                    }
                                });
                            },
                            error: function(error) {
                                console.error('Error fetching data:', error);
                            }
                        });
                        break;
                    default:
                        break;
                }
            });

            $('#nomor_bstb').on('change', function() {
                let selectedIdBox = $(this).val();
                let typeTransit = $('#transit_asal').val();
                let url = typeTransit === 'hancuran' ?
                    '{{ route('GradingWarnaPenerimaan.setHancuran') }}' :
                    '{{ route('GradingWarnaPenerimaan.setCabut') }}';

                $.ajax({
                    url: url,
                    method: 'GET',
                    data: {
                        nomor_bstb: selectedIdBox
                    },
                    success: function(response) {
                        var tableBody = $('#tableBody');
                        tableBody.empty();

                        // Menghapus dataArray sebelum menambahkan data baru
                        dataArray = [];

                        response.forEach(function(rowData) {
                            var newRow = $('<tr>');
                            newRow.append('<td>' + (rowData.nomor_job || '') + '</td>');
                            newRow.append('<td>' + rowData.nomor_bstb + '</td>');
                            newRow.append('<td>' + (rowData.nomor_batch || '') +
                                '</td>');
                            newRow.append('<td>' + rowData.tujuan_kirim + '</td>');
                            newRow.append('<td>' + (rowData.keterangan || '') +
                                '</td>');
                            newRow.append('<td>' + (rowData.berat_kotor || 0) +
                                '</td>');
                            newRow.append('<td>' + rowData.jenis_grading + '</td>');
                            newRow.append('<td>' + (rowData.berat_1_grading || 0) +
                                '</td>');

                            let berat2Grading = typeTransit === 'hancuran' ? rowData
                                .berat_job : (rowData.berat_2_grading || 0);
                            newRow.append('<td>' + (rowData.pcs_1_grading || 0) +
                                '</td>');
                            newRow.append('<td>' + berat2Grading + '</td>');
                            newRow.append('<td>' + rowData.modal + '</td>');
                            newRow.append('<td>' + rowData.total_modal + '</td>');

                            tableBody.append(newRow);

                            dataArray.push({
                                nomor_job: rowData.nomor_job || '',
                                nomor_bstb: rowData.nomor_bstb,
                                nomor_batch: rowData.nomor_batch || '',
                                tujuan_kirim: rowData.tujuan_kirim,
                                keterangan: rowData.keterangan || '',
                                berat_kotor: rowData.berat_kotor || 0,
                                jenis_grading: rowData.jenis_grading,
                                berat_1_grading: rowData.berat_1_grading || 0,
                                pcs_1_grading: rowData.pcs_1_grading || 0,
                                berat_2_grading: berat2Grading,
                                modal: rowData.modal,
                                total_modal: rowData.total_modal
                            });
                        });
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            });
        });
    </script>
    <script>
        function CeksendData() {
            var i = 0;
            var idBoxes = []; // Array untuk menyimpan id box yang akan dicek
            var typeTransit = $('#transit_asal').val(); // Ambil nilai transit asal

            // Mengumpulkan id box dari dataArray
            dataArray.forEach(function(item) {
                idBoxes.push(item.nomor_bstb);
            });

            // Mengirimkan permintaan AJAX untuk memeriksa ketersediaan id box
            $.ajax({
                url: `{{ route('GradingWarnaPenerimaan.CeksendData') }}`, // Ganti dengan URL endpoint yang sesuai untuk memeriksa
                method: 'POST',
                data: {
                    idBoxes: JSON.stringify(idBoxes),
                    typeTransit: typeTransit, // Tambahkan typeTransit ke data yang dikirim
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(response) {
                    var unavailableBoxes = response.unavailableBoxes;

                    if (unavailableBoxes.length > 0) {
                        // Ada id box yang tidak tersedia, tampilkan pesan kesalahan
                        Swal.fire({
                            title: 'Error!',
                            text: 'Beberapa nomor bstb sudah tidak tersedia.',
                            icon: 'error',
                            showCancelButton: false, // Sembunyikan tombol cancel
                            confirmButtonText: 'OK' // Ganti teks tombol konfirmasi
                        }).then((result) => {
                            // Jika pengguna menekan tombol "OK", refresh halaman
                            if (result.isConfirmed) {
                                location.reload(); // Refresh halaman
                            }
                        });
                    } else {
                        // Semua id box tersedia, kirim data ke server
                        sendData();
                    }
                },
                error: function(error) {
                    Swal.fire({
                        title: 'Failed!',
                        text: 'Terjadi kesalahan saat memeriksa ketersediaan nomor bstb. Silakan coba lagi.',
                        icon: 'error'
                    });
                    console.log('Error:', error);
                }
            });

            function sendData() {
                var nomor_bstb = $('#nomor_bstb').val() || '';
                // Mengirim data ke server menggunakan AJAX
                $.ajax({
                    url: '{{ route('GradingWarnaPenerimaan.store') }}',
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
                            nomor_bstb: nomor_bstb,
                            user_created: $('#user_created').val() || '',
                            user_updated: $('#user_createds').val() || '',
                            _token: '{{ csrf_token() }}'
                        };

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
