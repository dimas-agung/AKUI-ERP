@extends('layouts.template')
@section('content')
    <div class="col-md-12">
        <div class="card mt-2">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Input Purchasing Raw Material</h4>
                </div>
                {{-- <form action="{{ route('purchasing_exim/prm_raw_material_input.store') }}" method="POST" class="row g-3" --}}
                <form method="POST" class="row g-3" id="myForm">
                    @csrf
                    {{-- <div class="col-md-4">
                        <label for="no_doc" class="form-label">Nomor DOC</label>
                        <input type="text" class="form-control" id="no_doc">
                    </div> --}}
                    <div class="col-md-6">
                        <label for="nomor_po" class="form-label">Nomor PO</label>
                        <input type="text" class="form-control" id="nomor_po">
                    </div>
                    <div class="col-md-6">
                        <label for="nomor_batch" class="form-label">Nomor Batch</label>
                        <input type="text" class="form-control" id="nomor_batch">
                    </div>
                    <div class="col-4">
                        <label for="nomor_nota_supplier" class="form-label">Nomor Nota Supplier</label>
                        <input type="text" class="form-control" id="nomor_nota_supplier">
                    </div>
                    <div class="col-4">
                        <label for="nomor_nota_internal" class="form-label">Nomor Nota Internal</label>
                        <input type="text" class="form-control" id="nomor_nota_internal">
                    </div>
                    <div class="col-md-4">
                        <label for="basic-usage" class="form-label">Pilih Nama Supplier :</label>
                        <select class="form-select select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1"
                            aria-hidden="true" name="nama_supplier" id="nama_supplier"
                            data-placeholder="Pilih Nama Supplier">
                            @foreach ($master_supplier_raw_materials as $MasterSPRM)
                                <option></option>
                                <option value="{{ $MasterSPRM->nama_supplier }}">
                                    {{ $MasterSPRM->nama_supplier }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12">
                        <hr>
                    </div>
                    <div class="col-md-3">
                        <label for="basic-usage" class="form-label">Pilih Jenis :</label>
                        <select class="form-select select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1"
                            aria-hidden="true" name="jenis" id="jenis" data-placeholder="Pilih Jenis">
                            @foreach ($master_jenis_raw_materials as $MasterJRM)
                                <option></option>
                                <option value="{{ $MasterJRM->jenis }}">
                                    {{ $MasterJRM->jenis }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="berat_nota" class="form-label">Berat Nota</label>
                        <input type="number" class="form-control" id="berat_nota">
                    </div>
                    <div class="col-md-3">
                        <label for="berat_kotor" class="form-label">Berat Kotor</label>
                        <input type="number" class="form-control" id="berat_kotor">
                    </div>
                    <div class="col-md-3">
                        <label for="berat_bersih" class="form-label">Berat Bersih</label>
                        <input type="number" class="form-control" id="berat_bersih">
                    </div>
                    <div class="col-md-3">
                        <label for="selisih_berat" class="form-label">Selisih Berat</label>
                        <input type="number" class="form-control" id="selisih_berat">
                    </div>
                    <div class="col-md-3">
                        <label for="kadar_air" class="form-label">Kadar Air</label>
                        <input type="number" class="form-control" id="kadar_air">
                    </div>
                    <div class="col-md-3">
                        <label for="id_box" class="form-label">ID Box</label>
                        <input type="text" class="form-control" id="id_box">
                    </div>
                    <div class="col-md-3">
                        <label for="harga_nota" class="form-label">Harga Nota</label>
                        <input type="number" class="form-control" id="harga_nota">
                    </div>
                    <div class="col-md-3">
                        <label for="total_harga_nota" class="form-label">Total Harga Nota</label>
                        <input type="number" class="form-control" id="total_harga_nota">
                    </div>
                    <div class="col-md-3">
                        <label for="harga_deal" class="form-label">Harga Deal</label>
                        <input type="number" class="form-control" id="harga_deal">
                    </div>
                    <div class="col-md-3">
                        <label for="keterangan_item" class="form-label">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan_item">
                    </div>
                    <div class="col-md-3">
                        <label for="user_created" class="form-label">NIP Admin</label>
                        <input type="text" class="form-control" id="user_created">
                    </div>
                    <div class="col-12">
                        <button type="button" class="btn btn-primary" id="addDataToTable">Tambah</button>
                        {{-- <button type="submit" class="btn btn-warning" id="resetBtn">Reset</button> --}}
                    </div>
                </form>
            </div>

        </div>
    </div>

    {{-- table --}}
    <div class="col-md-12">
        <div class="card mt-2">
            <div class="card-header">
                <div class="card-body" style="overflow: scroll" content="{{ csrf_token() }}">
                    <table class="table" id="dataTable">
                        <thead>
                            <tr>
                                {{-- <th scope="col">No</th> --}}
                                <th scope="col">Jenis</th>
                                <th scope="col">Berat Nota</th>
                                <th scope="col">Berat Kotor</th>
                                <th scope="col">Berat Bersih</th>
                                <th scope="col">Selisih Berat</th>
                                <th scope="col">Kadar Air</th>
                                <th scope="col">ID Box</th>
                                <th scope="col">Harga Nota</th>
                                <th scope="col">Total Harga Nota</th>
                                <th scope="col">Harga Deal</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">NIP Admin</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="col-12 mt-2 text-end">
                    <button type="submit" class="btn btn-success" id="simpanData">Simpan</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        // Menambahkan event listener untuk perubahan nilai pada input nomor nota supplier dan select nama supplier
        $('#nomor_nota_supplier').on('input', generateNomorNotaInternal);
        $('#nama_supplier').on('change', generateNomorNotaInternal);
        // $('#nomor_nota_supplier, #nama_supplier').on('input change', generateNomorNotaInternal);
        $('#nomor_nota_internal').on('input', generateIdBox);
        $('#jenis').on('change', generateIdBox);
        $('#harga_nota').on('input', generateIdBox);
        // Event listener untuk input beratNotaInput dan hargaNotaInput
        $('#berat_nota').on('input', updateTotalHarga);
        $('#harga_nota').on('input', updateTotalHarga);

        // Event listener untuk perubahan nilai pada berat nota atau berat bersih
        $('#berat_nota').on('input', updateSelisihBerat);
        $('#berat_bersih').on('input', updateSelisihBerat);

        // Event listener untuk perubahan nilai pada total harga nota atau berat bersih
        $('#total_harga_nota').on('input', updateHargaDeal);
        $('#berat_bersih').on('input', updateHargaDeal);

        $('#nama_supplier').on('change', function() {
            // Mengambil nilai id_box yang dipilih
            let selectedNamaSupplier = $(this).val();
            // Melakukan permintaan AJAX ke controller untuk mendapatkan nomor batch
            $.ajax({
                url: `{{ route('prm_raw_material_input.getDataSupplier') }}`,
                method: 'GET',
                data: {
                    nama_supplier: selectedNamaSupplier
                },
                success: function(response) {
                    console.log(response);
                    let inisial_supplier = response.inisial_supplier;
                    // let created_at = response.created_at;
                    generateNomorNotaInternal(inisial_supplier);
                    // generateNomorNotaInternal(created_at);

                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });

        // idbox
        $('#jenis').on('change', function() {
            // Mengambil nilai id_box yang dipilih
            let selectedJenis = $(this).val();
            // Melakukan permintaan AJAX ke controller untuk mendapatkan nomor batch
            $.ajax({
                url: `{{ route('prm_raw_material_input.getDataJenis') }}`,
                method: 'GET',
                data: {
                    jenis: selectedJenis
                },
                success: function(response) {
                    console.log(response);
                    let jenis = response.jenis;
                    // let created_at = response.created_at;
                    generateIdBox(jenis);
                    // generateNomorNotaInternal(created_at);

                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });
        // generate nomor internal
        function generateNomorNotaInternal(inisial_supplier) {
            const nomorNotaSupplier = $('#nomor_nota_supplier').val();
            const namaSupplier = $('#nama_supplier').val();
            // ambil tanggal, bulan, tahun
            const now = new Date();
            const tahun = now.getFullYear().toString().substr(-2); // Ambil 2 digit terakhir tahun
            const bulan = ('0' + (now.getMonth() + 1)).slice(-2); // Menambah '0' jika satu digit
            const tanggal = ('0' + now.getDate()).slice(-2);

            // Membentuk nomor nota internal dengan menggabungkan nama supplier dan nomor nota supplier
            const nomorNotaInternal = `${inisial_supplier}_${nomorNotaSupplier}_${tanggal}${bulan}${tahun}`;
            // console.log(nomorNotaInternal);

            // Menampilkan nomor nota internal pada input nomor nota internal
            $('#nomor_nota_internal').val(nomorNotaInternal);

        }
        // generate ID_Box
        function generateIdBox(jenis) {
            const nomorNotaInternal = $('#nomor_nota_internal').val();
            const Jenis = $('#jenis').val();
            const hargaNota = $('#harga_nota').val();

            // Membentuk nomor nota internal dengan menggabungkan nama supplier dan nomor nota supplier
            const idBox = `${nomorNotaInternal}_${Jenis}_${hargaNota}`;
            // console.log(nomorNotaInternal);

            // Menampilkan nomor nota internal pada input nomor nota internal
            $('#id_box').val(idBox);

        }

        function updateSelisihBerat() {
            // Mendapatkan nilai berat nota dan berat bersih
            const beratNota = parseFloat($('#berat_nota').val());
            const beratBersih = parseFloat($('#berat_bersih').val());

            // Melakukan perhitungan selisih berat
            const selisihBerat = beratBersih - beratNota;

            // Memasukkan hasil perhitungan ke dalam input selisih berat
            $('#selisih_berat').val(isNaN(selisihBerat) ? '' : selisihBerat);
        }

        function updateTotalHarga() {
            // Mendapatkan nilai berat nota dan harga nota menggunakan jQuery
            const beratNota = parseFloat($('#berat_nota').val());
            const hargaNota = parseFloat($('#harga_nota').val());

            // Melakukan perhitungan total harga nota
            const totalHargaNota = beratNota * hargaNota;

            // Memasukkan hasil perhitungan ke dalam input total harga nota menggunakan jQuery
            $('#total_harga_nota').val(isNaN(totalHargaNota) ? '' : totalHargaNota.toFixed(2));
        }

        function updateHargaDeal() {
            // Mendapatkan nilai total harga nota dan berat bersih menggunakan jQuery
            const totalHargaNota = parseFloat($('#total_harga_nota').val());
            const beratBersih = parseFloat($('#berat_bersih').val());

            // Melakukan perhitungan harga deal
            const hargaDeal = beratBersih !== 0 ? totalHargaNota / beratBersih : 0;
            // const hargaDeal = totalHargaNota / beratBersih: 0;

            // Memasukkan hasil perhitungan ke dalam input harga deal menggunakan jQuery
            $('#harga_deal').val(isNaN(hargaDeal) ? '' : hargaDeal.toFixed(2));
        }
    </script>
    <script>
        $(document).ready(function() {
            // Event handler untuk tombol Tambah
            $('#addDataToTable').on('click', function() {
                // Mengambil nilai dari setiap input
                let Jenis = $('#jenis').val();
                let BeratNota = $('#berat_nota').val();
                let BeratKotor = $('#berat_kotor').val();
                let BeratBersih = $('#berat_bersih').val();
                let SelisihBerat = $('#selisih_berat').val();
                let KadarAir = $('#kadar_air').val();
                let IdBox = $('#id_box').val();
                let HargaNota = $('#harga_nota').val();
                let TotalHargaNota = $('#total_harga_nota').val();
                let HargaDeal = $('#harga_deal').val();
                let Keterangan = $('#keterangan_item').val();
                let NipAdmin = $('#user_created').val();

                if (Jenis.trim() === '' || BeratNota.trim() === '' || BeratKotor.trim() === '' ||
                    BeratBersih.trim() === '' || SelisihBerat.trim() === '' || KadarAir.trim() === '' ||
                    IdBox.trim() === '' || HargaNota.trim() === '' || TotalHargaNota.trim() ===
                    '' || HargaDeal.trim() === '') {
                    alert('Harap isi semua kolom.');
                    return; // Berhenti jika ada input yang kosong
                }

                // Buat baris baru untuk tabel

                var newRow = '<tr>' +
                    '<td>' + Jenis + '</td>' +
                    '<td>' + BeratNota + '</td>' +
                    '<td>' + BeratKotor + '</td>' +
                    '<td>' + BeratBersih + '</td>' +
                    '<td>' + SelisihBerat + '</td>' +
                    '<td>' + KadarAir + '</td>' +
                    '<td>' + IdBox + '</td>' +
                    '<td>' + HargaNota + '</td>' +
                    '<td>' + TotalHargaNota + '</td>' +
                    '<td>' + HargaDeal + '</td>' +
                    '<td>' + Keterangan + '</td>' +
                    '<td>' + NipAdmin + '</td>' +
                    '</tr>';

                // Tambahkan baris ke dalam tabel
                $('#dataTable tbody').append(newRow);
                $('#myForm')[0].reset();
            });

        });
    </script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#simpanData').on('click', function() {
                var dataToSend = [];

                // Mendapatkan semua baris dari tabel kecuali header
                $('#dataTable tbody tr').each(function() {
                    var rowData = {};
                    $(this).find('td').each(function(index, element) {
                        var columnName = $('#dataTable thead th').eq(index).text().trim();
                        rowData[columnName] = $(element).text().trim();
                    });
                    dataToSend.push(rowData);
                });

                // Kirim data ke Laravel menggunakan AJAX
                $.ajax({
                    url: `{{ route('prm_raw_material_input.simpanData') }}`,
                    method: 'POST',
                    data: {
                        data: dataToSend,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Tanggapi respon dari server jika ada
                    },
                    error: function(error) {
                        // Tanggapi kesalahan jika ada
                    }
                });
            });
        });
    </script>
    {{-- <script>
        $(document).ready(function() {
            $('#resetBtn').on('click', function() {
                $('#myForm').trigger('reset'); // Memicu event reset pada formulir
            });
        });
    </script> --}}
@endsection
