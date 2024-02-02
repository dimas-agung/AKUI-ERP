@extends('layouts.master1')
{{-- @extends('layouts.template') --}}
@section('menu')
    Master
@endsection
@section('title')
    Master Operator
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card mt-2">
            <div class="card-body">
                <div class="card">
                    {{-- card header --}}
                    <div class="card-header">
                        <h5 class="card-title">
                            <div class="col-sm-12 d-flex justify-content-between">
                                Data Master Operator
                                <button href="{{ route('master_operator.create') }}" type="button"
                                    class="btn btn-outline-success rounded-pill" data-bs-toggle="modal"
                                    data-bs-target="#inlineForm">
                                    <strong><i class="bi bi-plus-circle"></i> Add Data <i
                                            class="bi bi-plus-circle"></i></strong>
                                </button>
                            </div>
                        </h5>
                    </div>
                    {{-- Modal Tambah --}}
                    <div class="modal fade text-left modal-borderless modal-lg" id="inlineForm" tabindex="-1"
                        role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h4 class="modal-title white" id="myModalLabel33">Input Data Master Operator</h4>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                                <form action="{{ route('master_operator.store') }}" method="POST">
                                    <div class="modal-body">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label><strong>Nama</strong></label>
                                                <div class="form-group">
                                                    <input type="text" name="nama" placeholder="Masukkan nama"
                                                        class="form-control @error('nama') is-invalid @enderror" required
                                                        oninvalid="this.setCustomValidity('Mohon isi nama')"
                                                        oninput="this.setCustomValidity('')">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label><strong>NIP</strong></label>
                                                <div class="form-group">
                                                    <input type="text" name="nip" placeholder="Masukan NIP"
                                                        class="form-control @error('nip') is-invalid @enderror" required
                                                        oninvalid="this.setCustomValidity('Mohon isi NIP')"
                                                        oninput="this.setCustomValidity('')">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label><strong>Plant</strong></label>
                                                <div class="form-group">
                                                    <input type="text" name="plant" placeholder="Masukan Plant"
                                                        class="form-control @error('plant') is-invalid @enderror" required
                                                        oninvalid="this.setCustomValidity('Mohon isi Plant')"
                                                        oninput="this.setCustomValidity('')">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label><strong>Divisi</strong></label>
                                                <div class="form-group">
                                                    <input type="text" name="divisi" placeholder="Masukan Divisi"
                                                        class="form-control @error('divisi') is-invalid @enderror" required
                                                        oninvalid="this.setCustomValidity('Mohon isi Divisi')"
                                                        oninput="this.setCustomValidity('')">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label><strong>Departemen</strong></label>
                                                <div class="form-group">
                                                    <input type="text" name="departemen" placeholder="Masukan Departemen"
                                                        class="form-control @error('departemen') is-invalid @enderror"
                                                        required oninvalid="this.setCustomValidity('Mohon isi Departemen')"
                                                        oninput="this.setCustomValidity('')">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label><strong>Bagian</strong></label>
                                                <div class="form-group">
                                                    <input type="text" name="bagian" placeholder="Masukan Bagian"
                                                        class="form-control @error('bagian') is-invalid @enderror" required
                                                        oninvalid="this.setCustomValidity('Mohon isi Bagian')"
                                                        oninput="this.setCustomValidity('')">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label><strong>Workstation</strong></label>
                                                <div class="form-group">
                                                    <input type="text" name="workstation"
                                                        placeholder="Masukan Workstation"
                                                        class="form-control @error('workstation') is-invalid @enderror"
                                                        required oninvalid="this.setCustomValidity('Mohon isi Workstation')"
                                                        oninput="this.setCustomValidity('')">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label><strong>Unit</strong></label>
                                                <div class="form-group">
                                                    <input type="text" name="unit" placeholder="Masukan Unit"
                                                        class="form-control @error('unit') is-invalid @enderror" required
                                                        oninvalid="this.setCustomValidity('Mohon isi Unit')"
                                                        oninput="this.setCustomValidity('')">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                {{-- <label><strong>Job</strong></label>
                                                <div class="form-group">
                                                    <input type="text" name="job" placeholder="Masukan Job"
                                                        class="form-control @error('job') is-invalid @enderror" required
                                                        oninvalid="this.setCustomValidity('Mohon isi Job')"
                                                        oninput="this.setCustomValidity('')">
                                                </div> --}}
                                                <label class="font-weight-bold">Job</label>
                                                <select class="form-control @error('job') is-invalid @enderror" required
                                                    name="job" oninvalid="this.setCustomValidity('Mohon Pilih Job')"
                                                    oninput="this.setCustomValidity('')">
                                                    <option></option>
                                                    <option value="Sikat + Kompresor">Sikat + Kompresor</option>
                                                    <option value="Flek + Poles">Flek + Poles</option>
                                                    <option value="Cutter">Cutter</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                            <i class="bx bx-x d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Batal</span>
                                        </button>
                                        <button type="submit" id="toast-success" class="btn btn-primary ms-1">
                                            <span id="toast-success" class="d-none d-sm-block">Tambah</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- card body --}}
                    <div class="card-body" style="overflow: auto;">
                        <div class="table-responsive">
                            <table id="table1" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">No</th>
                                        <th scope="col" class="text-center">Nama</th>
                                        <th scope="col" class="text-center">NIP</th>
                                        <th scope="col" class="text-center">Plant</th>
                                        <th scope="col" class="text-center">Divisi</th>
                                        <th scope="col" class="text-center">Departemen</th>
                                        <th scope="col" class="text-center">Bagian</th>
                                        <th scope="col" class="text-center">Workstation</th>
                                        <th scope="col" class="text-center">Unit</th>
                                        <th scope="col" class="text-center">Job</th>
                                        <th scope="col" class="text-center">Status</th>
                                        <th scope="col" class="text-center">Tanggal Buat</th>
                                        <th scope="col" class="text-center">Tanggal Update</th>
                                        <th scope="col" class="text-center">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($master_operators as $MasterOP)
                                        <tr>
                                            <td class="text-center">{{ $i++ }}</td>
                                            <td class="text-center">{{ $MasterOP->nama }}</td>
                                            <td class="text-center">{{ $MasterOP->nip }}</td>
                                            <td class="text-center">{{ $MasterOP->plant }}</td>
                                            <td class="text-center">{{ $MasterOP->divisi }}</td>
                                            <td class="text-center">{{ $MasterOP->departemen }}</td>
                                            <td class="text-center">{{ $MasterOP->bagian }}</td>
                                            <td class="text-center">{{ $MasterOP->workstation }}</td>
                                            <td class="text-center">{{ $MasterOP->unit }}</td>
                                            <td class="text-center">{{ $MasterOP->job }}</td>
                                            <td class="text-center">
                                                @if ($MasterOP->status == 1)
                                                    Aktif
                                                @else
                                                    Tidak Aktif
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $MasterOP->created_at }}</td>
                                            <td class="text-center">{{ $MasterOP->updated_at }}</td>
                                            <td class="text-center">
                                                <div class="form-button-action">
                                                    <form style="display: flex" id="deleteForm{{ $MasterOP->id }}"
                                                        action="{{ route('master_operator.destroy', $MasterOP->id) }}"
                                                        method="POST">
                                                        <a href="{{ route('master_operator.edit', $MasterOP->id) }}"
                                                            class="btn btn-link" title="Edit Task"
                                                            data-original-title="Edit Task">
                                                            <i class="bi bi-pencil-square text-success"></i>
                                                        </a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-link"
                                                            data-original-title="Remove"
                                                            onclick="confirmDelete({{ $MasterOP->id }})">
                                                            <i class="bi bi-trash3 text-danger"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <div class="alert alert-danger">
                                            Data Master Operator belum Tersedia.
                                        </div>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Konfirmasi',
            text: 'Anda yakin ingin menghapus data ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d61609',
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
