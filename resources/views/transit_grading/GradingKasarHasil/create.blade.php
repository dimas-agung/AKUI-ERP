@extends('layouts.master1')
@section('menu')
    Grading Kasar Transit
@endsection
@section('title')
    Grading Kasar Hasil
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card border border-primary border-3 mt-2">
            <div class="card-header">
                <div class="d-flex align-items-center mb-3">
                    <h4 class="card-title">Input Grading Kasar hasil</h4>
                </div>
                <hr>
                <form method="POST" class="row g-3" id="myForm">
                    @csrf
                    <div class="col-md-6">
                        <label for="basic-usage" class="form-label">Nomor Grading</label>
                        <select class="choices form-select" style="width: 100%;" tabindex="-1" aria-hidden="true"
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
                    <div class="col-md-6">
                        <label for="nama_supplier" class="form-label">Nama Supplier</label>
                        <input type="text" class="form-control" id="nama_supplier" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="jenis_raw_material" class="form-label">Jenis Adding</label>
                        <input type="text" class="form-control" id="jenis_raw_material" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="berat" class="form-label">Berat Adding</label>
                        <input type="text" class="form-control" id="berat" readonly>
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
                    <div class="col-md-4">
                        <label for="basic-usage" class="form-label">Pilih Jenis Grading :</label>
                        <select class="choices form-select" style="width: 100%;" tabindex="-1" aria-hidden="true"
                            name="jenis_grading" id="jenis_grading" placeholder="Pilih jenis grading">
                            <option value="">Pilih Jenis Grading</option>
                            @foreach ($MasterJenisGradingKasar as $MasterJGK)
                                <option value="{{ $MasterJGK->nama }},{{ $MasterJGK->harga_estimasi }}">
                                    {{ $MasterJGK->nama }}
                                </option>
                            @endforeach
                        </select>
                        <input type="hidden" id="harga_estimasi" name="harga_estimasi">
                    </div>
                    <div class="col-md-4">
                        <label for="berat_grading" class="form-label">Berat Grading</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="berat_grading">
                    </div>
                    <div class="col-md-4">
                        <label for="pcs_grading" class="form-label">Pcs Grading</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="pcs_grading">
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
        <div class="card mt-2">
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
        $('#nomor_grading').on('change', function() {
            // Mengambil nilai id_box yang dipilih
            let selectedNomorGrading = $(this).val();
            // Melakukan permintaan AJAX ke controller untuk mendapatkan nomor batch
            $.ajax({
                url: `{{ route('gradingKasarHasil.set') }}`,
                method: 'GET',
                data: {
                    nomor_grading: selectedNomorGrading
                },
                success: function(response) {
                    console.log(response);
                    // Mengatur nilai Nomor Batch sesuai dengan respons dari server
                    $('#id_box_raw_material').val(response.id_box);
                    $('#nomor_batch').val(response.nomor_batch);
                    $('#nomor_nota_internal').val(response.nomor_nota_internal);
                    $('#nama_supplier').val(response.nama_supplier);
                    $('#jenis_raw_material').val(response.jenis_raw_material);
                    $('#berat').val(response.berat);
                    $('#kadar_air').val(response.kadar_air);
                    $('#modal').val(response.modal);
                    $('#total_modal').val(response.total_modal);
                    // $('#harga_estimasi').val(response.harga_estimasi);
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });
        // jenis grading
        $(document).ready(function() {
            $("#jenis_grading").change(function() {
                var selectedOption = $(this).find("option:selected");
                var values = selectedOption.val().split(',');

                // Ambil nilai sesuai kebutuhan Anda
                var nama = values[0];
                var hargaEstimasi = values[1];
                $('#harga_estimasi').val(hargaEstimasi)
                // Log untuk memeriksa nilai
                console.log("Nama: " + nama);
                console.log("Harga Estimasi: " + hargaEstimasi);
            });
        });
        // hitung nilai berat
        function hitungNilaiBerat() {
            let totalBerat
        }
        // hitung nilai susut
        function hitungNilaiSusut() {
            let totalBeratGradingtest = parseFloat($('#berat_grading').val()) || 0;

            $('.berat_grading').each(function() {
                let beratGradingValue = parseFloat($(this).val());
                if (!isNaN(beratGradingValue)) {
                    totalBeratGradingtest += beratGradingValue;
                }
            });

            // console.log(beratGradingValue);
            let beratAdding = parseFloat($('#berat').val());

            if (!isNaN(totalBeratGradingtest) && !isNaN(beratAdding) && beratAdding !== 0) {
                let nilaiSusut = (1 - totalBeratGradingtest / beratAdding).toFixed(4);
                console.log(totalBeratGradingtest);
                console.log(beratAdding);
                // nilaiSusut = nilaiSusut.toFixed(4);
                console.log(nilaiSusut);
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

        let dataArray = [];

        function addRow() {

            // Mengambil nilai dari input
            let nomor_grading = $('#nomor_grading').val();
            let nomor_batch = $('#nomor_batch').val();
            let id_box_raw_material = $('#id_box_raw_material').val();
            let nomor_nota_internal = $('#nomor_nota_internal').val();
            let nama_supplier = $('#nama_supplier').val();
            let jenis_raw_material = $('#jenis_raw_material').val();
            let berat = $('#berat').val();
            let kadar_air = $('#kadar_air').val();
            let modal = $('#modal').val();
            let total_modal = $('#total_modal').val();
            let jenis_grading = $('#jenis_grading').val().split(',');
            let harga_estimasi = $('#harga_estimasi').val();
            let berat_grading = $('#berat_grading').val();
            let pcs_grading = $('#pcs_grading').val();
            let keterangan = $('#keterangan').val();
            let total_susut = $('#total_susut').val();
            let total_berat = $('#total_berat').val();
            let total_pcs = $('#total_pcs').val();

            // Validasi input (sesuai kebutuhan)
            if (!nomor_grading || !nomor_batch) {
                alert('Nomor Grading and nomor_batch are required.');
                return;
            }

            // Memanggil fungsi generateNomorBSTB untuk mendapatkan nomor_bstb
            // let nomor_bstb = generateNomorBSTB(inisial_tujuan);
            let susut = hitungNilaiSusut();
            console.log("Susut = " + susut);
            let id_box_grading_kasar = generateIdBoxGradingKasar();
            let biaya_produksi = 0;
            console.log("Harga Estimasi = " + harga_estimasi);

            // TOTAL Berat
            let totalBeratGrading = parseFloat($('#berat_grading').val()) || 0;

            $('#dataTable tbody tr').each(function() {
                let beratGradingValue = parseFloat($(this).find('td:eq(10)').text()) || 0;

                totalBeratGrading += beratGradingValue;
            });
            console.log("Total Berat = " + totalBeratGrading);
            // Total Pcs
            // Inisialisasi variabel untuk menyimpan total pcs_grading
            let totalPcsGrading = parseFloat($('#pcs_grading').val()) || 0;

            // Loop melalui setiap baris tabel untuk menghitung total pcs_grading
            $('#dataTable tbody tr').each(function() {
                // Ambil nilai dari kolom pcs_grading dalam setiap baris
                let pcsGradingValue = parseFloat($(this).find('td:eq(11)').text()) || 0;

                // Tambahkan nilai pcs_grading ke totalPcsGrading
                totalPcsGrading += pcsGradingValue;
            });
            console.log("Total Pcs = " + totalPcsGrading);

            //
            let newRow = '<tr>' +
                '<td class="text-center">' + nomor_grading + '</td>' +
                '<td class="text-center">' + id_box_raw_material + '</td>' +
                '<td class="text-center">' + id_box_grading_kasar + '</td>' +
                '<td class="text-center">' + nomor_batch + '</td>' +
                '<td class="text-center">' + nama_supplier + '</td>' +
                '<td class="text-center">' + nomor_nota_internal + '</td>' +
                '<td class="text-center">' + jenis_raw_material + '</td>' +
                '<td class="text-center">' + berat + '</td>' +
                '<td class="text-center">' + kadar_air + '</td>' +
                '<td class="text-center">' + jenis_grading[0] + '</td>' +
                '<td class="text-center">' + berat_grading + '</td>' +
                '<td class="text-center">' + pcs_grading + '</td>' +
                '<td class="text-center">' + susut + '</td>' +
                '<td class="text-center">' + modal + '</td>' +
                '<td class="text-center">' + total_modal + '</td>' +
                '<td class="text-center">' + keterangan + '</td>' +
                '<td class="text-center"><button class="btn btn-danger" onclick="hapusBaris(this)">Delete</button></td>' +
                '</tr>';

            $('#dataTable tbody').append(newRow);
            $('#total_pcs').val(totalPcsGrading);
            $('#total_berat').val(totalBeratGrading);

            $('#dataTable tbody tr').each(function() {
                let totalSusutValue = parseInt($(this).find('td:eq(12)').text()) || 0;
                // console.log(susut);
                susut += totalSusutValue;
                // console.log('Total = ' + totalSusutValue);
                $('#total_susut').val(susut);
            });

            console.log('Total Susut: ' + susut);

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
                susut: susut,
                modal: modal,
                total_modal: total_modal,
                biaya_produksi: 0,
                harga_estimasi: harga_estimasi,
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
                // user_created: user_created,
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
            $('#jenis').val('');
            $('#berat_grading').val('');
            $('#pcs_grading').val('');
            $('#keterangan').val('');
            // $('#total_susut').val();
            // $('#total_berat').val();
            // $('#total_pcs').val();
        }

        //
        function hapusBaris(button) {
            // Dapatkan elemen baris terkait dengan tombol delete yang diklik
            let row = $(button).closest('tr');

            let pcsToRemove = parseFloat(row.find('td:eq(11)').text());
            let beratToRemove = parseFloat(row.find('td:eq(10)').text());
            let susutToRemove = parseFloat(row.find('td:eq(12)').text());

            // Hapus baris dari dataArray berdasarkan indeks baris di tabel
            let rowIndex = row.index();
            dataArray.splice(rowIndex, 1);

            // Hapus baris dari tabel
            row.remove();
            // Kurangkan nilai dari total_pcs dan total_berat
            total_pcs -= pcsToRemove;
            total_berat -= beratToRemove;
            total_susut -= susutToRemove;
            // Panggil ulang fungsi hitungNilaiSusut setelah menghapus baris
            hitungNilaiSusut();
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
                    title: 'Warning!',
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
                        title: 'Success!',
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
                        title: 'Failed!',
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
