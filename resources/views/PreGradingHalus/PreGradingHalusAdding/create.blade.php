@extends('layouts.master1')
@section('menu')
    Pre Grading Halus Adding
@endsection
@section('title')
    Pre Grading Halus Adding
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card mt-2 border border-primary border-3">
            <div class="card-header">
                <div class="d-flex align-items-center mb-3">
                    <h4 class="card-title">Pre Grading Halus Adding</h4>
                </div>
                <hr>
                <form method="POST" class="row g-3" id="myForm">
                    <div class="col-md-6">
                        <label for="basic-usage" class="form-label">Nomor Job</label>
                        <select class="select2 form-select" style="width: 100%;" name="nomor_job" id="nomor_job"
                            data-placeholder="Pilih Nomor Job">
                            <option value="">Pilih Nomor Job</option>
                            @foreach ($pre_grading_halus_stocks as $PreGHS)
                                @php
                                    // Menghitung sisa berat
                                    $sisaBerat = $PreGHS->berat_masuk - $PreGHS->berat_keluar;
                                @endphp
                                @if ($sisaBerat != 0)
                                    <option value="{{ $PreGHS->nomor_job }}">
                                        {{ $PreGHS->nomor_job }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Plant</label>
                        <select class="select2 form-select" style="width: 100%;" name="plant" id="plant"
                            data-placeholder="Pilih Plant">
                            <option value="">Pilih Plant</option>
                            @foreach ($perusahaan as $Perusahaans)
                                <option value="{{ $Perusahaans->plant }}">
                                    {{ $Perusahaans->plant }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="nomor_grading" class="form-label">Nomor Grading</label>
                        <input type="text" class="form-control" id="nomor_grading">
                    </div>
                    <div class="col-md-6">
                        <label for="nomor_nota_internal" class="form-label">Nomor Nota Internal</label>
                        <input type="text" class="form-control" id="nomor_nota_internal" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="id_box_grading_kasar" class="form-label">ID Box Grading Kasar</label>
                        <input type="text" class="form-control" id="id_box_grading_kasar" readonly>
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
                        <label for="nama_supplier" class="form-label">Nama Supplier</label>
                        <input type="text" class="form-control" id="nama_supplier" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="jenis_raw_material" class="form-label">Jenis Raw Material</label>
                        <input type="text" class="form-control" id="jenis_raw_material" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="jenis_kirim" class="form-label">Jenis Kirim</label>
                        <input type="text" class="form-control" id="jenis_kirim" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="tujuan_kirim" class="form-label">Tujuan Kirim</label>
                        <input type="text" class="form-control" id="tujuan_kirim" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="kadar_air" class="form-label">Kadar Air</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="kadar_air" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="berat_kirim" class="form-label">Berat Kirim</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="berat_kirim" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="pcs_kirim" class="form-label">Pcs Kirim</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="pcs_kirim" readonly>
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
                    <div class="col-md-3">
                        <label for="user_created" class="form-label">NIP Admin</label>
                        <input type="text" class="form-control" id="user_created" value="{{ auth()->user()->nip }}"
                            readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="susut" class="form-label">Total Box</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="total_box" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="susut" class="form-label">Total Berat</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="total_berat" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="susut" class="form-label">Total Pcs</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="total_pcs" readonly>
                    </div>
                    <div class="col-12">
                        <button type="button" class="btn btn-primary" id="tambah_data"
                            onclick="addRow()">Tambah</button>
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
                                {{-- <th scope="col" class="text-center">No</th> --}}
                                <th scope="col" class="text-center">Nomor Job</th>
                                <th scope="col" class="text-center">Nomor Grading</th>
                                <th scope="col" class="text-center">Nomor Nota Internal</th>
                                <th scope="col" class="text-center">ID Box Grading Kasar</th>
                                <th scope="col" class="text-center">ID Box Raw Material</th>
                                <th scope="col" class="text-center">Nomor Batch</th>
                                <th scope="col" class="text-center">Nama Supplier</th>
                                <th scope="col" class="text-center">Jenis Raw Material</th>
                                <th scope="col" class="text-center">Jenis Kirim</th>
                                <th scope="col" class="text-center">Tujuan Kirim</th>
                                <th scope="col" class="text-center">Berat Kirim</th>
                                <th scope="col" class="text-center">Pcs Kirim</th>
                                <th scope="col" class="text-center">Kadar Air</th>
                                <th scope="col" class="text-center">Modal</th>
                                <th scope="col" class="text-center">Total Modal</th>
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
        // Nomor JOB
        $(document).ready(function() {
            $('#nomor_job').on('change', function() {
                let selectedNomorJob = $(this).val();

                $.ajax({
                    url: `{{ route('PreGradingHalusAdding.set') }}`,
                    method: 'GET',
                    data: {
                        nomor_job: selectedNomorJob
                    },
                    success: function(response) {
                        console.log(response);

                        // Menghitung berat_masuk - berat_keluar
                        let sisaBerat = response.berat_masuk - response.berat_keluar;

                        // Pemeriksaan jika sisaBerat tidak sama dengan 0
                        if (sisaBerat !== 0) {
                            // Menyimpan sisaBerat dalam variabel baru
                            let sisaBeratFormatted = parseFloat(sisaBerat).toFixed(2);
                            // let sisaBeratFormatted = sisaBerat;

                            // Mengatur nilai Nomor Batch sesuai dengan respons dari server
                            // $('#nomor_grading').val(response.nomor_grading);
                            $('#nomor_nota_internal').val(response.nomor_nota_internal);
                            $('#id_box_grading_kasar').val(response.id_box_grading_kasar);
                            $('#id_box_raw_material').val(response.id_box_raw_material);
                            $('#nomor_batch').val(response.nomor_batch);
                            $('#nama_supplier').val(response.nama_supplier);
                            $('#jenis_raw_material').val(response.jenis_raw_material);
                            $('#jenis_kirim').val(response.jenis_kirim);
                            $('#tujuan_kirim').val(response.tujuan_kirim);
                            $('#modal').val(response.modal);
                            $('#total_modal').val(response.total_modal);
                            $('#kadar_air').val(response.kadar_air);
                            $('#pcs_kirim').val(response.pcs_masuk);
                            $('#berat_kirim').val(response.berat_masuk);
                            if (!isNaN(sisaBeratFormatted)) {
                                $('#sisa_berat').val(sisaBeratFormatted);
                            } else {
                                // console.error('Nilai sisa berat tidak valid.');
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Sisa Berat Nomor Job Ini 0. Pilih nomor job lain.',
                                });

                            }
                        } else {
                            // Jika sisaBerat === 0, hapus opsi dan reset nilai input
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Berat masuk - berat keluar sama dengan 0. Pilih nomor job lain.',
                            }).then(() => {
                                // Hapus opsi nomor job yang sudah dipilih
                                $('#nomor_job option[value="' + selectedNomorJob + '"]')
                                    .remove();
                                // Reset nilai input
                                $('#nomor_job').val('').trigger('change');
                            });
                        }
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            });
            // grading
            $('#plant').on('change', function() {
                const selectedPlant = $(this).val();
                if (selectedPlant) { // Check if selectedPlant is not empty
                    const nomorGrading = generateNomorGrading(selectedPlant);
                    $('#nomor_grading').val(nomorGrading);
                } else {
                    $('#nomor_grading').val(''); // Clear nomor_grading if plant is empty
                }
            });

            function generateNomorGrading(selectedPlant) {
                const now = new Date();
                const tahun = now.getFullYear().toString().substr(-2);
                const bulan = ('0' + (now.getMonth() + 1)).slice(-2);
                const tanggal = ('0' + now.getDate()).slice(-2);
                const jam = ('0' + now.getHours()).slice(-2);
                const menit = ('0' + now.getMinutes()).slice(-2);
                const detik = ('0' + now.getSeconds()).slice(-2);

                const nomorGrading = `NG_${tanggal}${bulan}${tahun}_${jam}${menit}${detik}_${selectedPlant}_UGH`;

                return nomorGrading;
            }


        });

        function calculateTotalBerat() {
            let totalBerat = 0;
            // Iterasi melalui setiap baris dalam tabel
            $('#dataTable tbody tr').each(function() {
                // Mendapatkan nilai berat adding dari baris saat ini dan menambahkannya ke totalBerat
                let beratAdding = parseFloat($(this).find('td:eq(10)').text()) || 0;
                totalBerat += beratAdding;
            });
            // Menampilkan total berat di input #total_berat
            $('#total_berat').val(totalBerat);
        }

        function calculateTotalPcs() {
            let totalPcs = 0;
            // Iterasi melalui setiap baris dalam tabel
            $('#dataTable tbody tr').each(function() {
                // Mendapatkan nilai pcs adding dari baris saat ini dan menambahkannya ke totalPcs
                let pcsAdding = parseFloat($(this).find('td:eq(11)').text()) || 0;
                totalPcs += pcsAdding;
            });
            // Menampilkan total pcs di input #total_pcs
            $('#total_pcs').val(totalPcs);
        }

        function calculateTotalBox() {
            let jumlahBaris = $('#dataTable tbody tr').length;
            // Tampilkan Jumlah Baris di Input dengan ID "total_box"
            $('#total_box').val(jumlahBaris);
        }

        function validateForm() {
            // Mendefinisikan variabel untuk menyimpan kolom yang belum diisi
            let emptyFields = [];

            // Mendapatkan nilai dari semua input
            let nomor_job = $('#nomor_job').val();
            let nomor_grading = $('#nomor_grading').val();
            let nomor_nota_internal = $('#nomor_nota_internal').val();
            let id_box_grading_kasar = $('#id_box_grading_kasar').val();
            let id_box_raw_material = $('#id_box_raw_material').val();
            let nomor_batch = $('#nomor_batch').val();
            let nama_supplier = $('#nama_supplier').val();
            let jenis_raw_material = $('#jenis_raw_material').val();
            let jenis_kirim = $('#jenis_kirim').val();
            let tujuan_kirim = $('#tujuan_kirim').val();
            let kadar_air = $('#kadar_air').val();
            let modal = $('#modal').val();
            let total_modal = $('#total_modal').val();
            let pcs_kirim = $('#pcs_kirim').val();
            let berat_kirim = $('#berat_kirim').val();
            let user_created = $('#user_created').val();

            // Memeriksa setiap input, dan jika kosong, tambahkan ke daftar kolom yang belum diisi
            if (!nomor_job) emptyFields.push('Nomor Job');
            if (!nomor_grading) emptyFields.push('Nomor Grading');
            if (!nomor_nota_internal) emptyFields.push('Nomor Nota Internal');
            if (!id_box_grading_kasar) emptyFields.push('Id Box Grading Kasar');
            if (!id_box_raw_material) emptyFields.push('Id Box Raw Material');
            if (!nomor_batch) emptyFields.push('Nomor Batch');
            if (!nama_supplier) emptyFields.push('Nama Supplier');
            if (!jenis_raw_material) emptyFields.push('Jenis Raw Material');
            if (!jenis_kirim) emptyFields.push('Jenis Kirim');
            if (!tujuan_kirim) emptyFields.push('Tujuan Kirim');
            if (!kadar_air) emptyFields.push('Kadar Air');
            if (!modal) emptyFields.push('Modal');
            if (!total_modal) emptyFields.push('Total Modal');
            if (!pcs_kirim) emptyFields.push('Pcs Kirim');
            if (!berat_kirim) emptyFields.push('Berat Kirim');
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
        // ADD ROW
        function addRow() {
            if (validateForm()) {
                let nomor_job = $('#nomor_job').val();

                // Periksa apakah nomor job sudah ada dalam tabel
                if ($('#dataTable tbody tr td:nth-child(1)').filter(function() {
                        return $(this).text() === nomor_job;
                    }).length > 0) {
                    // Nomor job sudah ada dalam tabel, tampilkan pesan dan hentikan proses
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Nomor job sudah ada dalam tabel.',
                    });
                    return;
                }
                // Hapus opsi nomor_job yang sudah dipilih dari dropdown
                $('#nomor_job option[value="' + nomor_job + '"]').remove();
                // Mengambil nilai dari input
                // let nomor_job = $('#nomor_job').val();
                let nomor_grading = $('#nomor_grading').val();
                let nomor_nota_internal = $('#nomor_nota_internal').val();
                let id_box_grading_kasar = $('#id_box_grading_kasar').val();
                let id_box_raw_material = $('#id_box_raw_material').val();
                // let nomor_bstb = $('#nomor_bstb').val();
                let nomor_batch = $('#nomor_batch').val();
                let nama_supplier = $('#nama_supplier').val();
                let jenis_raw_material = $('#jenis_raw_material').val();
                let jenis_kirim = $('#jenis_kirim').val();
                let tujuan_kirim = $('#tujuan_kirim').val();
                let modal = $('#modal').val();
                let total_modal = $('#total_modal').val();
                let kadar_air = $('#kadar_air').val();
                let pcs_kirim = $('#pcs_kirim').val();
                let berat_kirim = $('#berat_kirim').val();
                let user_created = $('#user_created').val();
                // let berat_pre_cleaning = $('#berat_precleaning').val();
                // let pcs_pre_cleaning = $('#pcs').val();
                // let susut = $('#susut').val();
                // let susutTabel = parseFloat(susut).toFixed(2);
                // susutTabel = susutTabel.replace('.', '');
                // susutTabel = susutTabel.padStart(4, '0');

                $('#plant').prop('disabled', true);
                $('#nomor_grading').prop('readonly', true);


                var newRow = `<tr>` +
                    `<td class="text-center">${nomor_job}</td>` +
                    `<td class="text-center">${nomor_grading}</td>` +
                    `<td class="text-center">${nomor_nota_internal}</td>` +
                    `<td class="text-center">${id_box_grading_kasar}</td>` +
                    `<td class="text-center">${id_box_raw_material}</td>` +
                    `<td class="text-center">${nomor_batch}</td>` +
                    `<td class="text-center">${nama_supplier}</td>` +
                    `<td class="text-center">${jenis_raw_material}</td>` +
                    `<td class="text-center">${jenis_kirim}</td>` +
                    `<td class="text-center">${tujuan_kirim}</td>` +
                    `<td class="text-center">${berat_kirim}</td>` +
                    `<td class="text-center">${pcs_kirim}</td>` +
                    `<td class="text-center">${kadar_air}</td>` +
                    `<td class="text-center">${modal}</td>` +
                    `<td class="text-center">${total_modal}</td>` +
                    // `<td class="text-center">${fix_harga_deal.toFixed(4)}</td>` +
                    `<td class="text-center"><button class="btn btn-danger" onclick="hapusBaris(this)">Delete</button></td>` +
                    `</tr>`
                $('#dataTable tbody').append(newRow);

                calculateTotalBerat();
                calculateTotalPcs();
                calculateTotalBox();

                dataArray.push({
                    nomor_job: nomor_job,
                    nomor_grading: nomor_grading,
                    id_box_grading_kasar: id_box_grading_kasar,
                    id_box_raw_material: id_box_raw_material,
                    nomor_batch: nomor_batch,
                    nomor_nota_internal: nomor_nota_internal,
                    nama_supplier: nama_supplier,
                    jenis_raw_material: jenis_raw_material,
                    kadar_air: kadar_air,
                    jenis_kirim: jenis_kirim,
                    berat_kirim: berat_kirim,
                    pcs_kirim: pcs_kirim,
                    tujuan_kirim: tujuan_kirim,
                    modal: modal,
                    total_modal: total_modal,
                    // berat_adding: totalBeratKirim,
                    // pcs_adding: totalPcsKirim,
                    user_created: user_created,

                });

                // Mengosongkan nilai dropdown nomor_job
                // $('#nomor_job').val(null).trigger('change');
                $('#nomor_job, #id_box_grading_kasar, #id_box_raw_material, #nomor_batch, #nomor_nota_internal, #nama_supplier, #jenis_raw_material, #jenis_kirim, #tujuan_kirim, #modal, #total_modal, #kadar_air, #pcs_kirim, #berat_kirim, #operator_sikat_dan_kompresor, #operator_flex_dan_poles, #operator_cutter, #kuningan, #Sterofoam, #karat, #rontokan_flex, #rontokan_bahan,#rontokan_serabut, #ws, #berat_precleaning, #pcs, #susut')
                    .val('');
            }

        }

        function hapusBaris(button) {
            // Dapatkan elemen baris terkait dengan tombol delete yang diklik
            let row = $(button).closest('tr');

            // Dapatkan nomor_job dari baris yang dihapus
            let nomorJobDihapus = row.find('td:eq(0)').text();

            // Buat kembali opsi nomor_job yang dihapus dan tambahkan ke dalam dropdown
            $('#nomor_job').append('<option value="' + nomorJobDihapus + '">' + nomorJobDihapus + '</option>');

            // Urutkan opsi nomor_job dalam dropdown
            let options = $('#nomor_job option');
            options.detach().sort(function(a, b) {
                let at = $(a).text();
                let bt = $(b).text();
                return (at > bt) ? 1 : ((at < bt) ? -1 : 0);
            });
            $('#nomor_job').append(options);

            // Hapus baris dari dataArray berdasarkan indeks baris di tabel
            let rowIndex = row.index();
            dataArray.splice(rowIndex, 1);

            // Hapus baris dari tabel
            row.remove();

            let jumlahBaris = $('#dataTable tbody tr').length;
            if (jumlahBaris === 0) {
                // Jika tidak ada baris lagi, kosongkan nilai dari #plant dan #nomor_bstb
                // $('#plant').val('');
                $('#plant').val($('#plant option:first').val()).trigger('change').prop('disabled', false);
                $('#nomor_bstb').val('').prop('readonly', false);
                $('#nomor_bstb').val('');

                let totalBeratKirim = 0;
                $('#dataTable tbody tr').each(function() {
                    let beratKirim = parseFloat($(this).find('td:eq(10)')
                        .text()); // Ganti angka 10 dengan indeks kolom berat_kirim dalam tabel
                    if (!isNaN(beratKirim)) {
                        totalBeratKirim += beratKirim;
                    }
                });
                $('#total_berat').val(totalBeratKirim);
                // Total Pcs
                let totalPcsKirim = 0;
                $('#dataTable tbody tr').each(function() {
                    let pcsKirim = parseFloat($(this).find('td:eq(11)')
                        .text()); // Ganti angka 11 dengan indeks kolom pcs_kirim dalam tabel
                    if (!isNaN(pcsKirim)) {
                        totalPcsKirim += pcsKirim;
                    }
                });
                $('#total_pcs').val(totalPcsKirim);

                $('#total_box').val(jumlahBaris);
            } else {
                // Total Berat
                let totalBeratKirim = 0;
                $('#dataTable tbody tr').each(function() {
                    let beratKirim = parseFloat($(this).find('td:eq(10)')
                        .text()); // Ganti angka 10 dengan indeks kolom berat_kirim dalam tabel
                    if (!isNaN(beratKirim)) {
                        totalBeratKirim += beratKirim;
                    }
                });
                $('#total_berat').val(totalBeratKirim);
                // Total Pcs
                let totalPcsKirim = 0;
                $('#dataTable tbody tr').each(function() {
                    let pcsKirim = parseFloat($(this).find('td:eq(11)')
                        .text()); // Ganti angka 11 dengan indeks kolom pcs_kirim dalam tabel
                    if (!isNaN(pcsKirim)) {
                        totalPcsKirim += pcsKirim;
                    }
                });
                $('#total_pcs').val(totalPcsKirim);

                $('#total_box').val(jumlahBaris);
            }
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
                url: `{{ route('PreGradingHalusAdding.simpanData') }}`,
                method: 'POST',
                data: {
                    data: JSON.stringify(dataArray),
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
                    window.location.href = `{{ route('PreGradingHalusAdding.index') }}`;
                },
                error: function(xhr, status, error) {
                    console.error('Error sending data:', error);

                    // Handling duplicate entry error
                    if (xhr.responseJSON && xhr.responseJSON.error && xhr.responseJSON.error.includes(
                            'Integrity constraint violation: 1062')) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal Menyimpan Data',
                            text: 'Data tidak dapat disimpan karena terdapat duplikasi entri kunci unik pada basis data.'
                        });
                    } else {
                        // Menampilkan SweetAlert untuk pesan error umum
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Terjadi kesalahan saat mengirim data. Silakan coba lagi.'
                        });
                    }
                },
                // complete: function() {
                //     // Menutup SweetAlert setelah permintaan selesai, terlepas dari berhasil atau gagal
                //     Swal.close();
                // }
            });
        }

        // function simpanData() {
        //     console.log(dataArray);
        //     // Cek apakah data kosong
        //     if (dataArray.length === 0) {
        //         // Menampilkan SweetAlert untuk pesan error
        //         Swal.fire({
        //             icon: 'error',
        //             title: 'Astagfirullah',
        //             text: 'Data dalam tabel masih kosong. Silakan tambahkan data terlebih dahulu.'
        //         });
        //         return; // Menghentikan eksekusi fungsi jika data kosong
        //     }
        //     // Mengirim data ke server menggunakan AJAX
        //     $.ajax({
        //         url: `{{ route('PreGradingHalusAdding.simpanData') }}`,
        //         method: 'POST',
        //         data: {
        //             data: JSON.stringify(dataArray),
        //             _token: '{{ csrf_token() }}'
        //         },
        //         dataType: 'json',
        //         beforeSend: function() {
        //             // Menampilkan SweetAlert sebagai indikator loading sebelum permintaan dikirimkan
        //             Swal.fire({
        //                 title: 'Loading...',
        //                 allowOutsideClick: false,
        //                 showConfirmButton: false,
        //                 onBeforeOpen: () => {
        //                     Swal.showLoading();
        //                 }
        //             });
        //         },
        //         success: function(response) {
        //             console.log('Data sent successfully:', response);

        //             // Menampilkan SweetAlert untuk pesan sukses
        //             Swal.fire({
        //                 icon: 'success',
        //                 title: 'Alhamdulillah',
        //                 text: 'Data berhasil dikirim.'
        //             });

        //             // Redirect atau lakukan tindakan lain setelah berhasil
        //             window.location.href = `{{ route('PreGradingHalusAdding.index') }}`;
        //         },
        //         error: function(error) {
        //             console.error('Error sending data:', error);

        //             // Menampilkan SweetAlert untuk pesan error
        //             Swal.fire({
        //                 icon: 'error',
        //                 title: 'Error',
        //                 text: 'Terjadi kesalahan saat mengirim data. Silakan coba lagi.'
        //             });
        //         },
        //         complete: function() {
        //             // Menutup SweetAlert setelah permintaan selesai, terlepas dari berhasil atau gagal
        //             Swal.close();
        //         }
        //     });
        // }
    </script>
@endsection
