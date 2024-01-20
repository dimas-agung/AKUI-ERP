@extends('layouts.master1')
@section('Menu')
    Pre-Cleaning
@endsection
@section('title')
    Data Pre-Cleaning Input
@endsection
@section('content')
    <div class="container">
        <div class="card mt-2">
            <form action="{{ route('PreCleaningInput.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-0 shadow-sm rounded">
                            <div class="card-header">
                                <h4>Input Data Pre-Cleaning Input</h4>
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
                                            <label>Nomer Document</label>
                                            <input type="text" id="doc_no" class="form-control" name="doc_no"
                                                placeholder="Masukkan Nomer Document">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Nomor Job</label>
                                            <select id="nomor_job" class="choices form-select" name="nomor_job"
                                                data-placeholder="Pilih Nomor Job">
                                                <option value="">Pilih Nomor Job</option>
                                                @foreach ($stockTGK as $post)
                                                    <option value="{{ $post->nomor_job }}">
                                                        {{ old('nomor_job', $post->nomor_job) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>NIP Admin</label>
                                            <input type="text" id="user_created" class="form-control" name="user_created"
                                                placeholder="Masukkan User Created">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Nomer BSTB</label>
                                            <input type="text" class="form-control" id="nomor_bstb" name="nomor_bstb"
                                                onchange="handleChange(this.{{ 'nomor_bstb' }})" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>ID Box Grading Kasar</label>
                                            <input type="text" class="form-control" id="id_box_grading_kasar"
                                                name="id_box_grading_kasar"
                                                onchange="handleChange(this.{{ 'id_box_grading_kasar' }})" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tujuan Kirim</label>
                                            <input type="text" class="form-control" id="tujuan_kirim" name="tujuan_kirim"
                                                onchange="handleChange(this.{{ 'tujuan_kirim' }})" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Nama Supplier</label>
                                            <input type="text" class="form-control" id="nama_supplier"
                                                name="nama_supplier" onchange="handleChange(this.{{ 'nama_supplier' }})"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Nomor Batch</label>
                                            <input type="text" class="form-control" id="nomor_batch" name="nomor_batch"
                                                onchange="handleChange(this.{{ 'nomor_batch' }})" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>ID Box Raw Material</label>
                                            <input type="text" class="form-control" id="id_box_raw_material"
                                                name="id_box_raw_material"
                                                onchange="handleChange(this.{{ 'id_box_raw_material' }})" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Jenis Raw Material</label>
                                            <input type="text" class="form-control" id="jenis_raw_material"
                                                name="jenis_raw_material"
                                                onchange="handleChange(this.{{ 'jenis_raw_material' }})" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Jenis Grading</label>
                                            <input type="text" class="form-control" id="jenis_grading"
                                                name="jenis_grading" onchange="handleChange(this.{{ 'jenis_grading' }})"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Berat Keluar</label>
                                            <input type="text" id="berat_keluar" class="form-control" name="berat_keluar"
                                                onchange="handleChange(this.{{ 'berat_keluar' }})" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>PCS Keluar</label>
                                            <input type="text" id="pcs_keluar" class="form-control" name="pcs_keluar"
                                                onchange="handleChange(this.{{ 'pcs_keluar' }})" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>AVG Kadar Air</label>
                                            <input type="text" class="form-control" id="avg_kadar_air"
                                                name="avg_kadar_air" onchange="handleChange(this.{{ 'avg_kadar_air' }})"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Nomor Grading</label>
                                            <input type="text" id="nomor_grading" class="form-control"
                                                name="nomor_grading" onchange="handleChange(this)" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Modal</label>
                                            <input type="text" id="modal" class="form-control" name="modal"
                                                value="{{ 'modal' }}" onchange="handleChange(this)" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Total Modal</label>
                                            <input type="text" id="total_modal" class="form-control"
                                                name="total_modal" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>No Nota</label>
                                            <input type="text" id="nomor_nota_internal" class="form-control"
                                                name="nomor_nota_internal"
                                                onchange="handleChange(this.{{ 'nomor_nota_internal' }})" readonly>
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
                                <th class="text-center">Nomor Document</th>
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
        $('#nomor_job').on('change', function() {
            // Mengambil nilai nomor_job yang dipilih
            let selectedIdBox = $(this).val();
            // Melakukan permintaan AJAX ke controller untuk mendapatkan nomor batch
            $.ajax({
                url: `{{ route('PreCleaningInput.set') }}`,
                method: 'GET',
                data: {
                    nomor_job: selectedIdBox
                },
                success: function(response) {
                    console.log(response);
                    // Mengatur nilai Nomor Batch sesuai dengan respons dari server
                    $('#nomor_bstb').val(response.nomor_bstb);
                    $('#id_box_grading_kasar').val(response.id_box_grading_kasar);
                    $('#nomor_batch').val(response.nomor_batch);
                    $('#nama_supplier').val(response.nama_supplier);
                    $('#id_box_raw_material').val(response.id_box_raw_material);
                    $('#jenis_raw_material').val(response.jenis_raw_material);
                    $('#tujuan_kirim').val(response.tujuan_kirim);
                    $('#jenis_grading').val(response.jenis_grading);
                    $('#berat_keluar').val(response.berat_keluar);
                    $('#pcs_keluar').val(response.pcs_keluar);
                    $('#avg_kadar_air').val(response.avg_kadar_air);
                    $('#nomor_grading').val(response.nomor_grading);
                    $('#modal').val(response.modal);
                    $('#total_modal').val(response.total_modal);
                    $('#nomor_nota_internal').val(response.nomor_nota_internal);
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });

        // Variabel global untuk menyimpan indeks baris terakhir
        var currentRowIndex = 0;
        var dataArray = [];
        var dataStock = [];

        function addRow() {
            // Mengambil nilai dari input
            var doc_no = $('#doc_no').val();
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
            var keterangan = $('#keterangan').val();
            var user_created = $('#user_created').val();
            var nomor_nota_internal = $('#nomor_nota_internal').val();

            // Validasi input (sesuai kebutuhan)
            if (!nomor_job || !nomor_batch) {
                alert('ID and nomor_batch are required.');
                return;
            }

            // Menambahkan data ke dalam tabel
            var newRow = '<tr>' +
                '<td>' + doc_no + '</td>' +
                '<td>' + nomor_bstb + '</td>' +
                '<td>' + id_box_grading_kasar + '</td>' +
                '<td>' + nomor_job + '</td>' +
                '<td>' + nomor_batch + '</td>' +
                '<td>' + nama_supplier + '</td>' +
                '<td>' + id_box_raw_material + '</td>' +
                '<td>' + jenis_raw_material + '</td>' +
                '<td>' + jenis_grading + '</td>' +
                '<td>' + berat_keluar + '</td>' +
                '<td>' + pcs_keluar + '</td>' +
                '<td>' + avg_kadar_air + '</td>' +
                '<td>' + tujuan_kirim + '</td>' +
                '<td>' + nomor_grading + '</td>' +
                '<td>' + modal + '</td>' +
                '<td>' + total_modal + '</td>' +
                '<td>' + keterangan + '</td>' +
                '<td>' + user_created + '</td>' +
                '<td><button onclick="deleteRow(' + currentRowIndex +
                ')" class="btn btn-danger" data-dismiss="modal">Hapus</button></td>' +
                '</tr>';

            $('#tableBody').append(newRow);

            // Mendefinisikan array jika belum
            if (typeof doc_no === 'undefined') {
                var doc_no = [];
                var nomor_bstb = [];
                var id_box_grading_kasar = [];
                var nomor_job = [];
                var nama_supplier = [];
                var nomor_nota_internal = [];
                var id_box_raw_material = [];
                var jenis_raw_material = [];
                var jenis_grading = [];
                var berat_keluar = [];
                var pcs_keluar = [];
                var avg_kadar_air = [];
                var tujuan_kirim = [];
                var nomor_grading = [];
                var modal = [];
                var total_modal = [];
                var keterangan = [];
                var user_created = [];
                // ... definisikan array lainnya sesuai kebutuhan
            }

            doc_no.push(doc_no)
            nomor_bstb.push(nomor_bstb)
            id_box_grading_kasar.push(id_box_grading_kasar)
            nomor_batch.push(nomor_batch)
            nomor_job.push(nomor_job)
            nama_supplier.push(nama_supplier)
            nomor_nota_internal.push(nomor_nota_internal)
            id_box_raw_material.push(id_box_raw_material)
            jenis_raw_material.push(jenis_raw_material)
            jenis_grading.push(jenis_grading)
            berat_keluar.push(berat_keluar)
            pcs_keluar.push(pcs_keluar)
            avg_kadar_air.push(avg_kadar_air)
            tujuan_kirim.push(tujuan_kirim)
            nomor_grading.push(nomor_grading)
            modal.push(modal)
            total_modal.push(total_modal)
            keterangan.push(keterangan)
            user_created.push(user_created)

            // Membersihkan nilai input setelah ditambahkan
            $('#id_box_grading_kasar').val('');
            $('#nomor_batch').val('');
            $('#nama_supplier').val('');
            $('#nomor_nota_internal').val('');
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
            $('#keterangan').val('');

            // Menonaktifkan nilai input ketika ditambah
            $('#nomor_bstb').prop('readonly', true);
            $('#nomor_batch').prop('readonly', true);
            $('#user_created').prop('readonly', true);

            // Memperbarui indeks baris terakhir
            currentRowIndex++;
        }


        function getArray() {
            // Menampilkan array di konsol untuk tujuan debugging
            console.log(dataArray);
        }

        function deleteRow(rowIndex) {
            // Hapus baris dari tabel
            $('#tableBody tr').eq(rowIndex).remove();

            // Hapus data yang sesuai dari array (diasumsikan dataArray adalah variabel global)
            currentRowIndex.splice(rowIndex, 1);

            // Anda juga mungkin ingin mengaktifkan kembali input atau melakukan tindakan lain yang diperlukan
            // Sebagai contoh, jika Anda ingin mengaktifkan kembali input:
            $('#nomor_bstb').prop('readonly', false);
            $('#nomor_batch').prop('readonly', false);
            $('#keterangan').prop('readonly', false);
            $('#user_created').prop('readonly', false);
        }

        function sendData() {
            console.log(dataArray);
            // Mengirim data ke server menggunakan AJAX
            $.ajax({
                url: `{{ route('PreCleaningInput.sendData') }}`, // Ganti dengan URL endpoint yang sesuai
                method: 'POST',
                data: {
                    doc_no: JSON.stringify(doc_no),
                    nomor_bstb: JSON.stringify(nomor_bstb),
                    id_box_grading_kasar: JSON.stringify(id_box_grading_kasar),
                    nomor_batch: JSON.stringify(nomor_batch),
                    nomor_job: JSON.stringify(nomor_job),
                    nama_supplier: JSON.stringify(nama_supplier),
                    nomor_nota_internal: JSON.stringify(nomor_nota_internal),
                    id_box_raw_material: JSON.stringify(id_box_raw_material),
                    jenis_raw_material: JSON.stringify(jenis_raw_material),
                    jenis_grading: JSON.stringify(jenis_grading),
                    berat_keluar: JSON.stringify(berat_keluar),
                    pcs_keluar: JSON.stringify(pcs_keluar),
                    avg_kadar_air: JSON.stringify(avg_kadar_air),
                    tujuan_kirim: JSON.stringify(tujuan_kirim),
                    nomor_grading: JSON.stringify(nomor_grading),
                    modal: JSON.stringify(modal),
                    total_modal: JSON.stringify(total_modal),
                    keterangan: JSON.stringify(keterangan),
                    user_created: JSON.stringify(user_created),
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
