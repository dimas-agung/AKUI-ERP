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
                                            <input type="text" id="doc_no"
                                                class="form-control @error('doc_no') is-invalid @enderror" name="doc_no"
                                                value="{{ old('doc_no') }}" placeholder="Masukkan Nomer Dokument">
                                            <!-- error message untuk title -->
                                            @error('doc_no')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Nomor BTSB</label>
                                            <input type="text" id="nomor_bstb"
                                                class="form-control @error('nomor_bstb') is-invalid @enderror"
                                                name="nomor_bstb" value="{{ old('nomor_bstb') }}"
                                                placeholder="Masukkan nomor_bstb">
                                            <!-- error message untuk title -->
                                            @error('nomor_bstb')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 pr-0">
                                        <div class="form-group">
                                            <label>NIP Admin</label>
                                            <input type="text" id="user_created"
                                                class="form-control @error('user_created') is-invalid @enderror"
                                                name="user_created" value="{{ old('user_created') }}"
                                                placeholder="Masukkan User Created">
                                            <!-- error message untuk title -->
                                            @error('user_created')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>User Updated</label>
                                            <input type="text" id="user_updated"
                                                class="form-control @error('user_updated') is-invalid @enderror"
                                                name="user_updated" value="{{ old('user_updated') }}"
                                                placeholder="Masukkan User Updated">
                                            <!-- error message untuk title -->
                                            @error('user_updated')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="text-center">Keterangan</label>
                                            <input type="text" id="keterangan"
                                                class="form-control @error('keterangan') is-invalid @enderror"
                                                name="keterangan" value="{{ old('keterangan') }}"
                                                placeholder="Masukkan keterangan">
                                            <!-- error message untuk title -->
                                            @error('keterangan')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
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
                                                onchange="handleChange(this.{{ old('nomor_batch') }})"
                                                placeholder="Masukkan nomor batch">
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Supplier</label>
                                            <input type="text" class="form-control" id="nama_supplier"
                                                name="nama_supplier"
                                                onchange="handleChange(this.{{ old('nama_supplier') }})"
                                                placeholder="Masukkan nama supplier">
                                        </div>
                                        <div class="form-group">
                                            <label>Jenis</label>
                                            <input type="text" class="form-control" id="jenis" name="jenis"
                                                onchange="handleChange(this.{{ old('jenis') }})"
                                                placeholder="Masukkan jenis">
                                        </div>
                                    </div>
                                    <div class="col-md-4 pr-0">
                                        <div class="form-group">
                                            <label>Kadar Air</label>
                                            <input type="text" class="form-control" id="kadar_air" name="kadar_air"
                                                onchange="handleChange(this.{{ old('kadar_air') }})"
                                                placeholder="Masukkan kadar air">
                                        </div>
                                        <div class="form-group">
                                            <label>Berat</label>
                                            <input type="text" id="berat"
                                                class="form-control @error('berat') is-invalid @enderror" name="berat"
                                                value="{{ old('berat') }}" placeholder="Masukkan berat">
                                            <!-- error message untuk title -->
                                            @error('berat')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Tujuan Kirim</label>
                                            <input type="text" id="tujuan_kirim"
                                                class="form-control @error('tujuan_kirim') is-invalid @enderror"
                                                name="tujuan_kirim" value="{{ old('tujuan_kirim') }}"
                                                placeholder="Masukkan tujuan kirim">
                                            <!-- error message untuk title -->
                                            @error('tujuan_kirim')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Letak Tujuan</label>
                                            <input type="text" id="letak_tujuan"
                                                class="form-control @error('letak_tujuan') is-invalid @enderror"
                                                name="letak_tujuan" value="{{ old('letak_tujuan') }}"
                                                placeholder="Masukkan letak tujuan">
                                            <!-- error message untuk title -->
                                            @error('letak_tujuan')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4 pr-0">
                                        <div class="form-group">
                                            <label>Inisial Tujuan</label>
                                            <input type="text" id="inisial_tujuan"
                                                class="form-control @error('inisial_tujuan') is-invalid @enderror"
                                                name="inisial_tujuan" value="{{ old('inisial_tujuan') }}"
                                                placeholder="Masukkan inisial tujuan">
                                            <!-- error message untuk title -->
                                            @error('inisial_tujuan')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Modal</label>
                                            <input type="text" id="modal"
                                                class="form-control @error('modal') is-invalid @enderror" name="modal"
                                                value="{{ old('modal') }}" placeholder="Masukkan modal">
                                            <!-- error message untuk title -->
                                            @error('modal')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Total Modal</label>
                                            <input type="text" id="total_modal"
                                                class="form-control @error('total_modal') is-invalid @enderror"
                                                name="total_modal" value="{{ old('total_modal') }}"
                                                placeholder="Masukkan total modal">
                                            <!-- error message untuk title -->
                                            @error('total_modal')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <input type="text" id="keterangan_item"
                                                class="form-control @error('keterangan_item') is-invalid @enderror"
                                                name="keterangan_item" value="{{ old('keterangan_item') }}"
                                                placeholder="Masukkan keterangan">
                                            <!-- error message untuk title -->
                                            @error('keterangan_item')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
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
                                        <th class="text-center">Berat</th>
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
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        });

        var dataArray = [];
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
            var berat = $('#berat').val();
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
                '</td><td>' + nama_supplier + '</td><td>' + jenis + '</td><td>' + berat + '</td><td>' + kadar_air +
                '</td><td>' + tujuan_kirim + '</td><td>' + letak_tujuan + '</td><td>' + inisial_tujuan + '</td><td>' +
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
                berat: berat,
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
            console.log(dataArray);
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
            $('#nama_supplier').val('');
            $('#jenis').val('');
            $('#berat').val('');
            $('#kadar_air').val('');
            $('#tujuan_kirim').val('');
            $('#letak_tujuan').val('');
            $('#inisial_tujuan').val('');
            $('#modal').val('');
            $('#total_modal').val('');
            $('#keterangan_item').val('');
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
                    dataHeader: JSON.stringify(dataHeader),
                    // _token: $('meta[name="csrf-token"]').attr('content')
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json', // payload is json,
                success: function(response) {
                    alert('Success: ' + response.message); // Tampilkan pesan berhasil
                    window.location.href = response.redirectTo; // Redirect ke halaman lain
                },
                error: function(error) {
                    // console.error('Error sending data:', error);
                    // console.error('Error: ' + response.error);
                    console.error('Error:', response);
                    console.log('Validation Errors:', response.responseJSON.errors);
                }
            });

            // Membersihkan array setelah data dikirim
            // dataArray = [];
        }
    </script>
@endsection
