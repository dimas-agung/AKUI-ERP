@extends('layouts.master1')
@section('Menu')
    Purchasing & EXIM
@endsection
@section('title')
    Input Purchasing Raw Material
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card mt-2">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Input Purchasing Raw Material</h4>
                </div>
                {{-- <form action="{{ route('purchasing_exim/prm_raw_material_input.store') }}" method="POST" class="row g-3"> --}}
                <form method="POST" class="row g-3" id="myForm">
                    @csrf
                    <div class="col-md-4">
                        <label for="no_doc" class="form-label">Nomor DOC</label>
                        <input type="text" class="form-control" id="no_doc" value="1" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="nomor_po" class="form-label">Nomor PO</label>
                        <input type="text" class="form-control" id="nomor_po">
                    </div>
                    <div class="col-md-4">
                        <label for="nomor_batch" class="form-label">Nomor Batch</label>
                        <input type="text" class="form-control" id="nomor_batch">
                    </div>
                    <div class="col-md-4">
                        <label for="nomor_nota_supplier" class="form-label">Nomor Nota Supplier</label>
                        <input type="text" class="form-control" id="nomor_nota_supplier">
                    </div>
                    <div class="col-md-4">
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
                    <div class="col-md-flex">
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
                        <input type="text" pattern="[0-9]*" inputmode="numeric"
                            onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control"
                            id="berat_nota">
                    </div>
                    <div class="col-md-3">
                        <label for="berat_kotor" class="form-label">Berat Kotor</label>
                        <input type="text" pattern="[0-9]*" inputmode="numeric"
                            onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control"
                            id="berat_kotor">
                    </div>
                    <div class="col-md-3">
                        <label for="berat_bersih" class="form-label">Berat Bersih</label>
                        <input type="text" pattern="[0-9]*" inputmode="numeric"
                            onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control"
                            id="berat_bersih">
                    </div>
                    <div class="col-md-3">
                        <label for="selisih_berat" class="form-label">Selisih Berat</label>
                        <input type="text" pattern="[0-9]*" inputmode="numeric"
                            onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control"
                            id="selisih_berat">
                    </div>
                    <div class="col-md-3">
                        <label for="kadar_air" class="form-label">Kadar Air</label>
                        <input type="text" pattern="[0-9]*" inputmode="numeric"
                            onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control"
                            id="kadar_air">
                    </div>
                    <div class="col-md-3">
                        <label for="id_box" class="form-label">ID Box</label>
                        <input type="text" class="form-control" id="id_box">
                    </div>
                    <div class="col-md-3">
                        <label for="harga_nota" class="form-label">Harga Nota</label>
                        <input type="text" pattern="[0-9]*" inputmode="numeric"
                            onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control"
                            id="harga_nota">
                    </div>
                    <div class="col-md-3">
                        <label for="total_harga_nota" class="form-label">Total Harga Nota</label>
                        <input type="text" pattern="[0-9]*" inputmode="numeric"
                            onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control"
                            id="total_harga_nota">
                    </div>
                    <div class="col-md-3">
                        <label for="harga_deal" class="form-label">Harga Deal</label>
                        <input type="text" pattern="[0-9]*" inputmode="numeric"
                            onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control"
                            id="harga_deal">
                    </div>
                    <div class="col-md-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan">
                    </div>
                    <div class="col-md-3">
                        <label for="user_created" class="form-label">NIP Admin</label>
                        <input type="text" class="form-control" id="user_created">
                    </div>
                    <div class="col-12">
                        <button type="button" class="btn btn-primary" onclick="addRow()">Tambah</button>
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
                                {{-- <th scope="col">Doc No</th> --}}
                                <th scope="col" class="text-center">Jenis</th>
                                <th scope="col" class="text-center">Berat Nota</th>
                                <th scope="col" class="text-center">Berat Kotor</th>
                                <th scope="col" class="text-center">Berat Bersih</th>
                                <th scope="col" class="text-center">Selisih Berat</th>
                                <th scope="col" class="text-center">Kadar Air</th>
                                <th scope="col" class="text-center">ID Box</th>
                                <th scope="col" class="text-center">Harga Nota</th>
                                <th scope="col" class="text-center">Total Harga Nota</th>
                                <th scope="col" class="text-center">Harga Deal</th>
                                <th scope="col" class="text-center">Keterangan</th>
                                <th scope="col" class="text-center">NIP Admin</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="col-12 mt-2 text-end">
                    <button type="submit" class="btn btn-success" onclick="simpanData()">Simpan</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
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
        // test
        var dataArray = [];
        var dataHeader = [];
        var dataStock = [];

        function addRow() {
            console.log(dataArray);
            // Mengambil nilai dari input
            let doc_no = $('#doc_no').val();
            let nomor_po = $('#nomor_po').val();
            let nomor_batch = $('#nomor_batch').val();
            let nomor_nota_supplier = $('#nomor_nota_supplier').val();
            let nomor_nota_internal = $('#nomor_nota_internal').val();
            let nama_supplier = $('#nama_supplier').val();
            let jenis = $('#jenis').val();
            let berat_nota = $('#berat_nota').val();
            let berat_kotor = $('#berat_kotor').val();
            let berat_bersih = $('#berat_bersih').val();
            let selisih_berat = $('#selisih_berat').val();
            let kadar_air = $('#kadar_air').val();
            let id_box = $('#id_box').val();
            let harga_nota = $('#harga_nota').val();
            let total_harga_nota = $('#total_harga_nota').val();
            let harga_deal = $('#harga_deal').val();
            let keterangan = $('#keterangan').val();
            let user_created = $('#user_created').val();
            // test
            let berat_masuk = $('#berat_bersih').val();
            let avg_kadar_air = $('#kadar_air').val();
            // Validasi input (sesuai kebutuhan)
            if (nomor_po.trim() === '' || nomor_batch.trim() === '' || nomor_nota_supplier.trim() === '' ||
                nomor_nota_internal.trim() === '' || nama_supplier.trim() === '' || jenis.trim() === '' ||
                berat_nota.trim() === '' || berat_kotor.trim() === '' || berat_bersih.trim() === '' ||
                selisih_berat.trim() === '' ||
                kadar_air.trim() === '' || id_box.trim() === '' || harga_nota.trim() === '' || total_harga_nota.trim() ===
                '' || harga_deal.trim() === '') {
                alert('Harap isi semua kolom.');
                return; // Berhenti jika ada input yang kosong
            }
            // Menambahkan data ke dalam tabel
            var newRow = '<tr>' +
                // '<td>' + doc_no + '</td>' +
                '<td>' + jenis + '</td>' +
                '<td>' + berat_nota + '</td>' +
                '<td>' + berat_kotor + '</td>' +
                '<td>' + berat_bersih + '</td>' +
                '<td>' + selisih_berat + '</td>' +
                '<td>' + kadar_air + '</td>' +
                '<td>' + id_box + '</td>' +
                '<td>' + harga_nota + '</td>' +
                '<td>' + total_harga_nota + '</td>' +
                '<td>' + harga_deal + '</td>' +
                '<td>' + keterangan + '</td>' +
                '<td>' + user_created + '</td>' +
                '</tr>';
            $('#dataTable tbody').append(newRow);
            // $('#myForm')[0].reset();

            // Menambahkan data ke dalam array
            dataArray.push({
                id_box: id_box,
                nomor_batch: nomor_batch,
                nama_supplier: nama_supplier,
                doc_no: doc_no,
                jenis: jenis,
                berat_nota: berat_nota,
                berat_kotor: berat_kotor,
                berat_bersih: berat_bersih,
                selisih_berat: selisih_berat,
                kadar_air: kadar_air,
                id_box: id_box,
                harga_nota: harga_nota,
                total_harga_nota: total_harga_nota,
                harga_deal: harga_deal,
                keterangan: keterangan,
                user_created: user_created,
                nomor_nota_internal: nomor_nota_internal,
            });
            console.log(dataArray);
            dataHeader = [];
            dataHeader.push({
                doc_no: doc_no,
                nomor_po: nomor_po,
                nomor_batch: nomor_batch,
                nomor_nota_supplier: nomor_nota_supplier,
                nomor_nota_internal: nomor_nota_internal,
                nama_supplier: nama_supplier,
                keterangan: keterangan,
                user_created: user_created,
            });
            console.log(dataArray);
            // Membersihkan nilai input setelah ditambahkan
            $('#jenis').val('');
            $('#berat_nota').val('');
            $('#berat_kotor').val('');
            $('#berat_bersih').val('');
            $('#selisih_berat').val('');
            $('#kadar_air').val('');
            $('#id_box').val('');
            $('#harga_nota').val('');
            $('#total_harga_nota').val('');
            $('#harga_deal').val('');
            $('#keterangan').val('');
        }

        function getArray() {
            // Menampilkan array di konsol untuk tujuan debugging
            console.log(dataArray);
        }

        function simpanData() {
            console.log(dataArray);
            // Mengirim data ke server menggunakan AJAX
            $.ajax({
                url: `{{ route('prm_raw_material_input.simpanData') }}`, // Ganti dengan URL endpoint yang sesuai
                method: 'POST',
                data: {
                    data: JSON.stringify(dataArray),
                    dataHeader: JSON.stringify(dataHeader),
                    // dataStock: JSON.stringify(dataStock),
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json', // payload is json,
                success: function(response) {
                    console.log('Data sent successfully:', response);
                    window.location.href = `{{ route('prm_raw_material_input.index') }}`;
                },
                error: function(error) {
                    console.error('Error sending data:', error);
                }
            });
            // Membersihkan array setelah data dikirim
            // dataArray = [];
        }
    </script>
@endsection
