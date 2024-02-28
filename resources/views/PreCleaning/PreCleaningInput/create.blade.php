@extends('layouts.master1')
@section('menu')
    Pre-Cleaning
@endsection
@section('title')
    Data Pre-Cleaning Input
@endsection
@section('content')
    <div class="container">
        <div class="card border border-primary border-3 mt-2">
            <form action="{{ route('PreCleaningInput.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-0 shadow-sm rounded">
                            <div class="card-header">
                                <h4>Input Data Pre-Cleaning Input</h4>
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
                                            <label>Nomer Document</label>
                                            <input type="text" id="doc_no" class="form-control" name="doc_no"
                                                placeholder="Masukkan Nomer Document">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Nomer BSTB</label>
                                            <select id="nomor_bstb" class="select2 form-select" name="nomor_bstb"
                                                data-placeholder="Pilih Nomor BSTB">
                                                <option value="">Pilih Nomor BSTB</option>
                                                @php
                                                    $selectedNomorBSTB = ''; // Inisialisasi variabel untuk menyimpan nomor_bstb yang sudah ditampilkan
                                                @endphp
                                                @foreach ($stockTGK as $post)
                                                    @if ($selectedNomorBSTB != $post->nomor_bstb)
                                                        @php
                                                            $beratMasukShown = false; // Inisialisasi variabel untuk menandai apakah berat_masuk sudah ditampilkan atau belum
                                                        @endphp
                                                        @foreach ($stockTGK as $innerPost)
                                                            @if ($innerPost->nomor_bstb == $post->nomor_bstb && $innerPost->berat_keluar > 0)
                                                                @if (!$beratMasukShown)
                                                                    <option value="{{ $innerPost->nomor_bstb }}">
                                                                        {{ old('nomor_bstb', $innerPost->nomor_bstb) }}
                                                                    </option>
                                                                    @php
                                                                        $beratMasukShown = true; // Set nilai variabel untuk menandai bahwa berat_masuk sudah ditampilkan
                                                                    @endphp
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                        @php
                                                            $selectedNomorBSTB = $post->nomor_bstb; // Set nilai variabel dengan nomor_bstb yang baru ditampilkan
                                                        @endphp
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>NIP Admin</label>
                                            <input type="text" id="user_created" class="form-control" name="user_created"
                                                placeholder="Masukkan User Created">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <input type="text" id="keterangan" class="form-control" name="keterangan"
                                            placeholder="Masukkan keterangan">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-body" style="overflow: scroll" content="{{ csrf_token() }}">
                                                <table class="table table-striped mt-3">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Nomor BSTB</th>
                                                            <th class="text-center">ID Box Grading Kasar</th>
                                                            <th class="text-center">Nomor Job</th>
                                                            <th class="text-center">Nomor Batch</th>
                                                            <th class="text-center">Nomor nota internal</th>
                                                            <th class="text-center">Nama Supplier</th>
                                                            <th class="text-center">ID Box Raw Material</th>
                                                            <th class="text-center">Jenis Raw Material</th>
                                                            <th class="text-center">Jenis Grading</th>
                                                            <th class="text-center">Berat Keluar</th>
                                                            <th class="text-center">PCS Keluar</th>
                                                            <th class="text-center">AVG Kadar Air</th>
                                                            <th class="text-center">Tujuan Kirim</th>
                                                            <th class="text-center">Nomor Grading</th>
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
                                                        onclick="sendData()">Submit</a>
                                                    <a href="{{ url('/PreCleaningInput') }}" type="button"
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
        let selectedNomorBSTB = ''; // Variabel untuk menyimpan nomor BSTB yang dipilih sebelumnya

        $('#nomor_bstb').on('change', function() {
            let selectedIdBox = $(this).val();

            // Hanya lakukan permintaan AJAX jika nomor BSTB yang baru dipilih tidak sama dengan yang sebelumnya
            if (selectedNomorBSTB !== selectedIdBox) {
                selectedNomorBSTB = selectedIdBox; // Perbarui nomor BSTB yang dipilih sebelumnya

                $.ajax({
                    url: `{{ route('PreCleaningInput.set') }}`,
                    method: 'GET',
                    data: {
                        nomor_bstb: selectedIdBox
                    },
                    success: function(response) {
                        if (response.length > 0 && response[0].berat_keluar > 0) {
                            var tableBody = $('#tableBody');
                            tableBody.empty();

                            const rowData = response[0];
                            console.log(rowData);
                            var newRow = $('<tr>');
                            // Tambahkan kolom-kolom sesuai kebutuhan
                            newRow.append('<td>' + rowData.nomor_bstb + '</td>');
                            newRow.append('<td>' + rowData.nomor_job + '</td>');
                            newRow.append('<td>' + rowData.id_box_grading_kasar + '</td>');
                            newRow.append('<td>' + rowData.nomor_batch + '</td>');
                            newRow.append('<td>' + rowData.nomor_nota_internal + '</td>');
                            newRow.append('<td>' + rowData.nama_supplier + '</td>');
                            newRow.append('<td>' + rowData.id_box_raw_material + '</td>');
                            newRow.append('<td>' + rowData.jenis_raw_material + '</td>');
                            newRow.append('<td>' + rowData.jenis_grading + '</td>');
                            newRow.append('<td>' + rowData.berat_keluar + '</td>');
                            newRow.append('<td>' + rowData.pcs_keluar + '</td>');
                            newRow.append('<td>' + rowData.avg_kadar_air + '</td>');
                            newRow.append('<td>' + rowData.tujuan_kirim + '</td>');
                            newRow.append('<td>' + rowData.nomor_grading + '</td>');
                            newRow.append('<td>' + rowData.modal + '</td>');
                            newRow.append('<td>' + rowData.total_modal + '</td>');
                            // Tambahkan baris ke dalam tabel
                            tableBody.append(newRow);

                            // Bersihkan dataArray sebelum menambahkan data baru
                            dataArray = [];
                            // Menyimpan data dalam dataArray
                            dataArray.push({
                                nomor_bstb: rowData.nomor_bstb,
                                nomor_job: rowData.nomor_job,
                                jenis_kirim: rowData.jenis_kirim,
                                id_box_grading_kasar: rowData.id_box_grading_kasar,
                                nomor_batch: rowData.nomor_batch,
                                nama_supplier: rowData.nama_supplier,
                                id_box_raw_material: rowData.id_box_raw_material,
                                jenis_raw_material: rowData.jenis_raw_material,
                                tujuan_kirim: rowData.tujuan_kirim,
                                jenis_kirim: rowData.jenis_grading,
                                berat_kirim: rowData.berat_keluar,
                                pcs_kirim: rowData.pcs_keluar,
                                kadar_air: rowData.avg_kadar_air,
                                nomor_grading: rowData.nomor_grading,
                                modal: rowData.modal,
                                total_modal: rowData.total_modal,
                                nomor_nota_internal: rowData.nomor_nota_internal,
                            });
                            console.log(dataArray);
                        } else {
                            // Berat 0, mencegah pemilihan dan memberikan pesan kepada pengguna
                            Swal.fire({
                                title: 'Warning!',
                                text: 'Berat tidak boleh 0. Pilih nomor BSTB lain.',
                                icon: 'error'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                            });
                            $('#nomor_bstb').val('');
                        }
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            }
        });



        function sendData() {
            var doc_no = $('#doc_no').val() || '';
            var keterangan = $('#keterangan').val() || '';

            // Mengirim data ke server menggunakan AJAX
            $.ajax({
                url: '{{ route('PreCleaningInput.store') }}',
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
                        doc_no: doc_no,
                        user_created: $('#user_created').val() || '',
                        user_updated: 'Asc-186',
                        _token: '{{ csrf_token() }}'
                    };

                    // Hanya mengirim keterangan jika memiliki nilai
                    if (keterangan.trim() !== '') {
                        postData.keterangan = keterangan;
                    }

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



        // Variabel global untuk menyimpan indeks baris terakhir
        var currentRowIndex = 0;
        var dataStock = [];

        // Mendefinisikan array jika belum
        if (typeof dataArray === 'undefined') {
            var dataArray = [];
        }
    </script>
@endsection
