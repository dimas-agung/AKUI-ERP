@extends('layouts.master1')
@section('menu')
    Pre Cleaning
@endsection
@section('title')
    Pre Cleaning Output
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card mt-2">
            <div class="card-header">
                <div class="d-flex align-items-center mb-3">
                    <h4 class="card-title">Pre Cleaning Output</h4>
                </div>
                <hr>
                <form method="POST" class="row g-3" id="myForm">
                    <div class="col-md-12">
                        <label for="basic-usage" class="form-label">Nomor Job</label>
                        <select class="choices form-select" style="width: 100%;" tabindex="-1" aria-hidden="true"
                            name="nomor_job" id="nomor_job" placeholder="Pilih Nomor Job">
                            <option value="">Pilih Nomor Job</option>
                            @foreach ($pre_cleaning_stocks as $PreCS)
                                <option value="{{ $PreCS->nomor_job }}">
                                    {{ $PreCS->nomor_job }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="id_box_grading_kasar" class="form-label">ID Box Grading Kasar</label>
                        <input type="text" class="form-control" id="id_box_grading_kasar" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="nomor_bstb" class="form-label">Nomor BSTB</label>
                        <input type="text" class="form-control" id="nomor_bstb" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="id_box_raw_material" class="form-label">ID Box Raw Material</label>
                        <input type="text" class="form-control" id="id_box_raw_material" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="nomor_batch" class="form-label">Nomor Batch</label>
                        <input type="text" class="form-control" id="nomor_batch" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="nomor_nota_internal" class="form-label">Nomor Nota Internal</label>
                        <input type="text" class="form-control" id="nomor_nota_internal" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="nama_supplier" class="form-label">Nama Supplier</label>
                        <input type="text" class="form-control" id="nama_supplier" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="jenis_raw_material" class="form-label">Jenis Raw Material</label>
                        <input type="text" class="form-control" id="jenis_raw_material" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="jenis_kirim" class="form-label">Jenis Kirim</label>
                        <input type="text" class="form-control" id="jenis_kirim" readonly>
                    </div>
                    <div class="col-md-2">
                        <label for="berat_kirim" class="form-label">Berat Kirim</label>
                        <input type="text" class="form-control" id="berat_kirim" readonly>
                    </div>
                    <div class="col-md-2">
                        <label for="pcs_kirim" class="form-label">Pcs Kirim</label>
                        <input type="text" class="form-control" id="pcs_kirim" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="tujuan_kirim" class="form-label">Tujuan Kirim</label>
                        <input type="text" class="form-control" id="tujuan_kirim" readonly>
                    </div>

                    <div class="col-md-3">
                        <label for="modal" class="form-label">Modal</label>
                        <input type="text" class="form-control" id="modal" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="total_modal" class="form-label">Total Modal</label>
                        <input type="text" class="form-control" id="total_modal" readonly>
                    </div>
                    <div class="col-md-2">
                        <label for="kadar_air" class="form-label">Kadar Air</label>
                        <input type="text" class="form-control" id="kadar_air" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="basic-usage" class="form-label">Operator Sikat & Kompresor</label>
                        <select class="choices form-select" style="width: 100%;" tabindex="-1" aria-hidden="true"
                            name="operator_sikat_dan_kompresor" id="operator_sikat_dan_kompresor"
                            placeholder="Pilih Operator Sikat & Kompresor">
                            <option value="">Pilih Operator Sikat & Kompresor</option>
                            @foreach ($master_operators->sortBy('nama') as $MasterSPRM)
                                @if ($MasterSPRM->job == 'Sikat + Kompresor')
                                    <option value="{{ $MasterSPRM->nama }}">
                                        {{ $MasterSPRM->nama }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="basic-usage" class="form-label">Operator Flex & Poles</label>
                        <select class="choices form-select" style="width: 100%;" tabindex="-1" aria-hidden="true"
                            name="operator_flex_dan_poles" id="operator_flex_dan_poles"
                            placeholder="Pilih Operator Flex & Poles">
                            <option value="">Pilih Operator Flex & Poles</option>
                            @foreach ($master_operators->sortBy('nama') as $MasterSPRM)
                                @if ($MasterSPRM->job == 'Flek + Poles')
                                    <option value="{{ $MasterSPRM->nama }}">
                                        {{ $MasterSPRM->nama }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="basic-usage" class="form-label">Operator Cutter</label>
                        <select class="choices form-select" style="width: 100%;" tabindex="-1" aria-hidden="true"
                            name="operator_cutter" id="operator_cutter" placeholder="Pilih Operator Cutter">
                            <option value="">Pilih Operator Cutter</option>
                            @foreach ($master_operators->sortBy('nama') as $MasterSPRM)
                                @if ($MasterSPRM->job == 'Cutter')
                                    <option value="{{ $MasterSPRM->nama }}">
                                        {{ $MasterSPRM->nama }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="kuningan" class="form-label">Kuningan</label>
                        <input type="text" class="form-control" id="kuningan">
                    </div>
                    <div class="col-md-2">
                        <label for="Sterofoam" class="form-label">Sterofoam</label>
                        <input type="text" class="form-control" id="Sterofoam">
                    </div>
                    <div class="col-md-2">
                        <label for="karat" class="form-label">Karat</label>
                        <input type="text" class="form-control" id="karat">
                    </div>
                    <div class="col-md-2">
                        <label for="rontokan_flex" class="form-label">Rontokan Flex</label>
                        <input type="text" class="form-control" id="rontokan_flex">
                    </div>
                    <div class="col-md-2">
                        <label for="rontokan_bahan" class="form-label">Rontokan Bahan</label>
                        <input type="text" class="form-control" id="rontokan_bahan">
                    </div>
                    <div class="col-md-2">
                        <label for="rontokan_serabut" class="form-label">Rontokan Serabut</label>
                        <input type="text" class="form-control" id="rontokan_serabut">
                    </div>
                    <div class="col-md-3">
                        <label for="ws" class="form-label">WS-0-0-0</label>
                        <input type="text" class="form-control" id="ws">
                    </div>
                    <div class="col-md-3">
                        <label for="berat_precleaning" class="form-label">Berat Precleaning</label>
                        <input type="text" class="form-control" id="berat_precleaning">
                    </div>
                    <div class="col-md-3">
                        <label for="pcs" class="form-label">Pcs</label>
                        <input type="text" class="form-control" id="pcs">
                    </div>
                    <div class="col-md-3">
                        <label for="susut" class="form-label">Susut</label>
                        <input type="text" class="form-control" id="susut">
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
                                <th scope="col" class="text-center">Sisa Berat</th>
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
            // Mengambil nilai id_box yang dipilih
            let selectedNomorJob = $(this).val();
            // Melakukan permintaan AJAX ke controller untuk mendapatkan nomor batch
            $.ajax({
                url: `{{ route('preCleaningOutput.set') }}`,
                method: 'GET',
                data: {
                    nomor_job: selectedNomorJob
                },
                success: function(response) {
                    console.log(response);
                    // Mengatur nilai Nomor Batch sesuai dengan respons dari server
                    $('#id_box_grading_kasar').val(response.id_box_grading_kasar);
                    // $('#nomor_bstb').val(response.nomor_bstb);
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
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });

        // Generate BSTB OUTPUT
        $(document).ready(function() {
            // Menangani perubahan pada dropdown nomor_job
            $('#nomor_job').on('change', function() {
                // Mengambil nilai dari dropdown nomor_job
                var nomorJobValue = $(this).val();
                var nomorJobWithoutLast4 = nomorJobValue.slice(0, -4);

                // Menghitung nomor_bstb berdasarkan rumus nomor_job + UPC (contoh)
                var nomorBSTB = "BSTB_" + nomorJobWithoutLast4 + "_UPC";

                // Memasukkan nilai yang dihasilkan ke dalam input nomor_bstb
                $('#nomor_bstb').val(nomorBSTB);
            });
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
            let operator_sikat_dan_kompresor = $('#operator_sikat_dan_kompresor').val();
            let operator_flex_dan_poles = $('#operator_flex_dan_poles').val();
            let operator_cutter = $('#operator_cutter').val();
            let kuningan = $('#kuningan').val();
            let Sterofoam = $('#Sterofoam').val();
            let karat = $('#karat').val();
            let rontokan_flex = $('#rontokan_flex').val();
            let rontokan_bahan = $('#rontokan_bahan').val();
            let ws = $('#ws').val();
            let berat_precleaning = $('#berat_precleaning').val();
            let pcs = $('#pcs').val();
            let susut = $('#susut').val();

            // Validasi input (sesuai kebutuhan)
            if (!nomor_job || !id_box_grading_kasar) {
                alert('Nomor Job Dan ID Box Grading Kasar Required.');
                return;
            }

            let newRow = '<tr>' +
                '<td class="text-center">' + nomor_job + '</td>' +
                '<td class="text-center">' + id_box_grading_kasar + '</td>' +
                '<td class="text-center">' + nomor_bstb + '</td>' +
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
                '<td class="text-center">' + "sisa_berat" + '</td>' +
                '<td class="text-center"><button class="btn btn-danger" onclick="hapusBaris(this)">Delete</button></td>' +
                '</tr>';
            // Tambahkan Kedalam Tabel
            $('#dataTable tbody').append(newRow);

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
                operator_sikat_dan_kompresor: operator_sikat_dan_kompresor,
                operator_flex_dan_poles: operator_flex_dan_poles,
                operator_cutter: operator_cutter,
                kuningan: kuningan,
                Sterofoam: Sterofoam,
                karat: karat,
                rontokan_flex: rontokan_flex,
                rontokan_bahan: rontokan_bahan,
                ws: ws,
                berat_precleaning: berat_precleaning,
                pcs: pcs,
                susut: susut,
            });

            // Membersihkan nilai input setelah ditambahkan
            $('#nomor_job').val('').trigger('change');
            // $('#nomor_job').val($('#nomor_job option:first').val()).trigger('change');
            $('#id_box_grading_kasar').val();
            $('#nomor_bstb').val();
            $('#id_box_raw_material').val();
            $('#nomor_batch').val();
            $('#nomor_nota_internal').val();
            $('#nama_supplier').val();
            $('#jenis_raw_material').val();
            $('#jenis_kirim').val();
            $('#tujuan_kirim').val();
            $('#modal').val();
            $('#total_modal').val();
            $('#kadar_air').val();
            $('#pcs_kirim').val();
            $('#berat_kirim').val();
        }

        function hapusBaris(button) {
            // Dapatkan elemen baris terkait dengan tombol delete yang diklik
            let row = $(button).closest('tr');

            // Hapus baris dari dataArray berdasarkan indeks baris di tabel
            let rowIndex = row.index();
            dataArray.splice(rowIndex, 1);

            // Hapus baris dari tabel
            row.remove();
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
                url: `{{ route('pre_cleaning_output.simpanData') }}`,
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
                    window.location.href = `{{ route('pre_cleaning_output.index') }}`;
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
