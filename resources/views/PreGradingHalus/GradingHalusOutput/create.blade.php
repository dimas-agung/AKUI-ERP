@extends('layouts.master1')
@section('menu')
    Grading Halus
@endsection
@section('title')
    Input Grading Halus
@endsection
@section('content')
    {{-- <div class="container"> --}}
    <div class="card border border-primary border-3 mt-2">
        <form action="{{ route('GradingHalusInput.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 shadow-sm rounded">
                        <div class="card-header">
                            <h4>Input Data Prm Raw Material Output</h4>
                        </div>
                        <div class="card-body">
                            {{-- Create Data --}}
                            @if (session()->has('success'))
                                <div class="alert alert-success">
                                    <strong>Sukses: </strong>{{ session()->get('success') }}
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul><strong>
                                            @foreach ($errors->all() as $error)
                                                <li> {{ $error }} </li>
                                            @endforeach
                                        </strong>
                                    </ul>
                                    <p>Mohon periksa kembali formulir Anda.</p>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>ID Box Grading Halus</label>
                                        <select id="id_box_grading_halus" class="select2 form-select"
                                            name="id_box_grading_halus">
                                            <option value="">Pilih ID Box Grading Halus</option>
                                            @foreach ($TransitPre->sortBy('id_box_grading_halus') as $post)
                                                <option value="{{ $post->id_box_grading_halus }}">
                                                    {{ old('id_box_grading_halus', $post->id_box_grading_halus) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tujuan Kirim</label>
                                        <select id="tujuan_kirim" class="select2 form-select" name="tujuan_kirim">
                                            <option value="">Pilih Tujuan Kirim</option>
                                            @foreach ($TujuanKirimGHI->sortBy('tujuan_kirim') as $post)
                                                <option value="{{ $post->tujuan_kirim }}">
                                                    {{ old('tujuan_kirim', $post->tujuan_kirim) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor BSTB</label>
                                        <input type="text" class="form-control" id="nomor_bstb" name="nomor_bstb"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor Job</label>
                                        <input type="text" class="form-control" id="nomor_job" name="nomor_job" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nomor Batch</label>
                                        <input type="text" class="form-control" id="nomor_batch" name="nomor_batch"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Jenis Job</label>
                                        <input type="text" class="form-control" id="jenis_job" name="jenis_job" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Sisa Berat</label>
                                        <input type="text" id="berat_masuk" class="form-control" name="berat_masuk"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Sisa Pcs</label>
                                        <input type="text" id="pcs_masuk" class="form-control" name="pcs_masuk" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Modal</label>
                                        <input type="text" id="modal" class="form-control" name="modal" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Total Modal</label>
                                        <input type="text" id="total_modal" class="form-control" name="total_modal"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Berat Job</label>
                                        <input type="text" id="berat_job" pattern="[0-9]*" inputmode="numeric"
                                            onkeypress="return event.charCode >= 68 && event.charCode <= 57"
                                            class="form-control" name="berat_job" value="{{ old('berat_job') }}"
                                            placeholder="Masukkan berat job" data-parsley-required="true">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pcs Job</label>
                                        <input type="text" id="pcs_job" pattern="[0-9]*" inputmode="numeric"
                                            onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                            class="form-control" name="pcs_job" value="{{ old('pcs_job') }}"
                                            placeholder="Masukkan pcs job" data-parsley-required="true">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>NIP Admin</label>
                                        <input type="text" id="user_created" class="form-control" name="user_created"
                                            placeholder="Masukkan User Created" data-parsley-required="true">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <input type="text" id="keterangan" class="form-control" name="keterangan"
                                            placeholder="Masukkan keterangan">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="button" class="btn btn-primary" onclick="addRow()">Add</button>
                                <a href="{{ Route('GradingHalusInput.index') }}" type="button" class="btn btn-danger"
                                    data-dismiss="modal">Close</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Validasi Data Input</div>
                </div>
                <!-- Elemen dengan ID 'nomor_grading' -->
                <div class="card-body" style="overflow: scroll" content="{{ csrf_token() }}">
                    <table class="table table-striped mt-3">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">Id Box Grading Halus</th>
                                <th class="text-center" scope="col">Nomor Batch</th>
                                <th class="text-center" scope="col">Nomor BSTB</th>
                                <th class="text-center" scope="col">Nomor Job</th>
                                <th class="text-center" scope="col">Jenis Job</th>
                                <th class="text-center" scope="col">Berat Job</th>
                                <th class="text-center" scope="col">Pcs Job</th>
                                <th class="text-center" scope="col">Tujuan Kirim</th>
                                <th class="text-center" scope="col">Keterangan</th>
                                <th class="text-center" scope="col">Modal</th>
                                <th class="text-center" scope="col">Total Modal</th>
                                <th class="text-center" scope="col">NIP Admin</th>
                                <th class="text-center" scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                        </tbody>
                    </table>
                    <a href="#" class="btn btn-primary" onclick="sendData()">Submit</a>
                </div>
            </div>
        </div>
    </div>
    </form>

@endsection
@section('script')
    <script>
        let selectedNomorBSTB = '';
        var beratMasukAwal = 0;
        var pcsMasukAwal = 0;
        $('#id_box_grading_halus').on('change', function() {
            let selectedIdBox = $(this).val();
            if (selectedNomorBSTB !== selectedIdBox) {
                selectedNomorBSTB = selectedIdBox;
                $.ajax({
                    url: "{{ route('GradingHalusOutput.set') }}",
                    method: 'GET',
                    data: {
                        id_box_grading_halus: selectedIdBox
                    },
                    success: function(response) {
                        // Ambil nilai pertama dari respons jika ada
                        let data = response.length > 0 ? response[0] : null;

                        if (data) {
                            $('#id_box_raw_material').val(data.id_box_raw_material);
                            $('#nomor_batch').val(data.nomor_batch);
                            $('#jenis_job').val(data.jenis);
                            $('#modal').val(data.modal);
                            $('#total_modal').val(data.total_modal);

                        } else {
                            console.error('No data found for the selected id_box_grading_halus');
                        }

                        // Inisialisasi variabel untuk menampung total berat masuk dan pcs masuk
                        let totalBeratMasuk = 0;
                        let totalPcsMasuk = 0;

                        // Loop melalui setiap item dalam respons
                        response.forEach(function(item) {
                            totalBeratMasuk += parseFloat(item.berat_masuk);
                            totalPcsMasuk += parseInt(item.pcs_masuk);
                        });

                        $('#berat_masuk').val(totalBeratMasuk);
                        beratMasukAwal += totalBeratMasuk
                        $('#pcs_masuk').val(totalPcsMasuk);
                        pcsMasukAwal += totalPcsMasuk

                        // Memanggil generateNomorBSTB dan mengatur nilai sesuai dengan respons dari server
                        let generatedNomorBSTB = generateNomorBSTB(
                            'BSTB'); // Memanggil generateNomorBSTB dengan prefix 'BSTB'
                        let generatedNomorJob = generateNomorBSTB(
                            'JOB'); // Memanggil generateNomorBSTB dengan prefix 'JOB'
                        $('#nomor_bstb').val(generatedNomorBSTB);
                        $('#nomor_job').val(generatedNomorJob);
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            }
        });

        // Fungsi untuk menghitung total berat masuk dan pcs masuk
        function hitungTotal() {
            $('#berat_masuk').val(beratMasukAwal)
            $('#pcs_masuk').val(pcsMasukAwal)
            let totalBeratMasuk = parseFloat($('#berat_masuk').val() || 0);
            let totalPcsMasuk = parseInt($('#pcs_masuk').val() || 0);

            // Mengurangkan berat job dari total berat masuk
            let beratJob = parseFloat($('#berat_job').val() || 0);
            totalBeratMasuk -= beratJob;

            // Mengurangkan pcs job dari total pcs masuk
            let pcsJob = parseInt($('#pcs_job').val() || 0);
            totalPcsMasuk -= pcsJob;

            // Memperbarui nilai total berat masuk dan pcs masuk
            $('#berat_masuk').val(totalBeratMasuk);
            $('#pcs_masuk').val(totalPcsMasuk);
        }

        // Mendengarkan perubahan pada inputan berat job
        $('#berat_job').on('input', function() {
            hitungTotal();
        });

        // Mendengarkan perubahan pada inputan pcs job
        $('#pcs_job').on('input', function() {
            hitungTotal();
        });

        // Mendengarkan perubahan pada inputan berat masuk
        $('#berat_masuk').on('input', function() {
            hitungTotal();
        });

        // Mendengarkan perubahan pada inputan pcs masuk
        $('#pcs_masuk').on('input', function() {
            hitungTotal();
        });



        // $('#tujuan_kirim').on('change', function() {
        //     let selectedUnit = $(this).val();
        //     $.ajax({
        //         url: `{{ route('GradingHalusOutput.setUnit') }}`,
        //         method: 'GET',
        //         data: {
        //             tujuan_kirim: selectedUnit
        //         },
        //         success: function(response) {},
        //         error: function(error) {
        //             console.error('Error:', error);
        //         }
        //     });
        // });

        function generateNomorBSTB(prefix) {
            let nomor;

            const now = new Date();
            const tahun = now.getFullYear().toString().substr(-2);
            const bulan = ('0' + (now.getMonth() + 1)).slice(-2);
            const tanggal = ('0' + now.getDate()).slice(-2);
            const jam = ('0' + now.getHours()).slice(-2);
            const menit = ('0' + now.getMinutes()).slice(-2);
            const detik = ('0' + now.getSeconds()).slice(-2);

            // Menambahkan prefix yang sesuai
            if (prefix === 'BSTB') {
                nomor = `BSTB_${tanggal}${bulan}${tahun}-${jam}${menit}${detik}_A_UGH`;
            } else {
                nomor = `${tanggal}${bulan}${tahun}-${jam}${menit}${detik}_A_UGH`;
            }

            return nomor;
        }

        // Variabel global untuk menyimpan indeks baris terakhir
        var currentRowIndex = 0;
        var dataArray = [];

        function addRow() {
            // Mengambil nilai dari inputgrading_halus = $('#id_box_grading_halus').val();
            var id_box_grading_halus = $('#id_box_grading_halus').val();
            var nomor_batch = $('#nomor_batch').val();
            var nomor_bstb = $('#nomor_bstb').val();
            var nomor_job = $('#nomor_job').val();
            var jenis_job = $('#jenis_job').val();
            var berat_job = $('#berat_job').val();
            var berat_masuk = $('#berat_masuk').val();
            var pcs_job = $('#pcs_job').val();
            var pcs_masuk = $('#pcs_masuk').val();
            var tujuan_kirim = $('#tujuan_kirim').val();
            var keterangan = $('#keterangan').val();
            var modal = $('#modal').val();
            var total_modal = $('#total_modal').val();
            var user_created = $('#user_created').val();
            beratMasukAwal -= berat_job
            // Inisialisasi array untuk menyimpan field yang belum terisi
            let fieldsNotFilled = [];
            // Periksa setiap field
            if (!id_box_grading_halus) fieldsNotFilled.push('No Grading');
            if (!tujuan_kirim) fieldsNotFilled.push('Tujuan Kirim');
            if (!user_created) fieldsNotFilled.push('NIP Admin');
            if (!berat_job || berat_job <= 0) fieldsNotFilled.push('Berat Job');
            if (!pcs_job || pcs_job <= 0) fieldsNotFilled.push('PCS Job');

            // Cek apakah ada field yang belum terisi
            if (fieldsNotFilled.length > 0) {
                // Membuat pesan teks yang mencantumkan field yang belum terisi
                let message = `Data belum diinputkan untuk: ${fieldsNotFilled.join(', ')}. Silakan lengkapi form.`;

                Swal.fire({
                    title: 'Warning!',
                    text: message,
                    icon: 'warning'
                });
                return;
            }

            var newRow = '<tr>' +
                '<td>' + id_box_grading_halus + '</td>' +
                '<td>' + nomor_batch + '</td>' +
                '<td>' + nomor_bstb + '</td>' +
                '<td>' + nomor_job + '</td>' +
                '<td>' + jenis_job + '</td>' +
                '<td>' + berat_job + '</td>' +
                '<td>' + pcs_job + '</td>' +
                '<td>' + tujuan_kirim + '</td>' +
                '<td>' + keterangan + '</td>' +
                '<td>' + modal + '</td>' +
                '<td>' + total_modal + '</td>' +
                '<td>' + user_created + '</td>' +
                '</td><td><button class="btn btn-danger" onclick="hapusBaris(this)">Delete</button></td></tr>';

            $('#tableBody').append(newRow);

            // Menambahkan data ke dalam array
            dataArray.push({
                id_box_grading_halus: id_box_grading_halus,
                nomor_batch: nomor_batch,
                nomor_bstb: nomor_bstb,
                nomor_job: nomor_job,
                jenis_job: jenis_job,
                berat_job: berat_job,
                berat_masuk: berat_masuk,
                pcs_masuk: pcs_masuk,
                pcs_job: pcs_job,
                tujuan_kirim: tujuan_kirim,
                keterangan: keterangan,
                modal: modal,
                total_modal: total_modal,
                user_created: user_created,
            });
            // Membersihkan nilai input setelah ditambahkan
            $('#nomor_batch').val('');
            $('#nomor_bstb').val('');
            $('#nomor_job').val('');
            $('#berat_job').val('');
            $('#pcs_job').val('');
            $('#keterangan').val('');
            $('#modal').val('');
            $('#total_modal').val('');
            $('#id_box_grading_halus').val($('#id_box_grading_halus').val()).trigger('change');
            $('#user_created').prop('readonly', true);
            $('#tujuan_kirim').val($('#tujuan_kirim option:first').val());

            // Update indeks baris terakhir
            currentRowIndex++;

            // Kosongkan input setelah menambahkan baris
            $('#nomor_batch, #nomor_bstb, #nomor_job, #berat_job, #pcs_job, #keterangan, #modal, #total_modal, #jenis_job, #berat_masuk, #pcs_masuk')
                .val('');
            $('#tujuan_kirim').prop('selectedIndex', 0);
        }


        // Ambil indeks terakhir sebelum menghapus baris
        var lastRowIndex = currentRowIndex;

        function hapusBaris(button) {
            // Dapatkan elemen baris terkait dengan tombol delete yang diklik
            let row = $(button).closest('tr');

            // Hapus baris dari dataArray berdasarkan indeks baris di tabel
            let rowIndex = row.index();
            dataArray.splice(rowIndex, 1);

            // Hapus baris dari tabel
            row.remove();

            // Update indeks baris terakhir
            currentRowIndex--;
        }

        function sendData() {
            console.log("Isi data=",
                dataArray);
            // Mengirim data ke server menggunakan AJAX
            $.ajax({
                url: '{{ route('GradingHalusOutput.store') }}',
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
                    dataArray: JSON.stringify(
                        dataArray),
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
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
                        title: 'Failed!',
                        text: 'Terjadi kesalahan. Silakan coba cek data kembali.',
                        icon: 'error'
                    });
                    console.log('Error:', error);
                }
            });
        }
    </script>
@endsection
