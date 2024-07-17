@extends('layouts.master1')
@section('menu')
    Dry A Output
@endsection
@section('title')
    Data Dry A Output Cabut Input
@endsection
@section('content')
    <div class="container">
        <div class="card border border-primary border-3 mt-2">
            <form action="{{ route('DryAOutput.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-0 shadow-sm rounded">
                            <div class="card-header">
                                <h4>Input Data Dry A Output Cabut Input</h4>
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
                                            <label>Nomer Job</label>
                                            <select id="nomor_job" class="select2 form-select" name="nomor_job"
                                                data-placeholder="Pilih Nomor Job">
                                                <option value="">Pilih Nomor Job</option>
                                                @php
                                                    $selectedNomorBSTB = ''; // Inisialisasi variabel untuk menyimpan nomor_job yang sudah ditampilkan
                                                @endphp
                                                @foreach ($DryAGradingCabutStock as $nomor_job)
                                                    @if (!str_contains($nomor_job,Auth::user()->plant))
                                                        @php

                                                            continue;
                                                        @endphp
                                                    @endif
                                                                    <option value="{{ $nomor_job }}">
                                                                        {{ old('nomor_job', $nomor_job) }}
                                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Nomer BSTB</label>
                                            <input type="text" id="nomor_bstb" class="form-control" name="nomor_bstb"
                                                placeholder="Masukkan Nomer BSTB" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>NIP Admin</label>
                                            <input type="text" id="user_created" class="form-control" name="user_created"
                                                value="{{ auth()->user()->nip }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Total Berat</label>
                                            <input type="text" id="total_berat" class="form-control" name="total_berat"
                                                placeholder="Masukkan Total Berat" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Total Pcs</label>
                                            <input type="text" id="total_pcs" class="form-control" name="total_pcs"
                                                placeholder="Masukkan Total Pcs" readonly>
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
                                                    <tbody id="tableBodyTemp">
                                                    </tbody>
                                                </table>
                                                <div class="col-md-12">
                                                    <a class="btn btn-primary"
                                                        onclick="addRow()">Add</a>

                                                </div>
                                                <table class="table table-striped mt-3" id="dataTable">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Nomor Job</th>
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
                                                    <a href="{{ Route('DryAOutput.index') }}" type="button"
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
        // Inisialisasi dataArray
        var dataArray = [];
        var dataArrayTemp = [];
        let selectedNomorBSTB = ''; // Variabel untuk menyimpan nomor BSTB yang dipilih sebelumnya

        $('#nomor_job').on('change', function() {
            let selectedIdBox = $(this).val();
            if (selectedIdBox == "") {
                $('#total_berat').val(null);
                $('#total_pcs').val(null);
                return;
            }
            let  countjenisAlreadyTake =0
            dataArray.forEach(e => {
                if (e.nomor_job == selectedIdBox) {
                    Swal.fire({
                    title: 'Warning!',
                    text: "Nomor Job Sudah pernah ditambahkan sebelumnya.",
                    icon: 'warning'
                });
                countjenisAlreadyTake =1;
                 $('#nomor_job').val(null).trigger('change');
                return;
                }
            });
            if (countjenisAlreadyTake == 0) {
                // Hanya lakukan permintaan AJAX jika nomor BSTB yang baru dipilih tidak sama dengan yang sebelumnya
                if (selectedNomorBSTB !== selectedIdBox) {
                    selectedNomorBSTB = selectedIdBox; // Perbarui nomor BSTB yang dipilih sebelumnya
                    dataArrayTemp = [];
                    $.ajax({
                        url: `{{ route('DryAOutput.set') }}`,
                        method: 'GET',
                        data: {
                            nomor_job: selectedIdBox
                        },
                        success: function(response) {
                            if (response.length > 0 && response[0].berat_kotor > 0) {
                                var tableBody = $('#tableBodyTemp');
                                tableBody.empty();

                                // Menghapus dataArray sebelum menambahkan data baru
                                dataArrayTemp = [];

                                // Inisialisasi variabel untuk menjumlahkan berat dan pcs
                                let totalBerat1Grading = 0;
                                let totalBerat2Grading = 0;
                                let totalPcs1Grading = 0;

                                // Iterasi melalui setiap data yang diterima
                                response.forEach(function(rowData) {
                                    var newRow = $('<tr>');
                                    // Tambahkan kolom-kolom sesuai kebutuhan
                                    newRow.append('<td>' + rowData.nomor_job + '</td>');
                                    newRow.append('<td>' + rowData.nomor_batch + '</td>');
                                    newRow.append('<td>' + rowData.tujuan_kirim + '</td>');
                                    newRow.append('<td>' + rowData.keterangan + '</td>');
                                    newRow.append('<td>' + rowData.berat_kotor + '</td>');
                                    newRow.append('<td>' + rowData.jenis_grading + '</td>');
                                    newRow.append('<td>' + rowData.berat_1_grading + '</td>');
                                    newRow.append('<td>' + rowData.pcs_1_grading + '</td>');
                                    newRow.append('<td>' + rowData.berat_2_grading + '</td>');
                                    newRow.append('<td>' + rowData.modal + '</td>');
                                    newRow.append('<td>' + rowData.total_modal + '</td>');

                                    // Tambahkan baris ke dalam tabel
                                    tableBody.append(newRow);

                                    // Menambahkan data ke dalam dataArray
                                    dataArrayTemp.push({
                                        nomor_batch: rowData.nomor_batch,
                                        nomor_job: rowData.nomor_job,
                                        tujuan_kirim: rowData.tujuan_kirim,
                                        keterangan: rowData.keterangan,
                                        berat_kotor: rowData.berat_kotor,
                                        jenis_grading: rowData.jenis_grading,
                                        berat_1_grading: rowData.berat_1_grading,
                                        pcs_1_grading: rowData.pcs_1_grading,
                                        berat_2_grading: rowData.berat_2_grading,
                                        modal: rowData.modal,
                                        total_modal: rowData.total_modal,
                                    });

                                    // Tambahkan berat dan pcs grading ke total
                                    totalBerat1Grading += parseFloat(rowData.berat_1_grading);
                                    totalBerat2Grading += parseFloat(rowData.berat_2_grading);
                                    totalPcs1Grading += parseFloat(rowData.pcs_1_grading);
                                });

                                // Update nilai total berat di inputan #total_berat
                                let totalBerat = totalBerat1Grading + totalBerat2Grading;
                                $('#total_berat').val(totalBerat);

                                // Update nilai total pcs di inputan #total_pcs
                                $('#total_pcs').val(totalPcs1Grading);
                            } else {
                                // Berat 0, mencegah pemilihan dan memberikan pesan kepada pengguna
                                Swal.fire({
                                    title: 'Warning!',
                                    text: 'Berat tidak boleh 0. Pilih nomor BSTB lain.',
                                    icon: 'error'
                                })
                                $('#nomor_job').val('');
                            }
                        },
                        error: function(error) {
                            console.error('Error:', error);
                        }
                    });
                }
            }
        });
        function addRow() {

            // Mengubah atribut readonly menggunakan jQuery
            // $('#nomor_adjustment').prop('readonly', true);
            // $('#tanggal_adjustment').prop('readonly', true); // Jika ingin menjadikan select readonly

            var tableBodyTemp = $('#tableBodyTemp');
            tableBodyTemp.empty();
            var tableBody = $('#tableBody');
            if (dataArrayTemp === undefined || dataArrayTemp.length == 0) {
                 // Berat 0, mencegah pemilihan dan memberikan pesan kepada pengguna
                 Swal.fire({
                                title: 'Warning!',
                                text: 'Data Tidak boleh Kosong.',
                                icon: 'error'
                            })
                return;
            }

                // Menambahkan data ke dalam tabel
            dataArrayTemp.forEach(function(rowData) {

                                // // Tambahkan baris ke dalam tabel
                                var newRow = `<tr>` +
                                `<td class="text-center">${rowData.nomor_job}</td>` +
                                `<td class="text-center">${rowData.nomor_batch}</td>` +
                                `<td class="text-center">${rowData.tujuan_kirim}</td>` +
                                `<td class="text-center">${rowData.keterangan}</td>` +
                                `<td class="text-center">${rowData.berat_kotor}</td>` +
                                `<td class="text-center">${rowData.jenis_grading}</td>` +
                                `<td class="text-center">${rowData.berat_1_grading}</td>` +
                                `<td class="text-center">${rowData.pcs_1_grading}</td>` +
                                `<td class="text-center">${rowData.berat_2_grading}</td>` +
                                `<td class="text-center">${rowData.modal}</td>` +
                                `<td class="text-center">${rowData.total_modal}</td>` +
                                // `<td class="text-center">${fix_harga_deal.toFixed(4)}</td>` +
                                `<td class="text-center"><button class="btn btn-danger" onclick="hapusBaris(this)">Delete</button></td>` +
                                `</tr>`
                                // tableBody.append(row);

                                $('#dataTable tbody').append(newRow);
                                dataArray.push({
                                    nomor_batch: rowData.nomor_batch,
                                    nomor_job: rowData.nomor_job,
                                    tujuan_kirim: rowData.tujuan_kirim,
                                    keterangan: rowData.keterangan,
                                    berat_kotor: rowData.berat_kotor,
                                    jenis_grading: rowData.jenis_grading,
                                    berat_1_grading: rowData.berat_1_grading,
                                    pcs_1_grading: rowData.pcs_1_grading,
                                    berat_2_grading: rowData.berat_2_grading,
                                    modal: rowData.modal,
                                    total_modal: rowData.total_modal,
                                });
            });
            dataArrayTemp = [];
            console.log(dataArray);
            // $('#nomor_job option:first').prop('selected',true);
            // $('#nomor_job').prop('selectedIndex',0);

            $('#nomor_job').val("").trigger( "change" );
            // $('#nomor_job').val(null).trigger('change');
                // $('#dataTable tbody').append(newRow);


            // Menambahkan data ke dalam array
        }


        $(document).ready(function() {
            // Menangani perubahan pada dropdown nomor_job
            $('#nomor_job').on('change', function() {
                // Memanggil fungsi generateNomorBSTB ketika nomor_job berubah
                generateNomorBSTB();
            });

            // Fungsi untuk generate nomor_bstb
            function generateNomorBSTB() {
                const now = new Date();
                const tahun = now.getFullYear().toString().substr(-2);
                const bulan = ('0' + (now.getMonth() + 1)).slice(-2);
                const tanggal = ('0' + now.getDate()).slice(-2);
                const jam = ('0' + now.getHours()).slice(-2);
                const menit = ('0' + now.getMinutes()).slice(-2);
                const detik = ('0' + now.getSeconds()).slice(-2);
                const plant = '{{Auth::user()->plant}}';
                // Menghasilkan nomor_bstb berdasarkan rumus yang diinginkan
                const nomor_bstb = `BSTB_${tanggal}${bulan}${tahun}-${jam}${menit}${detik}_UDA_${plant}`;

                // Memasukkan nilai yang dihasilkan ke dalam input nomor_bstb
                $('#nomor_bstb').val(nomor_bstb);
                console.log(nomor_bstb);
            }
        });

        function CeksendData() {
            var i = 0;
            var idBoxes = []; // Array untuk menyimpan id box yang akan dicek

            // Mengumpulkan id box dari dataArray
            dataArray.forEach(function(item) {
                idBoxes.push(item.nomor_job);
            });

            // Mengirimkan permintaan AJAX untuk memeriksa ketersediaan id box
            $.ajax({
                url: `{{ route('DryAOutput.CeksendData') }}`, // Ganti dengan URL endpoint yang sesuai untuk memeriksa ketersediaan id box
                method: 'POST',
                data: {
                    idBoxes: JSON.stringify(idBoxes),
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(response) {
                    var unavailableBoxes = response.unavailableBoxes;

                    if (unavailableBoxes.length > 0) {
                        // Ada id box yang tidak tersedia, tampilkan pesan kesalahan
                        Swal.fire({
                            title: 'Error!',
                            text: 'Beberapa nomor job sudah tidak tersedia.',
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
                        text: 'Terjadi kesalahan saat memeriksa ketersediaan nomor job. Silakan coba lagi.',
                        icon: 'error'
                    });
                    console.log('Error:', error);
                }
            });

            function sendData() {
                var nomor_bstb = $('#nomor_bstb').val() || '';

                // Mengirim data ke server menggunakan AJAX
                $.ajax({
                    url: '{{ route('DryAOutput.store') }}',
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
