@extends('layouts.master1')
@section('menu')
    Kedatangan Output
@endsection
@section('title')
    Kedatangan Output
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card mt-2 border border-primary border-3">
            <div class="card-header">
                <div class="d-flex align-items-center mb-3">
                    <h4 class="card-title">Kedatangan Output</h4>
                </div>
                <hr>
                <form method="POST" class="row g-3" id="myForm">
                    <div class="col-md-4">
                        <label for="basic-usage" class="form-label">Nomor Batch</label>
                        <select class="select2 form-select" style="width: 100%;" name="nomor_batch" id="nomor_batch"
                            data-placeholder="Pilih Nomor Batch">
                            <option value="">Pilih Nomor Batch</option>
                            @foreach ($master_batch as $item)
                                <option value="{{ $item->nomor_batch }}">
                                    {{ $item->nomor_batch }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="basic-usage" class="form-label">Tujuan Kirim</label>
                        <select class="select2 form-select" style="width: 100%;" name="tujuan_kirim" id="tujuan_kirim"
                            data-placeholder="Pilih Tujuan Kirim">
                            <option value="">Pilih Tujuan Kirim</option>
                            @foreach ($master_tujuan_kirim_kedatangan as $item)
                                <option value="{{ $item->tujuan_kirim }}">
                                    {{ $item->tujuan_kirim }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="basic-usage" class="form-label">Jenis</label>
                        <select class="select2 form-select" style="width: 100%;" name="jenis" id="jenis"
                            data-placeholder="Pilih Jenis">
                            <option value="">Pilih Jenis</option>
                            @foreach ($master_jenis_kedatangan as $item)
                                <option value="{{ $item->jenis }}">
                                    {{ $item->jenis }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="berat" class="form-label">Berat</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="berat">
                    </div>

                    <div class="col-md-4">
                        <label for="pcs" class="form-label">Pcs</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="pcs">
                    </div>

                    <div class="col-md-4">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan">
                    </div>

                    <div class="col-md-4">
                        <label for="nomor_job" class="form-label">Nomor Job</label>
                        <input type="text" class="form-control" id="nomor_job" readonly>
                    </div>

                    <div class="col-md-4">
                        <label for="nomor_bstb" class="form-label">Nomor BSTB</label>
                        <input type="text" class="form-control" id="nomor_bstb" readonly>
                    </div>

                    <div class="col-md-4">
                        <label for="user_created" class="form-label">NIP Admin</label>
                        <input type="text" class="form-control" id="user_created" readonly
                            value="{{ auth()->user()->nip }}">
                    </div>

                    <div class="col-12">
                        <button type="button" class="btn btn-primary" id="tambah_data" onclick="addRow()">Tambah</button>
                        <a href="{{ Route('KedatanganOutput.index') }}" type="button" class="btn btn-danger">Close</a>
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
                                <th scope="col" class="text-center">Nomor Batch</th>
                                <th scope="col" class="text-center">Jenis</th>
                                <th scope="col" class="text-center">Tujuan Kirim</th>
                                <th scope="col" class="text-center">Berat</th>
                                <th scope="col" class="text-center">Pcs</th>
                                <th scope="col" class="text-center">Nomor Job</th>
                                <th scope="col" class="text-center">Nomor BSTB</th>
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
            let selectedTujuanKirim = '';
            let selectedInisialTujuan = '';
            let berat = '';
            // Get Batch
            $('#nomor_batch').on('change', function() {
                selectedNomorBatch = $(this).val();

                $.ajax({
                    url: '{{ route('KedatanganOutput.setBatch') }}',
                    method: 'GET',
                    data: {
                        nomor_batch: selectedNomorBatch
                    },
                    success: function(response) {
                        console.log(response);

                        // Mengatur nilai sesuai dengan respons dari server
                        $('#nomor_batch').val(response.nomor_batch);
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            });
            // Get Jenis
            $('#jenis').on('change', function() {
                selectedJenis = $(this).val();

                $.ajax({
                    url: '{{ route('KedatanganOutput.setJenis') }}',
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
                        $('#harga_estimasi').val(response.harga_estimasi);
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            });
            // Get Tujuan Kirim
            // $('#tujuan_kirim').on('change', function() {
            //     selectedTujuanKirim = $(this).val();

            //     $.ajax({
            //         url: '{{ route('KedatanganOutput.setTujuanKirim') }}',
            //         method: 'GET',
            //         data: {
            //             tujuan_kirim: selectedTujuanKirim
            //         },
            //         success: function(response) {
            //             console.log(response);

            //             // Mengatur nilai sesuai dengan respons dari server
            //             $('#tujuan_kirim').val(response.tujuan_kirim);
            //             let selectedInisialTujuan = response.inisial_tujuan;

            //             generateNomorBSTB(selectedInisialTujuan);
            //             generateNomorJob(selectedInisialTujuan);
            //         },
            //         error: function(error) {
            //             console.error('Error:', error);
            //         }
            //     });
            // });

            $('#tujuan_kirim').on('change', function() {
                selectedTujuanKirim = $(this).val();
                if (selectedTujuanKirim && berat) {
                    generate();
                } else {
                    $('#nomor_bstb').val('');
                }
            });

            $('#berat').on('input', function() {
                berat = $(this).val();
                if (selectedTujuanKirim && berat) {
                    generate();
                } else {
                    $('#nomor_bstb').val('');
                }
            });

            function generate() {
                $.ajax({
                    url: '{{ route('KedatanganOutput.setTujuanKirim') }}',
                    method: 'GET',
                    data: {
                        tujuan_kirim: selectedTujuanKirim
                    },
                    success: function(response) {
                        selectedInisialTujuan = response.inisial_tujuan;
                        generateNomorBSTB(selectedInisialTujuan);
                        generateNomorJob(selectedInisialTujuan);
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            }

            // Generate Nomor BSTB
            function generateNomorBSTB(selectedInisialTujuan) {
                const now = new Date();
                const tahun = now.getFullYear().toString().substr(-2);
                const bulan = ('0' + (now.getMonth() + 1)).slice(-2);
                const tanggal = ('0' + now.getDate()).slice(-2);
                const jam = ('0' + now.getHours()).slice(-2);
                const menit = ('0' + now.getMinutes()).slice(-2);
                const detik = ('0' + now.getSeconds()).slice(-2);

                const nomorBSTB =
                    `BSTB_${tanggal}${bulan}${tahun}-${jam}${menit}${detik}_UKD_${selectedInisialTujuan}`;
                $('#nomor_bstb').val(nomorBSTB);
                return nomorBSTB;
            }
            // Generate Nomor Job
            function generateNomorJob(selectedInisialTujuan) {
                const now = new Date();
                const tahun = now.getFullYear().toString().substr(-2);
                const bulan = ('0' + (now.getMonth() + 1)).slice(-2);
                const tanggal = ('0' + now.getDate()).slice(-2);
                const jam = ('0' + now.getHours()).slice(-2);
                const menit = ('0' + now.getMinutes()).slice(-2);
                const detik = ('0' + now.getSeconds()).slice(-2);

                const nomorJob =
                    `${tanggal}${bulan}${tahun}-${jam}${menit}${detik}_UKD_${selectedInisialTujuan}`;
                $('#nomor_job').val(nomorJob);
                return nomorJob;
            }
        });

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
            if (!id_box_grading_warna) emptyFields.push('ID Box Kedatangan Output');
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
