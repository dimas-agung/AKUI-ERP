@extends('layouts.master1')
@section('menu')
    Rambang
@endsection
@section('title')
    Data Rambang Pengiriman Waste
@endsection
@section('content')
    <div class="container">
        <div class="card border border-primary border-3 mt-2">
            <form action="{{ route('RambangPengirimanWaste.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-0 shadow-sm rounded">
                            <div class="card-header">
                                <h4>Input Data Rambang Pengiriman Waste</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="basic-usage" class="form-label">Id Box Hancuran Kotor</label>
                                        <select class="select2 form-select" style="width: 100%;" name="id_box_hcr_kotor"
                                            id="id_box_hcr_kotor" data-placeholder="Pilih Id Box Hancuran Kotor">
                                            <option value="">Pilih Id Box Hancuran Kotor</option>
                                            @php
                                                $selectedIdBoxHcrKotor = ''; // Inisialisasi variabel untuk menyimpan id_box_hcr_kotor yang sudah ditampilkan
                                            @endphp
                                            @foreach ($rambang_kering_stock as $post)
                                                @if ($selectedIdBoxHcrKotor != $post->id_box_hcr_kotor)
                                                    @php
                                                        $beratMasukShown = false; // Inisialisasi variabel untuk menandai apakah berat_masuk sudah ditampilkan atau belum
                                                    @endphp
                                                    @foreach ($rambang_kering_stock as $innerPost)
                                                        @if ($innerPost->id_box_hcr_kotor == $post->id_box_hcr_kotor && $innerPost->sisa_berat != 0)
                                                            <option value="{{ $innerPost->id_box_hcr_kotor }}">
                                                                {{ old('id_box_hcr_kotor', $innerPost->id_box_hcr_kotor) }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                    @php
                                                        $selectedIdBoxHcrKotor = $post->id_box_hcr_kotor; // Set nilai variabel dengan id_box_hcr_kotor yang baru ditampilkan
                                                    @endphp
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <input type="text" id="keterangan" class="form-control" name="keterangan"
                                                placeholder="Masukkan keterangan">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nomor BSTB</label>
                                            <input type="text" id="nomor_bstb" class="form-control" name="nomor_bstb"
                                                placeholder="Masukkan nomor_bstb">
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
                                                            <th class="text-center">Id Box Hancuran Kotor</th>
                                                            <th class="text-center">Jenis Rambang</th>
                                                            <th class="text-center">Berat</th>
                                                            {{-- <th class="text-center">Nomor BSTB</th> --}}
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
                                            <a href="{{ Route('RambangPengirimanWaste.index') }}" type="button"
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
            dataArray = []; // variabel untuk menampung semua data

            function addDataToTable(rowData, rowCount) {
                let newRow = $('<tr>');

                // Tambahkan nomor urut sebagai kolom pertama
                newRow.append('<td>' + rowCount + '</td>');
                // Tambahkan kolom-kolom sesuai kebutuhan
                newRow.append('<td>' + rowData.id_box_hcr_kotor + '</td>');
                newRow.append('<td>' + rowData.jenis_rambang + '</td>');
                newRow.append('<td>' + rowData.sisa_berat + '</td>');

                // Tambahkan baris ke dalam tabel
                $('#tableBody').append(newRow);

                // Tambahkan rowData ke dalam variabel allData
                dataArray.push({
                    id_box_hcr_kotor: rowData.id_box_hcr_kotor,
                    jenis_rambang: rowData.jenis_rambang,
                    berat: rowData.sisa_berat,
                });

                // Tampilkan data yang disimpan ke dalam konsol
                console.log("Data yang disimpan: ", dataArray);
            }

            function generateNomorBSTB() {
                const now = new Date();
                const tahun = now.getFullYear().toString().substr(-2);
                const bulan = ('0' + (now.getMonth() + 1)).slice(-2);
                const tanggal = ('0' + now.getDate()).slice(-2);
                const jam = ('0' + now.getHours()).slice(-2);
                const menit = ('0' + now.getMinutes()).slice(-2);
                const detik = ('0' + now.getSeconds()).slice(-2);

                const nomorBSTB = `BSTB_${tanggal}${bulan}${tahun}-${jam}${menit}${detik}_AKI_URB`;

                return nomorBSTB;
            }

            $('#id_box_hcr_kotor').on('change', function() {
                let selectedIdBoxHcr = $(this).val();
                if (selectedIdBoxHcr) {
                    // Generate nomor BSTB
                    const nomorBstb = generateNomorBSTB();

                    // Display nomor BSTB
                    $('#nomor_bstb').val(nomorBstb);

                    $.ajax({
                        url: `{{ route('RambangPengirimanWaste.set') }}`,
                        method: 'GET',
                        data: {
                            id_box_hcr_kotor: selectedIdBoxHcr
                        },
                        success: function(response) {
                            console.log(response);
                            // Bersihkan tabel sebelum menambahkan data baru
                            $('#tableBody').empty();
                            // Reset variabel allData
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

            // Mendapatkan semua id_box yang unik
            let uniqueIdBox = [];
            $('#id_box_hcr_kotor option').each(function() {
                if ($.inArray(this.value, uniqueIdBox) === -1) {
                    uniqueIdBox.push(this.value);
                }
            });

            // Menghapus opsi yang ada dan menambahkan opsi yang unik ke dalam select dropdown
            $('#id_box_hcr_kotor').empty();
            uniqueIdBox.forEach(function(id_box_hcr_kotor) {
                $('#id_box_hcr_kotor').append('<option value="' + id_box_hcr_kotor + '">' +
                    id_box_hcr_kotor + '</option>');
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
        //         url: `{{ route('RambangPengirimanWaste.CeksendData') }}`, // Ganti dengan URL endpoint yang sesuai untuk memeriksa ketersediaan id box
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
        //                 text: 'Terjadi kesalahan saat memeriksa ketersediaan nomor bstb. Silakan coba lagi.',
        //                 icon: 'error'
        //             });
        //             console.log('Error:', error);
        //         }
        //     });

        function sendData() {
            // let doc_no = $('#doc_no').val() || '';
            let keterangan = $('#keterangan').val() || '';
            let nomor_bstb = $('#nomor_bstb').val() || '';

            // Mengirim data ke server menggunakan AJAX
            $.ajax({
                url: '{{ route('RambangPengirimanWaste.store') }}',
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
                        nomor_bstb: $('#nomor_bstb').val() || '',
                        user_created: $('#user_created').val() || '',
                        user_updated: $('#user_createds').val() || '',
                        _token: '{{ csrf_token() }}'
                    };

                    // Hanya mengirim keterangan jika memiliki nilai
                    if (keterangan.trim() !== '') {
                        postData.keterangan = keterangan;
                        postData.nomor_bstb = nomor_bstb;
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
