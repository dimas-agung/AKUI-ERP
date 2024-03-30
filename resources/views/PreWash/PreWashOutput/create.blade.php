@extends('layouts.master1')
@section('menu')
    Pre-Wash
@endsection
@section('title')
    Pre-Wash Output
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card border border-primary border-3 mt-2">
            <div class="card-header">
                <div class="d-flex align-items-center mb-3">
                    <h4 class="card-title">Pre-Wash Output</h4>
                </div>
                <hr>
                <form method="POST" class="row g-3" id="myForm">
                    <div class="col-md-12">
                        <label for="basic-usage" class="form-label">Nomor Job</label>
                        <select class="select2 form-select" style="width: 100%;" name="nomor_job" id="nomor_job"
                            data-placeholder="Pilih Nomor Job">
                            <option value="">Pilih Nomor Job</option>
                            @foreach ($PreWashStk as $PreCS)
                                <option value="{{ $PreCS->nomor_job }}">
                                    {{ $PreCS->nomor_job }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="basic-usage" class="form-label">Operator Perendaman</label>
                        <select class="select2 form-select" style="width: 100%;" tabindex="-1" aria-hidden="true"
                            name="operator_perendaman" id="operator_perendaman"
                            data-placeholder="Pilih Operator Perendaman">
                            <option value="">Pilih Operator Perendaman</option>
                            @foreach ($MasterO->sortBy('nama') as $MasterSPRM)
                                @if ($MasterSPRM->job == 'Perendaman' && $MasterSPRM->status == 1)
                                    <option value="{{ $MasterSPRM->nama }}">
                                        {{ $MasterSPRM->nama }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="basic-usage" class="form-label">Operator Bilas</label>
                        <select class="select2 form-select" style="width: 100%;" name="operator_bilas" id="operator_bilas"
                            data-placeholder="Pilih Operator Bilas">
                            <option value="">Pilih Operator Bilas</option>
                            @foreach ($MasterO->sortBy('nama') as $MasterSPRM)
                                @if ($MasterSPRM->job == 'Bilas' && $MasterSPRM->status == 1)
                                    <option value="{{ $MasterSPRM->nama }}">
                                        {{ $MasterSPRM->nama }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="basic-usage" class="form-label">Operator Box</label>
                        <select class="select2 form-select" style="width: 100%;" name="operator_box" id="operator_box"
                            data-placeholder="Pilih Operator Box">
                            <option value="">Pilih Operator Box</option>
                            @foreach ($MasterO->sortBy('nama') as $MasterSPRM)
                                @if ($MasterSPRM->job == 'Box' && $MasterSPRM->status == 1)
                                    <option value="{{ $MasterSPRM->nama }}">
                                        {{ $MasterSPRM->nama }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="nomor_bstb" class="form-label">Nomor BSTB</label>
                        <input type="text" class="form-control" id="nomor_bstb">
                    </div>
                    <div class="col-md-4">
                        <label for="nomor_batch" class="form-label">Nomor Batch</label>
                        <input type="text" class="form-control" id="nomor_batch" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="jenis_job" class="form-label">Jenis Job</label>
                        <input type="text" class="form-control" id="jenis_job" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="tujuan_kirim" class="form-label">Tujuan Kirim</label>
                        <input type="text" class="form-control" id="tujuan_kirim" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="modal" class="form-label">Modal</label>
                        <input type="text" class="form-control" id="modal" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="total_modal" class="form-label">Total Modal</label>
                        <input type="text" class="form-control" id="total_modal" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="berat_job" class="form-label">Berat Job</label>
                        <input type="text" class="form-control" id="berat_job" placeholder="Masukkan berat job">
                    </div>
                    <div class="col-md-6">
                        <label for="pcs_job" class="form-label">Pcs Job</label>
                        <input type="text" class="form-control" id="pcs_job" placeholder="Masukkan pcs job">
                    </div>
                    <div class="col-md-6">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" placeholder="Masukkan Keterangan">
                    </div>
                    <div class="col-md-6">
                        <label for="user_created" class="form-label">Nip Admin</label>
                        <input type="text" class="form-control" id="user_created" value="{{ auth()->user()->nip }}"
                            readonly>
                    </div>
                    <div class="col-12">
                        <button type="button" class="btn btn-primary" onclick="addRow()">Tambah</button>
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
                                <th scope="col" class="text-center">Nomor Job</th>
                                <th scope="col" class="text-center">Nomor Batch</th>
                                <th scope="col" class="text-center">Nomor BSTB</th>
                                <th scope="col" class="text-center">Operator Perendaman</th>
                                <th scope="col" class="text-center">Operator Bilas</th>
                                <th scope="col" class="text-center">Operator Box</th>
                                <th scope="col" class="text-center">Jenis Job</th>
                                <th scope="col" class="text-center">Berat Job</th>
                                <th scope="col" class="text-center">Pcs Job</th>
                                <th scope="col" class="text-center">Tujuan Kirim</th>
                                <th scope="col" class="text-center">Modal</th>
                                <th scope="col" class="text-center">Total Modal</th>
                                <th scope="col" class="text-center">Keterangan</th>
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
                url: `{{ route('preWashOutput.set') }}`,
                method: 'GET',
                data: {
                    nomor_job: selectedNomorJob
                },
                success: function(response) {
                    console.log(response);

                    // Menghitung berat_masuk - berat_keluar
                    let sisaBerat = response.beratjob;

                    // Pemeriksaan jika sisaBerat tidak sama dengan 0
                    if (sisaBerat !== 0) {
                        // Menyimpan sisaBerat dalam variabel baru
                        let sisaBeratFormatted = parseFloat(sisaBerat).toFixed(2);
                        // let sisaBeratFormatted = sisaBerat;

                        // Mengatur nilai Nomor Batch sesuai dengan respons dari server
                        $('#nomor_batch').val(response.nomor_batch);
                        $('#jenis_job').val(response.jenis_job);
                        $('#tujuan_kirim').val(response.tujuan_kirim);
                        $('#modal').val(response.modal);
                        $('#total_modal').val(response.total_modal);
                    } else {
                        // Jika sisaBerat === 0, hapus opsi dan reset nilai input
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Berat Job sama dengan 0. Pilih nomor job lain.',
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

                // Menghasilkan nomor_bstb berdasarkan rumus yang diinginkan
                const nomor_bstb = `BSTB_${tanggal}${bulan}${tahun}_${jam}${menit}${detik}`;

                // Memasukkan nilai yang dihasilkan ke dalam input nomor_bstb
                $('#nomor_bstb').val(nomor_bstb);
                console.log(nomor_bstb);
            }
        });

        let dataArray = [];
        // ADD ROW
        function addRow() {
            // Mengambil nilai dari input
            let nomor_job = $('#nomor_job').val();
            let nomor_batch = $('#nomor_batch').val();
            let nomor_bstb = $('#nomor_bstb').val();
            let operator_perendaman = $('#operator_perendaman').val();
            let operator_bilas = $('#operator_bilas').val();
            let operator_box = $('#operator_box').val();
            let jenis_job = $('#jenis_job').val();
            let berat_job = $('#berat_job').val();
            let pcs_job = $('#pcs_job').val();
            let tujuan_kirim = $('#tujuan_kirim').val();
            let keterangan = $('#keterangan').val();
            let modal = $('#modal').val();
            let total_modal = $('#total_modal').val();
            let user_created = $('#user_created').val();

            // Validasi input (sesuai kebutuhan)
            if (!nomor_job || !user_created) {
                alert('Nomor Job Dan NIP Admin Required.');
                return;
            }

            let newRow = '<tr>' +
                '<td class="text-center">' + nomor_job + '</td>' +
                '<td class="text-center">' + nomor_bstb + '</td>' +
                '<td class="text-center">' + nomor_batch + '</td>' +
                '<td class="text-center">' + operator_perendaman + '</td>' +
                '<td class="text-center">' + operator_bilas + '</td>' +
                '<td class="text-center">' + operator_box + '</td>' +
                '<td class="text-center">' + jenis_job + '</td>' +
                '<td class="text-center">' + berat_job + '</td>' +
                '<td class="text-center">' + pcs_job + '</td>' +
                '<td class="text-center">' + tujuan_kirim + '</td>' +
                '<td class="text-center">' + modal + '</td>' +
                '<td class="text-center">' + total_modal + '</td>' +
                '<td class="text-center">' + keterangan + '</td>' +
                '<td class="text-center">' + user_created + '</td>' +
                '<td class="text-center"><button class="btn btn-danger" onclick="hapusBaris(this)">Delete</button></td>' +
                '</tr>';
            // Tambahkan Kedalam Tabel
            $('#dataTable tbody').append(newRow);

            let jumlahBaris = $('#dataTable tbody tr').length;
            // Tampilkan Jumlah Baris di Input dengan ID "total_box"
            $('#total_box').val(jumlahBaris);

            dataArray.push({
                nomor_job: nomor_job,
                nomor_bstb: nomor_bstb,
                nomor_batch: nomor_batch,
                operator_perendaman: operator_perendaman,
                operator_bilas: operator_bilas,
                operator_box: operator_box,
                jenis_job: jenis_job,
                berat_job: berat_job,
                pcs_job: pcs_job,
                tujuan_kirim: tujuan_kirim,
                modal: modal,
                total_modal: total_modal,
                keterangan: keterangan,
                user_created: user_created,
            });

            // Mengosongkan nilai dropdown nomor_job
            $('#nomor_job, #nomor_bstb, #nomor_batch, #jenis_job, #tujuan_kirim, #modal, #total_modal, #pcs_job, #berat_job, #operator_perendaman, #operator_bilas, #operator_box, #keterangan, #user_created')
                .val('');

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
                    title: 'Error',
                    text: 'Data dalam tabel masih kosong. Silakan tambahkan data terlebih dahulu.'
                });
                return; // Menghentikan eksekusi fungsi jika data kosong
            }
            // Mengirim data ke server menggunakan AJAX
            $.ajax({
                url: '{{ route('PreWashOutput.store') }}',
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
                        text: 'Data berhasil disimpan.'
                    });

                    // Redirect atau lakukan tindakan lain setelah berhasil
                    window.location.href = `{{ route('PreWashOutput.index') }}`;
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
