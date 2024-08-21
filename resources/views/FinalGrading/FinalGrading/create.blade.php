@extends('layouts.master1')
@section('menu')
    Final Grading
@endsection
@section('title')
    Final Grading
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card mt-2 border border-primary border-3">
            <div class="card-header">
                <div class="d-flex align-items-center mb-3">
                    <h4 class="card-title">Final Grading</h4>
                </div>
                <hr>
                <form method="POST" class="row g-3" id="myForm">
                    <div class="col-md-4">
                        <label for="basic-usage" class="form-label">Asal Transit</label>
                        <select id="asal_stock" class="select2 form-select" name="asal_stock"
                            data-placeholder="Pilih Asal Transit">
                            <option value="">Pilih Asal Transit</option>
                            <option value="moulding">
                                Moulding
                            </option>
                            <option value="rework">
                                Rework
                            </option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="basic-usage" class="form-label">Nomor Job</label>
                        <select class="select2 form-select" style="width: 100%;" name="nomor_job" id="nomor_job"
                            data-placeholder="Pilih Nomor Job">
                            <option value="">Pilih Nomor Job</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="nomor_batch" class="form-label">Nomor Batch</label>
                        <input type="text" class="form-control" id="nomor_batch" readonly>
                    </div>

                    <div class="col-md-4">
                        <label for="tujuan_kirim" class="form-label">Tujuan Kirim</label>
                        <input type="text" class="form-control" id="tujuan_kirim" readonly>
                    </div>

                    <div class="col-md-4">
                        <label for="job_order" class="form-label">Job Order</label>
                        <input type="text" class="form-control" id="job_order" readonly>
                    </div>

                    <div class="col-md-4">
                        <label for="berat_job" class="form-label">Berat Job</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="berat_job" readonly>
                    </div>

                    <div class="col-md-4">
                        <label for="pcs_job" class="form-label">Pcs Job</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="pcs_job" readonly>
                    </div>

                    <div class="col-md-4">
                        <label for="upah_operator" class="form-label">Upah Operator</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="upah_operator" readonly>
                    </div>

                    <div class="col-md-4">
                        <label for="nama_operator" class="form-label">Nama Operator</label>
                        <input type="text" class="form-control" id="nama_operator" readonly>
                    </div>

                    <div class="col-md-4">
                        <label for="nip_operator" class="form-label">NIP Operator</label>
                        <input type="text" class="form-control" id="nip_operator" readonly>
                    </div>

                    <div class="col-md-4">
                        <label for="grade_operator" class="form-label">Grade Operator</label>
                        <input type="text" class="form-control" id="grade_operator" readonly>
                    </div>

                    <div class="col-md-4">
                        <label for="nama_team_leader" class="form-label">Nama Team Leader</label>
                        <input type="text" class="form-control" id="nama_team_leader" readonly>
                    </div>

                    <div class="col-md-3">
                        <label for="basic-usage" class="form-label">Jenis Grading</label>
                        <select class="select2 form-select" style="width: 100%;" name="jenis_grading" id="jenis_grading"
                            data-placeholder="Pilih Jenis Grading">
                            <option value="">Pilih Jenis Grading</option>
                            @foreach ($master_jenis_final_grading as $item)
                                <option value="{{ $item->jenis }}">
                                    {{ $item->jenis }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" id="harga_estimasi">
                        <input type="hidden" id="kontribusi">
                        <input type="hidden" id="modal">
                        <input type="hidden" id="total_modal">
                    </div>

                    <div class="col-md-3">
                        <label for="kategori_susut" class="form-label">Kategori Susut</label>
                        <input type="text" class="form-control" id="kategori_susut" readonly>
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

                    <div class="col-md-4">
                        <label for="basic-usage" class="form-label">Rework</label>
                        <select class="select2 form-select" style="width: 100%;" name="select_rework" id="select_rework"
                            data-placeholder="Pilih Rework">
                            <option value="">Pilih Rework</option>
                            <option value="1">Ya</option>
                            <option value="0">Tidak</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="nomor_job_rework" class="form-label">Nomor Job Rework</label>
                        <input type="text" class="form-control" id="nomor_job_rework" readonly>
                    </div>

                    <div class="col-md-4">
                        <label for="user_created" class="form-label">NIP Admin</label>
                        <input type="text" class="form-control" id="user_created" readonly
                            value="{{ auth()->user()->nip }}">
                    </div>

                    <div class="col-md-4">
                        <label for="total_berat" class="form-label">Total Berat</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="total_berat" readonly>
                    </div>

                    <div class="col-md-4">
                        <label for="susut_depan" class="form-label">Susut Depan</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="susut_depan" readonly>
                    </div>

                    <div class="col-md-4">
                        <label for="susut_belakang" class="form-label">Susut Belakang</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="susut_belakang" readonly>
                    </div>

                    <div class="col-12">
                        <button type="button" class="btn btn-primary" id="tambah_data"
                            onclick="addRow()">Tambah</button>
                        <a href="{{ Route('FinalGrading.index') }}" type="button" class="btn btn-danger">Close</a>
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
                                <th scope="col" class="text-center">Nomor Job</th>
                                <th scope="col" class="text-center">Nomor Batch</th>
                                <th scope="col" class="text-center">Tujuan Kirim</th>
                                <th scope="col" class="text-center">Job Order</th>
                                <th scope="col" class="text-center">Berat Job</th>
                                <th scope="col" class="text-center">Pcs Job</th>
                                <th scope="col" class="text-center">Upah Operator</th>
                                <th scope="col" class="text-center">Nama Operator</th>
                                <th scope="col" class="text-center">NIP Operator</th>
                                <th scope="col" class="text-center">Grade Operator</th>
                                <th scope="col" class="text-center">Nama Team Leader</th>
                                <th scope="col" class="text-center">Jenis Grading</th>
                                <th scope="col" class="text-center">Kategori Susut</th>
                                <th scope="col" class="text-center">Harga Estimasi</th>
                                <th scope="col" class="text-center">Berat Grading</th>
                                <th scope="col" class="text-center">Pcs Grading</th>
                                <th scope="col" class="text-center">Nomor Job Rework</th>
                                <th scope="col" class="text-center">Susut Depan</th>
                                <th scope="col" class="text-center">Susut Belakang</th>
                                <th scope="col" class="text-center">Kontribusi</th>
                                @role('admin')
                                    <th scope="col" class="text-center">Modal</th>
                                    <th scope="col" class="text-center">Total Modal</th>
                                    <th scope="col" class="text-center">Rework</th>
                                @endrole
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
            // Menetapkan event handler untuk event 'change' pada elemen dengan ID 'asal_stock'
            $('#asal_stock').on('change', function() {
                // Mengambil nilai dari elemen yang berubah (misalnya, nilai yang dipilih dari dropdown)
                let typeTransit = $(this).val();

                // Mendapatkan elemen target untuk menampilkan hasil, yaitu elemen dengan ID 'nomor_job'
                let targetSelect = $('#nomor_job');

                // Mendapatkan nilai plant dari user (misalnya, dari server-side rendering atau backend)
                let userPlant = '{{ auth()->user()->plant }}';

                // Membersihkan opsi yang ada di targetSelect sebelum melakukan panggilan AJAX
                targetSelect.empty();

                // Menambahkan opsi default ke targetSelect, misalnya untuk memberi petunjuk kepada pengguna
                targetSelect.append('<option value="">Pilih Nomor Job</option>');

                // Fungsi untuk memproses respons dari panggilan AJAX
                let processResponse = function(response, nomorJobKey) {
                    let dataTransit = response;

                    dataTransit.forEach(v => {
                        let nomorJob = v[nomorJobKey];
                        if (nomorJob) {
                            // Split string berdasarkan '_'
                            let parts = nomorJob.split('_');
                            // nomorJob.include('_' + userPlant);
                            // Pastikan ada cukup bagian setelah split
                            // if (parts.length >= 4) {
                            //     // Ambil karakter ketiga dari belakang
                            //     let targetChar = parts[2];
                            //     console.log(
                            //         `Processing nomorJob: ${nomorJob}`); // Debugging line
                            //     console.log(
                            //         `Extracted character: ${targetChar}`); // Debugging line

                            // Tambahkan nomorJob ke dalam dropdown jika karakter sesuai dengan userPlant
                            if (nomorJob.includes('_' + userPlant)) {
                                targetSelect.append(
                                    `<option value="${nomorJob}">${nomorJob}</option>`
                                );
                            }
                            // }
                        }
                    });
                };

                // Melakukan aksi berdasarkan nilai typeTransit
                switch (typeTransit) {
                    case 'moulding':
                        // Melakukan panggilan AJAX untuk mendapatkan data moulding
                        $.ajax({
                            url: '{{ route('FinalGrading.getMoulding') }}', // URL endpoint untuk mendapatkan data moulding
                            method: 'GET', // Metode HTTP untuk panggilan
                            data: {
                                plant: userPlant // Mengirimkan nilai plant sebagai parameter
                            },
                            success: function(response) {
                                // Memproses data respons yang diterima dengan fungsi processResponse
                                processResponse(response, 'nomor_job');
                            },
                            error: function(error) {
                                // Menampilkan pesan error jika terjadi kesalahan dalam panggilan AJAX
                                console.error('Error fetching data:', error);
                            }
                        });
                        break;
                    case 'rework':
                        // Melakukan panggilan AJAX untuk mendapatkan data rework
                        $.ajax({
                            url: '{{ route('FinalGrading.getRework') }}', // URL endpoint untuk mendapatkan data rework
                            method: 'GET', // Metode HTTP untuk panggilan
                            data: {
                                plant: userPlant // Mengirimkan nilai plant sebagai parameter
                            },
                            success: function(response) {
                                // Memproses data respons yang diterima dengan fungsi processResponse
                                processResponse(response, 'nomor_job_rework');
                            },
                            error: function(error) {
                                // Menampilkan pesan error jika terjadi kesalahan dalam panggilan AJAX
                                console.error('Error fetching data:', error);
                            }
                        });
                        break;
                    default:
                        // Jika typeTransit tidak cocok dengan case yang ada, tidak melakukan tindakan apa pun
                        break;
                }

                // mengosongkan input
                $('#nomor_batch').val('');
                $('#tujuan_kirim').val('');
                $('#job_order').val('');
                $('#berat_job').val('');
                $('#pcs_job').val('');
                $('#upah_operator').val('');
                $('#nama_operator').val('');
                $('#nip_operator').val('');
                $('#grade_operator').val('');
                $('#nama_team_leader').val('');
                $('#select_rework').val(null).trigger('change');
                $('#nomor_job_rework').val('');

            });

            // Event listener Nomor Job
            $('#nomor_job').on('change', function() {
                let selectednomorJob = $(this).val();
                let typeTransit = $('#asal_stock').val();
                let url = typeTransit === 'moulding' ?
                    '{{ route('FinalGrading.setMoulding') }}' :
                    '{{ route('FinalGrading.setRework') }}';

                $.ajax({
                    url: url,
                    method: 'GET',
                    data: {
                        nomor_job: selectednomorJob
                    },
                    success: function(response) {
                        console.log(response);
                        if (typeTransit === 'moulding') {
                            $('#nomor_batch').val(response.nomor_batch);
                            $('#tujuan_kirim').val(response.tujuan_kirim);
                            $('#job_order').val(response.job_order);
                            $('#berat_job').val(response.berat_job);
                            $('#pcs_job').val(response.pcs_job);
                            $('#modal').val(response.modal_nomor_job);
                            $('#total_modal').val(response.total_modal_nomor_job);
                            $('#upah_operator').val(response.upah_operator);
                            $('#nama_operator').val(response.nama_operator);
                            $('#nip_operator').val(response.nip_operator);
                            $('#grade_operator').val(response.grade_operator);
                            $('#nama_team_leader').val(response.nama_team_leader);
                        } else if (typeTransit === 'rework') {
                            $('#nomor_batch').val(response.nomor_batch);
                            $('#tujuan_kirim').val(response.tujuan_kirim);
                            $('#job_order').val(response.job_order);
                            $('#berat_job').val(response.berat_job);
                            $('#pcs_job').val(response.pcs_job);
                            $('#modal').val(response.modal);
                            $('#total_modal').val(response.total_modal);
                            $('#upah_operator').val(0);
                            $('#nama_operator').val(response.nama_operator);
                            $('#nip_operator').val(response.nip_operator);
                            $('#grade_operator').val(response.grade_operator);
                            $('#nama_team_leader').val(response.nama_team_leader);
                        } else {
                            console.error('Error: Data not found in response');
                        }
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            });

            // Event listener Jenis
            $('#jenis_grading').on('change', function() {
                selectedJenis = $(this).val();

                $.ajax({
                    url: '{{ route('FinalGrading.setJenis') }}',
                    method: 'GET',
                    data: {
                        jenis: selectedJenis
                    },
                    success: function(response) {
                        console.log(response);

                        // Mengatur nilai Kategori Susut sesuai dengan respons dari server
                        $('#kategori_susut').val(response.kategori_susut);
                        $('#harga_estimasi').val(response.harga_estimasi);
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            });

            // Generate Nomor Job Rework
            $('#select_rework').on('change', function() {
                let selectedValue = $(this).val();
                console.log(selectedValue);
                let nomorJob = $('#nomor_job').val();
                if (selectedValue === '1' && nomorJob) {
                    // Generate nomor_job_rework dengan format nomor_job_R
                    let nomorJobRework = `${nomorJob}_R`;
                    $('#nomor_job_rework').val(nomorJobRework);
                } else {
                    // Kosongkan input jika "Tidak" dipilih
                    $('#nomor_job_rework').val('');
                }
            });
        });

        // Hitung harga estimasi
        // function hargaEstimasi() {
        //     // Pastikan nilai modal adalah angka
        //     const modal_number = parseFloat($('#modal').val());
        //     console.log("Modal " + modal_number);

        //     // Cek apakah nomor_lot dan jenis_grading sudah terisi
        //     const nomorLotTerisi = $('#nomor_lot').val() !== '';
        //     console.log("Nomor Lot ISI " + nomorLotTerisi);
        //     const jenisGradingTerisi = $('#jenis_grading').val() !== '';
        //     console.log("Jenis Gading ISI " + jenisGradingTerisi);

        //     // Pastikan nilai modal adalah angka dan nomor_lot serta jenis_grading sudah terisi
        //     if (!isNaN(modal_number) && nomorLotTerisi && jenisGradingTerisi) {
        //         // Pastikan nilai pengurangan_harga adalah angka
        //         const pengurangan_harga_number = parseFloat($('#pengurangan_harga').val());
        //         // Pastikan nilai harga_estimasi adalah angka
        //         const harga_estimasi = parseFloat($('#harga_esti').val());

        //         // Menghasilkan nomor BSTB baru
        //         if (isNaN(pengurangan_harga_number) || pengurangan_harga_number === null || pengurangan_harga_number ===
        //             0) {
        //             $('#harga_estimasi').val(harga_estimasi);
        //         } else {
        //             $('#harga_estimasi').val(modal_number - (modal_number * pengurangan_harga_number));
        //         }
        //     } else {
        //         // Jika nomor_lot atau jenis_grading belum terisi, tidak melakukan perhitungan
        //         console.log('Nomor Lot atau jenis grading belum terisi.');
        //     }
        // }
        // Hitung Susut Depan
        function hitungSusutDepan() {
            let beratGradingSD = 0;

            // Iterasi melalui setiap baris tabel
            $('#dataTable tbody tr').each(function() {
                let kategoriSusut = $(this).find('td:eq(12)').text();
                // console.log(kategoriSusut);
                let beratGrading = parseFloat($(this).find('td:eq(14)').text());
                // console.log(beratGrading);
                let beratJob = parseFloat($(this).find('td:eq(4)').text());
                // console.log(beratJob);

                // Pastikan beratGrading dan beratJob adalah angka yang valid
                if (!isNaN(beratGrading) && !isNaN(beratJob)) {
                    // Menambahkan berat grading jika kategori susut adalah "SD"
                    if (kategoriSusut === "SD") {
                        beratGradingSD += beratGrading;
                    }
                }
            });

            // Menghitung berat adjustment per adding untuk kategori SD
            let totalBeratJob = parseFloat($('#berat_job').val()); // Menggunakan berat adding dari input form
            // console.log("Berat Adding = " + totalBeratJob);
            let susutDepan = totalBeratJob !== 0 ? 1 - (beratGradingSD / totalBeratJob) : 0;

            $('#dataTable tbody tr').each(function() {
                let currentKategoriSusut = $(this).find('td:eq(12)').text();
                if (currentKategoriSusut === "SD") {
                    let row = $(this);
                    row.find('td:eq(17)').text(susutDepan.toFixed(4)); // Update nilai di tabel
                } else {
                    let row = $(this);
                    row.find('td:eq(17)').text(susutDepan.toFixed(4)); // Update nilai di tabel
                }
            });

            console.log("Susut Depan = " + susutDepan);
            $('#susut_depan').val(susutDepan.toFixed(4));
        }
        // Hitung Susut Belakang
        function hitungSusutBelakang() {
            let totalBeratGrading = 0;
            let totalBeratJob = parseFloat($('#berat_job').val()); // Mengambil berat adding dari input form

            // Menghitung total berat adjustment dari setiap baris tabel
            $('#dataTable tbody tr').each(function() {
                let beratGrading = parseFloat($(this).find('td:eq(14)').text());

                // Pastikan beratGrading adalah angka yang valid
                if (!isNaN(beratGrading)) {
                    totalBeratGrading += beratGrading;
                }
            });

            // Menghindari pembagian oleh nol
            if (totalBeratJob !== 0) {
                let susutBelakang = 1 - (totalBeratGrading / totalBeratJob);

                // Memperbarui tabel dengan hasil perhitungan
                $('#dataTable tbody tr').each(function() {
                    $(this).find('td:eq(18)').text(susutBelakang.toFixed(4));
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
                let beratGrading = parseFloat($(this).find('td:eq(14)').text());

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
                    let beratGrading = parseFloat($(this).find('td:eq(14)').text());
                    // Menghitung presentase berat grading berdasarkan total berat grading
                    let kontribusi = (beratGrading / totalBeratGrading) * 100;

                    // Menampilkan hasil perhitungan pada kolom yang sesuai
                    $(this).find('td:eq(19)').text(Math.round(kontribusi) + '%');
                    console.log("Kontribusi = " + Math.round(kontribusi) + '%');
                    // $('#kontribusi').val(kontribusi);
                });
            } else {
                // Jika tidak ada data berat grading yang valid atau total berat grading adalah nol, set semua nilai pada kolom hasil perhitungan ke 0
                $('#dataTable tbody tr').each(function() {
                    $(this).find('td:eq(19)').text('0%');
                });
            }
        }

        // Hitung Total Berat
        function hitungTotalBerat() {
            let totalBerat = 0;
            // Iterasi melalui setiap baris dalam tabel
            $('#dataTable tbody tr').each(function() {
                // Mendapatkan nilai berat adding dari baris saat ini dan menambahkannya ke totalBerat
                let beratGrading = parseFloat($(this).find('td:eq(14)').text()) || 0;
                totalBerat += beratGrading;
            });
            // Menampilkan total berat di input #total_berat
            $('#total_berat').val(totalBerat);
        }

        // Validasi
        function validateForm() {
            // Mendefinisikan variabel untuk menyimpan kolom yang belum diisi
            let emptyFields = [];

            // Mendapatkan nilai dari semua input
            let asal_stock = $('#asal_stock').val();
            let nomor_job = $('#nomor_job').val();
            let nomor_batch = $('#nomor_batch').val();
            let tujuan_kirim = $('#tujuan_kirim').val();
            let job_order = $('#job_order').val();
            let berat_job = $('#berat_job').val();
            let pcs_job = $('#pcs_job').val();
            let upah_operator = $('#upah_operator').val();
            let nama_operator = $('#nama_operator').val();
            let nip_operator = $('#nip_operator').val();
            let grade_operator = $('#grade_operator').val();
            let nama_team_leader = $('#nama_team_leader').val();
            let jenis_grading = $('#jenis_grading').val();
            let kategori_susut = $('#kategori_susut').val();
            let harga_estimasi = $('#harga_estimasi').val();
            let berat_grading = $('#berat_grading').val();
            let pcs_grading = $('#pcs_grading').val();
            let user_created = $('#user_created').val();

            // Memeriksa setiap input, dan jika kosong, tambahkan ke daftar kolom yang belum diisi
            if (!asal_stock) emptyFields.push('Asal Stock');
            if (!nomor_job) emptyFields.push('Nomor Job');
            if (!nomor_batch) emptyFields.push('Nomor Batch');
            if (!tujuan_kirim) emptyFields.push('Tujuan Kirim');
            if (!job_order) emptyFields.push('Job Order');
            if (!berat_job) emptyFields.push('Berat Job');
            if (!pcs_job) emptyFields.push('Pcs Job');
            if (!upah_operator) emptyFields.push('Upah Operator');
            if (!nama_operator) emptyFields.push('Nama Operator');
            if (!nip_operator) emptyFields.push('NIP Operator');
            if (!grade_operator) emptyFields.push('Grade Operator');
            if (!nama_team_leader) emptyFields.push('Nama Team Leader');
            if (!jenis_grading) emptyFields.push('Jenis Grading');
            if (!kategori_susut) emptyFields.push('Kategori Susut');
            if (!harga_estimasi) emptyFields.push('Harga Estimasi');
            if (!berat_grading) emptyFields.push('Berat Job');
            if (!pcs_grading) emptyFields.push('Pcs Job');
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
        // let rework = '';
        // let modal = '';

        function addRow() {
            if (validateForm()) {
                let nomor_job = $('#nomor_job').val();
                let nomor_batch = $('#nomor_batch').val();
                let tujuan_kirim = $('#tujuan_kirim').val();
                let job_order = $('#job_order').val();
                let berat_job = $('#berat_job').val();
                let pcs_job = $('#pcs_job').val();
                let upah_operator = $('#upah_operator').val();
                let nama_operator = $('#nama_operator').val();
                let nip_operator = $('#nip_operator').val();
                let grade_operator = $('#grade_operator').val();
                let nama_team_leader = $('#nama_team_leader').val();
                let jenis_grading = $('#jenis_grading').val();
                let kategori_susut = $('#kategori_susut').val();
                let harga_estimasi = $('#harga_estimasi').val();
                // let modal = $('#harga_estimasi').val();
                let berat_grading = $('#berat_grading').val();
                let pcs_grading = $('#pcs_grading').val();
                let nomor_job_rework = $('#nomor_job_rework').val();
                let susut_depan = $('#susut_depan').val();
                let susut_belakang = $('#susut_belakang').val();
                let total_modal = $('#total_modal').val();
                let modal = $('#modal').val();
                let select_rework = $('#select_rework').val();
                let user_created = $('#user_created').val();

                let newRow = `<tr>` +
                    `<td class="text-center">${nomor_job}</td>` +
                    `<td class="text-center">${nomor_batch}</td>` +
                    `<td class="text-center">${tujuan_kirim}</td>` +
                    `<td class="text-center">${job_order}</td>` +
                    `<td class="text-center">${berat_job}</td>` +
                    `<td class="text-center">${pcs_job}</td>` +
                    `<td class="text-center">${upah_operator}</td>` +
                    `<td class="text-center">${nama_operator}</td>` +
                    `<td class="text-center">${nip_operator}</td>` +
                    `<td class="text-center">${grade_operator}</td>` +
                    `<td class="text-center">${nama_team_leader}</td>` +
                    `<td class="text-center">${jenis_grading}</td>` +
                    `<td class="text-center">${kategori_susut}</td>` +
                    `<td class="text-center">${harga_estimasi}</td>` +
                    `<td class="text-center">${berat_grading}</td>` +
                    `<td class="text-center">${pcs_grading}</td>` +
                    `<td class="text-center">${nomor_job_rework}</td>` +
                    `<td class="text-center">${susut_depan}</td>` +
                    `<td class="text-center">${susut_belakang}</td>` +
                    `<td class="text-center">${kontribusi}</td>` +
                    `<td class="text-center">${modal}</td>` +
                    `<td class="text-center">${total_modal}</td>` +
                    `<td class="text-center">${select_rework}</td>` +
                    `<td class="text-center">${user_created}</td>` +
                    `<td class="text-center"><button class="btn btn-danger" onclick="hapusBaris(this)">Delete</button></td>` +
                    `</tr>`;
                // Tambahkan Kedalam Tabel
                $('#dataTable tbody').append(newRow);

                $('#asal_stock').prop('disabled', true);
                $('#nomor_job').prop('disabled', true);

                // Simpan data ke dalam array
                // dataArray.push({
                //     nomor_job: nomor_job,
                //     nomor_batch: nomor_batch,
                //     tujuan_kirim: tujuan_kirim,
                //     job_order: job_order,
                //     berat_job: berat_job,
                //     pcs_job: pcs_job,
                //     upah_operator: upah_operator,
                //     nama_operator: nama_operator,
                //     nip_operator: nip_operator,
                //     grade_operator: grade_operator,
                //     nama_team_leader: nama_team_leader,
                //     jenis_grading: jenis_grading,
                //     kategori_susut: kategori_susut,
                //     harga_estimasi: harga_estimasi,
                //     berat_grading: berat_grading,
                //     pcs_grading: pcs_grading,
                //     nomor_job_rework: nomor_job_rework,
                //     susut_depan: susut_depan,
                //     susut_belakang: susut_belakang,
                //     modal: modal,
                //     total_modal: total_modal,
                //     rework: rework,
                //     user_created: user_created,
                // });

                $('#jenis_grading').val(null).trigger('change');
                $('#select_rework').val(null).trigger('change');
                $('#harga_estimasi').val('');
                $('#nomor_job_rework').val('');
                $('#berat_grading').val('');
                $('#pcs_grading').val('');

                hitungTotalBerat();
                hitungSusutDepan();
                hitungSusutBelakang();
                hitungKontribusi();
            }
        }

        // Hapus Baris
        function hapusBaris(button) {
            // Dapatkan elemen baris terkait dengan tombol delete yang diklik
            let row = $(button).closest('tr');
            row.remove();

            let rowIndex = row.index();
            dataArray.splice(rowIndex, 1);

            // Cek apakah tabel tidak memiliki baris data lagi
            if ($('#dataTable tbody tr').length === 0) {
                $('#asal_stock').prop('disabled', false).val(null).trigger('change');
                $('#nomor_job').prop('disabled', false).val(null).trigger('change');
                $('#nomor_batch').val('');
                $('#tujuan_kirim').val('');
                $('#berat_job').val('');
                $('#pcs_job').val('');
                $('#upah_operator').val('');
                $('#nama_operator').val('');
                $('#nip_operator').val('');
                $('#grade_operator').val('');
                $('#nama_team_leader').val('');
                $('#jenis_grading').val(null).trigger('change');
                $('#select_rework').val(null).trigger('change');
                $('#kategori_susut').val('');
                $('#harga_estimasi').val('');
                $('#nomor_job_rework').val('');
                $('#berat_grading').val('');
                $('#pcs_grading').val('');
                $('#susut_depan').val('0');
                $('#susut_belakang').val('0');

                hitungTotalBerat();
                hitungKontribusi();

            } else {
                $('#jenis_grading').val(null).trigger('change');
                $('#select_rework').val(null).trigger('change');
                $('#harga_estimasi').val('');
                $('#nomor_job_rework').val('');
                $('#berat_grading').val('');
                $('#pcs_grading').val('');
                $('#susut_depan').val('');
                $('#susut_belakang').val('');

                hitungTotalBerat();
                hitungSusutDepan();
                hitungSusutBelakang();
                hitungKontribusi();
            }
        }

        function sendData() {

            // dataArray = []; // Kosongkan dataArray terlebih dahulu

            $('#dataTable tbody tr').each(function() {
                let row = $(this).find('td');

                let data = {
                    nomor_job: row.eq(0).text(),
                    nomor_batch: row.eq(1).text(),
                    tujuan_kirim: row.eq(2).text(),
                    job_order: row.eq(3).text(),
                    berat_job: row.eq(4).text(),
                    pcs_job: row.eq(5).text(),
                    upah_operator: row.eq(6).text(),
                    nama_operator: row.eq(7).text(),
                    nip_operator: row.eq(8).text(),
                    grade_operator: row.eq(9).text(),
                    nama_team_leader: row.eq(10).text(),
                    jenis_grading: row.eq(11).text(),
                    kategori_susut: row.eq(12).text(),
                    harga_estimasi: row.eq(13).text(),
                    berat_grading: row.eq(14).text(),
                    pcs_grading: row.eq(15).text(),
                    nomor_job_rework: row.eq(16).text(),
                    susut_depan: row.eq(17).text(),
                    susut_belakang: row.eq(18).text(),
                    kontribusi: row.eq(19).text().replace('%', ''),
                    modal: row.eq(20).text(),
                    total_modal: row.eq(21).text(),
                    rework: row.eq(22).text(),
                    user_created: row.eq(23).text(),
                };

                dataArray.push(data);
            });

            console.log(dataArray);
            // Mengirim data ke server menggunakan AJAX
            $.ajax({
                url: '{{ route('FinalGrading.store') }}',
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

        // Event listener ketika memilih id_box
        // $('#nomor_job').on('change', function() {
        //     let selectednomorJob = $(this).val();
        //     let typeTransit = $('#asal_stock').val();
        //     let url = typeTransit === 'moulding' ?
        //         '{{ route('FinalGrading.setMoulding') }}' :
        //         '{{ route('FinalGrading.setRework') }}';

        //     $.ajax({
        //         url: url,
        //         method: 'GET',
        //         data: {
        //             nomor_job: selectednomorJob
        //         },
        //         success: function(response) {
        //             console.log(response);
        //             // if (typeTransit === 'moulding' && response.jenis_grading) {
        //             if (typeTransit === 'moulding') {
        //                 $('#jenis').val(response.jenis_grading);
        //                 // $('#modal').val(response.modal);
        //                 // $('#berat_masuk').val(response.sisa_berat);
        //                 // $('#pcs_masuk').val(response.sisa_pcs);
        //                 // } else if (typeTransit === 'rework' && response.jenis_waste) {
        //             } else if (typeTransit === 'rework') {
        //                 $('#jenis').val(response.jenis_waste);
        //                 // $('#modal').val(response.modal);
        //                 // $('#berat_masuk').val(response.sisa_berat);
        //                 // $('#pcs_masuk').val(response.sisa_pcs);
        //             } else {
        //                 console.error('Error: Data not found in response');
        //             }

        //             // Generate nomor job setiap kali id_box berubah
        //             // if (inisialTujuanGlobal) {
        //             //     const generatedNomorJob = generateNomorBSTB('JOB');
        //             //     $('#nomor_job').val(generatedNomorJob);
        //             // }
        //         },
        //         error: function(error) {
        //             console.error('Error:', error);
        //         }
        //     });
        // });

        // Event listener untuk tombol addRow
        // $('#addRow').on('click', function() {
        //     // Disable the button to prevent multiple clicks
        //     $(this).prop('disabled', true);
        // });


        // $('#tujuan_kirim').on('change', function() {
        //     checkAndGenerateNomorBSTB();
        // });

        // $(document).ready(function() {
        //     $('#berat').on('input', function() {
        //         var berat = parseFloat($(this).val());
        //         var berat_masuk = parseFloat($('#berat_masuk').val());

        //         if (berat > berat_masuk) {
        //             Swal.fire({
        //                 title: 'Error!',
        //                 text: 'Berat keluar tidak boleh lebih dari berat masuk.',
        //                 icon: 'error'
        //             });
        //             $(this).val(''); // Kosongkan input berat jika nilai tidak valid
        //         }
        //     });

        //     $('#pcs').on('input', function() {
        //         var pcs = parseFloat($(this).val());
        //         var pcs_masuk = parseFloat($('#pcs_masuk').val());

        //         if (pcs > pcs_masuk) {
        //             Swal.fire({
        //                 title: 'Error!',
        //                 text: 'Pcs keluar tidak boleh lebih dari pcs masuk.',
        //                 icon: 'error'
        //             });
        //             $(this).val(''); // Kosongkan input pcs jika nilai tidak valid
        //         }
        //     });
        // });

        // Variabel global untuk menyimpan indeks baris terakhir
        // var currentRowIndex = 0;
        // var dataArray = [];

        // function addRow() {
        //     // Mengambil nilai dari inputgrading_halus = $('#id_box_grading_halus').val();
        //     var asal_stock = $('#asal_stock').val();
        //     var id_box = $('#id_box').val();
        //     var jenis = $('#jenis').val();
        //     var tujuan_kirim = $('#tujuan_kirim').val();
        //     var nomor_job = $('#nomor_job').val();
        //     var nomor_bstb = $('#nomor_bstb').val();
        //     var berat_masuk = ($('#berat_masuk').val());
        //     var berat = $('#berat').val();
        //     var pcs = $('#pcs').val();
        //     var keterangan = $('#keterangan').val();
        //     var modal = $('#modal').val();
        //     var user_created = $('#user_created').val();
        //     // Inisialisasi array untuk menyimpan field yang belum terisi
        //     let fieldsNotFilled = [];
        //     // Periksa setiap field
        //     if (!asal_stock) fieldsNotFilled.push('Asal Stock');
        //     if (!id_box) fieldsNotFilled.push('Id box');
        //     if (!jenis) fieldsNotFilled.push('Jenis Waste');
        //     if (!tujuan_kirim) fieldsNotFilled.push('Tujuan Kirim');
        //     if (!user_created) fieldsNotFilled.push('NIP Admin');
        //     if (!berat) fieldsNotFilled.push('Berat');
        //     if (!pcs) fieldsNotFilled.push('Pcs');

        //     // Cek apakah ada field yang belum terisi
        //     if (fieldsNotFilled.length > 0) {
        //         // Membuat pesan teks yang mencantumkan field yang belum terisi
        //         let message = `Data belum diinputkan untuk: ${fieldsNotFilled.join(', ')}. Silakan lengkapi form.`;

        //         Swal.fire({
        //             title: 'Warning!',
        //             text: message,
        //             icon: 'warning'
        //         });
        //         return;
        //     }

        //     // Menghitung total modal
        //     var total_modal = (berat_masuk - berat) * modal;

        //     var newRow = '<tr>' +
        //         '<td>' + asal_stock + '</td>' +
        //         '<td>' + id_box + '</td>' +
        //         '<td>' + jenis + '</td>' +
        //         '<td>' + tujuan_kirim + '</td>' +
        //         '<td>' + nomor_job + '</td>' +
        //         '<td>' + nomor_bstb + '</td>' +
        //         '<td>' + berat + '</td>' +
        //         '<td>' + pcs + '</td>' +
        //         '<td>' + keterangan + '</td>' +
        //         '<td>' + modal + '</td>' +
        //         '<td>' + total_modal + '</td>' +
        //         '<td>' + user_created + '</td>' +
        //         '</td><td><button class="btn btn-danger" onclick="hapusBaris(this)">Delete</button></td></tr>';

        //     $('#tableBody').append(newRow);

        //     // Menambahkan data ke dalam array
        //     dataArray.push({
        //         asal_stock: asal_stock,
        //         id_box: id_box,
        //         jenis: jenis,
        //         tujuan_kirim: tujuan_kirim,
        //         nomor_bstb: nomor_bstb,
        //         nomor_job: nomor_job,
        //         berat: berat,
        //         pcs: pcs,
        //         keterangan: keterangan,
        //         modal: modal,
        //         total_modal: total_modal,
        //         user_created: user_created,
        //     });
        //     // Membersihkan nilai input setelah ditambahkan
        //     $('#berat').val('');
        //     $('#pcs').val('');
        //     $('#keterangan').val('');
        //     $('#modal').val('');
        //     $('#total_modal').val('');
        //     $('#id_box').val(null).trigger('change');
        //     $('#user_created').prop('readonly', true);
        //     // Set tujuan_kirim sebagai read-only setelah dipilih
        //     $('#tujuan_kirim').prop('disabled', true);
        //     $('#asal_stock').prop('disabled', true);

        //     // Update indeks baris terakhir
        //     currentRowIndex++;
        // }


        // Ambil indeks terakhir sebelum menghapus baris
        // var lastRowIndex = currentRowIndex;

        // function hapusBaris(button) {
        //     // Dapatkan elemen baris terkait dengan tombol delete yang diklik
        //     let row = $(button).closest('tr');

        //     // Hapus baris dari dataArray berdasarkan indeks baris di tabel
        //     let rowIndex = row.index();
        //     dataArray.splice(rowIndex, 1);

        //     // Hapus baris dari tabel
        //     row.remove();

        //     // Cek apakah tabel tidak memiliki baris data lagi
        //     if ($('#tableBody tr').length === 0) {
        //         $('#tujuan_kirim').prop('disabled', false).val(null).trigger('change');
        //         $('#asal_stock').prop('disabled', false).val(null).trigger('change');
        //         $('#nomor_job').val('');
        //         $('#nomor_bstb').val('');
        //         $('#jenis').val('');

        //         nomorBSTBGlobal = null;
        //     }
        // }

        // function CeksendData() {
        //     var i = 0;
        //     var idBoxes = []; // Array untuk menyimpan id box yang akan dicek
        //     var typeTransit = $('#asal_stock').val();

        //     // Mengumpulkan id box dari dataArray
        //     dataArray.forEach(function(item) {
        //         idBoxes.push(item.id_box);
        //     });

        //     // Mengirimkan permintaan AJAX untuk memeriksa ketersediaan id box
        //     $.ajax({
        //         url: `{{ route('FinalGrading.setMoulding') }}`, // Ganti dengan URL endpoint yang sesuai untuk memeriksa ketersediaan id box
        //         method: 'POST',
        //         data: {
        //             idBoxes: JSON.stringify(idBoxes),
        //             typeTransit: typeTransit, // Tambahkan typeTransit ke data yang dikirim
        //             _token: '{{ csrf_token() }}'
        //         },
        //         dataType: 'json',
        //         success: function(response) {
        //             var unavailableBoxes = response.unavailableBoxes;

        //             if (unavailableBoxes.length > 0) {
        //                 // Ada id box yang tidak tersedia, tampilkan pesan kesalahan
        //                 Swal.fire({
        //                     title: 'Error!',
        //                     text: 'Beberapa id box sudah tidak tersedia.',
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
        //                 text: 'Terjadi kesalahan saat memeriksa ketersediaan id box. Silakan coba lagi.',
        //                 icon: 'error'
        //             });
        //             console.log('Error:', error);
        //         }
        //     });

        //     function sendData() {
        //         console.log("Isi data=",
        //             dataArray);
        //         // Mengirim data ke server menggunakan AJAX
        //         $.ajax({
        //             url: '{{ route('FinalGrading.setMoulding') }}',
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
        //             data: {
        //                 dataArray: JSON.stringify(
        //                     dataArray), // Mengirim dataArray sebagai string JSON
        //                 user_created: $('#user_created').val() || '',
        //                 _token: '{{ csrf_token() }}'
        //             },
        //             success: function(response) {
        //                 Swal.fire({
        //                     title: 'Success!',
        //                     text: 'Data berhasil disimpan.',
        //                     icon: 'success'
        //                 }).then((result) => {
        //                     // Redirect ke halaman lain setelah menekan tombol "OK" pada SweetAlert
        //                     if (result.isConfirmed) {
        //                         window.location.href = response
        //                             .redirectTo; // Ganti dengan URL tujuan redirect Anda
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
    </script>
@endsection
