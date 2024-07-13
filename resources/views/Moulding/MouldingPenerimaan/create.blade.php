@extends('layouts.master1')
@section('menu')
    Moulding
@endsection
@section('title')
    Data Moulding Persiapan Input
@endsection
@section('content')
    {{-- <div class="container"> --}}
    <div class="card border border-primary border-3 mt-2">
        <form action="{{ route('MouldingPersiapan.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 shadow-sm rounded">
                        <div class="card-header">
                            <h4>Input Data Moulding Persiapan Input</h4>
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
                                        <label>Id Box Grading Warna</label>
                                        <select id="id_box_grading_warna" class="select2 form-select"
                                            name="id_box_grading_warna" data-placeholder="Pilih Id Box Grading Warna">
                                            <option value="">Pilih Id Box Grading Warna</option>
                                            @foreach ($stockTGK as $post)
                                                @if ($post->sisa_berat > 0)
                                                    <option value="{{ $post->id_box_grading_warna }}">
                                                        {{ old('id_box_grading_warna', $post->id_box_grading_warna) }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Job Order</label>
                                        <select id="job_order" class="select2 form-select" name="job_order"
                                            data-placeholder="Pilih order job">
                                            <option value="">Pilih order job</option>
                                            @foreach ($MasTujKir as $innerPost)
                                                @if ($innerPost->status > 0)
                                                    <option value="{{ $innerPost->jenis }}">
                                                        {{ old('jenis', $innerPost->jenis) }}
                                                    </option>
                                                @endif
                                            @endforeach
                                            @php
                                                $selectedNomorBSTB = $post->jenis; // Set nilai variabel dengan nomor_bstb yang baru ditampilkan
                                            @endphp
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
                                        <label>Nomer Batch</label>
                                        <input type="text" id="nomor_batch" class="form-control" name="nomor_batch"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nomer Job</label>
                                        <input type="text" id="nomor_job" class="form-control" name="nomor_job" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tujuan Kirim</label>
                                        <input type="text" id="tujuan_kirim" class="form-control" name="tujuan_kirim"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Jenis Grading</label>
                                        <input type="text" id="jenis_grading" class="form-control" name="jenis_grading"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Modal</label>
                                        <input type="text" id="modal" class="form-control" name="modal" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Upah Operator</label>
                                        <input type="text" id="upah_operator" class="form-control" name="upah_operator"
                                            readonly>
                                        <input type="hidden" id="upahmasuk" class="form-control" name="upahmasuk">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Berat Job</label>
                                        <input type="text" id="berat_job" class="form-control" name="berat_job"
                                            placeholder="Silahkan isi Berat job">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pcs Job</label>
                                        <input type="text" id="pcs_job" class="form-control" name="pcs_job"
                                            placeholder="Silahkan isi Pcs job">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Sisa Berat</label>
                                        <input type="text" id="sisa_berat" class="form-control" name="sisa_berat"
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
                            </div>
                            <div class="col-md-12">
                                <button type="button" id="tombol_add" class="btn btn-primary"
                                    onclick="addRow()">Add</button>
                                <a href="{{ Route('MouldingPersiapan.index') }}" type="button" class="btn btn-danger"
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
                                <th class="text-center">Id Box Grading Warna</th>
                                <th class="text-center">Nomor Batch</th>
                                <th class="text-center">Tujuan Kirim</th>
                                <th class="text-center">Jenis Grading</th>
                                <th class="text-center">Job Order</th>
                                <th class="text-center">Berat Job</th>
                                <th class="text-center">Pcs Job</th>
                                <th class="text-center">Nomor Job</th>
                                <th class="text-center">Upah Operator</th>
                                <th class="text-center">Modal Per Jenis</th>
                                <th class="text-center">Total Modal Per Jenis</th>
                                <th class="text-center">Modal Nomor Job</th>
                                <th class="text-center">Total Modal Nomor Job</th>
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
                        <a href="{{ Route('MouldingPersiapan.index') }}" type="button" class="btn btn-danger"
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
        // Variabel penanda untuk menandai apakah tombol "add" sudah diklik atau belum
        let tombolAddDiklik = false;

        // Ketika tombol "add" diklik
        $('#tombol_add').on('click', function() {
            // Set variabel penanda menjadi true
            tombolAddDiklik = true;
        });

        $(document).ready(function() {
            let initialSisaBerat;

            // Ketika id_box_grading_warna berubah, lakukan AJAX untuk mendapatkan data
            $('#id_box_grading_warna').on('change', function() {
                let selectedJenisGrading = $(this).val();
                $.ajax({
                    url: `{{ route('MouldingPersiapan.set') }}`,
                    method: 'GET',
                    data: {
                        id_box_grading_warna: selectedJenisGrading
                    },
                    success: function(response) {
                        if (response.length > 0) {
                            initialSisaBerat = parseFloat(response[0].sisa_berat);
                            $('#sisa_berat').val(initialSisaBerat);
                            $('#nomor_batch').val(response[0].nomor_batch);
                            $('#jenis_grading').val(response[0].jenis_grading);
                            $('#tujuan_kirim').val(response[0].tujuan_kirim);
                            $('#modal').val(response[0].modal);

                            // Generate nomor job
                            const inisial = selectedJenisGrading.charAt(0).toUpperCase();
                            // Memeriksa apakah nomor_bstb sudah terisi, jika belum maka diisi
                            if (!tombolAddDiklik) {
                                const nomor_job = generateNomorJob(inisial);
                                $('#nomor_job').val(nomor_job);
                            }
                        }
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            });

            // Event handler untuk saat nilai berat keluar berubah
            $('#berat_job').on('input', function() {
                updateSisaBerat();
            });

            // Fungsi untuk mengupdate nilai sisa berat
            function updateSisaBerat() {
                let beratKeluar = parseFloat($('#berat_job').val());

                // Memeriksa apakah nilai berat keluar valid
                if (isNaN(beratKeluar) || beratKeluar < 0) {
                    beratKeluar = 0; // Jika tidak valid, set nilai berat keluar ke 0
                    $('#berat_job').val(0); // Set nilai input berat keluar menjadi 0
                }

                let sisaBerat = initialSisaBerat - beratKeluar;
                $('#sisa_berat').val(sisaBerat);
            }

            // Validasi agar berat keluar tidak lebih dari sisa berat
            $('#berat_job').on('input', function() {
                let berat = parseFloat($(this).val());
                if (berat > initialSisaBerat) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Berat keluar tidak boleh lebih dari sisa berat.',
                        icon: 'error'
                    });
                    $(this).val(''); // Kosongkan input berat jika nilai tidak valid
                    $('#sisa_berat').val(initialSisaBerat); // Kembalikan nilai sisa berat ke nilai awal
                } else {
                    updateSisaBerat();
                }
            });
        });

        // Ketika terjadi perubahan pada elemen dengan id 'tujuan_kirim'
        $('#job_order').on('change', function() {
            // Mengambil nilai job_order yang dipilih
            let selectedPcc = $(this).val();

            // Melakukan permintaan AJAX ke controller untuk mendapatkan data
            $.ajax({
                url: '{{ route('MouldingPersiapan.setpcc') }}',
                method: 'GET',
                data: {
                    order_job: selectedPcc
                },
                success: function(response) {
                    if (response.status > 0) {
                        // Mengatur nilai elemen-elemen sesuai dengan respons dari server
                        $('#upahmasuk').val(response.upah_operator);
                    }
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });

        function generateNomorJob(inisial) {
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
                nomor = `${tanggal}${bulan}${tahun}-${jam}${menit}${detik}_${inisial}_UMD`;
                // Memeriksa apakah nomor job yang dihasilkan sudah ada dalam data yang sudah diinputkan sebelumnya
            } while (existingNomorJobs.includes(nomor));

            return nomor;
        }


        // Hitung Total Berat
        function hitungTotalBerat() {
            let totalBerat = 0;
            // Iterasi melalui setiap baris dalam tabel
            $('#tableBody tr').each(function() {
                // Mendapatkan nilai berat adding dari baris saat ini dan menambahkannya ke totalBerat
                let beratGrading = parseFloat($(this).find('td:eq(5)').text()) || 0;
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
            var id_box_grading_warna = $('#id_box_grading_warna').val();
            var nomor_batch = $('#nomor_batch').val();
            var tujuan_kirim = $('#tujuan_kirim').val();
            var jenis_grading = $('#jenis_grading').val();
            var job_order = $('#job_order').val();
            var berat_job = $('#berat_job').val();
            var pcs_job = $('#pcs_job').val();
            var nomor_job = $('#nomor_job').val();
            var modal_per_jenis = $('#modal').val();
            var modal_nomor_job = $('#modal_nomor_job').val();
            var total_modal_nomor_job = $('#total_modal_nomor_job').val();
            var user_created = $('#user_created').val();
            var upahmasuk = parseFloat($('#upahmasuk').val());
            var total_berat = parseFloat($('#total_berat').val());

            // Inisialisasi array untuk menyimpan field yang belum terisi
            let fieldsNotFilled = [];
            // Periksa setiap field
            if (!id_box_grading_warna) fieldsNotFilled.push('Id Box Grading Warna');
            if (!job_order) fieldsNotFilled.push('Job Order');
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

            var total_modal_per_jenis = modal_per_jenis * berat_job;

            var newRow = '<tr>' +
                '<td>' + id_box_grading_warna + '</td>' +
                '<td>' + nomor_batch + '</td>' +
                '<td>' + tujuan_kirim + '</td>' +
                '<td>' + jenis_grading + '</td>' +
                '<td>' + job_order + '</td>' +
                '<td>' + berat_job + '</td>' +
                '<td>' + pcs_job + '</td>' +
                '<td>' + nomor_job + '</td>' +
                // '<td>' + upah_operator + '</td>' +
                '<td class="upah_operator"></td>' +
                '<td>' + modal_per_jenis + '</td>' +
                '<td class="total_modal_per_jenis">' + total_modal_per_jenis + '</td>' +
                '<td class="modal_nomor_job"></td>' +
                '<td class="total_modal_nomor_job"></td>' +
                '<td>' + user_created + '</td>' +
                '</td><td><button class="btn btn-danger" onclick="hapusBaris(this)">Delete</button></td></tr>';

            $('#tableBody').append(newRow);


            // Menambahkan data ke dalam array
            // dataArrayDocNo.push(doc_no)
            dataArray.push({
                id_box_grading_warna: id_box_grading_warna,
                nomor_batch: nomor_batch,
                tujuan_kirim: tujuan_kirim,
                jenis_grading: jenis_grading,
                job_order: job_order,
                berat_job: berat_job,
                pcs_job: pcs_job,
                nomor_job: nomor_job,
                upah_operator: 0, // Placeholder for now, will be updated later
                modal_per_jenis: modal_per_jenis,
                total_modal_per_jenis: total_modal_per_jenis,
                modal_nomor_job: 0, // Placeholder for now, will be updated later
                total_modal_nomor_job: 0, // Placeholder for now, will be updated later
                user_created: user_created,
            });

            // Membersihkan nilai input setelah ditambahkan
            $('#sisa_berat').val('');
            $('#pcs_job').val('');
            $('#berat_job').val('');
            $('#nomor_batch').val('');
            $('#tujuan_kirim').val('');
            $('#jenis_grading').val('');
            $('#modal').val('');
            $('#id_box_grading_warna').val(null).trigger('change');
            $('#job_order').prop('disabled', true);

            // Update indeks baris terakhir
            currentRowIndex++;
            hitungTotalBerat();
            // Menghitung dan memperbarui upah_operator untuk semua baris
            updateUpahOperator();
            // Menghitung dan memperbarui modal_nomor_job untuk semua baris
            updateModalNomorJob();
        }

        function updateUpahOperator() {
            // Menghitung total berat job
            var total_berat_job = 0;
            $('#tableBody tr').each(function() {
                var currentBerat = parseFloat($(this).find('td:nth-child(6)').text());
                if (!isNaN(currentBerat)) {
                    total_berat_job += currentBerat;
                }
            });

            // Menghitung upah_operator berdasarkan total berat job
            var upahmasuk = parseFloat($('#upahmasuk').val());
            var upah_operator = upahmasuk * total_berat_job;

            // Memperbarui kolom upah_operator di setiap baris dan dataArray
            $('#tableBody tr').each(function(index) {
                $(this).find('.upah_operator').text(upah_operator.toFixed(2));
                dataArray[index].upah_operator = upah_operator; // Update the upah_operator in dataArray
            });
            // Menampilkan hasil upah_operator di input dengan id 'upah_operator'
            $('#upah_operator').val(upah_operator.toFixed(2));
        }

        function updateModalNomorJob() {
            // Menghitung total berat job
            var total_berat_job = 0;
            var total_modal = 0;
            $('#tableBody tr').each(function() {
                var currentBerat = parseFloat($(this).find('td:nth-child(6)').text());
                var currentModal = parseFloat($(this).find('.total_modal_per_jenis').text());
                if (!isNaN(currentBerat)) {
                    total_berat_job += currentBerat;
                }
                if (!isNaN(currentModal)) {
                    total_modal += currentModal;
                }
            });

            // Menghitung modal_nomor_job berdasarkan total modal dan total berat job
            var modal_nomor_job = total_modal / total_berat_job;
            console.log(total_modal);

            // Memperbarui kolom modal_nomor_job di setiap baris dan dataArray
            $('#tableBody tr').each(function(index) {
                $(this).find('.modal_nomor_job').text(modal_nomor_job);
                $(this).find('.total_modal_nomor_job').text(total_modal);
                dataArray[index].modal_nomor_job = modal_nomor_job; // Update the modal_nomor_job in dataArray
                dataArray[index].total_modal_nomor_job = total_modal; // Update the modal_nomor_job in dataArray
            });
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

            // Memperbarui perhitungan setelah baris dihapus
            hitungTotalBerat();
            updateUpahOperator();
            updateModalNomorJob();

            // Cek apakah tabel tidak memiliki baris data lagi
            if ($('#tableBody tr').length === 0) {
                $('#job_order').prop('disabled', false).val(null).trigger('change');
                $('#nomor_job').val('');
            }
        }

        function CeksendData() {
            var i = 0;
            var idBoxes = []; // Array untuk menyimpan id box yang akan dicek

            // Mengumpulkan id box dari dataArray
            dataArray.forEach(function(item) {
                idBoxes.push(item.id_box_grading_warna);
            });

            // Mengirimkan permintaan AJAX untuk memeriksa ketersediaan id box
            $.ajax({
                url: `{{ route('MouldingPersiapan.CeksendData') }}`, // Ganti dengan URL endpoint yang sesuai untuk memeriksa ketersediaan id box
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
                            text: 'Beberapa id box grading warna sudah tidak tersedia.',
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
                var id_box_grading_warna = $('#id_box_grading_warna').val() || '';

                // Mengirim data ke server menggunakan AJAX
                $.ajax({
                    url: '{{ route('MouldingPersiapan.store') }}',
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
