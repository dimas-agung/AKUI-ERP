@extends('layouts.master1')
@section('menu')
    Dry A
@endsection
@section('title')
    Dry A Grading Hancuran
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card mt-2 border border-primary border-3">
            <div class="card-header">
                <div class="d-flex align-items-center mb-3">
                    <h4 class="card-title">Dry A Grading Hancuran</h4>
                </div>
                <hr>
                <form method="POST" class="row g-3" id="myForm">
                    <div class="col-md-3">
                        <label for="basic-usage" class="form-label">Nomor Job</label>
                        <select class="select2 form-select" style="width: 100%;" name="nomor_job" id="nomor_job"
                            data-placeholder="Pilih Nomor Job">
                            <option value="">Pilih Nomor Job</option>
                            @foreach ($dry_a_penerimaan_hancuran_stock as $item)
                                @if ($item->dry_a_grading_hancuran_count == 0)
                                    <option value="{{ $item->nomor_job }}">
                                        {{ $item->nomor_job }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="jenis_rambang" class="form-label">Jenis Rambang</label>
                        <input type="text" class="form-control" id="jenis_rambang" readonly>
                    </div>

                    <div class="col-md-3">
                        <label for="upah_operator" class="form-label">Upah Operator</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric" class="form-control" id="upah_operator"
                            readonly>
                    </div>

                    <div class="col-md-3">
                        <label for="berat" class="form-label">Berat</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric" class="form-control" id="berat"
                            readonly>
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
                        <label for="waktu_penyebaran" class="form-label">Waktu Penyebaran</label>
                        <input type="text" class="form-control" id="waktu_penyebaran" readonly>
                    </div>

                    <div class="col-md-3">
                        <label for="waktu_pengembalian" class="form-label">Waktu Pengembalian</label>
                        <input type="text" class="form-control" id="waktu_pengembalian" readonly>
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
                        <input type="hidden" id="harga_estimasi" name="harga_estimasi" readonly>
                        <input type="hidden" id="kontribusi" name="kontribusi" readonly>
                        <input type="hidden" id="modal" name="modal" readonly>
                        <input type="hidden" id="total_modal" name="total_modal" readonly>
                    </div>

                    <div class="col-md-3">
                        <label for="berat_grading" class="form-label">Berat Grading</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="berat_grading">
                    </div>

                    <div class="col-md-4">
                        <label for="susut_belakang" class="form-label">Susut Belakang</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="susut_belakang" readonly>
                    </div>

                    <div class="col-md-4">
                        <label for="total_berat" class="form-label">Total Berat</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="total_berat" readonly>
                    </div>

                    <div class="col-md-4">
                        <label for="user_created" class="form-label">NIP Admin</label>
                        <input type="text" class="form-control" id="user_created" readonly
                            value="{{ auth()->user()->nip }}">
                    </div>

                    <div class="col-12">
                        <button type="button" class="btn btn-primary" id="tambah_data"
                            onclick="addRow()">Tambah</button>
                        <a href="{{ Route('DryAGradingHancuran.index') }}" type="button"
                            class="btn btn-danger">Close</a>

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
                                <th scope="col" class="text-center">Nomor Job</th>
                                <th scope="col" class="text-center">Jenis Rambang</th>
                                <th scope="col" class="text-center">Upah Operator</th>
                                <th scope="col" class="text-center">Berat</th>
                                <th scope="col" class="text-center">Nama Operator</th>
                                <th scope="col" class="text-center">Nip Operator</th>
                                <th scope="col" class="text-center">Grade Operator</th>
                                <th scope="col" class="text-center">Nama Team Leader</th>
                                <th scope="col" class="text-center">Waktu Penyebaran</th>
                                <th scope="col" class="text-center">Waktu Pengembalian</th>
                                <th scope="col" class="text-center">Jenis Grading</th>
                                <th scope="col" class="text-center">Berat Grading</th>
                                <th scope="col" class="text-center">Susut Belakang</th>
                                <th scope="col" class="text-center">Kontribusi</th>
                                <th scope="col" class="text-center">Harga Estimasi</th>
                                <th scope="col" class="text-center">Modal</th>
                                <th scope="col" class="text-center">Total Modal</th>
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
                    url: '{{ route('DryAGradingHancuran.set') }}',
                    method: 'GET',
                    data: {
                        nomor_job: selectedNomorJob
                    },
                    success: function(response) {
                        console.log(response);

                        // Mengatur nilai Nomor Batch sesuai dengan respons dari server
                        $('#jenis_rambang').val(response.jenis_rambang);
                        $('#upah_operator').val(response.upah_operator);
                        $('#berat').val(response.berat);
                        $('#nama_operator').val(response.nama_operator);
                        $('#nip_operator').val(response.nip_operator);
                        $('#grade_operator').val(response.grade_operator);
                        $('#nama_team_leader').val(response.nama_team_leader);
                        $('#waktu_penyebaran').val(response.waktu_penyebaran);
                        $('#waktu_pengembalian').val(response.waktu_pengembalian);

                        // hargaEstimasi();
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
                    url: '{{ route('DryAGradingHancuran.setJenis') }}',
                    method: 'GET',
                    data: {
                        jenis_grading: selectedJenis
                    },
                    success: function(response) {
                        console.log(response);

                        // Mengatur nilai Kategori Susut sesuai dengan respons dari server
                        $('#kategori_susut').val(response.kategori_susut);
                        $('#harga_estimasi').val(response.harga_estimasi);
                        $('#modal').val(response.harga_estimasi);

                        updateTotalModal();

                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            });
            $('#berat_grading').on('input', function() {
                updateTotalModal();
            });

            function updateTotalModal() {
                const modal = parseFloat($('#modal').val()) || 0;
                const berat = parseFloat($('#berat_grading').val()) || 0;
                const totalModal = modal * berat;

                $('#total_modal').val(totalModal.toFixed(2)); // Mengatur total modal dengan 2 desimal
            }
        });

        // Hitung Susut Belakang
        function hitungSusutBelakang() {
            let totalBeratGrading = 0;
            // Mengambil berat adding dari input form dan default ke 0 jika NaN
            let totalBeratAdding = parseFloat($('#berat').val()) || 0;

            // Menghitung total berat adjustment dari setiap baris tabel
            $('#dataTable tbody tr').each(function() {
                // Default ke 0 jika NaN atau 0
                let beratGrading = parseFloat($(this).find('td:eq(11)').text()) || 0;

                totalBeratGrading += beratGrading;
            });

            // Menghindari pembagian oleh nol
            let susutBelakang = totalBeratAdding !== 0 ? totalBeratGrading / totalBeratAdding : 0;

            $('#dataTable tbody tr').each(function(index) {
                $(this).find('td:eq(12)').text(susutBelakang.toFixed(4));
                // Update susut_belakang in dataArray
                dataArray[index].susut_belakang = susutBelakang.toFixed(4);
            });

            // console.log("Susut Belakang = " + susutBelakang);
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
                let beratGrading = parseFloat($(this).find('td:eq(11)').text()) || 0;

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
                $('#dataTable tbody tr').each(function(index) {
                    // Mendapatkan berat grading dari kolom yang sesuai
                    // Kolom 10 berisi berat grading
                    let beratGrading = parseFloat($(this).find('td:eq(11)').text()) || 0;

                    // Menghitung presentase berat grading berdasarkan total berat grading
                    let presentaseBeratGrading = (beratGrading / totalBeratGrading) * 100;

                    // Menampilkan hasil perhitungan pada kolom yang sesuai
                    $(this).find('td:eq(13)').text(Math.round(presentaseBeratGrading) + '%');
                    // Update kontribusi in dataArray
                    dataArray[index].kontribusi = Math.round(presentaseBeratGrading) + '%';
                });
            } else {
                // Jika tidak ada data berat grading yang valid atau total berat grading adalah nol, set semua nilai pada kolom hasil perhitungan ke 0
                $('#dataTable tbody tr').each(function(index) {
                    $(this).find('td:eq(13)').text('0%');
                    // Update kontribusi in dataArray
                    dataArray[index].kontribusi = '0%';
                });
            }
        }

        // Hitung Total Berat
        function hitungTotalBerat() {
            let totalBerat = 0;
            // Iterasi melalui setiap baris dalam tabel
            $('#dataTable tbody tr').each(function() {
                // Mendapatkan nilai berat adding dari baris saat ini dan menambahkannya ke totalBerat
                let beratGrading = parseFloat($(this).find('td:eq(11)').text()) || 0;
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
            let nomor_job = $('#nomor_job').val();
            let jenis_rambang = $('#jenis_rambang').val();
            let upah_operator = $('#upah_operator').val();
            let berat = $('#berat').val();
            let nama_operator = $('#nama_operator').val();
            let nip_operator = $('#nip_operator').val();
            let grade_operator = $('#grade_operator').val();
            let nama_team_leader = $('#nama_team_leader').val();
            let waktu_penyebaran = $('#waktu_penyebaran').val();
            let waktu_pengembalian = $('#waktu_pengembalian').val();
            let jenis_grading = $('#jenis_grading').val();
            let berat_grading = $('#berat_grading').val();
            let user_created = $('#user_created').val();

            // Memeriksa setiap input, dan jika kosong, tambahkan ke daftar kolom yang belum diisi
            if (!nomor_job) emptyFields.push('Nomor Job');
            if (!jenis_rambang) emptyFields.push('Jenis Rambang');
            if (!upah_operator) emptyFields.push('Upah Operator');
            if (!berat) emptyFields.push('Brat');
            if (!nama_operator) emptyFields.push('Nama Operator');
            if (!nip_operator) emptyFields.push('Nip Operator');
            if (!grade_operator) emptyFields.push('Grade Operator');
            if (!nama_team_leader) emptyFields.push('Nama Team Leader');
            if (!waktu_penyebaran) emptyFields.push('Waktu Penyebaran');
            if (!waktu_pengembalian) emptyFields.push('Waktu Pengembalian');
            if (!jenis_grading) emptyFields.push('Jenis Grading');
            if (!berat_grading) emptyFields.push('Berat Grading');
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
                let jenis_rambang = $('#jenis_rambang').val();
                let upah_operator = $('#upah_operator').val();
                let berat = $('#berat').val();
                let nama_operator = $('#nama_operator').val();
                let nip_operator = $('#nip_operator').val();
                let grade_operator = $('#grade_operator').val();
                let nama_team_leader = $('#nama_team_leader').val();
                let waktu_penyebaran = $('#waktu_penyebaran').val();
                let waktu_pengembalian = $('#waktu_pengembalian').val();
                let jenis_grading = $('#jenis_grading').val();
                let berat_grading = $('#berat_grading').val();
                let susut_belakang = $('#susut_belakang').val();
                let kontribusi = $('#kontribusi').val();
                let harga_estimasi = $('#harga_estimasi').val();
                let modal = $('#modal').val();
                let total_modal = $('#total_modal').val();
                let user_created = $('#user_created').val();

                let newRow = `<tr>` +
                    `<td class="text-center">${nomor_job}</td>` +
                    `<td class="text-center">${jenis_rambang}</td>` +
                    `<td class="text-center">${upah_operator}</td>` +
                    `<td class="text-center">${berat}</td>` +
                    `<td class="text-center">${nip_operator}</td>` +
                    `<td class="text-center">${nama_operator}</td>` +
                    `<td class="text-center">${grade_operator}</td>` +
                    `<td class="text-center">${nama_team_leader}</td>` +
                    `<td class="text-center">${waktu_penyebaran}</td>` +
                    `<td class="text-center">${waktu_pengembalian}</td>` +
                    `<td class="text-center">${jenis_grading}</td>` +
                    `<td class="text-center">${berat_grading}</td>` +
                    `<td class="text-center">${susut_belakang}</td>` +
                    `<td class="text-center">${kontribusi}</td>` +
                    `<td class="text-center">${harga_estimasi}</td>` +
                    `<td class="text-center">${modal}</td>` +
                    `<td class="text-center">${total_modal}</td>` +
                    `<td class="text-center">${user_created}</td>` +
                    `<td class="text-center"><button class="btn btn-danger" onclick="hapusBaris(this)">Delete</button></td>` +
                    `</tr>`;
                // Tambahkan Kedalam Tabel
                $('#dataTable tbody').append(newRow);

                $('#nomor_job').prop('disabled', true);
                $('#berat_kotor').prop('readonly', true);

                dataArray.push({
                    nomor_job: nomor_job,
                    jenis_rambang: jenis_rambang,
                    upah_operator: upah_operator,
                    berat: berat,
                    nama_operator: nama_operator,
                    nip_operator: nip_operator,
                    grade_operator: grade_operator,
                    nama_team_leader: nama_team_leader,
                    waktu_penyebaran: waktu_penyebaran,
                    waktu_pengembalian: waktu_pengembalian,
                    jenis_grading: jenis_grading,
                    berat_grading: berat_grading,
                    susut_belakang: susut_belakang,
                    kontribusi: kontribusi,
                    harga_estimasi: harga_estimasi,
                    modal: modal,
                    total_modal: total_modal,
                    user_created: user_created,
                });
                console.log(dataArray);

                $('#jenis_grading').val(null).trigger('change');
                $('#berat_grading').val('');

                hitungSusutBelakang();
                hitungKontribusi();
                hitungTotalBerat();
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
                $('#jenis_rambang').val('');
                $('#upah_operator').val('');
                $('#berat').val('');
                $('#nama_operator').val('');
                $('#nip_operator').val('');
                $('#grade_operator').val('');
                $('#nama_team_leader').val('');

                // Set susut_depan dan susut_belakang to 0 when table is empty
                $('#susut_belakang').val('0.0000');
                hitungTotalBerat();
            } else {
                // hitungSusutDepan();
                hitungSusutBelakang();
                hitungKontribusi();
                hitungTotalBerat();
            }
        }

        function CeksendData() {
            var idBoxes = dataArray.map(item => item.nomor_job); // Array untuk menyimpan id box yang akan dicek

            // Mengirimkan permintaan AJAX untuk memeriksa ketersediaan id box
            $.ajax({
                url: `{{ route('DryAGradingHancuran.CeksendData') }}`,
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
                            showCancelButton: false,
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    } else {
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
                // Tambahkan susut_belakang dan kontribusi ke dataArray
                $('#dataTable tbody tr').each(function(index) {
                    let susutBelakang = parseFloat($(this).find('td:eq(12)').text());
                    let kontribusi = parseFloat($(this).find('td:eq(13)').text());

                    dataArray[index].susut_belakang = susutBelakang;
                    dataArray[index].kontribusi = kontribusi;
                });

                console.log("Isi data=", dataArray);

                // Mengirim data ke server menggunakan AJAX
                $.ajax({
                    url: '{{ route('DryAGradingHancuran.store') }}',
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
        }


        // TEST
    </script>
@endsection
