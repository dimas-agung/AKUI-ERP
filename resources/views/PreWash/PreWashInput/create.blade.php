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
                                                            <th class="text-center">Status</th>
                                                            <th class="text-center">Jenis Job</th>
                                                            <th class="text-center">Berat Job</th>
                                                            <th class="text-center">Pcs Job</th>
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
                                            <a href="#" class="btn btn-primary" onclick="sendData()">Simpan</a>
                                            <a href="{{ Route('PreCleaningInput.index') }}" type="button"
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
            function addDataToTable(data, rowCount) {
                let newRow = $('<tr>');

                // Tambahkan nomor urut sebagai kolom pertama
                newRow.append('<td>' + rowCount + '</td>');
                // Tambahkan kolom-kolom sesuai kebutuhan
                newRow.append('<td>' + data.nomor_job + '</td>');
                newRow.append('<td>' + data.nomor_batch + '</td>');
                newRow.append('<td>' + data.status + '</td>');
                newRow.append('<td>' + data.jenis_job + '</td>');
                newRow.append('<td>' + data.berat_job + '</td>');
                newRow.append('<td>' + data.pcs_job + '</td>');
                newRow.append('<td>' + data.tujuan_kirim + '</td>');
                newRow.append('<td>' + data.nomor_bstb + '</td>');
                newRow.append('<td>' + data.modal + '</td>');
                newRow.append('<td>' + data.total_modal + '</td>');

                // Tambahkan baris ke dalam tabel
                $('#tableBody').append(newRow);
            }

            $('#nomor_bstb').on('change', function() {
                let selectedIdBox = $(this).val();
                if (selectedIdBox) {
                    $.ajax({
                        url: `{{ route('PreWashInput.set') }}`,
                        method: 'GET',
                        data: {
                            nomor_bstb: selectedIdBox
                        },
                        success: function(response) {
                            console.log(response);
                            $('#tableBody')
                        .empty(); // Bersihkan tabel sebelum menambahkan data baru
                            let rowCount = 1;
                            response.forEach(function(rowData) {
                                addDataToTable(rowData,
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


        // function sendData() {
        //     let selectedNomorBSTB = $('#nomor_bstb').val();
        //     if (selectedNomorBSTB) {
        //         $.ajax({
        //             url: `{{ route('PreWashInput.set') }}`,
        //             method: 'POST',
        //             data: {
        //                 nomor_bstb: selectedNomorBSTB
        //             },
        //             success: function(response) {
        //                 console.log(response);
        //                 $('#tableBody').empty(); // Bersihkan tabel sebelum menambahkan data baru
        //                 response.forEach(function(rowData) {
        //                     addDataToTable(rowData); // Tambahkan data ke tabel
        //                 });
        //             },
        //             error: function(error) {
        //                 console.error('Error:', error);
        //             }
        //         });
        //     } else {
        //         alert('Mohon pilih nomor BSTB terlebih dahulu.');
        //     }
        // }




        // // letiabel global untuk menyimpan indeks baris terakhir
        // let currentRowIndex = 0;
        // let dataStock = [];

        // // Mendefinisikan array jika belum
        // if (typeof dataArray === 'undefined') {
        //     let dataArray = [];
        // }
    </script>
@endsection
