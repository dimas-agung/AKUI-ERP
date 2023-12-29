@extends('layouts.master2')
@section('title')
    Input Data PRM Raw Material Output
@endsection
@section('content')
    <div class="container">
        <div class="card mt-2">
            <form action="{{ route('PrmRawMaterialOutput.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-0 shadow-sm rounded">
                            <div class="card-header">
                                <h4>Input Data Prm Raw Material Output Header</h4>
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
                                    <div class="col-md-6 pr-0">
                                        <div class="form-group">
                                            <label>Nomer Dokument</label>
                                            <input type="text" id="doc_no" class="form-control" name="doc_no"
                                                value="{{ old('doc_no') }}" placeholder="Masukkan Nomer Dokument">
                                        </div>
                                        <div class="form-group">
                                            <label>Nomor BTSB</label>
                                            <input type="text" id="nomor_bstb" class="form-control" name="nomor_bstb"
                                                value="{{ old('nomor_bstb') }}" placeholder="Masukkan nomor_bstb">
                                        </div>
                                    </div>
                                    <div class="col-md-6 pr-0">
                                        <div class="form-group">
                                            <label>NIP Admin</label>
                                            <input type="text" id="user_created" class="form-control" name="user_created"
                                                value="{{ old('user_created') }}" placeholder="Masukkan User Created">
                                        </div>
                                        <div class="form-group">
                                            <label>User Updated</label>
                                            <input type="text" id="user_updated" class="form-control" name="user_updated"
                                                value="{{ old('user_updated') }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="text-center">Keterangan</label>
                                            <input type="text" id="keterangan" class="form-control" name="keterangan"
                                                value="{{ old('keterangan') }}" placeholder="Masukkan keterangan">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-0 shadow-sm rounded">
                            <div class="card-header">
                                <h4>Input Data Prm Raw Material Output Item</h4>
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
                                    <div class="col-md-4 pr-0">
                                        <div class="form-group">
                                            <label>Id Box</label>
                                            <select id="id_box" class="form-control select2 select2-hidden-accessible"
                                                style="width: 100%;" tabindex="-1" aria-hidden="true" name="id_box"
                                                data-placeholder="Pilih Id Box">
                                                <option></option>
                                                @foreach ($PrmRawMS as $post)
                                                    <option value="{{ $post->id_box }}">
                                                        {{ old('id_box', $post->id_box) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Nomor Batch</label>
                                            <input type="text" class="form-control" id="nomor_batch" name="nomor_batch"
                                                onchange="handleChange(this.{{ old('nomor_batch') }})" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4 pr-0">
                                        <div class="form-group">
                                            <label>Nama Supplier</label>
                                            <input type="text" class="form-control" id="nama_supplier"
                                                name="nama_supplier"
                                                onchange="handleChange(this.{{ old('nama_supplier') }})" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Jenis</label>
                                            <input type="text" class="form-control" id="jenis" name="jenis"
                                                onchange="handleChange(this.{{ old('jenis') }})" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4 pr-0">
                                        <div class="form-group">
                                            <label>Kadar Air</label>
                                            <input type="text" class="form-control" id="kadar_air" name="kadar_air"
                                                onchange="handleChange(this.{{ old('kadar_air') }})" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Berat Masuk</label>
                                            <input type="text" class="form-control" id="berat_masuk" name="berat_masuk"
                                                onchange="handleChange(this.{{ old('berat_masuk') }})" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tujuan Kirim</label>
                                            <select id="tujuan_kirim"
                                                class="form-control select2 select2-hidden-accessible"
                                                style="width: 100%;" tabindex="-1" aria-hidden="true"
                                                name="tujuan_kirim" data-placeholder="Pilih Tujuan Kirim">
                                                <option></option>
                                                @foreach ($MasTujKir as $post)
                                                    <option value="{{ $post->tujuan_kirim }}">
                                                        {{ old('tujuan_kirim', $post->tujuan_kirim) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Letak Tujuan</label>
                                            <input type="text" id="letak_tujuan" class="form-control"
                                                name="letak_tujuan"
                                                onchange="handleChange(this.{{ old('letak_tujuan') }})" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Inisial Tujuan</label>
                                            <input type="text" id="inisial_tujuan" class="form-control"
                                                name="inisial_tujuan"
                                                onchange="handleChange(this.{{ old('inisial_tujuan') }})" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <input type="text" id="keterangan_item" class="form-control"
                                                name="keterangan_item" value="{{ old('keterangan_item') }}"
                                                placeholder="Masukkan keterangan">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Berat Keluar</label>
                                            <input type="text" id="berat" pattern="[0-9]*" inputmode="numeric"
                                                onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                                class="form-control" name="berat" value="{{ old('berat') }}"
                                                placeholder="Masukkan berat keluar">
                                        </div>
                                        <div class="form-group">
                                            <label>Sisa Berat</label>
                                            <input type="text" id="selisih_berat" pattern="[0-9]*"
                                                inputmode="numeric"
                                                onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                                class="form-control" name="selisih_berat"
                                                value="{{ old('selisih_berat') }}"
                                                placeholder="Masukkan berat keluar terlebih dahulu" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Modal</label>
                                            <input type="text" id="modal" class="form-control" name="modal"
                                                value="{{ old('modal') }}" placeholder="Masukkan modal">
                                        </div>
                                        <div class="form-group">
                                            <label>Total Modal</label>
                                            <input type="text" id="total_modal" class="form-control"
                                                name="total_modal" value="{{ old('total_modal') }}"
                                                placeholder="Masukkan total modal">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-primary" onclick="addRow()">Add</button>
                                        <a href="{{ url('/PrmRawMaterialOutput') }}" type="button"
                                            class="btn btn-danger" data-dismiss="modal">Close</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        {{-- <div class="card"> --}}
                        <div class="card-header">
                            <div class="card-title">Validasi Data Input</div>
                        </div>
                        <div class="card-body" style="overflow: scroll" content="{{ csrf_token() }}">
                            <table class="table table-striped mt-3">
                                <thead>
                                    <tr>
                                        <th class="text-center">No Document</th>
                                        <th class="text-center">No BSTB</th>
                                        <th class="text-center">Nomor Batch</th>
                                        <th class="text-center">ID</th>
                                        <th class="text-center">Nama Supplier</th>
                                        <th class="text-center">Jenis</th>
                                        <th class="text-center">Berat Masuk</th>
                                        <th class="text-center">Berat</th>
                                        <th class="text-center">Berat sisa</th>
                                        <th class="text-center">Kadar Air</th>
                                        <th class="text-center">Tujuan Kirim</th>
                                        <th class="text-center">Letak Tujuan</th>
                                        <th class="text-center">Inisial Tujuan</th>
                                        <th class="text-center">Modal</th>
                                        <th class="text-center">Total Modal</th>
                                        <th class="text-center">Keterangan</th>
                                        <th class="text-center">NIP Admin</th>
                                        <th class="text-center">User Update</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                </tbody>
                            </table>
                            <a href="#" class="btn btn-primary" onclick="sendData()">Submit</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
        $('#id_box').on('change', function() {
            // Mengambil nilai id_box yang dipilih
            let selectedIdBox = $(this).val();
            // Melakukan permintaan AJAX ke controller untuk mendapatkan nomor batch
            $.ajax({
                url: `{{ route('PrmRawMaterialOutput.set') }}`,
                method: 'GET',
                data: {
                    id_box: selectedIdBox
                },
                success: function(response) {
                    console.log(response);
                    // Mengatur nilai Nomor Batch sesuai dengan respons dari server
                    $('#nomor_batch').val(response.nomor_batch);
                    $('#nama_supplier').val(response.nama_supplier);
                    $('#jenis').val(response.jenis);
                    $('#kadar_air').val(response.avg_kadar_air);
                    $('#berat_masuk').val(response.berat_masuk);
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });

        $('#tujuan_kirim').on('change', function() {
            // Mengambil nilai id_box yang dipilih
            let selectedPcc = $(this).val();
            // Melakukan permintaan AJAX ke controller untuk mendapatkan nomor batch
            $.ajax({
                url: `{{ route('PrmRawMaterialOutput.setpcc') }}`,
                method: 'GET',
                data: {
                    tujuan_kirim: selectedPcc
                },
                success: function(response) {
                    console.log(response);
                    // Mengatur nilai Nomor Batch sesuai dengan respons dari server
                    $('#letak_tujuan').val(response.letak_tujuan);
                    $('#inisial_tujuan').val(response.inisial_tujuan);
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });

        // Event listener untuk perubahan nilai pada berat nota atau berat bersih
        $('#berat_masuk').on('change', updateSelisihBerat);
        $('#berat').on('input', updateSelisihBerat);

        function updateSelisihBerat() {
            // Mendapatkan nilai berat nota dan berat bersih
            const berat_masuk = parseFloat($('#berat_masuk').val());
            const berat = parseFloat($('#berat').val());

            // Melakukan perhitungan selisih berat
            const selisihBerat = berat_masuk - berat;

            // Memasukkan hasil perhitungan ke dalam input selisih berat
            $('#selisih_berat').val(isNaN(selisihBerat) ? '' : selisihBerat);
        }


        var dataArray = [];
        var dataStock = [];
        var dataHeader = [];

        function addRow() {
            console.log(dataArray);
            // Mengambil nilai dari input
            var doc_no = $('#doc_no').val();
            var nomor_bstb = $('#nomor_bstb').val();
            var nomor_batch = $('#nomor_batch').val();
            var id_box = $('#id_box').val();
            var nama_supplier = $('#nama_supplier').val();
            var jenis = $('#jenis').val();
            var berat_masuk = $('#berat_masuk').val();
            var berat = $('#berat').val();
            var selisih_berat = $('#selisih_berat').val();
            var kadar_air = $('#kadar_air').val();
            var tujuan_kirim = $('#tujuan_kirim').val();
            var letak_tujuan = $('#letak_tujuan').val();
            var inisial_tujuan = $('#inisial_tujuan').val();
            var modal = $('#modal').val();
            var total_modal = $('#total_modal').val();
            var keterangan = $('#keterangan').val();
            var keterangan_item = $('#keterangan_item').val();
            var user_created = $('#user_created').val();
            var user_updated = $('#user_updated').val();
            // Validasi input (sesuai kebutuhan)
            if (!id_box || !nomor_batch) {
                alert('ID and nomor_batch are required.');
                return;
            }
            // Menambahkan data ke dalam tabel
            var newRow = '<tr><td>' + doc_no + '</td><td>' + nomor_bstb + '</td><td>' + nomor_batch + '</td><td>' + id_box +
                '</td><td>' + nama_supplier + '</td><td>' + jenis + '</td><td>' + berat_masuk + '</td><td>' +
                berat + '</td><td>' + selisih_berat + '</td><td>' + kadar_air + '</td><td>' + tujuan_kirim + '</td><td>' +
                letak_tujuan + '</td><td>' + inisial_tujuan + '</td><td>' +
                modal + '</td><td>' + total_modal + '</td><td>' + keterangan_item + '</td><td>' + user_created +
                '</td><td>' + user_updated + '</td></tr>';
            $('#tableBody').append(newRow);

            // Menambahkan data ke dalam array
            dataArray.push({
                doc_no: doc_no,
                nomor_bstb: nomor_bstb,
                nomor_batch: nomor_batch,
                id_box: id_box,
                nama_supplier: nama_supplier,
                jenis: jenis,
                berat_masuk: berat_masuk,
                berat: berat,
                selisih_berat: selisih_berat,
                kadar_air: kadar_air,
                tujuan_kirim: tujuan_kirim,
                letak_tujuan: letak_tujuan,
                inisial_tujuan: inisial_tujuan,
                modal: modal,
                total_modal: total_modal,
                keterangan_item: keterangan_item,
                user_created: user_created,
                user_updated: user_updated
            });
            dataStock = [];
            dataStock.push({
                id_box: id_box,
                nomor_batch: nomor_batch,
                nama_supplier: nama_supplier,
                jenis: jenis,
                berat_masuk: berat_masuk,
                berat: berat,
                selisih_berat: selisih_berat,
                kadar_air: kadar_air,
                tujuan_kirim: tujuan_kirim,
                letak_tujuan: letak_tujuan,
                inisial_tujuan: inisial_tujuan,
                modal: modal,
                total_modal: total_modal,
                keterangan_item: keterangan_item,
                user_created: user_created,
                user_updated: user_updated
            });
            console.log(dataStock);
            dataHeader = [];
            dataHeader.push({
                doc_no: doc_no,
                nomor_bstb: nomor_bstb,
                nomor_batch: nomor_batch,
                keterangan: keterangan,
                user_created: user_created,
                user_updated: user_updated
            });
            // Membersihkan nilai input setelah ditambahkan
            $('#id_box').val('<option></option>');
            $('#nomor_batch').val('');
            $('#nama_supplier').val('');
            $('#jenis').val('');
            $('#berat_masuk').val('');
            $('#berat').val('');
            $('#selisih_berat').val('');
            $('#kadar_air').val('');
            $('#tujuan_kirim').val('');
            $('#letak_tujuan').val('');
            $('#inisial_tujuan').val('');
            $('#modal').val('');
            $('#total_modal').val('');
            $('#keterangan_item').val('');
            // Menonaktif kan nilai input ketika ditambah
            $('#doc_no').prop('readonly', true);
            $('#nomor_bstb').prop('readonly', true);
            $('#nomor_batch').prop('readonly', true);
            $('#keterangan').prop('readonly', true);
            $('#user_created').prop('readonly', true);
        }

        function getArray() {
            // Menampilkan array di konsol untuk tujuan debugging
            console.log(dataArray);
        }

        function sendData() {
            console.log(dataArray);
            // Mengirim data ke server menggunakan AJAX
            $.ajax({
                url: `{{ route('PrmRawMaterialOutput.sendData') }}`, // Ganti dengan URL endpoint yang sesuai
                method: 'POST',
                data: {
                    data: JSON.stringify(dataArray),
                    // dataStock: JSON.stringify(dataStock),
                    dataHeader: JSON.stringify(dataHeader),
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json', // payload is json,
                success: function(response) {
                    alert('Success: ' + response.message); // Tampilkan pesan berhasil
                    window.location.href = response.redirectTo; // Redirect ke halaman lain
                },
                error: function(error) {
                    console.error('Error:', response);
                    console.log('Validation Errors:', response.responseJSON.errors);
                }
            });

            // Membersihkan array setelah data dikirim
            // dataArray = [];
        }
    </script>
@endsection
