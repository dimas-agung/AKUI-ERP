@extends('layouts.master1')
@section('menu')
    Dry A
@endsection
@section('title')
    Dry A Grading Cabut
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card mt-2 border border-primary border-3">
            <div class="card-header">
                <div class="d-flex align-items-center mb-3">
                    <h4 class="card-title">Dry A Grading Cabut</h4>
                </div>
                <hr>
                <form method="POST" class="row g-3" id="myForm">
                    <div class="col-md-3">
                        <label for="basic-usage" class="form-label">Nomor Job</label>
                        <select class="select2 form-select" style="width: 100%;" name="nomor_job" id="nomor_job"
                            data-placeholder="Pilih Nomor Job">
                            <option value="">Pilih Nomor Job</option>
                            @foreach ($dry_a_penerimaan_cabut_stock as $item)
                                @if ($item->tujuan_kirim != Auth::user()->plant)
                                    @php
                                        continue;
                                    @endphp
                                @endif
                                @if ($item->dry_a_grading_cabut_count == 0)
                                    <option value="{{ $item->nomor_job }}">
                                        {{ $item->nomor_job }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Nomor Batch</label>
                        <input type="text" class="form-control" id="nomor_batch">
                    </div>

                    <div class="col-md-3">
                        <label for="jenis_job" class="form-label">Jenis Job</label>
                        <input type="text" class="form-control" id="jenis_job" readonly>
                    </div>

                    <div class="col-md-3">
                        <label for="berat_job" class="form-label">Berat Job</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric" class="form-control" id="berat_job"
                            readonly>
                    </div>

                    <div class="col-md-3">
                        <label for="pcs_job" class="form-label">Pcs job</label>
                        <input onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="pcs_job" readonly>
                    </div>

                    <div class="col-md-3">
                        <label for="tujuan_kirim" class="form-label">Tujuan Kirim</label>
                        <input type="text" class="form-control" id="tujuan_kirim" readonly>
                    </div>

                    <div class="col-md-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" readonly>
                    </div>

                    <div class="col-md-3">
                        <label for="nama_operator" class="form-label">Nama Operator</label>
                        <input type="text" class="form-control" id="nama_operator" readonly>
                    </div>

                    <div class="col-md-3">
                        <label for="nip_operator" class="form-label">NIP Operator</label>
                        <input type="text" class="form-control" id="nip_operator" readonly>
                    </div>

                    <div class="col-md-3">
                        <label for="grade_operator" class="form-label">Grade Operator</label>
                        <input type="text" class="form-control" id="grade_operator" readonly>
                    </div>

                    <div class="col-md-3">
                        <label for="nama_team_leader" class="form-label">Nama Team Leader</label>
                        <input type="text" class="form-control" id="nama_team_leader" readonly>
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
                        <label for="upah_operator" class="form-label">Upah Operator</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="upah_operator" readonly>
                    </div>

                    <div class="col-md-3">
                        <label for="user_created" class="form-label">NIP Admin</label>
                        <input type="text" class="form-control" id="user_created" readonly
                            value="{{ auth()->user()->nip }}">
                    </div>

                    <div class="col-md-3">
                        <label for="berat_kotor" class="form-label">Berat Kotor</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="berat_kotor">
                    </div>

                    <div class="col-md-3">
                        <label for="basic-usage" class="form-label">Jenis Grading</label>
                        <select class="select2 form-select" style="width: 100%;" tabindex="-1" aria-hidden="true"
                            name="jenis_grading" id="jenis_grading" data-placeholder="Pilih Jenis Grading">
                            <option value="">Jenis Grading</option>
                            @foreach ($master_jenis_dry_a as $MasterSPRM)
                                <option value="{{ $MasterSPRM->jenis }}">
                                    {{ $MasterSPRM->jenis }}
                                </option>
                            @endforeach
                        </select>
                        <input type="hidden" id="harga_esti" name="harga_esti" readonly>
                        <input type="hidden" id="harga_estimasi" name="harga_estimasi" readonly>
                        <input type="hidden" id="pengurangan_harga" name="pengurangan_harga" readonly>
                        <input type="hidden" id="kontribusi" name="kontribusi" readonly>
                    </div>

                    <div class="col-md-3">
                        <label for="kategori_susut" class="form-label">Kategori Susut</label>
                        <input type="text" class="form-control" id="kategori_susut" readonly>
                    </div>

                    <div class="col-md-3">
                        <label for="berat_1_grading" class="form-label">Berat 1 Grading</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="berat_1_grading">
                    </div>

                    <div class="col-md-3">
                        <label for="pcs_1_grading" class="form-label">Pcs 1 Grading</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="pcs_1_grading">
                    </div>

                    <div class="col-md-3">
                        <label for="berat_2_grading" class="form-label">Berat 2 Grading</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="berat_2_grading">
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
                        <label for="total_berat_susut" class="form-label">Total Berat Susut</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="total_berat_susut" readonly>
                    </div>

                    <div class="col-12">
                        <button type="button" class="btn btn-primary" id="tambah_data"
                            onclick="addRow()">Tambah</button>
                        <a href="{{ Route('DryAGradingCabut.index') }}" type="button" class="btn btn-danger">Close</a>

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
                                <th scope="col" class="text-center">Nomor Batch</th>
                                <th scope="col" class="text-center">Jenis Job</th>
                                <th scope="col" class="text-center">Berat Job</th>
                                <th scope="col" class="text-center">Pcs Job</th>
                                <th scope="col" class="text-center">Tujuan Kirim</th>
                                <th scope="col" class="text-center">Keterangan</th>
                                <th scope="col" class="text-center">Nama Operator</th>
                                <th scope="col" class="text-center">Nip Operator</th>
                                <th scope="col" class="text-center">Grade Operator</th>
                                <th scope="col" class="text-center">Nama Team Leader</th>
                                <th scope="col" class="text-center">Modal</th>
                                <th scope="col" class="text-center">Total Modal</th>
                                <th scope="col" class="text-center">Upah Operator</th>
                                <th scope="col" class="text-center">Berat Kotor</th>
                                <th scope="col" class="text-center">JenisGrading</th>
                                <th scope="col" class="text-center">Kategori Susut</th>
                                <th scope="col" class="text-center">Berat 1 Grading</th>
                                <th scope="col" class="text-center">Pcs 1 Grading</th>
                                <th scope="col" class="text-center">Berat 2 Grading</th>
                                <th scope="col" class="text-center">Susut Depan</th>
                                <th scope="col" class="text-center">Susut Belakang</th>
                                <th scope="col" class="text-center">Harga Estimasi</th>
                                <th scope="col" class="text-center">Kontribusi</th>
                                <th scope="col" class="text-center">NIP Admin</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="col-12 mt-2 text-end">
                    <button type="submit" class="btn btn-success" onclick="CeksendData()">Simpan</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        // Dropdown Nomor Job
        $(document).ready(function() {
            let selectedNomorJob = '';

            $('#nomor_job').on('change', function() {
                selectedNomorJob = $(this).val();

                $.ajax({
                    url: '{{ route('DryAGradingCabut.set') }}',
                    method: 'GET',
                    data: {
                        nomor_job: selectedNomorJob
                    },
                    success: function(response) {
                        console.log(response);

                        // Mengatur nilai Nomor Batch sesuai dengan respons dari server
                        $('#nomor_batch').val(response.nomor_batch);
                        $('#jenis_job').val(response.jenis_job);
                        $('#berat_job').val(response.berat_job);
                        $('#pcs_job').val(response.pcs_job);
                        $('#tujuan_kirim').val(response.tujuan_kirim);
                        $('#keterangan').val(response.keterangan);
                        $('#nama_operator').val(response.nama_operator);
                        $('#nip_operator').val(response.nip_operator);
                        $('#grade_operator').val(response.grade_operator);
                        $('#nama_team_leader').val(response.nama_team_leader);
                        $('#modal').val(response.modal);
                        $('#total_modal').val(response.total_modal);
                        $('#upah_operator').val(response.upah_operator);

                        hargaEstimasi();
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            });
        });

        // DropDown Jenis
        $(document).ready(function() {
            let selectedJenis = '';

            $('#jenis_grading').on('change', function() {
                selectedJenis = $(this).val();

                $.ajax({
                    url: '{{ route('DryAGradingCabut.setJenis') }}',
                    method: 'GET',
                    data: {
                        jenis_grading: selectedJenis
                    },
                    success: function(response) {
                        console.log(response);

                        // Mengatur nilai Kategori Susut sesuai dengan respons dari server
                        $('#kategori_susut').val(response.kategori_susut);
                        $('#harga_esti').val(response.harga_estimasi);
                        $('#pengurangan_harga').val(response.pengurangan_harga);

                        hargaEstimasi();

                        // Reset semua field terlebih dahulu
                        $('#berat_1_grading').val('').prop('readonly', false);
                        $('#berat_2_grading').val('').prop('readonly', false);

                        // Menambahkan logika untuk mengatur readonly dan nilai
                        const kategoriSusut = response.kategori_susut.toLowerCase();
                        if (kategoriSusut === 'sd') {
                            $('#berat_2_grading').val(0).prop('readonly', true);
                            $('#berat_1_grading').prop('readonly', false);
                        } else if (kategoriSusut !== 'sd') {
                            $('#berat_1_grading').val(0).prop('readonly', true);
                            $('#berat_2_grading').prop('readonly', false);
                        } else {
                            $('#berat_1_grading, #berat_2_grading').prop('readonly', false);
                        }
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            });
        });

        // Hitung Harga Estimasi
        function hargaEstimasi() {
            // Pastikan nilai modal adalah angka
            const modal_number = parseFloat($('#modal').val());

            // Cek apakah nomor_grading dan jenis_grading sudah terisi
            const nomorJobTerisi = $('#nomor_job').val() !== '';
            const jenisGradingTerisi = $('#jenis_grading').val() !== '';

            // Pastikan nilai modal adalah angka dan nomor_grading serta jenis_grading sudah terisi
            if (!isNaN(modal_number) && nomorJobTerisi && jenisGradingTerisi) {
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
                // Jika nomor_job atau jenis_grading belum terisi, tidak melakukan perhitungan
                console.log('Nomor Job atau jenis grading belum terisi.');
            }
        }
        // Hitung Susut Depan
        function hitungSusutDepan() {
            let beratGradingSD = 0;

            // Iterasi melalui setiap baris tabel
            $('#dataTable tbody tr').each(function() {
                let kategoriSusut = $(this).find('td:eq(16)').text();
                let beratGrading = parseFloat($(this).find('td:eq(17)').text()) || 0; // Default ke 0 jika NaN
                let beratAdding = parseFloat($(this).find('td:eq(3)').text()) || 0; // Default ke 0 jika NaN

                // Menambahkan berat grading jika kategori susut adalah "SD"
                if (kategoriSusut === "SD") {
                    beratGradingSD += beratGrading;
                }
            });

            // Menghitung berat adjustment per adding untuk kategori SD
            let totalBeratAdding = parseFloat($('#berat_job').val()) ||
                0; // Menggunakan berat adding dari input form dan default ke 0 jika NaN
            let susutDepan = totalBeratAdding !== 0 ? 1 - (beratGradingSD / totalBeratAdding) : 0;
            // let susutDepan = totalBeratAdding !== 0 ? beratGradingSD / totalBeratAdding : 0;

            $('#dataTable tbody tr').each(function() {
                let currentKategoriSusut = $(this).find('td:eq(16)').text();
                let row = $(this);
                row.find('td:eq(20)').text(susutDepan.toFixed(4)); // Update nilai di tabel
            });

            console.log("Susut Depan = " + susutDepan);
            $('#susut_depan').val(susutDepan.toFixed(4));
        }
        // Hitung Susut Belakang
        function hitungSusutBelakang() {
            let totalBeratGrading = 0;
            // Mengambil berat adding dari input form dan default ke 0 jika NaN
            let totalBeratAdding = parseFloat($('#berat_job').val()) || 0;

            // Menghitung total berat adjustment dari setiap baris tabel
            $('#dataTable tbody tr').each(function() {
                // Default ke 0 jika NaN atau 0
                let beratGrading = parseFloat($(this).find('td:eq(19)').text()) || 0;

                // Jika beratGrading bernilai 0, ambil nilai dari kolom 17
                if (beratGrading === 0) {
                    // Default ke 0 jika NaN
                    beratGrading = parseFloat($(this).find('td:eq(17)').text()) || 0;
                }

                totalBeratGrading += beratGrading;
            });

            // Menghindari pembagian oleh nol
            let susutBelakang = totalBeratAdding !== 0 ? 1 - (totalBeratGrading / totalBeratAdding) : 0;

            $('#dataTable tbody tr').each(function() {
                $(this).find('td:eq(21)').text(susutBelakang.toFixed(4));
            });

            console.log("Susut Belakang = " + susutBelakang);
            $('#susut_belakang').val(susutBelakang.toFixed(4));
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
                // Kolom 10 berisi berat grading
                let beratGrading = parseFloat($(this).find('td:eq(17)').text()) || 0;

                if (beratGrading === 0) {
                    // Default ke 0 jika NaN
                    beratGrading = parseFloat($(this).find('td:eq(19)').text()) || 0;
                }

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
                    // Kolom 10 berisi berat grading
                    let beratGrading = parseFloat($(this).find('td:eq(17)').text()) || 0;

                    if (beratGrading === 0) {
                        // Default ke 0 jika NaN
                        beratGrading = parseFloat($(this).find('td:eq(19)').text()) || 0;
                    }
                    // Menghitung presentase berat grading berdasarkan total berat grading
                    let presentaseBeratGrading = (beratGrading / totalBeratGrading) * 100;

                    // Menampilkan hasil perhitungan pada kolom yang sesuai
                    $(this).find('td:eq(23)').text(Math.round(presentaseBeratGrading) + '%');
                });
            } else {
                // Jika tidak ada data berat grading yang valid atau total berat grading adalah nol, set semua nilai pada kolom hasil perhitungan ke 0
                $('#dataTable tbody tr').each(function() {
                    $(this).find('td:eq(23)').text('0%');
                });
            }
        }

        // Validasi
        function validateForm() {
            // Mendefinisikan variabel untuk menyimpan kolom yang belum diisi
            let emptyFields = [];

            // Mendapatkan nilai dari semua input
            let nomor_job = $('#nomor_job').val();
            let nomor_batch = $('#nomor_batch').val();
            let jenis_job = $('#jenis_job').val();
            let berat_job = $('#berat_job').val();
            let pcs_job = $('#pcs_job').val();
            let tujuan_kirim = $('#tujuan_kirim').val();
            let nama_operator = $('#nama_operator').val();
            let nip_operator = $('#nip_operator').val();
            let grade_operator = $('#grade_operator').val();
            let nama_team_leader = $('#nama_team_leader').val();
            let modal = $('#modal').val();
            let total_modal = $('#total_modal').val();
            let upah_operator = $('#upah_operator').val();
            let berat_kotor = $('#berat_kotor').val();
            let jenis_grading = $('#jenis_grading').val();
            let kategori_susut = $('#kategori_susut').val();
            let berat_1_grading = $('#berat_1_grading').val();
            let pcs_1_grading = $('#pcs_1_grading').val();
            let berat_2_grading = $('#berat_2_grading').val();
            let user_created = $('#user_created').val();

            // Memeriksa setiap input, dan jika kosong, tambahkan ke daftar kolom yang belum diisi
            if (!nomor_job) emptyFields.push('Nomor Job');
            if (!nomor_batch) emptyFields.push('Nomor Batch');
            if (!jenis_job) emptyFields.push('Jenis Job');
            if (!berat_job) emptyFields.push('Brat Job');
            if (!pcs_job) emptyFields.push('Pcs Job');
            if (!tujuan_kirim) emptyFields.push('Tujuan Kirim');
            if (!nama_operator) emptyFields.push('Nama Operator');
            if (!nip_operator) emptyFields.push('Nip Operator');
            if (!grade_operator) emptyFields.push('Grade Operator');
            if (!nama_team_leader) emptyFields.push('Nama Team Leader');
            if (!modal) emptyFields.push('Modal');
            if (!total_modal) emptyFields.push('Total Modal');
            if (!upah_operator) emptyFields.push('Upah Operator');
            if (!berat_kotor) emptyFields.push('Berat Kotor');
            if (!jenis_grading) emptyFields.push('Jenis Grading');
            if (!kategori_susut) emptyFields.push('kategori Susut');
            if (!berat_1_grading) emptyFields.push('Berat 1 Grading');
            if (!pcs_1_grading) emptyFields.push('Pcs 1 Grading');
            if (!berat_2_grading) emptyFields.push('Berat 2 Grading');
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
                let nomor_job = $('#nomor_job').val();
                let nomor_batch = $('#nomor_batch').val();
                let jenis_job = $('#jenis_job').val();
                let berat_job = $('#berat_job').val();
                let pcs_job = $('#pcs_job').val();
                let tujuan_kirim = $('#tujuan_kirim').val();
                let keterangan = $('#keterangan').val();
                let nama_operator = $('#nama_operator').val();
                let nip_operator = $('#nip_operator').val();
                let grade_operator = $('#grade_operator').val();
                let nama_team_leader = $('#nama_team_leader').val();
                let modal = $('#modal').val();
                let total_modal = $('#total_modal').val();
                let upah_operator = $('#upah_operator').val();
                let berat_kotor = $('#berat_kotor').val();
                let jenis_grading = $('#jenis_grading').val();
                let kategori_susut = $('#kategori_susut').val();
                let berat_1_grading = $('#berat_1_grading').val();
                let pcs_1_grading = $('#pcs_1_grading').val();
                let berat_2_grading = $('#berat_2_grading').val();
                let susut_depan = $('#susut_depan').val();
                let susut_belakang = $('#susut_belakang').val();
                let harga_estimasi = $('#harga_estimasi').val();
                let kontribusi = $('#kontribusi').val();
                let user_created = $('#user_created').val();

                let newRow = `<tr>` +
                    `<td class="text-center">${nomor_job}</td>` +
                    `<td class="text-center">${nomor_batch}</td>` +
                    `<td class="text-center">${jenis_job}</td>` +
                    `<td class="text-center">${berat_job}</td>` +
                    `<td class="text-center">${pcs_job}</td>` +
                    `<td class="text-center">${tujuan_kirim}</td>` +
                    `<td class="text-center">${keterangan}</td>` +
                    `<td class="text-center">${nip_operator}</td>` +
                    `<td class="text-center">${nama_operator}</td>` +
                    `<td class="text-center">${grade_operator}</td>` +
                    `<td class="text-center">${nama_team_leader}</td>` +
                    `<td class="text-center">${modal}</td>` +
                    `<td class="text-center">${total_modal}</td>` +
                    `<td class="text-center">${upah_operator}</td>` +
                    `<td class="text-center">${berat_kotor}</td>` +
                    `<td class="text-center">${jenis_grading}</td>` +
                    `<td class="text-center">${kategori_susut}</td>` +
                    `<td class="text-center">${berat_1_grading}</td>` +
                    `<td class="text-center">${pcs_1_grading}</td>` +
                    `<td class="text-center">${berat_2_grading}</td>` +
                    `<td class="text-center">${susut_depan}</td>` +
                    `<td class="text-center">${susut_belakang}</td>` +
                    `<td class="text-center">${harga_estimasi}</td>` +
                    `<td class="text-center">${kontribusi}</td>` +
                    `<td class="text-center">${user_created}</td>` +
                    `<td class="text-center"><button class="btn btn-danger" onclick="hapusBaris(this)">Delete</button></td>` +
                    `</tr>`;
                // Tambahkan Kedalam Tabel
                $('#dataTable tbody').append(newRow);

                $('#nomor_job').prop('disabled', true);
                $('#berat_kotor').prop('readonly', true);

                dataArray.push({
                    nomor_job: nomor_job,
                    nomor_batch: nomor_batch,
                    jenis_job: jenis_job,
                    berat_job: berat_job,
                    pcs_job: pcs_job,
                    tujuan_kirim: tujuan_kirim,
                    keterangan: keterangan,
                    nama_operator: nama_operator,
                    nip_operator: nip_operator,
                    grade_operator: grade_operator,
                    nama_team_leader: nama_team_leader,
                    modal: modal,
                    total_modal: total_modal,
                    upah_operator: upah_operator,
                    berat_kotor: berat_kotor,
                    jenis_grading: jenis_grading,
                    kategori_susut: kategori_susut,
                    berat_1_grading: berat_1_grading,
                    berat_grading: berat_1_grading,
                    pcs_1_grading: pcs_1_grading,
                    berat_2_grading: berat_2_grading,
                    susut_depan: susut_depan,
                    susut_belakang: susut_belakang,
                    harga_estimasi: harga_estimasi,
                    kontribusi: kontribusi,
                    user_created: user_created,
                });
                console.log(dataArray);

                $('#jenis_grading').val(null).trigger('change');
                $('#kategori_susut').val('');
                $('#berat_1_grading').val('');
                $('#pcs_1_grading').val('');
                $('#berat_2_grading').val('');

                hitungSusutDepan();
                hitungSusutBelakang();
                hitungKontribusi();
            }

        }

        // Hapus Baris
        function hapusBaris(button) {
            // Dapatkan elemen baris terkait dengan tombol delete yang diklik
            let row = $(button).closest('tr');

            // Hapus baris dari tabel
            row.remove();

            // Hapus baris dari dataArray berdasarkan indeks baris di tabel
            let rowIndex = row.index();
            dataArray.splice(rowIndex, 1);

            // Cek apakah tabel tidak memiliki baris data lagi
            if ($('#dataTable tbody tr').length === 0) {
                $('#nomor_job').prop('disabled', false).val(null).trigger('change');
                $('#nomor_batch').val('');
                $('#jenis_job').val('');
                $('#berat_job').val('');
                $('#pcs_job').val('');
                $('#tujuan_kirim').val('');
                $('#keterangan').val('');
                $('#nama_operator').val('');
                $('#nip_operator').val('');
                $('#grade_operator').val('');
                $('#nama_team_leader').val('');
                $('#modal').val('');
                $('#total_modal').val('');
                $('#upah_operator').val('');
                $('#berat_kotor').prop('readonly', false).val(null);

                // Set susut_depan dan susut_belakang to 0 when table is empty
                $('#susut_depan').val('0.0000');
                $('#susut_belakang').val('0.0000');
            } else {
                hitungSusutDepan();
                hitungSusutBelakang();
                hitungKontribusi();
            }
        }

        // function CeksendData() {
        //     let i = 0;
        //     let idBoxes = []; // Array untuk menyimpan id box yang akan dicek

        //     // Mengumpulkan id box dari dataArray
        //     dataArray.forEach(function(item) {
        //         idBoxes.push(item.nomor_job);
        //     });

        //     // Mengirimkan permintaan AJAX untuk memeriksa ketersediaan id box
        //     $.ajax({
        //         url: `{{ route('CabutBuluPenyebaran.CeksendData') }}`, // Ganti dengan URL endpoint yang sesuai untuk memeriksa ketersediaan id box
        //         method: 'POST',
        //         data: {
        //             idBoxes: JSON.stringify(idBoxes),
        //             _token: '{{ csrf_token() }}'
        //         },
        //         dataType: 'json',
        //         success: function(response) {
        //             let unavailableBoxes = response.unavailableBoxes;

        //             if (unavailableBoxes.length > 0) {
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
        //                 // let waktu_penyebaran = new Date().getTime(); // Ambil waktu saat ini

        //                 const now = new Date();
        //                 const tahun = now.getFullYear().toString().substr(-2);
        //                 const bulan = ('0' + (now.getMonth() + 1)).slice(-2);
        //                 const tanggal = ('0' + now.getDate()).slice(-2);
        //                 const jam = ('0' + now.getHours()).slice(-2);
        //                 const menit = ('0' + now.getMinutes()).slice(-2);
        //                 const detik = ('0' + now.getSeconds()).slice(-2);

        //                 const waktu_penyebaran = `${tahun}/${bulan}/${tanggal} ${jam}:${menit}:${detik}`;

        //                 console.log("Waktu =" + waktu_penyebaran);

        //                 sendData(waktu_penyebaran);
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

        //     function sendData(waktu_penyebaran) {
        //         // Mengirim data ke server menggunakan AJAX
        //         $.ajax({
        //             url: '{{ route('CabutBuluPenyebaran.store') }}',
        //             method: 'POST',
        //             beforeSend: function() {
        //                 Swal.fire({
        //                     title: 'Loading...',
        //                     allowOutsideClick: false,
        //                     showConfirmButton: false,
        //                     onBeforeOpen: () => {
        //                         Swal.showLoading();
        //                     }
        //                 });
        //             },
        //             data: function() {
        //                 let postData = {
        //                     dataArray: JSON.stringify(dataArray), // Mengirim dataArray sebagai string JSON
        //                     user_created: $('#user_created').val() || '',
        //                     user_updated: $('#user_createds').val() || '',
        //                     waktu_penyebaran: waktu_penyebaran, // Mengirim waktu_penyebaran
        //                     _token: '{{ csrf_token() }}'
        //                 };

        //                 return postData;
        //             }(),
        //             success: function(response) {
        //                 Swal.fire({
        //                     title: 'Success!',
        //                     text: 'Data berhasil disimpan.',
        //                     icon: 'success'
        //                 }).then((result) => {
        //                     // Redirect ke halaman lain setelah menekan tombol "OK" pada SweetAlert
        //                     if (result.isConfirmed) {
        //                         window.location.href = response.redirectTo;
        //                         // Ganti dengan URL tujuan redirect Anda
        //                     }
        //                 });
        //             },
        //             error: function(error) {
        //                 Swal.fire({
        //                     title: 'Failed!',
        //                     text: 'Terjadi kesalahan. Silakan coba cek data kembali.',
        //                     icon: 'error'
        //                 });
        //                 console.log('Error:', error);
        //             }
        //         });
        //     }
        // }

        function CeksendData() {
            var i = 0;
            var idBoxes = []; // Array untuk menyimpan id box yang akan dicek

            // Mengumpulkan id box dari dataArray
            dataArray.forEach(function(item) {
                idBoxes.push(item.nomor_job);
            });

            // Mengirimkan permintaan AJAX untuk memeriksa ketersediaan id box
            $.ajax({
                url: `{{ route('DryAGradingCabut.CeksendData') }}`, // Ganti dengan URL endpoint yang sesuai untuk memeriksa ketersediaan id box
                method: 'POST',
                data: {
                    idBoxes: JSON.stringify(idBoxes),
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(response) {
                    var unavailableBoxes = response.unavailableBoxes;

                    if (unavailableBoxes.length > 0) {
                        // Ada id box yang tidak tersedia, tampilkan pesan kesalahan
                        Swal.fire({
                            title: 'Error!',
                            text: 'Beberapa nomor job sudah tidak tersedia.',
                            icon: 'error',
                            showCancelButton: false, // Sembunyikan tombol cancel
                            confirmButtonText: 'OK' // Ganti teks tombol konfirmasi
                        }).then((result) => {
                            // Jika pengguna menekan tombol "OK", refresh halaman
                            if (result.isConfirmed) {
                                // Refresh halaman
                                location.reload();
                            }
                        });
                    } else {
                        // Semua id box tersedia, kirim data ke server
                        sendData();
                    }
                },
                error: function(error) {
                    Swal.fire({
                        title: 'Failed!',
                        text: 'Terjadi kesalahan saat memeriksa ketersediaan nomor job. Silakan coba lagi.',
                        icon: 'error'
                    });
                    console.log('Error:', error);
                }
            });

            function sendData() {
                console.log("Isi data=",
                    dataArray);
                // Mengirim data ke server menggunakan AJAX
                $.ajax({
                    url: '{{ route('DryAGradingCabut.store') }}',
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
                        var tableDataArray = [];

                        // Iterasi melalui setiap baris tabel
                        $('#dataTable tbody tr').each(function() {
                            // Mengambil nilai susut_depan dan susut_belakang dari tiap baris
                            var susutDepan = parseFloat($(this).find('td:eq(20)').text());
                            var susutBelakang = parseFloat($(this).find('td:eq(21)').text());
                            var kontribusi = parseFloat($(this).find('td:eq(23)').text());

                            // Debugging: Cetak nilai susut_depan, susut_belakang, dan kontribusi ke konsol
                            console.log("Nilai susut_depan:", susutDepan);
                            console.log("Nilai susut_belakang:", susutBelakang);
                            console.log("Nilai kontribusi:", kontribusi);

                            // Menambahkan data ke dalam array
                            tableDataArray.push({
                                susut_depan: susutDepan,
                                susut_belakang: susutBelakang,
                                kontribusi: kontribusi
                            });
                        });

                        // Mengirim dataArray dan data tabel ke server sebagai string JSON
                        var postData = {
                            dataArray: JSON.stringify(dataArray), // Mengirim dataArray sebagai string JSON
                            tableDataArray: JSON.stringify(
                                tableDataArray), // Mengirim data tabel sebagai string JSON
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
                                location.reload();
                                // window.location.href = response.redirectTo;
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
        }
    </script>
@endsection
