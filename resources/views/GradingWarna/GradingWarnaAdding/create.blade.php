@extends('layouts.master1')
@section('menu')
    Grading Warna
@endsection
@section('title')
    Grading Warna Adding
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card mt-2 border border-primary border-3">
            <div class="card-header">
                <div class="d-flex align-items-center mb-3">
                    <h4 class="card-title">Grading Warna Adding</h4>
                </div>
                <hr>
                <form method="POST" class="row g-3" id="myForm">
                    <div class="col-md-4">
                        <label for="basic-usage" class="form-label">Nomor Job</label>
                        <select class="select2 form-select" style="width: 100%;" name="nomor_job" id="nomor_job"
                            data-placeholder="Pilih Nomor Job">
                            <option value="">Pilih Nomor Job</option>
                            @foreach ($grading_warna_penerimaan_stock as $item)
                                <option value="{{ $item->nomor_job }}">
                                    {{ $item->nomor_job }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Tujuan Kirim</label>
                        <input type="text" class="form-control" name="tujuan_kirim" id="tujuan_kirim" value="{{Auth::user()->plant}}" readonly>
                        {{-- <select class="select2 form-select" style="width: 100%;" name="tujuan_kirim" id="tujuan_kirim"
                            data-placeholder="Pilih Tujuan Kirim">
                            <option value="">Pilih Tujuan Kirim</option>
                            @foreach ($master_tujuan_kirim_moulding as $item)
                                <option value="{{ $item->inisial_tujuan }}">
                                    {{ $item->tujuan_kirim }}
                                </option>
                            @endforeach
                        </select> --}}
                    </div>

                    <div class="col-md-4">
                        <label for="user_created" class="form-label">NIP Admin</label>
                        <input type="text" class="form-control" id="user_created" readonly
                            value="{{ auth()->user()->nip }}">
                    </div>

                    <div class="col-md-4">
                        <label for="berat_kotor" class="form-label">Berat Kotor</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="berat_kotor" readonly>
                    </div>

                    <div class="col-md-4">
                        <label for="prosentase_susut" class="form-label">Presentase Susut</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="prosentase_susut" readonly>
                    </div>

                    <div class="col-md-4">
                        <label for="nomor_lot" class="form-label">Nomor Lot</label>
                        <input type="text" class="form-control" id="nomor_lot" readonly>
                    </div>

                    <div class="col-md-4">
                        <label for="berat_kotor_adding" class="form-label">Berat Kotor Adding</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="berat_kotor_adding">
                    </div>

                    <div class="col-md-4">
                        <label for="keterangan_2" class="form-label">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan_2">
                    </div>

                    <div class="col-md-4">
                        <label for="total_berat" class="form-label">Total Berat</label>
                        <input type="text" pattern="[0-9.]*" inputmode="numeric"
                            onkeypress="return (event.charCode >= 48 && event.charCode <= 57) || event.key === '.'"
                            class="form-control" id="total_berat" readonly>
                    </div>

                    <div class="col-12">
                        <button type="button" class="btn btn-primary" id="tambah_data" onclick="addRow()">Tambah</button>
                        <a href="{{ Route('GradingWarnaAdding.index') }}" type="button" class="btn btn-danger">Close</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card mt-2 border border-primary border-3">
            <div class="card-header">
                <div class="d-flex align-items-center mb-3">
                    <h4 class="card-title">Validasi Data</h4>
                </div>
                <div class="card-body" style="overflow: scroll" content="{{ csrf_token() }}">
                    <table class="table" id="dataTable">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">Nomor Job</th>
                                <th scope="col" class="text-center">Nomor BSTB</th>
                                <th scope="col" class="text-center">Nomor Batch</th>
                                <th scope="col" class="text-center">Tujuan Kirim</th>
                                <th scope="col" class="text-center">Keterangan</th>
                                <th scope="col" class="text-center">Berat Kotor</th>
                                <th scope="col" class="text-center">Jenis Grading</th>
                                <th scope="col" class="text-center">Berat 1 Grading</th>
                                <th scope="col" class="text-center">Pcs 1 Grading</th>
                                <th scope="col" class="text-center">Berat 2 Grading</th>
                                @role('admin')
                                <th scope="col" class="text-center">Modal</th>
                                <th scope="col" class="text-center">Total Modal</th>
                                @endrole
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card mt-2 border border-primary border-3">
            <div class="card-header">
                <div class="d-flex align-items-center mb-3">
                    <h4 class="card-title">Collect Data</h4>
                </div>
                <div class="card-body" style="overflow: scroll" content="{{ csrf_token() }}">
                    <table class="table" id="dataTableSend">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">Nomor Job</th>
                                <th scope="col" class="text-center">Nomor BSTB</th>
                                <th scope="col" class="text-center">Nomor Batch</th>
                                <th scope="col" class="text-center">Tujuan Kirim</th>
                                <th scope="col" class="text-center">Berat Kotor</th>
                                <th scope="col" class="text-center">Jenis Grading</th>
                                <th scope="col" class="text-center">Berat 1 Grading</th>
                                <th scope="col" class="text-center">Pcs 1 Grading</th>
                                <th scope="col" class="text-center">Berat 2 Grading</th>
                                @role('admin')
                                <th scope="col" class="text-center">Modal</th>
                                <th scope="col" class="text-center">Total Modal</th>
                                @endrole
                                <th scope="col" class="text-center">Nomor Lot</th>
                                <th scope="col" class="text-center">Nomor Kotor Adding</th>
                                <th scope="col" class="text-center">Prosentase Susut</th>
                                <th scope="col" class="text-center">Keterangan</th>
                                <th scope="col" class="text-center">NIP Admin</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="col-12 mt-3 text-end">
                    {{-- <button type="submit" class="btn btn-success" onclick="saveDataToArray()">Simpan</button> --}}
                    <button type="submit" class="btn btn-success" onclick="CeksendData()">Simpan</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        let dataArrayTemp = [];
        $(document).ready(function() {
            // $('#tujuan_kirim').on('change', function() {
            //     const selectedPlant = $(this).val();
            //     if (selectedPlant) { // Check if selectedPlant is not empty
            //         const nomorLOT = generateNomorLot(selectedPlant);
            //         $('#nomor_lot').val(nomorLOT);
            //     } else {
            //         $('#nomor_lot').val(''); // Clear nomor_grading if plant is empty
            //     }
            // });
            let selectedPlant =   $('#tujuan_kirim').val();
            let nomorLOT = generateNomorLot(selectedPlant);
            $('#nomor_lot').val(nomorLOT);

            // Generate Nomor LOT
            function generateNomorLot(selectedPlant) {
                const now = new Date();
                const tahun = now.getFullYear().toString().substr(-2);
                const bulan = ('0' + (now.getMonth() + 1)).slice(-2);
                const tanggal = ('0' + now.getDate()).slice(-2);
                const jam = ('0' + now.getHours()).slice(-2);
                const menit = ('0' + now.getMinutes()).slice(-2);
                const detik = ('0' + now.getSeconds()).slice(-2);

                const nomorLOT = `LOT_${tanggal}${bulan}${tahun}-${jam}${menit}${detik}_${selectedPlant}_UGW`;

                return nomorLOT;
            }

            // Get Nomor JOB
            $('#nomor_job').change(function() {
                var nomorJob = $(this).val();
                var dataTableBody = $('#dataTable tbody');

                if (nomorJob) {
                    var url = '{{ route('GradingWarnaAdding.getData', ['nomor_job' => ':nomor_job']) }}';
                    url = url.replace(':nomor_job', nomorJob);

                    $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            dataTableBody.empty(); // Clear existing rows

                            // var tujuanKirim = '';
                            var beratKotor = '';

                            if (data.length > 0) {
                                // tujuanKirim = data[0].tujuan_kirim;
                                beratKotor = data[0].berat_kotor;
                            }
                            $('#tujuan_kirim').val(data[0].tujuan_kirim).trigger('change')
                        

                            $.each(data, function(index, item) {
                                var row = `
                                <tr>
                                    <td class="text-center">${item.nomor_job}</td>
                                    <td class="text-center">${item.nomor_bstb}</td>
                                    <td class="text-center">${item.nomor_batch}</td>
                                    <td class="text-center">${item.tujuan_kirim}</td>
                                    <td class="text-center">${item.keterangan}</td>
                                    <td class="text-center">${item.berat_kotor}</td>
                                    <td class="text-center">${item.jenis_grading}</td>
                                    <td class="text-center">${item.berat_1_grading}</td>
                                    <td class="text-center">${item.pcs_1_grading}</td>
                                    <td class="text-center">${item.berat_2_grading}</td>
                                    <td class="text-center">${item.modal}</td>
                                    <td class="text-center">${item.total_modal}</td>
                                </tr>
                            `;
                                dataTableBody.append(row);
                                let dataPush = {
                                    nomor_job : item.nomor_job,
                                    nomor_bstb : item.nomor_bstb,
                                    nomor_batch : item.nomor_batch,
                                    tujuan_kirim : item.tujuan_kirim,
                                    keterangan : item.keterangan,
                                    berat_kotor : item.berat_kotor,
                                    jenis_grading : item.jenis_grading,
                                    pcs_1_grading : item.pcs_1_grading,
                                    berat_1_grading : item.berat_1_grading,
                                    berat_2_grading : item.berat_2_grading,
                                    modal : item.modal,
                                    total_modal : item.total_modal,
                                }
                              dataArrayTemp.push(dataPush)
                                
                            });
                           
                            $('#berat_kotor').val(beratKotor);
                            // $('#tujuan_kirim').val(tujuanKirim);

                            // var nomorLot = generateNomorLOT();
                            // $('#nomor_lot').val(nomorLot);

                            $('#prosentase_susut').val('100%');
                            $('#berat_kotor_adding').val('');

                        },
                        error: function(error) {
                            console.error('Error:', error);
                        }
                    });
                } else {
                    // Clear Data
                    dataTableBody.empty();
                    $('#berat_kotor').val('');
                    // $('#tujuan_kirim').val('');
                    $('#prosentase_susut').val('');
                    // $('#nomor_lot').prop('readonly', true);
                }
            });

            // Prosentase Susut
            $('#berat_kotor_adding').on('input', function() {
                var beratKotor = parseFloat($('#berat_kotor').val()) || 0;
                var beratKotorAdding = parseFloat($(this).val()) || 0;

                // if (beratKotorAdding > beratKotor) {
                //     // Tampilkan pesan peringatan jika berat_kotor_adding lebih besar atau sama dengan berat_kotor
                //     Swal.fire({
                //         icon: 'error',
                //         title: 'Oops...',
                //         text: 'Berat Kotor Adding tidak boleh lebih besar dari Berat Kotor.',
                //     });

                //     // Kosongkan input berat_kotor_adding
                //     $(this).val('');
                //     // Kosongkan nilai prosentase_susut
                //     $('#prosentase_susut').val('');
                // } else {
                    // Hitung prosentase susut
                    if (beratKotor != 0 && !isNaN(beratKotor) && !isNaN(beratKotorAdding) && beratKotor != 0) {
                        var presentaseSusut = 100 - ((beratKotorAdding / beratKotor) * 100);
                        $('#prosentase_susut').val(presentaseSusut.toFixed(2) + '%');
                    } else {
                        $('#prosentase_susut').val(0);
                    }
                // }
            });
        });

        // Hitung Total Berat
        function hitungTotalBerat() {
            let totalBerat = 0;
            dataArray.forEach(v => {
                let beratGrading = v.berat_1_grading !== 0 ? v.berat_1_grading : v.berat_2_grading;
                totalBerat += beratGrading;
            });

            $('#total_berat').val(totalBerat);
        }
        // Hitung Total Berat
        function hitungTotalModal() {
            let totalBerat = 0;

            $('#dataTableSend tbody tr').each(function() {
                // Mendapatkan nilai berat_1_grading dan berat_2_grading dari baris saat ini
                let berat1Grading = parseFloat($(this).find('td:eq(6)').text()) || 0;
                let berat2Grading = parseFloat($(this).find('td:eq(8)').text()) || 0;

                // Jika berat_1_grading 0, gunakan berat_2_grading
                let beratGrading = berat1Grading !== 0 ? berat1Grading : berat2Grading;

                totalBerat += beratGrading;
            });

            $('#total_berat').val(totalBerat);
        }

        // Validasi Data
        function validateForm() {
            // Mendefinisikan variabel untuk menyimpan kolom yang belum diisi
            let emptyFields = [];

            // Mendapatkan nilai dari semua input
            let nomor_job = $('#nomor_job').val();
            let tujuan_kirim = $('#tujuan_kirim').val();
            let berat_kotor = $('#berat_kotor').val();
            let prosentase_susut = $('#prosentase_susut').val();
            let berat_kotor_adding = $('#berat_kotor_adding').val();
            let nomor_lot = $('#nomor_lot').val();

            // Memeriksa setiap input, dan jika kosong, tambahkan ke daftar kolom yang belum diisi
            if (!nomor_job) emptyFields.push('Nomor Job');
            // if (!tujuan_kirim) emptyFields.push('Tujuan Kirim');
            if (!tujuan_kirim) emptyFields.push('Plant');
            if (!berat_kotor) emptyFields.push('Berat Kotor');
            if (!prosentase_susut) emptyFields.push('Presentase Susut');
            if (!berat_kotor_adding) emptyFields.push('Berat Kotor Adding');
            if (!nomor_lot) emptyFields.push('Nomor Lot');
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

        // Add Table
        let dataArray = [];

        function addRow() {
            if (validateForm()) {
                let dataTableBody = $('#dataTable tbody');
                let dataTableSendBody = $('#dataTableSend tbody');

                // Loop through each row in dataTable
                dataArrayTemp.forEach(v => {

                    let nomor_job = v.nomor_job
                    let nomor_bstb = v.nomor_bstb;
                    let nomor_batch = v.nomor_batch;
                    let tujuan_kirim = v.tujuan_kirim;
                    let berat_kotor = v.berat_kotor;
                    let jenis_grading = v.jenis_grading;
                    let berat_1_grading = v.berat_1_grading;
                    let pcs_1_grading =  v.pcs_1_grading;
                    let berat_2_grading =  v.berat_2_grading;
                    let modal =v.modal;
                    let total_modal =v.total_modal;
                    let nomor_lot = $('#nomor_lot').val();
                    let berat_kotor_adding = $('#berat_kotor_adding').val();
                    let prosentase_susut = $('#prosentase_susut').val();
                    let keterangan = $('#keterangan_2').val() ?? '';
                    let user_created = $('#user_created').val();

                    // Hapus Nomor Job
                    $('#nomor_job option[value="' + nomor_job + '"]').remove();

                    let newRow = `
                        <tr>
                            <td class="text-center">${nomor_job}</td>
                            <td class="text-center">${nomor_bstb}</td>
                            <td class="text-center">${nomor_batch}</td>
                            <td class="text-center">${tujuan_kirim}</td>
                            <td class="text-center">${berat_kotor}</td>
                            <td class="text-center">${jenis_grading}</td>
                            <td class="text-center">${berat_1_grading}</td>
                            <td class="text-center">${pcs_1_grading}</td>
                            <td class="text-center">${berat_2_grading}</td>
                            <td class="text-center">${modal}</td>
                            <td class="text-center">${total_modal}</td>
                            <td class="text-center">${nomor_lot}</td>
                            <td class="text-center">${berat_kotor_adding}</td>
                            <td class="text-center">${prosentase_susut}</td>
                            <td class="text-center">${keterangan}</td>
                            <td class="text-center">${user_created}</td>
                            <td class="text-center"><button class="btn btn-danger" onclick="hapusBaris(this)">Delete</button></td>
                        </tr>
                    `;

                    dataTableSendBody.append(newRow);
                   
                    let dataPush = {
                        nomor_job : v.nomor_job,
                        nomor_bstb : v.nomor_bstb,
                        nomor_batch : v.nomor_batch,
                        tujuan_kirim : v.tujuan_kirim,
                        keterangan : v.keterangan,
                        berat_kotor : v.berat_kotor,
                        jenis_grading : v.jenis_grading,
                        pcs_1_grading :v.pcs_1_grading,
                        berat_1_grading : v.berat_1_grading,
                        berat_2_grading : v.berat_2_grading,
                        modal : v.modal,
                        total_modal : v.total_modal,
                        berat_kotor_adding : berat_kotor_adding,
                        nomor_lot : nomor_lot,
                        prosentase_susut : prosentase_susut.replace('%', ''),
                        keterangan : keterangan,
                        user_created : user_created

                    };
                    dataArray.push(dataPush);
                    

                });
                dataArrayTemp = [];
                hitungTotalBerat();

                // Kosongkan nilai dropdown nomor_job dan input lainnya setelah data ditambahkan
                $('#nomor_job').val(null).trigger('change');
                $('#tujuan_kirim').prop('disabled', true);
                // $('#tujuan_kirim').val('');
                $('#berat_kotor').val('');
                $('#berat_kotor_adding').val('');
                $('#prosentase_susut').val('');
                $('#keterangan_2').val('');
            }
        }

        // Hapus Baris
        function hapusBaris(button) {
            // Dapatkan elemen baris terkait dengan tombol delete yang diklik
            let row = $(button).closest('tr');

            // Dapatkan nomor_job dari baris yang dihapus
            let nomorJobDihapus = row.find('td:eq(0)').text();

            // Buat kembali opsi nomor_job yang dihapus dan tambahkan ke dalam dropdown
            $('#nomor_job').append('<option value="' + nomorJobDihapus + '">' + nomorJobDihapus + '</option>');

            // Urutkan opsi nomor_job dalam dropdown
            let options = $('#nomor_job option');
            options.detach().sort(function(a, b) {
                let at = $(a).text();
                let bt = $(b).text();
                return (at > bt) ? 1 : ((at < bt) ? -1 : 0);
            });
            $('#nomor_job').append(options);

            // Hapus semua baris dengan nomor_job yang sama dari tabel
            $('#dataTableSend tbody tr').each(function() {
                if ($(this).find('td:eq(0)').text() === nomorJobDihapus) {
                    $(this).remove();
                }
            });

            // Hapus semua entri dalam dataArray dengan nomor_job yang sama
            dataArray = dataArray.filter(function(item) {
                return item.nomor_job !== nomorJobDihapus;
            });

            // Cek apakah tabel tidak memiliki baris data lagi
            if ($('#dataTableSend tbody tr').length === 0) {
                $('#nomor_job').val(null).trigger('change');
                // $('#tujuan_kirim').prop('disabled', false).val(null).trigger('change');
                $('#nomor_lot').val('');
                $('#berat_kotor').val('');
                $('#berat_kotor_adding').val('');
                $('#prosentase_susut').val('');
                $('#keterangan_2').val('');

                hitungTotalBerat();
            } else {
                hitungTotalBerat();
            }
        }

        function CeksendData() {
            var idNomorJob = dataArray.map(item => item.nomor_job); // Array untuk menyimpan id box yang akan dicek

            // Mengirimkan permintaan AJAX untuk memeriksa ketersediaan id box
            $.ajax({
                url: `{{ route('GradingWarnaAdding.CeksendData') }}`,
                method: 'POST',
                data: {
                    idNomorJob: JSON.stringify(idNomorJob),
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(response) {
                    var unavailableNomorJob = response.unavailableNomorJob;

                    if (unavailableNomorJob.length > 0) {
                        // Ada id box yang tidak tersedia, tampilkan pesan kesalahan
                        Swal.fire({
                            title: 'Error!',
                            text: 'Beberapa nomor job sudah tidak tersedia.',
                            icon: 'error',
                            showCancelButton: false,
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    } else {
                        sendData();
                    }
                },
                error: function(error) {
                    Swal.fire({
                        title: 'Failed!',
                        text: 'Terjadi kesalahan saat memeriksa ketersediaan nomor job. Silakan coba lagi.',
                        icon: 'error'
                    });
                    console.log('Error:', error);
                }
            });

            function sendData() {

                // dataArray = []; // Kosongkan dataArray terlebih dahulu


    //modal =  total modal / total berat
                        // total modal = sum total modal adding
                console.log(dataArray);
                let SumTotalModal = 0;
                dataArray.forEach(element => {
                    SumTotalModal+= element.total_modal
                });
                // Mengirim data ke server menggunakan AJAX
                $.ajax({
                    url: '{{ route('GradingWarnaAdding.store') }}',
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
                        SumTotalModal : SumTotalModal,
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
        }
    </script>
@endsection
