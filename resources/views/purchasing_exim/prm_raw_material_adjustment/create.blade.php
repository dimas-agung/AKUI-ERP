@extends('layouts.master1')
@section('menu')
    Purchasing & EXIM
@endsection
@section('title')
    Purchasing Raw Material Input Adjustment
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card mt-2 border border-primary border-3">
            <div class="card-header">
                <div class="d-flex align-items-center mb-3">
                    <h4 class="card-title">Input Purchasing Raw Material Adjustment</h4>
                </div>
                <hr>
                <form method="POST" class="row g-3" id="myForm">
                    @csrf
                    <div class="col-md-4">
                        <label for="no_doc" class="form-label">Nomor Adjustment</label>
                        <input type="text" class="form-control" id="nomor_adjustment" name="nomor_adjustment"
                            value="" readonly>

                    </div>


                    <div class="col-md-4">
                        <label for="nomor_batch" class="form-label">Nomor Batch Adjustment</label>
                        <input type="text" class="form-control" id="nomor_batch_adjustment" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="tanggal_adjustment" class="form-label">Tanggal Adjustment</label>
                        <input type="date" class="form-control" id="tanggal_adjustment" onchange="generateNomorAdjustment()">
                    </div>
                    <div class="col-md-4">
                        <label for="basic-usage" class="form-label">Pilih Id Box Raw Material :</label>
                        <select class="select2 form-select" style="width: 100%;" tabindex="-1" aria-hidden="true"
                            name="id_box_raw_material" id="id_box_raw_material" placeholder="Pilih Id Box">
                            <option value="">Pilih Id Box</option>
                            @foreach ($PrmRawMaterialStock as $MasterSPRM)
                                {{-- @if ($MasterSPRM->status == 1) --}}
                                    <option value="{{ $MasterSPRM->id_box }}">
                                        {{ $MasterSPRM->id_box }}
                                    </option>
                                {{-- @endif --}}
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="nama_supplier" class="form-label">Nama Supplier</label>
                        <input type="text" class="form-control" id="nama_supplier" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="nomor_batch" class="form-label">Nomor Batch</label>
                        <input type="text" class="form-control" id="nomor_batch" readonly>
                    </div>
                    <div class="col-md-flex">
                        <hr>
                    </div>
                    <div class="col-md-3">
                        <label for="basic-usage" class="form-label">jenis</label>
                        <input type="text" class="form-control" id="jenis" readonly>
                        <input type="hidden" name="modal" id="modal">
                    </div>
                    <div class="col-md-3">
                        <label for="berat_saldo_terakhir" class="form-label">Berat Saldo Terakhir</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"

                            class="form-control" id="berat_saldo_terakhir" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="berat_adjustment" class="form-label">Berat Adjustment</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"

                            class="form-control" id="berat_adjustment">
                    </div>
                    <div class="col-md-3">
                        <label for="berat_saldo_awal" class="form-label">Berat Saldo Awal</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="berat_saldo_awal" readonly>
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
        <div class="card mt-2 border border-primary border-3">
            <div class="card-header">
                <div class="card-title">Validasi</div>
                <div class="card-body" style="overflow: scroll" content="{{ csrf_token() }}">
                    <table class="table" id="dataTable">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">Tgl Adjustment</th>
                                <th scope="col" class="text-center">No Adjustment</th>
                                <th scope="col" class="text-center">Id Box Raw Material</th>
                                <th scope="col" class="text-center">Nomor Batch</th>
                                <th scope="col" class="text-center">Nama Supplier</th>
                                <th scope="col" class="text-center">Jenis</th>
                                <th scope="col" class="text-center">Nomor Batch Adjustment</th>
                                <th scope="col" class="text-center">Berat Adjustment</th>
                                <th scope="col" class="text-center">Berat Saldo Terakhir</th>
                                <th scope="col" class="text-center">Berat Saldo Awal</th>
                                <th scope="col" class="text-center">Keterangan</th>
                                <th scope="col" class="text-center">Actions</th>
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

        $('#berat_adjustment').on('input', calculateBerat);

        // idbox
        $('#id_box_raw_material').on('change', function() {
            // Mengambil nilai id_box yang dipilih
            let selectedbox = $(this).val();
            // Melakukan permintaan AJAX ke controller untuk mendapatkan nomor batch
            $.ajax({
                url: `{{ route('PrmRawMaterialAdjustment.getDataStock') }}`,
                method: 'GET',
                data: {
                    id_box_raw_material: selectedbox
                },
                success: function(response) {
                    $('#nomor_batch').val(response.nomor_batch)
                    $('#nomor_batch_adjustment').val(response.nomor_batch)
                    $('#nama_supplier').val(response.nama_supplier)
                    $('#jenis').val(response.jenis)
                    $('#modal').val(response.modal)
                    $('#berat_saldo_terakhir').val(response.sisa_berat)
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });

        // generate nomor internal
        function generateNomorAdjustment() {

                const tanggal_adjustment = $('#tanggal_adjustment').val();

                var date = new Date($('#tanggal_adjustment').val());
                var day = ("0" + date.getDate()).slice(-2);
                var month =date.getMonth();
                if (month < 10) {
                    month = '0' + month;
                }
             
                var year = date.getFullYear();
                const nomor_adjustment = `NASA_${day}${month}${year}_A`;
                $('#nomor_adjustment').val(nomor_adjustment);

        }


        function calculateBerat() {
            // Mendapatkan nilai berat nota dan berat bersih
            const berat_adjustment = parseFloat($('#berat_adjustment').val());
            const berat_saldo_terakhir = parseFloat($('#berat_saldo_terakhir').val());

            // Melakukan perhitungan selisih berat
            const berat_saldo_awal = berat_saldo_terakhir - berat_adjustment;

            // Memasukkan hasil perhitungan ke dalam input selisih berat
            $('#berat_saldo_awal').val(isNaN(berat_saldo_awal) ? '' : berat_saldo_awal);
        }

    </script>
    <script>
        // test
        let dataArray = [];
        let dataHeader = [];
        let idBoxGroups = [];

        function addRow() {
            // Mengambil nilai dari input
            let id_box_raw_material = $('#id_box_raw_material').val();;
            let nomor_adjustment = $('#nomor_adjustment').val();
            let tanggal_adjustment = $('#tanggal_adjustment').val();
            let nomor_batch = $('#nomor_batch').val();
            let nomor_batch_adjustment = $('#nomor_batch_adjustment').val();
            let nama_supplier = $('#nama_supplier').val();
            let jenis = $('#jenis').val();
            let modal = $('#modal').val();
            let berat_adjustment = $('#berat_adjustment').val();
            let berat_saldo_awal = $('#berat_saldo_awal').val();
            let berat_saldo_terakhir = $('#berat_saldo_terakhir').val();
            let keterangan = $('#keterangan').val();
            let user_created = $('#user_created').val();

            // Validasi input (sesuai kebutuhan)
            if (nomor_adjustment.trim() === '' || nomor_batch.trim() === '' || tanggal_adjustment.trim() === '' ||
            berat_adjustment.trim() === '' || nama_supplier.trim() === '' || jenis.trim() === '' ||
                nomor_batch_adjustment.trim() === '' ) {
                // Menampilkan SweetAlert untuk pesan error
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Harap isi semua kolom.'
                });
                return; // Berhenti jika ada input yang kosong
            }

            // Mengubah atribut readonly menggunakan jQuery
            $('#nomor_adjustment').prop('readonly', true);
            $('#tanggal_adjustment').prop('readonly', true); // Jika ingin menjadikan select readonly



                // Menambahkan data ke dalam tabel
                var newRow = `<tr>` +
                    `<td class="text-center">${tanggal_adjustment}</td>` +
                    `<td class="text-center">${nomor_adjustment}</td>` +
                    `<td class="text-center">${id_box_raw_material}</td>` +
                    `<td class="text-center">${nomor_batch}</td>` +
                    `<td class="text-center">${nama_supplier}</td>` +
                    `<td class="text-center">${jenis}</td>` +
                    `<td class="text-center">${nomor_batch_adjustment}</td>` +
                    `<td class="text-center">${berat_adjustment}</td>` +
                    `<td class="text-center">${berat_saldo_terakhir}</td>` +
                    `<td class="text-center">${berat_saldo_awal}</td>` +
                    `<td class="text-center">${keterangan}</td>` +
                    `<td class="text-center">${user_created}</td>` +
                    // `<td class="text-center">${fix_harga_deal.toFixed(4)}</td>` +
                    `<td class="text-center"><button class="btn btn-danger" onclick="hapusBaris(this)">Delete</button></td>` +
                    `</tr>`
                $('#dataTable tbody').append(newRow);


            // Menambahkan data ke dalam array
            dataArray.push({
                // id_box: id_box,
                id_box_raw_material: id_box_raw_material,
                nomor_adjustment: nomor_adjustment,
                nomor_batch: nomor_batch,
                tanggal_adjustment: tanggal_adjustment,
                nomor_batch_adjustment: nomor_batch_adjustment,
                nomor_batch: nomor_batch,
                nama_supplier: nama_supplier,

                modal: modal,
                jenis: jenis,
                berat_adjustment: berat_adjustment,
                berat_saldo_terakhir: berat_saldo_terakhir,
                berat_saldo_awal: berat_saldo_awal,

                keterangan: keterangan,
                user_created: user_created,

            });


            // Membersihkan nilai input setelah ditambahkan
            // $('#jenis').val(null).trigger('change');
            $('#id_box_raw_material').val($('#jenis option:first').val()).trigger('change');
            $('#berat_adjustment').val('');
            $('#berat_saldo_terakhir').val('');
            $('#nama_supplier').val('');
            $('#nomor_batch').val('');
            $('#nomor_batch_adjustment').val('');
            $('#jenis').val('');
            $('#berat_adjustment').val('');
            $('#berat_saldo_terakhir').val('');
            $('#berat_saldo_awal').val('');
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
                url: `{{ route('PrmRawMaterialAdjustment.store') }}`,
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
                        title: 'Sukses',
                        text: 'Data berhasil dikirim.'
                    });

                    // Redirect atau lakukan tindakan lain setelah berhasil
                    window.location.href = `{{ route('PrmRawMaterialAdjustment.index') }}`;
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
