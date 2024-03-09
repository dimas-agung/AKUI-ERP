@extends('layouts.master1')
@section('menu')
    Grading Kasar
@endsection
@section('title')
    Grading Kasar Hasil
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card mt-2 border border-primary border-3">
            <div class="card-header">
                <div class="d-flex align-items-center mb-3">
                    <h4 class="card-title">Input Grading Kasar hasil</h4>
                </div>
                <hr>
                <form method="POST" class="row g-3" id="myForm">
                    @csrf
                    <div class="col-md-6">
                        <label for="basic-usage" class="form-label">Nomor Grading</label>
                        <select class="select2 form-select" style="width: 100%;" tabindex="-1" aria-hidden="true"
                            name="nomor_grading" id="nomor_grading" placeholder="Pilih Nomor Grading">
                            <option value="">Pilih Nomor Grading</option>
                            @foreach ($GradingKasarInput as $GradingKI)
                                <option value="{{ $GradingKI->nomor_grading }}">
                                    {{ $GradingKI->nomor_grading }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="id_box_raw_material" class="form-label">ID Box Raw Material</label>
                        <input type="text" class="form-control" id="id_box_raw_material" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="nomor_batch" class="form-label">Nomor Batch</label>
                        <input type="text" class="form-control" id="nomor_batch" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="nomor_nota_internal" class="form-label">Nomor Nota Internal</label>
                        <input type="text" class="form-control" id="nomor_nota_internal" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="nama_supplier" class="form-label">Nama Supplier</label>
                        <input type="text" class="form-control" id="nama_supplier" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="jenis_raw_material" class="form-label">Jenis Adding</label>
                        <input type="text" class="form-control" id="jenis_raw_material" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="berat_adding" class="form-label">Berat Adding</label>
                        <input type="text" class="form-control" id="berat_adding" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="sisa_berat_adding" class="form-label">Sisa Berat Adding</label>
                        <input type="text" class="form-control" id="sisa_berat_adding" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="kadar_air" class="form-label">Kadar Air</label>
                        <input type="text" class="form-control" id="kadar_air" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="modal" class="form-label">Modal</label>
                        <input type="text" class="form-control" id="modal" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="total_modal" class="form-label">Total Modal</label>
                        <input type="text" class="form-control" id="total_modal" readonly>
                    </div>
                    <div class="col-md-flex">
                        <hr>
                    </div>
                    <div class="col-md-3">
                        <label for="basic-usage" class="form-label">Pilih Jenis Grading :</label>
                        <select class="select2 form-select" style="width: 100%;" tabindex="-1" aria-hidden="true"
                            name="jenis_grading" id="jenis_grading" placeholder="Pilih jenis grading">
                            <option value="">Pilih Jenis Grading</option>
                            @foreach ($MasterJenisGradingKasar as $MasterJGK)
                                <option
                                    value="{{ $MasterJGK->nama }},{{ $MasterJGK->harga_estimasi }},{{ $MasterJGK->presentase_pengurangan_harga }}">
                                    {{ $MasterJGK->nama }}
                                </option>
                            @endforeach
                        </select>
                        <input type="hidden" id="harga_estimasi" name="harga_estimasi">
                        <input type="hidden" id="presetanse_pengurangan_harga" name="presetanse_pengurangan_harga">
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
                        <label for="user_created" class="form-label">NIP Admin</label>
                        <input type="text" class="form-control" id="user_created">
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea class="form-control" id="keterangan" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="total_susut" class="form-label">Total Susut</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="total_susut" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="total_berat" class="form-label">Total Berat</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="total_berat" readonly>
                    </div>
                    <div class="col-md-4">
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

    {{-- table --}}
    <div class="col-md-12">
        <div class="card mt-2 border border-primary border-3">
            <div class="card-header">
                <div class="card-body" style="overflow: scroll" content="{{ csrf_token() }}">
                    <table class="table" id="dataTable">
                        <thead>
                            <tr>
                                {{-- <th scope="col" class="text-center">No</th> --}}
                                <th scope="col" class="text-center">Nomor Grading</th>
                                <th scope="col" class="text-center">ID Box Raw Material</th>
                                <th scope="col" class="text-center">ID Box Grading Kasar</th>
                                <th scope="col" class="text-center">Nomor Batch</th>
                                <th scope="col" class="text-center">Nama Supplier</th>
                                <th scope="col" class="text-center">Nomor Nota Internal</th>
                                <th scope="col" class="text-center">Jenis Raw Material</th>
                                <th scope="col" class="text-center">Berat</th>
                                <th scope="col" class="text-center">Kadar Air</th>
                                <th scope="col" class="text-center">Jenis Grading</th>
                                <th scope="col" class="text-center">Berat Grading</th>
                                <th scope="col" class="text-center">Pcs Grading</th>
                                <th scope="col" class="text-center">Susut</th>
                                <th scope="col" class="text-center">Modal</th>
                                <th scope="col" class="text-center">Total Modal</th>
                                {{-- <th scope="col" class="text-center">Biaya Produksi</th>
                                <th scope="col" class="text-center">Harga Estimasi</th>
                                <th scope="col" class="text-center">Total Harga</th>
                                <th scope="col" class="text-center">Nilai Laba Rugi</th>
                                <th scope="col" class="text-center">Nilai dari total keuntungan</th>
                                <th scope="col" class="text-center">Nilai setelah dikurangi keuntungan</th>
                                <th scope="col" class="text-center">Prosentase Harga dan Gramasi</th>
                                <th scope="col" class="text-center">Selisih Laba Rugi dalam kg</th>
                                <th scope="col" class="text-center">Selisih Laba Rugi per gram</th>
                                <th scope="col" class="text-center">HPP</th>
                                <th scope="col" class="text-center">Total HPP</th> --}}
                                <th scope="col" class="text-center">NIP Admin</th>
                                <th scope="col" class="text-center">Keterangan</th>
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
        var sisaBeratAddding = 0;
        $(document).ready(function() {
            let beratAddingAwal; // Variabel untuk menyimpan nilai awal berat adding
            // var sisaBeratAddding = parseFloat($('#sisa_berat_adding').val());
            // Event untuk mengambil nilai awal berat adding saat memilih nomor grading
            $('#nomor_grading').on('change', function() {
                $('#berat_grading').val('');
                $('#pcs_grading').val('');
                let selectedNomorGrading = $(this).val();
                $.ajax({
                    url: `{{ route('GradingKasarHasil.set') }}`,
                    method: 'GET',
                    data: {
                        nomor_grading: selectedNomorGrading
                    },
                    success: function(response) {
                        console.log(response);
                        $('#id_box_raw_material').val(response.id_box);
                        $('#nomor_batch').val(response.nomor_batch);
                        $('#nomor_nota_internal').val(response.nomor_nota_internal);
                        $('#nama_supplier').val(response.nama_supplier);
                        $('#jenis_raw_material').val(response.jenis_raw_material);
                        $('#berat_adding').val(response.berat);
                        $('#sisa_berat_adding').val(response.berat);
                        $('#kadar_air').val(response.kadar_air);
                        $('#modal').val(response.modal);
                        $('#total_modal').val(response.total_modal);
                        // Menyimpan nilai awal berat adding
                        sisaBeratAddding = response.berat;
                        beratAddingAwal = parseFloat(response.berat);
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            });

            // Event untuk menghitung stok pada perubahan nilai berat grading
            $('#berat_grading').on('change', function() {
                let beratGrading = parseFloat($(this).val());
                let beratAddingAwal = parseFloat($('#berat_adding').val());
                console.log(sisaBeratAddding);
                if (!isNaN(beratGrading)) {
                    if (beratGrading > sisaBeratAddding) {
                        // Menampilkan alert jika berat grading melebihi berat awal
                        Swal.fire({
                            title: 'Warning!',
                            text: "Berat grading tidak boleh melebihi berat adding.",
                            icon: 'warning'
                        });
                        // $(this).val(''); // Mengosongkan nilai input
                        return;
                    }
                    let sisaBerat = sisaBeratAddding - beratGrading;
                    if (sisaBerat < 0) {
                        sisaBerat = 0; // Menghindari stok negatif
                    }
                    // Mengatur nilai sisa berat pada #berat_adding
                    $('#sisa_berat_adding').val(sisaBerat); // membulatkan ke 2 desimal
                } else {
                    // if ($('#sisa_berat_adding').val()) {

                    $('#sisa_berat_adding').val(sisaBeratAddding);
                    // } else {
                    //     $('#sisa_berat_adding').val(beratAddingAwal);

                    // }

                    // Jika #berat_grading kosong, kembalikan ke nilai awal

                }
            });

            // Event untuk mengembalikan nilai berat adding ke nilai awal jika nilai berat grading dihapus
            // $('#berat_grading').on('change', function() {
            //     if ($(this).val() === '') {
            //         $('#sisa_berat_adding').val(beratAddingAwal);
            //         // Mengembalikan nilai berat adding ke nilai awalnya
            //     }
            // });
            $('#berat_grading').on('change', function() {
                if ($(this).val() === '') {
                    // let beratAddingAwal = parseFloat($('#sisa_berat_adding').val());
                    $('#sisa_berat_adding').val(sisaBerat);
                    // Mengembalikan nilai berat adding ke nilai awalnya
                }
            });
        });

        // jenis grading
        $(document).ready(function() {
            $("#jenis_grading").change(function() {
                var selectedOption = $(this).find("option:selected");
                var values = selectedOption.val().split(',');

                console.log("data = " + values);
                // Ambil nilai sesuai kebutuhan Anda
                var nama = values[0];
                var hargaEstimasi = values[1];
                var presentasePenguranganHarga = values[2];
                $('#harga_estimasi').val(hargaEstimasi);
                $('#presetanse_pengurangan_harga').val(presentasePenguranganHarga);
                // Log untuk memeriksa nilai
                console.log("Nama: " + nama);
                console.log("Harga Estimasi: " + hargaEstimasi);
                console.log("Prosentase Pengurangan Harga: " + presentasePenguranganHarga);
            });
        });
        // hitung nilai berat
        function hitungNilaiBerat() {
            let totalBerat
        }

        // function hitungNilaiSusut() {
        //     let totalBeratGradingtest = parseFloat($('#total_berat').val());

        //     if (isNaN(totalBeratGradingtest)) {
        //         totalBeratGradingtest = parseFloat($('#berat_grading').val()) || 0;
        //     }

        //     let beratAdding = parseFloat($('#berat_adding').val());

        //     if (!isNaN(totalBeratGradingtest) && !isNaN(beratAdding) && beratAdding !== 0) {
        //         let nilaiSusut = (1 - totalBeratGradingtest / beratAdding);
        //         console.log("totalTest = " + totalBeratGradingtest);
        //         console.log("Berat Adding = " + beratAdding);
        //         console.log("Susut = " + nilaiSusut);
        //         return nilaiSusut;
        //     } else {
        //         console.error('Input tidak valid untuk berat_grading atau berat');
        //         return null;
        //     }
        // }

        function hitungNilaiSusut() {
            let totalBeratGradingtest = parseFloat($('#total_berat').val());

            if (isNaN(totalBeratGradingtest)) {
                totalBeratGradingtest = parseFloat($('#berat_grading').val()) || 0;
            }

            let beratAdding = parseFloat($('#berat_adding').val());

            if (!isNaN(totalBeratGradingtest) && !isNaN(beratAdding)) {
                let nilaiSusut = (1 - totalBeratGradingtest / beratAdding);
                console.log("totalTest = " + totalBeratGradingtest);
                console.log("Berat Adding = " + beratAdding);
                console.log("Susut = " + nilaiSusut);
                return nilaiSusut;
            } else {
                console.error('Input tidak valid untuk berat_grading atau berat');
                return null;
            }
        }



        // generate id box grading kasar
        function generateIdBoxGradingKasar() {
            const nomorGrading = $('#nomor_grading').val();
            const jenisGrading = $('#jenis_grading').val();

            // Memisahkan nilai-nilai jenisGrading menjadi array
            const jenisGradingArray = jenisGrading.split(',');

            // Mengambil elemen pertama dari array jenisGradingArray
            const jenisGradingPertama = jenisGradingArray[0];

            // Menggabungkan nilai-nilai tersebut untuk membentuk nomor grading
            const id_box_grading_kasar = `${nomorGrading}_${jenisGradingPertama}`;

            // Menampilkan hasil di konsol (opsional)
            console.log("Id Box Grading Kasar = " + id_box_grading_kasar);

            return id_box_grading_kasar;
        }

        function validateForm() {
            // Mendefinisikan variabel untuk menyimpan kolom yang belum diisi
            let emptyFields = [];

            // Mendapatkan nilai dari semua input
            // Mengambil nilai dari input
            let nomor_grading = $('#nomor_grading').val();
            let nomor_batch = $('#nomor_batch').val();
            let id_box_raw_material = $('#id_box_raw_material').val();
            let nomor_nota_internal = $('#nomor_nota_internal').val();
            let nama_supplier = $('#nama_supplier').val();
            let jenis_raw_material = $('#jenis_raw_material').val();
            let berat = $('#berat_adding').val();
            let kadar_air = $('#kadar_air').val();
            let modal = $('#modal').val();
            let total_modal = $('#total_modal').val();
            let jenis_grading = $('#jenis_grading').val().split(',');
            let harga_estimasi = $('#harga_estimasi').val();
            let presetanse_pengurangan_harga = $('#presetanse_pengurangan_harga').val();
            let berat_grading = $('#berat_grading').val();
            let pcs_grading = $('#pcs_grading').val();
            let keterangan = $('#keterangan').val();
            let total_susut = $('#total_susut').val();
            let total_berat = $('#total_berat').val();
            let total_pcs = $('#total_pcs').val();
            let user_created = $('#user_created').val();
            let sisa_berat_adding = $('#sisa_berat_adding').val();

            // Memeriksa setiap input, dan jika kosong, tambahkan ke daftar kolom yang belum diisi
            if (!nomor_grading) emptyFields.push('Nomor Grading');
            if (!nomor_batch) emptyFields.push('Nomor Batch');
            if (!id_box_raw_material) emptyFields.push('ID Box Raw Material');
            if (!nomor_nota_internal) emptyFields.push('Nomor Nota Internal');
            if (!nama_supplier) emptyFields.push('Nama Supplier');
            if (!jenis_raw_material) emptyFields.push('Jenis Adding');
            if (!berat) emptyFields.push('Berat Adding');
            if (!kadar_air) emptyFields.push('Kadar Air');
            if (!modal) emptyFields.push('Modal');
            if (!total_modal) emptyFields.push('Total Modal');
            if (!jenis_grading[0]) emptyFields.push('Jenis Grading');
            if (!berat_grading) emptyFields.push('Berat Grading');
            if (!pcs_grading) emptyFields.push('Pcs Grading');
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

        function addRow() {
            if (validateForm()) {
                // Mengambil nilai dari input
                let nomor_grading = $('#nomor_grading').val();
                let nomor_batch = $('#nomor_batch').val();
                let id_box_raw_material = $('#id_box_raw_material').val();
                let nomor_nota_internal = $('#nomor_nota_internal').val();
                let nama_supplier = $('#nama_supplier').val();
                let jenis_raw_material = $('#jenis_raw_material').val();
                let berat = $('#berat_adding').val();
                let kadar_air = $('#kadar_air').val();
                let modal = $('#modal').val();
                let total_modal = $('#total_modal').val();
                let jenis_grading = $('#jenis_grading').val().split(',');
                let harga_estimasi = $('#harga_estimasi').val();
                let presetanse_pengurangan_harga = $('#presetanse_pengurangan_harga').val();
                let berat_grading = $('#berat_grading').val();
                let pcs_grading = $('#pcs_grading').val();
                let keterangan = $('#keterangan').val();
                let total_susut = $('#total_susut').val();
                let total_berat = $('#total_berat').val();
                let total_pcs = $('#total_pcs').val();
                let user_created = $('#user_created').val();
                let sisa_berat_adding = $('#sisa_berat_adding').val();
                sisaBeratAddding = sisa_berat_adding

                $('#nomor_grading').prop('disabled', true);

                let id_box_grading_kasar = generateIdBoxGradingKasar();
                let biaya_produksi = 0;
                console.log("Harga Estimasi = " + harga_estimasi);

                // TOTAL Berat
                let totalBeratGrading = parseFloat($('#berat_grading').val()) || 0;
                $('#dataTable tbody tr').each(function() {
                    let beratGradingValue = parseFloat($(this).find('td:eq(10)').text()) || 0;

                    totalBeratGrading += beratGradingValue;
                });
                // console.log("Total Berat = " + totalBeratGrading);
                $('#total_berat').val(totalBeratGrading);
                // Total Pcs
                let totalPcsGrading = parseFloat($('#pcs_grading').val()) || 0;
                // Loop melalui setiap baris tabel untuk menghitung total pcs_grading
                $('#dataTable tbody tr').each(function() {
                    // Ambil nilai dari kolom pcs_grading dalam setiap baris
                    let pcsGradingValue = parseFloat($(this).find('td:eq(11)').text()) || 0;

                    // Tambahkan nilai pcs_grading ke totalPcsGrading
                    totalPcsGrading += pcsGradingValue;
                });
                // console.log("Total Pcs = " + totalPcsGrading);
                $('#total_pcs').val(totalPcsGrading);

                let susut = hitungNilaiSusut() || 0; // Nilai susut diambil dari fungsi hitungNilaiSusut
                console.log("Susut = " + susut);

                $('#dataTable tbody tr').each(function() {
                    // Ganti koma dengan titik sebagai tanda desimal
                    let totalSusutValue = parseFloat($(this).find('td:eq(12)').text().replace(',', '.')) || 0;
                    console.log('TotalSusut = ' + totalSusutValue);

                    susut += totalSusutValue;

                    // Update nilai susut pada kolom susut di setiap baris tabel
                    $(this).find('td:eq(12)').text(susut.toFixed(4));
                });
                console.log('Total Susut= ' + susut);
                $('#total_susut').val(susut.toFixed(4));

                //
                let newRow = `<tr>` +
                    `<td class="text-center">${nomor_grading}</td>` +
                    `<td class="text-center">${id_box_raw_material}</td>` +
                    `<td class="text-center">${id_box_grading_kasar}</td>` +
                    `<td class="text-center">${nomor_batch}</td>` +
                    `<td class="text-center">${nama_supplier}</td>` +
                    `<td class="text-center">${nomor_nota_internal}</td>` +
                    `<td class="text-center">${jenis_raw_material}</td>` +
                    `<td class="text-center">${berat}</td>` +
                    `<td class="text-center">${kadar_air}</td>` +
                    `<td class="text-center">${jenis_grading[0]}</td>` +
                    `<td class="text-center">${berat_grading}</td>` +
                    `<td class="text-center">${pcs_grading}</td>` +
                    `<td class="text-center">${susut.toFixed(4)}</td>` +
                    `<td class="text-center">${modal}</td>` +
                    `<td class="text-center">${total_modal}</td>` +
                    `<td class="text-center">${user_created} </td>` +
                    `<td class="text-center">${keterangan}</td>` +
                    `<td class="text-center"><button class="btn btn-danger" onclick="hapusBaris(this)">Delete</button></td>` +
                    `</tr>`;
                $('#dataTable tbody').append(newRow);

                // Mengecek dan menetapkan nilai yang akan dimasukkan ke dalam dataArray
                let hargaEstimasiToSend = harga_estimasi;
                console.log("Harga Estimasi Lama= " + hargaEstimasiToSend);
                if (presetanse_pengurangan_harga === '' || presetanse_pengurangan_harga === null ||
                    presetanse_pengurangan_harga == 0) {
                    // console.log(presetanse_pengurangan_harga);
                    hargaEstimasiToSend = harga_estimasi;
                } else {
                    hargaEstimasiToSend = modal - (modal * presetanse_pengurangan_harga);
                }

                console.log("Harga Estimasi Baru= " + hargaEstimasiToSend);

                dataArray.push({
                    // doc_no: doc_no,
                    nomor_grading: nomor_grading,
                    id_box_raw_material: id_box_raw_material,
                    id_box_grading_kasar: id_box_grading_kasar,
                    nomor_batch: nomor_batch,
                    nama_supplier: nama_supplier,
                    nomor_nota_internal: nomor_nota_internal,
                    jenis_raw_material: jenis_raw_material,
                    berat: berat,
                    kadar_air: kadar_air,
                    jenis_grading: jenis_grading,
                    berat_grading: berat_grading,
                    pcs_grading: pcs_grading,
                    susut: total_susut,
                    // susut: susut,
                    modal: modal,
                    total_modal: total_modal,
                    biaya_produksi: 0,
                    harga_estimasi: hargaEstimasiToSend,
                    total_harga: 0,
                    nilai_laba_rugi: 0,
                    nilai_prosentase_total_keuntungan: 0,
                    nilai_dikurangi_keuntungan: 0,
                    prosentase_harga_gramasi: 0,
                    selisih_laba_rugi_kg: 0,
                    selisih_laba_rugi_gram: 0,
                    hpp: 0,
                    total_hpp: 0,
                    keterangan: keterangan,
                    user_created: user_created,
                    // user_updated: user_updated
                });
                // Membersihkan nilai input setelah ditambahkan
                // $('#nomor_grading').val();
                // $('#nomor_batch').val();
                // $('#id_box_raw_material').val();
                // $('#nomor_nota_internal').val();
                // $('#nama_supplier').val();
                // $('#jenis_adding').val();
                // $('#berat_adding').val();
                // $('#kadar_air').val();
                // $('#modal').val();
                // $('#total_modal').val();
                $('#jenis_grading').val($('#jenis_grading option:first').val()).trigger('change');
                // $('#jenis').val('');
                // $('#harga_estimasi').val('');
                // $('#presetanse_pengurangan_harga').val('');
                $('#berat_grading').val('');
                $('#pcs_grading').val('');
                $('#keterangan').val('');
                $('#user_created').val('');
            }
        }



        //
        function hapusBaris(button) {
            // Dapatkan elemen baris terkait dengan tombol delete yang diklik
            let row = $(button).closest('tr');

            // Hapus baris dari dataArray berdasarkan indeks baris di tabel
            let rowIndex = row.index();
            dataArray.splice(rowIndex, 1);

            // Hapus baris dari tabel
            row.remove();
            // Kurangkan nilai dari total_pcs dan total_berat
            hitungNilaiSusut();
            // Mengaktifkan kembali select2 pada elemen #nomor_grading
            $('#nomor_grading').prop('disabled', false).trigger('change');
            // Mengaktifkan dan men-trigger change
            // Total Berat
            let totalBeratGrading = 0;
            $('#dataTable tbody tr').each(function() {
                let beratGradingValue = parseFloat($(this).find('td:eq(10)')
                    .text()); // Ganti angka 10 dengan indeks kolom berat_kirim dalam tabel
                if (!isNaN(beratGradingValue)) {
                    totalBeratGrading += beratGradingValue;
                }
            });
            $('#total_berat').val(totalBeratGrading);
            // Total Pcs
            let totalPcsGrading = 0;
            // Loop melalui setiap baris tabel untuk menghitung total pcs_grading
            $('#dataTable tbody tr').each(function() {
                // Ambil nilai dari kolom pcs_grading dalam setiap baris
                let pcsGradingValue = parseFloat($(this).find('td:eq(11)').text()) || 0;
                totalPcsGrading += pcsGradingValue;
            });
            $('#total_pcs').val(totalPcsGrading);

        }

        function getArray() {
            // Menampilkan array di konsol untuk tujuan debugging
            console.log(dataArray);
        }

        function simpanData() {
            console.log(dataArray);
            // Cek apakah data kosong
            if (dataArray.length === 0) {
                // Menampilkan SweetAlert untuk pesan error
                Swal.fire({
                    icon: 'error',
                    title: 'Astagfirullah',
                    text: 'Data dalam tabel masih kosong. Silakan tambahkan data terlebih dahulu.'
                });
                return; // Menghentikan eksekusi fungsi jika data kosong
            }
            // Mengirim data ke server menggunakan AJAX
            $.ajax({
                url: `{{ route('GradingKasarHasil.simpanData') }}`,
                method: 'POST',
                data: {
                    data: JSON.stringify(dataArray),
                    total_susut: $('#total_susut').val(),
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                beforeSend: function() {
                    // Menampilkan SweetAlert sebagai indikator loading sebelum permintaan dikirimkan
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
                    console.log('Data sent successfully:', response);

                    // Menampilkan SweetAlert untuk pesan sukses
                    Swal.fire({
                        icon: 'success',
                        title: 'Alhamdulillah',
                        text: 'Data berhasil dikirim.'
                    });

                    // Redirect atau lakukan tindakan lain setelah berhasil
                    window.location.href = `{{ route('GradingKasarHasil.index') }}`;
                },
                error: function(error) {
                    console.error('Error sending data:', error);

                    // Menampilkan SweetAlert untuk pesan error
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan saat mengirim data. Silakan coba lagi.'
                    });
                },
                complete: function() {
                    // Menutup SweetAlert setelah permintaan selesai, terlepas dari berhasil atau gagal
                    Swal.close();
                }
            });
        }
    </script>
@endsection
