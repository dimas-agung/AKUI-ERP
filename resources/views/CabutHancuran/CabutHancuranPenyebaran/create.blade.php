@extends('layouts.master1')
@section('menu')
    Cabut Bulu Hancuran
@endsection
@section('title')
    Cabut Bulu Hancuran Penyebaran
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card mt-2 border border-primary border-3">
            <div class="card-header">
                <div class="d-flex align-items-center mb-3">
                    <h4 class="card-title">Cabut Bulu Hancuran Penyebaran</h4>
                </div>
                <hr>
                <form method="POST" class="row g-3" id="myForm">
                    <div class="col-md-6">
                        <label for="basic-usage" class="form-label">Nomor Job</label>
                        <select class="select2 form-select" style="width: 100%;" name="nomor_job" id="nomor_job"
                            data-placeholder="Pilih Nomor Job">
                            <option value="">Pilih Nomor Job</option>
                            @foreach ($get_unused_nomor_job as $item)
                                <option value="{{ $item->nomor_job }}">
                                    {{ $item->nomor_job }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="jenis_rambang" class="form-label">Jenis Rambang</label>
                        <input type="text" class="form-control" id="jenis_rambang" readonly>
                    </div>

                    <div class="col-md-6">
                        <label for="upah_operator" class="form-label">Upah Operator</label>
                        <input type="text" class="form-control" id="upah_operator" readonly>
                    </div>

                    <div class="col-md-6">
                        <label for="berat" class="form-label">Berat</label>
                        <input type="text" class="form-control" id="berat" readonly>
                    </div>

                    <div class="col-md-6">
                        <label for="basic-usage" class="form-label">NIP Operator</label>
                        <select class="select2 form-select" style="width: 100%;" tabindex="-1" aria-hidden="true"
                            name="nip_operator" id="nip_operator" data-placeholder="Pilih NIP Operator">
                            <option value="">NIP Operator</option>
                            @foreach ($master_operators as $item)
                                <option value="{{ $item->nip }}">
                                    {{ $item->nip }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
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

                    <div class="col-md-4">
                        <label for="user_created" class="form-label">NIP Admin</label>
                        <input type="text" class="form-control" id="user_created" value="{{ auth()->user()->nip }}">
                    </div>


                    <div class="col-12">
                        <button type="button" class="btn btn-primary" id="tambah_data" onclick="addRow()">Tambah</button>
                        <a href="{{ Route('CabutHancuranPenyebaran.index') }}" type="button"
                            class="btn btn-danger">Close</a>

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
                                <th scope="col" class="text-center">Nomor Job</th>
                                <th scope="col" class="text-center">Jenis Rambang</th>
                                <th scope="col" class="text-center">Upah Operator</th>
                                <th scope="col" class="text-center">Berat</th>
                                <th scope="col" class="text-center">Nama Operator</th>
                                <th scope="col" class="text-center">Nip Operator</th>
                                <th scope="col" class="text-center">Grade Operator</th>
                                <th scope="col" class="text-center">Nama Team Leader</th>
                                <th scope="col" class="text-center">NIP Admin</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="col-12 mt-2 text-end">
                    <button type="submit" class="btn btn-success" onclick="CeksendData()">Simpan</button>
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
                    url: '{{ route('CabutHancuranPenyebaran.set') }}',
                    method: 'GET',
                    data: {
                        nomor_job: selectedNomorJob
                    },
                    success: function(response) {
                        console.log(response);

                        // Mengatur nilai Nomor Batch sesuai dengan respons dari server
                        $('#jenis_rambang').val(response.jenis_rambang);
                        $('#berat').val(response.sisa_berat);
                        $('#upah_operator').val(response.upah_operator);
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            });
        });

        // DropDown NIP
        $(document).ready(function() {
            let selectedNip = '';

            $('#nip_operator').on('change', function() {
                selectedNip = $(this).val();

                $.ajax({
                    url: '{{ route('CabutHancuranPenyebaran.setNip') }}',
                    method: 'GET',
                    data: {
                        nip: selectedNip
                    },
                    success: function(response) {
                        console.log(response);

                        // Mengatur nilai Nomor Batch sesuai dengan respons dari server
                        $('#nama_operator').val(response.nama);
                        $('#grade_operator').val(response.grade_operator);
                        $('#nama_team_leader').val(response.nama_team_leader);

                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            });
        });

        function validateForm() {
            // Mendefinisikan variabel untuk menyimpan kolom yang belum diisi
            let emptyFields = [];

            // Mendapatkan nilai dari semua input
            let nomor_job = $('#nomor_job').val();
            let jenis_rambang = $('#jenis_rambang').val();
            let upah_operator = $('#upah_operator').val();
            let berat = $('#berat').val();
            let nama_operator = $('#nama_operator').val();
            let nip_operator = $('#nip_operator').val();
            let grade_operator = $('#grade_operator').val();
            let nama_team_leader = $('#nama_team_leader').val();
            let user_created = $('#user_created').val();

            // Memeriksa setiap input, dan jika kosong, tambahkan ke daftar kolom yang belum diisi
            if (!nomor_job) emptyFields.push('Nomor Job');
            if (!jenis_rambang) emptyFields.push('Jenis Rambang');
            if (!upah_operator) emptyFields.push('Upah Operator');
            if (!berat) emptyFields.push('Berat');
            if (!nama_operator) emptyFields.push('Nama Operator');
            if (!nip_operator) emptyFields.push('Nip Operator');
            if (!grade_operator) emptyFields.push('Grade Operator');
            if (!nama_team_leader) emptyFields.push('Nama Team Leader');
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
                if ($('#dataTable tbody tr td:nth-child(1)').filter(function() {
                        return $(this).text() === nomor_job;
                    }).length > 0) {
                    // Nomor job sudah ada dalam tabel, tampilkan pesan dan hentikan proses
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Nomor job sudah ada dalam tabel.',
                    });
                    return;
                }
                // Hapus opsi nomor_job yang sudah dipilih dari dropdown
                $('#nomor_job option[value="' + nomor_job + '"]').remove();

                let jenis_rambang = $('#jenis_rambang').val();
                let upah_operator = $('#upah_operator').val();
                let berat = $('#berat').val();
                let nama_operator = $('#nama_operator').val();
                let nip_operator = $('#nip_operator').val();
                let grade_operator = $('#grade_operator').val();
                let nama_team_leader = $('#nama_team_leader').val();
                let user_created = $('#user_created').val();

                let newRow = `<tr>` +
                    `<td class="text-center">${nomor_job}</td>` +
                    `<td class="text-center">${jenis_rambang}</td>` +
                    `<td class="text-center">${upah_operator}</td>` +
                    `<td class="text-center">${berat}</td>` +
                    `<td class="text-center">${nama_operator}</td>` +
                    `<td class="text-center">${nip_operator}</td>` +
                    `<td class="text-center">${grade_operator}</td>` +
                    `<td class="text-center">${nama_team_leader}</td>` +
                    `<td class="text-center">${user_created}</td>` +
                    `<td class="text-center"><button class="btn btn-danger" onclick="hapusBaris(this)">Delete</button></td>` +
                    `</tr>`;
                // Tambahkan Kedalam Tabel
                $('#dataTable tbody').append(newRow);

                dataArray.push({
                    nomor_job: nomor_job,
                    jenis_rambang: jenis_rambang,
                    upah_operator: upah_operator,
                    berat: berat,
                    nama_operator: nama_operator,
                    nip_operator: nip_operator,
                    grade_operator: grade_operator,
                    nama_team_leader: nama_team_leader,
                    user_created: user_created,
                });
                console.log(dataArray);

                // Mengosongkan nilai dropdown nomor_job
                $('#nomor_job').val(null).trigger('change');
                $('#jenis_rambang').val('');
                $('#upah_operator').val('');
                $('#berat').val('');
                $('#nip_operator').val(null).trigger('change');
                $('#nama_operator').val('');
                $('#grade_operator').val('');
                $('#nama_team_leader').val('');

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
        }

        function CeksendData() {
            let i = 0;
            let idBoxes = []; // Array untuk menyimpan id box yang akan dicek

            // Mengumpulkan id box dari dataArray
            dataArray.forEach(function(item) {
                idBoxes.push(item.nomor_job);
            });

            // Mengirimkan permintaan AJAX untuk memeriksa ketersediaan id box
            $.ajax({
                url: `{{ route('CabutHancuranPenyebaran.CeksendData') }}`, // Ganti dengan URL endpoint yang sesuai untuk memeriksa ketersediaan id box
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
                        text: 'Terjadi kesalahan saat memeriksa ketersediaan nomor bstb. Silakan coba lagi.',
                        icon: 'error'
                    });
                    console.log('Error:', error);
                }
            });

            function sendData(waktu_penyebaran) {
                // Mengirim data ke server menggunakan AJAX
                $.ajax({
                    url: '{{ route('CabutHancuranPenyebaran.store') }}',
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
                            user_updated: $('#user_createds').val() || '',
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
