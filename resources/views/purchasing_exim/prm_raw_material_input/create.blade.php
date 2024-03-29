@extends('layouts.master1')
@section('menu')
    Purchasing & EXIM
@endsection
@section('title')
    Purchasing Raw Material Input
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card mt-2">
            <div class="card-header">
                <div class="d-flex align-items-center mb-3">
                    <h4 class="card-title">Input Purchasing Raw Material</h4>
                </div>
                <hr>
                <form method="POST" class="row g-3" id="myForm">
                    @csrf
                    <div class="col-md-4">
                        <label for="no_doc" class="form-label">Nomor DOC</label>
                        <input type="text" class="form-control" id="no_doc" value="1" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="nomor_po" class="form-label">Nomor PO</label>
                        <input type="text" class="form-control" id="nomor_po">
                    </div>
                    <div class="col-md-4">
                        <label for="nomor_batch" class="form-label">Nomor Batch</label>
                        <input type="text" class="form-control" id="nomor_batch">
                    </div>
                    <div class="col-md-4">
                        <label for="nomor_nota_supplier" class="form-label">Nomor Nota Supplier</label>
                        <input type="text" class="form-control" id="nomor_nota_supplier">
                    </div>

                    <div class="col-md-4">
                        <label for="basic-usage" class="form-label">Pilih Nama Supplier :</label>
                        <select class="choices form-select" style="width: 100%;" tabindex="-1" aria-hidden="true"
                            name="nama_supplier" id="nama_supplier" placeholder="Pilih Nama Supplier">
                            <option value="">Pilih Nama Supplier</option>
                            @foreach ($master_supplier_raw_materials->sortBy('nama_supplier') as $MasterSPRM)
                                @if ($MasterSPRM->status == 1)
                                    <option value="{{ $MasterSPRM->nama_supplier }}">
                                        {{ $MasterSPRM->nama_supplier }}
                                    </option>
                                @endif
                                {{-- <option value="{{ $MasterSPRM->nama_supplier }}">
                                    {{ $MasterSPRM->nama_supplier }}</option> --}}
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="nomor_nota_internal" class="form-label">Nomor Nota Internal</label>
                        <input type="text" class="form-control" id="nomor_nota_internal" readonly>
                    </div>
                    <div class="col-md-flex">
                        <hr>
                    </div>
                    <div class="col-md-3">
                        <label for="basic-usage" class="form-label">Pilih Jenis :</label>
                        <select class="choices form-select" style="width: 100%;" tabindex="-1" aria-hidden="true"
                            name="jenis" id="jenis" placeholder="Pilih Jenis">
                            <option value="">Pilih Jenis</option>
                            @foreach ($master_jenis_raw_materials->sortBy('jenis') as $MasterJRM)
                                @if ($MasterJRM->status == 1)
                                    <option value="{{ $MasterJRM->jenis }}">
                                        {{ $MasterJRM->jenis }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="berat_nota" class="form-label">Berat Nota</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="berat_nota">
                    </div>
                    <div class="col-md-3">
                        <label for="berat_kotor" class="form-label">Berat Kotor</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="berat_kotor">
                    </div>
                    <div class="col-md-3">
                        <label for="berat_bersih" class="form-label">Berat Bersih</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="berat_bersih">
                    </div>
                    <div class="col-md-3">
                        <label for="selisih_berat" class="form-label">Selisih Berat</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="selisih_berat" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="kadar_air" class="form-label">Kadar Air</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="kadar_air">
                    </div>
                    <div class="col-md-3">
                        <label for="harga_nota" class="form-label">Harga Nota</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="harga_nota">
                    </div>
                    <div class="col-md-3">
                        <label for="id_box" class="form-label">ID Box</label>
                        <input type="text" class="form-control" id="id_box" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="total_harga_nota" class="form-label">Total Harga Nota</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="total_harga_nota" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="harga_deal" class="form-label">Harga Deal</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="harga_deal" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan">
                    </div>
                    <div class="col-md-3">
                        <label for="user_created" class="form-label">NIP Admin</label>
                        <input type="text" class="form-control" id="user_created">
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
                <div class="card-title">Validasi</div>
                <div class="card-body" style="overflow: scroll" content="{{ csrf_token() }}">
                    <table class="table" id="dataTable">
                        <thead>
                            <tr>
                                {{-- <th scope="col">Doc No</th> --}}
                                <th scope="col" class="text-center">Jenis</th>
                                <th scope="col" class="text-center">Berat Nota</th>
                                <th scope="col" class="text-center">Berat Kotor</th>
                                <th scope="col" class="text-center">Berat Bersih</th>
                                <th scope="col" class="text-center">Selisih Berat</th>
                                <th scope="col" class="text-center">Kadar Air</th>
                                <th scope="col" class="text-center">ID Box</th>
                                <th scope="col" class="text-center">Harga Nota</th>
                                <th scope="col" class="text-center">Total Harga Nota</th>
                                <th scope="col" class="text-center">Harga Deal</th>
                                <th scope="col" class="text-center">Keterangan</th>
                                <th scope="col" class="text-center">NIP Admin</th>
                                <th scope="col" class="text-center">Action</th>
                                <th scope="col" class="text-center">Fix Harga Deal</th>
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
        // Menambahkan event listener untuk perubahan nilai pada input nomor nota supplier dan select nama supplier
        $('#nomor_nota_supplier').on('input', generateNomorNotaInternal);
        $('#nama_supplier').on('change', generateNomorNotaInternal);
        // $('#nomor_nota_supplier, #nama_supplier').on('input change', generateNomorNotaInternal);
        $('#nomor_nota_internal').on('input', generateIdBox);
        $('#jenis').on('change', generateIdBox);
        $('#harga_nota').on('input', generateIdBox);
        // Event listener untuk input beratNotaInput dan hargaNotaInput
        $('#berat_nota').on('input', updateTotalHarga);
        $('#harga_nota').on('input', updateTotalHarga);

        // Event listener untuk perubahan nilai pada berat nota atau berat bersih
        $('#berat_nota').on('input', updateSelisihBerat);
        $('#berat_bersih').on('input', updateSelisihBerat);

        // Event listener untuk perubahan nilai pada total harga nota atau berat bersih
        $('#total_harga_nota').on('change', updateHargaDeal);
        $('#berat_bersih').on('input', updateHargaDeal);

        $('#nama_supplier').on('change', function() {
            // Mengambil nilai id_box yang dipilih
            let selectedNamaSupplier = $(this).val();
            // Melakukan permintaan AJAX ke controller untuk mendapatkan nomor batch
            $.ajax({
                url: `{{ route('prm_raw_material_input.getDataSupplier') }}`,
                method: 'GET',
                data: {
                    nama_supplier: selectedNamaSupplier
                },
                success: function(response) {
                    console.log(response);
                    let inisial_supplier = response.inisial_supplier;
                    generateNomorNotaInternal(inisial_supplier);
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });

        // idbox
        $('#jenis').on('change', function() {
            // Mengambil nilai id_box yang dipilih
            let selectedJenis = $(this).val();
            // Melakukan permintaan AJAX ke controller untuk mendapatkan nomor batch
            $.ajax({
                url: `{{ route('prm_raw_material_input.getDataJenis') }}`,
                method: 'GET',
                data: {
                    jenis: selectedJenis
                },
                success: function(response) {
                    console.log(response);
                    let jenis = response.jenis;
                    // let created_at = response.created_at;
                    generateIdBox(jenis);
                    // generateNomorNotaInternal(created_at);
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });
        //
        // // Event listener untuk perubahan pada input nama_supplier
        // $('#nama_supplier').on('change', function() {
        //     let selectedNamaSupplier = $(this).val();
        //     // Panggil fungsi getInisialSupplier untuk mendapatkan inisial_supplier
        //     getInisialSupplier(selectedNamaSupplier);
        // });

        // // Event listener untuk perubahan pada input nomor_nota_supplier
        // $('#nomor_nota_supplier').on('input', function() {
        //     let inisial_supplier = $('#inisial_supplier').val();
        //     // Panggil fungsi generateNomorNotaInternal dengan inisial_supplier yang sudah ada
        //     generateNomorNotaInternal(inisial_supplier);
        // });
        // generate nomor internal
        function generateNomorNotaInternal(inisial_supplier) {
            const nomorNotaSupplier = $('#nomor_nota_supplier').val();
            const namaSupplier = $('#nama_supplier').val();

            // ambil tanggal, bulan, tahun
            const now = new Date();
            const tahun = now.getFullYear().toString().substr(-2); // Ambil 2 digit terakhir tahun
            const bulan = ('0' + (now.getMonth() + 1)).slice(-2); // Menambah '0' jika satu digit
            const tanggal = ('0' + now.getDate()).slice(-2);
            console.log(inisial_supplier);
            // Membentuk nomor nota internal dengan menggabungkan nama supplier dan nomor nota supplier
            const nomorNotaInternal = `${inisial_supplier}_${nomorNotaSupplier}_${tanggal}${bulan}${tahun}`;
            console.log(nomorNotaInternal);

            // Menampilkan nomor nota internal pada input nomor nota internal
            $('#nomor_nota_internal').val(nomorNotaInternal);

        }
        // generate ID_Box
        function generateIdBox(jenis) {
            const nomorNotaInternal = $('#nomor_nota_internal').val();
            const Jenis = $('#jenis').val();
            const hargaNota = $('#harga_nota').val();

            // Membentuk nomor nota internal dengan menggabungkan nama supplier dan nomor nota supplier
            const idBox = `${nomorNotaInternal}_${Jenis}_${hargaNota}`;
            // console.log(nomorNotaInternal);

            // Menampilkan nomor nota internal pada input nomor nota internal
            $('#id_box').val(idBox);

        }

        function updateSelisihBerat() {
            // Mendapatkan nilai berat nota dan berat bersih
            const beratNota = parseFloat($('#berat_nota').val());
            const beratBersih = parseFloat($('#berat_bersih').val());

            // Melakukan perhitungan selisih berat
            const selisihBerat = beratBersih - beratNota;

            // Memasukkan hasil perhitungan ke dalam input selisih berat
            $('#selisih_berat').val(isNaN(selisihBerat) ? '' : selisihBerat);
        }

        function updateTotalHarga() {
            // Mendapatkan nilai berat nota dan harga nota menggunakan jQuery
            const beratNota = parseFloat($('#berat_nota').val()) || 0;
            const hargaNota = parseFloat($('#harga_nota').val()) || 0;

            // Melakukan perhitungan total harga nota
            let totalHargaNota = beratNota * hargaNota;

            // Memasukkan hasil perhitungan ke dalam input total harga nota menggunakan jQuery
            $('#total_harga_nota').val(isFinite(totalHargaNota) ? totalHargaNota.toFixed(2) : '');

            // Memanggil updateHargaDeal setiap kali updateTotalHarga terjadi
            updateHargaDeal();
        }

        function updateHargaDeal() {
            // Mendapatkan nilai total harga nota dan berat bersih menggunakan jQuery
            const totalHargaNota = parseFloat($('#total_harga_nota').val());
            const beratBersih = parseFloat($('#berat_bersih').val());

            // Memeriksa jika total harga nota sudah terisi
            if (!isNaN(totalHargaNota) && totalHargaNota !== 0) {
                const hargaDeal = totalHargaNota / (beratBersih !== 0 ? beratBersih : 1);

                // Memasukkan hasil perhitungan ke dalam input harga deal menggunakan jQuery
                $('#harga_deal').val(hargaDeal.toFixed(2));
            } else {
                // Jika total harga nota kosong, tampilkan nilai dari berat bersih
                $('#harga_deal').val(beratBersih !== 0 ? '0.00' : '');
            }
        }

        // Panggil fungsi updateHargaDeal saat nilai berubah pada total harga nota dan berat bersih
        $('#total_harga_nota, #berat_bersih').on('input', function() {
            updateHargaDeal();
        });
    </script>
    <script>
        // test
        let dataArray = [];
        let dataHeader = [];
        let idBoxGroups = [];

        function addRow() {
            console.log(dataArray);
            // Mengambil nilai dari input
            let doc_no = $('#doc_no').val();
            let nomor_po = $('#nomor_po').val();
            let nomor_batch = $('#nomor_batch').val();
            let nomor_nota_supplier = $('#nomor_nota_supplier').val();
            let nomor_nota_internal = $('#nomor_nota_internal').val();
            let nama_supplier = $('#nama_supplier').val();
            let jenis = $('#jenis').val();
            let berat_nota = $('#berat_nota').val();
            let berat_kotor = $('#berat_kotor').val();
            let berat_bersih = $('#berat_bersih').val();
            let selisih_berat = $('#selisih_berat').val();
            let kadar_air = $('#kadar_air').val();
            let id_box = $('#id_box').val();
            let harga_nota = $('#harga_nota').val();
            let total_harga_nota = $('#total_harga_nota').val();
            let harga_deal = $('#harga_deal').val();
            let keterangan = $('#keterangan').val();
            let user_created = $('#user_created').val();
            // test
            let berat_masuk = $('#berat_bersih').val();
            let avg_kadar_air = $('#kadar_air').val();

            // Validasi input (sesuai kebutuhan)
            if (nomor_po.trim() === '' || nomor_batch.trim() === '' || nomor_nota_supplier.trim() === '' ||
                nomor_nota_internal.trim() === '' || nama_supplier.trim() === '' || jenis.trim() === '' ||
                berat_nota.trim() === '' || berat_kotor.trim() === '' || berat_bersih.trim() === '' ||
                selisih_berat.trim() === '' ||
                kadar_air.trim() === '' || id_box.trim() === '' || harga_nota.trim() === '' || total_harga_nota.trim() ===
                '' || harga_deal.trim() === '') {
                // Menampilkan SweetAlert untuk pesan error
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Harap isi semua kolom.'
                });
                return; // Berhenti jika ada input yang kosong
            }
            // Mengubah atribut readonly menggunakan jQuery
            $('#nomor_po').prop('readonly', true);
            $('#nomor_batch').prop('readonly', true);
            $('#nomor_nota_supplier').prop('readonly', true);
            $('#nama_supplier').prop('disabled', true); // Jika ingin menjadikan select readonly

            // Memeriksa apakah id_box sudah ada di objek idBoxGroups
            if (id_box in idBoxGroups) {
                // Jika sudah ada, update nilai total-harga-nominal dan total-berat-bersih
                idBoxGroups[id_box].totalHargaNota += parseFloat(total_harga_nota);
                idBoxGroups[id_box].totalBeratBersih += parseFloat(berat_bersih);
            } else {
                // Jika belum ada, tambahkan id_box baru ke objek
                idBoxGroups[id_box] = {
                    totalHargaNota: parseFloat(total_harga_nota),
                    totalBeratBersih: parseFloat(berat_bersih),
                };
            }

            let totalHargaNota = 0;
            let totalHargaBersih = 0;
            $('#dataTable tbody tr').each(function() {
                let totalHargaNotaValue = parseInt($(this).find('td:eq(8)').text()) || 0;
                let hargaBersihValue = parseInt($(this).find('td:eq(3)').text()) || 0;

                console.log("------------------------------");
                console.log("Harga Nota Value = " + totalHargaNotaValue);
                console.log("Harga Bersih Value = " + hargaBersihValue);
                console.log("------------------------------");

                totalHargaNota += totalHargaNotaValue;
                totalHargaBersih += hargaBersihValue;

                console.log("------------------------------");
                console.log("Harga Nota = " + totalHargaNota);
                console.log("Harga Bersih = " + totalHargaBersih);
                console.log("------------------------------");

                let jumlahTotal = totalHargaNota / totalHargaBersih;

                console.log("------------------------------");
                console.log("Jumlah Total = " + jumlahTotal);
                console.log("------------------------------");
            });

            // Menampilkan total-harga-nominal dan total-berat-bersih untuk setiap id_box
            for (let idBox in idBoxGroups) {
                console.log("ID Box: " + idBox);
                console.log("Total Harga Nota: " + idBoxGroups[idBox].totalHargaNota);
                console.log("Total Berat Bersih: " + idBoxGroups[idBox].totalBeratBersih);
                console.log("Fix harga Modal: " + idBoxGroups[idBox].totalHargaNota / idBoxGroups[idBox].totalBeratBersih);
                console.log("------------------------------");
                fix_harga_deal_clg = idBoxGroups[idBox].totalHargaNota / idBoxGroups[idBox].totalBeratBersih;
                console.log(fix_harga_deal_clg.toFixed(2));
            }
            let fixHargaDealForRow = idBoxGroups[id_box].totalHargaNota / idBoxGroups[id_box].totalBeratBersih;

            // Menambahkan atau mengupdate data ke dalam tabel
            let existingRow = $('#dataTable tbody tr[data-idbox="' + id_box + '"]');
            if (existingRow.length > 0) {
                // Jika baris sudah ada, update nilai fix_harga_deal
                existingRow.find('td:eq(12)').text(fixHargaDealForRow.toFixed(2));
            } else {
                // Menambahkan data ke dalam tabel
                var newRow = `<tr>` +
                    `<td class="text-center">${jenis}</td>` +
                    `<td class="text-center">${berat_nota}</td>` +
                    `<td class="text-center">${berat_kotor}</td>` +
                    `<td class="text-center">${berat_bersih}</td>` +
                    `<td class="text-center">${selisih_berat}</td>` +
                    `<td class="text-center">${kadar_air}</td>` +
                    `<td class="text-center">${id_box}</td>` +
                    `<td class="text-center">${harga_nota}</td>` +
                    `<td class="text-center">${total_harga_nota}</td>` +
                    `<td class="text-center">${harga_deal}</td>` +
                    `<td class="text-center">${keterangan}</td>` +
                    `<td class="text-center">${user_created}</td>` +
                    `<td class="text-center"><button class="btn btn-danger" onclick="hapusBaris(this)">Delete</button></td>` +
                    `<td class="text-center">${fixHargaDealForRow.toFixed(4)}</td>` +
                    `</tr>`
                $('#dataTable tbody').append(newRow);
            }
            // Update nilai fix_harga_deal di dalam objek dataArray
            let dataIndex = dataArray.findIndex(item => item.id_box === id_box);
            if (dataIndex !== -1) {
                dataArray[dataIndex].fix_harga_deal = fixHargaDealForRow;
            }

            // Menambahkan data ke dalam array
            dataArray.push({
                id_box: id_box,
                nomor_nota_internal: nomor_nota_internal,
                nomor_batch: nomor_batch,
                nama_supplier: nama_supplier,
                doc_no: doc_no,
                jenis: jenis,
                berat_nota: berat_nota,
                berat_kotor: berat_kotor,
                berat_bersih: berat_bersih,
                selisih_berat: selisih_berat,
                kadar_air: kadar_air,
                id_box: id_box,
                harga_nota: harga_nota,
                total_harga_nota: total_harga_nota,
                harga_deal: harga_deal,
                fixHargaDealForRow: fixHargaDealForRow,
                keterangan: keterangan,
                user_created: user_created,

            });
            console.log(dataArray);
            dataHeader = [];
            dataHeader.push({
                // doc_no: doc_no,
                nomor_po: nomor_po,
                nomor_batch: nomor_batch,
                nomor_nota_supplier: nomor_nota_supplier,
                nomor_nota_internal: nomor_nota_internal,
                nama_supplier: nama_supplier,
                keterangan: keterangan,
                user_created: user_created,
            });

            // Membersihkan nilai input setelah ditambahkan
            // $('#jenis').val(null).trigger('change');
            $('#jenis').val($('#jenis option:first').val()).trigger('change');
            $('#berat_nota').val('');
            $('#berat_kotor').val('');
            $('#berat_bersih').val('');
            $('#selisih_berat').val('');
            $('#kadar_air').val('');
            $('#id_box').val('');
            $('#harga_nota').val('');
            $('#total_harga_nota').val('');
            $('#harga_deal').val('');
            $('#keterangan').val('');
        }

        function hapusBaris(button) {
            // Dapatkan elemen baris terkait dengan tombol delete yang diklik
            let row = $(button).closest('tr');

            // Hapus baris dari dataArray berdasarkan indeks baris di tabel
            let rowIndex = row.index();
            dataArray.splice(rowIndex, 1);
            dataHeader.splice(rowIndex, 1);

            // Hapus baris dari tabel
            row.remove();
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
                    title: 'Astagfirullah',
                    text: 'Data dalam tabel masih kosong. Silakan tambahkan data terlebih dahulu.'
                });
                return; // Menghentikan eksekusi fungsi jika data kosong
            }
            // Mengirim data ke server menggunakan AJAX
            $.ajax({
                url: `{{ route('prm_raw_material_input.simpanData') }}`,
                method: 'POST',
                data: {
                    data: JSON.stringify(dataArray),
                    dataHeader: JSON.stringify(dataHeader),
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
                    window.location.href = `{{ route('prm_raw_material_input.index') }}`;
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
