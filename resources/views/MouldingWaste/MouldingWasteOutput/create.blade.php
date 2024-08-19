@extends('layouts.master1')
@section('menu')
    Moulding Waste
@endsection
@section('title')
    Moulding Waste
@endsection
@section('content')
    {{-- <div class="container"> --}}
    <div class="card border border-primary border-3 mt-2">
        <form action="{{ route('MouldingWasteOutput.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 shadow-sm rounded">
                        <div class="card-header">
                            <h4>Data Moulding Waste Output</h4>
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
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="asal_stock">Asal Stock</label>
                                        <select id="asal_stock" class="select2 form-select" name="asal_stock" 
                                            data-placeholder="Pilih Asal Stock">
                                            <option value="">Pilih Asal Stock</option>
                                            <option value="warna" {{ old('asal_stock') == 'warna' ? 'selected' : '' }}>
                                                Grading Warna Stock
                                            </option>
                                            <option value="waste" {{ old('asal_stock') == 'waste' ? 'selected' : '' }}>
                                                Moulding Waste Stock
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Id Box</label>
                                        <select id="id_box" class="select2 form-select" data-placeholder="Pilih Id Box"
                                            name="id_box">
                                            <option value="">Pilih Id Box</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tujuan Kirim</label>
                                        <select id="tujuan_kirim" class="select2 form-select" name="tujuan_kirim"
                                            data-placeholder="Pilih Tujuan Kirim">
                                            <option value="">Pilih Tujuan Kirim</option>
                                            @foreach ($TujuanKirimGHI->sortBy('tujuan_kirim') as $post)
                                                <option value="{{ $post->tujuan_kirim }}">
                                                    {{ old('tujuan_kirim', $post->tujuan_kirim) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Jenis Waste</label>
                                        <input type="text" class="form-control" id="jenis" name="jenis" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nomor BSTB</label>
                                        <input type="text" class="form-control" id="nomor_bstb" name="nomor_bstb"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nomor Job</label>
                                        <input type="text" class="form-control" id="nomor_job" name="nomor_job" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Modal</label>
                                        <input type="text" class="form-control" id="modal" name="modal" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>NIP Admin</label>
                                        <input type="text" id="user_created" class="form-control" name="user_created"
                                            value="{{ auth()->user()->nip }}" readonly data-parsley-required="true">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Berat Masuk</label>
                                        <input type="text" class="form-control" id="berat_masuk" name="berat_masuk"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Pcs Masuk</label>
                                        <input type="text" class="form-control" id="pcs_masuk" name="pcs_masuk" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Berat</label>
                                        <input type="text" class="form-control" id="berat" name="berat"
                                            placeholder="Masukan Berat">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Pcs</label>
                                        <input type="text" class="form-control" id="pcs" name="pcs"
                                            placeholder="Masukan Pcs">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <input type="text" id="keterangan" class="form-control" name="keterangan"
                                            placeholder="Masukkan keterangan">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="button" class="btn btn-primary" onclick="addRow()">Add</button>
                                <a href="{{ Route('DryAWasteOutput.index') }}" type="button" class="btn btn-danger"
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
                                <th class="text-center" scope="col">Asal Stock</th>
                                <th class="text-center" scope="col">Id Box</th>
                                <th class="text-center" scope="col">Jenis Waste</th>
                                <th class="text-center" scope="col">Tujuan Kirim</th>
                                <th class="text-center" scope="col">Nomor Job</th>
                                <th class="text-center" scope="col">Nomor BSTB</th>
                                <th class="text-center" scope="col">Berat</th>
                                <th class="text-center" scope="col">Pcs</th>
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
                    <a href="#" class="btn btn-primary" onclick="CeksendData()">Submit</a>
                </div>
            </div>
        </div>
    </div>
    </form>

@endsection
@section('script')
    <script>
        $('#asal_stock').on('change', function() {
            let typeTransit = $(this).val();
            console.log(typeTransit);
            let targetSelect = $('#id_box');
            let userPlant =
                '{{ auth()->user()->plant }}'; // Ganti ini dengan nilai plant dari user yang sebenarnya
               
            // Clear the options before making the AJAX call
            targetSelect.empty();
            targetSelect.append('<option value="">Pilih Id Box</option>'); // Tambahkan opsi default
            let processResponse = function(response, idBoxKey) {
                let dataTransit = response;
                let lastCharMap = new Map();

                dataTransit.forEach(v => {
                    // console.log(v.id_box_grading_warna);
                    let idBox = v[idBoxKey];
                    // console.log('- '+idBox);
                    let filter = '';
                    if (typeTransit == 'warna') {
                         filter = 'v.tujuan_kirim == userPlant';
                    }else{
                        filter = 'v.plant == userPlant';
                    }
                    if (idBox && filter) {
                        let lastChar = idBox.slice(-1);
                        // if (!lastCharMap.has(lastChar)) {
                        lastCharMap.set(lastChar, idBox);
                        targetSelect.append(
                            `<option value="${idBox}">${idBox}</option>`
                        );
                        // }
                    }
                });
            };
           
            switch (typeTransit) {
                case 'warna':
                    $.ajax({
                        url: '{{ route('MouldingWasteOutput.getGrading') }}',
                        method: 'GET',
                        data: {
                            plant: userPlant
                        }, // Kirim plant sebagai parameter
                        success: function(response) {
                            processResponse(response, 'id_box_grading_warna');
                        },
                        error: function(error) {
                            console.error('Error fetching data:', error);
                        }
                    });
                    break;
                case 'waste':
                    $.ajax({
                        url: '{{ route('MouldingWasteOutput.getWaste') }}',
                        method: 'GET',
                        data: {
                            plant: userPlant
                        }, // Kirim plant sebagai parameter
                        success: function(response) {
                            processResponse(response, 'id_box_waste_moulding');
                        },
                        error: function(error) {
                            console.error('Error fetching data:', error);
                        }
                    });
                    break;
                default:
                    break;
            }
        });
       


        // Variabel global
        let inisialTujuanGlobal = ''; // Variabel global untuk menyimpan inisial_tujuan
        let nomorBSTBGlobal = ''; // Variabel global untuk menyimpan nomor BSTB

        // Event listener ketika memilih tujuan kirim
        $('#tujuan_kirim').on('change', function() {
            let selectedPcc = $(this).val();

            $.ajax({
                url: '{{ route('MouldingWasteOutput.setpcc') }}',
                method: 'GET',
                data: {
                    tujuan_kirim: selectedPcc
                },
                success: function(response) {
                    if (response.status > 0) {
                        inisialTujuanGlobal = response
                            .inisial_tujuan; // Simpan inisial_tujuan ke variabel global
                        checkAndGenerateNomorBSTB(); // Panggil fungsi tanpa parameter
                    }
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });

        // Fungsi untuk menggenerate nomor BSTB dan nomor job
        function checkAndGenerateNomorBSTB() {
            // Hanya generate nomor BSTB jika nomor BSTB global belum diatur
            if (!nomorBSTBGlobal && inisialTujuanGlobal) {
                nomorBSTBGlobal = generateNomorBSTB('BSTB');
                $('#nomor_bstb').val(nomorBSTBGlobal);
            }

            // Generate nomor job
            const generatedNomorJob = generateNomorBSTB('JOB');
            $('#nomor_job').val(generatedNomorJob);
        }

        // Fungsi untuk menggenerate nomor BSTB dengan prefix tertentu
        function generateNomorBSTB(prefix) {
            let nomor;
            const plant = '{{ auth()->user()->plant }}';

            const now = new Date();
            const tahun = now.getFullYear().toString().substr(-2);
            const bulan = ('0' + (now.getMonth() + 1)).slice(-2);
            const tanggal = ('0' + now.getDate()).slice(-2);
            const jam = ('0' + now.getHours()).slice(-2);
            const menit = ('0' + now.getMinutes()).slice(-2);
            const detik = ('0' + now.getSeconds()).slice(-2);

            if (prefix === 'BSTB') {
                nomor = `BSTB_${tanggal}${bulan}${tahun}-${jam}${menit}${detik}_UMD_${inisialTujuanGlobal}_${plant}`;
            } else {
                nomor = `${tanggal}${bulan}${tahun}-${jam}${menit}${detik}_UMD_${inisialTujuanGlobal}_${plant}`;
            }

            return nomor;
        }

        // Event listener ketika memilih id_box
        $('#id_box').on('change', function() {
            let selectedIdBox = $(this).val();
            let typeTransit = $('#asal_stock').val();
            let url = typeTransit === 'warna' ?
                '{{ route('MouldingWasteOutput.setGrading') }}' :
                '{{ route('MouldingWasteOutput.setWaste') }}';

            $.ajax({
                url: url,
                method: 'GET',
                data: {
                    id_box: selectedIdBox
                },
                success: function(response) {
                    console.log(response);
                    if (typeTransit === 'warna' && response.jenis_grading) {
                        $('#jenis').val(response.jenis_grading);
                        $('#modal').val(response.modal);
                        $('#berat_masuk').val(response.sisa_berat);
                        $('#pcs_masuk').val(response.sisa_pcs);
                    } else if (typeTransit === 'waste' && response.jenis_waste) {
                        $('#jenis').val(response.jenis_waste);
                        $('#modal').val(response.modal);
                        $('#berat_masuk').val(response.sisa_berat);
                        $('#pcs_masuk').val(response.sisa_pcs);
                    } else {
                        console.error('Error: Data not found in response');
                    }

                    // Generate nomor job setiap kali id_box berubah
                    if (inisialTujuanGlobal) {
                        const generatedNomorJob = generateNomorBSTB('JOB');
                        $('#nomor_job').val(generatedNomorJob);
                    }
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });

        // Event listener untuk tombol addRow
        $('#addRow').on('click', function() {
            // Disable the button to prevent multiple clicks
            $(this).prop('disabled', true);
        });


        $('#tujuan_kirim').on('change', function() {
            checkAndGenerateNomorBSTB();
        });

        $(document).ready(function() {
            $('#berat').on('input', function() {
                var berat = parseFloat($(this).val());
                var berat_masuk = parseFloat($('#berat_masuk').val());

                if (berat > berat_masuk) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Berat keluar tidak boleh lebih dari berat masuk.',
                        icon: 'error'
                    });
                    $(this).val(''); // Kosongkan input berat jika nilai tidak valid
                }
            });

            $('#pcs').on('input', function() {
                var pcs = parseFloat($(this).val());
                var pcs_masuk = parseFloat($('#pcs_masuk').val());

                if (pcs > pcs_masuk) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Pcs keluar tidak boleh lebih dari pcs masuk.',
                        icon: 'error'
                    });
                    $(this).val(''); // Kosongkan input pcs jika nilai tidak valid
                }
            });
        });

        // Variabel global untuk menyimpan indeks baris terakhir
        var currentRowIndex = 0;
        var dataArray = [];

        function addRow() {
            // Mengambil nilai dari inputgrading_halus = $('#id_box_grading_halus').val();
            var asal_stock = $('#asal_stock').val();
            var id_box = $('#id_box').val();
            var jenis = $('#jenis').val();
            var tujuan_kirim = $('#tujuan_kirim').val();
            var nomor_job = $('#nomor_job').val();
            var nomor_bstb = $('#nomor_bstb').val();
            var berat_masuk = ($('#berat_masuk').val());
            var berat = $('#berat').val();
            var pcs = $('#pcs').val();
            var keterangan = $('#keterangan').val();
            var modal = $('#modal').val();
            var user_created = $('#user_created').val();
            // Inisialisasi array untuk menyimpan field yang belum terisi
            let fieldsNotFilled = [];
            // Periksa setiap field
            if (!asal_stock) fieldsNotFilled.push('Asal Stock');
            if (!id_box) fieldsNotFilled.push('Id box');
            if (!jenis) fieldsNotFilled.push('Jenis Waste');
            if (!tujuan_kirim) fieldsNotFilled.push('Tujuan Kirim');
            if (!user_created) fieldsNotFilled.push('NIP Admin');
            if (!berat) fieldsNotFilled.push('Berat');
            if (!pcs) fieldsNotFilled.push('Pcs');

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

            // Menghitung total modal
            var total_modal = (berat_masuk - berat) * modal;

            var newRow = '<tr>' +
                '<td>' + asal_stock + '</td>' +
                '<td>' + id_box + '</td>' +
                '<td>' + jenis + '</td>' +
                '<td>' + tujuan_kirim + '</td>' +
                '<td>' + nomor_job + '</td>' +
                '<td>' + nomor_bstb + '</td>' +
                '<td>' + berat + '</td>' +
                '<td>' + pcs + '</td>' +
                '<td>' + keterangan + '</td>' +
                '<td>' + modal + '</td>' +
                '<td>' + total_modal + '</td>' +
                '<td>' + user_created + '</td>' +
                '</td><td><button class="btn btn-danger" onclick="hapusBaris(this)">Delete</button></td></tr>';

            $('#tableBody').append(newRow);

            // Menambahkan data ke dalam array
            dataArray.push({
                asal_stock: asal_stock,
                id_box: id_box,
                jenis: jenis,
                tujuan_kirim: tujuan_kirim,
                nomor_bstb: nomor_bstb,
                nomor_job: nomor_job,
                berat: berat,
                pcs: pcs,
                keterangan: keterangan,
                modal: modal,
                total_modal: total_modal,
                user_created: user_created,
            });
            // Membersihkan nilai input setelah ditambahkan
            $('#berat').val('');
            $('#pcs').val('');
            $('#keterangan').val('');
            $('#modal').val('');
            $('#total_modal').val('');
            $('#id_box').val(null).trigger('change');
            $('#user_created').prop('readonly', true);
            // Set tujuan_kirim sebagai read-only setelah dipilih
            $('#tujuan_kirim').prop('disabled', true);
            $('#asal_stock').prop('disabled', true);

            // Update indeks baris terakhir
            currentRowIndex++;
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

            // Cek apakah tabel tidak memiliki baris data lagi
            if ($('#tableBody tr').length === 0) {
                $('#tujuan_kirim').prop('disabled', false).val(null).trigger('change');
                $('#asal_stock').prop('disabled', false).val(null).trigger('change');
                $('#nomor_job').val('');
                $('#nomor_bstb').val('');
                $('#jenis').val('');

                nomorBSTBGlobal = null;
            }
        }

        function CeksendData() {
            var i = 0;
            var idBoxes = []; // Array untuk menyimpan id box yang akan dicek
            var typeTransit = $('#asal_stock').val();

            // Mengumpulkan id box dari dataArray
            dataArray.forEach(function(item) {
                idBoxes.push(item.id_box);
            });

            // Mengirimkan permintaan AJAX untuk memeriksa ketersediaan id box
            $.ajax({
                url: `{{ route('MouldingWasteOutput.sendData') }}`, // Ganti dengan URL endpoint yang sesuai untuk memeriksa ketersediaan id box
                method: 'POST',
                data: {
                    idBoxes: JSON.stringify(idBoxes),
                    typeTransit: typeTransit, // Tambahkan typeTransit ke data yang dikirim
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(response) {
                    var unavailableBoxes = response.unavailableBoxes;

                    if (unavailableBoxes.length > 0) {
                        // Ada id box yang tidak tersedia, tampilkan pesan kesalahan
                        Swal.fire({
                            title: 'Error!',
                            text: 'Beberapa id box sudah tidak tersedia.',
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
                        text: 'Terjadi kesalahan saat memeriksa ketersediaan id box. Silakan coba lagi.',
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
                    url: '{{ route('MouldingWasteOutput.store') }}',
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
                            dataArray), // Mengirim dataArray sebagai string JSON
                        user_created: $('#user_created').val() || '',
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
        }
    </script>
@endsection
