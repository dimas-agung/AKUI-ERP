@extends('layouts.master1')
@section('menu')
    Adjustment Adding
@endsection
@section('title')
    Adjustment Adding
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card mt-2 border border-primary border-3">
            <div class="card-header">
                <div class="d-flex align-items-center mb-3">
                    <h4 class="card-title">Adjustment Adding</h4>
                </div>
                <hr>
                <form method="POST" class="row g-3" id="myForm">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="basic-usage" class="form-label">ID Box Grading Halus</label>
                            <select class="select2 form-select" style="width: 100%;" name="id_box_grading_halus"
                                id="id_box_grading_halus" placeholder="Pilih ID Box Grading Halus">
                                <option value="">Pilih ID Box Grading Halus</option>
                                @foreach ($grading_halus_stocks as $GradingHS)
                                    <option value="{{ $GradingHS->id_box_grading_halus }}">
                                        {{ $GradingHS->id_box_grading_halus }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label>Plant</label>
                        <select class="select2 form-select" style="width: 100%;" name="plant" id="plant"
                            placeholder="Pilih ID Box Grading Halus">
                            <option value="">Pilih Plant</option>
                            @foreach ($perusahaan as $Perusahaans)
                                <option value="{{ $Perusahaans->plant }}">
                                    {{ $Perusahaans->plant }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="nomor_adjustment" class="form-label">Nomor Adjustment</label>
                        <input type="text" class="form-control" id="nomor_adjustment">
                    </div>
                    <div class="col-md-6">
                        <label for="nomor_batch" class="form-label">Nomor Batch</label>
                        <input type="text" class="form-control" id="nomor_batch" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="jenis_adding" class="form-label">Jenis Adding</label>
                        <input type="text" class="form-control" id="jenis_adding" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="sisa_berat" class="form-label">Sisa Berat</label>
                        <input type="text" class="form-control" id="sisa_berat" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="sisa_pcs" class="form-label">Sisa Pcs</label>
                        <input type="text" class="form-control" id="sisa_pcs" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="berat_adding" class="form-label">Berat Adding</label>
                        <input type="text" class="form-control" id="berat_adding">
                    </div>
                    <div class="col-md-4">
                        <label for="pcs_adding" class="form-label">Pcs Adding</label>
                        <input type="text" class="form-control" id="pcs_adding">
                    </div>
                    <div class="col-md-4">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan">
                    </div>
                    <div class="col-md-3">
                        <label for="modal" class="form-label">Modal</label>
                        <input type="text" class="form-control" id="modal" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="total_modal" class="form-label">Total Modal</label>
                        <input type="text" class="form-control" id="total_modal" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="total_berat" class="form-label">Total Berat</label>
                        <input type="text" class="form-control" id="total_berat" readonly>
                    </div>
                    <div class="col-md-3">
                        <label for="total_pcs" class="form-label">Total Pcs</label>
                        <input type="text" class="form-control" id="total_pcs" readonly>
                    </div>
                    <div class="col-12">
                        <button type="button" class="btn btn-primary" onclick="addRow()">Tambah</button>
                        {{-- <button type="submit" class="btn btn-warning" id="resetBtn">Reset</button> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card mt-2 border border-primary border-3">
            <div class="card-header">
                <div class="card-body" style="overflow: scroll">
                    <table class="table" id="dataTable">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">ID Box Grading Halus</th>
                                <th scope="col" class="text-center">Nomor Batch</th>
                                <th scope="col" class="text-center">Jenis Adding</th>
                                <th scope="col" class="text-center">Berat Adding</th>
                                <th scope="col" class="text-center">Pcs Adding</th>
                                <th scope="col" class="text-center">Keterangan</th>
                                <th scope="col" class="text-center">Modal</th>
                                <th scope="col" class="text-center">Total Modal</th>
                                <th scope="col" class="text-center">Nomor Adjustment</th>
                                <th scope="col" class="text-center">User Created</th>
                                <th scope="col" class="text-center">User Updated</th>
                                <th scope="col" class="text-center">Created At</th>
                                <th scope="col" class="text-center">Updated At</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="col-12 mt-2 text-end">
                    <button type="submit" class="btn btn-success" onclick="simpanData()">Simpan</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $('#id_box_grading_halus').on('change', function() {
            // Mengambil nilai id_box yang dipilih
            let selectedIdBoxGradingHalus = $(this).val();
            // Melakukan permintaan AJAX ke controller untuk mendapatkan nomor batch
            $.ajax({
                url: `{{ route('AdjustmentAdding.set') }}`,
                method: 'GET',
                data: {
                    id_box_grading_halus: selectedIdBoxGradingHalus
                },
                success: function(response) {
                    console.log(response);
                    // Mengatur nilai Nomor Batch sesuai dengan respons dari server
                    $('#nomor_batch').val(response.nomor_batch);
                    $('#jenis_adding').val(response.jenis);
                    $('#sisa_berat').val(response.sisa_berat);
                    $('#sisa_pcs').val(response.sisa_pcs);
                    $('#modal').val(response.modal);
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });
        $(document).ready(function() {
            // Menangani perubahan pada dropdown nomor_job
            $('#plant').on('change', function() {
                // Memanggil fungsi generateNomorGrading ketika nomor_job berubah
                generateNomorAdjustment();
            });

            // Fungsi untuk generate nomor_bstb
            function generateNomorAdjustment() {
                const now = new Date();
                const tahun = now.getFullYear().toString().substr(-2);
                const bulan = ('0' + (now.getMonth() + 1)).slice(-2);
                const tanggal = ('0' + now.getDate()).slice(-2);
                const jam = ('0' + now.getHours()).slice(-2);
                const menit = ('0' + now.getMinutes()).slice(-2);
                const detik = ('0' + now.getSeconds()).slice(-2);

                // Mengambil nilai dari dropdown nomor_job
                const plant = $('#plant').val();

                // Mengambil bagian ketiga (indeks 2) dari array hasil split
                // const bagianKetiga = nomorJobValue[2][0];

                // Menghasilkan nomor_bstb berdasarkan rumus yang diinginkan
                const nomor_adjustment = `ADJ_${tanggal}${bulan}${tahun}_${jam}${menit}${detik}_${plant}_UGH`;

                // Memasukkan nilai yang dihasilkan ke dalam input nomor_bstb
                $('#nomor_adjustment').val(nomor_adjustment);
                console.log(nomor_adjustment);
            }
        });
    </script>
@endsection
