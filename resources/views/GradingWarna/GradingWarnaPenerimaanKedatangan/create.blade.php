@extends('layouts.master1')
@section('menu')
    Grading Warna
@endsection
@section('title')
    Data Grading Warna Penerimaan Kedatangan
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
                                <h4>Input Data Grading Warna Penerimaan Kedatangan</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="basic-usage" class="form-label">Nomor BSTB</label>
                                        <select class="select2 form-select" style="width: 100%;" name="nomor_bstb"
                                            id="nomor_bstb" data-placeholder="Pilih Nomor BSTB">
                                            <option value="">Pilih Nomor BSTB</option>
                                            @php
                                                $selectedNomorBSTB = ''; // Inisialisasi variabel untuk menyimpan nomor_bstb yang sudah ditampilkan
                                            @endphp
                                            @foreach ($transit_kedatangan as $post)
                                                <option value="{{ $post }}">
                                                    {{ old('nomor_bstb', $post) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="basic-usage" class="form-label">NIP Admin</label>
                                        <input type="text" id="user_created" class="form-control" name="user_created"
                                            value="{{ auth()->user()->nip }}" readonly>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="basic-usage" class="form-label">Keterangan</label>
                                        <input type="text" id="keterangan" class="form-control" name="keterangan"
                                            placeholder="Masukkan keterangan">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-body" style="overflow: scroll" content="{{ csrf_token() }}">
                                                <table class="table table-striped mt-3">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col" class="text-center">No</th>
                                                            <th scope="col" class="text-center">Nomor Batch</th>
                                                            <th scope="col" class="text-center">Jenis</th>
                                                            <th scope="col" class="text-center">Berat</th>
                                                            <th scope="col" class="text-center">Pcs</th>
                                                            <th scope="col" class="text-center">Tujuan Kirim</th>
                                                            <th scope="col" class="text-center">Keterangan</th>
                                                            <th scope="col" class="text-center">Nomor Job</th>
                                                            <th scope="col" class="text-center">Nomor BSTB</th>
                                                            <th scope="col" class="text-center">Modal</th>
                                                            <th scope="col" class="text-center">Total Modal</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tableBody">
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-md-12 text-end">
                                            {{-- <a href="#" class="btn btn-primary" onclick="CeksendData()">Simpan</a> --}}
                                            <a href="#" class="btn btn-primary" onclick="sendData()">Simpan</a>
                                            <a href="{{ Route('GradingWarnaPenerimaanKedatangan.index') }}" type="button"
                                                class="btn btn-danger" data-dismiss="modal">Close</a>
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
        let dataArray = [];
        $(document).ready(function() {
            // Definisikan dataArray di luar fungsi untuk dapat diakses oleh semua fungsi

            // Definisikan fungsi addDataToTable
            function addDataToTable(rowData, rowCount) {
                let newRow = $('<tr>');

                // Tambahkan nomor urut sebagai kolom pertama
                newRow.append('<td>' + rowCount + '</td>');
                // Tambahkan kolom-kolom sesuai kebutuhan
                newRow.append('<td>' + rowData.nomor_batch + '</td>');
                newRow.append('<td>' + rowData.jenis + '</td>');
                newRow.append('<td>' + rowData.berat + '</td>');
                newRow.append('<td>' + rowData.pcs + '</td>');
                newRow.append('<td>' + rowData.tujuan_kirim + '</td>');
                newRow.append('<td>' + rowData.keterangan + '</td>');
                newRow.append('<td>' + rowData.nomor_job + '</td>');
                newRow.append('<td>' + rowData.nomor_bstb + '</td>');
                newRow.append('<td>' + rowData.modal + '</td>');
                newRow.append('<td>' + rowData.total_modal + '</td>');

                // Tambahkan baris ke dalam tabel
                $('#tableBody').append(newRow);

                // Tambahkan rowData ke dalam dataArray
                dataArray.push({
                    nomor_batch: rowData.nomor_batch,
                    jenis_grading: rowData.jenis,
                    berat_1_grading: rowData.berat,
                    pcs_1_grading: rowData.pcs,
                    tujuan_kirim: rowData.tujuan_kirim,
                    nomor_job: rowData.nomor_job,
                    nomor_bstb: rowData.nomor_bstb,
                    modal: rowData.modal,
                    total_modal: rowData.total_modal,
                });

                // Tampilkan data yang disimpan ke dalam konsol
                console.log("Data yang disimpan:", dataArray);
            }

            $('#nomor_bstb').on('change', function() {
                let selectedNomorBSTB = $(this).val();
                console.log("Selected Nomor BSTB: ", selectedNomorBSTB);
                if (selectedNomorBSTB) {
                    $.ajax({
                        url: `{{ route('GradingWarnaPenerimaanKedatangan.setBSTB') }}`,
                        method: 'GET',
                        data: {
                            nomor_bstb: selectedNomorBSTB
                        },
                        success: function(response) {
                            console.log("Response: ", response);
                            if (Array.isArray(response)) {
                                $('#tableBody').empty();
                                dataArray = [];
                                let rowCount = 1;
                                response.forEach(function(data) {
                                    addDataToTable(data, rowCount++);
                                });
                            } else {
                                console.error('Error: Response is not an array');
                            }
                        },
                        error: function(error) {
                            console.error('Error:', error);
                        }
                    });
                }
            });

            let uniqueNomorBSTB = [];
            $('#nomor_bstb option').each(function() {
                if ($.inArray(this.value, uniqueNomorBSTB) === -1) {
                    uniqueNomorBSTB.push(this.value);
                }
            });

            $('#nomor_bstb').empty();
            uniqueNomorBSTB.forEach(function(nomor_bstb) {
                $('#nomor_bstb').append('<option value="' + nomor_bstb + '">' + nomor_bstb + '</option>');
            });
        });

        function sendData() {
            // Mengirim data ke server menggunakan AJAX
            $.ajax({
                url: '{{ route('GradingWarnaPenerimaanKedatangan.store') }}',
                method: 'POST',
                data: {
                    dataArray: JSON.stringify(dataArray), // Mengirim dataArray sebagai string JSON
                    user_created: $('#user_created').val() || '',
                    user_updated: $('#user_updated').val() || '',
                    keterangan: $('#keterangan').val() || '',
                    _token: '{{ csrf_token() }}'
                },
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
                success: function(response) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Data berhasil disimpan.',
                        icon: 'success'
                    }).then((result) => {
                        // Redirect ke halaman lain setelah menekan tombol "OK" pada SweetAlert
                        if (result.isConfirmed) {
                            window.location.href = response.redirectTo;
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
