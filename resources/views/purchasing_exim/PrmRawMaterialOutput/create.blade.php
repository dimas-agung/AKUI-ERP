@extends('layouts.master1')
@section('Menu')
    Purchasing & EXIM
@endsection
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
                                        <div class="form-group mandatory">
                                            <label>Nomer Dokument</label>
                                            <input type="text" id="doc_no" class="form-control" name="doc_no"
                                                value="{{ old('doc_no') }}" placeholder="Masukkan Nomer Dokument"
                                                data-parsley-required="true">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>NIP Admin</label>
                                            <input type="text" id="user_created" class="form-control" name="user_created"
                                                value="{{ old('user_created') }}" placeholder="Masukkan User Created"
                                                data-parsley-required="true">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Id Box</label>
                                            <select id="id_box" class="select2 form-select" name="id_box"
                                                removeActiveItemsByValue>
                                                <option value="">Pilih Id Box</option>
                                                @foreach ($PrmRawMS->sortBy('id_box') as $post)
                                                    <option value="{{ $post->id_box }}">
                                                        {{ old('id_box', $post->id_box) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tujuan Kirim</label>
                                            <select id="tujuan_kirim" class="select2 form-select" name="tujuan_kirim"
                                                searchable="true">
                                                <option value="">Pilih Tujuan Kirim</option>
                                                @foreach ($MasTujKir->sortBy('tujuan_kirim') as $post)
                                                    <option value="{{ $post->tujuan_kirim }}">
                                                        {{ old('tujuan_kirim', $post->tujuan_kirim) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Nama Supplier</label>
                                            <input type="text" class="form-control" id="nama_supplier"
                                                name="nama_supplier"
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
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Jenis</label>
                                            <input type="text" class="form-control" id="jenis" name="jenis"
                                                onchange="handleChange(this.{{ old('jenis') }})" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Letak Tujuan</label>
                                            <input type="text" id="letak_tujuan" class="form-control" name="letak_tujuan"
                                                onchange="handleChange(this.{{ old('letak_tujuan') }})" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>No Nota</label>
                                            <input type="text" id="nomor_nota_internal" class="form-control"
                                                name="nomor_nota_internal"
                                                onchange="handleChange(this.{{ old('nomor_nota_internal') }})" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Kadar Air</label>
                                            <input type="text" class="form-control" id="kadar_air" name="kadar_air"
                                                onchange="handleChange(this)" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Inisial Tujuan</label>
                                            <input type="text" id="inisial_tujuan" class="form-control"
                                                name="inisial_tujuan" value="{{ old('inisial_tujuan') }}"
                                                onchange="handleChange(this)" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Modal</label>
                                            <input type="text" id="modal" class="form-control" name="modal"
                                                value="{{ old('modal') }}" onchange="handleChange(this)" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Total Modal</label>
                                            <input type="text" id="total_modal" class="form-control"
                                                name="total_modal" value="{{ old('total_modal') }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Berat Masuk</label>
                                            <input type="text" class="form-control" id="berat_masuk"
                                                name="berat_masuk" onchange="handleChange(this.{{ old('berat_masuk') }})"
                                                readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Berat Keluar</label>
                                            <input type="text" id="berat" pattern="[0-9]*" inputmode="numeric"
                                                onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                                class="form-control" name="berat" value="{{ old('berat') }}"
                                                placeholder="Masukkan berat keluar" data-parsley-required="true">
                                        </div>
                                        <div class="form-group">
                                            <label>Sisa Berat</label>
                                            <input type="text" id="selisih_berat" pattern="[0-9]*"
                                                inputmode="numeric"
                                                onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                                class="form-control" name="selisih_berat"
                                                value="{{ old('selisih_berat') }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <input type="text" id="keterangan_item" class="form-control"
                                            name="keterangan_item" value="{{ old('keterangan_item') }}"
                                            placeholder="Masukkan keterangan">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-primary" onclick="addRow()">Add</button>
                                    <a href="{{ Route('PrmRawMaterialOutput.index') }}" type="button"
                                        class="btn btn-danger" data-dismiss="modal">Close</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>


        <div class="col-md-12">
            <div class="card mt-2">
                <div class="card-header">
                    <div class="card-title">Validasi Data Input</div>
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
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12 mt-2 text-end">
                        <a href="#" class="btn btn-primary" onclick="sendData()">Submit</a>
                    </div>
                </div>
            </div>
        </div>
        </form>
        <div class="me-1 mb-1 d-inline-block">
            <!-- full size modal-->
            <div class="modal fade text-left w-100" id="editModal" tabindex="-1" role="dialog"
                aria-labelledby="myModalLabel20" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-full" role="document"
                    data-parsley-validate>
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel20">Edit Data</h4>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <!-- Formulir pengeditan -->
                        <div class="modal-body">
                            <form id="editForm">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group mandatory">
                                            <label for="doc_no_edit" class="form-label">No Document</label>
                                            <input type="text" class="form-control" id="doc_no_edit"
                                                name="doc_no_edit" data-parsley-required="true" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group mandatory">
                                            <label for="user_created_edit" class="form-label">Nomor Batch</label>
                                            <input type="text" class="form-control" id="user_created_edit"
                                                name="user_created_edit" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group mandatory">
                                            <label class="form-label">nomor_bstb</label>
                                            <input type="text" id="nomor_bstb_edit" class="form-control"
                                                name="nomor_bstb_edit" value="{{ old('nomor_bstb') }}"
                                                placeholder="Masukkan nomor_bstb">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group mandatory">
                                            <label for="id_box_edit" class="form-label">ID Box</label>
                                            <select id="id_box_edit" class="choices form-select" name="id_box_edit">
                                                <option value="">Pilih Id Box</option>
                                                @foreach ($PrmRawMS->sortBy('id_box') as $post)
                                                    <option value="{{ $post->id_box }}">
                                                        {{ old('id_box', $post->id_box) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group mandatory">
                                            <label for="tujuan_kirim_edit" class="form-label">Tujuan Kirim</label>
                                            <select id="tujuan_kirim_edit" class="choices form-select"
                                                name="tujuan_kirim_edit">
                                                <option value="">Pilih Tujuan Kirim</option>
                                                @foreach ($MasTujKir->sortBy('tujuan_kirim') as $post)
                                                    <option value="{{ $post->tujuan_kirim }}">
                                                        {{ old('tujuan_kirim', $post->tujuan_kirim) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Nama Supplier</label>
                                            <input type="text" class="form-control" id="nama_supplier_edit"
                                                name="nama_supplier_edit" onchange="handleChange(this)" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Nomor Batch</label>
                                            <input type="text" class="form-control" id="nomor_batch_edit"
                                                name="nomor_batch_edit" onchange="handleChange(this)" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Jenis</label>
                                            <input type="text" class="form-control" id="jenis_edit" name="jenis_edit"
                                                onchange="handleChange(this)" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Letak Tujuan</label>
                                            <input type="text" id="letak_tujuan_edit" class="form-control"
                                                name="letak_tujuan_edit" onchange="handleChange(this)" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>No Nota</label>
                                            <input type="text" id="nomor_nota_internal_edit" class="form-control"
                                                name="nomor_nota_internal_edit" onchange="handleChange(this)" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Kadar Air</label>
                                            <input type="text" class="form-control" id="kadar_air_edit"
                                                name="kadar_air_edit" onchange="handleChange(this)" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Inisial Tujuan</label>
                                            <input type="text" id="inisial_tujuan_edit" class="form-control"
                                                name="inisial_tujuan_edit" onchange="handleChange(this)" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Modal</label>
                                            <input type="text" id="modal_edit" class="form-control" name="modal_edit"
                                                onchange="handleChange(this)" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Total Modal</label>
                                            <input type="text" id="total_modal_edit" class="form-control"
                                                name="total_modal_edit" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Berat Masuk</label>
                                            <input type="text" class="form-control" id="berat_masuk_edit"
                                                name="berat_masuk_edit" onchange="handleChange(this)" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label>Berat Keluar</label>
                                            <input type="text" id="berat_edit" pattern="[0-9]*" inputmode="numeric"
                                                onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                                class="form-control" name="berat_edit"
                                                placeholder="Masukkan berat keluar">
                                        </div>
                                        <div class="form-group">
                                            <label>Sisa Berat</label>
                                            <input type="text" id="selisih_berat_edit" pattern="[0-9]*"
                                                inputmode="numeric"
                                                onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                                class="form-control" name="selisih_berat_edit" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <label>Keterangan</label>
                                    <input type="text" id="keterangan_item_edit" class="form-control"
                                        name="keterangan_item_edit" value="{{ old('keterangan_item') }}"
                                        placeholder="Masukkan keterangan">
                                </div>
                                <!-- Tambahkan kolom formulir pengeditan sesuai kebutuhan -->
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Close</span>
                            </button>
                            <button type="button" class="btn btn-primary ms-1" data-bs-dismiss="modal"
                                id="editSaveButton">
                                <i class="bx bx-check d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Accept</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        // $(document).ready(function() {
        //     $('.select2').select2();
        // });

        function handleChange(input) {
            // Hapus atribut readonly
            input.removeAttribute('readonly');
        }
        // Gunakan koma untuk memisahkan multiple selectors pada event handler
        $('#id_box, #id_box_edit').on('change', function() {
            // Mengambil nilai id_box yang dipilih
            let selectedIdBox = $(this).val();
            // Melakukan permintaan AJAX ke controller untuk mendapatkan nomor batch
            $.ajax({
                url: '{{ route('PrmRawMaterialOutput.set') }}',
                method: 'GET',
                data: {
                    id_box: selectedIdBox
                },
                success: function(response) {
                    if (response.sisa_berat > 0) {
                        console.log(response);
                        // Mengatur nilai Nomor Batch sesuai dengan respons dari server
                        $('#nomor_batch').val(response.nomor_batch);
                        $('#nama_supplier').val(response.nama_supplier);
                        $('#jenis').val(response.jenis);
                        $('#kadar_air').val(response.avg_kadar_air);
                        $('#berat_masuk').val(response.berat_masuk);
                        $('#modal').val(response.modal);
                        $('#nomor_nota_internal').val(response.nomor_nota_internal);

                        // Panggil fungsi handleChange untuk menghapus atribut readonly
                        handleChange(document.getElementById('nomor_batch_edit'));
                        handleChange(document.getElementById('nama_supplier_edit'));
                        handleChange(document.getElementById('jenis_edit'))
                        handleChange(document.getElementById('kadar_air_edit'))
                        handleChange(document.getElementById('berat_masuk_edit'))
                        handleChange(document.getElementById('modal_edit'))
                        handleChange(document.getElementById('nomor_nota_internal_edit'))

                        $('#nomor_batch_edit').val(response.nomor_batch);
                        $('#nama_supplier_edit').val(response.nama_supplier);
                        $('#jenis_edit').val(response.jenis);
                        $('#kadar_air_edit').val(response.avg_kadar_air);
                        $('#berat_masuk_edit').val(response.berat_masuk);
                        $('#modal_edit').val(response.modal);
                        $('#nomor_nota_internal_edit').val(response.nomor_nota_internal);
                    } else {
                        // Berat 0, mencegah pemilihan dan memberikan pesan kepada pengguna
                        Swal.fire({
                            title: 'Warning!',
                            text: 'Berat ID Box tidak boleh 0. Pilih ID Box lain.',
                            icon: 'warning'
                        });
                        // Reset nilai dropdown ke default atau sesuaikan dengan kebutuhan Anda
                        $('#nomor_bstb').val('');
                    }
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });

        $('#tujuan_kirim').on('change', function() {
            // Mengambil nilai id_box yang dipilih
            let selectedPcc = $(this).val();

            // Melakukan permintaan AJAX ke controller untuk mendapatkan data
            $.ajax({
                url: '{{ route('PrmRawMaterialOutput.setpcc') }}',
                method: 'GET',
                data: {
                    tujuan_kirim: selectedPcc
                },
                success: function(response) {
                    if (response.status > 0) {
                        // Mengatur nilai elemen-elemen sesuai dengan respons dari server
                        $('#letak_tujuan').val(response.letak_tujuan);
                        $('#inisial_tujuan').val(response.inisial_tujuan);

                        // Panggil fungsi handleChange untuk menghapus atribut readonly
                        handleChange(document.getElementById('letak_tujuan_edit'));
                        handleChange(document.getElementById('inisial_tujuan_edit'));

                        $('#letak_tujuan_edit').val(response.letak_tujuan);
                        $('#inisial_tujuan_edit').val(response.inisial_tujuan);
                    } else {
                        // Berat 0, mencegah pemilihan dan memberikan pesan kepada pengguna
                        // alert("Berat tidak boleh 0. Pilih nomor_bstb lain.");
                        Swal.fire({
                            title: 'Warning!',
                            text: 'Tujuan Kirim tidak boleh tidak aktif. Pilih Tujuan Kirim lain.',
                            icon: 'warning'
                        });
                        // Reset nilai dropdown ke default atau sesuaikan dengan kebutuhan Anda
                        $('#nomor_bstb').val('');
                    }
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });

        // Fungsi generateNomorBSTB (letakkan di sini atau muat dari file eksternal)
        function generateNomorBSTB(inisial_tujuan) {
            const inisialTujuan = document.getElementById('inisial_tujuan').value;
            const now = new Date();
            const tahun = now.getFullYear().toString().substr(-2);
            const bulan = ('0' + (now.getMonth() + 1)).slice(-2);
            const tanggal = ('0' + now.getDate()).slice(-2);
            const jam = ('0' + now.getHours()).slice(-2);
            const menit = ('0' + now.getMinutes()).slice(-2);
            const detik = ('0' + now.getSeconds()).slice(-2);

            const nomor_bstb = `BSTB_PNE_${tanggal}${bulan}${tahun}-${jam}${menit}${detik}_${inisial_tujuan}`;

            // Menampilkan hasil ke dalam elemen HTML dengan ID 'hasil_nomor_bstb'
            // $('#hasil_nomor_bstb').text(nomor_bstb);
            return nomor_bstb;
            console.log(nomor_bstb);
        }

        // Event listener untuk perubahan nilai pada total modal
        $('#modal').on('input', updateTotalmodal);
        $('#berat').on('input', updateTotalmodal);
        $('#modal_edit').on('input', updateTotalmodal);
        $('#berat_edit').on('input', updateTotalmodal);

        function updateTotalmodal() {
            // Mendapatkan nilai berat nota dan berat bersih
            const modal = parseFloat($('#modal').val());
            const berat = parseFloat($('#berat').val());
            const modal_e = parseFloat($('#modal_edit').val());
            const berat_e = parseFloat($('#berat_edit').val());

            // Melakukan perhitungan selisih berat
            const totalmodal = berat * modal;
            const totalmodale = berat_e * modal_e;

            // Memasukkan hasil perhitungan ke dalam input selisih berat
            $('#total_modal').val(isNaN(totalmodal) ? '' : totalmodal);
            $('#total_modal_edit').val(isNaN(totalmodale) ? '' : totalmodale);
        }

        // Event listener untuk perubahan nilai pada berat nota atau berat bersih
        $('#berat_masuk').on('change', updateSelisihBerat);
        $('#berat').on('input', updateSelisihBerat);
        $('#berat_masuk_edit').on('change', updateSelisihBerat);
        $('#berat_edit').on('input', updateSelisihBerat);

        function updateSelisihBerat() {
            // Mendapatkan nilai berat nota dan berat bersih
            const berat_masuk = parseFloat($('#berat_masuk').val());
            const berat_masuk_edit = parseFloat($('#berat_masuk_edit').val());
            const berat = parseFloat($('#berat').val());
            const berat_edit = parseFloat($('#berat_edit').val());
            const selisihBerat = berat_masuk - berat;
            const selisihBerate = berat_masuk_edit - berat_edit;

            // Memasukkan hasil perhitungan ke dalam input selisih berat
            $('#selisih_berat').val(isNaN(selisihBerat) ? '' : selisihBerat);
            $('#selisih_berat_edit').val(isNaN(selisihBerate) ? '' : selisihBerate);
        }

        // Variabel global untuk menyimpan indeks baris terakhir
        var currentRowIndex = 0;
        var dataArray = [];
        var dataStock = [];

        function addRow() {
            // Mengambil nilai dari input
            var doc_no = $('#doc_no').val();
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
            var keterangan_item = $('#keterangan_item').val();
            var user_created = $('#user_created').val();
            var nomor_nota_internal = $('#nomor_nota_internal').val();


            // Inisialisasi array untuk menyimpan field yang belum terisi
            let fieldsNotFilled = [];
            // Periksa setiap field
            if (!id_box) fieldsNotFilled.push('ID Box');
            if (!nama_supplier) fieldsNotFilled.push('Nama Supllier');
            if (!tujuan_kirim) fieldsNotFilled.push('Tujuan Kirim');
            if (!letak_tujuan) fieldsNotFilled.push('Inisial Kirim');
            if (!user_created) fieldsNotFilled.push('NIP Admin');
            if (!berat || berat <= 0) fieldsNotFilled.push('Berat Keluar');

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

            // Memanggil fungsi generateNomorBSTB untuk mendapatkan nomor_bstb
            var nomor_bstb = generateNomorBSTB(inisial_tujuan);

            var newRow = '<tr>' +
                '<td>' + doc_no + '</td>' +
                '<td>' + nomor_bstb + '</td>' +
                '<td>' + nomor_batch + '</td>' +
                '<td>' + id_box + '</td>' +
                '<td>' + nama_supplier + '</td>' +
                '<td>' + jenis + '</td>' +
                '<td>' + berat_masuk + '</td>' +
                '<td>' + berat + '</td>' +
                '<td>' + selisih_berat + '</td>' +
                '<td>' + kadar_air + '</td>' +
                '<td>' + tujuan_kirim + '</td>' +
                '<td>' + letak_tujuan + '</td>' +
                '<td>' + inisial_tujuan + '</td>' +
                '<td>' + modal + '</td>' +
                '<td>' + total_modal + '</td>' +
                '<td>' + keterangan_item + '</td>' +
                '<td>' + user_created + '</td>' +
                '<td><button onclick="editRow(' + currentRowIndex +
                ')" class="btn btn-warning" data-toggle="modal" data-target="#editModal">Edit</button></td>' +
                '<td><button class="btn btn-danger" onclick="hapusBaris(this)">Delete</button></td>' +
                '</tr>';

            $('#tableBody').append(newRow);

            // Menambahkan data ke dalam array
            // dataArrayDocNo.push(doc_no)
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
                nomor_nota_internal: nomor_nota_internal,
            });
            // Membersihkan nilai input setelah ditambahkan
            $('#id_box').val('');
            $('#tujuan_kirim').val('');
            $('#nomor_batch').val('');
            $('#nama_supplier').val('');
            $('#jenis').val('');
            $('#berat_masuk').val('');
            $('#berat').val('');
            $('#selisih_berat').val('');
            $('#kadar_air').val('');
            $('#tujuan_kirim').val($('#tujuan_kirim option:first').val());
            $('#nomor_nota_internal').val('');
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

            // Update indeks baris terakhir
            currentRowIndex++;
        }

        // Tambahkan fungsi editRow di luar dari addRow
        function editRow(rowIndex) {
            // Dapatkan referensi ke formulir pengeditan (misalnya, modal edit)
            var editModal = $('#editModal');

            // Ambil nilai dari dataArray[rowIndex]
            var editedData = dataArray[rowIndex];

            // Setel nilai-nilai ke dalam elemen formulir pengeditan
            editModal.find('#id_box_edit').val(editedData.id_box);
            editModal.find('#nomor_bstb_edit').val(editedData.nomor_bstb);
            editModal.find('#nomor_batch_edit').val(editedData.nomor_batch);
            editModal.find('#nama_supplier_edit').val(editedData.nama_supplier);
            editModal.find('#doc_no_edit').val(editedData.doc_no);
            editModal.find('#jenis_edit').val(editedData.jenis);
            editModal.find('#berat_masuk_edit').val(editedData.berat_masuk);
            editModal.find('#berat_edit').val(editedData.berat);
            editModal.find('#selisih_berat_edit').val(editedData.selisih_berat);
            editModal.find('#kadar_air_edit').val(editedData.kadar_air);
            editModal.find('#tujuan_kirim_edit').val(editedData.tujuan_kirim);
            editModal.find('#letak_tujuan_edit').val(editedData.letak_tujuan);
            editModal.find('#inisial_tujuan_edit').val(editedData.inisial_tujuan);
            editModal.find('#modal_edit').val(editedData.modal);
            editModal.find('#total_modal_edit').val(editedData.total_modal);
            editModal.find('#keterangan_item_edit').val(editedData.keterangan_item);
            editModal.find('#user_created_edit').val(editedData.user_created);
            editModal.find('#nomor_nota_internal_edit').val(editedData.nomor_nota_internal);

            // Tambahkan atribut data-index ke tombol "Simpan" pada formulir pengeditan
            editModal.find('#editSaveButton').attr('data-index', rowIndex);

            // Tampilkan formulir pengeditan
            editModal.modal('show');
        }

        // Tambahkan fungsi untuk menangani perubahan di formulir pengeditan dan memperbarui dataArray
        $('#editSaveButton').on('click', function() {
            // Dapatkan data yang diubah dari formulir pengeditan
            var editedData = {
                id_box: $('#id_box_edit').val(),
                nomor_bstb: $('#nomor_bstb_edit').val(),
                nomor_batch: $('#nomor_batch_edit').val(),
                nama_supplier: $('#nama_supplier_edit').val(),
                doc_no: $('#doc_no_edit').val(),
                jenis: $('#jenis_edit').val(),
                berat_masuk: $('#berat_masuk_edit').val(),
                berat: $('#berat_edit').val(),
                selisih_berat: $('#selisih_berat_edit').val(),
                kadar_air: $('#kadar_air_edit').val(),
                tujuan_kirim: $('#tujuan_kirim_edit').val(),
                letak_tujuan: $('#letak_tujuan_edit').val(),
                inisial_tujuan: $('#inisial_tujuan_edit').val(),
                modal: $('#modal_edit').val(),
                total_modal: $('#total_modal_edit').val(),
                keterangan_item: $('#keterangan_item_edit').val(),
                user_created: $('#user_created_edit').val(),
                nomor_nota_internal: $('#nomor_nota_internal_edit').val(),
            };

            // // Validasi data sebelum menyimpan
            if (!validateEditedData(editedData)) {
                // Tampilkan pesan kesalahan atau lakukan tindakan yang sesuai
                return;
            }

            // Dapatkan indeks baris yang akan diperbarui dari atribut data-index
            var rowIndex = $(this).attr('data-index');

            // Perbarui dataArray dengan data yang diubah
            dataArray[rowIndex] = editedData;

            // Sembunyikan formulir pengeditan
            $('#editModal').modal('hide');

            // Perbarui tampilan tabel
            updateTable();
        });

        function validateEditedData(data) {
            // Validasi kolom yang diperlukan
            if (!data.id_box || !data.nomor_bstb || !data.nomor_batch || !data.nama_supplier || !data.jenis ||
                !data.berat_masuk || !data.berat || !data.selisih_berat || !data.kadar_air || !data.tujuan_kirim ||
                !data.letak_tujuan || !data.inisial_tujuan || !data.modal || !data.total_modal || !data.keterangan_item ||
                !data.user_created || !data.nomor_nota_internal) {
                // Tampilkan pesan kesalahan atau lakukan tindakan yang sesuai
                Swal.fire({
                    title: 'Warning!',
                    text: 'Semua kolom harus diisi.',
                    icon: 'warning'
                });
                return;
            }

            // Lakukan validasi lainnya sesuai kebutuhan
            return true; // Kembalikan true jika data valid
        }


        // Tambahkan fungsi untuk memperbarui tampilan tabel
        function updateTable() {
            // Hapus semua baris dari tabel
            $('#tableBody').empty();

            // Tambahkan kembali semua data dari dataArray ke dalam tabel
            for (var i = 0; i < dataArray.length; i++) {
                var rowData = dataArray[i];
                var newRow = '<tr><td>' + rowData.doc_no + '</td><td>' + rowData.nomor_bstb + '</td><td>' + rowData
                    .nomor_batch + '</td><td>' +
                    rowData.id_box + '</td><td>' + rowData.nama_supplier + '</td><td>' + rowData.jenis + '</td><td>' +
                    rowData.berat_masuk +
                    '</td><td>' + rowData.berat + '</td><td>' + rowData.selisih_berat + '</td><td>' + rowData.kadar_air +
                    '</td><td>' +
                    rowData.tujuan_kirim + '</td><td>' + rowData.letak_tujuan + '</td><td>' + rowData.inisial_tujuan +
                    '</td><td>' +
                    rowData.modal + '</td><td>' + rowData.total_modal + '</td><td>' + rowData.keterangan_item +
                    '</td><td>' +
                    rowData.user_created + '</td><td><button onclick="editRow(' + i +
                    ')" class="btn btn-warning" data-toggle="modal" data-target="#editModal">Edit</button></td>' +
                    '<td><button class="btn btn-danger" onclick="hapusBaris(this)">Delete</button></td></tr>';

                $('#tableBody').append(newRow);
            }
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


        function getArray() {
            // Menampilkan array di konsol untuk tujuan debugging
            console.log(dataArray);
        }

        function sendData() {
            var i = 0;
            console.log(dataArray);
            // Mengirim data ke server menggunakan AJAX
            $.ajax({
                url: `{{ route('PrmRawMaterialOutput.sendData') }}`, // Ganti dengan URL endpoint yang sesuai
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
                    data: JSON.stringify(dataArray),
                    dataStock: JSON.stringify(dataStock),
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json', // payload is json,
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
                        text: 'Terjadi kesalahan. Silakan coba lagi.',
                        icon: 'error'
                    });
                    console.log('Validation Errors:', response.responseJSON.errors);
                }
            });
        }
    </script>
@endsection
