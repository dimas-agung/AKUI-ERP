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
                                            @php
                                                $selectedNomorBSTB = ''; // Inisialisasi variabel untuk menyimpan nomor_bstb yang sudah ditampilkan
                                            @endphp
                                            @foreach ($transit_grading_haluses as $post)
                                                <option value="{{ $post }}">
                                                    {{ old('nomor_bstb', $post) }}
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
                                {{-- </div> --}}
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-body" style="overflow: scroll" content="{{ csrf_token() }}">
                                                <table class="table table-striped mt-3">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">No</th>
                                                            <th class="text-center">Nomor Job</th>
                                                            <th class="text-center">Nomor Batch</th>
                                                            {{-- <th class="text-center">Status</th> --}}
                                                            <th class="text-center">Jenis Job</th>
                                                            <th class="text-center">Berat Job</th>
                                                            <th class="text-center">Pcs Job</th>
                                                            <th class="text-center">Upah Operator</th>
                                                            <th class="text-center">Tujuan Kirim</th>
                                                            <th class="text-center">Nomor BSTB</th>
                                                            <th class="text-center">Modal</th>
                                                            <th class="text-center">Total Modal</th>
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
                                            <a href="{{ Route('PreWashInput.index') }}" type="button"
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
        $(document).ready(function() {
            dataArray = []; // letiabel untuk menampung semua data

            function addDataToTable(rowData, rowCount) {
                let newRow = $('<tr>');

                // Tambahkan nomor urut sebagai kolom pertama
                newRow.append('<td>' + rowCount + '</td>');
                // Tambahkan kolom-kolom sesuai kebutuhan
                newRow.append('<td>' + rowData.nomor_job + '</td>');
                newRow.append('<td>' + rowData.nomor_batch + '</td>');
                // newRow.append('<td>' + rowData.status + '</td>');
                newRow.append('<td>' + rowData.jenis_job + '</td>');
                newRow.append('<td>' + rowData.berat_job + '</td>');
                newRow.append('<td>' + rowData.pcs_job + '</td>');
                newRow.append('<td>' + rowData.upah_operator + '</td>');
                newRow.append('<td>' + rowData.tujuan_kirim + '</td>');
                newRow.append('<td>' + rowData.nomor_bstb + '</td>');
                newRow.append('<td>' + rowData.modal + '</td>');
                newRow.append('<td>' + rowData.total_modal + '</td>');

                // Tambahkan baris ke dalam tabel
                $('#tableBody').append(newRow);

                // Tambahkan rowData ke dalam letiabel allData
                // allData.push(data);
                dataArray.push({
                    nomor_job: rowData.nomor_job,
                    nomor_batch: rowData.nomor_batch,
                    status: rowData.status,
                    jenis_job: rowData.jenis_job,
                    berat_job: rowData.berat_job,
                    pcs_job: rowData.pcs_job,
                    upah_operator: rowData.upah_operator,
                    tujuan_kirim: rowData.tujuan_kirim,
                    nomor_bstb: rowData.nomor_bstb,
                    modal: rowData.modal,
                    total_modal: rowData.total_modal,
                });

                // Tampilkan data yang disimpan ke dalam konsol
                // console.log("Data yang disimpan:", allData);
            }
            console.log("Data yang disimpan: ", dataArray);

            $('#nomor_bstb').on('change', function() {
                let selectedNomorBSTB = $(this).val();
                if (selectedNomorBSTB) {
                    $.ajax({
                        url: `{{ route('PreWashInput.set') }}`,
                        method: 'GET',
                        data: {
                            nomor_bstb: selectedNomorBSTB
                        },
                        success: function(response) {
                            console.log(response);
                            // Bersihkan tabel sebelum menambahkan data baru
                            $('#tableBody').empty();
                            // Reset letiabel allData
                            dataArray = [];
                            let rowCount = 1;
                            response.forEach(function(data) {
                                addDataToTable(data,
                                    rowCount++); // Tambahkan data ke tabel
                            });
                        },
                        error: function(error) {
                            console.error('Error:', error);
                        }
                    });
                }
            });

            // Mendapatkan semua nomor_bstb yang unik
            let uniqueNomorBSTB = [];
            $('#nomor_bstb option').each(function() {
                if ($.inArray(this.value, uniqueNomorBSTB) === -1) {
                    uniqueNomorBSTB.push(this.value);
                }
            });

            // Menghapus opsi yang ada dan menambahkan opsi yang unik ke dalam select dropdown
            $('#nomor_bstb').empty();
            uniqueNomorBSTB.forEach(function(nomor_bstb) {
                $('#nomor_bstb').append('<option value="' + nomor_bstb + '">' + nomor_bstb + '</option>');
            });
        });

        // function CeksendData() {
        //     let i = 0;
        //     let nomorBSTB = []; // Array untuk menyimpan id box yang akan dicek

        //     // Mengumpulkan id box dari dataArray
        //     dataArray.forEach(function(item) {
        //         nomorBSTB.push(item.nomor_bstb);
        //     });

        //     // Mengirimkan permintaan AJAX untuk memeriksa ketersediaan id box
        //     $.ajax({
        //         url: `{{ route('PreWashInput.CeksendData') }}`, // Ganti dengan URL endpoint yang sesuai untuk memeriksa ketersediaan id box
        //         method: 'POST',
        //         data: {
        //             nomorBSTB: JSON.stringify(nomorBSTB),
        //             _token: '{{ csrf_token() }}'
        //         },
        //         dataType: 'json',
        //         success: function(response) {
        //             let unavailableNomorBSTB = response.unavailableNomorBSTB;

        //             if (unavailableNomorBSTB.length > 0) {
        //                 // Ada id box yang tidak tersedia, tampilkan pesan kesalahan
        //                 Swal.fire({
        //                     title: 'Error!',
        //                     text: 'Beberapa nomor bstb sudah tidak tersedia.',
        //                     icon: 'error',
        //                     showCancelButton: false, // Sembunyikan tombol cancel
        //                     confirmButtonText: 'OK' // Ganti teks tombol konfirmasi
        //                 }).then((result) => {
        //                     // Jika pengguna menekan tombol "OK", refresh halaman
        //                     if (result.isConfirmed) {
        //                         location.reload();
        //                         // Refresh halaman
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
        //                 text: 'Terjadi kesalahan saat memeriksa ketersediaan nomor bstb. Silakan coba lagi.',
        //                 icon: 'error'
        //             });
        //             console.log('Error:', error);
        //         }
        //     });

        function sendData() {
            // let doc_no = $('#doc_no').val() || '';
            let keterangan = $('#keterangan').val() || '';

            // Mengirim data ke server menggunakan AJAX
            $.ajax({
                url: '{{ route('PreWashInput.store') }}',
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
                    let postData = {
                        dataArray: JSON.stringify(dataArray), // Mengirim dataArray sebagai string JSON
                        // doc_no: doc_no,
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
        // }

        // letiabel global untuk menyimpan indeks baris terakhir
        let currentRowIndex = 0;
        let dataStock = [];

        // Mendefinisikan array jika belum
        if (typeof dataArray === 'undefined') {
            let dataArray = [];
        }
    </script>
@endsection
