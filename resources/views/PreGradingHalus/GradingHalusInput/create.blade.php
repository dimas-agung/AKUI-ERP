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
                                    <div class="form-group mandatory">
                                        <label>Nomer Dokument</label>
                                        <input type="text" id="doc_no" class="form-control" name="doc_no"
                                            placeholder="Masukkan Nomer Dokument" data-parsley-required="true">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>NIP Admin</label>
                                        <input type="text" id="user_created" class="form-control" name="user_created"
                                            placeholder="Masukkan User Created" data-parsley-required="true">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nomor Grading</label>
                                        <select id="nomor_grading" class="select2 form-select" name="nomor_grading">
                                            <option value="">Pilih Nomor Grading</option>
                                            @foreach ($TransitPre->sortBy('nomor_grading') as $post)
                                                <option value="{{ $post->nomor_grading }}">
                                                    {{ old('nomor_grading', $post->nomor_grading) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Jenis Grading</label>
                                        <select id="jenis_grading" class="select2 form-select" name="jenis_grading">
                                            <option value="">Pilih Jenis Grading</option>
                                            @foreach ($Unit->sortBy('jenis') as $post)
                                                <option value="{{ $post->jenis }}">
                                                    {{ old('jenis', $post->jenis) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nama Supplier</label>
                                        <input type="text" class="form-control" id="nama_supplier" name="nama_supplier"
                                            readonly>
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
                                        <label>Jenis Raw Material</label>
                                        <input type="text" class="form-control" id="jenis_raw_material"
                                            name="jenis_raw_material" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Berta Adding</label>
                                        <input type="text" id="berat_adding" class="form-control" name="berat_adding"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Pcs Adding</label>
                                        <input type="text" id="pcs_adding" class="form-control" name="pcs_adding"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>No Nota</label>
                                        <input type="text" id="nomor_nota_internal" class="form-control"
                                            name="nomor_nota_internal" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Kadar Air</label>
                                        <input type="text" class="form-control" id="kadar_air" name="kadar_air" readonly>
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
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Kategori Susut</label>
                                        <input type="text" id="kategori_susut" class="form-control"
                                            name="kategori_susut" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Berat Grading</label>
                                        <input type="text" id="berat_grading" pattern="[0-9]*" inputmode="numeric"
                                            onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                            class="form-control" name="berat_grading" value="{{ old('berat_grading') }}"
                                            placeholder="Masukkan berat grading" data-parsley-required="true">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Pcs Grading</label>
                                        <input type="text" id="pcs_grading" pattern="[0-9]*" inputmode="numeric"
                                            onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                            class="form-control" name="pcs_grading" value="{{ old('pcs_grading') }}"
                                            placeholder="Masukkan pcs grading" data-parsley-required="true">
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
                                <th class="text-center" scope="col">No</th>
                                <th class="text-center" scope="col">Nomor grading</th>
                                <th class="text-center" scope="col">Id Box Raw Material</th>
                                <th class="text-center" scope="col">Nomor Batch</th>
                                <th class="text-center" scope="col">Nomor Nota Internal</th>
                                <th class="text-center" scope="col">Nama Supplier</th>
                                <th class="text-center" scope="col">Jenis Raw Material</th>
                                <th class="text-center" scope="col">Kadar Air</th>
                                <th class="text-center" scope="col">Berat Adding</th>
                                <th class="text-center" scope="col">Pcs Adding</th>
                                <th class="text-center" scope="col">Keterangan</th>
                                <th class="text-center" scope="col">Modal</th>
                                <th class="text-center" scope="col">Total Modal</th>
                                <th class="text-center" scope="col">Kategori Susut</th>
                                <th class="text-center" scope="col">Id Box Grading Halus</th>
                                <th class="text-center" scope="col">Susut Depan</th>
                                <th class="text-center" scope="col">Susut Belakang</th>
                                <th class="text-center" scope="col">Biaya Produksi</th>
                                <th class="text-center" scope="col">kontribusi</th>
                                <th class="text-center" scope="col">harga_estimasi</th>
                                <th class="text-center" scope="col">total_harga</th>
                                <th class="text-center" scope="col">nilai_laba_rugi</th>
                                <th class="text-center" scope="col">nilai_prosentase_total_keuntungan</th>
                                <th class="text-center" scope="col">prosentase_harga_gramasi</th>
                                <th class="text-center" scope="col">selisih_laba_rugi_kg</th>
                                <th class="text-center" scope="col">selisih_laba_rugi_per_gram</th>
                                <th class="text-center" scope="col">hpp</th>
                                <th class="text-center" scope="col">total_hpp</th>
                                <th class="text-center" scope="col">fix_hpp</th>
                                <th class="text-center" scope="col">fix_total_hpp</th>
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
        let selectedNomorBSTB = ''; // Variabel untuk menyimpan nomor BSTB yang dipilih sebelumnya
        $('#nomor_grading').on('change', function() {
            // Mengambil nilai nomor_grading yang dipilih
            let selectedIdBox = $(this).val();
            // Hanya lakukan permintaan AJAX jika nomor BSTB yang baru dipilih tidak sama dengan yang sebelumnya
            if (selectedNomorBSTB !== selectedIdBox) {
                selectedNomorBSTB = selectedIdBox; // Perbarui nomor BSTB yang dipilih sebelumnya

                // Melakukan permintaan AJAX ke controller untuk mendapatkan data
                $.ajax({
                    url: `{{ route('GradingHalusInput.set') }}`,
                    method: 'GET',
                    data: {
                        nomor_grading: selectedIdBox
                    },
                    success: function(response) {
                        console.log(response);
                        $('#id_box_raw_material').val(response.id_box_raw_material);
                        $('#nomor_batch').val(response.nomor_batch);
                        $('#nomor_nota_internal').val(response.nomor_nota_internal);
                        $('#nama_supplier').val(response.nama_supplier);
                        $('#jenis_raw_material').val(response.jenis_raw_material);
                        $('#kadar_air').val(response.kadar_air);
                        $('#berat_adding').val(response.berat_adding);
                        $('#pcs_adding').val(response.pcs_adding);
                        $('#modal').val(response.modal);
                        $('#total_modal').val(response.total_modal);
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            }
        });

        $('#jenis_grading').on('change', function() {
            // Mengambil nilai unit yang dipilih
            let selectedUnit = $(this).val();

            // Melakukan permintaan AJAX ke controller untuk mendapatkan data
            $.ajax({
                url: `{{ route('GradingHalusInput.setUnit') }}`,
                method: 'GET',
                data: {
                    jenis: selectedUnit // Perbaikan disini
                },
                success: function(response) {
                    console.log(response);
                    $('#kategori_susut').val(response.kategori_susut);
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });


        function addRow() {
            // Mengambil nilai dari input
            var nomor_grading = $('#nomor_grading').val();
            var id_box_raw_material = $('#id_box_raw_material').val();
            var nomor_batch = $('#nomor_batch').val();
            var nomor_nota_internal = $('#nomor_nota_internal').val();
            var nama_supplier = $('#nama_supplier').val();
            var jenis_raw_material = $('#jenis_raw_material').val();
            var kadar_air = $('#kadar_air').val();
            var berat_adding = $('#berat_adding').val();
            var pcs_adding = $('#pcs_adding').val();
            var jenis_grading = $('#jenis_grading').val();
            var berat_grading = $('#berat_grading').val();
            var pcs_grading = $('#pcs_grading').val();
            var keterangan = $('#keterangan').val();
            var modal = $('#modal').val();
            var total_modal = $('#total_modal').val();
            var kategori_susut = $('#kategori_susut').val();
            var id_box_grading_halus = $('#id_box_grading_halus').val();
            var susut_depan = $('#susut_depan').val();
            var susut_belakang = $('#susut_belakang').val();
            var biaya_produksi = $('#biaya_produksi').val();
            var kontribusi = $('#kontribusi').val();
            var harga_estimasi = $('#harga_estimasi').val();
            var total_harga = $('#total_harga').val();
            var nilai_laba_rugi = $('#nilai_laba_rugi').val();
            var nilai_prosentase_total_keuntungan = $('#nilai_prosentase_total_keuntungan').val();
            var prosentase_harga_gramasi = $('#prosentase_harga_gramasi').val();
            var selisih_laba_rugi_kg = $('#selisih_laba_rugi_kg').val();
            var selisih_laba_rugi_per_gram = $('#selisih_laba_rugi_per_gram').val();
            var hpp = $('#hpp').val();
            var total_hpp = $('#total_hpp').val();
            var fix_hpp = $('#fix_hpp').val();
            var fix_total_hpp = $('#fix_total_hpp').val();
            var user_created = $('#user_created').val();


            // Inisialisasi array untuk menyimpan field yang belum terisi
            let fieldsNotFilled = [];
            // Periksa setiap field
            if (!nomor_grading) fieldsNotFilled.push('No Grading');
            if (!nama_supplier) fieldsNotFilled.push('Nama Supllier');
            if (!id_box_grading_halus) fieldsNotFilled.push('Tujuan Kirim');
            if (!jenis_grading) fieldsNotFilled.push('Jenis Grading');
            if (!user_created) fieldsNotFilled.push('NIP Admin');
            if (!berat_grading || berat_grading <= 0) fieldsNotFilled.push('Berat Grading');

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
                '<td>' + nomor_grading + '</td>' +
                '<td>' + id_box_raw_material + '</td>' +
                '<td>' + nomor_batch + '</td>' +
                '<td>' + nomor_nota_internal + '</td>' +
                '<td>' + nama_supplier + '</td>' +
                '<td>' + jenis_raw_material + '</td>' +
                '<td>' + kadar_air + '</td>' +
                '<td>' + berat_adding + '</td>' +
                '<td>' + pcs_adding + '</td>' +
                '<td>' + jenis_grading + '</td>' +
                '<td>' + berat_grading + '</td>' +
                '<td>' + pcs_grading + '</td>' +
                '<td>' + keterangan + '</td>' +
                '<td>' + modal + '</td>' +
                '<td>' + total_modal + '</td>' +
                '<td>' + kategori_susut + '</td>' +
                '<td>' + id_box_grading_halus + '</td>' +
                '<td>' + susut_depan + '</td>' +
                '<td>' + susut_belakang + '</td>' +
                '<td>' + biaya_produksi + '</td>' +
                '<td>' + kontribusi + '</td>' +
                '<td>' + harga_estimasi + '</td>' +
                '<td>' + total_harga + '</td>' +
                '<td>' + nilai_laba_rugi + '</td>' +
                '<td>' + nilai_prosentase_total_keuntungan + '</td>' +
                '<td>' + prosentase_harga_gramasi + '</td>' +
                '<td>' + selisih_laba_rugi_kg + '</td>' +
                '<td>' + selisih_laba_rugi_per_gram + '</td>' +
                '<td>' + hpp + '</td>' +
                '<td>' + total_hpp + '</td>' +
                '<td>' + fix_hpp + '</td>' +
                '<td>' + fix_total_hpp + '</td>' +
                '<td>' + user_created + '</td>' +
                '<td><button class="btn btn-danger" onclick="hapusBaris(this)">Delete</button></td>' +
                '</tr>';

            $('#tableBody').append(newRow);

            // Menambahkan data ke dalam array
            // dataArrayDocNo.push(doc_no)
            dataArray.push({
                nomor_grading: nomor_grading,
                id_box_raw_material: id_box_raw_material,
                nomor_batch: nomor_batch,
                nomor_nota_internal: nomor_nota_internal,
                nama_supplier: nama_supplier,
                jenis_raw_material: jenis_raw_material,
                kadar_air: kadar_air,
                berat_adding: berat_adding,
                pcs_adding: pcs_adding,
                jenis_grading: jenis_grading,
                berat_grading: berat_grading,
                pcs_grading: pcs_grading,
                keterangan: keterangan,
                modal: modal,
                total_modal: total_modal,
                kategori_susut: inisial_tujuan,
                id_box_grading_halus: id_box_grading_halus,
                susut_depan: susut_depan,
                susut_belakang: susut_belakang,
                biaya_produksi: biaya_produksi,
                kontribusi: kontribusi,
                harga_estimasi: harga_estimasi,
                total_harga: total_harga,
                nilai_laba_rugi: nilai_laba_rugi,
                nilai_prosentase_total_keuntungan: nilai_prosentase_total_keuntungan,
                prosentase_harga_gramasi: prosentase_harga_gramasi,
                selisih_laba_rugi_kg: selisih_laba_rugi_kg,
                selisih_laba_rugi_per_gram: selisih_laba_rugi_per_gram,
                hpp: hpp,
                total_hpp: total_hpp,
                fix_hpp: fix_hpp,
                fix_total_hpp: fix_total_hpp,
                user_created: user_created,
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
            $('#doc_no').prop('readonly', true);
            $('#nomor_bstb').prop('readonly', true);
            $('#nomor_batch').prop('readonly', true);
            $('#keterangan').prop('readonly', true);
            $('#user_created').prop('readonly', true);

            // Update indeks baris terakhir
            currentRowIndex++;
        }

        function sendData() {
            // Mengirim data ke server menggunakan AJAX
            $.ajax({
                url: '{{ route('PreGradingHalusInput.store') }}',
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
                    var postData = {
                        dataArray: JSON.stringify(dataArray), // Mengirim dataArray sebagai string JSON
                        user_created: $('#user_created').val() || '',
                        user_updated: 'Asc-186',
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
