@extends('layouts.master1')
@section('menu')
    Grading Warna
@endsection
@section('title')
    Grading Warna
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card mt-2 border border-primary border-3">
            <div class="card-header">
                <div class="d-flex align-items-center mb-3">
                    <h4 class="card-title">Grading Warna</h4>
                </div>
                <hr>
                <form method="POST" class="row g-3" id="myForm">
                    <div class="col-md-3">
                        <label for="basic-usage" class="form-label">Nomor Lot</label>
                        <select class="select2 form-select" style="width: 100%;" name="nomor_lot" id="nomor_lot"
                            data-placeholder="Pilih Nomor Lot">
                            <option value="">Pilih Nomor Lot</option>
                            @foreach ($grading_warna_adding_stock as $item)
                                <option value="{{ $item->nomor_lot }}">
                                    {{ $item->nomor_lot }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" id="modal">
                        <input type="hidden" id="total_modal">
                    </div>

                    <div class="col-md-3">
                        <label for="nomor_batch" class="form-label">Nomor Batch</label>
                        <input type="text" class="form-control" id="nomor_batch" readonly>
                    </div>

                    <div class="col-md-3">
                        <label for="tujuan_kirim" class="form-label">Tujuan Kirim</label>
                        <input type="text" class="form-control" id="tujuan_kirim" readonly>
                    </div>

                    <div class="col-md-3">
                        <label for="user_created" class="form-label">NIP Admin</label>
                        <input type="text" class="form-control" id="user_created" readonly
                            value="{{ auth()->user()->nip }}">
                    </div>

                    <div class="col-md-3">
                        <label for="berat_lot" class="form-label">Berat Lot</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="berat_lot" readonly>
                    </div>

                    <div class="col-md-3">
                        <label for="pcs_lot" class="form-label">Pcs Lot</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="pcs_lot" readonly>
                    </div>

                    <div class="col-md-3">
                        <label for="sisa_berat_lot" class="form-label">Sisa Berat Lot</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="sisa_berat_lot" readonly>
                    </div>

                    <div class="col-md-3">
                        <label for="sisa_pcs_lot" class="form-label">Sisa Pcs Lot</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="sisa_pcs_lot" readonly>
                    </div>

                    <div class="col-md-3">
                        <label for="basic-usage" class="form-label">Jenis Grading</label>
                        <select class="select2 form-select" style="width: 100%;" name="jenis_grading" id="jenis_grading"
                            data-placeholder="Pilih Jenis Grading">
                            <option value="">Pilih Jenis Grading</option>
                            @foreach ($master_jenis_grading_warna as $item)
                                <option value="{{ $item->jenis }}">
                                    {{ $item->jenis }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" id="kategori_susut">
                        <input type="hidden" id="upah_operator">
                        <input type="hidden" id="pengurangan_harga">
                        <input type="hidden" id="harga_esti">
                        <input type="hidden" id="harga_estimasi">
                        <input type="hidden" id="kontribusi">
                    </div>

                    <div class="col-md-3">
                        <label for="berat_grading" class="form-label">Berat Grading</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="berat_grading">
                    </div>

                    <div class="col-md-3">
                        <label for="pcs_grading" class="form-label">Pcs Grading</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="pcs_grading">
                    </div>

                    <div class="col-md-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan">
                    </div>

                    <div class="col-md-3">
                        <label for="susut_depan" class="form-label">Susut Depan</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="susut_depan" readonly>
                    </div>

                    <div class="col-md-3">
                        <label for="susut_belakang" class="form-label">Susut Belakang</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="susut_belakang" readonly>
                    </div>

                    <div class="col-md-3">
                        <label for="total_berat" class="form-label">Total Berat</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="total_berat" readonly>
                    </div>

                    <div class="col-md-3">
                        <label for="id_box_grading_warna" class="form-label">ID Box Grading Warna</label>
                        <input type="text" class="form-control" id="id_box_grading_warna" readonly>
                    </div>

                    <div class="col-12">
                        <button type="button" class="btn btn-primary" id="tambah_data"
                            onclick="addRow()">Tambah</button>
                        <a href="{{ Route('GradingWarna.index') }}" type="button" class="btn btn-danger">Close</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card mt-2 border border-primary border-3">
            <div class="card-header">
                <div class="d-flex align-items-center mb-3">
                    <h4 class="card-title">Validasi Data</h4>
                </div>
                <div class="card-body" style="overflow: scroll" content="{{ csrf_token() }}">
                    <table class="table" id="dataTable">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">Nomor Lot</th>
                                <th scope="col" class="text-center">Nomor Batch</th>
                                <th scope="col" class="text-center">Tujuan Kirim</th>
                                <th scope="col" class="text-center">Berat Lot</th>
                                <th scope="col" class="text-center">Pcs Lot</th>
                                <th scope="col" class="text-center">Modal</th>
                                <th scope="col" class="text-center">Total Modal</th>
                                <th scope="col" class="text-center">Jenis Grading</th>
                                <th scope="col" class="text-center">Id Box Grading Warna</th>
                                <th scope="col" class="text-center">Kategori Susut</th>
                                <th scope="col" class="text-center">Berat Grading</th>
                                <th scope="col" class="text-center">Pcs Grading</th>
                                <th scope="col" class="text-center">Susut Depan</th>
                                <th scope="col" class="text-center">Susut Belakang</th>
                                <th scope="col" class="text-center">Harga Estimasi</th>
                                <th scope="col" class="text-center">Kontribusi</th>
                                <th scope="col" class="text-center">Keterangan</th>
                                <th scope="col" class="text-center">Nip Admin</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="col-12 mt-3 text-end">
                    {{-- <button type="submit" class="btn btn-success" onclick="CeksendData()">Simpan</button> --}}
                    <button type="submit" class="btn btn-success" onclick="sendData()">Simpan</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            // Get Nomor Lot
            let selectedNomorLot = '';
            let tujuanKirim = '';
            let selectedJenis = '';

            $('#nomor_lot').on('change', function() {
                selectedNomorLot = $(this).val();

                $.ajax({
                    url: '{{ route('GradingWarna.setLot') }}',
                    method: 'GET',
                    data: {
                        nomor_lot: selectedNomorLot
                    },
                    success: function(response) {
                        console.log(response);

                        // Mengatur nilai Nomor Batch sesuai dengan respons dari server
                        $('#nomor_batch').val(response.nomor_batch);
                        tujuanKirim = response.tujuan_kirim;
                        $('#tujuan_kirim').val(tujuanKirim);
                        $('#berat_lot').val(response.sisa_berat);
                        $('#pcs_lot').val(response.sisa_pcs);
                        $('#modal').val(response.modal);
                        $('#total_modal').val(response.total_modal);
                        // hitung Sisa Lot
                        $('#sisa_berat_lot').val(response.sisa_berat);
                        $('#sisa_pcs_lot').val(response.sisa_pcs);
                        initialSisaBeratLot = parseFloat(response.sisa_berat);
                        initialSisaPcsLot = parseFloat(response.sisa_pcs);

                        hargaEstimasi();

                        // Cek apakah kedua nilai sudah diatur untuk membuat IDBoxGradingWarna
                        if (tujuanKirim && selectedJenis) {
                            $('#id_box_grading_warna').val(generateIDBoxGradingWarna(
                                tujuanKirim, selectedJenis));
                        }
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            });

            // Get Jenis Grading
            $('#jenis_grading').on('change', function() {
                selectedJenis = $(this).val();

                $.ajax({
                    url: '{{ route('GradingWarna.setJenis') }}',
                    method: 'GET',
                    data: {
                        jenis_grading: selectedJenis
                    },
                    success: function(response) {
                        console.log(response);

                        // Mengatur nilai sesuai dengan respons dari server
                        $('#kategori_susut').val(response.kategori_susut);
                        $('#upah_operator').val(response.upah_operator);
                        $('#pengurangan_harga').val(response.pengurangan_harga);
                        // $('#harga_estimasi').val(response.harga_estimasi);
                        $('#harga_esti').val(response.harga_estimasi);

                        hargaEstimasi();

                        // Cek apakah kedua nilai sudah diatur untuk membuat IDBoxGradingWarna
                        if (tujuanKirim && selectedJenis) {
                            $('#id_box_grading_warna').val(generateIDBoxGradingWarna(
                                tujuanKirim, selectedJenis));
                        }
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            });

            function generateIDBoxGradingWarna(tujuanKirim, jenisGrading) {
                const IDBoxGradingWarna = `${jenisGrading}_${tujuanKirim}`;

                return IDBoxGradingWarna;
            }

            // Validasi berat_grading tidak boleh lebih dari sisa_berat_lot
            $('#berat_grading').on('input', function() {
                const beratGrading = parseFloat($(this).val()) || 0;
                const sisaBeratLot = initialSisaBeratLot - beratGrading;

                if (beratGrading > initialSisaBeratLot) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Berat Grading tidak boleh lebih dari Sisa Berat Lot.',
                    });
                    $(this).val('');
                    $('#sisa_berat_lot').val(initialSisaBeratLot);
                } else {
                    $('#sisa_berat_lot').val(sisaBeratLot);
                }
            });

            // Validasi pcs_grading tidak boleh lebih dari sisa_pcs_lot
            $('#pcs_grading').on('input', function() {
                const pcsGrading = parseFloat($(this).val()) || 0;
                const sisaPcsLot = initialSisaPcsLot - pcsGrading;

                if (pcsGrading > initialSisaPcsLot) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Pcs Grading tidak boleh lebih dari Sisa Pcs Lot.',
                    });
                    $(this).val('');
                    $('#sisa_pcs_lot').val(initialSisaPcsLot);
                } else {
                    $('#sisa_pcs_lot').val(sisaPcsLot);
                }
            });
        });

        // Hitung harga estimasi
        function hargaEstimasi() {
            // Pastikan nilai modal adalah angka
            const modal_number = parseFloat($('#modal').val());
            console.log("Modal " + modal_number);

            // Cek apakah nomor_lot dan jenis_grading sudah terisi
            const nomorLotTerisi = $('#nomor_lot').val() !== '';
            console.log("Nomor Lot ISI " + nomorLotTerisi);
            const jenisGradingTerisi = $('#jenis_grading').val() !== '';
            console.log("Jenis Gading ISI " + jenisGradingTerisi);

            // Pastikan nilai modal adalah angka dan nomor_lot serta jenis_grading sudah terisi
            if (!isNaN(modal_number) && nomorLotTerisi && jenisGradingTerisi) {
                // Pastikan nilai pengurangan_harga adalah angka
                const pengurangan_harga_number = parseFloat($('#pengurangan_harga').val());
                // Pastikan nilai harga_estimasi adalah angka
                const harga_estimasi = parseFloat($('#harga_esti').val());

                // Menghasilkan nomor BSTB baru
                if (isNaN(pengurangan_harga_number) || pengurangan_harga_number === null || pengurangan_harga_number ===
                    0) {
                    $('#harga_estimasi').val(harga_estimasi);
                } else {
                    $('#harga_estimasi').val(modal_number - (modal_number * pengurangan_harga_number));
                }
            } else {
                // Jika nomor_lot atau jenis_grading belum terisi, tidak melakukan perhitungan
                console.log('Nomor Lot atau jenis grading belum terisi.');
            }
        }

        // Hitung Susut Depan
        function hitungSusutDepan() {
            let beratGradingSD = 0;

            // Iterasi melalui setiap baris tabel
            $('#dataTable tbody tr').each(function() {
                let kategoriSusut = $(this).find('td:eq(9)').text();
                let beratGrading = parseFloat($(this).find('td:eq(10)').text());
                let beratLot = parseFloat($(this).find('td:eq(3)').text());

                // Pastikan beratGrading dan beratLot adalah angka yang valid
                if (!isNaN(beratGrading) && !isNaN(beratLot)) {
                    // Menambahkan berat grading jika kategori susut adalah "SD"
                    if (kategoriSusut === "SD") {
                        beratGradingSD += beratGrading;
                    }
                }
            });

            // Menghitung berat adjustment per adding untuk kategori SD
            let totalBeratLot = parseFloat($('#berat_lot').val()); // Menggunakan berat adding dari input form
            // console.log("Berat Adding = " + totalBeratLot);
            let susutDepan = totalBeratLot !== 0 ? 1 - (beratGradingSD / totalBeratLot) : 0;

            $('#dataTable tbody tr').each(function() {
                let currentKategoriSusut = $(this).find('td:eq(9)').text();
                if (currentKategoriSusut === "SD") {
                    let row = $(this);
                    row.find('td:eq(12)').text(susutDepan.toFixed(4)); // Update nilai di tabel
                } else {
                    let row = $(this);
                    row.find('td:eq(12)').text(susutDepan.toFixed(4)); // Update nilai di tabel
                }
            });

            console.log("Susut Depan = " + susutDepan);
            $('#susut_depan').val(susutDepan.toFixed(4));
        }
        // Hitung Susut Belakang
        function hitungSusutBelakang() {
            let totalBeratGrading = 0;
            let totalBeratLot = parseFloat($('#berat_lot').val()); // Mengambil berat adding dari input form

            // Menghitung total berat adjustment dari setiap baris tabel
            $('#dataTable tbody tr').each(function() {
                let beratLot = parseFloat($(this).find('td:eq(10)').text());

                // Pastikan beratLot adalah angka yang valid
                if (!isNaN(beratLot)) {
                    totalBeratGrading += beratLot;
                }
            });

            // Menghindari pembagian oleh nol
            if (totalBeratLot !== 0) {
                let susutBelakang = 1 - (totalBeratGrading / totalBeratLot);

                // Memperbarui tabel dengan hasil perhitungan
                $('#dataTable tbody tr').each(function() {
                    $(this).find('td:eq(13)').text(susutBelakang.toFixed(4));
                    // Kolom 30 untuk menampilkan hasil perhitungan
                });

                console.log("Susut Belakang = " + susutBelakang);
                $('#susut_belakang').val(susutBelakang.toFixed(4));
            }
        }
        // Hitung Kontribusi
        function hitungKontribusi() {
            // Inisialisasi variabel untuk menyimpan total berat grading dari seluruh tabel
            let totalBeratGrading = 0;
            // Inisialisasi variabel untuk menyimpan jumlah data berat grading yang valid
            let jumlahData = 0;

            // Iterasi melalui setiap baris tabel
            $('#dataTable tbody tr').each(function() {
                // Mendapatkan berat grading dari kolom yang sesuai
                let beratGrading = parseFloat($(this).find('td:eq(10)').text());

                // Pastikan beratGrading adalah angka yang valid
                if (!isNaN(beratGrading)) {
                    // Menambahkan berat grading ke total
                    totalBeratGrading += beratGrading;
                    // Menambah jumlah data berat grading yang valid
                    jumlahData++;
                }
            });

            // Menghindari pembagian oleh nol dan pastikan ada data berat grading yang valid
            if (totalBeratGrading !== 0 && jumlahData > 0) {
                // Iterasi melalui setiap baris tabel
                $('#dataTable tbody tr').each(function() {
                    // Mendapatkan berat grading dari kolom yang sesuai
                    let beratGrading = parseFloat($(this).find('td:eq(10)').text());
                    // Menghitung presentase berat grading berdasarkan total berat grading
                    let kontribusi = (beratGrading / totalBeratGrading) * 100;

                    // Menampilkan hasil perhitungan pada kolom yang sesuai
                    $(this).find('td:eq(15)').text(Math.round(kontribusi) + '%');
                    console.log("Kontribusi = " + Math.round(kontribusi) + '%');
                    // $('#kontribusi').val(kontribusi);
                });
            } else {
                // Jika tidak ada data berat grading yang valid atau total berat grading adalah nol, set semua nilai pada kolom hasil perhitungan ke 0
                $('#dataTable tbody tr').each(function() {
                    $(this).find('td:eq(15)').text('0%');
                });
            }
        }

        // Hitung Total Berat
        function hitungTotalBerat() {
            let totalBerat = 0;
            // Iterasi melalui setiap baris dalam tabel
            $('#dataTable tbody tr').each(function() {
                // Mendapatkan nilai berat adding dari baris saat ini dan menambahkannya ke totalBerat
                let beratGrading = parseFloat($(this).find('td:eq(10)').text()) || 0;
                totalBerat += beratGrading;
            });
            // Menampilkan total berat di input #total_berat
            $('#total_berat').val(totalBerat);
        }

        // Validasi Data
        function validateForm() {
            // Mendefinisikan variabel untuk menyimpan kolom yang belum diisi
            let emptyFields = [];

            // Mendapatkan nilai dari semua input
            let nomor_lot = $('#nomor_lot').val();
            let nomor_batch = $('#nomor_batch').val();
            let tujuan_kirim = $('#tujuan_kirim').val();
            let berat_lot = $('#berat_lot').val();
            let pcs_lot = $('#pcs_lot').val();
            let jenis_grading = $('#jenis_grading').val();
            let berat_grading = $('#berat_grading').val();
            let pcs_grading = $('#pcs_grading').val();
            let id_box_grading_warna = $('#id_box_grading_warna').val();
            let user_created = $('#user_created').val();

            // Memeriksa setiap input, dan jika kosong, tambahkan ke daftar kolom yang belum diisi
            if (!nomor_lot) emptyFields.push('Nomor Lot');
            if (!nomor_batch) emptyFields.push('Nomor Batch');
            if (!tujuan_kirim) emptyFields.push('Tujuan Kirim');
            if (!berat_lot) emptyFields.push('Berat Lot');
            if (!pcs_lot) emptyFields.push('Pcs Lot');
            if (!jenis_grading) emptyFields.push('Jenis Grading');
            if (!berat_grading) emptyFields.push('Berat Grading');
            if (!pcs_grading) emptyFields.push('Pcs Grading');
            if (!id_box_grading_warna) emptyFields.push('ID Box Grading Warna');
            if (!user_created) emptyFields.push('NIP Admin');

            // Jika daftar kolom yang belum diisi tidak kosong, tampilkan pesan peringatan
            if (emptyFields.length > 0) {
                Swal.fire({
                    title: 'Warning!',
                    html: "Harap isi kolom berikut: <br>" + emptyFields.join('<br>'),
                    icon: 'warning'
                });
                return false;
            } else {
                return true; // Form valid
            }
        }

        // ADD ROW
        let dataArray = [];

        function addRow() {
            if (validateForm()) {
                let nomor_lot = $('#nomor_lot').val();
                let nomor_batch = $('#nomor_batch').val();
                let tujuan_kirim = $('#tujuan_kirim').val();
                let berat_lot = $('#berat_lot').val();
                let pcs_lot = $('#pcs_lot').val();
                let modal = $('#modal').val();
                let total_modal = $('#total_modal').val();
                let jenis_grading = $('#jenis_grading').val();
                let kategori_susut = $('#kategori_susut').val();
                let berat_grading = $('#berat_grading').val();
                let pcs_grading = $('#pcs_grading').val();
                let keterangan = $('#keterangan').val();
                let susut_depan = $('#susut_depan').val();
                let susut_belakang = $('#susut_belakang').val();
                let kontribusi = $('#kontribusi').val();
                let harga_estimasi = $('#harga_estimasi').val();
                let id_box_grading_warna = $('#id_box_grading_warna').val();
                let user_created = $('#user_created').val();

                let newRow = `<tr>` +
                    `<td class="text-center">${nomor_lot}</td>` +
                    `<td class="text-center">${nomor_batch}</td>` +
                    `<td class="text-center">${tujuan_kirim}</td>` +
                    `<td class="text-center">${berat_lot}</td>` +
                    `<td class="text-center">${pcs_lot}</td>` +
                    `<td class="text-center">${modal}</td>` +
                    `<td class="text-center">${total_modal}</td>` +
                    `<td class="text-center">${jenis_grading}</td>` +
                    `<td class="text-center">${id_box_grading_warna}</td>` +
                    `<td class="text-center">${kategori_susut}</td>` +
                    `<td class="text-center">${berat_grading}</td>` +
                    `<td class="text-center">${pcs_grading}</td>` +
                    `<td class="text-center">${susut_depan}</td>` +
                    `<td class="text-center">${susut_belakang}</td>` +
                    `<td class="text-center">${harga_estimasi}</td>` +
                    `<td class="text-center">${kontribusi}</td>` +
                    `<td class="text-center">${keterangan}</td>` +
                    `<td class="text-center">${user_created}</td>` +
                    `<td class="text-center"><button class="btn btn-danger" onclick="hapusBaris(this)">Delete</button></td>` +
                    `</tr>`;
                // Tambahkan Kedalam Tabel
                $('#dataTable tbody').append(newRow);
                // disable nomor lot
                $('#nomor_lot').prop('disabled', true);

                // Mengosongkan nilai dropdown nomor_job
                $('#jenis_grading').val(null).trigger('change');
                $('#berat_grading').val('');
                $('#pcs_grading').val('');
                $('#keterangan').val('');
                $('#id_box_grading_warna').val('');

                hitungTotalBerat();
                hitungSusutDepan();
                hitungSusutBelakang();
                hitungKontribusi();

                // Update nilai sisa berat dan pcs
                initialSisaBeratLot -= parseFloat(berat_grading);
                initialSisaPcsLot -= parseFloat(pcs_grading);
                $('#sisa_berat_lot').val(initialSisaBeratLot);
                $('#sisa_pcs_lot').val(initialSisaPcsLot);
            }
        }

        // Hapus Baris
        function hapusBaris(button) {
            // Dapatkan elemen baris terkait dengan tombol delete yang diklik
            let row = $(button).closest('tr');
            // cari berat_grading dan pcs_grading
            let berat_grading = parseFloat(row.find('td:eq(10)').text()) || 0;
            let pcs_grading = parseFloat(row.find('td:eq(11)').text()) || 0;

            row.remove();
            // hitung ulang sisa_lot
            initialSisaBeratLot += berat_grading;
            initialSisaPcsLot += pcs_grading;
            $('#sisa_berat_lot').val(initialSisaBeratLot);
            $('#sisa_pcs_lot').val(initialSisaPcsLot);

            let rowIndex = row.index();
            dataArray.splice(rowIndex, 1);

            // Cek apakah tabel tidak memiliki baris data lagi
            if ($('#dataTable tbody tr').length === 0) {
                $('#nomor_lot').prop('disabled', false).val(null).trigger('change');
                $('#nomor_batch').val('');
                $('#tujuan_kirim').val('');
                $('#berat_lot').val('');
                $('#pcs_lot').val('');
                $('#jenis_grading').val(null).trigger('change');
                $('#berat_grading').val('');
                $('#pcs_grading').val('');
                $('#keterangan').val('');
                $('#id_box_grading_warna').val('');
                $('#susut_depan').val('0');
                $('#susut_belakang').val('0');

                hitungTotalBerat();
                hitungKontribusi();

            } else {
                $('#jenis_grading').val(null).trigger('change');
                $('#berat_grading').val('');
                $('#pcs_grading').val('');
                $('#keterangan').val('');
                $('#id_box_grading_warna').val('');
                $('#susut_depan').val('');
                $('#susut_belakang').val('');

                hitungTotalBerat();
                hitungSusutDepan();
                hitungSusutBelakang();
                hitungKontribusi();
            }
        }

        // function CeksendData() {

        //     var idNomorlot = dataArray.map(item => item.nomor_lot); // Array untuk menyimpan id box yang akan dicek
        //     // Mengirimkan permintaan AJAX untuk memeriksa ketersediaan id box
        //     $.ajax({
        //         url: `{{ route('GradingWarna.CeksendData') }}`,
        //         method: 'POST',
        //         data: {
        //             idNomorlot: JSON.stringify(idNomorlot),
        //             _token: '{{ csrf_token() }}'
        //         },
        //         dataType: 'json',
        //         success: function(response) {
        //             var unavailableNomorlot = response.unavailableNomorlot;

        //             console.log(unavailableNomorlot);

        //             if (unavailableNomorlot.length > 0) {
        //                 // Ada id box yang tidak tersedia, tampilkan pesan kesalahan
        //                 Swal.fire({
        //                     title: 'Error!',
        //                     text: 'Beberapa nomor job sudah tidak tersedia.',
        //                     icon: 'error',
        //                     showCancelButton: false,
        //                     confirmButtonText: 'OK'
        //                 }).then((result) => {
        //                     if (result.isConfirmed) {
        //                         location.reload();
        //                     }
        //                 });
        //             } else {
        //                 sendData();
        //             }
        //         },
        //         error: function(error) {
        //             Swal.fire({
        //                 title: 'Failed!',
        //                 text: 'Terjadi kesalahan saat memeriksa ketersediaan nomor job. Silakan coba lagi.',
        //                 icon: 'error'
        //             });
        //             console.log('Error:', error);
        //         }
        //     });

        function sendData() {

            // dataArray = []; // Kosongkan dataArray terlebih dahulu

            $('#dataTable tbody tr').each(function() {
                let row = $(this).find('td');

                let data = {
                    nomor_lot: row.eq(0).text(),
                    nomor_batch: row.eq(1).text(),
                    tujuan_kirim: row.eq(2).text(),
                    berat_lot: row.eq(3).text(),
                    pcs_lot: row.eq(4).text(),
                    modal: row.eq(5).text(),
                    total_modal: row.eq(6).text(),
                    jenis_grading: row.eq(7).text(),
                    id_box_grading_warna: row.eq(8).text(),
                    kategori_susut: row.eq(9).text(),
                    berat_grading: row.eq(10).text(),
                    pcs_grading: row.eq(11).text(),
                    susut_depan: row.eq(12).text(),
                    susut_belakang: row.eq(13).text(),
                    harga_estimasi: row.eq(14).text(),
                    kontribusi: row.eq(15).text().replace('%', ''),
                    keterangan: row.eq(16).text(),
                    user_created: row.eq(17).text(),
                };

                dataArray.push(data);
            });

            console.log(dataArray);
            // Mengirim data ke server menggunakan AJAX
            $.ajax({
                url: '{{ route('GradingWarna.store') }}',
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
                data: {
                    dataArray: JSON.stringify(dataArray),
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Data berhasil disimpan.',
                        icon: 'success'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = response.redirectTo;
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
    </script>
@endsection
