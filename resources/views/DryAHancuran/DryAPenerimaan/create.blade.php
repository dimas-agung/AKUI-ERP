@extends('layouts.master1')
@section('menu')
    Dry A Penerimaan Hancuran
@endsection
@section('title')
    Input Dry A Penerimaan Hancuran
@endsection
@section('content')
    {{-- <div class="container"> --}}
    <div class="card border border-primary border-3 mt-2">
        <form action="{{ route('DryAPenerimaanHancuran.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 shadow-sm rounded">
                        <div class="card-header">
                            <h4>Input Data Dry A Penerimaan Hancuran</h4>
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
                                        <label>Nomor Job</label>
                                        <select id="nomor_job" class="select2 form-select" name="nomor_job"
                                            data-placeholder="Pilih Nomor Job">
                                            <option value="">Pilih Nomor Job</option>
                                            @foreach ($TransitPre->sortBy('nomor_job') as $post)
                                                @if ($post->berat > 0)
                                                    <option value="{{ $post->nomor_job }}">
                                                        {{ old('nomor_job', $post->nomor_job) }}
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
                                            value="{{ auth()->user()->nip }}" readonly data-parsley-required="true">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Jenis Rambang</label>
                                        <input type="text" class="form-control" id="jenis_rambang" name="jenis_rambang">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Upah Operator</label>
                                        <input type="text" class="form-control" id="upah_operator" name="upah_operator"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Berat</label>
                                        <input type="text" class="form-control" id="berat" name="berat" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nama Operator</label>
                                        <input type="text" id="nama_operator" class="form-control" name="nama_operator"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>NIP Operator</label>
                                        <input type="text" id="nip_operator" class="form-control" name="nip_operator"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Grade Operator</label>
                                        <input type="text" id="grade_operator" class="form-control" name="grade_operator"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nama Team Leader</label>
                                        <input type="text" class="form-control" id="nama_team_leader"
                                            name="nama_team_leader" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Waktu Penyebaran</label>
                                        <input type="text" class="form-control" id="waktu_penyebaran"
                                            name="waktu_penyebaran">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Waktu Pengembalian</label>
                                        <input type="text" id="waktu_pengembalian" class="form-control"
                                            name="waktu_pengembalian">
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
                                <th class="text-center" scope="col">Nomor Job</th>
                                <th class="text-center" scope="col">Jenis Rambang</th>
                                <th class="text-center" scope="col">Upah Operator</th>
                                <th class="text-center" scope="col">Berat</th>
                                <th class="text-center" scope="col">Nama Operator</th>
                                <th class="text-center" scope="col">NIP Operator</th>
                                <th class="text-center" scope="col">Grade Operator</th>
                                <th class="text-center" scope="col">Nama Team Leader</th>
                                <th class="text-center" scope="col">Waktu Penyebaran</th>
                                <th class="text-center" scope="col">Waktu Pengembalian</th>
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
        let selectedNomorBSTB = ''; // Variabel untuk menyimpan nomor BSTB yang dipilih sebelumnya
        $('#nomor_job').on('change', function() {
            let selectedIdBox = $(this).val();
            if (selectedNomorBSTB !== selectedIdBox) {
                selectedNomorBSTB = selectedIdBox;
                $.ajax({
                    url: `{{ route('DryAPenerimaanHancuran.set') }}`,
                    method: 'GET',
                    data: {
                        nomor_job: selectedIdBox
                    },
                    success: function(response) {
                        console.log(response);
                        $('#jenis_rambang').val(response.jenis_rambang);
                        $('#upah_operator').val(response.upah_operator);
                        $('#berat').val(response.berat);
                        $('#nama_operator').val(response.nama_operator);
                        $('#nip_operator').val(response.nip_operator);
                        $('#grade_operator').val(response.grade_operator);
                        $('#nama_team_leader').val(response.nama_team_leader);
                        $('#waktu_penyebaran').val(response.waktu_penyebaran);
                        $('#waktu_pengembalian').val(response.waktu_pengembalian);
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            }
        });

        // Variabel global untuk menyimpan indeks baris terakhir
        var currentRowIndex = 0;
        var dataArray = [];

        function addRow() {
            // Mengambil nilai dari input
            var nomor_job = $('#nomor_job').val();
            var jenis_rambang = $('#jenis_rambang').val();
            var upah_operator = $('#upah_operator').val();
            var berat = $('#berat').val();
            var nama_operator = $('#nama_operator').val();
            var nip_operator = $('#nip_operator').val();
            var grade_operator = $('#grade_operator').val();
            var nama_team_leader = $('#nama_team_leader').val();
            var waktu_penyebaran = $('#waktu_penyebaran').val();
            var waktu_pengembalian = $('#waktu_pengembalian').val();
            var user_created = $('#user_created').val();

            // Inisialisasi array untuk menyimpan field yang belum terisi
            let fieldsNotFilled = [];
            // Periksa setiap field
            if (!nomor_job) fieldsNotFilled.push('No Job');

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
                '<td>' + nomor_job + '</td>' +
                '<td>' + jenis_rambang + '</td>' +
                '<td>' + upah_operator + '</td>' +
                '<td>' + berat + '</td>' +
                '<td>' + nama_operator + '</td>' +
                '<td>' + nip_operator + '</td>' +
                '<td>' + grade_operator + '</td>' +
                '<td>' + nama_team_leader + '</td>' +
                '<td>' + waktu_penyebaran + '</td>' +
                '<td>' + waktu_pengembalian + '</td>' +
                '<td>' + user_created + '</td>' +
                '</td><td><button class="btn btn-danger" onclick="hapusBaris(this)">Delete</button></td></tr>';

            $('#tableBody').append(newRow);

            // Menambahkan data ke dalam array
            // dataArrayDocNo.push(doc_no)
            dataArray.push({
                nomor_job: nomor_job,
                jenis_rambang: jenis_rambang,
                upah_operator: upah_operator,
                berat: berat,
                nama_operator: nama_operator,
                nip_operator: nip_operator,
                grade_operator: grade_operator,
                nama_team_leader: nama_team_leader,
                waktu_penyebaran: waktu_penyebaran,
                waktu_pengembalian: waktu_pengembalian,
                user_created: user_created,
            });
            // Membersihkan nilai input setelah ditambahkan
            $('#nomor_batch').val('');
            $('#jenis_rambang').val('');
            $('#berat').val('');
            $('#waktu_penyebaran').val('');
            $('#waktu_pengembalian').val('');
            $('#nama_operator').val('');
            $('#nip_operator').val('');
            $('#grade_operator').val('');
            $('#nama_team_leader').val('');
            $('#upah_operator').val('');
            $('#keterangan').val('');
            $('#modal').val('');
            $('#total_modal').val('');
            $('#nomor_job').val(null).trigger('change');

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
                idBoxes.push(item.nomor_job);
            });

            // Mengirimkan permintaan AJAX untuk memeriksa ketersediaan id box
            $.ajax({
                url: `{{ route('DryAPenerimaanHancuran.CeksendData') }}`, // Ganti dengan URL endpoint yang sesuai untuk memeriksa ketersediaan id box
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
                console.log("Isi data=",
                    dataArray);
                // Mengirim data ke server menggunakan AJAX
                $.ajax({
                    url: '{{ route('DryAPenerimaanHancuran.store') }}',
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
                        // Inisialisasi array untuk menyimpan data tiap baris
                        var tableDataArray = [];

                        // Mengirim dataArray dan data tabel ke server sebagai string JSON
                        var postData = {
                            dataArray: JSON.stringify(dataArray), // Mengirim dataArray sebagai string JSON
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
                                    .redirectTo;
                                // Ganti dengan URL tujuan redirect Anda
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
