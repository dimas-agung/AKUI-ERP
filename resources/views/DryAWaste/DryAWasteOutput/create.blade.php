@extends('layouts.master1')
@section('menu')
    Dry A Waste
@endsection
@section('title')
    Input Dry A Waste
@endsection
@section('content')
    {{-- <div class="container"> --}}
    <div class="card border border-primary border-3 mt-2">
        <form action="{{ route('DryAWasteOutput.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 shadow-sm rounded">
                        <div class="card-header">
                            <h4>Input Data Dry A Waste Output</h4>
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
                                        <label>Jenis Waste</label>
                                        <select id="jenis_waste" class="select2 form-select"
                                            data-placeholder="Pilih Jenis Waste" name="jenis_waste">
                                            <option value="">Pilih Jenis Waste</option>
                                            @foreach ($TransitPre->sortBy('jenis_waste') as $post)
                                                <option value="{{ $post->jenis_waste }}">
                                                    {{ old('jenis_waste', $post->jenis_waste) }}</option>
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
                                            @foreach ($TujuanKirimGHI->sortBy('tujuan_kirim') as $post)
                                                <option value="{{ $post->tujuan_kirim }}">
                                                    {{ old('tujuan_kirim', $post->tujuan_kirim) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>NIP Admin</label>
                                        <input type="text" id="user_created" class="form-control" name="user_created"
                                            value="{{ auth()->user()->nip }}" readonly data-parsley-required="true">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Berat Masuk</label>
                                        <input type="text" class="form-control" id="berat_masuk" name="berat_masuk"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pcs Masuk</label>
                                        <input type="text" class="form-control" id="pcs_masuk" name="pcs_masuk" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Berat Keluar</label>
                                        <input type="text" class="form-control" id="berat" name="berat"
                                            placeholder="Masukan Berat Keluar">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pcs Keluar</label>
                                        <input type="text" class="form-control" id="pcs" name="pcs"
                                            placeholder="Masukan Pcs Keluar">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor Job</label>
                                        <input type="text" class="form-control" id="nomor_job" name="nomor_job" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor BSTB</label>
                                        <input type="text" class="form-control" id="nomor_bstb" name="nomor_bstb"
                                            >
                                    </div>
                                </div>
                                @role('admin')
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Modal</label>
                                        <input type="text" class="form-control" id="modal" name="modal" readonly>
                                    </div>
                                </div>
                                @elserole('dry_a')
                                <input type="hidden" class="form-control" id="modal" name="modal" readonly>
                                @endrole
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <input type="text" id="keterangan" class="form-control" name="keterangan"
                                            placeholder="Masukkan keterangan">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="button" class="btn btn-primary" onclick="addRow()">Add</button>
                                <a href="{{ Route('DryAWasteOutput.index') }}" type="button" class="btn btn-danger"
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
                <!-- Elemen dengan ID 'nomor_grading' -->
                <div class="card-body" style="overflow: scroll" content="{{ csrf_token() }}">
                    <table class="table table-striped mt-3">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">Jenis Waste</th>
                                <th class="text-center" scope="col">Tujuan Kirim</th>
                                <th class="text-center" scope="col">Berat</th>
                                <th class="text-center" scope="col">Pcs</th>
                                <th class="text-center" scope="col">Nomor Job</th>
                                <th class="text-center" scope="col">Nomor BSTB</th>
                                <th class="text-center" scope="col">Keterangan</th>
                                @role('admin')
                                <th class="text-center" scope="col">Modal</th>
                                <th class="text-center" scope="col">Total Modal</th>
                                @endrole
                                <th class="text-center" scope="col">NIP Admin</th>
                                <th class="text-center" scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                        </tbody>
                    </table>
                    <a href="#" class="btn btn-primary" onclick="CeksendData()">Submit</a>
                </div>
            </div>
        </div>
    </div>
    </form>

@endsection
@section('script')
    <script>
        let selectedNomorBSTB = '';
        var beratMasukAwal = 0;
        var pcsMasukAwal = 0;

        $('#jenis_waste').on('change', function() {
            let selectedIdBox = $(this).val();
            $.ajax({
                url: "{{ route('DryAWasteOutput.set') }}",
                method: 'GET',
                async: false,
                data: {
                    jenis_waste: selectedIdBox
                },
                success: function(response) {
                    let data = response.length > 0 ? response[0] : null;

                    $('#berat_masuk').val(data.sisa_berat);
                    $('#pcs_masuk').val(data.sisa_pcs);
                    $('#modal').val(data.modal);
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });

        let inisialTujuanGlobal = ''; // Variabel global untuk menyimpan inisial_tujuan
        let nomorBSTBGlobal = ''; // Variabel global untuk menyimpan nomor BSTB

        $('#tujuan_kirim').on('change', function() {
            let selectedPcc = $(this).val();

            $.ajax({
                url: '{{ route('DryAWasteOutput.setpcc') }}',
                method: 'GET',
                data: {
                    tujuan_kirim: selectedPcc
                },
                success: function(response) {
                    if (response.status > 0) {
                        inisialTujuanGlobal = response
                            .inisial_tujuan; // Simpan inisial_tujuan ke variabel global
                        checkAndGenerateNomorBSTB(
                            inisialTujuanGlobal); // Panggil fungsi dengan inisial_tujuan
                    }
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });

        function checkAndGenerateNomorBSTB(inisialTujuan) {
            const idBoxGradingHalus = $('#jenis_waste').val();
            if (inisialTujuan && idBoxGradingHalus) {
                // Hanya generate nomor BSTB jika nomor BSTB global belum diatur
                if (!nomorBSTBGlobal) {
                    nomorBSTBGlobal = generateNomorBSTB('BSTB', inisialTujuan);
                    $('#nomor_bstb').val(nomorBSTBGlobal);
                }

                const generatedNomorJob = generateNomorBSTB('JOB', inisialTujuan);
                $('#nomor_job').val(generatedNomorJob);
            }
        }

        function generateNomorBSTB(prefix, inisial_tujuan) {
            let nomor;

            const now = new Date();
            const tahun = now.getFullYear().toString().substr(-2);
            const bulan = ('0' + (now.getMonth() + 1)).slice(-2);
            const tanggal = ('0' + now.getDate()).slice(-2);
            const jam = ('0' + now.getHours()).slice(-2);
            const menit = ('0' + now.getMinutes()).slice(-2);
            const detik = ('0' + now.getSeconds()).slice(-2);

            if (prefix === 'BSTB') {
                nomor = `BSTB_${tanggal}${bulan}${tahun}-${jam}${menit}${detik}_${inisial_tujuan}_UDA`;
            } else {
                nomor = `${tanggal}${bulan}${tahun}-${jam}${menit}${detik}_${inisial_tujuan}_UDA`;
            }

            return nomor;
        }

        // Event listener untuk tombol addRow
        $('#addRow').on('click', function() {
            if (inisialTujuanGlobal) {
                const generatedNomorJob = generateNomorBSTB('JOB', inisialTujuanGlobal);
                $('#nomor_job').val(generatedNomorJob);
            }
        });

        // Event listener untuk perubahan jenis_waste
        $('#jenis_waste').on('change', function() {
            if (inisialTujuanGlobal) {
                const generatedNomorJob = generateNomorBSTB('JOB', inisialTujuanGlobal);
                $('#nomor_job').val(generatedNomorJob);
            }
        });

        $('#tujuan_kirim').on('change', function() {
            checkAndGenerateNomorBSTB();
        });

        $(document).ready(function() {
            $('#berat').on('input', function() {
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

            $('#pcs').on('input', function() {
                var pcs = parseFloat($(this).val());
                var pcs_masuk = parseFloat($('#pcs_masuk').val());

                if (pcs > pcs_masuk) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Pcs keluar tidak boleh lebih dari pcs masuk.',
                        icon: 'error'
                    });
                    $(this).val(''); // Kosongkan input pcs jika nilai tidak valid
                }
            });
        });

        // Variabel global untuk menyimpan indeks baris terakhir
        var currentRowIndex = 0;
        var dataArray = [];

        function addRow() {
            // Mengambil nilai dari inputgrading_halus = $('#id_box_grading_halus').val();
            var jenis_waste = $('#jenis_waste').val();
            var berat = $('#berat').val();
            var berat_masuk = ($('#berat_masuk').val()); // Mengubah berat_masuk ke tipe angka
            var pcs = $('#pcs').val();
            var nomor_job = $('#nomor_job').val();
            var nomor_bstb = $('#nomor_bstb').val();
            var tujuan_kirim = $('#tujuan_kirim').val();
            var keterangan = $('#keterangan').val();
            var modal = $('#modal').val();
            var user_created = $('#user_created').val();
            // Inisialisasi array untuk menyimpan field yang belum terisi
            let fieldsNotFilled = [];
            // Periksa setiap field
            if (!jenis_waste) fieldsNotFilled.push('Jenis Waste');
            if (!tujuan_kirim) fieldsNotFilled.push('Tujuan Kirim');
            if (!user_created) fieldsNotFilled.push('NIP Admin');
            if (!berat) fieldsNotFilled.push('Berat Keluar');
            if (!pcs) fieldsNotFilled.push('Pcs Keluar');

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
            var total_modal = (berat_masuk - berat) * modal;

            var newRow = '<tr>' +
                '<td>' + jenis_waste + '</td>' +
                '<td>' + tujuan_kirim + '</td>' +
                '<td>' + berat + '</td>' +
                '<td>' + pcs + '</td>' +
                '<td>' + nomor_job + '</td>' +
                '<td>' + nomor_bstb + '</td>' +
                '<td>' + keterangan + '</td>' +
                @role('admin')
                '<td>' + modal + '</td>' +
                '<td>' + total_modal + '</td>' +
                @endrole
                '<td>' + user_created + '</td>' +
                '</td><td><button class="btn btn-danger" onclick="hapusBaris(this)">Delete</button></td></tr>';

            $('#tableBody').append(newRow);

            // Menambahkan data ke dalam array
            dataArray.push({
                jenis_waste: jenis_waste,
                berat: berat,
                pcs: pcs,
                nomor_bstb: nomor_bstb,
                nomor_job: nomor_job,
                tujuan_kirim: tujuan_kirim,
                keterangan: keterangan,
                modal: modal,
                total_modal: total_modal,
                user_created: user_created,
            });
            // Membersihkan nilai input setelah ditambahkan
            $('#berat').val('');
            $('#pcs').val('');
            $('#berat_masuk').val('');
            $('#pcs_masuk').val('');
            $('#keterangan').val('');
            $('#modal').val('');
            $('#total_modal').val('');
            $('#jenis_waste').val(null).trigger('change');
            $('#nomor_bstb').prop('readonly', true);
            $('#nomor_job').prop('readonly', true);
            $('#user_created').prop('readonly', true);
            // Set tujuan_kirim sebagai read-only setelah dipilih
            $('#tujuan_kirim').prop('disabled', true);


            // Update indeks baris terakhir
            currentRowIndex++;
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
                idBoxes.push(item.jenis_waste);
            });

            // Mengirimkan permintaan AJAX untuk memeriksa ketersediaan id box
            $.ajax({
                url: `{{ route('DryAWasteOutput.sendData') }}`, // Ganti dengan URL endpoint yang sesuai untuk memeriksa ketersediaan id box
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
                            text: 'Beberapa id box grading halus sudah tidak tersedia.',
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
                        text: 'Terjadi kesalahan saat memeriksa ketersediaan id box grading halus. Silakan coba lagi.',
                        icon: 'error'
                    });
                    console.log('Error:', error);
                }
            });

            function sendData() {
                console.log("Isi data=",
                    dataArray);
                // Mengirim data ke server menggunakan AJAX
                $.ajax({
                    url: '{{ route('DryAWasteOutput.store') }}',
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
    </script>
@endsection
