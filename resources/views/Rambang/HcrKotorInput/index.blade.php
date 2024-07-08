@extends('layouts.master1')
@section('menu')
    Rambang
@endsection
@section('title')
    Hcr Kotor Input
@endsection
@section('content')
    <div class="section">
        <div class="card border border-primary border-3">
            <div class="card-header">
                <div class="col-sm-12 d-flex justify-content-between">
                    <h4 class="card-title">Data Hcr Kotor Input</h4>
                    <div style="position: absolute;right: 25px;">
                        <a class="btn btn-outline-warning rounded-pill" style="margin-right: 10px" onclick="toggleFilter()">
                            <strong>Filter</strong>
                        </a>
                        <button class="btn btn-outline-success rounded-pill" data-bs-toggle="modal"
                            data-bs-target="#inlineForm" onclick="renderSelect2()">
                            <i class="fa fa-plus"></i>
                            Add Data
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body" style="overflow: auto;">
                <div id="filterRow" class="row mb-5 mt-3">
                    <div class="col-4">
                        <label class="form-label">Tanggal Mulai</label>
                        <div class="input-group">
                            <input type="date" class="form-control " placeholder="Filter by start date..."
                                id="filterInputStartDate">
                        </div>
                    </div>
                    <div class="col-4">
                        <label class="form-label">Tanggal Akhir</label>
                        <div class="input-group">
                            <input type="date" class="form-control " placeholder="Filter by end date..."
                                id="filterInputEndDate">
                        </div>
                    </div>

                    <div class="col-4 mt-3" style="margin-top: 10px">
                        <button type="button" class="btn btn-outline-success rounded-pill" onclick="applyFilter()">
                            <strong><i class="bi bi-funnel"></i> Apply Filter</strong>
                        </button>
                    </div>
                </div>
                {{-- Create Data --}}
                <div class="modal fade text-left border border-primary border-3" id="inlineForm" role="dialog"
                    aria-labelledby="myModalLabel33" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content border border-primary border-3">
                            <div class="modal-header">
                                <h5 class="modal-title" id="myModalLabel33">
                                    <span class="fw-mediumbold">
                                        Input</span>
                                    <span class="fw-light">
                                        Data Unit
                                    </span>
                                </h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('InputHcrKotor.store') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Tanggal Cabut</label>
                                                <input type="date" id="tgl_add"
                                                    class="form-control mb-3 flatpickr-date" name="tgl_add"
                                                    value="{{ old('tgl_add') }}" placeholder="Masukkan Tanggal Adding">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Jenis</label>
                                                <select id="jenis" class="select2 form-select" name="jenis">
                                                    <option></option>
                                                    @foreach ($jenis as $post)
                                                        <option value="{{ $post->jenis }}">
                                                            {{ $post->jenis }}</option>
                                                    @endforeach
                                                </select>
                                                <!-- error message untuk title -->
                                                @error('jenis')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group form-group-default">
                                                <label>Berat</label>
                                                <input id="berat" type="text"
                                                    class="form-control @error('nama') is-invalid @enderror" name="berat"
                                                    value="{{ old('berat') }}" placeholder="Masukkan berat">

                                                <!-- error message untuk title -->
                                                @error('berat')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group form-group-default">
                                                <label>Id Box Hcr Kotor</label>
                                                <input id="id_box" type="text"
                                                    class="form-control @error('nama') is-invalid @enderror" name="id_box"
                                                    value="{{ old('id_box') }}" placeholder="Masukkan Id Box Hcr Kotor"
                                                    readonly>

                                                <!-- error message untuk title -->
                                                @error('id_box')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group form-group-default">
                                                <label>keterangan</label>
                                                <input id="keterangan" type="text"
                                                    class="form-control @error('nama') is-invalid @enderror"
                                                    name="keterangan" value="{{ old('keterangan') }}"
                                                    placeholder="Masukkan keterangan">
                                                <input type="hidden" class="form-control" id="user_created"
                                                    name="user_created" value="{{ auth()->user()->nip }}" readonly>

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
                                <div class="modal-footer no-bd">
                                    <button type="submit" class="btn btn-primary">Add</button>
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="table1" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">No</th>
                                <th class="text-center" scope="col">Tanggal Cabut</th>
                                <th class="text-center" scope="col">Jenis Hcr Kotor</th>
                                <th class="text-center" scope="col">Berat Hcr Kotor</th>
                                <th class="text-center" scope="col">ID Box Hcr Kotor</th>
                                <th class="text-center" scope="col">Keterangan</th>
                                <th class="text-center" scope="col">NIP Admin</th>
                                <th class="text-center" scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($CBPenerimaan as $item)
                                <tr>
                                    <td class="text-center">{{ $i++ }}</td>
                                    <td class="text-center">{!! $item->tanggal_cabut !!}</td>
                                    <td class="text-center">{!! $item->jenis_hcr_kotor !!}</td>
                                    <td class="text-center">{!! $item->berat_hcr_kotor !!}</td>
                                    <td class="text-center">{!! $item->id_box_hcr_kotor !!}</td>
                                    <td class="text-center">{!! $item->keterangan !!}</td>
                                    <td class="text-center">{!! $item->user_created !!}</td>
                                    <td class="text-center">
                                        <div class="form-button-action">
                                            @if ($item->status == 1)
                                                <form style="display: flex" id="deleteForm{{ $item->id }}"
                                                    action="{{ route('InputHcrKotor.destroy', $item->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-link btn-danger"
                                                        data-original-title="Remove"
                                                        onclick="confirmDelete('{{ $item->id }}')">
                                                        <i class="bi bi-trash3 text-danger"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <div class="alert alert-danger">
                                    Data Hcr Kotor Input belum Tersedia.
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr('.flatpickr-date', {
                dateFormat: 'Y-m-d', // Format tanggal yang diinginkan
                enableTime: false, // Nonaktifkan waktu
                time_24hr: false // Gunakan format 12 jam jika diinginkan
            });
        });

        function renderSelect2() {
            $('.select2').select2({
                width: '100%',
                dropdownParent: $("#inlineForm")
            });
        }
        // Menambahkan event listener untuk perubahan pada input tanggal dan select plant
        $('#tgl_add, #jenis').change(function() {
            generateNomorGrading();
        });

        function generateNomorGrading() {
            const tanggal = $('#tgl_add').val();
            const jenis = $('#jenis').val();

            // Hanya lakukan generate jika kedua tanggal dan jenis sudah terpilih
            if (tanggal && jenis) {
                const now = new Date();
                const jam = ('0' + now.getHours()).slice(-2);
                const menit = ('0' + now.getMinutes()).slice(-2);
                const detik = ('0' + now.getSeconds()).slice(-2);

                // Memformat tanggal menjadi ddmmyy
                const formattedTanggal = formatDateToDdmmyy(tanggal);
                // Menggabungkan nilai-nilai tersebut untuk membentuk nomor grading
                const nomor_grading = `${formattedTanggal}_${jenis}`;
                // Menampilkan hasil di konsol (opsional)
                console.log(nomor_grading);
                // Menampilkan hasil di input nomor_grading
                $('#id_box').val(nomor_grading);
                return nomor_grading;
            }
        }

        function formatDateToDdmmyy(inputDate) {
            const date = new Date(inputDate);
            const day = ('0' + date.getDate()).slice(-2);
            const month = ('0' + (date.getMonth() + 1)).slice(-2);
            const year = date.getFullYear().toString().substr(-2);

            return `${day}${month}${year}`;
        }

        function confirmDelete(id) {
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Anda yakin ingin menghapus data ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika dikonfirmasi, submit form
                    document.getElementById('deleteForm' + id).submit();
                }
            });
        }
    </script>
    <script>
        function toggleFilter() {
            var filterRow = document.getElementById('filterRow');
            if (filterRow.style.display === 'none' || filterRow.style.display === '') {
                filterRow.style.display = 'flex';
            } else {
                filterRow.style.display = 'none';
            }
        }

        function applyFilter() {

            const start_date = document.getElementById('filterInputStartDate').value;
            const end_date = document.getElementById('filterInputEndDate').value;

            const filters = {
                start_date: start_date,
                end_date: end_date,
            };
            var url = '{{ route('PreCleaningInput.index') }}';

            // url = url.replace(':slug', slug);
            url = url + '?start_date=' + start_date + '&end_date=' + end_date;
            window.location.href = url;

        }
    </script>
@endsection
