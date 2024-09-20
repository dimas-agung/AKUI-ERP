@extends('layouts.master1')
@section('menu')
    Moulding
@endsection
@section('title')
    Data Moulding Rework Persiapan Input
@endsection
@section('content')
    {{-- <div class="container"> --}}
    <div class="card border border-primary border-3 mt-2">
        <form action="{{ route('MouldingReworkPersiapan.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 shadow-sm rounded">
                        <div class="card-header">
                            <h4>Input Data Moulding Rework Persiapan Input</h4>
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor Job Rework</label>
                                        <select id="nomor_job_rework" class="select2 form-select" name="nomor_job_rework"
                                            data-placeholder="Pilih Nomor Job Rework">
                                            <option value="">Pilih Nomor Job Rework</option>
                                            @foreach ($TransitFGR as $post)
                                                @if ($post->status > 0)
                                                    <option value="{{ $post->nomor_job_rework }}">
                                                        {{ old('nomor_job_rework', $post->nomor_job_rework) }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>NIP Admin</label>
                                        <input type="text" id="user_created" class="form-control" name="user_created"
                                            value="{{ auth()->user()->nip }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="button" id="tombol_add" class="btn btn-primary"
                                    onclick="addRow()">Add</button>
                                <a href="{{ Route('MouldingReworkPersiapan.index') }}" type="button" class="btn btn-danger"
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
                                <th class="text-center">Nomor Job Rework</th>
                                <th class="text-center">Nomor Batch</th>
                                <th class="text-center">Tujuan Kirim</th>
                                <th class="text-center">Job Order</th>
                                <th class="text-center">Berat Job</th>
                                <th class="text-center">Pcs Job</th>
                                <th class="text-center">Modal</th>
                                <th class="text-center">Total Modal</th>
                                <th class="text-center">Nama Operator</th>
                                <th class="text-center">Nip Operator</th>
                                <th class="text-center">Grade Operator</th>
                                <th class="text-center">Nama Team Leader</th>
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
                        <a href="{{ Route('MouldingReworkPersiapan.index') }}" type="button" class="btn btn-danger"
                            data-dismiss="modal">Close</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
    {{-- </div> --}}
@endsection
@section('printArea')
    <style>
        @media print {
            body {
            visibility: hidden;
            /* display: none; */
            /* position: relative; */
            }
            #printableArea1 {
            visibility: visible;
            /* display: inline; */
            position: absolute;
            left: 0;
            top: 0;
            /* bottom: 0; */
            /* right: 0; */
            }
            .no-print {
                display: none; /* Menyembunyikan elemen dengan class "no-print" saat mencetak */
            }
        }
    </style>
    <div class="row" id="printableArea1" style="max-width: 200px;margin: 10px;">

        <div id="qrcode" class="col" style="max-width: 70px;padding-right:0;padding-left:0;"></div>
        <div class="col" style="font-size: 9px;width: 220px;padding-right:0;padding-left:0;" >
            <span style="text-align: center;font-weight: bold;;font-size:10px;" id="cetak_nomor_batch"></span><br>
            <span style="font-family:Calibri;font-weight: bold;font-size:10px;"  id="cetak_nomor_job"></span><br>
            <span style="font-family:Calibri;font-weight: bold;font-size:10px;" id="cetak_jenis"></span><br>
            <span style="font-family:Calibri;font-weight: bold;font-size:10px;" id="cetak_gramasi"></span><span style="font-family:Calibri;font-weight: bold;font-size:10px;" >gr 
        </div>
    </div>
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

        // Variabel global untuk menyimpan indeks baris terakhir
        var currentRowIndex = 0;
        var dataArray = [];

        function addRow() {
            let selectedJenisGrading = $('#nomor_job_rework').val();

            $.ajax({
                url: `{{ route('MouldingReworkPersiapan.set') }}`,
                method: 'GET',
                data: {
                    nomor_job_rework: selectedJenisGrading
                },
                success: function(response) {
                    if (response.length > 0) {
                        var nomor_job_rework = selectedJenisGrading;
                        var nomor_batch = response[0].nomor_batch;
                        var tujuan_kirim = response[0].tujuan_kirim;
                        var job_order = response[0].job_order;
                        var berat_job = response[0].berat_job;
                        var pcs_job = response[0].pcs_job;
                        var modal = response[0].modal_per_jenis;
                        var total_modal = response[0].total_modal_per_jenis;
                        var nama_operator = response[0].nama_operator;
                        var nip_operator = response[0].nip_operator;
                        var grade_operator = response[0].grade_operator;
                        var nama_team_leader = response[0].nama_team_leader;
                        var user_created = $('#user_created').val();

                        // Inisialisasi array untuk menyimpan field yang belum terisi
                        let fieldsNotFilled = [];
                        // Periksa setiap field
                        if (!nomor_job_rework) fieldsNotFilled.push('Nomor Job Rework');

                        // Cek apakah ada field yang belum terisi
                        if (fieldsNotFilled.length > 0) {
                            // Membuat pesan teks yang mencantumkan field yang belum terisi
                            let message =
                                `Data belum diinputkan untuk: ${fieldsNotFilled.join(', ')}. Silakan lengkapi form.`;

                            Swal.fire({
                                title: 'Warning!',
                                text: message,
                                icon: 'warning'
                            });
                            return;
                        }

                        // Gunakan data-* attribute untuk menyimpan nomor_job_rework di elemen baris tabel
                        var newRow = '<tr data-nomor-job-rework="' + nomor_job_rework + '">' +
                            '<td>' + nomor_job_rework + '</td>' +
                            '<td>' + nomor_batch + '</td>' +
                            '<td>' + tujuan_kirim + '</td>' +
                            '<td>' + job_order + '</td>' +
                            '<td>' + berat_job + '</td>' +
                            '<td>' + pcs_job + '</td>' +
                            '<td>' + modal + '</td>' +
                            '<td>' + total_modal + '</td>' +
                            '<td>' + nama_operator + '</td>' +
                            '<td>' + nip_operator + '</td>' +
                            '<td>' + grade_operator + '</td>' +
                            '<td>' + nama_team_leader + '</td>' +
                            '<td>' + user_created + '</td>' +
                            '<td><button class="btn btn-danger" onclick="hapusBaris(this)">Delete</button></td></tr>';

                        $('#tableBody').append(newRow);

                        // Menambahkan data ke dalam array
                        dataArray.push({
                            nomor_job_rework: nomor_job_rework,
                            nomor_batch: nomor_batch,
                            tujuan_kirim: tujuan_kirim,
                            job_order: job_order,
                            berat_job: berat_job,
                            pcs_job: pcs_job,
                            modal: modal,
                            total_modal: total_modal,
                            nama_operator: nama_operator,
                            nip_operator: nip_operator,
                            grade_operator: grade_operator,
                            nama_team_leader: nama_team_leader,
                            user_created: user_created,
                        });
                        generateQrCode(nomor_job_rework)
                        
                        $('#cetak_nomor_batch').html(nomor_batch)
                        $('#cetak_nomor_job').html(nomor_job_rework)
                        $('#cetak_jenis').html(job_order)
                        $('#cetak_gramasi').html(Math.floor(berat_job))
                        window.print();

                        // Membersihkan nilai input setelah ditambahkan
                        $('#nomor_job_rework').val(null).trigger('change');

                        // Nonaktifkan opsi yang telah dipilih dari dropdown
                        $("#nomor_job_rework option[value='" + nomor_job_rework + "']").prop('disabled', true);

                        // Update indeks baris terakhir
                        currentRowIndex++;
                    }
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        }

        // Hapus Baris
        function hapusBaris(button) {
            // Dapatkan elemen baris terkait dengan tombol delete yang diklik
            let row = $(button).closest('tr');

            // Ambil nomor_job_rework dari data-* attribute
            let nomor_job_rework = row.data('nomor-job-rework');

            // Hapus baris dari tabel
            row.remove();

            // Hapus baris dari dataArray berdasarkan indeks baris di tabel
            let rowIndex = row.index();
            dataArray.splice(rowIndex, 1);

            // Kembalikan nomor_job_rework ke dalam dropdown
            $("#nomor_job_rework option[value='" + nomor_job_rework + "']").prop('disabled', false);

            // Refresh Select2
            $('#nomor_job_rework').val(null).trigger('change');
        }

        function CeksendData() {
            var i = 0;
            var idBoxes = []; // Array untuk menyimpan id box yang akan dicek

            // Mengumpulkan id box dari dataArray
            dataArray.forEach(function(item) {
                idBoxes.push(item.nomor_job_rework);
            });

            // Mengirimkan permintaan AJAX untuk memeriksa ketersediaan id box
            $.ajax({
                url: `{{ route('MouldingReworkPersiapan.CeksendData') }}`, // Ganti dengan URL endpoint yang sesuai untuk memeriksa ketersediaan id box
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
                var nomor_job_rework = $('#nomor_job_rework').val() || '';

                // Mengirim data ke server menggunakan AJAX
                $.ajax({
                    url: '{{ route('MouldingReworkPersiapan.store') }}',
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
                            dataArray: JSON.stringify(
                                dataArray
                            ), // Mengirim dataArray sebagai string JSON
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
