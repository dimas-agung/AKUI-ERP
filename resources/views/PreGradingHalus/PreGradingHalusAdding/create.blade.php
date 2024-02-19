@extends('layouts.master1')
@section('menu')
    Pre Grading Halus Adding
@endsection
@section('title')
    Pre Grading Halus Adding
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card mt-2">
            <div class="card-header">
                <div class="d-flex align-items-center mb-3">
                    <h4 class="card-title">Pre Grading Halus Adding</h4>
                </div>
                <hr>
                <form method="POST" class="row g-3" id="myForm">
                    <div class="col-md-12">
                        <label for="basic-usage" class="form-label">Nomor Job</label>
                        <select class="select2 form-select" style="width: 100%;" name="nomor_job" id="nomor_job"
                            placeholder="Pilih Nomor Job">
                            <option value="">Pilih Nomor Job</option>
                            @foreach ($pre_grading_halus_stocks as $PreGHS)
                                <option value="{{ $PreGHS->nomor_job }}">
                                    {{ $PreGHS->nomor_job }}
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
                        <input type="text" class="form-control" id="kadar_air" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="berat_kirim" class="form-label">Berat Kirim</label>
                        <input type="text" class="form-control" id="berat_kirim" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="pcs_kirim" class="form-label">Pcs Kirim</label>
                        <input type="text" class="form-control" id="pcs_kirim" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="modal" class="form-label">Modal</label>
                        <input type="text" class="form-control" id="modal" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="total_modal" class="form-label">Total Modal</label>
                        <input type="text" class="form-control" id="total_modal" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="susut" class="form-label">Total Box</label>
                        <input type="text" class="form-control" id="total_box" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="susut" class="form-label">Total Berat</label>
                        <input type="text" class="form-control" id="total_berat" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="susut" class="form-label">Total Pcs</label>
                        <input type="text" class="form-control" id="total_pcs" readonly>
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
        <div class="card mt-2">
            <div class="card-header">
                <div class="card-body" style="overflow: scroll">
                    <table class="table" id="dataTable">
                        <thead>
                            <tr>
                                {{-- <th scope="col" class="text-center">No</th> --}}
                                <th scope="col" class="text-center">Nomor Job</th>
                                <th scope="col" class="text-center">ID Box Grading Kasar</th>
                                <th scope="col" class="text-center">ID Box Raw Material</th>
                                <th scope="col" class="text-center">Nomor Batch</th>
                                <th scope="col" class="text-center">Nomor Nota Internal</th>
                                <th scope="col" class="text-center">Nama Supplier</th>
                                <th scope="col" class="text-center">Jenis Raw Material</th>
                                <th scope="col" class="text-center">Kadar Air</th>
                                <th scope="col" class="text-center">Jenis Kirim</th>
                                <th scope="col" class="text-center">Berat Kirim</th>
                                <th scope="col" class="text-center">Pcs Kirim</th>
                                <th scope="col" class="text-center">Tujuan Kirim</th>
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


        $(document).ready(function() {
            // Menangani perubahan pada dropdown nomor_job
            $('#nomor_job').on('change', function() {
                // Memanggil fungsi generateNomorGrading ketika nomor_job berubah
                generateNomorGrading();
            });

            // Fungsi untuk generate nomor_bstb
            function generateNomorGrading() {
                const now = new Date();
                const tahun = now.getFullYear().toString().substr(-2);
                const bulan = ('0' + (now.getMonth() + 1)).slice(-2);
                const tanggal = ('0' + now.getDate()).slice(-2);
                const jam = ('0' + now.getHours()).slice(-2);
                const menit = ('0' + now.getMinutes()).slice(-2);
                const detik = ('0' + now.getSeconds()).slice(-2);

                // Mengambil nilai dari dropdown nomor_job
                const nomorJobValue = $('#nomor_job').val().split('_');

                // Mengambil bagian ketiga (indeks 2) dari array hasil split
                const bagianKetiga = nomorJobValue[2][0];

                // Menghasilkan nomor_bstb berdasarkan rumus yang diinginkan
                const nomor_grading = `NG_${tanggal}${bulan}${tahun}_${jam}${menit}${detik}_${bagianKetiga}_UGH`;

                // Memasukkan nilai yang dihasilkan ke dalam input nomor_bstb
                $('#nomor_grading').val(nomor_grading);
                console.log(nomor_grading);
            }
        });

        let dataArray = [];
        // ADD ROW
        function addRow() {
            // Mengambil nilai dari input
            let nomor_job = $('#nomor_job').val();
            let id_box_grading_kasar = $('#id_box_grading_kasar').val();
            let nomor_bstb = $('#nomor_bstb').val();
            let id_box_raw_material = $('#id_box_raw_material').val();
            let nomor_batch = $('#nomor_batch').val();
            let nomor_nota_internal = $('#nomor_nota_internal').val();
            let nama_supplier = $('#nama_supplier').val();
            let jenis_raw_material = $('#jenis_raw_material').val();
            let jenis_kirim = $('#jenis_kirim').val();
            let tujuan_kirim = $('#tujuan_kirim').val();
            let modal = $('#modal').val();
            let total_modal = $('#total_modal').val();
            let kadar_air = $('#kadar_air').val();
            let pcs_kirim = $('#pcs_kirim').val();
            let berat_kirim = $('#berat_kirim').val();
            let berat_pre_cleaning = $('#berat_precleaning').val();
            let pcs_pre_cleaning = $('#pcs').val();
            let susut = $('#susut').val();
            let susutTabel = parseFloat(susut).toFixed(2);
            susutTabel = susutTabel.replace('.', '');
            susutTabel = susutTabel.padStart(4, '0');

            // Validasi input (sesuai kebutuhan)
            if (!nomor_job || !id_box_grading_kasar) {
                alert('Nomor Job Dan ID Box Grading Kasar Required.');
                return;
            }

            let newRow = '<tr>' +
                '<td class="text-center">' + nomor_job + '</td>' +
                '<td class="text-center">' + id_box_grading_kasar + '</td>' +
                '<td class="text-center">' + id_box_raw_material + '</td>' +
                '<td class="text-center">' + nomor_batch + '</td>' +
                '<td class="text-center">' + nomor_nota_internal + '</td>' +
                '<td class="text-center">' + nama_supplier + '</td>' +
                '<td class="text-center">' + jenis_raw_material + '</td>' +
                '<td class="text-center">' + kadar_air + '</td>' +
                '<td class="text-center">' + jenis_kirim + '</td>' +
                '<td class="text-center">' + berat_kirim + '</td>' +
                '<td class="text-center">' + pcs_kirim + '</td>' +
                '<td class="text-center">' + tujuan_kirim + '</td>' +
                '<td class="text-center">' + modal + '</td>' +
                '<td class="text-center">' + total_modal + '</td>' +
                // '<td class="text-center">' + "sisa_berat" + '</td>' +
                '<td class="text-center"><button class="btn btn-danger" onclick="hapusBaris(this)">Delete</button></td>' +
                '</tr>';
            // Tambahkan Kedalam Tabel
            $('#dataTable tbody').append(newRow);

            let totalPcsKirim = 0;
            $('#dataTable tbody tr').each(function() {
                let pcsKirim = parseFloat($(this).find('td:eq(10)')
                    .text()); // Ganti angka 10 dengan indeks kolom berat_kirim dalam tabel
                if (!isNaN(pcsKirim)) {
                    totalPcsKirim += pcsKirim;
                }
            });

            $('#total_pcs').val(totalPcsKirim);

            let totalBeratKirim = 0;
            $('#dataTable tbody tr').each(function() {
                let beratKirim = parseFloat($(this).find('td:eq(9)')
                    .text()); // Ganti angka 10 dengan indeks kolom berat_kirim dalam tabel
                if (!isNaN(beratKirim)) {
                    totalBeratKirim += beratKirim;
                }
            });

            $('#total_berat').val(totalBeratKirim);

            let jumlahBaris = $('#dataTable tbody tr').length;
            // Tampilkan Jumlah Baris di Input dengan ID "total_box"
            $('#total_box').val(jumlahBaris);

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
                // user_created: user_created,
                // user_updated: user_updated,
            });

            // Mengosongkan nilai dropdown nomor_job
            $('#nomor_job, #id_box_grading_kasar, #nomor_grading, #id_box_raw_material, #nomor_batch, #nomor_nota_internal, #nama_supplier, #jenis_raw_material, #jenis_kirim, #tujuan_kirim, #modal, #total_modal, #kadar_air, #pcs_kirim, #berat_kirim, #operator_sikat_dan_kompresor, #operator_flex_dan_poles, #operator_cutter, #kuningan, #Sterofoam, #karat, #rontokan_flex, #rontokan_bahan,#rontokan_serabut, #ws, #berat_precleaning, #pcs, #susut')
                .val('');

        }

        function hapusBaris(button) {
            // Dapatkan elemen baris terkait dengan tombol delete yang diklik
            let row = $(button).closest('tr');

            // Hapus baris dari dataArray berdasarkan indeks baris di tabel
            let rowIndex = row.index();
            dataArray.splice(rowIndex, 1);
            // Hapus baris dari tabel
            row.remove();
            // Total Berat
            let totalBeratKirim = 0;
            $('#dataTable tbody tr').each(function() {
                let beratKirim = parseFloat($(this).find('td:eq(9)')
                    .text()); // Ganti angka 10 dengan indeks kolom berat_kirim dalam tabel
                if (!isNaN(beratKirim)) {
                    totalBeratKirim += beratKirim;
                }
            });
            $('#total_berat').val(totalBeratKirim);
            // Total Pcs
            let totalPcsKirim = 0;
            $('#dataTable tbody tr').each(function() {
                let pcsKirim = parseFloat($(this).find('td:eq(10)')
                    .text()); // Ganti angka 10 dengan indeks kolom berat_kirim dalam tabel
                if (!isNaN(pcsKirim)) {
                    totalPcsKirim += pcsKirim;
                }
            });
            $('#total_pcs').val(totalPcsKirim);

            let jumlahBaris = $('#dataTable tbody tr').length;
            $('#total_box').val(jumlahBaris);
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
