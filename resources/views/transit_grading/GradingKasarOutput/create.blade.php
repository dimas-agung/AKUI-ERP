@extends('layouts.master1')
@section('Menu')
    Transit Grading Kasar
@endsection
@section('title')
    Input Data Grading Kasar Output
@endsection
@section('content')
    <div class="container">
        <div class="card mt-2">
            <form action="{{ route('GradingKasarOutput.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-0 shadow-sm rounded">
                            <div class="card-header">
                                <h4>Input Data Grading Kasar Output</h4>
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
                                            <label>Nomer BSTB</label>
                                            <input type="text" id="nomor_bstb" class="form-control" name="nomor_bstb"
                                                value="{{ old('nomor_bstb') }}" placeholder="Masukkan Nomer BSTB">
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
                                            <label>Nomor Job</label>
                                            <input type="text" class="form-control" id="nomor_job" name="nomor_job"
                                                value="{{ old('nomor_job') }}" placeholder="Masukkan Nomor Job">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>ID Box Grading Kasar</label>
                                            <select id="id_box_grading_kasar" class="choices form-select"
                                                name="id_box_grading_kasar">
                                                <option value="">Pilih ID Box Grading Kasar</option>
                                                @foreach ($GradingKS as $post)
                                                    <option value="{{ $post->id_box_grading_kasar }}">
                                                        {{ old('id_box_grading_kasar', $post->id_box_grading_kasar) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tujuan Kirim</label>
                                            <select id="tujuan_kirim" class="choices form-select" name="tujuan_kirim">
                                                <option value="">Pilih Tujuan Kirim</option>
                                                @foreach ($MasTujKir as $post)
                                                    <option value="{{ $post->tujuan_kirim }}">
                                                        {{ old('tujuan_kirim', $post->tujuan_kirim) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
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
                                            <label>ID Box Raw Material</label>
                                            <input type="text" class="form-control" id="id_box_raw_material"
                                                name="id_box_raw_material"
                                                onchange="handleChange(this.{{ old('id_box_raw_material') }})" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Jenis Raw Material</label>
                                            <input type="text" class="form-control" id="jenis_raw_material"
                                                name="jenis_raw_material"
                                                onchange="handleChange(this.{{ old('jenis_raw_material') }})" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Jenis Grading</label>
                                            <input type="text" class="form-control" id="jenis_grading"
                                                name="jenis_grading"
                                                onchange="handleChange(this.{{ old('jenis_grading') }})" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Nomor Grading</label>
                                            <input type="text" id="nomor_grading" class="form-control"
                                                name="nomor_grading" value="{{ old('nomor_grading') }}"
                                                onchange="handleChange(this)" readonly>
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
                                            <label>AVG Kadar Air</label>
                                            <input type="text" class="form-control" id="avg_kadar_air"
                                                name="avg_kadar_air"
                                                onchange="handleChange(this.{{ old('avg_kadar_air') }})" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Modal</label>
                                            <input type="text" id="modal" class="form-control" name="modal"
                                                value="{{ old('modal') }}" onchange="handleChange(this)" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Berat Keluar</label>
                                            <input type="text" id="berat_keluar" class="form-control"
                                                name="berat_keluar" placeholder="Masukkan berat_keluar">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>PCS Keluar</label>
                                            <input type="text" id="pcs_keluar" class="form-control" name="pcs_keluar"
                                                placeholder="Masukkan pcs_keluar">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Total Modal</label>
                                            <input type="text" id="total_modal" class="form-control"
                                                name="total_modal" placeholder="Masukkan total_modal" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Biaya Produksi</label>
                                            <input type="text" class="form-control" id="biaya_produksi"
                                                name="biaya_produksi" placeholder="Masukkan Biaya Produksi">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Fix Total Modal</label>
                                            <input type="text" class="form-control" id="fix_total_modal"
                                                name="fix_total_modal" onchange="handleChange(this)" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Keterangan</label>
                                        <input type="text" id="keterangan" class="form-control" name="keterangan"
                                            placeholder="Masukkan keterangan">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-primary" onclick="addRow()">Add</button>
                                    <a href="{{ url('/PrmRawMaterialOutput') }}" type="button" class="btn btn-danger"
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
                    <div class="card-body" style="overflow: scroll" content="{{ csrf_token() }}">
                        <table class="table table-striped mt-3">
                            <thead>
                                <tr>
                                    <th class="text-center">Nomor BSTB</th>
                                    <th class="text-center">ID Box Grading Kasar</th>
                                    <th class="text-center">Nomor Job</th>
                                    <th class="text-center">Nomor Batch</th>
                                    <th class="text-center">Nama Supplier</th>
                                    <th class="text-center">ID Box Raw Material</th>
                                    <th class="text-center">Jenis Raw Material</th>
                                    <th class="text-center">Jenis Grading</th>
                                    <th class="text-center">Berat Keluar</th>
                                    <th class="text-center">PCS Keluar</th>
                                    <th class="text-center">AVG Kadar Air</th>
                                    <th class="text-center">Tujuan Kirim</th>
                                    <th class="text-center">Nomor Grading</th>
                                    <th class="text-center">Modal</th>
                                    <th class="text-center">Total Modal</th>
                                    <th class="text-center">Biaya Produksi</th>
                                    <th class="text-center">Fix Total Modal</th>
                                    <th class="text-center">Keterangan</th>
                                    <th class="text-center">NIP Admin</th>
                                    <th class="text-center">Action</th>
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
    </div>
    </div>
@endsection
@section('script')
    <script>
        $('#id_box_grading_kasar').on('change', function() {
            // Mengambil nilai id_box_grading_kasar yang dipilih
            let selectedIdBox = $(this).val();
            // Melakukan permintaan AJAX ke controller untuk mendapatkan nomor batch
            $.ajax({
                url: `{{ route('GradingKasarOutput.set') }}`,
                method: 'GET',
                data: {
                    id_box_grading_kasar: selectedIdBox
                },
                success: function(response) {
                    console.log(response);
                    // Mengatur nilai Nomor Batch sesuai dengan respons dari server
                    $('#nomor_batch').val(response.nomor_batch);
                    $('#nama_supplier').val(response.nama_supplier);
                    $('#id_box_raw_material').val(response.id_box_raw_material);
                    $('#jenis_raw_material').val(response.jenis_raw_material);
                    $('#jenis_grading').val(response.jenis_grading);
                    $('#avg_kadar_air').val(response.avg_kadar_air);
                    $('#nomor_grading').val(response.nomor_grading);
                    $('#modal, #fix_total_modal').val(response.modal);
                    $('#nomor_nota_internal').val(response.nomor_nota_internal);
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });

        // Event listener untuk perubahan nilai pada total modal
        $('#modal').on('input', updateTotalmodal);
        $('#berat_keluar').on('input', updateTotalmodal);

        function updateTotalmodal() {
            // Mendapatkan nilai berat_keluar nota dan berat_keluar bersih
            const modal = parseFloat($('#modal').val());
            const berat = parseFloat($('#berat_keluar').val());

            // Melakukan perhitungan selisih berat
            const totalmodal = berat * modal;

            // Memasukkan hasil perhitungan ke dalam input selisih berat
            $('#total_modal').val(isNaN(totalmodal) ? '' : totalmodal);
        }

        // Variabel global untuk menyimpan indeks baris terakhir
        var currentRowIndex = 0;
        var dataArray = [];
        var dataStock = [];

        function addRow() {
            // Mengambil nilai dari input
            var nomor_bstb = $('#nomor_bstb').val();
            var id_box_grading_kasar = $('#id_box_grading_kasar').val();
            var nomor_job = $('#nomor_job').val();
            var nomor_batch = $('#nomor_batch').val();
            var nama_supplier = $('#nama_supplier').val();
            var id_box_raw_material = $('#id_box_raw_material').val();
            var jenis_raw_material = $('#jenis_raw_material').val();
            var jenis_grading = $('#jenis_grading').val();
            var berat_keluar = $('#berat_keluar').val();
            var pcs_keluar = $('#pcs_keluar').val();
            var selisih_berat = $('#selisih_berat').val();
            var avg_kadar_air = $('#avg_kadar_air').val();
            var tujuan_kirim = $('#tujuan_kirim').val();
            var nomor_grading = $('#nomor_grading').val();
            var modal = $('#modal').val();
            var total_modal = $('#total_modal').val();
            var biaya_produksi = $('#biaya_produksi').val();
            var fix_total_modal = $('#fix_total_modal').val();
            var keterangan = $('#keterangan').val();
            var user_created = $('#user_created').val();
            var nomor_nota_internal = $('#nomor_nota_internal').val();

            // Validasi input (sesuai kebutuhan)
            if (!nomor_job || !nomor_batch) {
                alert('ID and nomor_batch are required.');
                return;
            }

            // Memanggil fungsi generateNomorBSTB untuk mendapatkan nomor_bstb
            // var nomor_bstb = generateNomorBSTB(inisial_tujuan);

            // Menambahkan data ke dalam tabel
            var newRow =
                '<tr><td>' + nomor_bstb +
                '</td><td>' + id_box_grading_kasar +
                '</td><td>' + nomor_job +
                '</td><td>' + nomor_batch +
                '</td><td>' + nama_supplier +
                '</td><td>' + id_box_raw_material +
                '</td><td>' + jenis_raw_material +
                '</td><td>' + jenis_grading +
                '</td><td>' + berat_keluar +
                '</td><td>' + pcs_keluar +
                '</td><td>' + avg_kadar_air +
                '</td><td>' + tujuan_kirim +
                '</td><td>' + nomor_grading +
                '</td><td>' + modal +
                '</td><td>' + total_modal +
                '</td><td>' + biaya_produksi +
                '</td><td>' + fix_total_modal +
                '</td><td>' + keterangan +
                '</td><td>' + user_created +
                '</td><td><button class="btn btn-danger" onclick="hapusBaris(this)">Delete</button></td></tr>';

            $('#tableBody').append(newRow);

            // Menambahkan data ke dalam array
            // dataid_box_grading_kasar.push(id_box_grading_kasar)
            dataArray.push({
                nomor_bstb: nomor_bstb,
                id_box_grading_kasar: id_box_grading_kasar,
                nomor_batch: nomor_batch,
                nomor_job: nomor_job,
                nama_supplier: nama_supplier,
                nomor_nota_internal: nomor_nota_internal,
                id_box_raw_material: id_box_raw_material,
                jenis_raw_material: jenis_raw_material,
                jenis_grading: jenis_grading,
                berat_keluar: berat_keluar,
                pcs_keluar: pcs_keluar,
                avg_kadar_air: avg_kadar_air,
                tujuan_kirim: tujuan_kirim,
                nomor_grading: nomor_grading,
                biaya_produksi: biaya_produksi,
                modal: modal,
                total_modal: total_modal,
                fix_total_modal: fix_total_modal,
                keterangan: keterangan,
                user_created: user_created
            });
            // Membersihkan nilai input setelah ditambahkan
            $('#id_box_grading_kasar').val('<option></option>');
            $('#id_box_raw_material').val('');
            $('#nomor_batch').val('');
            $('#nama_supplier').val('');
            $('#nomor_nota_internal').val('');
            $('#jenis_raw_material').val('');
            $('#jenis_grading').val('');
            $('#berat_masuk').val('');
            $('#berat_keluar').val('');
            $('#pcs_keluar').val('');
            $('#avg_kadar_air').val('');
            $('#biaya_produksi').val('');
            $('#nomor_grading').val('');
            $('#fix_total_modal').val('');
            $('#modal').val('');
            $('#total_modal').val('');
            $('#keterangan').val('');
            // Menonaktif kan nilai input ketika ditambah
            $('#nomor_bstb').prop('readonly', true);
            $('#nomor_batch').prop('readonly', true);
            $('#user_created').prop('readonly', true);
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

            // Update indeks baris terakhir
            currentRowIndex--;
        }

        function getArray() {
            // Menampilkan array di konsol untuk tujuan debugging
            console.log(dataArray);
        }

        function sendData() {
            console.log(dataArray);
            // Mengirim data ke server menggunakan AJAX
            $.ajax({
                url: `{{ route('GradingKasarOutput.sendData') }}`, // Ganti dengan URL endpoint yang sesuai
                method: 'POST',
                data: {
                    data: JSON.stringify(dataArray),
                    dataStock: JSON.stringify(dataStock),
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json', // payload is json,
                success: function(response) {
                    Swal.fire({
                        title: 'Alhamdulillah!',
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
                        title: 'Astaghfirullah!',
                        text: 'Terjadi kesalahan. Silakan coba lagi.',
                        icon: 'error'
                    });
                    console.log('Validation Errors:', response.responseJSON.errors);
                }
            });
        }
    </script>
@endsection
