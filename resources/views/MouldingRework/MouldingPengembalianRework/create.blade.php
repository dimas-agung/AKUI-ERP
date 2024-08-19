@extends('layouts.master1')
@section('menu')
    Moulding Rework
@endsection
@section('title')
    Moulding Rework Pengembalian
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card mt-2 border border-primary border-3">
            <div class="card-header">
                <div class="d-flex align-items-center mb-3">
                    <h4 class="card-title">Moulding Rework Pengembalian</h4>
                </div>
                <hr>
                @csrf

                <!-- Use 'row' class to create a horizontal layout -->
                <div class="row">
                    <div class="col-md-4">
                        <label for="nomor_job_rework" class="form-label">Nomor Job Rework</label>
                        <select class="select2 form-select" style="width: 100%;" name="nomor_job_rework"
                            id="nomor_job_rework" data-placeholder="Pilih Nomor Job Rework">
                            <option value="">Pilih Nomor Job Rework</option>
                            @foreach ($moulding_stock_rework as $item)
                                <option value="{{ $item->nomor_job_rework }}">{{ $item->nomor_job_rework }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="nomor_batch" class="form-label">Nomor Batch</label>
                        <input type="text" class="form-control" id="nomor_batch" readonly>
                    </div>

                    <div class="col-md-4">
                        <label for="tujuan_kirim" class="form-label">Tujuan Kirim</label>
                        <input type="text" class="form-control" id="tujuan_kirim" readonly>
                    </div>

                    <div class="col-md-4">
                        <label for="job_order" class="form-label">Job Order</label>
                        <input type="text" class="form-control" id="job_order" readonly>
                    </div>

                    <div class="col-md-4">
                        <label for="berat_job" class="form-label">Berat Job</label>
                        <input type="text" class="form-control" id="berat_job" readonly>
                    </div>

                    <div class="col-md-4">
                        <label for="pcs_job" class="form-label">Pcs Job</label>
                        <input type="text" class="form-control" id="pcs_job" readonly>
                    </div>

                    <div class="col-md-4">
                        <label for="nama_operator" class="form-label">Nama Operator</label>
                        <input type="text" class="form-control" id="nama_operator" readonly>
                    </div>

                    <div class="col-md-4">
                        <label for="grade_operator" class="form-label">Grade Operator</label>
                        <input type="text" class="form-control" id="grade_operator" readonly>
                    </div>

                    <div class="col-md-4">
                        <label for="nama_team_leader" class="form-label">Nama Team Leader</label>
                        <input type="text" class="form-control" id="nama_team_leader" readonly>
                    </div>

                    <input type="hidden" class="form-control" id="modal" readonly>
                    <input type="hidden" class="form-control" id="total_modal" readonly>

                    <div class="col-md-4">
                        <label for="waktu_penyebaran" class="form-label">Waktu Penyebaran</label>
                        <input type="text" class="form-control" id="waktu_penyebaran" readonly>
                    </div>

                    <div class="col-md-4">
                        <label for="nip_operator" class="form-label">NIP Operator</label>
                        <input type="text" class="form-control" id="nip_operator" readonly>
                    </div>

                    <div class="col-md-4">
                        <label for="user_created" class="form-label">NIP Admin</label>
                        <input type="text" class="form-control" id="user_created" readonly
                            value="{{ auth()->user()->nip }}">
                    </div>

                    <div class="col-md-12">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan">
                    </div>

                    <div class="col-12 mt-3">
                        <button type="submit" class="btn btn-success" onclick="CeksendData()">Simpan</button>
                        <a href="{{ Route('MouldingReworkPengembalian.index') }}" type="button"
                            class="btn btn-danger">Close</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        let dataArray = []; // Deklarasi dataArray di luar event handler

        $(document).ready(function() {
            let selectedNomorJob = '';

            $('#nomor_job_rework').on('change', function() {
                selectedNomorJob = $(this).val();

                $.ajax({
                    url: '{{ route('MouldingReworkPengembalian.setJob') }}',
                    method: 'GET',
                    data: {
                        nomor_job_rework: selectedNomorJob
                    },
                    success: function(response) {
                        console.log(response);
                        // Mengatur nilai Nomor Batch sesuai dengan respons dari server
                        $('#nomor_batch').val(response.nomor_batch);
                        $('#tujuan_kirim').val(response.tujuan_kirim);
                        $('#job_order').val(response.job_order);
                        $('#berat_job').val(response.berat_job);
                        $('#pcs_job').val(response.pcs_job);
                        $('#modal').val(response.modal);
                        $('#total_modal').val(response.total_modal);
                        $('#waktu_penyebaran').val(response.waktu_penyebaran);
                        $('#nip_operator').val(response.nip_operator);
                        $('#nama_operator').val(response.nama_operator);
                        $('#grade_operator').val(response.grade_operator);
                        $('#nama_team_leader').val(response.nama_team_leader);

                        const now = new Date();
                        const tahun = now.getFullYear().toString().substr(-2);
                        const bulan = ('0' + (now.getMonth() + 1)).slice(-2);
                        const tanggal = ('0' + now.getDate()).slice(-2);
                        const jam = ('0' + now.getHours()).slice(-2);
                        const menit = ('0' + now.getMinutes()).slice(-2);
                        const detik = ('0' + now.getSeconds()).slice(-2);

                        const waktu_pengembalian =
                            `${tahun}/${bulan}/${tanggal} ${jam}:${menit}:${detik}`;

                        console.log("Waktu =" + waktu_pengembalian);

                        let nomor_job_rework = $('#nomor_job_rework').val();
                        let nomor_batch = $('#nomor_batch').val();
                        let tujuan_kirim = $('#tujuan_kirim').val();
                        let job_order = $('#job_order').val();
                        let berat_job = $('#berat_job').val();
                        let pcs_job = $('#pcs_job').val();
                        let modal = $('#modal').val();
                        let total_modal = $('#total_modal').val();
                        let waktu_penyebaran = $('#waktu_penyebaran').val();
                        let nip_operator = $('#nip_operator').val();
                        let nama_operator = $('#nama_operator').val();
                        let grade_operator = $('#grade_operator').val();
                        let nama_team_leader = $('#nama_team_leader').val();
                        let keterangan = $('#keterangan').val();
                        let user_created = $('#user_created').val();

                        // Hanya menyimpan elemen terbaru di dataArray
                        dataArray = [{
                            nomor_job_rework: nomor_job_rework,
                            nomor_batch: nomor_batch,
                            tujuan_kirim: tujuan_kirim,
                            job_order: job_order,
                            berat_job: berat_job,
                            pcs_job: pcs_job,
                            modal: modal,
                            total_modal: total_modal,
                            nama_operator: nama_operator,
                            nip_operator: nip_operator,
                            grade_operator: grade_operator,
                            nama_team_leader: nama_team_leader,
                            waktu_penyebaran: waktu_penyebaran,
                            waktu_pengembalian: waktu_pengembalian,
                            keterangan: keterangan,
                            user_created: user_created,
                        }];
                        console.log(dataArray);
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            });

            // Event handler untuk perubahan keterangan
            $('#keterangan').on('input', function() {
                let keterangan = $(this).val();
                if (dataArray.length > 0) {
                    dataArray[0].keterangan = keterangan;
                }
                console.log('Updated dataArray:', dataArray);
            });
        });

        function CeksendData() {
            var idBoxes = []; // Array untuk menyimpan id box yang akan dicek

            // Mengumpulkan id box dari elemen pertama dalam dataArray
            if (dataArray.length > 0) {
                idBoxes.push(dataArray[0].nomor_job_rework);
            }

            if (idBoxes.length === 0) {
                // Menampilkan SweetAlert untuk pesan error jika idBoxes kosong
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Tidak ada nomor job yang dipilih. Silakan pilih nomor job terlebih dahulu.'
                });
                return; // Menghentikan eksekusi fungsi jika idBoxes kosong
            }

            // Mengirimkan permintaan AJAX untuk memeriksa ketersediaan id box
            $.ajax({
                url: `{{ route('MouldingReworkPengembalian.CeksendData') }}`, // Ganti dengan URL endpoint yang sesuai untuk memeriksa ketersediaan id box
                method: 'POST',
                data: {
                    idBoxes: JSON.stringify(idBoxes),
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(response) {
                    var unavailableBoxes = response.unavailableBoxes;

                    if (unavailableBoxes.length > 0) {
                        // Ada id box yang tidak tersedia, tampilkan pesan kesalahan
                        Swal.fire({
                            title: 'Error!',
                            text: 'Beberapa nomor job sudah tidak tersedia.',
                            icon: 'error',
                            showCancelButton: false, // Sembunyikan tombol cancel
                            confirmButtonText: 'OK' // Ganti teks tombol konfirmasi
                        }).then((result) => {
                            // Jika pengguna menekan tombol "OK", refresh halaman
                            if (result.isConfirmed) {
                                location.reload(); // Refresh halaman
                            }
                        });
                    } else {
                        // Semua id box tersedia, kirim data ke server
                        simpanData();
                    }
                },
                error: function(error) {
                    Swal.fire({
                        title: 'Failed!',
                        text: 'Terjadi kesalahan saat memeriksa ketersediaan nomor job rework. Silakan coba lagi.',
                        icon: 'error'
                    });
                    console.log('Error:', error);
                }
            });
        }

        function simpanData() {
            console.log(dataArray); // Debug statement
            if (dataArray.length === 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Data array kosong. Tidak ada data untuk disimpan.'
                });
                return;
            }
            $.ajax({
                url: '{{ route('MouldingReworkPengembalian.store') }}',
                method: 'POST',
                data: {
                    dataArray: JSON.stringify(dataArray),
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

                    Swal.fire({
                        title: 'Success!',
                        text: 'Data berhasil disimpan.',
                        icon: 'success'
                    }).then((result) => {
                        // Redirect ke halaman lain setelah menekan tombol "OK" pada SweetAlert
                        if (result.isConfirmed) {
                            window.location.href = response.redirectTo;
                        }
                    });
                },
                error: function(error) {
                    console.error('Error sending data:', error);

                    // Menampilkan SweetAlert untuk pesan error
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan saat mengirim data. Silakan coba lagi.'
                    });
                }
            });
        }
    </script>
@endsection
