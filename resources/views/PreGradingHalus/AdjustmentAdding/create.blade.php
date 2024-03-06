@extends('layouts.master1')
@section('menu')
    Adjustment Adding
@endsection
@section('title')
    Adjustment Adding
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card mt-2 border border-primary border-3">
            <div class="card-header">
                <div class="d-flex align-items-center mb-3">
                    <h4 class="card-title">Adjustment Adding</h4>
                </div>
                <hr>
                <form method="POST" class="row g-3" id="myForm">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="basic-usage" class="form-label">ID Box Grading Halus</label>
                            <select class="select2 form-select" style="width: 100%;" name="id_box_grading_halus"
                                id="id_box_grading_halus" placeholder="Pilih ID Box Grading Halus">
                                <option value="">Pilih ID Box Grading Halus</option>
                                @foreach ($grading_halus_stocks as $GradingHS)
                                    <option value="{{ $GradingHS->id_box_grading_halus }}">
                                        {{ $GradingHS->id_box_grading_halus }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>Plant</label>
                        <select class="select2 form-select" style="width: 100%;" name="plant" id="plant"
                            placeholder="Pilih ID Box Grading Halus">
                            <option value="">Pilih Plant</option>
                            @foreach ($perusahaan as $Perusahaans)
                                <option value="{{ $Perusahaans->plant }}">
                                    {{ $Perusahaans->plant }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="nomor_adjustment" class="form-label">Nomor Adjustment</label>
                        <input type="text" class="form-control" id="nomor_adjustment">
                    </div>
                    <div class="col-md-6">
                        <label for="nomor_batch" class="form-label">Nomor Batch</label>
                        <input type="text" class="form-control" id="nomor_batch" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="jenis_adding" class="form-label">Jenis Adding</label>
                        <input type="text" class="form-control" id="jenis_adding" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="sisa_berat" class="form-label">Sisa Berat</label>
                        <input type="text" class="form-control" id="sisa_berat" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="sisa_pcs" class="form-label">Sisa Pcs</label>
                        <input type="text" class="form-control" id="sisa_pcs" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="berat_adding" class="form-label">Berat Adding</label>
                        <input type="text" class="form-control" id="berat_adding">
                    </div>
                    <div class="col-md-4">
                        <label for="pcs_adding" class="form-label">Pcs Adding</label>
                        <input type="text" class="form-control" id="pcs_adding">
                    </div>
                    <div class="col-md-4">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan">
                    </div>
                    <div class="col-md-3">
                        <label for="modal" class="form-label">Modal</label>
                        <input type="text" class="form-control" id="modal" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="total_modal" class="form-label">Total Modal</label>
                        <input type="text" class="form-control" id="total_modal" readonly>
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
                                <th scope="col" class="text-center">ID Box Grading Halus</th>
                                <th scope="col" class="text-center">Nomor Adjustment</th>
                                <th scope="col" class="text-center">Nomor Batch</th>
                                <th scope="col" class="text-center">Jenis Adding</th>
                                <th scope="col" class="text-center">Berat Adding</th>
                                <th scope="col" class="text-center">Pcs Adding</th>
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
            let sisaBeratAwal; // Variabel untuk menyimpan nilai awal berat adding
            let sisaPcsAwal
            $('#id_box_grading_halus').on('change', function() {
                // Mengambil nilai id_box yang dipilih
                $('#berat_adding').val('');
                $('#pcs_adding').val('');
                let selectedIdBoxGradingHalus = $(this).val();
                // Melakukan permintaan AJAX ke controller untuk mendapatkan nomor batch
                $.ajax({
                    url: `{{ route('AdjustmentAdding.set') }}`,
                    method: 'GET',
                    data: {
                        id_box_grading_halus: selectedIdBoxGradingHalus
                    },
                    success: function(response) {
                        console.log(response);
                        // Mengatur nilai Nomor Batch sesuai dengan respons dari server
                        $('#nomor_batch').val(response.nomor_batch);
                        $('#jenis_adding').val(response.jenis);
                        $('#sisa_berat').val(response.sisa_berat);
                        $('#sisa_pcs').val(response.sisa_pcs);
                        $('#modal').val(response.modal);
                        sisaBeratAwal = parseFloat(response.sisa_berat);
                        sisaPcsAwal = parseFloat(response.sisa_pcs);
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            });

            // Event untuk menghitung stok pada perubahan nilai berat grading
            $('#berat_adding').on('input', function() {
                let beratGrading = parseFloat($(this).val());
                if (!isNaN(beratGrading)) {
                    if (beratGrading > sisaBeratAwal) {
                        // Menampilkan alert jika berat grading melebihi berat awal
                        Swal.fire({
                            title: 'Warning!',
                            text: "Berat Adding tidak boleh melebihi Sisa Berat.",
                            icon: 'warning'
                        });
                        $(this).val(''); // Mengosongkan nilai input
                        return;
                    }
                    let sisaBerat = sisaBeratAwal - beratGrading;
                    if (sisaBerat < 0) {
                        sisaBerat = 0; // Menghindari stok negatif
                    }
                    // Mengatur nilai sisa berat pada #berat_adding
                    $('#sisa_berat').val(sisaBerat);
                } else {
                    // Jika #berat_grading kosong, kembalikan ke nilai awal
                    $('#sisa_berat').val(sisaBeratAwal);
                }
            });

            // Event untuk mengembalikan nilai berat adding ke nilai awal jika nilai berat grading dihapus
            $('#berat_adding').on('change', function() {
                if ($(this).val() === '') {
                    $('#sisa_berat').val(sisaBeratAwal);
                    // Mengembalikan nilai berat adding ke nilai awalnya
                }
            });
            // Sisa PCS
            // Event untuk menghitung stok pada perubahan Sisa PCS
            $('#pcs_adding').on('input', function() {
                let pcsAdding = parseFloat($(this).val());
                if (!isNaN(pcsAdding)) {
                    if (pcsAdding > sisaPcsAwal) {
                        Swal.fire({
                            title: 'Warning!',
                            text: "Pcs Adding tidak boleh melebihi Sisa Pcs.",
                            icon: 'warning'
                        });
                        $(this).val(''); // Mengosongkan nilai input
                        return;
                    }
                    let sisaPcs = sisaPcsAwal - pcsAdding;
                    if (sisaPcs < 0) {
                        sisaPcs = 0; // Menghindari stok negatif
                    }
                    $('#sisa_pcs').val(sisaPcs);
                } else {
                    $('#sisa_pcs').val(sisaPcsAwal);
                }
            });

            // Event untuk mengembalikan nilai berat adding ke nilai awal jika nilai berat grading dihapus
            $('#pcs_adding').on('change', function() {
                if ($(this).val() === '') {
                    $('#sisa_pcs').val(sisaPcsAwal);
                    // Mengembalikan nilai berat adding ke nilai awalnya
                }
            });
        });
        $(document).ready(function() {
            // Menangani perubahan pada dropdown nomor_job
            $('#plant').on('change', function() {
                // Memanggil fungsi generateNomorGrading ketika nomor_job berubah
                generateNomorAdjustment();
            });

            // Fungsi untuk generate nomor_bstb
            function generateNomorAdjustment() {
                const now = new Date();
                const tahun = now.getFullYear().toString().substr(-2);
                const bulan = ('0' + (now.getMonth() + 1)).slice(-2);
                const tanggal = ('0' + now.getDate()).slice(-2);
                const jam = ('0' + now.getHours()).slice(-2);
                const menit = ('0' + now.getMinutes()).slice(-2);
                const detik = ('0' + now.getSeconds()).slice(-2);

                // Mengambil nilai dari dropdown nomor_job
                const plant = $('#plant').val();

                // Menghasilkan nomor_bstb berdasarkan rumus yang diinginkan
                const nomor_adjustment = `ADJ_${tanggal}${bulan}${tahun}_${jam}${menit}${detik}_${plant}_UGH`;

                // Memasukkan nilai yang dihasilkan ke dalam input nomor_bstb
                $('#nomor_adjustment').val(nomor_adjustment);
                console.log(nomor_adjustment);
            }
        });

        // Fungsi untuk menghitung total modal
        function calculateTotalModal() {
            // Mengambil nilai berat adding
            let beratAdding = parseFloat($('#berat_adding').val()) || 0;
            // Mengambil nilai modal
            let modal = parseFloat($('#modal').val()) || 0;
            // Menghitung total modal
            let totalModal = beratAdding * modal;
            // Memasukkan hasil perhitungan ke dalam input total modal
            $('#total_modal').val(totalModal);
        }

        // Memanggil fungsi calculateTotalModal setiap kali berat adding berubah
        $('#berat_adding').on('input', function() {
            calculateTotalModal();
        });

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
        // Manambahkan Data Ke Table
        function addRow() {
            if (validateForm()) {
                // Mendapatkan nilai dari semua input
                let idBoxGradingHalus = $('#id_box_grading_halus').val();
                let nomorAdjustment = $('#nomor_adjustment').val();
                let nomorBatch = $('#nomor_batch').val();
                let jenisAdding = $('#jenis_adding').val();
                let beratAdding = $('#berat_adding').val();
                let pcsAdding = $('#pcs_adding').val();
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
    </script>
@endsection
