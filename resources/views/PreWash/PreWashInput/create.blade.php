@extends('layouts.master1')
@section('menu')
    Pre-Wash
@endsection
@section('title')
    Data Pre-Wash Input
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
                                <h4>Input Data Pre Wash Input</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="basic-usage" class="form-label">Nomor BSTB</label>
                                        <select class="select2 form-select" style="width: 100%;" name="nomor_bstb"
                                            id="nomor_bstb" data-placeholder="Pilih Nomor BSTB">
                                            <option value="">Pilih Nomor BSTB</option>
                                            @foreach ($transit_grading_haluses as $item)
                                                <option value="{{ $item->nomor_bstb }}">
                                                    {{ $item->nomor_bstb }}
                                                </option>
                                            @endforeach
                                        </select>
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
                                            <label>Keterangan</label>
                                            <input type="text" id="keterangan" class="form-control" name="keterangan"
                                                placeholder="Masukkan keterangan">
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
                                                            <th class="text-center">Unit</th>
                                                            <th class="text-center">Nomor Job</th>
                                                            <th class="text-center">Nomor Batch</th>
                                                            <th class="text-center">Status</th>
                                                            <th class="text-center">Jenis Job</th>
                                                            <th class="text-center">Berat Job</th>
                                                            <th class="text-center">Pcs Job</th>
                                                            <th class="text-center">Tujuan Kirim</th>
                                                            <th class="text-center">Nomor BSTB</th>
                                                            <th class="text-center">Keterangan</th>
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
                                                    <a href="{{ Route('PreCleaningInput.index') }}" type="button"
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
                    url: `{{ route('PreWashInput.set') }}`,
                    method: 'GET',
                    data: {
                        nomor_bstb: selectedIdBox
                    },
                    success: function(response) {
                        console.log(response);
                        // if (response.length > 0 && response[0].berat_keluar > 0) {
                        //     var tableBody = $('#tableBody');
                        //     tableBody.empty();

                        // Menghapus dataArray sebelum menambahkan data baru
                        dataArray = [];

                        // Iterasi melalui setiap data yang diterima
                        response.forEach(function(rowData) {
                            var newRow = $('<tr>');
                            // Tambahkan kolom-kolom sesuai kebutuhan
                            newRow.append('<td>' + rowData.unit + '</td>');
                            newRow.append('<td>' + rowData.nomor_job + '</td>');
                            newRow.append('<td>' + rowData.nomor_batch + '</td>');
                            newRow.append('<td>' + rowData.status + '</td>');
                            newRow.append('<td>' + rowData.jenis_job + '</td>');
                            newRow.append('<td>' + rowData.berat_job + '</td>');
                            newRow.append('<td>' + rowData.pcs_job + '</td>');
                            newRow.append('<td>' + rowData.tujuan_kirim + '</td>');
                            newRow.append('<td>' + rowData.nomor_bstb + '</td>');
                            newRow.append('<td>' + rowData.keterangan + '</td>');
                            newRow.append('<td>' + rowData.modal + '</td>');
                            newRow.append('<td>' + rowData.total_modal + '</td>');

                            // Tambahkan baris ke dalam tabel
                            tableBody.append(newRow);

                            // Menambahkan data ke dalam dataArray
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
                        });
                        // } else {
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
                        // }
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
                        user_updated: $('#user_createds').val() || '',
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
