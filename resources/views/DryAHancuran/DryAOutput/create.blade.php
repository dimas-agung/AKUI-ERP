@extends('layouts.master1')
@section('menu')
    Dry A Output
@endsection
@section('title')
    Data Dry A Output Hancuran Input
@endsection
@section('content')
    {{-- <div class="container"> --}}
    <div class="card border border-primary border-3 mt-2">
        <form action="{{ route('DryAOutputHancuran.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 shadow-sm rounded">
                        <div class="card-header">
                            <h4>Input Data Dry A Output Hancuran Input</h4>
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
                                        <label>Jenis Grading</label>
                                        <select id="jenis_grading" class="select2 form-select" name="jenis_grading"
                                            data-placeholder="Pilih Jenis Grading">
                                            <option value="">Pilih Jenis Grading</option>
                                            @foreach ($stockTGK as $post)
                                                @if ($post->plant != Auth::user()->plant)
                                                    @php
                                                        continue;
                                                    @endphp
                                                @endif
                                                @if ($post->sisa_berat > 0)
                                                    <option value="{{ $post->jenis_grading }}">
                                                        {{ old('jenis_grading', $post->jenis_grading) }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tujuan Kirim</label>
                                        <select id="tujuan_kirim" class="select2 form-select" name="tujuan_kirim"
                                            data-placeholder="Pilih Tujuan Kirim">
                                            <option value="">Pilih Tujuan Kirim</option>
                                            @foreach ($MasTujKir as $post)
                                                @php
                                                    $beratMasukShown = false; // Inisialisasi variabel untuk menandai apakah berat_masuk sudah ditampilkan atau belum
                                                @endphp
                                                @foreach ($MasTujKir as $innerPost)
                                                    @if ($innerPost->tujuan_kirim == $post->tujuan_kirim && $innerPost->status > 0)
                                                        @if (!$beratMasukShown)
                                                            <option value="{{ $innerPost->inisial_tujuan }}">
                                                                {{ old('tujuan_kirim', $innerPost->tujuan_kirim) }}
                                                            </option>
                                                            @php
                                                                $beratMasukShown = true; // Set nilai variabel untuk menandai bahwa berat_masuk sudah ditampilkan
                                                            @endphp
                                                        @endif
                                                    @endif
                                                @endforeach
                                                @php
                                                    $selectedNomorBSTB = $post->tujuan_kirim; // Set nilai variabel dengan nomor_bstb yang baru ditampilkan
                                                @endphp
                                            @endforeach
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
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nomer BSTB</label>
                                        <input type="text" id="nomor_bstb" class="form-control" name="nomor_bstb"
                                            placeholder="Masukkan Nomer BSTB" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nomer Job</label>
                                        <input type="text" id="nomor_job" class="form-control" name="nomor_job"
                                            placeholder="Masukkan Nomer Job" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Modal</label>
                                        <input type="text" id="modal" class="form-control" name="modal" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Berat Masuk</label>
                                        <input type="text" id="berat_masuk" class="form-control" name="berat_masuk"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Total Berat</label>
                                        <input type="text" id="total_berat" class="form-control" name="total_berat"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Berat Keluar</label>
                                        <input type="text" id="berat_job" class="form-control" name="berat_job"
                                            placeholder="Silahkan isi Berat keluar">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Sisa Berat</label>
                                        <input type="text" id="sisa_berat" class="form-control" name="sisa_berat"
                                            readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="button" class="btn btn-primary" onclick="addRow()">Add</button>
                                <a href="{{ Route('DryAPenerimaanHancuran.index') }}" type="button" class="btn btn-danger"
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
                </div>
                <!-- Elemen dengan ID 'nomor_grading' -->
                <div class="card-body" style="overflow: scroll" content="{{ csrf_token() }}">
                    <div class="card-title">Validasi Data Input</div>
                    <table class="table table-striped mt-3">
                        <thead>
                            <tr>
                                <th class="text-center">Jenis Grading</th>
                                <th class="text-center">Nomor Job</th>
                                <th class="text-center">Nomor BSTB</th>
                                <th class="text-center">Berat Job</th>
                                <th class="text-center">Tujuan Kirim</th>
                                <th class="text-center">Modal</th>
                                <th class="text-center">Total Modal</th>
                                <th class="text-center">User Created</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                        </tbody>
                    </table>
                    <div class="col-md-12">
                        {{-- <button type="submit" class="btn btn-primary">Add</button> --}}
                        <a href="#" class="btn btn-primary" onclick="CeksendData()">Submit</a>
                        <a href="{{ Route('DryAOutputHancuran.index') }}" type="button" class="btn btn-danger"
                            data-dismiss="modal">Close</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
    {{-- </div> --}}
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#jenis_grading').on('change', function() {
                let selectedJenisGrading = $(this).val();
                $.ajax({
                    url: `{{ route('DryAOutputHancuran.set') }}`,
                    method: 'GET',
                    data: {
                        jenis_grading: selectedJenisGrading
                    },
                    success: function(response) {
                        if (response.length > 0) {
                            $('#berat_masuk').val(response[0].berat_masuk);
                            $('#modal').val(response[0].modal);
                        } else {
                            $('#berat_masuk').val('');
                        }
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            });
        });


        // Ketika terjadi perubahan pada elemen dengan id 'tujuan_kirim'
        $('#tujuan_kirim').on('change', function() {
            // Mengambil nilai tujuan_kirim yang dipilih
            let selectedPcc = $(this).val();

            // Melakukan permintaan AJAX ke controller untuk mendapatkan data
            $.ajax({
                url: '{{ route('DryAOutputHancuran.setpcc') }}',
                method: 'GET',
                data: {
                    tujuan_kirim: selectedPcc
                },
                success: function(response) {
                    if (response.status > 0) {
                        // Mengatur nilai elemen-elemen sesuai dengan respons dari server
                        $('#inisial_tujuan').val(response.inisial_tujuan);

                        // Memeriksa apakah nomor_bstb sudah terisi, jika belum maka diisi
                        if (!tombolAddDiklik) {
                            const nomor_bstb = generateNomorBSTB(response.inisial_tujuan, 'BSTB');
                            $('#nomor_bstb').val(nomor_bstb);
                        }

                        // Memeriksa apakah nomor_job sudah terisi, jika belum maka diisi
                        // if (!tombolAddDiklik) {
                        const nomor_job = generateNomorBSTB(response.inisial_tujuan, 'JOB');
                        $('#nomor_job').val(nomor_job);
                        // }
                    }
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });

        function generateNomorBSTB(inisial_tujuan, prefix) {
            let nomor;
            const existingNomorJobs = dataArray.map(data => data
                .nomor_job); // dataArray harus diisi dengan data yang sesuai

            do {
                const now = new Date();
                const tahun = now.getFullYear().toString().substr(-2);
                const bulan = ('0' + (now.getMonth() + 1)).slice(-2);
                const tanggal = ('0' + now.getDate()).slice(-2);
                const jam = ('0' + now.getHours()).slice(-2);
                const menit = ('0' + now.getMinutes()).slice(-2);
                const detik = ('0' + now.getSeconds()).slice(-2);

                // Menambahkan prefix yang sesuai
                nomor = `${tanggal}${bulan}${tahun}-${jam}${menit}${detik}_${inisial_tujuan}_UDA`;
                if (prefix === 'BSTB') {
                    nomor = `BSTB_${nomor}`;
                }
                // Memeriksa apakah nomor job yang dihasilkan sudah ada dalam data yang sudah diinputkan sebelumnya
            } while (existingNomorJobs.includes(nomor));

            return nomor;
        }

        // Event handler untuk saat nilai berat keluar berubah
        $('#berat_job').on('input', function() {
            updateSisaBerat();
        });

        // Fungsi untuk mengupdate nilai sisa berat
        function updateSisaBerat() {
            let beratMasuk = parseFloat($('#berat_masuk').val());
            let beratKeluar = parseFloat($('#berat_job').val());

            // Memeriksa apakah nilai berat keluar valid
            if (isNaN(beratKeluar)) {
                beratKeluar = 0; // Jika tidak valid, set nilai berat keluar ke 0
                $('#berat_job').val(0); // Set nilai input berat keluar menjadi 0
            }

            let sisaBerat = beratMasuk - beratKeluar;
            $('#sisa_berat').val(sisaBerat);
        }

        // Variabel penanda untuk menandai apakah tombol "add" sudah diklik atau belum
        let tombolAddDiklik = false;

        // Ketika tombol "add" diklik
        $('#tombol_add').on('click', function() {
            // Set variabel penanda menjadi true
            tombolAddDiklik = true;
        });

        $(document).ready(function() {
            $('#berat_job').on('input', function() {
                var berat = parseFloat($(this).val());
                var berat_masuk = parseFloat($('#berat_masuk').val());

                if (berat > berat_masuk) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Berat keluar tidak boleh lebih dari berat masuk.',
                        icon: 'error'
                    });
                    $(this).val(''); // Kosongkan input berat jika nilai tidak valid
                }
            });
        });

        // Hitung Total Berat
        function hitungTotalBerat() {
            let totalBerat = 0;
            // Iterasi melalui setiap baris dalam tabel
            $('#tableBody tr').each(function() {
                // Mendapatkan nilai berat adding dari baris saat ini dan menambahkannya ke totalBerat
                let beratGrading = parseFloat($(this).find('td:eq(3)').text()) || 0;
                totalBerat += beratGrading;
            });
            // Menampilkan total berat di input #total_berat
            $('#total_berat').val(totalBerat);
            console.log(totalBerat);
        }

        // Variabel global untuk menyimpan indeks baris terakhir
        var currentRowIndex = 0;
        var dataArray = [];

        function addRow() {
            // Mengambil nilai dari input
            var jenis_grading = $('#jenis_grading').val();
            var berat_job = $('#berat_job').val();
            var nomor_job = $('#nomor_job').val();
            var berat_masuk = $('#berat_masuk').val();
            var nomor_bstb = $('#nomor_bstb').val();
            var tujuan_kirim = $('#tujuan_kirim').val();
            var modal = $('#modal').val();
            var user_created = $('#user_created').val();

            // Inisialisasi array untuk menyimpan field yang belum terisi
            let fieldsNotFilled = [];
            // Periksa setiap field
            if (!jenis_grading) fieldsNotFilled.push('Jenis Grading');
            if (!tujuan_kirim) fieldsNotFilled.push('Tujuan Kirim');
            if (!berat_job) fieldsNotFilled.push('Berat Keluar');

            // Cek apakah ada field yang belum terisi
            if (fieldsNotFilled.length > 0) {
                // Membuat pesan teks yang mencantumkan field yang belum terisi
                let message = `Data belum diinputkan untuk: ${fieldsNotFilled.join(', ')}. Silakan lengkapi form.`;

                Swal.fire({
                    title: 'Warning!',
                    text: message,
                    icon: 'warning'
                });
                return;
            }

            // Menghitung total modal
            var total_modal = berat_job * modal;

            var newRow = '<tr>' +
                '<td>' + jenis_grading + '</td>' +
                '<td>' + nomor_job + '</td>' +
                '<td>' + nomor_bstb + '</td>' +
                '<td>' + berat_job + '</td>' +
                '<td>' + tujuan_kirim + '</td>' +
                '<td>' + modal + '</td>' +
                '<td>' + total_modal + '</td>' +
                '<td>' + user_created + '</td>' +
                '</td><td><button class="btn btn-danger" onclick="hapusBaris(this)">Delete</button></td></tr>';

            $('#tableBody').append(newRow);

            hitungTotalBerat();

            // Menambahkan data ke dalam array
            // dataArrayDocNo.push(doc_no)
            dataArray.push({
                jenis_grading: jenis_grading,
                nomor_job: nomor_job,
                nomor_bstb: nomor_bstb,
                berat_job: berat_job,
                tujuan_kirim: tujuan_kirim,
                modal: modal,
                total_modal: total_modal,
                user_created: user_created,
            });

            // Membersihkan nilai input setelah ditambahkan
            $('#sisa_berat').val('');
            $('#berat_masuk').val('');
            $('#berat_job').val('');
            $('#modal').val('');
            $('#jenis_grading').val(null).trigger('change');
            $('#tujuan_kirim').prop('disabled', true);

            // Update indeks baris terakhir
            currentRowIndex++;
        }

        // Ambil indeks terakhir sebelum menghapus baris
        var lastRowIndex = currentRowIndex;


        // Hapus Baris
        function hapusBaris(button) {
            // Dapatkan elemen baris terkait dengan tombol delete yang diklik
            let row = $(button).closest('tr');

            // Hapus baris dari tabel
            row.remove();

            // Hapus baris dari dataArray berdasarkan indeks baris di tabel
            let rowIndex = row.index();
            dataArray.splice(rowIndex, 1);

            // Cek apakah tabel tidak memiliki baris data lagi
            if ($('#tableBody tr').length === 0) {
                $('#tujuan_kirim').prop('disabled', false).val(null).trigger('change');
                $('#nomor_job').val('');
                $('#nomor_bstb').val('');
                hitungTotalBerat();
            } else {
                hitungTotalBerat();
            }
        }

        function CeksendData() {
            var i = 0;
            var idBoxes = []; // Array untuk menyimpan id box yang akan dicek

            // Mengumpulkan id box dari dataArray
            dataArray.forEach(function(item) {
                idBoxes.push(item.jenis_grading);
            });

            // Mengirimkan permintaan AJAX untuk memeriksa ketersediaan id box
            $.ajax({
                url: `{{ route('DryAOutputHancuran.CeksendData') }}`, // Ganti dengan URL endpoint yang sesuai untuk memeriksa ketersediaan id box
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
                            text: 'Beberapa jenis grading sudah tidak tersedia.',
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
                        text: 'Terjadi kesalahan saat memeriksa ketersediaan jenis grading. Silakan coba lagi.',
                        icon: 'error'
                    });
                    console.log('Error:', error);
                }
            });

            function sendData() {
                var jenis_grading = $('#jenis_grading').val() || '';

                // Mengirim data ke server menggunakan AJAX
                $.ajax({
                    url: '{{ route('DryAOutputHancuran.store') }}',
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
