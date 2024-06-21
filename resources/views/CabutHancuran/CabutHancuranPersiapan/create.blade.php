@extends('layouts.master1')
@section('menu')
    Cabut Hancuran
@endsection
@section('title')
    Data Cabut Hancuran Persiapan
@endsection
@section('content')
    <div class="container">
        <div class="card border border-primary border-3 mt-2">
            <form action="{{ route('CabutHancuranPersiapan.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-0 shadow-sm rounded">
                            <div class="card-header">
                                <h4>Input Data Cabut Hancuran Persiapan</h4>
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
                                            <label>ID Box HCR Kotor</label>
                                            {{-- <select id="id_stock_hcr_kotor" class="select2 form-select"
                                                name="id_stock_hcr_kotor" data-placeholder="Pilih ID Box HCR Kotor">
                                                <option value="">Pilih ID Box HCR Kotor</option>
                                                @php
                                                    $selectedNomorBSTB = ''; // Inisialisasi variabel untuk menyimpan nomor_bstb yang sudah ditampilkan
                                                @endphp
                                                @foreach ($stockTGK as $post)
                                                    @if ($selectedNomorBSTB != $post->id_box_hcr_kotor)
                                                        @php
                                                            $beratMasukShown = false; // Inisialisasi variabel untuk menandai apakah berat_masuk sudah ditampilkan atau belum
                                                        @endphp
                                                        @foreach ($stockTGK as $innerPost)
                                                            @if ($innerPost->id_box_hcr_kotor == $post->id_box_hcr_kotor && $innerPost->sisa_berat > 0)
                                                                @if (!$beratMasukShown)
                                                                    <option value="{{ $innerPost->id_box_hcr_kotor }}">
                                                                        {{ old('id_box_hcr_kotor', $innerPost->id_box_hcr_kotor) }}
                                                                    </option>
                                                                    @php
                                                                        $beratMasukShown = true; // Set nilai variabel untuk menandai bahwa berat_masuk sudah ditampilkan
                                                                    @endphp
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                        @php
                                                            $selectedNomorBSTB = $post->id_box_hcr_kotor; // Set nilai variabel dengan nomor_bstb yang baru ditampilkan
                                                        @endphp
                                                    @endif
                                                @endforeach
                                            </select> --}}
                                            <select id="id_box_hcr_kotor" class="select2 form-select"
                                                name="id_box_hcr_kotor" data-placeholder="Pilih ID Box Stock Hcr Kotor">
                                                <option value="">Pilih ID Box Stock Hcr Kotor</option>
                                                @foreach ($stockTGK as $post)
                                                    @if (str_contains(strtolower($post->jenis_rambang), 'hcr rambang') === true)
                                                        <option value="{{ $post->id_box_hcr_kotor }}">
                                                            {{ old('id_box_hcr_kotor', $post->id_box_hcr_kotor) }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Jenis Rambang</label>
                                            <input type="text" class="form-control" id="jenis_rambang" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Berat Masuk</label>
                                            <input type="text" class="form-control" id="berat_masuk" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Berat Keluar</label>
                                            <input type="text" class="form-control" id="berat_keluar"
                                                placeholder="Masukan berat keluar">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Sisa Berat</label>
                                            <input type="text" class="form-control" id="sisa_berat" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Nomor Job</label>
                                            <input type="text" class="form-control" id="nomor_job" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Upah Operator</label>
                                            <input type="text" class="form-control" id="upah_operator" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>NIP Admin</label>
                                            <input type="text" id="user_created" class="form-control" name="user_created"
                                                value="{{ auth()->user()->nip }}" readonly data-parsley-required="true">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-primary" onclick="addRow()">Add</button>
                                    <a href="{{ Route('CabutHancuranPersiapan.index') }}" type="button"
                                        class="btn btn-danger" data-dismiss="modal">Close</a>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-body" style="overflow: scroll" content="{{ csrf_token() }}">
                                                <table class="table table-striped mt-3">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center" scope="col">ID Box HCR Kotor</th>
                                                            <th class="text-center" scope="col">Jenis Rambang</th>
                                                            <th class="text-center" scope="col">Berat Masuk</th>
                                                            <th class="text-center" scope="col">Berat Keluar</th>
                                                            <th class="text-center" scope="col">Sisa Berat</th>
                                                            <th class="text-center" scope="col">Nomor Job</th>
                                                            <th class="text-center" scope="col">Upah Operator</th>
                                                            <th class="text-center" scope="col">NIP Admin</th>
                                                            <th class="text-center" scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tableBody">
                                                    </tbody>
                                                </table>
                                                <div class="col-md-12">
                                                    {{-- <button type="submit" class="btn btn-primary">Add</button> --}}
                                                    <a href="#" class="btn btn-primary"
                                                        onclick="CeksendData()">Submit</a>
                                                    <a href="{{ Route('CabutHancuranPersiapan.index') }}" type="button"
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
            $('#id_box_hcr_kotor').on('change', function() {
                let selectedIdBox = $(this).val();
                $.ajax({
                    url: "{{ route('CabutHancuranPersiapan.set') }}",
                    method: 'GET',
                    async: false,
                    data: {
                        id_box_hcr_kotor: selectedIdBox
                    },
                    success: function(response) {
                        // Ambil nilai pertama dari respons jika ada
                        let data = response.length > 0 ? response : null;
                        data.forEach(v => {
                            if (v.jenis_rambang.toLowerCase().includes("hcr rambang")) {
                                
                                $('#berat_masuk').val(v.sisa_berat);
                                $('#jenis_rambang').val(v.jenis_rambang);
                                // Hitung sisa berat berdasarkan berat masuk dan berat keluar
                                hitungTotal();
                            } else {
                                console.error('No data found for the selected id_box_hcr_kotor');
                            }
                            
                        });
                       
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            });

            // Fungsi generateNomorBSTB (letakkan di sini atau muat dari file eksternal)
            function generateNomorBSTB() {
                const now = new Date();
                const tahun = now.getFullYear().toString().substr(-2);
                const bulan = ('0' + (now.getMonth() + 1)).slice(-2);
                const tanggal = ('0' + now.getDate()).slice(-2);
                const jam = ('0' + now.getHours()).slice(-2);
                const menit = ('0' + now.getMinutes()).slice(-2);
                const detik = ('0' + now.getSeconds()).slice(-2);

                const nomorJob = `${tanggal}${bulan}${tahun}-${jam}${menit}${detik}_A_UCH`;

                // Menampilkan hasil ke dalam elemen HTML dengan ID 'nomor_job'
                $('#nomor_job').val(nomorJob); // Menggunakan .val() karena ini input field
                return nomorJob;
            }

            // Fungsi untuk menghitung sisa berat
            function hitungTotal() {
                let beratMasuk = parseFloat($('#berat_masuk').val() || 0);
                let beratKeluar = 0;
                
                     beratKeluar = parseFloat($('#berat_keluar').val() || 0);

                
                let sisaBerat = beratMasuk - beratKeluar;

                let upah_operator = beratKeluar * 0.12 * 835

                // Memperbarui nilai sisa berat
                $('#sisa_berat').val(sisaBerat);
                $('#upah_operator').val(upah_operator);
            }

            // Mendengarkan perubahan pada inputan berat keluar
            $('#berat_keluar').on('input', function() {
                hitungTotal();
                generateNomorBSTB();
            });

            // Mendengarkan perubahan pada inputan berat masuk
            $('#berat_masuk').on('input', function() {
                hitungTotal();
            });
        });

        function addRow() {
            // Mengambil nilai dari inputgrading_halus = $('#id_box_grading_halus').val();
            var id_box_hcr_kotor = $('#id_box_hcr_kotor').val();
            var jenis_rambang = $('#jenis_rambang').val();
            var berat_masuk = $('#berat_masuk').val();
            var berat_keluar = $('#berat_keluar').val();
            var sisa_berat = $('#sisa_berat').val();
            var nomor_job = $('#nomor_job').val();
            var upah_operator = $('#upah_operator').val();
            var user_created = $('#user_created').val();

            // Inisialisasi array untuk menyimpan field yang belum terisi
            let fieldsNotFilled = [];
            // Periksa setiap field
            if (!id_box_hcr_kotor) fieldsNotFilled.push('id box hcr kotor');
            if (!berat_keluar || berat_keluar <= 0) fieldsNotFilled.push('Berat keluar');

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

            var newRow = '<tr>' +
                '<td>' + id_box_hcr_kotor + '</td>' +
                '<td>' + jenis_rambang + '</td>' +
                '<td>' + berat_masuk + '</td>' +
                '<td>' + berat_keluar + '</td>' +
                '<td>' + sisa_berat + '</td>' +
                '<td>' + nomor_job + '</td>' +
                '<td>' + upah_operator + '</td>' +
                '<td>' + user_created + '</td>' +
                '</td><td><button class="btn btn-danger" onclick="hapusBaris(this)">Delete</button></td></tr>';

            $('#tableBody').append(newRow);

            // Menambahkan data ke dalam array
            dataArray.push({
                id_box_hcr_kotor: id_box_hcr_kotor,
                jenis_rambang: jenis_rambang,
                berat_masuk: berat_masuk,
                upah_operator: upah_operator,
                sisa_berat: sisa_berat,
                nomor_job: nomor_job,
                berat_keluar: berat_keluar,
                user_created: user_created,
            });
            // Membersihkan nilai input setelah ditambahkan
            $('#id_box_hcr_kotor').val(null).trigger('change');
            // $('#id_box_hcr_kotor').prop('selectedIndex', 0);
            $('#jenis_rambang, #berat_masuk, #berat_keluar, #upah_operator, #nomor_job, #sisa_berat')
                .val('');

            // Update indeks baris terakhir
            currentRowIndex++;

            // Kosongkan input setelah menambahkan baris
        }

        // Ambil indeks terakhir sebelum menghapus baris
        var lastRowIndex = currentRowIndex;

        function hapusBaris(button) {
            // Dapatkan elemen baris terkait dengan tombol delete yang diklik
            let row = $(button).closest('tr');

            // Hapus baris dari dataArray berdasarkan indeks baris di tabel
            let rowIndex = row.index();
            dataArray.splice(rowIndex, 1);

            // Hapus baris dari tabel
            row.remove();

            // Update indeks baris terakhir
            currentRowIndex--;
        }

        function CeksendData() {
            var i = 0;
            var idBoxes = []; // Array untuk menyimpan id box yang akan dicek

            // Mengumpulkan id box dari dataArray
            dataArray.forEach(function(item) {
                idBoxes.push(item.id_box_hcr_kotor);
            });

            // Mengirimkan permintaan AJAX untuk memeriksa ketersediaan id box
            $.ajax({
                url: `{{ route('CabutHancuranPersiapan.sendData') }}`, // Ganti dengan URL endpoint yang sesuai untuk memeriksa ketersediaan id box
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
                // Mengirim data ke server menggunakan AJAX
                $.ajax({
                    url: '{{ route('CabutHancuranPersiapan.store') }}',
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
                        dataArray: JSON.stringify(
                            dataArray),
                        _token: '{{ csrf_token() }}'
                    },
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
