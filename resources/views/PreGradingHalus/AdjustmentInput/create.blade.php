@extends('layouts.master1')
@section('menu')
    Adjustment Input
@endsection
@section('title')
    Adjustment Input
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card mt-2 border border-primary border-3">
            <div class="card-header">
                <div class="d-flex align-items-center mb-3">
                    <h4 class="card-title">Adjustment Input</h4>
                </div>
                <hr>
                <form method="POST" class="row g-3" id="myForm">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="basic-usage" class="form-label">Nomor Adjustment</label>
                            <select class="select2 form-select" style="width: 100%;" name="nomor_adjustment"
                                id="nomor_adjustment" placeholder="Pilih Nomor Adjustment">
                                <option value="">Pilih Nomor Adjustment</option>
                                @foreach ($adjustment_inputs as $ADJI)
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
                        <input type="text" class="form-control" id="berat_adding" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="pcs_adding" class="form-label">Pcs Adding</label>
                        <input type="text" class="form-control" id="pcs_adding" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="modal" class="form-label">Modal</label>
                        <input type="text" class="form-control" id="modal" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="total_modal" class="form-label">Total Modal</label>
                        <input type="text" class="form-control" id="total_modal" readonly>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="basic-usage" class="form-label">Jenis Adjustment</label>
                            <select class="select2 form-select" style="width: 100%;" name="jenis_adjustment"
                                id="jenis_adjustment" placeholder="Pilih Jenis Adjustment">
                                <option value="">Pilih Jenis Adjustment</option>
                                @foreach ($master_jenis_grading_halus as $MasterJGH)
                                    <option value="{{ $MasterJGH->jenis }}">
                                        {{ $MasterJGH->jenis }}
                                    </option>
                                @endforeach
                            </select>
                            <input type="hidden" id="harga_estimasi" name="harga_estimasi">
                            <input type="hidden" id="pengurangan_harga" name="pengurangan_harga">
                            <input type="hidden" id="id_box_grading_halus" name="id_box_grading_halus">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="kategori_susut" class="form-label">Kategori Susut</label>
                        <input type="text" class="form-control" id="kategori_susut" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="berat_adjustment" class="form-label">Berat Adjustment</label>
                        <input type="text" class="form-control" id="berat_adjustment">
                    </div>
                    <div class="col-md-4">
                        <label for="pcs_adjustment" class="form-label">Pcs Adjustment</label>
                        <input type="text" class="form-control" id="pcs_adjustment">
                    </div>
                    <div class="col-md-4">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan">
                    </div>
                    <div class="col-md-3">
                        <label for="susut_depan" class="form-label">Susut Depan</label>
                        <input type="text" class="form-control" id="susut_depan" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="susut_belakang" class="form-label">Susut Belakang</label>
                        <input type="text" class="form-control" id="susut_belakang" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="total_berat" class="form-label">Total Berat</label>
                        <input type="text" class="form-control" id="total_berat" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="total_pcs" class="form-label">Total Pcs</label>
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
        <div class="card mt-2 border border-primary border-3">
            <div class="card-header">
                <div class="card-body" style="overflow: scroll">
                    <table class="table" id="dataTable">
                        <thead>
                            <tr>
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
                    url: `{{ route('AdjustmentAdding.getNomorAdjustment') }}`,
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
                    url: `{{ route('AdjustmentAdding.getJenisGradingHalus') }}`,
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
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            });
            // Id Box Grading Halus
            $('#nomor_batch, #jenis_adjustment').on('change', function() {
                // Mengambil nilai nomor batch dan jenis adjustment yang dipilih
                let selectedNomorBatch = $('#nomor_batch').val();
                let selectedJenis = $('#jenis_adjustment').val();

                // Membuat ID box grading halus dari nomor batch dan jenis adjustment
                let idBoxGradingHalus = selectedNomorBatch + '-' + selectedJenis;
                $('#id_box_grading_halus').val(idBoxGradingHalus);
            });
        });
        // Calculate Total Berat
        function calculateTotalBerat() {
            let totalBerat = 0;
            // Iterasi melalui setiap baris dalam tabel
            $('#dataTable tbody tr').each(function() {
                // Mendapatkan nilai berat adding dari baris saat ini dan menambahkannya ke totalBerat
                let beratAdding = parseFloat($(this).find('td:eq(4)').text()) || 0;
                totalBerat += beratAdding;
            });
            // Menampilkan total berat di input #total_berat
            $('#total_berat').val(totalBerat);
        }
        // Calculate Pcs Adjustment
        function calculateTotalPcs() {
            let totalPcs = 0;
            // Iterasi melalui setiap baris dalam tabel
            $('#dataTable tbody tr').each(function() {
                // Mendapatkan nilai pcs adding dari baris saat ini dan menambahkannya ke totalPcs
                let pcsAdding = parseFloat($(this).find('td:eq(5)').text()) || 0;
                totalPcs += pcsAdding;
            });
            // Menampilkan total pcs di input #total_pcs
            $('#total_pcs').val(totalPcs);
        }



        function validateForm() {
            // Mendefinisikan variabel untuk menyimpan kolom yang belum diisi
            let emptyFields = [];

            // Mendapatkan nilai dari semua input
            let idBoxGradingHalus = $('#id_box_grading_halus').val();
            let plant = $('#plant').val();
            let nomorAdjustment = $('#nomor_adjustment').val();
            let nomorBatch = $('#nomor_batch').val();
            let jenisAdding = $('#jenis_adding').val();
            let beratAdding = $('#berat_adding').val();
            let pcsAdding = $('#pcs_adding').val();
            let modal = $('#modal').val();
            let totalModal = $('#total_modal').val();

            // Memeriksa setiap input, dan jika kosong, tambahkan ke daftar kolom yang belum diisi
            if (!idBoxGradingHalus) emptyFields.push('ID Box Grading Halus');
            if (!plant) emptyFields.push('Plant');
            if (!nomorAdjustment) emptyFields.push('Nomor Adjustment');
            if (!nomorBatch) emptyFields.push('Nomor Batch');
            if (!jenisAdding) emptyFields.push('Jenis Adding');
            if (!beratAdding) emptyFields.push('Berat Adding');
            if (!pcsAdding) emptyFields.push('Pcs Adding');
            if (!modal) emptyFields.push('Modal');
            if (!totalModal) emptyFields.push('Total Modal');

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
                // let idBoxGradingHalus = $('#id_box_grading_halus').val();
                let nomorAdjustment = $('#nomor_adjustment').val();
                let nomorBatch = $('#nomor_batch').val();
                let jenisAdding = $('#jenis_adjustment').val();
                let beratAdding = $('#berat_adding').val();
                let pcsAdding = $('#pcs_adding').val();
                let beratAdjustment = $('#berat_adjustment').val();
                let pcsAdjustment = $('#pcs_adjustment').val();
                let keterangan = $('#keterangan').val();
                let modal = $('#modal').val();
                let totalModal = $('#total_modal').val();

                // Membuat baris HTML baru untuk ditambahkan ke tabel
                let newRow = `<tr>` +
                    `<td class='text-center'>${idBoxGradingHalus}</td>` +
                    `<td class='text-center'>${nomorAdjustment}</td>` +
                    `<td class='text-center'>${nomorBatch}</td>` +
                    `<td class='text-center'>${jenisAdding}</td>` +
                    `<td class='text-center'>${beratAdding}</td>` +
                    `<td class='text-center'>${pcsAdding}</td>` +
                    `<td class='text-center'>${keterangan}</td>` +
                    `<td class='text-center'>${modal}</td>` +
                    `<td class='text-center'>${totalModal}</td>` +
                    `<td class='text-center'><button type='button' class='btn btn-danger' onclick='deleteRow(this)'>Delete</button></td>` +
                    `</tr>`;

                // Menambahkan baris baru ke dalam tabel
                $('#dataTable tbody').append(newRow);

                dataArray.push({

                    id_box_grading_halus: idBoxGradingHalus,
                    nomor_adjustment: nomorAdjustment,
                    nomor_batch: nomorBatch,
                    jenis_adding: jenisAdding,
                    berat_adding: beratAdding,
                    pcs_adding: pcsAdding,
                    sisa_berat: sisaBerat,
                    sisa_pcs: sisaPcs,
                    keterangan: keterangan,
                    modal: modal,
                    total_modal: totalModal
                });

                // Mengosongkan nilai input formulir
                $('#id_box_grading_halus, #plant').val(null).trigger('change');
                $('#plant').val(null).trigger('change');
                $('#nomor_adjustment').val('');
                $('#nomor_batch').val('');
                $('#jenis_adding').val('');
                $('#sisa_berat').val('');
                $('#sisa_pcs').val('');
                $('#berat_adding').val('');
                $('#pcs_adding').val('');
                $('#keterangan').val('');
                $('#modal').val('');
                $('#total_modal').val('');

                calculateTotalBerat();
                calculateTotalPcs();

            }
        }

        function deleteRow(btn) {
            // Menghapus baris dari tabel
            $(btn).closest('tr').remove();
            calculateTotalBerat();
            calculateTotalPcs();
        }

        function simpanData() {
            console.log(dataArray);
            // Cek apakah data kosong
            if (dataArray.length === 0) {
                // Menampilkan SweetAlert untuk pesan error
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Data dalam tabel masih kosong. Silakan tambahkan data terlebih dahulu.'
                });
                return; // Menghentikan eksekusi fungsi jika data kosong
            }
            // Mengirim data ke server menggunakan AJAX
            $.ajax({
                url: `{{ route('AdjustmentAdding.simpanData') }}`,
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
                        title: 'Success',
                        text: 'Data berhasil dikirim.'
                    });

                    // Redirect atau lakukan tindakan lain setelah berhasil
                    window.location.href = `{{ route('AdjustmentAdding.index') }}`;
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
