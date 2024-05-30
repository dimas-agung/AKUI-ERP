@extends('layouts.master1')
@section('menu')
    Dry A Penerimaan
@endsection
@section('title')
    Input Dry A Penerimaan
@endsection
@section('content')
    {{-- <div class="container"> --}}
    <div class="card border border-primary border-3 mt-2">
        <form action="{{ route('DryAPenerimaan.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 shadow-sm rounded">
                        <div class="card-header">
                            <h4>Input Data Dry A Penerimaan</h4>
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
                                        <label>Nomor Job</label>
                                        <select id="nomor_job" class="select2 form-select" name="nomor_job"
                                            data-placeholder="Pilih Nomor Job">
                                            <option value="">Pilih Nomor Job</option>
                                            @foreach ($TransitPre->sortBy('nomor_job') as $post)
                                                @if ($post->berat_job > 0)
                                                    <option value="{{ $post->nomor_job }}">
                                                        {{ old('nomor_job', $post->nomor_job) }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nomor Batch</label>
                                        <input type="text" class="form-control" id="nomor_batch" name="nomor_batch">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>NIP Admin</label>
                                        <input type="text" id="user_created" class="form-control" name="user_created"
                                            value="{{ auth()->user()->nip }}" readonly data-parsley-required="true">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Jenis Job</label>
                                        <input type="text" class="form-control" id="jenis_job" name="jenis_job">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Berat Job</label>
                                        <input type="text" class="form-control" id="berat_job" name="berat_job" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Pcs Job</label>
                                        <input type="text" class="form-control" id="pcs_job" name="pcs_job" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tujuan Kirim</label>
                                        <input type="text" class="form-control" id="tujuan_kirim" name="tujuan_kirim"
                                            readonly>
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
                                        <label>Modal</label>
                                        <input type="text" id="modal" class="form-control" name="modal" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Total Modal</label>
                                        <input type="text" id="total_modal" class="form-control" name="total_modal"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Upah Operator</label>
                                        <input type="text" id="upah_operator" class="form-control" name="upah_operator"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <input type="text" id="keterangan" class="form-control" name="keterangan"
                                            readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="button" class="btn btn-primary" onclick="addRow()">Add</button>
                                <a href="{{ Route('DryAPenerimaan.index') }}" type="button" class="btn btn-danger"
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
                                <th class="text-center" scope="col">Nomor Job</th>
                                <th class="text-center" scope="col">Nomor Batch</th>
                                <th class="text-center" scope="col">Jenis Job</th>
                                <th class="text-center" scope="col">Berat Job</th>
                                <th class="text-center" scope="col">Pcs Job</th>
                                <th class="text-center" scope="col">Tujuan Kirim</th>
                                <th class="text-center" scope="col">Nama Operator</th>
                                <th class="text-center" scope="col">NIP Operator</th>
                                <th class="text-center" scope="col">Grade Operator</th>
                                <th class="text-center" scope="col">Nama Team Leader</th>
                                <th class="text-center" scope="col">Upah Operator</th>
                                <th class="text-center" scope="col">Keterangan</th>
                                <th class="text-center" scope="col">Modal</th>
                                <th class="text-center" scope="col">Total Modal</th>
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
                    url: `{{ route('DryAPenerimaan.set') }}`,
                    method: 'GET',
                    data: {
                        nomor_job: selectedIdBox
                    },
                    success: function(response) {
                        console.log(response);
                        $('#nomor_batch').val(response.nomor_batch);
                        $('#jenis_job').val(response.jenis_job);
                        $('#berat_job').val(response.berat_job);
                        $('#pcs_job').val(response.pcs_job);
                        $('#tujuan_kirim').val(response.tujuan_kirim);
                        $('#nama_operator').val(response.nama_operator);
                        $('#nip_operator').val(response.nip_operator);
                        $('#grade_operator').val(response.grade_operator);
                        $('#nama_team_leader').val(response.nama_team_leader);
                        $('#upah_operator').val(response.upah_operator);
                        $('#keterangan').val(response.keterangan);
                        $('#modal').val(response.modal);
                        $('#total_modal').val(response.total_modal);
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
            var nomor_batch = $('#nomor_batch').val();
            var jenis_job = $('#jenis_job').val();
            var berat_job = $('#berat_job').val();
            var pcs_job = $('#pcs_job').val();
            var tujuan_kirim = $('#tujuan_kirim').val();
            var nama_operator = $('#nama_operator').val();
            var nip_operator = $('#nip_operator').val();
            var grade_operator = $('#grade_operator').val();
            var nama_team_leader = $('#nama_team_leader').val();
            var upah_operator = $('#upah_operator').val();
            var keterangan = $('#keterangan').val();
            var modal = $('#modal').val();
            var total_modal = $('#total_modal').val();
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
                '<td>' + nomor_batch + '</td>' +
                '<td>' + jenis_job + '</td>' +
                '<td>' + berat_job + '</td>' +
                '<td>' + pcs_job + '</td>' +
                '<td>' + tujuan_kirim + '</td>' +
                '<td>' + nama_operator + '</td>' +
                '<td>' + nip_operator + '</td>' +
                '<td>' + grade_operator + '</td>' +
                '<td>' + nama_team_leader + '</td>' +
                '<td>' + upah_operator + '</td>' +
                '<td>' + keterangan + '</td>' +
                '<td>' + modal + '</td>' +
                '<td>' + total_modal + '</td>' +
                '<td>' + user_created + '</td>' +
                '</td><td><button class="btn btn-danger" onclick="hapusBaris(this)">Delete</button></td></tr>';

            $('#tableBody').append(newRow);

            // Menambahkan data ke dalam array
            // dataArrayDocNo.push(doc_no)
            dataArray.push({
                nomor_job: nomor_job,
                nomor_batch: nomor_batch,
                jenis_job: jenis_job,
                berat_job: berat_job,
                pcs_job: pcs_job,
                tujuan_kirim: tujuan_kirim,
                nama_operator: nama_operator,
                nip_operator: nip_operator,
                grade_operator: grade_operator,
                nama_team_leader: nama_team_leader,
                upah_operator: upah_operator,
                keterangan: keterangan,
                modal: modal,
                total_modal: total_modal,
                user_created: user_created,
            });
            // Membersihkan nilai input setelah ditambahkan
            $('#nomor_batch').val('');
            $('#jenis_job').val('');
            $('#berat_job').val('');
            $('#pcs_job').val('');
            $('#tujuan_kirim').val('');
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
                url: `{{ route('DryAPenerimaan.CeksendData') }}`, // Ganti dengan URL endpoint yang sesuai untuk memeriksa ketersediaan id box
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
                    url: '{{ route('DryAPenerimaan.store') }}',
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
