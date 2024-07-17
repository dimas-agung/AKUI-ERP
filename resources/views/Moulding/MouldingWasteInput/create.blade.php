@extends('layouts.master1')
@section('menu')
    Moulding
@endsection
@section('title')
    Moulding Waste Input
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card mt-2 border border-primary border-3">
            <div class="card-header">
                <div class="d-flex align-items-center mb-3">
                    <h4 class="card-title">Moulding Waste Input</h4>
                </div>
                <hr>
                <form method="POST" class="row g-3" id="myForm">
                    <div class="col-md-4">
                        <label for="tanggal_moulding" class="form-label">Tanggal Moulding</label>
                        <input type="date" class="form-control" id="tanggal_moulding">
                    </div>

                    <div class="col-md-4">
                        <label for="basic-usage" class="form-label">Jenis Waste</label>
                        <select class="select2 form-select" style="width: 100%;" tabindex="-1" aria-hidden="true"
                            name="jenis_waste" id="jenis_waste" data-placeholder="Pilih Jenis Grading">
                            <option value="">Jenis Waste</option>
                            @foreach ($master_jenis_waste as $item)
                                <option value="{{ $item->jenis }}">
                                    {{ $item->jenis }}
                                </option>
                            @endforeach
                        </select>
                        <input type="hidden" id="harga_estimasi" name="harga_estimasi" readonly>
                        <input type="hidden" id="modal" name="modal" readonly>
                        <input type="hidden" id="total_modal" name="total_modal" readonly>
                        <input type="hidden" id="plant" value="{{ auth()->user()->plant }}" readonly>
                    </div>

                    <div class="col-md-4">
                        <label for="user_created" class="form-label">NIP Admin</label>
                        <input type="text" class="form-control" id="user_created" readonly
                            value="{{ auth()->user()->nip }}">
                    </div>

                    <div class="col-md-3">
                        <label for="id_box_waste_moulding" class="form-label">Id Box Waste Moulding</label>
                        <input type="text" class="form-control" id="id_box_waste_moulding" readonly>
                    </div>

                    <div class="col-md-3">
                        <label for="berat" class="form-label">Berat</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="berat">
                    </div>

                    <div class="col-md-3">
                        <label for="pcs" class="form-label">Pcs</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="pcs">
                    </div>

                    <div class="col-md-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan">
                    </div>

                    <div class="col-12">
                        <button type="button" class="btn btn-primary" id="tambah_data" onclick="addRow()">Tambah</button>
                        <a href="{{ Route('MouldingWasteInput.index') }}" type="button" class="btn btn-danger">Close</a>

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
                                <th scope="col" class="text-center">Tanggal Cabut</th>
                                <th scope="col" class="text-center">Jenis Waste</th>
                                <th scope="col" class="text-center">Harga Estimasi</th>
                                <th scope="col" class="text-center">Id Box Waste Moulding</th>
                                <th scope="col" class="text-center">Berat</th>
                                <th scope="col" class="text-center">Pcs</th>
                                <th scope="col" class="text-center">Modal</th>
                                <th scope="col" class="text-center">Total Modal</th>
                                <th scope="col" class="text-center">Keterangan</th>
                                <th scope="col" class="text-center">NIP Admin</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="col-12 mt-2 text-end">
                    <button type="submit" class="btn btn-success" onclick="sendData()">Simpan</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        // DropDown Jenis
        $(document).ready(function() {
            let selectedJenis = '';

            $('#jenis_waste').on('change', function() {
                selectedJenis = $(this).val();

                $.ajax({
                    url: '{{ route('MouldingWasteInput.setJenis') }}',
                    method: 'GET',
                    data: {
                        jenis_waste: selectedJenis
                    },
                    success: function(response) {
                        console.log(response);

                        // Mengatur nilai Kategori Susut sesuai dengan respons dari server
                        $('#kategori_susut').val(response.kategori_susut);
                        $('#harga_estimasi').val(response.harga_estimasi);
                        $('#modal').val(response.harga_estimasi);

                        // Update total modal setelah modal diperbarui
                        updateTotalModal();
                        generateIdBoxWasteMoulding();
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            });

            $('#berat').on('input', function() {
                updateTotalModal();
            });

            function generateIdBoxWasteMoulding() {
                const plant = '{{ auth()->user()->plant }}';
                if (selectedJenis && plant) {
                    $('#id_box_waste_moulding').val(`${selectedJenis}_${plant}`);
                } else {
                    $('#id_box_waste_moulding').val('');
                }
            }

            function updateTotalModal() {
                const modal = parseFloat($('#modal').val()) || 0;
                const berat = parseFloat($('#berat').val()) || 0;
                const totalModal = modal * berat;

                $('#total_modal').val(totalModal.toFixed(2)); // Mengatur total modal dengan 2 desimal
            }
        });

        // Validasi
        function validateForm() {
            // Mendefinisikan variabel untuk menyimpan kolom yang belum diisi
            let emptyFields = [];

            // Mendapatkan nilai dari semua input
            let tanggal_moulding = $('#tanggal_moulding').val();
            let jenis_waste = $('#jenis_waste').val();
            let harga_estimasi = $('#harga_estimasi').val();
            let id_box_waste_moulding = $('#id_box_waste_moulding').val();
            let plant = $('#plant').val();
            let berat = $('#berat').val();
            let pcs = $('#pcs').val();
            let modal = $('#modal').val();
            let total_modal = $('#total_modal').val();
            let user_created = $('#user_created').val();

            // Memeriksa setiap input, dan jika kosong, tambahkan ke daftar kolom yang belum diisi
            if (!tanggal_moulding) emptyFields.push('Tanggal Cabut');
            if (!jenis_waste) emptyFields.push('Jenis Waste');
            if (!harga_estimasi) emptyFields.push('Harga Estimasi');
            if (!id_box_waste_moulding) emptyFields.push('Id Box Waste Moulding');
            if (!plant) emptyFields.push('Plant');
            if (!berat) emptyFields.push('Berat');
            if (!pcs) emptyFields.push('Pcs');
            if (!modal) emptyFields.push('Modal');
            if (!total_modal) emptyFields.push('Total Modal');
            if (!user_created) emptyFields.push('NIP Admin');

            // Jika daftar kolom yang belum diisi tidak kosong, tampilkan pesan peringatan
            if (emptyFields.length > 0) {
                Swal.fire({
                    title: 'Warning!',
                    html: "Harap isi kolom berikut: <br>" + emptyFields.join('<br>'),
                    icon: 'warning'
                });
                return false;
            } else {
                return true; // Form valid
            }
        }

        // ADD ROW
        let dataArray = [];

        function addRow() {
            if (validateForm()) {
                let tanggal_moulding = $('#tanggal_moulding').val();
                let jenis_waste = $('#jenis_waste').val();
                let harga_estimasi = $('#harga_estimasi').val();
                let id_box_waste_moulding = $('#id_box_waste_moulding').val();
                let plant = $('#plant').val();
                let berat = $('#berat').val();
                let pcs = $('#pcs').val();
                let modal = $('#modal').val();
                let total_modal = $('#total_modal').val();
                let keterangan = $('#keterangan').val();
                let user_created = $('#user_created').val();

                let newRow = `<tr>` +
                    `<td class="text-center">${tanggal_moulding}</td>` +
                    `<td class="text-center">${jenis_waste}</td>` +
                    `<td class="text-center">${harga_estimasi}</td>` +
                    `<td class="text-center">${id_box_waste_moulding}</td>` +
                    `<td class="text-center">${berat}</td>` +
                    `<td class="text-center">${pcs}</td>` +
                    `<td class="text-center">${modal}</td>` +
                    `<td class="text-center">${total_modal}</td>` +
                    `<td class="text-center">${keterangan}</td>` +
                    `<td class="text-center">${user_created}</td>` +
                    `<td class="text-center"><button class="btn btn-danger" onclick="hapusBaris(this)">Delete</button></td>` +
                    `</tr>`;
                // Tambahkan Kedalam Tabel
                $('#dataTable tbody').append(newRow);

                $('#tanggal_moulding').prop('disabled', true);

                dataArray.push({
                    tanggal_moulding: tanggal_moulding,
                    jenis_waste: jenis_waste,
                    harga_estimasi: harga_estimasi,
                    id_box_waste_moulding: id_box_waste_moulding,
                    plant: plant,
                    berat: berat,
                    pcs: pcs,
                    modal: modal,
                    total_modal: total_modal,
                    keterangan: keterangan,
                    user_created: user_created,
                });
                console.log(dataArray);

                $('#jenis_waste').val(null).trigger('change');
                $('#harga_estimasi').val('');
                $('#id_box_waste_moulding').val('');
                $('#berat').val('');
                $('#pcs').val('');
                $('#modal').val('');
                $('#total_modal').val('');
                $('#keterangan').val('');
            }
        }

        // Hapus Baris
        function hapusBaris(button) {
            // Dapatkan elemen baris terkait dengan tombol delete yang diklik
            let row = $(button).closest('tr');

            // Hapus baris dari tabel
            row.remove();

            // Hapus baris dari dataArray berdasarkan indeks baris di tabel
            let rowIndex = row.index();
            dataArray.splice(rowIndex, 1);

            // Cek apakah tabel tidak memiliki baris data lagi
            if ($('#dataTable tbody tr').length === 0) {
                $('#tanggal_moulding').prop('disabled', false).val(null).trigger('change');
                $('#jenis_waste').val('');
                $('#harga_estimasi').val('');
                $('#id_box_waste_moulding').val('');
                $('#berat').val('');
                $('#pcs').val('');
                $('#modal').val('');
                $('#total_modal').val('');
                $('#keterangan').val('');

            } else {
                $('#jenis_waste').val('');
                $('#harga_estimasi').val('');
                $('#id_box_waste_moulding').val('');
                $('#berat').val('');
                $('#pcs').val('');
                $('#modal').val('');
                $('#total_modal').val('');
                $('#keterangan').val('');
            }
        }

        function sendData() {
            console.log("Isi data=", dataArray);
            // Cek apakah data kosong
            if (dataArray.length === 0) {
                // Menampilkan SweetAlert untuk pesan error
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Data dalam tabel masih kosong. Silakan tambahkan data terlebih dahulu.'
                });
                return; // Menghentikan eksekusi fungsi jika data kosong
            }
            // Mengirim data ke server menggunakan AJAX
            $.ajax({
                url: '{{ route('MouldingWasteInput.store') }}',
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
                    dataArray: JSON.stringify(dataArray),
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Data berhasil disimpan.',
                        icon: 'success'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = response.redirectTo;
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
