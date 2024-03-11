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
                    <div class="col-md-12">
                        <label for="basic-usage" class="form-label">Nomor Job</label>
                        <select class="select2 form-select" style="width: 100%;" name="nomor_job" id="nomor_job"
                            placeholder="Pilih Nomor Job">
                            <option value="">Pilih Nomor Job</option>
                            @foreach ($pre_cleaning_stocks as $PreCS)
                                <option value="{{ $PreCS->nomor_job }}">
                                    {{ $PreCS->nomor_job }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    {{-- <input type="hidden" id="sisa_berat"> --}}
                    {{-- <div class="col-md-4"> --}}
                    {{-- <label for="id_box_grading_kasar" class="form-label">ID Box Grading Kasar</label> --}}
                    <input type="hidden" class="form-control" id="id_box_grading_kasar" readonly>
                    {{-- </div> --}}
                    <div class="col-md-4">
                        <label for="nomor_bstb" class="form-label">Nomor BSTB</label>
                        <input type="text" class="form-control" id="nomor_bstb">
                    </div>
                    {{-- <div class="col-md-4"> --}}
                    {{-- <label for="id_box_raw_material" class="form-label">ID Box Raw Material</label> --}}
                    <input type="hidden" class="form-control" id="id_box_raw_material" readonly>
                    {{-- </div> --}}
                    <div class="col-md-4">
                        <label for="nomor_batch" class="form-label">Nomor Batch</label>
                        <input type="text" class="form-control" id="nomor_batch" readonly>
                    </div>
                    {{-- <div class="col-md-4"> --}}
                    {{-- <label for="nomor_nota_internal" class="form-label">Nomor Nota Internal</label> --}}
                    <input type="hidden" class="form-control" id="nomor_nota_internal" readonly>
                    {{-- </div> --}}
                    {{-- <div class="col-md-4"> --}}
                    {{-- <label for="nama_supplier" class="form-label">Nama Supplier</label> --}}
                    <input type="hidden" class="form-control" id="nama_supplier" readonly>
                    {{-- </div> --}}
                    {{-- <div class="col-md-4"> --}}
                    {{-- <label for="jenis_raw_material" class="form-label">Jenis Raw Material</label> --}}
                    <input type="hidden" class="form-control" id="jenis_raw_material" readonly>
                    {{-- </div> --}}
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

                    {{-- <div class="col-md-3"> --}}
                    {{-- <label for="modal" class="form-label">Modal</label> --}}
                    <input type="hidden" class="form-control" id="modal" readonly>
                    {{-- </div> --}}
                    {{-- <div class="col-md-3"> --}}
                    {{-- <label for="total_modal" class="form-label">Total Modal</label> --}}
                    <input type="hidden" class="form-control" id="total_modal" readonly>
                    {{-- </div> --}}
                    {{-- <div class="col-md-2"> --}}
                    {{-- <label for="kadar_air" class="form-label">Kadar Air</label> --}}
                    <input type="hidden" class="form-control" id="kadar_air" readonly>
                    {{-- </div> --}}
                    <div class="col-md-4">
                        <label for="basic-usage" class="form-label">Operator Sikat & Kompresor</label>
                        <select class="select2 form-select" style="width: 100%;" tabindex="-1" aria-hidden="true"
                            name="operator_sikat_dan_kompresor" id="operator_sikat_dan_kompresor"
                            placeholder="Pilih Operator Sikat & Kompresor">
                            <option value="">Pilih Operator Sikat & Kompresor</option>
                            @foreach ($master_operators->sortBy('nama') as $MasterSPRM)
                                @if ($MasterSPRM->job == 'Sikat + Kompresor' && $MasterSPRM->status == 1)
                                    <option value="{{ $MasterSPRM->nama }}">
                                        {{ $MasterSPRM->nama }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="basic-usage" class="form-label">Operator Flex & Poles</label>
                        <select class="select2 form-select" style="width: 100%;" name="operator_flex_dan_poles"
                            id="operator_flex_dan_poles" placeholder="Pilih Operator Flex & Poles">
                            <option value="">Pilih Operator Flex & Poles</option>
                            @foreach ($master_operators->sortBy('nama') as $MasterSPRM)
                                @if ($MasterSPRM->job == 'Flek + Poles' && $MasterSPRM->status == 1)
                                    <option value="{{ $MasterSPRM->nama }}">
                                        {{ $MasterSPRM->nama }}
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
                            @foreach ($master_operators->sortBy('nama') as $MasterSPRM)
                                @if ($MasterSPRM->job == 'Cutter' && $MasterSPRM->status == 1)
                                    <option value="{{ $MasterSPRM->nama }}">
                                        {{ $MasterSPRM->nama }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="kuningan" class="form-label">Kuningan</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="kuningan">
                    </div>
                    <div class="col-md-4">
                        <label for="Sterofoam" class="form-label">Sterofoam</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="Sterofoam">
                    </div>
                    <div class="col-md-4">
                        <label for="karat" class="form-label">Karat</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="karat">
                    </div>
                    <div class="col-md-4">
                        <label for="rontokan_flex" class="form-label">Rontokan Flex</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="rontokan_flex">
                    </div>
                    <div class="col-md-4">
                        <label for="rontokan_bahan" class="form-label">Rontokan Bahan</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="rontokan_bahan">
                    </div>
                    <div class="col-md-4">
                        <label for="rontokan_serabut" class="form-label">Rontokan Serabut</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="rontokan_serabut">
                    </div>
                    <div class="col-md-3">
                        <label for="ws" class="form-label">WS-0-0-0</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="ws">
                    </div>
                    <div class="col-md-3">
                        <label for="berat_precleaning" class="form-label">Berat Precleaning</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="berat_precleaning">
                    </div>
                    <div class="col-md-3">
                        <label for="pcs" class="form-label">Pcs</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="pcs">
                    </div>
                    <div class="col-md-3">
                        <label for="user_created" class="form-label">NIP Admin</label>
                        <input type="text" class="form-control" id="user_created">
                    </div>
                    <div class="col-md-3">
                        <label for="susut" class="form-label">Susut</label>
                        <input type="text" class="form-control" id="susut" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="total_box" class="form-label">Total Box</label>
                        <input type="text" class="form-control" id="total_box" readonly>
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
                                <th scope="col" class="text-center">Kuningan</th>
                                <th scope="col" class="text-center">Sterofoam</th>
                                <th scope="col" class="text-center">Karat</th>
                                <th scope="col" class="text-center">Rontokan Flex</th>
                                <th scope="col" class="text-center">Rontokan Bahan</th>
                                <th scope="col" class="text-center">Rontokan Serabut</th>
                                <th scope="col" class="text-center">WS-0-0-0</th>
                                <th scope="col" class="text-center">Berat Pre Cleaning</th>
                                <th scope="col" class="text-center">Pcs</th>
                                <th scope="col" class="text-center">Susut</th>
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
        // Nomor JOB
        $('#nomor_job').on('change', function() {
            let selectedNomorJob = $(this).val();

            $.ajax({
                url: `{{ route('preCleaningOutput.set') }}`,
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
                        $('#kadar_air').val(response.avg_kadar_air);
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
                // Memanggil fungsi generateNomorBSTB ketika nomor_job berubah
                generateNomorBSTB();
            });

            // Fungsi untuk generate nomor_bstb
            function generateNomorBSTB() {
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
                const bagianKetiga = nomorJobValue[2];

                // Menghasilkan nomor_bstb berdasarkan rumus yang diinginkan
                const nomor_bstb = `BSTB_${tanggal}${bulan}${tahun}_${jam}${menit}${detik}_${bagianKetiga}_UPC`;

                // Memasukkan nilai yang dihasilkan ke dalam input nomor_bstb
                $('#nomor_bstb').val(nomor_bstb);
                console.log(nomor_bstb);
            }
        });
        // Fungsi untuk menghitung persentase susut
        function hitungPersentaseSusut(nilaiAwal, nilaiAkhir) {
            // Menghitung nilai susut
            var nilaiSusut = nilaiAwal - nilaiAkhir;

            // Menghitung persentase susut
            var persentaseSusut = (nilaiSusut / nilaiAwal) * 100;

            // Mengembalikan hasil
            return persentaseSusut;
        }

        // Event listener untuk menghitung persentase susut saat input berubah
        $("#berat_precleaning").on("input", function() {
            // Mendapatkan nilai awal dan nilai akhir dari input
            var nilaiAwal = parseFloat($("#berat_kirim").val()) || 0; // Jika tidak valid, asumsi nilai 0
            var nilaiAkhir = parseFloat($(this).val()) || 0; // Jika tidak valid, asumsi nilai 0

            // Memastikan nilai akhir tidak nol untuk menghindari pembagian oleh nol
            if (nilaiAkhir !== 0) {
                // Menghitung persentase susut
                var persentaseSusut = hitungPersentaseSusut(nilaiAwal, nilaiAkhir);

                // Menampilkan hasil pada input susut
                $("#susut").val(persentaseSusut.toFixed(2) +
                    "%"); // Menampilkan hasil dengan dua desimal dan tambahkan simbol persen
            } else {
                // Jika nilai akhir nol, tampilkan pesan atau ambil tindakan lain
                $("#susut").val("Tidak dapat melakukan pembagian oleh nol");
            }
        });

        function validateForm() {
            // Mendefinisikan variabel untuk menyimpan kolom yang belum diisi
            let emptyFields = [];

            // Mendapatkan nilai dari semua input
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
            let operator_sikat_kompresor = $('#operator_sikat_dan_kompresor').val();
            let operator_flek_poles = $('#operator_flex_dan_poles').val();
            let operator_flek_cutter = $('#operator_cutter').val();
            let kuningan = $('#kuningan').val();
            let sterofoam = $('#Sterofoam').val();
            let karat = $('#karat').val();
            let rontokan_fisik = $('#rontokan_flex').val();
            let rontokan_bahan = $('#rontokan_bahan').val();
            let rontokan_serabut = $('#rontokan_serabut').val();
            let ws_0_0_0 = $('#ws').val();
            let berat_pre_cleaning = $('#berat_precleaning').val();
            let pcs_pre_cleaning = $('#pcs').val();
            let susut = $('#susut').val();
            let user_created = $('#user_created').val();

            // Memeriksa setiap input, dan jika kosong, tambahkan ke daftar kolom yang belum diisi
            if (!nomor_job) emptyFields.push('Nomor Job');
            if (!operator_sikat_kompresor) emptyFields.push('Operator Sikat Kompresor');
            if (!operator_flek_poles) emptyFields.push('Operator Flek Poles');
            if (!operator_flek_cutter) emptyFields.push('Operator Flek Cutter');
            if (!kuningan) emptyFields.push('Kuningan');
            if (!sterofoam) emptyFields.push('Sterofoam');
            if (!karat) emptyFields.push('Karat');
            if (!rontokan_fisik) emptyFields.push('Rontokan Fisik');
            if (!rontokan_bahan) emptyFields.push('Rontokan Bahan');
            if (!rontokan_serabut) emptyFields.push('Rontokan Serabut');
            if (!ws_0_0_0) emptyFields.push('ws_0_0_0');
            if (!berat_pre_cleaning) emptyFields.push('Berat Pre Cleaning');
            if (!pcs_pre_cleaning) emptyFields.push('Pcs Pre Cleaning');
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
                let operator_sikat_kompresor = $('#operator_sikat_dan_kompresor').val();
                let operator_flek_poles = $('#operator_flex_dan_poles').val();
                let operator_flek_cutter = $('#operator_cutter').val();
                let kuningan = $('#kuningan').val();
                let sterofoam = $('#Sterofoam').val();
                let karat = $('#karat').val();
                let rontokan_fisik = $('#rontokan_flex').val();
                let rontokan_bahan = $('#rontokan_bahan').val();
                let rontokan_serabut = $('#rontokan_serabut').val();
                let ws_0_0_0 = $('#ws').val();
                let berat_pre_cleaning = $('#berat_precleaning').val();
                let pcs_pre_cleaning = $('#pcs').val();
                let susut = $('#susut').val();
                let user_created = $('#user_created').val();
                let susutTabel = parseFloat(susut).toFixed(2);
                susutTabel = susutTabel.replace('.', '');
                susutTabel = susutTabel.padStart(4, '0');

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
                    `<td class="text-center">${operator_sikat_kompresor}</td>` +
                    `<td class="text-center">${operator_flek_poles}</td>` +
                    `<td class="text-center">${operator_flek_cutter}</td>` +
                    `<td class="text-center">${kuningan}</td>` +
                    `<td class="text-center">${sterofoam}</td>` +
                    `<td class="text-center">${karat}</td>` +
                    `<td class="text-center">${rontokan_fisik}</td>` +
                    `<td class="text-center">${rontokan_bahan}</td>` +
                    `<td class="text-center">${rontokan_serabut}</td>` +
                    `<td class="text-center">${ws_0_0_0}</td>` +
                    `<td class="text-center">${berat_pre_cleaning}</td>` +
                    `<td class="text-center">${pcs_pre_cleaning}</td>` +
                    `<td class="text-center">${susutTabel}</td>` +
                    `<td class="text-center">${user_created}</td>` +
                    // `<td class="text-center"> + "sisa_berat" + </td>` +
                    `<td class="text-center"><button class="btn btn-danger" onclick="hapusBaris(this)">Delete</button></td>` +
                    `</tr>`;
                // Tambahkan Kedalam Tabel
                $('#dataTable tbody').append(newRow);

                let totalPcsKirim = 0;
                $('#dataTable tbody tr').each(function() {
                    let pcsKirim = parseFloat($(this).find('td:eq(11)')
                        .text()); // Ganti angka 10 dengan indeks kolom berat_kirim dalam tabel
                    if (!isNaN(pcsKirim)) {
                        totalPcsKirim += pcsKirim;
                    }
                });

                $('#total_pcs').val(totalPcsKirim);

                let totalBeratKirim = 0;
                $('#dataTable tbody tr').each(function() {
                    let beratKirim = parseFloat($(this).find('td:eq(10)')
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
                    operator_sikat_kompresor: operator_sikat_kompresor,
                    operator_flek_poles: operator_flek_poles,
                    operator_flek_cutter: operator_flek_cutter,
                    kuningan: kuningan,
                    sterofoam: sterofoam,
                    karat: karat,
                    rontokan_fisik: rontokan_fisik,
                    rontokan_bahan: rontokan_bahan,
                    rontokan_serabut: rontokan_serabut,
                    ws_0_0_0: ws_0_0_0,
                    berat_pre_cleaning: berat_pre_cleaning,
                    pcs_pre_cleaning: pcs_pre_cleaning,
                    susutTabel: susutTabel,
                    user_created: user_created,
                });

                // Mengosongkan nilai dropdown nomor_job
                $('#nomor_job, #id_box_grading_kasar, #nomor_bstb, #id_box_raw_material, #nomor_batch, #nomor_nota_internal, #nama_supplier, #jenis_raw_material, #jenis_kirim, #tujuan_kirim, #modal, #total_modal, #kadar_air, #pcs_kirim, #berat_kirim, #operator_sikat_dan_kompresor, #operator_flex_dan_poles, #operator_cutter, #kuningan, #Sterofoam, #karat, #rontokan_flex, #rontokan_bahan,#rontokan_serabut, #ws, #berat_precleaning, #pcs, #susut')
                    .val('');
            }

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
