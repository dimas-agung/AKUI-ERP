@extends('layouts.master1')
@section('menu')
    Rambang
@endsection
@section('title')
    Rambang Kering Input
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card mt-2 border border-primary border-3">
            <div class="card-header">
                <div class="d-flex align-items-center mb-3">
                    <h4 class="card-title">Rambang Kering Input</h4>
                </div>
                <hr>
                <form method="POST" class="row g-3" id="myForm">
                    <div class="col-md-6">
                        <label for="basic-usage" class="form-label">Id Box Hancuran Kotor</label>
                        <select class="select2 form-select" style="width: 100%;" name="id_box_hcr_kotor"
                            id="id_box_hcr_kotor" data-placeholder="Pilih Id Box Hcr Kotor">
                            <option value="">Pilih Id Box Hancuran Kotor</option>
                            @foreach ($rambang_basah_stock as $item)
                                @if ($item->sisa_berat != 0)
                                    <option value="{{ $item->id_box_hcr_kotor }}">
                                        {{ $item->id_box_hcr_kotor }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="basic-usage" class="form-label">Jenis Rambang</label>
                        <select class="select2 form-select" style="width: 100%;" name="jenis_rambang" id="jenis_rambang"
                            data-placeholder="Pilih Jenis Rambang">
                            <option value="">Pilih Jenis Rambang</option>
                            @foreach ($rambang_basah_stock as $item)
                                @if (
                                    $item->sisa_berat != 0 &&
                                        strpos(strtolower($item->jenis_rambang), 'hcr') === false &&
                                        strpos(strtolower($item->jenis_rambang), 'rambang') !== false)
                                    <option value="{{ $item->jenis_rambang }}">
                                        {{ $item->jenis_rambang }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="berat_basah" class="form-label">Berat Basah</label>
                        <input type="text" class="form-control" id="berat_basah" readonly>
                    </div>

                    <div class="col-md-6">
                        <label for="berat_kering" class="form-label">Berat Kering</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="berat_kering">
                    </div>

                    <div class="col-md-6">
                        <label for="susut" class="form-label">Susut</label>
                        <input type="text" class="form-control" id="susut" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan">
                    </div>
                    <div class="col-md-4">
                        <label for="total_berat_kering" class="form-label">Total Berat Kering</label>
                        <input type="text" class="form-control" id="total_berat_kering" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="total_susut" class="form-label">Total Susut</label>
                        <input type="text" class="form-control" id="total_susut" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="user_created" class="form-label">NIP Admin</label>
                        <input type="text" class="form-control" id="user_created" value="{{ auth()->user()->nip }}">
                    </div>


                    <div class="col-12">
                        <button type="button" class="btn btn-primary" id="tambah_data" onclick="addRow()">Tambah</button>
                        <a href="{{ Route('RambangKeringInput.index') }}" type="button" class="btn btn-danger">Close</a>

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
                                <th scope="col" class="text-center">Id Box Hancuran Kotor</th>
                                <th scope="col" class="text-center">Jenis Rambang</th>
                                <th scope="col" class="text-center">Berat Basah</th>
                                <th scope="col" class="text-center">Berat Kering</th>
                                <th scope="col" class="text-center">Susut</th>
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
                    <button type="submit" class="btn btn-success" onclick="CeksendData()">Simpan</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            let selectedBox = '';
            let selectedJenisRambang = '';

            // Event listener untuk ketika id_box_hcr_kotor dipilih
            $('#id_box_hcr_kotor').on('change', function() {
                selectedBox = $(this).val();
                updateBeratBasah();
            });

            // Event listener untuk ketika jenis_rambang dipilih
            $('#jenis_rambang').on('change', function() {
                selectedJenisRambang = $(this).val();
                updateBeratBasah();
            });

            // Event listener untuk ketika input berat_kering diubah
            $('#berat_kering').on('input', function() {
                updateSusut();
            });

            // Perbarui dropdown jenis rambang berdasarkan id_box_hcr_kotor yang dipilih
            $('#id_box_hcr_kotor').change(function() {
                let selectedBox = $(this).val();
                $('#jenis_rambang').empty().append('<option value="">Pilih Jenis Rambang</option>');

                // Membuat objek untuk menyimpan jenis rambang yang terkait dengan setiap id_box_hcr_kotor
                let jenisRambangOptions = {};

                // Mengisi objek jenisRambangOptions dengan jenis rambang yang sesuai dengan setiap id_box_hcr_kotor
                @foreach ($rambang_basah_stock as $item)
                    if ("{{ $item->sisa_berat }}" != 0 && "{{ strtolower($item->jenis_rambang) }}" !==
                        'hcr rambang') {
                        if (!jenisRambangOptions["{{ $item->id_box_hcr_kotor }}"]) {
                            jenisRambangOptions["{{ $item->id_box_hcr_kotor }}"] = [];
                        }
                        jenisRambangOptions["{{ $item->id_box_hcr_kotor }}"].push(
                            "{{ $item->jenis_rambang }}");
                    }
                @endforeach

                // Memperbarui dropdown jenis_rambang berdasarkan nilai yang dipilih dari id_box_hcr_kotor
                if (jenisRambangOptions[selectedBox]) {
                    $.each(jenisRambangOptions[selectedBox], function(index, value) {
                        $('#jenis_rambang').append('<option value="' + value + '">' + value +
                            '</option>');
                    });
                }
            });

            function updateBeratBasah() {
                // Mengambil nilai terbaru dari id_box_hcr_kotor dan jenis_rambang
                let selectedBox = $('#id_box_hcr_kotor').val();
                let selectedJenisRambang = $('#jenis_rambang').val();

                // Update Ajax request data to only include selectedBox and selectedJenisRambang
                $.ajax({
                    url: '{{ route('RambangKeringInput.set') }}',
                    method: 'GET',
                    data: {
                        id_box_hcr_kotor: selectedBox,
                        jenis_rambang: selectedJenisRambang
                    },
                    success: function(response) {
                        console.log(response);
                        // Check if sisa_berat exists in the response and display if present
                        if (response.sisa_berat) {
                            // Set the value of berat_basah according to the sisa_berat from the server response
                            $('#berat_basah').val(response.sisa_berat);
                            // Update susut when berat basah is updated
                            updateSusut();
                        } else {
                            // If sisa_berat is not present in the response, clear the value of berat_basah
                            $('#berat_basah').val('');
                        }
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            }
            // Function untuk mengupdate nilai susut
            function updateSusut() {
                let beratBasah = parseFloat($('#berat_basah').val());
                let beratKering = parseFloat($('#berat_kering').val());

                // Pastikan kedua nilai tidak NaN atau undefined
                if (!isNaN(beratBasah) && !isNaN(beratKering) && beratBasah !== 0) {
                    let susut = 1 - (beratKering / beratBasah);
                    $('#susut').val(susut.toFixed(4)); // Menampilkan nilai susut dengan 2 desimal
                } else {
                    $('#susut').val('');
                }
            }
            // Fungsi untuk menyaring nilai unik dari dropdown id_box_hcr_kotor
            function uniqueIdBoxes() {
                let seen = {};
                $('#id_box_hcr_kotor option').each(function() {
                    let txt = $(this).text();
                    if (seen[txt]) {
                        $(this).remove();
                    } else {
                        seen[txt] = true;
                    }
                });
            }
            // Panggil fungsi uniqueIdBoxes saat dokumen siap
            uniqueIdBoxes();
        });

        function calculateTotalBeratKering() {
            let totalBeratKering = 0;
            // Iterasi melalui setiap baris dalam tabel
            $('#dataTable tbody tr').each(function() {
                // Mendapatkan nilai berat adding dari baris saat ini dan menambahkannya ke totalBeratKering
                let beratKering = parseFloat($(this).find('td:eq(3)').text()) || 0;
                totalBeratKering += beratKering;
            });
            // Menampilkan total berat di input #total_berat
            $('#total_berat_kering').val(totalBeratKering);
        }

        function calculateTotalSusut() {
            let totalBeratBasah = 0;
            // Iterasi melalui setiap baris dalam tabel untuk menghitung jumlah berat basah
            $('#dataTable tbody tr').each(function() {
                // Mendapatkan nilai berat basah dari baris saat ini dan menambahkannya ke totalBeratBasah
                let beratBasah = parseFloat($(this).find('td:eq(2)').text()) || 0;
                totalBeratBasah += beratBasah;

                console.log("Total Berat Basah = " + totalBeratBasah);
            });

            let totalBeratKering = parseFloat($('#total_berat_kering').val()) || 0;
            console.log("Total Berat Kering = " + totalBeratKering);
            let totalSusut = 0;

            // Pastikan totalBeratBasah memiliki nilai yang valid sebelum melakukan perhitungan total susut
            if (totalBeratBasah !== 0) {
                totalSusut = 1 - (totalBeratKering / totalBeratBasah);
                console.log("Total Susut = " + totalSusut);
            }

            // Menampilkan total susut di input #total_susut
            $('#total_susut').val(totalSusut.toFixed(2)); // Menampilkan total susut dengan 2 desimal
        }


        // Validasi Data
        function validateForm() {
            // Mendefinisikan variabel untuk menyimpan kolom yang belum diisi
            let emptyFields = [];

            // Mendapatkan nilai dari semua input
            let id_box_hcr_kotor = $('#id_box_hcr_kotor').val();
            let jenis_rambang = $('#jenis_rambang').val();
            let berat_basah = $('#berat_basah').val();
            let berat_kering = $('#berat_kering').val();
            let susut = $('#susut').val();
            let user_created = $('#user_created').val();

            // Memeriksa setiap input, dan jika kosong, tambahkan ke daftar kolom yang belum diisi
            if (!id_box_hcr_kotor) emptyFields.push('Id Box Hancuran Kotor');
            if (!jenis_rambang) emptyFields.push('Jenis Rambang');
            if (!berat_basah) emptyFields.push('Berat Basah');
            if (!berat_kering) emptyFields.push('Berat Kering');
            if (!susut) emptyFields.push('Susut');
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

        // Send Data To Table
        let dataArray = [];
        // ADD ROW
        function addRow() {
            if (validateForm()) {
                let jenis_rambang = $('#jenis_rambang').val();

                // Periksa apakah nomor job sudah ada dalam tabel
                if ($('#dataTable tbody tr td:nth-child(1)').filter(function() {
                        return $(this).text() === jenis_rambang;
                    }).length > 0) {
                    // Nomor job sudah ada dalam tabel, tampilkan pesan dan hentikan proses
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Jenis Rambang sudah ada dalam tabel.',
                    });
                    return;
                }
                // Hapus opsi jenis_rambang yang sudah dipilih dari dropdown
                $('#jenis_rambang option[value="' + jenis_rambang + '"]').remove();

                let id_box_hcr_kotor = $('#id_box_hcr_kotor').val();
                // let jenis_rambang = $('#jenis_rambang').val();
                let berat_basah = $('#berat_basah').val();
                let berat_kering = $('#berat_kering').val();
                let susut = $('#susut').val();
                let keterangan = $('#keterangan').val();
                let user_created = $('#user_created').val();

                let newRow = `<tr>` +
                    `<td class="text-center">${id_box_hcr_kotor}</td>` +
                    `<td class="text-center">${jenis_rambang}</td>` +
                    `<td class="text-center">${berat_basah}</td>` +
                    `<td class="text-center">${berat_kering}</td>` +
                    `<td class="text-center">${susut}</td>` +
                    `<td class="text-center">${keterangan}</td>` +
                    `<td class="text-center">${user_created}</td>` +
                    `<td class="text-center"><button class="btn btn-danger" onclick="hapusBaris(this)">Delete</button></td>` +
                    `</tr>`;
                // Tambahkan Kedalam Tabel
                $('#dataTable tbody').append(newRow);
                // Disable #id_box_hcr_kotor
                $('#id_box_hcr_kotor').prop('disabled', true);

                calculateTotalBeratKering();
                calculateTotalSusut();

                dataArray.push({
                    id_box_hcr_kotor: id_box_hcr_kotor,
                    jenis_rambang: jenis_rambang,
                    berat_basah: berat_basah,
                    berat_kering: berat_kering,
                    susut: susut,
                    keterangan: keterangan,
                    user_created: user_created,
                });
                console.log(dataArray);

                // Mengosongkan nilai dropdown nomor_job
                // $('#jenis_rambang').val(null).trigger('change');
                $('#berat_basah').val('');
                $('#berat_kering').val('');
                $('#susut').val('');
            }
        }

        // Hapus Tabel
        function hapusBaris(button) {
            // Dapatkan elemen baris terkait dengan tombol delete yang diklik
            let row = $(button).closest('tr');

            // Dapatkan jenis_ramabng dari baris yang dihapus
            let jenisRambangHapus = row.find('td:eq(1)').text();

            // Buat kembali opsi jenis_ramabng yang dihapus dan tambahkan ke dalam dropdown
            $('#jenis_rambang').append('<option value="' + jenisRambangHapus + '">' + jenisRambangHapus + '</option>');

            // Urutkan opsi jenis_rambang dalam dropdown
            let options = $('#jenis_rambang option');
            options.detach().sort(function(a, b) {
                let at = $(a).text();
                let bt = $(b).text();
                return (at > bt) ? 1 : ((at < bt) ? -1 : 0);
            });
            $('#jenis_rambang').append(options);

            // Hapus baris dari dataArray berdasarkan indeks baris di tabel
            let rowIndex = row.index();
            dataArray.splice(rowIndex, 1);

            // Hapus baris dari tabel
            row.remove();

            let jumlahBaris = $('#dataTable tbody tr').length;
            if (jumlahBaris === 0) {
                // Jika tidak ada baris lagi, kosongkan nilai dari #id_box_hcr_kotor
                $('#id_box_hcr_kotor').val($('#id_box_hcr_kotor option:first').val()).trigger('change').prop('disabled',
                    false);
            }
            calculateTotalBeratKering();
            calculateTotalSusut();
        }

        function CeksendData() {
            let i = 0;
            let idBoxes = []; // Array untuk menyimpan id box yang akan dicek

            // Mengumpulkan id box dari dataArray
            dataArray.forEach(function(item) {
                idBoxes.push(item.id_box_hcr_kotor);
            });

            // Mengirimkan permintaan AJAX untuk memeriksa ketersediaan id box
            $.ajax({
                url: `{{ route('RambangKeringInput.CeksendData') }}`, // Ganti dengan URL endpoint yang sesuai untuk memeriksa ketersediaan id box
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
                            text: 'Beberapa Id Box Hancuran Kotor sudah tidak tersedia.',
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
                        sendData();
                    }
                },
                error: function(error) {
                    Swal.fire({
                        title: 'Failed!',
                        text: 'Terjadi kesalahan saat memeriksa ketersediaan Id Box Hancuran Kotor. Silakan coba lagi.',
                        icon: 'error'
                    });
                    console.log('Error:', error);
                }
            });

            function sendData() {
                // Mengirim data ke server menggunakan AJAX
                $.ajax({
                    url: '{{ route('RambangKeringInput.store') }}',
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
