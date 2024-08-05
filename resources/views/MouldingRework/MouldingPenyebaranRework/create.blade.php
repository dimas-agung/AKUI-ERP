@extends('layouts.master1')
@section('menu')
    Moulding Rework
@endsection
@section('title')
    Moulding Rework Penyebaran
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card mt-2 border border-primary border-3">
            <div class="card-header">
                <div class="d-flex align-items-center mb-3">
                    <h4 class="card-title">Moulding Rework Penyebaran</h4>
                </div>
                <hr>
                <form action="{{ route('MouldingReworkPenyebaran.store') }}" method="POST" class="row g-3" id="myForm">
                    @csrf
                    <div class="col-md-4">
                        <label for="basic-usage" class="form-label">Nomor Job Rework</label>
                        <select class="select2 form-select" style="width: 100%;" name="nomor_job_rework"
                            id="nomor_job_rework" data-placeholder="Pilih Nomor Job Rework">
                            <option value="">Pilih Nomor Job Rework</option>
                            @foreach ($moulding_stock_rework as $item)
                                <option value="{{ $item->nomor_job_rework }}">
                                    {{ $item->nomor_job_rework }}</option>
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

                    <div class="col-md-6">
                        <label for="modal" class="form-label">Modal</label>
                        <input type="text" class="form-control" id="modal" readonly>
                    </div>

                    <div class="col-md-6">
                        <label for="total_modal" class="form-label">Total Modal</label>
                        <input type="text" class="form-control" id="total_modal" readonly>
                    </div>

                    <div class="col-md-6">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan">
                    </div>

                    <div class="col-md-6">
                        <label for="user_created" class="form-label">NIP Admin</label>
                        <input type="text" class="form-control" id="user_created" readonly
                            value="{{ auth()->user()->nip }}">
                    </div>

                    <div class="col-12">
                        {{-- <button type="button" class="btn btn-primary" id="tambah_data" onclick="addRow()">Tambah</button> --}}
                        <button type="submit" class="btn btn-success" onclick="sendData()">Simpan</button>
                        <a href="{{ Route('MouldingReworkPenyebaran.index') }}" type="button"
                            class="btn btn-danger">Close</a>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            let selectedNomorJob = '';

            $('#nomor_job_rework').on('change', function() {
                selectedNomorJob = $(this).val();

                $.ajax({
                    url: '{{ route('MouldingReworkPenyebaran.setJob') }}',
                    method: 'GET',
                    data: {
                        nomor_job_rework: selectedNomorJob
                    },
                    success: function(response) {
                        console.log(response);
                        // Menghapus dataArray sebelum menambahkan data baru
                        dataArray = [];

                        // Mengatur nilai Nomor Batch sesuai dengan respons dari server
                        $('#nomor_batch').val(response.nomor_batch);
                        $('#tujuan_kirim').val(response.tujuan_kirim);
                        $('#job_order').val(response.job_order);
                        $('#berat_job').val(response.berat_job);
                        $('#pcs_job').val(response.pcs_job);
                        $('#modal').val(response.modal);
                        $('#total_modal').val(response.total_modal);
                        $('#nama_operator').val(response.nama_operator);
                        $('#grade_operator').val(response.grade_operator);
                        $('#nama_team_leader').val(response.nama_team_leader);

                        dataArray.push({
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
                            user_created: user_created,
                        });
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            });
        });

        function CeksendData() {
            let i = 0;
            let idBoxes = []; // Array untuk menyimpan id box yang akan dicek

            // Mengumpulkan id box dari dataArray
            dataArray.forEach(function(item) {
                idBoxes.push(item.nomor_job_rework);
            });

            // Mengirimkan permintaan AJAX untuk memeriksa ketersediaan id box
            $.ajax({
                url: `{{ route('MouldingReworkPenyebaran.CeksendData') }}`, // Ganti dengan URL endpoint yang sesuai untuk memeriksa ketersediaan id box
                method: 'POST',
                data: {
                    idBoxes: JSON.stringify(idBoxes),
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(response) {
                    let unavailableBoxes = response.unavailableBoxes;

                    if (unavailableBoxes.length > 0) {
                        // Ada id box yang tidak tersedia, tampilkan pesan kesalahan
                        Swal.fire({
                            title: 'Error!',
                            text: 'Beberapa nomor bstb sudah tidak tersedia.',
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
                        // let waktu_penyebaran = new Date().getTime(); // Ambil waktu saat ini

                        const now = new Date();
                        const tahun = now.getFullYear().toString().substr(-2);
                        const bulan = ('0' + (now.getMonth() + 1)).slice(-2);
                        const tanggal = ('0' + now.getDate()).slice(-2);
                        const jam = ('0' + now.getHours()).slice(-2);
                        const menit = ('0' + now.getMinutes()).slice(-2);
                        const detik = ('0' + now.getSeconds()).slice(-2);

                        const waktu_penyebaran = `${tahun}/${bulan}/${tanggal} ${jam}:${menit}:${detik}`;

                        console.log("Waktu =" + waktu_penyebaran);

                        sendData(waktu_penyebaran);
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

            function sendData(waktu_penyebaran) {
                // Mengirim data ke server menggunakan AJAX
                $.ajax({
                    url: '{{ route('MouldingReworkPenyebaran.store') }}',
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
                    data: function() {
                        let postData = {
                            dataArray: JSON.stringify(dataArray), // Mengirim dataArray sebagai string JSON
                            user_created: $('#user_created').val() || '',
                            keterangan: $('#keterangan').val() || '',
                            waktu_penyebaran: waktu_penyebaran, // Mengirim waktu_penyebaran
                            _token: '{{ csrf_token() }}'
                        };

                        return postData;
                    }(),
                    success: function(response) {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Data berhasil disimpan.',
                            icon: 'success'
                        }).then((result) => {
                            // Redirect ke halaman lain setelah menekan tombol "OK" pada SweetAlert
                            if (result.isConfirmed) {
                                window.location.href = response.redirectTo;
                                // Ganti dengan URL tujuan redirect Anda
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
        }
    </script>
@endsection
