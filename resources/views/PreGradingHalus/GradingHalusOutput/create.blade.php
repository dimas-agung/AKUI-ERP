@extends('layouts.master1')
@section('menu')
    Grading Halus
@endsection
@section('title')
    Grading Halus Output
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
                            <h4>Input Data Grading Halus Output</h4>
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
                                            name="id_box_grading_halus" data-placeholder="Pilih ID Box Grading Halus">
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
                                        <select id="tujuan_kirim" class="select2 form-select" name="tujuan_kirim"
                                            data-placeholder="Pilih Tujuan Kirim">
                                            <option value="">Pilih Tujuan Kirim</option>
                                            @foreach ($TujuanKirimGHI->sortBy('tujuan_kirim') as $post)
                                                <option value="{{ $post->inisial_tujuan }}">
                                                    {{ old('tujuan_kirim', $post->tujuan_kirim) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nomor Partai</label>
                                     
                                        <input type="text" class="form-control" id="nomor_partai" name="nomor_partai" onkeypress="return event.charCode != 32"
                                            >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nomor BSTB</label>
                                        <input type="hidden" class="form-control" id="inisial_tujuan">
                                        <input type="text" class="form-control" id="nomor_bstb" name="nomor_bstb" onkeypress="return event.charCode != 32"
                                            >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nomor Job</label>
                                        <input type="text" class="form-control" id="nomor_job" name="nomor_job" >
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
                                        <input type="text" id="total_modal_lama" class="form-control"
                                            name="total_modal_lama" readonly>
                                        <input type="hidden" id="total_modal" class="form-control" name="total_modal">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Berat Job</label>
                                        <input type="text" id="berat_job" pattern="[0-9]*" inputmode="numeric"
                                            onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                            class="form-control" name="berat_job" value="{{ old('berat_job') }}"
                                            placeholder="Masukkan berat job" data-parsley-required="true">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Pcs Job</label>
                                        <input type="text" id="pcs_job" pattern="[0-9]*" inputmode="numeric"
                                            onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                            class="form-control" name="pcs_job" value="{{ old('pcs_job') }}"
                                            placeholder="Masukkan pcs job" data-parsley-required="true">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Upah Oprator</label>
                                        <input type="hidden" id="upah" class="form-control" name="upah"
                                            readonly>
                                        <input type="text" id="upah_oprator" class="form-control" name="upah_oprator"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>NIP Admin</label>
                                        <input type="text" id="user_created" class="form-control" name="user_created"
                                            placeholder="Masukkan User Created" value="{{ auth()->user()->nip }}" readonly
                                            data-parsley-required="true">
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
                    <table class="table table-striped mt-3" id="tableBody">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">Id Box Grading Halus</th>
                                <th class="text-center" scope="col">Nomor Batch</th>
                                <th class="text-center" scope="col">Nomor BSTB</th>
                                <th class="text-center" scope="col">Nomor Job</th>
                                <th class="text-center" scope="col">Jenis Job</th>
                                <th class="text-center" scope="col">Berat Job</th>
                                <th class="text-center" scope="col">Pcs Job</th>
                                <th class="text-center" scope="col">Upah Oprator</th>
                                <th class="text-center" scope="col">Tujuan Kirim</th>
                                <th class="text-center" scope="col">Keterangan</th>
                                @role('admin')
                                <th class="text-center" scope="col">Modal</th>
                                <th class="text-center" scope="col">Total Modal</th>
                                @endrole
                                <th class="text-center" scope="col">NIP Admin</th>
                                <th class="text-center" scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <a href="#" class="btn btn-primary" onclick="CeksendData()">Submit</a>
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

        let inisialTujuanGlobal = ''; // Variabel global untuk menyimpan inisial_tujuan
        let nomorBSTBGlobal = ''; // Variabel global untuk menyimpan nomor BSTB

        $('#tujuan_kirim').on('change', function() {
            let selectedPcc = $(this).val();

            $.ajax({
                url: '{{ route('GradingHalusOutput.setpcc') }}',
                method: 'GET',
                data: {
                    tujuan_kirim: selectedPcc
                },
                success: function(response) {
                    if (response.status > 0) {
                        inisialTujuanGlobal = response
                            .inisial_tujuan; // Simpan inisial_tujuan ke variabel global
                        checkAndGenerateNomorBSTB(
                            inisialTujuanGlobal); // Panggil fungsi dengan inisial_tujuan
                    }
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });

        function checkAndGenerateNomorBSTB(inisialTujuan) {
            const idBoxGradingHalus = $('#id_box_grading_halus').val();

            if (inisialTujuan && idBoxGradingHalus) {
                // Hanya generate nomor BSTB jika nomor BSTB global belum diatur
                if (!nomorBSTBGlobal) {
                    nomorBSTBGlobal = generateNomorBSTB('BSTB', inisialTujuan);
                    $('#nomor_bstb').val(nomorBSTBGlobal);
                }

                const generatedNomorJob = generateNomorBSTB('JOB', inisialTujuan);
                $('#nomor_job').val(generatedNomorJob);
                $('#nomor_partai').val('Pt_'+generatedNomorJob);
            }
        }

        function generateNomorBSTB(prefix, inisial_tujuan) {
            let nomor;

            const now = new Date();
            const tahun = now.getFullYear().toString().substr(-2);
            const bulan = ('0' + (now.getMonth() + 1)).slice(-2);
            const tanggal = ('0' + now.getDate()).slice(-2);
            const jam = ('0' + now.getHours()).slice(-2);
            const menit = ('0' + now.getMinutes()).slice(-2);
            const detik = ('0' + now.getSeconds()).slice(-2);

            if (prefix === 'BSTB') {
                nomor = `BSTB_${tanggal}${bulan}${tahun}-${jam}${menit}${detik}_${inisial_tujuan}_UGH`;
            } else {
                nomor = `${tanggal}${bulan}${tahun}-${jam}${menit}${detik}_${inisial_tujuan}_UGH`;
            }

            return nomor;
        }

        $('#id_box_grading_halus').on('change', function() {
            let selectedIdBox = $(this).val();
            generateAfterIdboxChange(selectedIdBox)
          
        });
        function generateAfterIdboxChange(selectedIdBox) {
            if (selectedNomorBSTB !== selectedIdBox) {
                selectedNomorBSTB = selectedIdBox;
                $.ajax({
                    url: "{{ route('GradingHalusOutput.set') }}",
                    method: 'GET',
                    async: false,
                    data: {
                        id_box_grading_halus: selectedIdBox
                    },
                    success: function(response) {
                        let data = response.length > 0 ? response[0] : null;

                        if (data) {
                            $('#id_box_raw_material').val(data.id_box_raw_material);
                            $('#nomor_batch').val(data.nomor_batch);
                            $('#jenis_job').val(data.jenis);
                            $('#modal').val(data.modal);
                            $('#total_modal_lama').val(data.total_modal);
                        } else {
                            console.error('No data found for the selected id_box_grading_halus');
                        }

                        let totalBeratMasuk = 0;
                        let totalPcsMasuk = 0;

                        response.forEach(function(item) {
                            totalBeratMasuk += (parseFloat(item.berat_masuk) - parseFloat(item.berat_keluar));
                            totalPcsMasuk += (parseInt(item.pcs_masuk) - parseInt(item.pcs_keluar));
                        });

                        $('#berat_masuk').val(totalBeratMasuk);
                        beratMasukAwal += totalBeratMasuk;
                        $('#pcs_masuk').val(totalPcsMasuk);
                        pcsMasukAwal += totalPcsMasuk;
                        generateUpah();
                        calculateUpah();
                        // Memanggil generateNomorBSTB dan mengatur nilai sesuai dengan respons dari server
                        // let generatedNomorBSTB = generateNomorBSTB(
                        //     'BSTB'); // Memanggil generateNomorBSTB dengan prefix 'BSTB'
                        // let generatedNomorJob = generateNomorBSTB(
                        //     'JOB'); // Memanggil generateNomorBSTB dengan prefix 'JOB'
                        // $('#nomor_bstb').val(generatedNomorBSTB);
                        // $('#nomor_job').val(generatedNomorJob);
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            }
            console.log('yeesadhjnkjadj');
            generateUpah();
            calculateUpah();

        }
        $('#tujuan_kirim').on('change', function() {
            // let selectedIdBox = $(this).val();
            let generatedNomorBSTB = generateNomorBSTB( 'BSTB'); // Memanggil generateNomorBSTB dengan prefix 'BSTB'
            let generatedNomorJob = generateNomorBSTB('JOB'); // Memanggil generateNomorBSTB dengan prefix 'JOB'
            $('#nomor_bstb').val(generatedNomorBSTB);
            $('#nomor_job').val(generatedNomorJob);
            $('#nomor_partai').val('Pt_'+generatedNomorJob);
        });

        $('#berat_job').on('input', function() {
            calculateUpah();
        });

        $('#modal').on('input', function() {
            calculateUpah();
        });

        function generateUpah() {
            let jenis_job = $('#jenis_job').val();
            $.ajax({
                url: `{{ route('GradingHalusOutput.setUpah') }}`,
                method: 'GET',
                async:false,
                data: {
                    jenis: jenis_job
                },
                success: function(response) {
                    $('#upah').val(response.upah_operator);
                    // calculateUpah(); // Hitung upah setelah mendapatkan upah operator
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        }

        function calculateUpah() {
            let upah_operator = parseFloat($('#upah').val());
            let berat_job = parseFloat($('#berat_job').val());
            let modal = parseFloat($('#modal').val());

            if (!isNaN(upah_operator) && !isNaN(berat_job)) {
                let hasil_upah = upah_operator * berat_job;
                $('#upah_oprator').val(hasil_upah.toFixed(2)); // Menampilkan hasil dengan 2 desimal
            } else {
                $('#upah_oprator').val(upah_operator);
            }


            // Menghitung total modal
            if (!isNaN(berat_job) && !isNaN(modal)) {
                let total_modal = berat_job * modal;
                $('#total_modal').val(total_modal.toFixed(2)); // Menampilkan total modal dengan 2 desimal
            } else {
                $('#total_modal').val('');
            }
        }
        // });

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
            console.log(totalPcsMasuk);
            // Memperbarui nilai total berat masuk dan pcs masuk
            $('#berat_masuk').val(totalBeratMasuk);
            $('#pcs_masuk').val(totalPcsMasuk);
        }

        // Mendengarkan perubahan pada inputan berat job
        $('#berat_job').on('input', function() {
            hitungTotal();
            console.log('job');
        });

        // Mendengarkan perubahan pada inputan pcs job
        $('#pcs_job').on('input', function() {
            hitungTotal();
        });

        // Mendengarkan perubahan pada inputan berat masuk
        $('#berat_masuk').on('input', function() {
            hitungTotal();
            console.log('masuk');
        });

        // Mendengarkan perubahan pada inputan pcs masuk
        $('#pcs_masuk').on('input', function() {
            hitungTotal();
        });

        function generateNomorBSTB(prefix) {
            let nomor;
            let tujuan_kirim = $('#tujuan_kirim').val()
            const now = new Date();
            const tahun = now.getFullYear().toString().substr(-2);
            const bulan = ('0' + (now.getMonth() + 1)).slice(-2);
            const tanggal = ('0' + now.getDate()).slice(-2);
            const jam = ('0' + now.getHours()).slice(-2);
            const menit = ('0' + now.getMinutes()).slice(-2);
            const detik = ('0' + now.getSeconds()).slice(-2);

            // Menambahkan prefix yang sesuai
            if (prefix === 'BSTB') {
                nomor = `BSTB_${tanggal}${bulan}${tahun}-${jam}${menit}${detik}_${tujuan_kirim}_UGH`;
            } else {
                nomor = `${tanggal}${bulan}${tahun}-${jam}${menit}${detik}_${tujuan_kirim}_UGH`;
            }

            return nomor;
        }

        // Variabel global untuk menyimpan indeks baris terakhir
        var currentRowIndex = 0;
        var dataArray = [];

        function addRow() {
            let nomor_job = $('#nomor_job').val().replace(/\s/g, "");

            // Periksa apakah nomor job sudah ada dalam tabel
            if ($('#tableBody tbody tr td:nth-child(1)').filter(function() {
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
            // Hapus opsi id_box_grading_halus yang sudah dipilih dari dropdown
            // $('#id_box_grading_halus option[value="' + id_box_grading_halus + '"]').remove();
            // Mengambil nilai dari inputgrading_halus = $('#id_box_grading_halus').val();
            var id_box_grading_halus = $('#id_box_grading_halus').val();
            var nomor_batch = $('#nomor_batch').val();
            var nomor_bstb = $('#nomor_bstb').val().replace(/\s/g, "");
            var nomor_partai = $('#nomor_partai').val().replace(/\s/g, "");
            // var nomor_job = $('#nomor_job').val();
            var jenis_job = $('#jenis_job').val();
            var berat_job = $('#berat_job').val();
            var berat_masuk = $('#berat_masuk').val();
            var pcs_job = $('#pcs_job').val();
            var pcs_masuk = $('#pcs_masuk').val();
            var upah_oprator = $('#upah_oprator').val();
            var tujuan_kirim = $('#tujuan_kirim').val();
            var keterangan = $('#keterangan').val();
            var modal = $('#modal').val();
            var total_modal = berat_job*modal;
            var user_created = $('#user_created').val();
            beratMasukAwal -= berat_job
            pcsMasukAwal -= pcs_job
            // Inisialisasi array untuk menyimpan field yang belum terisi
            let fieldsNotFilled = [];
            // Periksa setiap field
            if (!id_box_grading_halus) fieldsNotFilled.push('No Grading');
            if (!tujuan_kirim) fieldsNotFilled.push('Tujuan Kirim');
            if (!user_created) fieldsNotFilled.push('NIP Admin');
            if (!berat_job || berat_job <= 0) fieldsNotFilled.push('Berat Job');
            if (!pcs_job ) fieldsNotFilled.push('PCS Job');

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
            generateQrCode(nomor_job)
            let berat_bersih = berat_job/1.15;
            let cetak_keterangan = keterangan == ''? '' :'('+keterangan+')';
            $('#cetak_nomor_batch').html(nomor_batch)
            $('#cetak_nomor_job').html(nomor_job)
            $('#cetak_jenis').html(jenis_job+cetak_keterangan)
            $('#cetak_gramasi').html(Math.floor(berat_bersih))
            $('#cetak_pcs').html(pcs_job)
            window.print();
            var newRow = '<tr>' +
                '<td>' + id_box_grading_halus + '</td>' +
                '<td>' + nomor_batch + '</td>' +
                '<td>' + nomor_partai + '</td>' +
                '<td>' + nomor_bstb + '</td>' +
                '<td>' + nomor_job + '</td>' +
                '<td>' + jenis_job + '</td>' +
                '<td>' + berat_job + '</td>' +
                '<td>' + pcs_job + '</td>' +
                '<td>' + upah_oprator + '</td>' +
                '<td>' + tujuan_kirim + '</td>' +
                '<td>' + keterangan + '</td>' +
                @role('admin')
                '<td>' + modal + '</td>' +
                '<td>' + total_modal + '</td>' +
                @endrole
                '<td>' + user_created + '</td>' +
                '</td><td><button class="btn btn-danger" onclick="hapusBaris(this)">Delete</button></td></tr>';

            $('#tableBody').append(newRow);

            // Menambahkan data ke dalam array
            dataArray.push({
                id_box_grading_halus: id_box_grading_halus,
                nomor_batch: nomor_batch,
                nomor_partai: nomor_partai,
                nomor_bstb: nomor_bstb,
                nomor_job: nomor_job,
                jenis_job: jenis_job,
                berat_job: berat_job,
                berat_masuk: berat_masuk,
                pcs_masuk: pcs_masuk,
                pcs_job: pcs_job,
                upah_operator: upah_oprator,
                tujuan_kirim: tujuan_kirim,
                keterangan: keterangan,
                modal: modal,
                total_modal: total_modal,
                user_created: user_created,
            });
            // Membersihkan nilai input setelah ditambahkan
            // $('#nomor_batch').val('');
            // $('#nomor_bstb').val('');
            $('#nomor_bstb').prop('readonly', true);
            let generatedNomorJob = generateNomorBSTB('JOB'); // Memanggil generateNomorBSTB dengan prefix 'JOB
            $('#nomor_job').val(generatedNomorJob);
            // $('#nomor_job').prop('readonly', true);
            $('#berat_job').val('');
            $('#pcs_job').val('');
            $('#upah_oprator').val('');
            $('#keterangan').val('');
            generateAfterIdboxChange(id_box_grading_halus)
            // $('#modal').val('');
            // $('#total_modal').val('');
            // $('#id_box_grading_halus').val($('#id_box_grading_halus').val()).trigger('change');
            $('#user_created').prop('readonly', true);
            // $('#tujuan_kirim').val($('#tujuan_kirim option:first').val());
            $('#tujuan_kirim').attr("disabled", true);

            // Update indeks baris terakhir
            currentRowIndex++;

            // Kosongkan input setelah menambahkan baris
            // $('#nomor_batch, #nomor_bstb, #nomor_job, #berat_job, #pcs_job, #upah_oprator, #keterangan, #modal, #total_modal, #jenis_job, #berat_masuk, #pcs_masuk')
            //     .val('');
            // $('#tujuan_kirim').prop('selectedIndex', 0);
        }


        // Ambil indeks terakhir sebelum menghapus baris
        var lastRowIndex = currentRowIndex;

        function hapusBaris(button) {
            // Dapatkan elemen baris terkait dengan tombol delete yang diklik
            let row = $(button).closest('tr');

            // Dapatkan id_box_grading_halus dari baris yang dihapus
            let idBoxGradingHalusHapus = row.find('td:eq(0)').text();

            // Buat kembali opsi id_box_grading_halus yang dihapus dan tambahkan ke dalam dropdown
            $('#id_box_grading_halus').append('<option value="' + idBoxGradingHalusHapus + '">' + idBoxGradingHalusHapus +
                '</option>');

            // Urutkan opsi id_box_grading_halus dalam dropdown
            let options = $('#id_box_grading_halus option');
            options.detach().sort(function(a, b) {
                let at = $(a).text();
                let bt = $(b).text();
                return (at > bt) ? 1 : ((at < bt) ? -1 : 0);
            });
            $('#id_box_grading_halus').append(options);

            // Hapus baris dari dataArray berdasarkan indeks baris di tabel
            let rowIndex = row.index();
            dataArray.splice(rowIndex, 1);

            // Hapus baris dari tabel
            row.remove();

            // Update indeks baris terakhir
            currentRowIndex--;
        }

        function CeksendData() {
            var i = 0;
            var idBoxes = []; // Array untuk menyimpan id box yang akan dicek

            // Mengumpulkan id box dari dataArray
            dataArray.forEach(function(item) {
                idBoxes.push(item.id_box_grading_halus);
            });

            // Mengirimkan permintaan AJAX untuk memeriksa ketersediaan id box
            $.ajax({
                url: `{{ route('GradingHalusOutput.sendData') }}`, // Ganti dengan URL endpoint yang sesuai untuk memeriksa ketersediaan id box
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
                            text: 'Beberapa id box grading halus sudah tidak tersedia.',
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
                        text: 'Terjadi kesalahan saat memeriksa ketersediaan id box grading halus. Silakan coba lagi.',
                        icon: 'error'
                    });
                    console.log('Error:', error);
                }
            });

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
                                location.reload();
                                // window.location.href = response.redirectTo; // Ganti dengan URL tujuan redirect Anda
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
@section('printArea')
    <style>
        @media print {
            body {
            visibility: hidden;
            /* display: none; */
            /* position: relative; */
            }
            #printableArea1 {
            visibility: visible;
            /* display: inline; */
            position: absolute;
            left: 0;
            top: 0;
            /* bottom: 0; */
            /* right: 0; */
            }
            .no-print {
                display: none; /* Menyembunyikan elemen dengan class "no-print" saat mencetak */
            }
        }
    </style>
    <div class="row" id="printableArea1" style="max-width: 200px;margin: 10px;">

        <div id="qrcode" class="col" style="max-width: 70px;padding-right:0;padding-left:0;"></div>
        <div class="col" style="font-size: 9px;width: 220px;padding-right:0;padding-left:0;" >
            <span style="text-align: center;font-weight: bold;;font-size:10px;" id="cetak_nomor_batch">1234567890</span><br>
            <span style="font-family:Calibri;font-weight: bold;font-size:10px;"  id="cetak_nomor_job">010324-083609_AKI_ugk</span><br>
            <span style="font-family:Calibri;font-weight: bold;font-size:10px;" id="cetak_jenis">PT12</span><br>
            <span style="font-family:Calibri;font-weight: bold;font-size:10px;" id="cetak_gramasi">100</span><span style="font-family:Calibri;font-weight: bold;font-size:10px;" >gr / </span><span style="font-family:Calibri;font-weight: bold;font-size:10px;"   id="cetak_pcs">20</span><span style="font-family:Calibri;font-weight: bold;font-size:10px;" >pcs</span>
        </div>
    </div>
@endsection
