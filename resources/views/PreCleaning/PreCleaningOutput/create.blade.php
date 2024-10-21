@extends('layouts.master1')
@section('menu')
    Pre Cleaning
@endsection
@section('title')
    Pre Cleaning Output
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card mt-2 border border-primary border-3">
            <div class="card-header">
                <div class="d-flex align-items-center mb-3">
                    <h4 class="card-title">Pre Cleaning Output</h4>
                </div>
                <hr>
                <form method="POST" class="row g-3" id="myForm">
                    <div class="col-md-6">
                        <label for="basic-usage" class="form-label">Nomor Job</label>
                        <select class="select2 form-select" style="width: 100%;" name="nomor_job" id="nomor_job"
                            data-placeholder="Pilih Nomor Job">
                            <option value="">Pilih Nomor Job</option>
                            @foreach ($pre_cleaning_stocks as $item)
                                <option value="{{ $item->nomor_job }}">
                                    {{ $item->nomor_job }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Plant</label>
                        <select class="select2 form-select" style="width: 100%;" name="plant" id="plant"
                            data-placeholder="Pilih Plant">
                            <option value="">Pilih Plant</option>
                            @foreach ($perusahaan as $item)
                                <option value="{{ $item->plant }}">
                                    {{ $item->plant }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <input type="hidden" class="form-control" id="id_box_grading_kasar" readonly>

                    <div class="col-md-4">
                        <label for="nomor_bstb" class="form-label">Nomor BSTB</label>
                        <input type="text" class="form-control" id="nomor_bstb">
                    </div>

                    <input type="hidden" class="form-control" id="id_box_raw_material" readonly>

                    <div class="col-md-4">
                        <label for="nomor_batch" class="form-label">Nomor Batch</label>
                        <input type="text" class="form-control" id="nomor_batch" readonly>
                    </div>

                    <input type="hidden" class="form-control" id="nomor_nota_internal" readonly>
                    <input type="hidden" class="form-control" id="nama_supplier" readonly>
                    <input type="hidden" class="form-control" id="jenis_raw_material" readonly>

                    <div class="col-md-4">
                        <label for="jenis_kirim" class="form-label">Jenis Kirim</label>
                        <input type="text" class="form-control" id="jenis_kirim" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="berat_kirim" class="form-label">Berat Kirim</label>
                        <input type="text" class="form-control" id="berat_kirim" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="pcs_kirim" class="form-label">Pcs Kirim</label>
                        <input type="text" class="form-control" id="pcs_kirim" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="tujuan_kirim" class="form-label">Tujuan Kirim</label>
                        <input type="text" class="form-control" id="tujuan_kirim" readonly>
                    </div>

                    <input type="hidden" class="form-control" id="modal" readonly>
                    <input type="hidden" class="form-control" id="total_modal" readonly>
                    <input type="hidden" class="form-control" id="kadar_air" readonly>

                    <div class="col-md-4">
                        <label for="basic-usage" class="form-label">Operator Sikat & Kompresor</label>
                        <select class="select2 form-select" style="width: 100%;" tabindex="-1" aria-hidden="true"
                            name="operator_sikat_dan_kompresor" id="operator_sikat_dan_kompresor"
                            data-placeholder="Pilih Operator Sikat & Kompresor">
                            <option value="">Pilih Operator Sikat & Kompresor</option>
                            @foreach ($master_operators->sortBy('nama') as $item)
                                @if (strpos(strtolower($item->job), 'sikat') !== false && strpos(strtolower($item->job), 'kompresor') !== false)
                                    <option value="{{ $item->nama }}">
                                        {{ $item->nama }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="basic-usage" class="form-label">Operator Flex & Poles</label>
                        <select class="select2 form-select" style="width: 100%;" name="operator_flex_dan_poles"
                            id="operator_flex_dan_poles" data-placeholder="Pilih Operator Flex & Poles">
                            <option value="">Pilih Operator Flex & Poles</option>
                            @foreach ($master_operators->sortBy('nama') as $item)
                                @if ($item->job == 'Flex + Poles' && $item->status == 1)
                                {{-- @if (strpos(strtolower($item->job), 'flek') !== false && strpos(strtolower($item->job), 'poles') !== false) --}}
                                    <option value="{{ $item->nama }}">
                                        {{ $item->nama }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="basic-usage" class="form-label">Operator Cutter</label>
                        <select class="select2 form-select" style="width: 100%;" name="operator_cutter"
                            id="operator_cutter" data-placeholder="Pilih Operator Cutter">
                            <option value="">Pilih Operator Cutter</option>
                            @foreach ($master_operators->sortBy('nama') as $item)
                                @if (strpos(strtolower($item->job), 'cutter') !== false)
                                    <option value="{{ $item->nama }}">
                                        {{ $item->nama }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="basic-usage" class="form-label">Pilih Jenis Grading</label>
                        <select class="select2 form-select" style="width: 100%;" name="jenis_grading"
                            id="jenis_grading" data-placeholder="Pilih Jenis Grading">
                            <option value="">Pilih Jenis Grading</option>
                            @foreach ($jenis_grading->sortBy('jenis') as $item)
                              
                                    <option value="{{ $item->jenis }}">
                                        {{ $item->jenis }}
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="berat_grading" class="form-label">Berat Grading</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="berat_grading">
                    </div>
                    <div class="col-md-3">
                        <label for="pcs" class="form-label">Pcs</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="pcs_grading">
                    </div>
                    <div class="col-md-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan">
                    </div>
                    <div class="col-md-3">
                        <label for="user_created" class="form-label">NIP Admin</label>
                        <input type="text" class="form-control" id="user_created" value="{{ auth()->user()->nip }}"
                            readonly>
                    </div>
                    
                    <input type="hidden" class="form-control" id="susut" readonly>
                   
                    <div class="col-md-3">
                        <label for="total_berat" class="form-label">Total Berat</label>
                        <input type="text" class="form-control" id="total_berat" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="total_pcs" class="form-label">Total Pcs</label>
                        <input type="text" class="form-control" id="total_pcs" readonly>
                    </div>
                    <div class="col-12">
                        <button type="button" class="btn btn-primary" id="tambah_data"
                            onclick="addRow()" style="margin: 10px">Tambah</button>
                        <button type="button" style="margin: 10px"  class="btn btn-info" onclick="confirmJob()">Confirm Job</button>
                        <a href="{{ Route('PreCleaningOutput.index') }}"style="margin: 10px" type="button" class="btn btn-danger">Close</a>

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
                                <th scope="col" class="text-center">ID Box Grading Kasar</th>
                                <th scope="col" class="text-center">Nomor BSTB</th>
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
                                {{-- <th scope="col" class="text-center">Sisa Berat</th> --}}
                                <th scope="col" class="text-center">Operator Flek & Kompresor</th>
                                <th scope="col" class="text-center">Operator Flek & Poles</th>
                                <th scope="col" class="text-center">Operator Cutter</th>
                                <th scope="col" class="text-center">Jenis Grading</th>
                                <th scope="col" class="text-center">Berat Grading</th>
                                <th scope="col" class="text-center">Pcs Grading</th>
                                <th scope="col" class="text-center">NIP Admin</th>
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
            let selectedNomorJob = '';

            $('#nomor_job').on('change', function() {
                selectedNomorJob = $(this).val();

                $.ajax({
                    url: '{{ route('preCleaningOutput.set') }}',
                    method: 'GET',
                    data: {
                        nomor_job: selectedNomorJob
                    },
                    success: function(response) {
                        console.log(response);

                        // Mengatur nilai Nomor Batch sesuai dengan respons dari server
                        $('#id_box_grading_kasar').val(response.id_box_grading_kasar);
                        $('#id_box_raw_material').val(response.id_box_raw_material);
                        $('#nomor_batch').val(response.nomor_batch);
                        $('#nomor_nota_internal').val(response.nomor_nota_internal);
                        $('#nama_supplier').val(response.nama_supplier);
                        $('#jenis_raw_material').val(response.jenis_raw_material);
                        $('#jenis_kirim').val(response.jenis_kirim);
                        $('#tujuan_kirim').val(response.tujuan_kirim);
                        $('#modal').val(response.modal);
                        $('#total_modal').val(response.total_modal);
                        $('#kadar_air').val(response.kadar_air);
                        $('#pcs_kirim').val(response.pcs_masuk - response.pcs_keluar);
                        $('#berat_kirim').val(response.berat_masuk - response.berat_keluar);
                        // $('#pcs_kirim').val(response.sisa_pcs);
                        // $('#berat_kirim').val(response.sisa_berat);
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            });
        });

        $(document).ready(function() {
            // Menangani perubahan pada dropdown nomor_job
            $('#plant').on('change', function() {
                const selectedPlant = $(this).val();
                if (selectedPlant) { // Check if selectedPlant is not empty
                    const nomorGrading = generateNomorGrading(selectedPlant);
                    $('#nomor_bstb').val(nomorGrading);
                } else {
                    $('#nomor_bstb').val(''); // Clear nomor_grading if plant is empty
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

                const nomorGrading = `BSTB_${tanggal}${bulan}${tahun}_${jam}${menit}${detik}_${selectedPlant}_UPC`;

                return nomorGrading;
            }

        });
        // Fungsi untuk menghitung persentase susut
        function hitungPersentaseSusut(berat_kirim, berat_grading) {
            // Menghitung nilai susut
            var nilaiSusut = berat_kirim - berat_grading;

            // Menghitung persentase susut
            var persentaseSusut = (nilaiSusut / berat_kirim) * 100;

            // Mengembalikan hasil
            return persentaseSusut;
        }

        function calculateTotalBerat() {
            let totalBerat = 0;
            // Iterasi melalui setiap baris dalam tabel
            $('#dataTable tbody tr').each(function() {
                // Mendapatkan nilai berat adding dari baris saat ini dan menambahkannya ke totalBerat
                let beratAdding = parseFloat($(this).find('td:eq(19)').text()) || 0;
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
                let pcsAdding = parseFloat($(this).find('td:eq(20)').text()) || 0;
                totalPcs += pcsAdding;
            });
            // Menampilkan total pcs di input #total_pcs
            $('#total_pcs').val(totalPcs);
        }

        // function calculateTotalBox() {
        //     let jumlahBaris = $('#dataTable tbody tr').length;
        //     // Tampilkan Jumlah Baris di Input dengan ID "total_box"
        //     $('#total_box').val(jumlahBaris);
        // }

        // Event listener untuk menghitung persentase susut saat input berubah
        $("#berat_grading").on("input", function() {
            // Mendapatkan nilai awal dan nilai akhir dari input
            let berat_kirim = parseFloat($("#berat_kirim").val()) || 0; // Jika tidak valid, asumsi nilai 0
            let berat_grading = parseFloat($(this).val()) || 0; // Jika tidak valid, asumsi nilai 0

            // Memastikan nilai akhir tidak nol untuk menghindari pembagian oleh nol
            if (berat_kirim !== 0) {
                // Menghitung persentase susut
                let persentaseSusut = hitungPersentaseSusut(berat_kirim, berat_grading);

                // Menampilkan hasil pada input susut
                $("#susut").val(persentaseSusut.toFixed(2) + " %");
                // Menampilkan hasil dengan dua desimal dan tambahkan simbol persen


            } else {
                // Jika nilai akhir nol, tampilkan pesan atau ambil tindakan lain
                $("#susut").val("Tidak dapat melakukan pembagian oleh nol");
            }
        });
        function confirmJob(){
                let nomor_job = $('#nomor_job').val();

                // // Periksa apakah nomor job sudah ada dalam tabel
                // if ($('#dataTable tbody tr td:nth-child(1)').filter(function() {
                //         return $(this).text() === nomor_job;
                //     }).length > 0) {
                //     // Nomor job sudah ada dalam tabel, tampilkan pesan dan hentikan proses
                //     Swal.fire({
                //         icon: 'error',
                //         title: 'Oops...',
                //         text: 'Nomor job sudah ada dalam tabel.',
                //     });
                //     return;
                // }
                // Hapus opsi nomor_job yang sudah dipilih dari dropdown
                $('#nomor_job option[value="' + nomor_job + '"]').remove();
                $('#nomor_job').prop('disabled', false);
                // $('#berat_kirim').val('');
                // $('#pcs_kirim').val('');
                // $('#susut').val('');
                $('#keterangan').val('');
                $('#nomor_job').val(null).trigger('change');

        }
        function validateForm() {
            // Mendefinisikan variabel untuk menyimpan kolom yang belum diisi
            let emptyFields = [];

            // Mendapatkan nilai dari semua input
            let nomor_job = $('#nomor_job').val();
            let plant = $('#plant').val();
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
            let operator_sikat_n_kompresor = $('#operator_sikat_dan_kompresor').val();
            let operator_flek_n_poles = $('#operator_flex_dan_poles').val();
            let operator_cutter = $('#operator_cutter').val();
            let jenis_grading = $('#jenis_grading').val();
            let berat_grading = $('#berat_grading').val();
            let pcs_grading = $('#pcs_grading').val();
            let susut = $('#susut').val();
            let user_created = $('#user_created').val();

            // Memeriksa setiap input, dan jika kosong, tambahkan ke daftar kolom yang belum diisi
            if (!nomor_job) emptyFields.push('Nomor Job');
            if (!plant) emptyFields.push('Plant');
            if (!operator_sikat_n_kompresor) emptyFields.push('Operator Sikat Kompresor');
            if (!operator_flek_n_poles) emptyFields.push('Operator Flek Poles');
            if (!operator_cutter) emptyFields.push('Operator Flek Cutter');
            if (!jenis_grading) emptyFields.push('Jenis Grading');
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
        // ADD ROW
        function addRow() {
            if (validateForm()) {

                let nomor_job = $('#nomor_job').val();

                // Periksa apakah nomor job sudah ada dalam tabel
                // if ($('#dataTable tbody tr td:nth-child(1)').filter(function() {
                //         return $(this).text() === nomor_job;
                //     }).length > 0) {
                //     // Nomor job sudah ada dalam tabel, tampilkan pesan dan hentikan proses
                //     Swal.fire({
                //         icon: 'error',
                //         title: 'Oops...',
                //         text: 'Nomor job sudah ada dalam tabel.',
                //     });
                //     return;
                // }
                // Hapus opsi nomor_job yang sudah dipilih dari dropdown
                // $('#nomor_job option[value="' + nomor_job + '"]').remove();

                let id_box_grading_kasar = $('#id_box_grading_kasar').val();
                let nomor_bstb = $('#nomor_bstb').val();
                let id_box_raw_material = $('#id_box_raw_material').val();
                let nomor_batch = $('#nomor_batch').val();
                let nomor_nota_internal = $('#nomor_nota_internal').val();
                let nama_supplier = $('#nama_supplier').val();
                let jenis_raw_material = $('#jenis_raw_material').val();
                let kadar_air = $('#kadar_air').val();
                let jenis_kirim = $('#jenis_kirim').val();
                let berat_kirim = $('#berat_kirim').val();
                let pcs_kirim = $('#pcs_kirim').val();
                let tujuan_kirim = $('#tujuan_kirim').val();
                let modal = $('#modal').val();
                let total_modal = $('#total_modal').val();
                let operator_sikat_n_kompresor = $('#operator_sikat_dan_kompresor').val();
                let operator_flek_n_poles = $('#operator_flex_dan_poles').val();
                let operator_cutter = $('#operator_cutter').val();
                let jenis_grading = $('#jenis_grading').val();
                let berat_grading = $('#berat_grading').val();
                let pcs_grading = $('#pcs_grading').val();
                let susut = $('#susut').val();
                let user_created = $('#user_created').val();
                let keterangan = $('#keterangan').val();
                let susutTabel = parseFloat(susut).toFixed(2);
                susutTabel = susutTabel.replace('.', '');
                susutTabel = susutTabel.padStart(4, '0');

               
                $('#plant').prop('disabled', true);
                $('#nomor_bstb').prop('readonly', true);
                $('#nomor_job').prop('disabled', true);

                let newRow = `<tr>` +
                    `<td class="text-center">${nomor_job}</td>` +
                    `<td class="text-center">${id_box_grading_kasar}</td>` +
                    `<td class="text-center">${nomor_bstb}</td>` +
                    `<td class="text-center">${id_box_raw_material}</td>` +
                    `<td class="text-center">${nomor_batch}</td>` +
                    `<td class="text-center">${nomor_nota_internal}</td>` +
                    `<td class="text-center">${nama_supplier}</td>` +
                    `<td class="text-center">${jenis_raw_material}</td>` +
                    `<td class="text-center">${kadar_air}</td>` +
                    `<td class="text-center">${jenis_kirim}</td>` +
                    `<td class="text-center">${berat_kirim}</td>` +
                    `<td class="text-center">${pcs_kirim}</td>` +
                    `<td class="text-center">${tujuan_kirim}</td>` +
                    `<td class="text-center">${modal}</td>` +
                    `<td class="text-center">${total_modal}</td>` +
                    `<td class="text-center">${operator_sikat_n_kompresor}</td>` +
                    `<td class="text-center">${operator_flek_n_poles}</td>` +
                    `<td class="text-center">${operator_cutter}</td>` +
                    `<td class="text-center">${jenis_grading}</td>` +
                    `<td class="text-center">${berat_grading}</td>` +
                    `<td class="text-center">${pcs_grading}</td>` +
                    // `<td class="text-center">${susutTabel}</td>` +
                    `<td class="text-center">${user_created}</td>` +
                    `<td class="text-center"><button class="btn btn-danger" onclick="hapusBaris(this)">Delete</button></td>` +
                    `</tr>`;
                // Tambahkan Kedalam Tabel
                $('#dataTable tbody').append(newRow);

                calculateTotalBerat();
                calculateTotalPcs();
                // calculateTotalBox();

                dataArray.push({
                    nomor_job: nomor_job,
                    id_box_grading_kasar: id_box_grading_kasar,
                    nomor_bstb: nomor_bstb,
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
                    operator_sikat_n_kompresor: operator_sikat_n_kompresor,
                    operator_flek_n_poles: operator_flek_n_poles,
                    operator_cutter: operator_cutter,
                    jenis_grading: jenis_grading,
                    berat_grading: berat_grading,
                    pcs_grading: pcs_grading,
                    total_berat_grading:0,
                    susutTabel: susutTabel,
                    keterangan: keterangan,
                    user_created: user_created,
                });
                // console.log(dataArray);
                // Mengosongkan nilai dropdown nomor_job
                $('#jenis_grading, #berat_grading, #pcs_grading')
                    .val('');
                // $('#berat_kirim').val('');
                // $('#pcs_kirim').val('');
                // $('#susut').val('');
                // $('#keterangan').val('');
                // $('#nomor_job').val(null).trigger('change');
                $('#jenis_grading').val(null).trigger('change');
           

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

               
                calculateTotalBerat();
                calculateTotalPcs();

                // $('#total_box').val(jumlahBaris);
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

                // $('#total_box').val(jumlahBaris);
            }
        }

        function simpanData() {
            // console.log(dataArray);
            // return;
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
                url: `{{ route('PreCleaningOutput.simpanData') }}`,
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
                    window.location.href = `{{ route('PreCleaningOutput.index') }}`;
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
