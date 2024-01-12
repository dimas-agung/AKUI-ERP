@extends('layouts.master1')
@section('Menu')
    Grading Kasar
@endsection
@section('title')
    Input Grading Kasar
@endsection
@section('content')
    {{-- <div class="container"> --}}
    <div class="card mt-2">
        <form action="{{ route('PrmRawMaterialOutput.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="card border-0 shadow-sm rounded">
                        <div class="card-header">
                            <h4>Input Grading Kasar</h4>
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
                                        <label>Tanggal Adding</label>
                                        <input type="date" id="tgl_add" class="form-control" name="tgl_add"
                                            value="{{ old('tgl_add') }}" placeholder="Masukkan Tanggal Adding">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Plant</label>
                                        <select id="plant" class="choices form-select" name="plant">
                                            <option @readonly(true)>Pilih Plant</option>
                                            <option>A</option>
                                            <option>B</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>NIP Admin</label>
                                        <input type="text" id="user_created" class="form-control" name="user_created"
                                            value="{{ old('user_created') }}" placeholder="Masukkan User Created">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>No BSTB</label>
                                        <select id="nomor_bstb" class="choices form-select" name="nomor_bstb"
                                            data-placeholder="Pilih No BSTB">
                                            <option @readonly(true)>Pilih No BSTB</option>
                                            @foreach ($stockTGK as $post)
                                                <option value="{{ $post->nomor_bstb }}">
                                                    {{ old('nomor_bstb', $post->nomor_bstb) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Id Box</label>
                                        <input type="text" class="form-control" id="id_box" name="id_box"
                                            onchange="handleChange(this.{{ old('id_box') }})" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Kadar Air</label>
                                        <input type="text" class="form-control" id="kadar_air" name="kadar_air"
                                            onchange="handleChange(this.{{ old('kadar_air') }})" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nama Supplier</label>
                                        <input type="text" class="form-control" id="nama_supplier" name="nama_supplier"
                                            onchange="handleChange(this.{{ old('nama_supplier') }})" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nomor Batch</label>
                                        <input type="text" class="form-control" id="nomor_batch" name="nomor_batch"
                                            onchange="handleChange(this.{{ old('nomor_batch') }})" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>No Nota Internal</label>
                                        <input type="text" id="no_nota" class="form-control" name="no_nota"
                                            value="{{ old('no_nota') }}" onchange="handleChange(this)" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Jenis</label>
                                        <input type="text" class="form-control" id="jenis" name="jenis"
                                            onchange="handleChange(this.{{ old('jenis') }})" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Modal</label>
                                        <input type="text" id="modal" class="form-control" name="modal"
                                            onchange="handleChange()">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Berat</label>
                                        <input type="text" id="berat" class="form-control" name="berat"
                                            onchange="handleChange()">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Total Modal</label>
                                        <input type="text" id="total_modal" class="form-control" name="total_modal"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <input type="text" id="keterangan" class="form-control" name="keterangan"
                                            value="{{ old('keterangan') }}" placeholder="Masukkan keterangan">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="button" class="btn btn-primary" onclick="addRow()">Add</button>
                                <a href="{{ url('/GradingKasarInput') }}" type="button" class="btn btn-danger"
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
                                <th class="text-center">No BSTB</th>
                                <th class="text-center">Nomor Batch</th>
                                <th class="text-center">ID Box</th>
                                <th class="text-center">Nama Supplier</th>
                                <th class="text-center">Jenis</th>
                                <th class="text-center">Berat Masuk</th>
                                <th class="text-center">Berat Keluar</th>
                                <th class="text-center">Kadar Air</th>
                                <th class="text-center">Nomor Grading</th>
                                <th class="text-center">Modal</th>
                                <th class="text-center">Total Modal</th>
                                <th class="text-center">Keterangan</th>
                                <th class="text-center">NIP Admin</th>
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
        $('#nomor_bstb').on('change', function() {
            // Mengambil nilai nomor_bstb yang dipilih
            let selectedIdBox = $(this).val();

            // Melakukan permintaan AJAX ke controller untuk mendapatkan data
            $.ajax({
                url: `{{ route('GradingKasarInput.set') }}`,
                method: 'GET',
                data: {
                    nomor_bstb: selectedIdBox
                },
                success: function(response) {
                    // Mengatur nilai elemen-elemen sesuai dengan respons dari server
                    $('#id_box').val(response.id_box);
                    $('#nomor_batch').val(response.nomor_batch);
                    $('#nama_supplier').val(response.nama_supplier);
                    $('#jenis').val(response.jenis);
                    $('#berat').val(response.berat);
                    $('#kadar_air').val(response.kadar_air);
                    $('#modal').val(response.modal);
                    $('#no_nota').val(response.nomor_nota_internal);

                    // Memanggil fungsi untuk mengupdate total modal
                    updateTotalmodal();
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });

        function generateNomorGrading() {
            const now = new Date();
            // const tahun = now.getFullYear().toString().substr(-2);
            // const bulan = ('0' + (now.getMonth() + 1)).slice(-2);
            // const tanggal = ('0' + now.getDate()).slice(-2);
            const jam = ('0' + now.getHours()).slice(-2);
            const menit = ('0' + now.getMinutes()).slice(-2);
            const detik = ('0' + now.getSeconds()).slice(-2);
            // Mengambil nilai dari input tanggal dan plant
            const tanggal = $('#tgl_add').val();
            const plant = $('#plant').val();
            // Memformat tanggal menjadi ddmmyy
            const formattedTanggal = formatDateToDdmmyy(tanggal);


            // Menggabungkan nilai-nilai tersebut untuk membentuk nomor grading
            const nomor_grading = `NG_${formattedTanggal}-${jam}${menit}${detik}_${plant}_UGK`;

            // Menampilkan hasil di konsol (opsional)
            console.log(nomor_grading);

            return nomor_grading;
        }

        function formatDateToDdmmyy(inputDate) {
            const date = new Date(inputDate);
            const day = ('0' + date.getDate()).slice(-2);
            const month = ('0' + (date.getMonth() + 1)).slice(-2);
            const year = date.getFullYear().toString().substr(-2);

            return `${day}${month}${year}`;
        }

        // Event listener untuk perubahan nilai pada total modal
        $('#modal, #berat').on('input', updateTotalmodal);

        // Fungsi untuk menghitung total modal
        function updateTotalmodal() {
            // Mendapatkan nilai modal dan berat
            const modal = parseFloat($('#modal').val()) || 0;
            const berat = parseFloat($('#berat').val()) || 0;

            // Melakukan perhitungan total modal
            const totalmodal = berat * modal;

            // Memasukkan hasil perhitungan ke dalam input total modal
            $('#total_modal').val(isNaN(totalmodal) ? '' : totalmodal.toFixed(2));
        }



        var dataArray = [];
        var dataStock = [];

        function addRow() {
            // Mengambil nilai dari input
            var nomor_bstb = $('#nomor_bstb').val();
            var nomor_batch = $('#nomor_batch').val();
            var id_box = $('#id_box').val();
            var nama_supplier = $('#nama_supplier').val();
            var jenis = $('#jenis').val();
            var berat_masuk = $('#berat').val();
            var berat = $('#berat').val(); // Perbaikan: Menggunakan berat_keluar
            var kadar_air = $('#kadar_air').val();
            var modal = $('#modal').val();
            var total_modal = $('#total_modal').val();
            var keterangan = $('#keterangan').val();
            var user_created = $('#kadar_air').val();
            var nomor_nota_internal = $('#no_nota').val();

            // Memanggil fungsi generateNomorGrading untuk mendapatkan nomor_grading
            var nomor_grading = generateNomorGrading();


            // Validasi input (sesuai kebutuhan)
            if (!id_box || !nomor_batch) {
                alert('ID and nomor_batch are required.');
                return;
            }

            // Menambahkan data ke dalam tabel
            var newRow = '<tr><td>' + nomor_bstb + '</td><td>' + nomor_batch + '</td><td>' + id_box +
                '</td><td>' + nama_supplier + '</td><td>' + jenis + '</td><td>' +
                berat_masuk + '</td><td>' +
                berat + '</td><td>' + kadar_air + '</td><td id="nomor_grading">' +
                nomor_grading + '</td><td>' + modal + '</td><td>' + total_modal + '</td><td>' + keterangan + '</td><td>' +
                user_created +
                '</td></tr>';

            $('#tableBody').append(newRow);

            // Menambahkan data ke dalam array
            dataArray.push({
                nomor_bstb: nomor_bstb,
                nomor_batch: nomor_batch,
                id_box: id_box,
                nama_supplier: nama_supplier,
                jenis: jenis,
                no_nota: no_nota,
                berat: berat,
                kadar_air: kadar_air,
                nomor_grading: nomor_grading,
                modal: modal,
                total_modal: total_modal,
                keterangan: keterangan,
                user_created: user_created,
                nomor_nota_internal: nomor_nota_internal,
            });
            // Membersihkan nilai input setelah ditambahkan
            $('#id_box').val('');
            $('#nomor_batch').val('');
            $('#nama_supplier').val('');
            $('#jenis').val('');
            $('#berat_masuk').val('');
            $('#berat').val('');
            $('#selisih_berat').val('');
            $('#kadar_air').val('');
            $('#tujuan_kirim').val('');
            $('#letak_tujuan').val('');
            $('#nomor_grading').val('');
            $('#modal').val('');
            $('#total_modal').val('');
            $('#keterangan').val('');
            // Menonaktif kan nilai input ketika ditambah
            // $('#nomor_bstb').prop('readonly', true);
            // $('#nomor_batch').prop('readonly', true);
            // $('#keterangan').prop('readonly', true);
            // $('#user_created').prop('readonly', true);
        }

        function getArray() {
            // Menampilkan array di konsol untuk tujuan debugging
            console.log(dataArray);
        }

        function sendData() {
            console.log(dataArray);
            // Mengirim data ke server menggunakan AJAX
            $.ajax({
                url: `{{ route('GradingKasarInput.sendData') }}`, // Ganti dengan URL endpoint yang sesuai
                method: 'POST',
                data: {
                    data: JSON.stringify(dataArray),
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json', // payload is json,
                success: function(response) {
                    // alert('Success: ' + response.message); // Tampilkan pesan berhasil
                    // window.location.href = response.redirectTo; // Redirect ke halaman lain
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
                        title: 'Error!',
                        text: 'Terjadi kesalahan. Silakan coba lagi.',
                        icon: 'error'
                    });
                    console.log('Validation Errors:', response.responseJSON.errors);
                }
            });

            // Membersihkan array setelah data dikirim
            // dataArray = [];
        }
    </script>
@endsection
