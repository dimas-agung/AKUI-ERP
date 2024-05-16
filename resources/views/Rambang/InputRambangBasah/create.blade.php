@extends('layouts.master1')
@section('menu')
    Rambang
@endsection
@section('title')
    Input Rambang Basah
@endsection
@section('content')
    {{-- <div class="container"> --}}
    <div class="card border border-primary border-3 mt-2">
        <form action="{{ route('InputRambangBasah.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 shadow-sm rounded">
                        <div class="card-header">
                            <h4>Input Data Rambang Basah</h4>
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
                                        <label>Id Box Hcr Kotor</label>
                                        <select id="id_box_hcr_kotor" data-placeholder="Pilih Id Box Hcr Kotor"
                                            class="select2 form-select" name="id_box_hcr_kotor">
                                            <option value="">Pilih Id Box Hcr Kotor</option>
                                            @foreach ($TransitPre->sortBy('id_box_hcr_kotor') as $post)
                                                <option value="{{ $post->id_box_hcr_kotor }}">
                                                    {{ old('id_box_hcr_kotor', $post->id_box_hcr_kotor) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jenis Rambang</label>
                                        <select id="jenis" data-placeholder="Pilih Jenis Rambang"
                                            class="select2 form-select" name="jenis">
                                            <option value="">Pilih Jenis Rambang</option>
                                            @foreach ($Unit->sortBy('jenis') as $post)
                                                <option value="{{ $post->jenis }}">
                                                    {{ old('jenis', $post->jenis) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Jenis Hcr Kotor</label>
                                        <input type="text" class="form-control" id="jenis_hcr_kotor"
                                            name="jenis_hcr_kotor" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tanggal Cabut</label>
                                        <input type="text" class="form-control" id="tanggal_cabut" name="tanggal_cabut"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Berat Hcr Kotor</label>
                                        <input type="text" class="form-control" id="berat_masuk" name="berat_masuk"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Berat</label>
                                        <input type="text" id="berat" pattern="[0-9]*" inputmode="numeric"
                                            onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                            class="form-control" name="berat" value="{{ old('berat') }}"
                                            placeholder="Masukkan berat" data-parsley-required="true">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <input type="text" id="keterangan" class="form-control" name="keterangan"
                                            placeholder="Masukkan keterangan">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>NIP Admin</label>
                                        <input type="text" id="user_created" class="form-control" name="user_created"
                                            value="{{ auth()->user()->nip }}" readonly data-parsley-required="true">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="button" class="btn btn-primary" onclick="addRow()">Add</button>
                                <a href="{{ Route('InputRambangBasah.index') }}" type="button" class="btn btn-danger"
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
                                <th class="text-center" scope="col">Id Box Hcr Kotor</th>
                                <th class="text-center" scope="col">Tanggal Cabut</th>
                                <th class="text-center" scope="col">Jenis Hcr Kotor</th>
                                <th class="text-center" scope="col">Berat Hcr Kotor</th>
                                <th class="text-center" scope="col">Jenis Rambang</th>
                                <th class="text-center" scope="col">Berat</th>
                                <th class="text-center" scope="col">Keterangan</th>
                                <th class="text-center" scope="col">NIP Admin</th>
                                <th class="text-center" scope="col">Action</th>
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
        $('#id_box_hcr_kotor').on('change', function() {
            let selectedIdBox = $(this).val();
            $.ajax({
                url: `{{ route('InputRambangBasah.set') }}`,
                method: 'GET',
                data: {
                    id_box_hcr_kotor: selectedIdBox
                },
                success: function(response) {
                    console.log(response);
                    $('#tanggal_cabut').val(response.tanggal_cabut);
                    $('#jenis_hcr_kotor').val(response.jenis_hcr_kotor);
                    $('#berat_masuk').val(response.berat_masuk);
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });

        // Variabel global untuk menyimpan indeks baris terakhir
        var currentRowIndex = 0;
        var dataArray = [];

        function addRow() {
            // Mengambil nilai dari input
            var id_box_hcr_kotor = $('#id_box_hcr_kotor').val();
            var tanggal_cabut = $('#tanggal_cabut').val();
            var jenis_hcr_kotor = $('#jenis_hcr_kotor').val();
            var berat_masuk = $('#berat_masuk').val();
            var jenis = $('#jenis').val();
            var berat = $('#berat').val();
            var keterangan = $('#keterangan').val();
            var user_created = $('#user_created').val();

            // Inisialisasi array untuk menyimpan field yang belum terisi
            let fieldsNotFilled = [];
            // Periksa setiap field
            if (!id_box_hcr_kotor) fieldsNotFilled.push('Id Box Hcr Kotor');
            if (!jenis) fieldsNotFilled.push('Jenis Rambang');
            if (!berat) fieldsNotFilled.push('Berat');
            if (!user_created) fieldsNotFilled.push('NIP Admin');

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
                '<td>' + tanggal_cabut + '</td>' +
                '<td>' + jenis_hcr_kotor + '</td>' +
                '<td>' + berat_masuk + '</td>' +
                '<td>' + jenis + '</td>' +
                '<td>' + berat + '</td>' +
                '<td>' + keterangan + '</td>' +
                '<td>' + user_created + '</td>' +
                '</td><td><button class="btn btn-danger" onclick="hapusBaris(this)">Delete</button></td></tr>';

            $('#tableBody').append(newRow);

            // Menambahkan data ke dalam array
            dataArray.push({
                id_box_hcr_kotor: id_box_hcr_kotor,
                tanggal_cabut: tanggal_cabut,
                jenis_hcr_kotor: jenis_hcr_kotor,
                berat_hcr_kotor: berat_masuk,
                jenis_rambang: jenis,
                berat: berat,
                berat_masuk: berat_masuk,
                keterangan: keterangan,
                user_created: user_created,
            });
            // Membersihkan nilai input setelah ditambahkan
            $('#berat').val('');
            $('#jenis').val($('#jenis option:first').val()).trigger('change');
            $('#id_box_hcr_kotor').prop('disabled', true);
            $('#tanggal_cabut').prop('readonly', true);
            $('#jenis_hcr_kotor').prop('readonly', true);
            $('#berat_masuk').prop('readonly', true);
            $('#user_created').prop('readonly', true);
            // $('#jenis').val($('#jenis option:first').val());

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

        // function CeksendData() {
        //     var i = 0;
        //     var idBoxes = []; // Array untuk menyimpan id box yang akan dicek

        //     // Mengumpulkan id box dari dataArray
        //     dataArray.forEach(function(item) {
        //         idBoxes.push(item.nomor_grading);
        //     });

        //     // Mengirimkan permintaan AJAX untuk memeriksa ketersediaan id box
        //     $.ajax({
        //         url: `{{ route('InputRambangBasah.CeksendData') }}`, // Ganti dengan URL endpoint yang sesuai untuk memeriksa ketersediaan id box
        //         method: 'POST',
        //         data: {
        //             idBoxes: JSON.stringify(idBoxes),
        //             _token: '{{ csrf_token() }}'
        //         },
        //         dataType: 'json',
        //         success: function(response) {
        //             var unavailableBoxes = response.unavailableBoxes;

        //             if (unavailableBoxes.length > 0) {
        //                 // Ada id box yang tidak tersedia, tampilkan pesan kesalahan
        //                 Swal.fire({
        //                     title: 'Error!',
        //                     text: 'Beberapa nomor grading sudah tidak tersedia.',
        //                     icon: 'error',
        //                     showCancelButton: false, // Sembunyikan tombol cancel
        //                     confirmButtonText: 'OK' // Ganti teks tombol konfirmasi
        //                 }).then((result) => {
        //                     // Jika pengguna menekan tombol "OK", refresh halaman
        //                     if (result.isConfirmed) {
        //                         location.reload(); // Refresh halaman
        //                     }
        //                 });
        //             } else {
        //                 // Semua id box tersedia, kirim data ke server
        //                 sendData();
        //             }
        //         },
        //         error: function(error) {
        //             Swal.fire({
        //                 title: 'Failed!',
        //                 text: 'Terjadi kesalahan saat memeriksa ketersediaan nomor grading. Silakan coba lagi.',
        //                 icon: 'error'
        //             });
        //             console.log('Error:', error);
        //         }
        //     });

        function sendData() {
            console.log("Isi data=",
                dataArray);
            // Mengirim data ke server menggunakan AJAX
            $.ajax({
                url: '{{ route('InputRambangBasah.store') }}',
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
    </script>
@endsection
