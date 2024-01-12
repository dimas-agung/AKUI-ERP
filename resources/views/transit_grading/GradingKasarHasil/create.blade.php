@extends('layouts.master1')
@section('menu')
    Grading Kasar Transit
@endsection
@section('title')
    Grading Kasar Hasil
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card mt-2">
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
                        <label for="jenis_adding" class="form-label">Jenis Adding</label>
                        <input type="text" class="form-control" id="jenis_adding" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="berat_adding" class="form-label">Berat Adding</label>
                        <input type="text" class="form-control" id="berat_adding" readonly>
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
                            name="jenis" id="jenis" placeholder="Pilih Jenis">
                            <option value="">Pilih Jenis Grading</option>
                            @foreach ($MasterJenisGradingKasar as $MasterJGK)
                                <option value="{{ $MasterJGK->nama }}">
                                    {{ $MasterJGK->nama }}</option>
                            @endforeach
                        </select>
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
                                <th scope="col" class="text-center">Nomor Grading</th>
                                <th scope="col" class="text-center">ID Box Raw Material</th>
                                <th scope="col" class="text-center">Nomor Batch</th>
                                <th scope="col" class="text-center">Nomor Nota Internal</th>
                                <th scope="col" class="text-center">Nama Supplier</th>
                                <th scope="col" class="text-center">Jenis Adding</th>
                                <th scope="col" class="text-center">Berat Adding</th>
                                <th scope="col" class="text-center">Kadar Air</th>
                                <th scope="col" class="text-center">Jenis Grading</th>
                                <th scope="col" class="text-center">Berat Grading</th>
                                <th scope="col" class="text-center">Pcs Grading</th>
                                <th scope="col" class="text-center">ID Box Grading Kasar</th>
                                <th scope="col" class="text-center">Susut</th>
                                <th scope="col" class="text-center">Modal</th>
                                <th scope="col" class="text-center">Total Modal</th>
                                <th scope="col" class="text-center">Keterangan</th>
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
                    $('#jenis_adding').val(response.jenis);
                    $('#berat_adding').val(response.berat);
                    $('#kadar_air').val(response.kadar_air);
                    $('#modal').val(response.modal);
                    $('#total_modal').val(response.total_modal);
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });

        $('#tujuan_kirim').on('change', function() {
            // Mengambil nilai tujuan_kirim yang dipilih
            let selectedPcc = $(this).val();

            // Melakukan permintaan AJAX ke controller untuk mendapatkan data
            $.ajax({
                url: '{{ route('PrmRawMaterialOutput.setpcc') }}',
                method: 'GET',
                data: {
                    tujuan_kirim: selectedPcc
                },
                success: function(response) {
                    // Mengatur nilai elemen-elemen sesuai dengan respons dari server
                    $('#letak_tujuan').val(response.letak_tujuan);
                    $('#inisial_tujuan').val(response.inisial_tujuan);
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });

        // Fungsi generateNomorBSTB (letakkan di sini atau muat dari file eksternal)
        function generateNomorBSTB(inisial_tujuan) {
            const inisialTujuan = document.getElementById('inisial_tujuan').value;
            const now = new Date();
            const tahun = now.getFullYear().toString().substr(-2);
            const bulan = ('0' + (now.getMonth() + 1)).slice(-2);
            const tanggal = ('0' + now.getDate()).slice(-2);
            const jam = ('0' + now.getHours()).slice(-2);
            const menit = ('0' + now.getMinutes()).slice(-2);
            const detik = ('0' + now.getSeconds()).slice(-2);

            const nomor_bstb = `BSTB_PNE_${tanggal}${bulan}${tahun}-${jam}${menit}${detik}_${inisial_tujuan}`;

            // Menampilkan hasil ke dalam elemen HTML dengan ID 'hasil_nomor_bstb'
            // $('#hasil_nomor_bstb').text(nomor_bstb);
            return nomor_bstb;
            console.log(nomor_bstb);
        }

        // Event listener untuk perubahan nilai pada total modal
        $('#modal').on('input', updateTotalmodal);
        $('#berat').on('input', updateTotalmodal);

        function updateTotalmodal() {
            // Mendapatkan nilai berat nota dan berat bersih
            const modal = parseFloat($('#modal').val());
            const berat = parseFloat($('#berat').val());

            // Melakukan perhitungan selisih berat
            const totalmodal = berat * modal;

            // Memasukkan hasil perhitungan ke dalam input selisih berat
            $('#total_modal').val(isNaN(totalmodal) ? '' : totalmodal);
        }

        // Event listener untuk perubahan nilai pada berat nota atau berat bersih
        $('#berat_masuk').on('change', updateSelisihBerat);
        $('#berat').on('input', updateSelisihBerat);

        function updateSelisihBerat() {
            // Mendapatkan nilai berat nota dan berat bersih
            const berat_masuk = parseFloat($('#berat_masuk').val());
            const berat = parseFloat($('#berat').val());
            const selisihBerat = berat_masuk - berat;

            // Memasukkan hasil perhitungan ke dalam input selisih berat
            $('#selisih_berat').val(isNaN(selisihBerat) ? '' : selisihBerat);
        }

        var dataArray = [];
        var dataStock = [];

        function addRow() {
            // Mengambil nilai dari input
            var doc_no = $('#doc_no').val();
            var nomor_batch = $('#nomor_batch').val();
            var id_box = $('#id_box').val();
            var nama_supplier = $('#nama_supplier').val();
            var jenis = $('#jenis').val();
            var berat_masuk = $('#berat_masuk').val();
            var berat = $('#berat').val();
            var selisih_berat = $('#selisih_berat').val();
            var kadar_air = $('#kadar_air').val();
            var tujuan_kirim = $('#tujuan_kirim').val();
            var letak_tujuan = $('#letak_tujuan').val();
            var inisial_tujuan = $('#inisial_tujuan').val();
            var modal = $('#modal').val();
            var total_modal = $('#total_modal').val();
            var keterangan_item = $('#keterangan_item').val();
            var user_created = $('#user_created').val();

            // Validasi input (sesuai kebutuhan)
            if (!id_box || !nomor_batch) {
                alert('ID and nomor_batch are required.');
                return;
            }

            // Memanggil fungsi generateNomorBSTB untuk mendapatkan nomor_bstb
            var nomor_bstb = generateNomorBSTB(inisial_tujuan);

            // Menambahkan data ke dalam tabel
            var newRow = '<tr><td>' + doc_no + '</td><td>' + nomor_bstb + '</td><td>' + nomor_batch + '</td><td>' + id_box +
                '</td><td>' + nama_supplier + '</td><td>' + jenis + '</td><td>' + berat_masuk + '</td><td>' +
                berat + '</td><td>' + selisih_berat + '</td><td>' + kadar_air + '</td><td>' + tujuan_kirim + '</td><td>' +
                letak_tujuan + '</td><td>' + inisial_tujuan + '</td><td>' +
                modal + '</td><td>' + total_modal + '</td><td>' + keterangan_item + '</td><td>' + user_created +
                '</td></tr>';

            $('#tableBody').append(newRow);

            // Menambahkan data ke dalam array
            dataArray.push({
                doc_no: doc_no,
                nomor_bstb: nomor_bstb,
                nomor_batch: nomor_batch,
                id_box: id_box,
                nama_supplier: nama_supplier,
                jenis: jenis,
                berat_masuk: berat_masuk,
                berat: berat,
                selisih_berat: selisih_berat,
                kadar_air: kadar_air,
                tujuan_kirim: tujuan_kirim,
                letak_tujuan: letak_tujuan,
                inisial_tujuan: inisial_tujuan,
                modal: modal,
                total_modal: total_modal,
                keterangan_item: keterangan_item,
                user_created: user_created,
            });
            dataStock = [];
            dataStock.push({
                id_box: id_box,
                doc_no: doc_no,
                // berat_masuk: berat_masuk,
                berat: berat,
                selisih_berat: selisih_berat,
                kadar_air: kadar_air,
                modal: modal,
                total_modal: total_modal,
                keterangan_item: keterangan_item,
                user_created: user_created,
            });
            console.log(dataStock);
            // Membersihkan nilai input setelah ditambahkan
            $('#id_box').val('<option></option>');
            $('#nomor_batch').val('');
            $('#nama_supplier').val('');
            $('#jenis').val('');
            $('#berat_masuk').val('');
            $('#berat').val('');
            $('#selisih_berat').val('');
            $('#kadar_air').val('');
            $('#tujuan_kirim').val('');
            $('#letak_tujuan').val('');
            $('#inisial_tujuan').val('');
            $('#modal').val('');
            $('#total_modal').val('');
            $('#keterangan_item').val('');
            // Menonaktif kan nilai input ketika ditambah
            $('#doc_no').prop('readonly', true);
            $('#nomor_bstb').prop('readonly', true);
            $('#nomor_batch').prop('readonly', true);
            $('#keterangan').prop('readonly', true);
            $('#user_created').prop('readonly', true);
        }

        function getArray() {
            // Menampilkan array di konsol untuk tujuan debugging
            console.log(dataArray);
        }

        function sendData() {
            console.log(dataArray);
            // Mengirim data ke server menggunakan AJAX
            $.ajax({
                url: `{{ route('PrmRawMaterialOutput.sendData') }}`, // Ganti dengan URL endpoint yang sesuai
                method: 'POST',
                data: {
                    data: JSON.stringify(dataArray),
                    dataStock: JSON.stringify(dataStock),
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json', // payload is json,
                success: function(response) {
                    // alert('Success: ' + response.message); // Tampilkan pesan berhasil
                    // window.location.href = response.redirectTo; // Redirect ke halaman lain
                    Swal.fire({
                        title: 'Success!',
                        text: 'Data berhasil disimpan.',
                        icon: 'success'
                    }).then((result) => {
                        // Redirect ke halaman lain setelah menekan tombol "OK" pada SweetAlert
                        if (result.isConfirmed) {
                            window.location.href = response
                                .redirectTo; // Ganti dengan URL tujuan redirect Anda
                        }
                    });
                },
                error: function(error) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Terjadi kesalahan. Silakan coba lagi.',
                        icon: 'error'
                    });
                    console.log('Validation Errors:', response.responseJSON.errors);
                }
            });

            // Membersihkan array setelah data dikirim
            // dataArray = [];
        }
    </script>
@endsection
{{-- @section('script')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
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
                    // let created_at = response.created_at;
                    generateNomorNotaInternal(inisial_supplier);
                    // generateNomorNotaInternal(created_at);
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
        // generate nomor internal
        function generateNomorNotaInternal(inisial_supplier) {
            const nomorNotaSupplier = $('#nomor_nota_supplier').val();
            const namaSupplier = $('#nama_supplier').val();
            // ambil tanggal, bulan, tahun
            const now = new Date();
            const tahun = now.getFullYear().toString().substr(-2); // Ambil 2 digit terakhir tahun
            const bulan = ('0' + (now.getMonth() + 1)).slice(-2); // Menambah '0' jika satu digit
            const tanggal = ('0' + now.getDate()).slice(-2);

            // Membentuk nomor nota internal dengan menggabungkan nama supplier dan nomor nota supplier
            const nomorNotaInternal = `${inisial_supplier}_${nomorNotaSupplier}_${tanggal}${bulan}${tahun}`;
            // console.log(nomorNotaInternal);

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
            const beratNota = parseFloat($('#berat_nota').val());
            const hargaNota = parseFloat($('#harga_nota').val());

            // Melakukan perhitungan total harga nota
            const totalHargaNota = beratNota * hargaNota;

            // Memasukkan hasil perhitungan ke dalam input total harga nota menggunakan jQuery
            $('#total_harga_nota').val(isNaN(totalHargaNota) ? '' : totalHargaNota.toFixed(2));
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
        var dataArray = [];
        var dataHeader = [];
        var dataStock = [];
        var dataStockHistory = [];

        // function isDuplicateData(nomorPO, nomorBatch) {
        //     return dataHeader.some(data => data.nomor_po === nomorPO && data.nomor_batch === nomorBatch);
        // }

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
                alert('Harap isi semua kolom.');
                return; // Berhenti jika ada input yang kosong
            }
            // Mengubah atribut readonly menggunakan jQuery
            $('#nomor_po').prop('readonly', true);
            $('#nomor_batch').prop('readonly', true);
            $('#nomor_nota_supplier').prop('readonly', true);
            $('#nama_supplier').prop('disabled', true); // Jika ingin menjadikan select readonly
            // Menambahkan data ke dalam tabel
            var newRow = '<tr>' +
                // '<td>' + doc_no + '</td>' +
                '<td>' + jenis + '</td>' +
                '<td>' + berat_nota + '</td>' +
                '<td>' + berat_kotor + '</td>' +
                '<td>' + berat_bersih + '</td>' +
                '<td>' + selisih_berat + '</td>' +
                '<td>' + kadar_air + '</td>' +
                '<td>' + id_box + '</td>' +
                '<td>' + harga_nota + '</td>' +
                '<td>' + total_harga_nota + '</td>' +
                '<td>' + harga_deal + '</td>' +
                '<td>' + keterangan + '</td>' +
                '<td>' + user_created + '</td>' +
                '</tr>';
            $('#dataTable tbody').append(newRow);
            // $('#myForm')[0].reset();

            // Menambahkan data ke dalam array
            dataArray.push({
                id_box: id_box,
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
                keterangan: keterangan,
                user_created: user_created,

            });
            console.log(dataArray);
            dataHeader = [];
            dataHeader.push({
                doc_no: doc_no,
                nomor_po: nomor_po,
                nomor_batch: nomor_batch,
                nomor_nota_supplier: nomor_nota_supplier,
                nomor_nota_internal: nomor_nota_internal,
                nama_supplier: nama_supplier,
                keterangan: keterangan,
                user_created: user_created,
            });

            // Membersihkan nilai input setelah ditambahkan
            // $('#jenis').val('1');
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

        function getArray() {
            // Menampilkan array di konsol untuk tujuan debugging
            console.log(dataArray);
        }

        function simpanData() {
            console.log(dataArray);
            // Mengirim data ke server menggunakan AJAX
            $.ajax({
                url: `{{ route('prm_raw_material_input.simpanData') }}`, // Ganti dengan URL endpoint yang sesuai
                method: 'POST',
                data: {
                    data: JSON.stringify(dataArray),
                    dataHeader: JSON.stringify(dataHeader),
                    dataStock: JSON.stringify(dataStock),
                    // dataStockHistory: JSON.stringify(dataStockHistory),
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json', // payload is json,
                success: function(response) {
                    console.log('Data sent successfully:', response);
                    window.location.href = `{{ route('prm_raw_material_input.index') }}`;
                },
                error: function(error) {
                    console.error('Error sending data:', error);
                }
            });
        }
    </script>
@endsection --}}
