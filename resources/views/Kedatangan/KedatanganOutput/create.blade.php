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
                        <input type="hidden" id="inisial_tujuan">
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
                        <input type="hidden" id="harga_estimasi">
                    </div>

                    <div class="col-md-3">
                        <label for="berat" class="form-label">Berat</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="berat">
                    </div>

                    <div class="col-md-3">
                        <label for="pcs" class="form-label">Pcs</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="pcs">
                    </div>

                    <div class="col-md-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan">
                    </div>

                    <div class="col-md-3">
                        <label for="total_berat" class="form-label">Total Berat</label>
                        <input type="text" class="form-control" id="total_berat" readonly>
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
                                @role('admin')
                                    <th scope="col" class="text-center">Modal</th>
                                    <th scope="col" class="text-center">Total Modal</th>
                                @endrole
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
                        jenis: selectedJenis
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
            $('#tujuan_kirim').on('change', function() {
                selectedTujuanKirim = $(this).val();

                $.ajax({
                    url: '{{ route('KedatanganOutput.setTujuanKirim') }}',
                    method: 'GET',
                    data: {
                        tujuan_kirim: selectedTujuanKirim
                    },
                    success: function(response) {
                        console.log(response);

                        // Mengatur nilai sesuai dengan respons dari server
                        $('#tujuan_kirim').val(response.tujuan_kirim);
                        $('#inisial_tujuan').val(response.inisial_tujuan);

                        // Memanggil fungsi generateNomorBSTB dengan nilai baru
                        generateNomorBSTB(response.inisial_tujuan);
                        generateNomorJob(response.inisial_tujuan);
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            });
            // Generate Nomor BSTB
            function generateNomorBSTB(selectedInisialTujuan) {
                if (!selectedInisialTujuan) {
                    // Jika tidak ada nilai untuk inisial tujuan, kosongkan nomor_bstb
                    $('#nomor_bstb').val('');
                    return '';
                }
                const now = new Date();
                const tahun = now.getFullYear().toString().substr(-2);
                const bulan = ('0' + (now.getMonth() + 1)).slice(-2);
                const tanggal = ('0' + now.getDate()).slice(-2);
                const jam = ('0' + now.getHours()).slice(-2);
                const menit = ('0' + now.getMinutes()).slice(-2);
                const detik = ('0' + now.getSeconds()).slice(-2);

                const nomorBSTB =
                    `BSTB_${tanggal}${bulan}${tahun}-${jam}${menit}${detik}_UKD_${selectedInisialTujuan}`;
                console.log(nomorBSTB);

                $('#nomor_bstb').val(nomorBSTB);
                return nomorBSTB;
            }
            // Generate Nomor Job
            function generateNomorJob() {
                // Ambil nilai berat, inisial
                const berat = $('#berat').val();
                const inisialTujuan = $('#inisial_tujuan').val();

                if (!inisialTujuan) {
                    $('#nomor_job').val('');
                    return '';
                }

                // Mendapatkan tanggal dan waktu saat ini
                const now = new Date();
                const tahun = now.getFullYear().toString().substr(-2);
                const bulan = ('0' + (now.getMonth() + 1)).slice(-2);
                const tanggal = ('0' + now.getDate()).slice(-2);
                const jam = ('0' + now.getHours()).slice(-2);
                const menit = ('0' + now.getMinutes()).slice(-2);
                const detik = ('0' + now.getSeconds()).slice(-2);

                // Membuat nomor pekerjaan
                const nomorJob =
                    `${tanggal}${bulan}${tahun}-${jam}${menit}${detik}_UKD_${inisialTujuan}`;
                console.log(nomorJob);

                // Menetapkan nomor pekerjaan ke elemen input
                $('#nomor_job').val(nomorJob);
            }
            // Listener #berat
            $('#berat').on('input', function() {
                generateNomorJob();
            });
        });

        // Hitung Total Berat
        function hitungTotalBerat() {
            let totalBerat = 0;
            dataArray.forEach(element => {
                totalBerat += parseFloat(element.berat)
            });

            // Menampilkan total berat di input #total_berat
            $('#total_berat').val(totalBerat);
        }

        // Validasi Data
        function validateForm() {
            // Mendefinisikan variabel untuk menyimpan kolom yang belum diisi
            let emptyFields = [];

            // Mendapatkan nilai dari semua input
            let nomor_batch = $('#nomor_batch').val();
            let tujuan_kirim = $('#tujuan_kirim').val();
            let berat = $('#berat').val();
            let pcs = $('#pcs').val();
            let jenis = $('#jenis').val();
            let nomor_job = $('#nomor_job').val();
            let nomor_bstb = $('#nomor_bstb').val();
            let user_created = $('#user_created').val();

            // Memeriksa setiap input, dan jika kosong, tambahkan ke daftar kolom yang belum diisi
            if (!nomor_batch) emptyFields.push('Nomor Batch');
            if (!jenis) emptyFields.push('Jenis');
            if (!tujuan_kirim) emptyFields.push('Tujuan Kirim');
            if (!berat) emptyFields.push('Berat');
            if (!pcs) emptyFields.push('Pcs');
            if (!nomor_job) emptyFields.push('Nomor Job');
            if (!nomor_bstb) emptyFields.push('Nomor BSTB');
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
                let nomor_batch = $('#nomor_batch').val();
                let tujuan_kirim = $('#tujuan_kirim').val();
                let jenis = $('#jenis').val();
                let berat = parseFloat($('#berat').val());
                let pcs = $('#pcs').val();
                let keterangan = $('#keterangan').val();
                let nomor_job = $('#nomor_job').val();
                let nomor_bstb = $('#nomor_bstb').val();
                let modal = parseFloat($('#harga_estimasi').val());
                console.log("Modal = " + modal);
                let total_modal = berat * modal;
                let user_created = $('#user_created').val();
                // dataArray[] = [

                // ];
                // Tambahkan data ke dataArray
                dataArray.push({
                    nomor_batch,
                    tujuan_kirim,
                    jenis,
                    berat,
                    pcs,
                    nomor_job,
                    nomor_bstb,
                    modal,
                    total_modal,
                    keterangan,
                    user_created
                });
                renderTable();
                // disable input
                $('#nomor_batch').prop('disabled', true);
                $('#tujuan_kirim').prop('disabled', true);

                // Mengosongkan nilai dropdown
                $('#jenis').val(null).trigger('change');
                $('#berat').val('');
                $('#pcs').val('');
                $('#keterangan').val('');
                $('#nomor_job').val('');

                hitungTotalBerat();
            }
        }

        // Hapus Baris
        function hapusBaris(button) {
            // Dapatkan elemen baris terkait dengan tombol delete yang diklik
            let row = $(button).closest('tr');

            row.remove();

            let rowIndex = row.index();
            dataArray.splice(rowIndex, 1);

            // Cek apakah tabel tidak memiliki baris data lagi
            if ($('#dataTable tbody tr').length === 0) {
                $('#nomor_batch').prop('disabled', false).val(null).trigger('change');
                $('#tujuan_kirim').prop('disabled', false).val(null).trigger('change');
                $('#nomor_bstb').val('');
                $('#inisial_tujuan').val('');
                $('#jenis').val(null).trigger('change');
                $('#nomor_job').val('');
                $('#berat').val('');
                $('#pcs').val('');
                $('#keterangan').val('');

                hitungTotalBerat();

            } else {
                $('#jenis').val(null).trigger('change');
                $('#nomor_job').val('');
                $('#berat').val('');
                $('#pcs').val('');
                $('#keterangan').val('');

                hitungTotalBerat();
            }
        }

        function renderTable() {
            let newRow = '';
            $('#dataTable tbody').empty();
            dataArray.forEach(v => {
                newRow += `<tr>` +
                    `<td class="text-center">${v.nomor_batch}</td>` +
                    `<td class="text-center">${v.jenis}</td>` +
                    `<td class="text-center">${v.tujuan_kirim}</td>` +
                    `<td class="text-center">${v.berat}</td>` +
                    `<td class="text-center">${v.pcs}</td>` +
                    `<td class="text-center">${v.nomor_job}</td>` +
                    `<td class="text-center">${v.nomor_bstb}</td>` +
                    @role('admin')
                        `<td class="text-center">${v.modal}</td>` +
                        `<td class="text-center">${v.total_modal}</td>` +
                    @endrole
                `<td class="text-center">${v.keterangan}</td>` +
                `<td class="text-center">${v.user_created}</td>` +
                `<td class="text-center"><button class="btn btn-danger" onclick="hapusBaris(this)">Delete</button></td>` +
                `</tr>`;
            });
            // Tambahkan Kedalam Tabel
            $('#dataTable tbody').append(newRow);
        }

        function sendData() {

            console.log(dataArray);
            // Mengirim data ke server menggunakan AJAX
            $.ajax({
                url: '{{ route('KedatanganOutput.store') }}',
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
