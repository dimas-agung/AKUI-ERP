@extends('layouts.master1')
@section('menu')
    Adjustment Input
@endsection
@section('title')
    Grading Halus Adjustment Input
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card mt-2 border border-primary border-3">
            <div class="card-header">
                <div class="d-flex align-items-center mb-3">
                    <h4 class="card-title">Grading Halus Adjustment Input</h4>
                </div>
                <hr>
                <form method="POST" class="row g-3" id="myForm">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="basic-usage" class="form-label">Nomor Adjustment</label>
                            <select class="select2 form-select" style="width: 100%;" name="nomor_adjustment"
                                id="nomor_adjustment" data-placeholder="Pilih Nomor Adjustment">
                                <option value="">Pilih Nomor Adjustment</option>
                                @foreach ($grading_halus_adjustment_inputs as $ADJI)
                                    <option value="{{ $ADJI->nomor_adjustment }}">
                                        {{ $ADJI->nomor_adjustment }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="nomor_batch" class="form-label">Nomor Batch</label>
                        <input type="text" class="form-control" id="nomor_batch" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="berat_adding" class="form-label">Berat Adding</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="berat_adding" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="pcs_adding" class="form-label">Pcs Adding</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="pcs_adding" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="modal" class="form-label">Modal</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="modal" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="total_modal" class="form-label">Total Modal</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="total_modal" readonly>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="basic-usage" class="form-label">Jenis Adjustment</label>
                            <select class="select2 form-select" style="width: 100%;" name="jenis_adjustment"
                                id="jenis_adjustment" data-placeholder="Pilih Jenis Adjustment">
                                <option value="">Pilih Jenis Adjustment</option>
                                @foreach ($master_jenis_grading_halus as $MasterJGH)
                                    <option value="{{ $MasterJGH->jenis }}">
                                        {{ $MasterJGH->jenis }}
                                    </option>
                                @endforeach
                            </select>
                            <input type="hidden" id="harga_estimasi" name="harga_estimasi" readonly>
                            <input type="hidden" id="pengurangan_harga" name="pengurangan_harga" readonly>
                            <input type="hidden" id="id_box_grading_halus" name="id_box_grading_halus" readonly>
                            <input type="hidden" id="kontribusi" name="kontribusi" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="kategori_susut" class="form-label">Kategori Susut</label>
                        <input type="text" class="form-control" id="kategori_susut" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="berat_adjustment" class="form-label">Berat Adjustment</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="berat_adjustment">
                    </div>
                    <div class="col-md-3">
                        <label for="pcs_adjustment" class="form-label">Pcs Adjustment</label>
                        <input onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="pcs_adjustment">
                    </div>
                    <div class="col-md-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan">
                    </div>
                    <div class="col-md-3">
                        <label for="user_created" class="form-label">NIP Admin</label>
                        <input type="text" class="form-control" id="user_created">
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
                        <label for="total_pcs" class="form-label">Total Pcs</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="total_pcs" readonly>
                    </div>
                    <div class="col-12">
                        <button type="button" class="btn btn-primary" onclick="addRow()">Tambah</button>
                        {{-- <button type="submit" class="btn btn-warning" id="resetBtn">Reset</button> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card mt-2 border border-primary border-3">
            <div class="card-header">
                <div class="card-body" style="overflow: scroll">
                    <table class="table" id="dataTable">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">Id Box Grading Halus</th>
                                <th scope="col" class="text-center">Nomor Adjustment</th>
                                <th scope="col" class="text-center">Nomor Batch</th>
                                <th scope="col" class="text-center">Berat Adding</th>
                                <th scope="col" class="text-center">Pcs Adding</th>
                                <th scope="col" class="text-center">Jenis Adjustment</th>
                                <th scope="col" class="text-center">Kategori Susut</th>
                                <th scope="col" class="text-center">Berat Adjustment</th>
                                <th scope="col" class="text-center">Pcs Adjustment</th>
                                <th scope="col" class="text-center">Keterangan</th>
                                <th scope="col" class="text-center">Modal</th>
                                <th scope="col" class="text-center">Total Modal</th>
                                <th scope="col" class="text-center">Kontribusi</th>
                                <th scope="col" class="text-center">Harga Estimasi</th>
                                <th scope="col" class="text-center">Susut Depan</th>
                                <th scope="col" class="text-center">Susut Belakang</th>
                                <th scope="col" class="text-center">Action</th>
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
            $('#nomor_adjustment').on('change', function() {
                // Mengambil nilai id_box yang dipilih
                let selectedNomorAdjustment = $(this).val();
                // Melakukan permintaan AJAX ke controller untuk mendapatkan nomor batch
                $.ajax({
                    url: `{{ route('GradingHalusAdjustmentAdding.getNomorAdjustment') }}`,
                    method: 'GET',
                    data: {
                        nomor_adjustment: selectedNomorAdjustment
                    },
                    success: function(response) {
                        console.log(response);
                        // Mengatur nilai Nomor Batch sesuai dengan respons dari server
                        $('#nomor_batch').val(response.nomor_batch);
                        $('#berat_adding').val(response.berat_adding);
                        $('#pcs_adding').val(response.pcs_adding);
                        $('#modal').val(response.modal);
                        $('#total_modal').val(response.total_modal);
                        updateIdBoxGradingHalus();
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            });
            // Jenis Adjustment
            $('#jenis_adjustment').on('change', function() {
                // Mengambil nilai id_box yang dipilih
                let selectedJenis = $(this).val();
                // Melakukan permintaan AJAX ke controller untuk mendapatkan nomor batch
                $.ajax({
                    url: `{{ route('GradingHalusAdjustmentAdding.getJenisGradingHalus') }}`,
                    method: 'GET',
                    data: {
                        jenis: selectedJenis
                    },
                    success: function(response) {
                        console.log(response);
                        // Mengatur nilai Nomor Batch sesuai dengan respons dari server
                        $('#kategori_susut').val(response.kategori_susut);
                        $('#harga_estimasi').val(response.harga_estimasi);
                        $('#pengurangan_harga').val(response.pengurangan_harga);
                        // Log untuk memeriksa nilai
                        // console.log("Jenis: " + jenis);
                        console.log("Kategori Susut: " + response.kategori_susut);
                        console.log("Harga Estimasi: " + response.harga_estimasi);
                        console.log("Pengurangan Harga: " + response.pengurangan_harga);
                        updateIdBoxGradingHalus();
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            });
        });

        // Generate ID Box Grading Halus
        function updateIdBoxGradingHalus() {
            // Mengambil nilai nomor batch, nomor adjustment, dan jenis adjustment yang dipilih
            let selectedNomorBatch = $('#nomor_batch').val();
            let selectedNomorAdjustment = $('#nomor_adjustment').val();
            let selectedJenis = $('#jenis_adjustment').val();

            // Pastikan keduanya terisi sebelum membuat ID box grading halus
            if (selectedNomorBatch && selectedJenis) {
                // Membuat ID box grading halus dari nomor batch, nomor adjustment, dan jenis adjustment
                let idBoxGradingHalus = selectedNomorBatch + '_' + selectedJenis;
                $('#id_box_grading_halus').val(idBoxGradingHalus);
                console.log("ID Box Grading Halus = " + idBoxGradingHalus);
            }
        }
        // Calculate Total Berat
        function calculateTotalBerat() {
            let totalBerat = 0;
            // Iterasi melalui setiap baris dalam tabel
            $('#dataTable tbody tr').each(function() {
                // Mendapatkan nilai berat adding dari baris saat ini dan menambahkannya ke totalBerat
                let beratAdjustment = parseFloat($(this).find('td:eq(7)').text()) || 0;
                totalBerat += beratAdjustment;
            });
            // Menampilkan total berat di input #total_berat
            $('#total_berat').val(totalBerat);
        }
        // Calculate Total Pcs
        function calculateTotalPcs() {
            let totalPcs = 0;
            // Iterasi melalui setiap baris dalam tabel
            $('#dataTable tbody tr').each(function() {
                // Mendapatkan nilai pcs adding dari baris saat ini dan menambahkannya ke totalPcs
                let pcsAdding = parseFloat($(this).find('td:eq(8)').text()) || 0;
                totalPcs += pcsAdding;
            });
            // Menampilkan total pcs di input #total_pcs
            $('#total_pcs').val(totalPcs);
        }
        // Hitung Susut Depan
        function hitungSusutDepan() {
            let beratAdjustmentSD = 0;

            // Iterasi melalui setiap baris tabel
            $('#dataTable tbody tr').each(function() {
                let kategoriSusut = $(this).find('td:eq(6)').text();
                let beratAdjustment = parseFloat($(this).find('td:eq(7)').text());
                let beratAdding = parseFloat($(this).find('td:eq(3)').text());

                // Pastikan beratGrading dan beratAdding adalah angka yang valid
                if (!isNaN(beratAdjustment) && !isNaN(beratAdding)) {
                    // Menambahkan berat grading jika kategori susut adalah "SD"
                    if (kategoriSusut === "SD") {
                        beratAdjustmentSD += beratAdjustment;
                    }
                }
            });

            // Menghitung berat adjustment per adding untuk kategori SD
            let totalBeratAdding = parseFloat($('#berat_adding').val()); // Menggunakan berat adding dari input form
            // console.log("Berat Adding = " + totalBeratAdding);
            let susutDepan = totalBeratAdding !== 0 ? beratAdjustmentSD / totalBeratAdding : 0;

            $('#dataTable tbody tr').each(function() {
                let currentKategoriSusut = $(this).find('td:eq(6)').text();
                if (currentKategoriSusut === "SD") {
                    let row = $(this);
                    row.find('td:eq(14)').text(susutDepan.toFixed(4)); // Update nilai di tabel
                } else {
                    let row = $(this);
                    row.find('td:eq(14)').text(susutDepan.toFixed(4)); // Update nilai di tabel
                }
            });

            console.log("Susut Depan = " + susutDepan);
            $('#susut_depan').val(susutDepan.toFixed(4));
        }
        // Hitung Susut Belakang
        function hitungSusutBelakang() {
            let totalBeratAdjustment = 0;
            let totalBeratAdding = parseFloat($('#berat_adding').val()); // Mengambil berat adding dari input form

            // Menghitung total berat adjustment dari setiap baris tabel
            $('#dataTable tbody tr').each(function() {
                let beratAdjustment = parseFloat($(this).find('td:eq(7)').text());

                // Pastikan beratAdjustment adalah angka yang valid
                if (!isNaN(beratAdjustment)) {
                    totalBeratAdjustment += beratAdjustment;
                }
            });

            // Menghindari pembagian oleh nol
            if (totalBeratAdding !== 0) {
                let susutBelakang = totalBeratAdjustment / totalBeratAdding;

                // Memperbarui tabel dengan hasil perhitungan
                $('#dataTable tbody tr').each(function() {
                    $(this).find('td:eq(15)').text(susutBelakang.toFixed(
                        4)); // Kolom 30 untuk menampilkan hasil perhitungan
                });

                console.log("Susut Belakang = " + susutBelakang);
                $('#susut_belakang').val(susutBelakang.toFixed(4));
            }
        }
        // Hitung Kontribusi
        function hitungKontribusi() {
            // Inisialisasi variabel untuk menyimpan total berat grading dari seluruh tabel
            let totalBeratAdjustment = 0;
            // Inisialisasi variabel untuk menyimpan jumlah data berat grading yang valid
            let jumlahData = 0;

            // Iterasi melalui setiap baris tabel
            $('#dataTable tbody tr').each(function() {
                // Mendapatkan berat grading dari kolom yang sesuai
                let beratAdjustment = parseFloat($(this).find('td:eq(7)').text());

                // Pastikan beratAdjustment adalah angka yang valid
                if (!isNaN(beratAdjustment)) {
                    // Menambahkan berat grading ke total
                    totalBeratAdjustment += beratAdjustment;
                    // Menambah jumlah data berat grading yang valid
                    jumlahData++;
                }
            });

            // Menghindari pembagian oleh nol dan pastikan ada data berat grading yang valid
            if (totalBeratAdjustment !== 0 && jumlahData > 0) {
                // Iterasi melalui setiap baris tabel
                $('#dataTable tbody tr').each(function() {
                    // Mendapatkan berat grading dari kolom yang sesuai
                    let beratAdjustment = parseFloat($(this).find('td:eq(7)').text());
                    // Menghitung presentase berat grading berdasarkan total berat grading
                    let kontribusi = (beratAdjustment / totalBeratAdjustment) * 100;

                    // Menampilkan hasil perhitungan pada kolom yang sesuai
                    $(this).find('td:eq(12)').text(Math.round(kontribusi) + '%');
                    console.log("Kontribusi = " + Math.round(kontribusi) + '%');
                    // $('#kontribusi').val(kontribusi);
                });
            } else {
                // Jika tidak ada data berat grading yang valid atau total berat grading adalah nol, set semua nilai pada kolom hasil perhitungan ke 0
                $('#dataTable tbody tr').each(function() {
                    $(this).find('td:eq(12)').text('0%');
                });
            }
        }

        // Form VALIDASI
        function validateForm() {
            // Mendefinisikan variabel untuk menyimpan kolom yang belum diisi
            let emptyFields = [];

            // Mendapatkan nilai dari semua input
            let idBoxGradingHalus = $('#id_box_grading_halus').val();
            let nomorAdjustment = $('#nomor_adjustment').val();
            let nomorBatch = $('#nomor_batch').val();
            let beratAdding = $('#berat_adding').val();
            let pcsAdding = $('#pcs_adding').val();
            let jenisAdjustment = $('#jenis_adjustment').val();
            let kategoriSusut = $('#kategori_susut').val();
            let beratAdjustment = $('#berat_adjustment').val();
            let pcsAdjustment = $('#pcs_adjustment').val();
            let keterangan = $('#keterangan').val();
            let modal = $('#modal').val();
            let totalModal = $('#total_modal').val();
            let user_created = $('#user_created').val();

            // Memeriksa setiap input, dan jika kosong, tambahkan ke daftar kolom yang belum diisi
            if (!idBoxGradingHalus) emptyFields.push('ID Box Grading Halus');
            if (!nomorAdjustment) emptyFields.push('Nomor Adjustment');
            if (!nomorBatch) emptyFields.push('Nomor Batch');
            if (!beratAdding) emptyFields.push('Berat Adding');
            if (!pcsAdding) emptyFields.push('Pcs Adding');
            if (!modal) emptyFields.push('Modal');
            if (!totalModal) emptyFields.push('Total Modal');
            if (!jenisAdjustment) emptyFields.push('Jenis Adjustment');
            if (!kategoriSusut) emptyFields.push('Kategori Susut');
            if (!beratAdjustment) emptyFields.push('Berat Adjustment');
            if (!pcsAdjustment) emptyFields.push('Pcs Adjustment');
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

        let dataArray = [];
        // Manambahkan Data Ke Table
        function addRow() {
            if (validateForm()) {
                // Mendapatkan nilai dari semua input
                let idBoxGradingHalus = $('#id_box_grading_halus').val();
                let nomorAdjustment = $('#nomor_adjustment').val();
                let nomorBatch = $('#nomor_batch').val();
                let beratAdding = $('#berat_adding').val();
                let pcsAdding = $('#pcs_adding').val();
                let jenisAdjustment = $('#jenis_adjustment').val();
                let kategoriSusut = $('#kategori_susut').val();
                let beratAdjustment = $('#berat_adjustment').val();
                let pcsAdjustment = $('#pcs_adjustment').val();
                let keterangan = $('#keterangan').val();
                let modal = $('#modal').val();
                let user_created = $('#user_created').val();
                let totalModal = $('#total_modal').val();
                let hargaEstimasi = $('#harga_estimasi').val();
                let pengurangan_harga = $('#pengurangan_harga').val();
                let susut_depan = $('#susut_depan').val();
                let susut_belakang = $('#susut_belakang').val();

                // Disable Nomor Adjustment
                $('#nomor_adjustment').prop('disabled', true);
                // Harga Estimasi
                // Mengecek dan menetapkan nilai yang akan dimasukkan ke dalam dataArray
                let hargaEstimasiToSend = parseFloat(hargaEstimasi); // Mengonversi hargaEstimasi menjadi angka
                console.log("Harga Estimasi Lama= " + hargaEstimasiToSend);
                if (pengurangan_harga === '' || pengurangan_harga === null || pengurangan_harga == 0) {
                    hargaEstimasiToSend = parseFloat(
                        hargaEstimasi); // Jika tidak ada pengurangan harga, tetap gunakan hargaEstimasi asli
                } else {
                    let modalNumber = parseFloat(modal); // Mengonversi modal menjadi angka
                    hargaEstimasiToSend = modalNumber - (modalNumber * pengurangan_harga);
                }

                hargaEstimasiToSend = hargaEstimasiToSend.toFixed(4);


                console.log("Harga Estimasi Baru= " + hargaEstimasiToSend)

                // Membuat baris HTML baru untuk ditambahkan ke tabel
                let newRow = `<tr>` +
                    `<td class='text-center'>${idBoxGradingHalus}</td>` +
                    `<td class='text-center'>${nomorAdjustment}</td>` +
                    `<td class='text-center'>${nomorBatch}</td>` +
                    `<td class='text-center'>${beratAdding}</td>` +
                    `<td class='text-center'>${pcsAdding}</td>` +
                    `<td class='text-center'>${jenisAdjustment}</td>` +
                    `<td class='text-center'>${kategoriSusut}</td>` +
                    `<td class='text-center'>${beratAdjustment}</td>` +
                    `<td class='text-center'>${pcsAdjustment}</td>` +
                    `<td class='text-center'>${keterangan}</td>` +
                    `<td class='text-center'>${modal}</td>` +
                    `<td class='text-center'>${totalModal}</td>` +
                    `<td class='text-center'>${kontribusi}</td>` +
                    `<td class='text-center'>${hargaEstimasiToSend}</td>` +
                    `<td class='text-center'>${susut_depan}</td>` +
                    `<td class='text-center'>${susut_belakang}</td>` +
                    `<td class='text-center'><button type='button' class='btn btn-danger' onclick='deleteRow(this)'>Delete</button></td>` +
                    `</tr>`;

                // Menambahkan baris baru ke dalam tabel
                $('#dataTable tbody').append(newRow);

                dataArray.push({
                    id_box_grading_halus: idBoxGradingHalus,
                    nomor_adjustment: nomorAdjustment,
                    nomor_batch: nomorBatch,
                    berat_adding: beratAdding,
                    pcs_adding: pcsAdding,
                    jenis_adjustment: jenisAdjustment,
                    kategori_susut: kategoriSusut,
                    berat_adjustment: beratAdjustment,
                    pcs_adjustment: pcsAdjustment,
                    keterangan: keterangan,
                    modal: modal,
                    user_created: user_created,
                    total_modal: totalModal,
                    harga_estimasi: hargaEstimasiToSend,
                });

                // Mengosongkan nilai input formulir
                $('#jenis_adjustment').val(null).trigger('change');
                $('#jenis_adjustment').val('');
                $('#berat_adjustment').val('');
                $('#pcs_adjustment').val('');
                $('#keterangan').val('');

                // Memanggil fungsi penghitungan
                calculateTotalBerat();
                calculateTotalPcs();
                hitungSusutDepan();
                hitungSusutBelakang();
                hitungKontribusi();
            }
        }

        function deleteRow(btn) {
            // Menghapus baris dari tabel
            $(btn).closest('tr').remove();

            $('#nomor_adjustment').prop('disabled', false).trigger('change');
            calculateTotalBerat();
            calculateTotalPcs();
            hitungSusutDepan();
            hitungSusutBelakang();
            hitungKontribusi();
        }

        function simpanData() {
            console.log("Isi data=",
                dataArray);
            // Mengirim data ke server menggunakan AJAX
            $.ajax({
                url: '{{ route('GradingHalusAdjustmentInput.store') }}',
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
                    let tableDataArray = [];

                    // Iterasi melalui setiap baris tabel
                    $('#dataTable tbody tr').each(function() {
                        // Mengambil nilai susut_depan dan susut_belakang dari tiap baris
                        let susutDepan = parseFloat($(this).find('td:eq(14)').text());
                        let susutBelakang = parseFloat($(this).find('td:eq(15)').text());
                        let kontribusi = parseFloat($(this).find('td:eq(12)').text());

                        // Debugging: Cetak nilai susut_depan, susut_belakang, dan kontribusi ke konsol
                        console.log("Nilai kontribusi:", kontribusi);
                        console.log("Nilai Susut Depan:", susutDepan);
                        console.log("Nilai Susut Belakang:", susutBelakang);

                        // Menambahkan data ke dalam array
                        tableDataArray.push({
                            kontribusi: kontribusi,
                            susut_depan: susutDepan,
                            susut_belakang: susutBelakang
                        });
                    });

                    // Mengirim dataArray dan data tabel ke server sebagai string JSON
                    let postData = {
                        dataArray: JSON.stringify(dataArray), // Mengirim dataArray sebagai string JSON
                        tableDataArray: JSON.stringify(tableDataArray),

                        // susutDepan: $('#susut_depan').val(),
                        // susutBelakang: $('#susut_belakang').val(),
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
