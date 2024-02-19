@extends('layouts.master1')
@section('menu')
    Purchasing & EXIM
@endsection
@section('title')
    Purchasing Raw Material Input
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card mt-2">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">View Purchasing Raw Material</h4>
                </div>
                <form action="{{ route('PrmRawMaterialInput.update', $prm_raw_material_input_items->id) }} " method="POST"
                    class="row g-3">
                    @csrf
                    {{-- <div class="col-md-4">
                        <label for="no_doc" class="form-label">Nomor DOC</label>
                        <input type="text" class="form-control" id="no_doc" value="1" readonly>
                    </div> --}}
                    {{-- <div class="col-md-4">
                        <label for="nomor_po" class="form-label">Nomor PO</label>
                        <input type="text" class="form-control" id="nomor_po"
                            value="{{ old('nomor_po', $prm_raw_material_inputs->nomor_po) }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="nomor_batch" class="form-label">Nomor Batch</label>
                        <input type="text" class="form-control" id="nomor_batch"
                            value="{{ old('nomor_batch', $prm_raw_material_inputs->nomor_batch) }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="nomor_nota_supplier" class="form-label">Nomor Nota Supplier</label>
                        <input type="text" class="form-control" id="nomor_nota_supplier"
                            value="{{ old('nomor_nota_internal', $prm_raw_material_inputs->nomor_nota_internal) }}"
                            readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="nomor_nota_internal" class="form-label">Nomor Nota Internal</label>
                        <input type="text" class="form-control" id="nomor_nota_internal"
                            value="{{ old('nomor_nota_internal', $prm_raw_material_inputs->nomor_nota_internal) }}"
                            readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="basic-usage" class="form-label">Pilih Nama Supplier :</label>
                        <select class="choices form-select" style="width: 100%;" tabindex="-1" aria-hidden="true"
                            name="nama_supplier" id="nama_supplier" data-placeholder="Pilih Nama Supplier" readonly>
                            <option value="">Pilih Nama Supplier</option>
                            @foreach ($master_supplier_raw_materials as $MasterSPRM)
                                <option value="{{ $MasterSPRM->nama_supplier }}"
                                    {{ old('nama_supplier', $prm_raw_material_inputs->nama_supplier) == $MasterSPRM->nama_supplier ? 'selected' : '' }}>
                                    {{ $MasterSPRM->nama_supplier }}</option>
                            @endforeach
                        </select>
                    </div> --}}
                    <div class="col-md-flex">
                        <hr>
                    </div>
                    <div class="col-md-3">
                        <label for="basic-usage" class="form-label">Pilih Jenis :</label>
                        <select class="choices form-select" style="width: 100%;" tabindex="-1" aria-hidden="true"
                            name="jenis" id="jenis" data-placeholder="Pilih Jenis">
                            <option value="">Pilih Jenis</option>
                            @foreach ($master_jenis_raw_materials as $MasterJRM)
                                <option value="{{ $MasterJRM->jenis }}"
                                    {{ old('jenis', $prm_raw_material_input_items->jenis) == $MasterJRM->jenis ? 'selected' : '' }}>
                                    {{ $MasterJRM->jenis }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="berat_nota" class="form-label">Berat Nota</label>
                        <input type="number" class="form-control" id="berat_nota"
                            value="{{ old('berat_nota', $prm_raw_material_input_items->berat_nota) }}" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="berat_kotor" class="form-label">Berat Kotor</label>
                        <input type="number" class="form-control" id="berat_kotor"
                            value="{{ old('berat_kotor', $prm_raw_material_input_items->berat_kotor) }}" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="berat_bersih" class="form-label">Berat Bersih</label>
                        <input type="number" class="form-control" id="berat_bersih"
                            value="{{ old('berat_bersih', $prm_raw_material_input_items->berat_bersih) }}" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="selisih_berat" class="form-label">Selisih Berat</label>
                        <input type="number" class="form-control" id="selisih_berat"
                            value="{{ old('selisih_berat', $prm_raw_material_input_items->selisih_berat) }}" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="kadar_air" class="form-label">Kadar Air</label>
                        <input type="number" class="form-control" id="kadar_air"
                            value="{{ old('kadar_air', $prm_raw_material_input_items->kadar_air) }}" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="id_box" class="form-label">ID Box</label>
                        <input type="text" class="form-control" id="id_box"
                            value="{{ old('id_box', $prm_raw_material_input_items->id_box) }}" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="harga_nota" class="form-label">Harga Nota</label>
                        <input type="number" class="form-control" id="harga_nota"
                            value="{{ old('harga_nota', $prm_raw_material_input_items->harga_nota) }}" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="total_harga_nota" class="form-label">Total Harga Nota</label>
                        <input type="number" class="form-control" id="total_harga_nota"
                            value="{{ old('total_harga_nota', $prm_raw_material_input_items->total_harga_nota) }}"
                            readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="harga_deal" class="form-label">Harga Deal</label>
                        <input type="number" class="form-control" id="harga_deal"
                            value="{{ old('harga_deal', $prm_raw_material_input_items->harga_deal) }}" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan"
                            value="{{ old('keterangan', $prm_raw_material_input_items->keterangan) }}" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="user_created" class="form-label">NIP Admin</label>
                        <input type="text" class="form-control" id="user_created"
                            value="{{ old('user_created', $prm_raw_material_input_items->user_created) }}" readonly>
                    </div>
                    <div class="col-12">
                        {{-- <button type="submit" class="btn btn-md btn-primary">UPDATE</button> --}}
                        {{-- <button type="button" class="btn btn-warning" onclick="addRow()">Update</button> --}}
                        <button type="button" class="btn btn-danger" onclick="goBack()">Cancel</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
@section('script')
    <script>
        // Menambahkan event listener untuk perubahan nilai pada input nomor nota supplier dan select nama supplier
        $('#nomor_nota_supplier').on('input', generateNomorNotaInternal);
        $('#nama_supplier').on('change', generateNomorNotaInternal);
        // $('#nomor_nota_supplier, #nama_supplier').on('input change', generateNomorNotaInternal);
        $('#nomor_nota_internal').on('input', generateIdBox);
        $('#jenis').on('change', generateIdBox);
        $('#harga_nota').on('input', generateIdBox);
        // Event listener untuk input beratNotaInput dan hargaNotaInput
        $('#berat_nota').on('input', updateTotalHarga);
        $('#harga_nota').on('input', updateTotalHarga);

        // Event listener untuk perubahan nilai pada berat nota atau berat bersih
        $('#berat_nota').on('input', updateSelisihBerat);
        $('#berat_bersih').on('input', updateSelisihBerat);

        // Event listener untuk perubahan nilai pada total harga nota atau berat bersih
        $('#total_harga_nota').on('input', updateHargaDeal);
        $('#berat_bersih').on('input', updateHargaDeal);

        $('#nama_supplier').on('change', function() {
            // Mengambil nilai id_box yang dipilih
            let selectedNamaSupplier = $(this).val();
            // Melakukan permintaan AJAX ke controller untuk mendapatkan nomor batch
            $.ajax({
                url: `{{ route('prm_raw_material_input.getDataSupplier') }}`,
                method: 'GET',
                data: {
                    nama_supplier: selectedNamaSupplier
                },
                success: function(response) {
                    console.log(response);
                    let inisial_supplier = response.inisial_supplier;
                    // let created_at = response.created_at;
                    generateNomorNotaInternal(inisial_supplier);
                    // generateNomorNotaInternal(created_at);

                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });

        // idbox
        $('#jenis').on('change', function() {
            // Mengambil nilai id_box yang dipilih
            let selectedJenis = $(this).val();
            // Melakukan permintaan AJAX ke controller untuk mendapatkan nomor batch
            $.ajax({
                url: `{{ route('PrmRawMaterialInput.getDataJenis') }}`,
                method: 'GET',
                data: {
                    jenis: selectedJenis
                },
                success: function(response) {
                    console.log(response);
                    let jenis = response.jenis;
                    // let created_at = response.created_at;
                    generateIdBox(jenis);
                    // generateNomorNotaInternal(created_at);

                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });
        // generate nomor internal
        function generateNomorNotaInternal(inisial_supplier) {
            const nomorNotaSupplier = $('#nomor_nota_supplier').val();
            const namaSupplier = $('#nama_supplier').val();
            // ambil tanggal, bulan, tahun
            const now = new Date();
            const tahun = now.getFullYear().toString().substr(-2); // Ambil 2 digit terakhir tahun
            const bulan = ('0' + (now.getMonth() + 1)).slice(-2); // Menambah '0' jika satu digit
            const tanggal = ('0' + now.getDate()).slice(-2);

            // Membentuk nomor nota internal dengan menggabungkan nama supplier dan nomor nota supplier
            const nomorNotaInternal = `${inisial_supplier}_${nomorNotaSupplier}_${tanggal}${bulan}${tahun}`;
            // console.log(nomorNotaInternal);

            // Menampilkan nomor nota internal pada input nomor nota internal
            $('#nomor_nota_internal').val(nomorNotaInternal);

        }
        // generate ID_Box
        function generateIdBox(jenis) {
            const nomorNotaInternal = $('#nomor_nota_internal').val();
            const Jenis = $('#jenis').val();
            const hargaNota = $('#harga_nota').val();

            // Membentuk nomor nota internal dengan menggabungkan nama supplier dan nomor nota supplier
            const idBox = `${nomorNotaInternal}_${Jenis}_${hargaNota}`;
            // console.log(nomorNotaInternal);

            // Menampilkan nomor nota internal pada input nomor nota internal
            $('#id_box').val(idBox);

        }

        function updateSelisihBerat() {
            // Mendapatkan nilai berat nota dan berat bersih
            const beratNota = parseFloat($('#berat_nota').val());
            const beratBersih = parseFloat($('#berat_bersih').val());

            // Melakukan perhitungan selisih berat
            const selisihBerat = beratBersih - beratNota;

            // Memasukkan hasil perhitungan ke dalam input selisih berat
            $('#selisih_berat').val(isNaN(selisihBerat) ? '' : selisihBerat);
        }

        function updateTotalHarga() {
            // Mendapatkan nilai berat nota dan harga nota menggunakan jQuery
            const beratNota = parseFloat($('#berat_nota').val());
            const hargaNota = parseFloat($('#harga_nota').val());

            // Melakukan perhitungan total harga nota
            const totalHargaNota = beratNota * hargaNota;

            // Memasukkan hasil perhitungan ke dalam input total harga nota menggunakan jQuery
            $('#total_harga_nota').val(isNaN(totalHargaNota) ? '' : totalHargaNota.toFixed(2));
        }

        function updateHargaDeal() {
            // Mendapatkan nilai total harga nota dan berat bersih menggunakan jQuery
            const totalHargaNota = parseFloat($('#total_harga_nota').val());
            const beratBersih = parseFloat($('#berat_bersih').val());

            // Melakukan perhitungan harga deal
            const hargaDeal = beratBersih !== 0 ? totalHargaNota / beratBersih : 0;
            // const hargaDeal = totalHargaNota / beratBersih: 0;

            // Memasukkan hasil perhitungan ke dalam input harga deal menggunakan jQuery
            $('#harga_deal').val(isNaN(hargaDeal) ? '' : hargaDeal.toFixed(2));
        }
    </script>
@endsection
