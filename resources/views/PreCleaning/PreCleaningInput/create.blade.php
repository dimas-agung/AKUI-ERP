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
                                    <button type="submit" class="btn btn-primary">Add</button>
                                    <a href="{{ url('/PreCleaningInput') }}" type="button" class="btn btn-danger"
                                        data-dismiss="modal">Close</a>
                                </div>
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
        var dataStock = [];

        // Mendefinisikan array jika belum
        if (typeof dataArray === 'undefined') {
            var dataArray = [];
        }
    </script>
@endsection
