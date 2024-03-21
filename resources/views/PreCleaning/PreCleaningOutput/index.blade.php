@extends('layouts.master1')
@section('menu')
    Pre Cleaning
@endsection
@section('title')
    Pre Cleaning Output
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card mt-2 border border-primary border-3">
            <div class="card-body">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            <div class="col-sm-12 d-flex justify-content-between">
                                Data Pre Cleaning Output
                                <button onclick="redirectToPage()" type="button" class="btn btn-outline-success rounded-pill">
                                    <strong><i class="bi bi-plus-circle"></i> Add Data <i
                                            class="bi bi-plus-circle"></i></strong>
                                </button>
                            </div>
                        </h5>
                    </div>
                    <div class="card-body" style="overflow: auto;">
                        <div class="table-responsive">
                            <table id="table1" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">No</th>
                                        {{-- <th scope="col" class="text-center">Doc NO</th> --}}
                                        <th scope="col" class="text-center">Nomor Job</th>
                                        <th scope="col" class="text-center">ID Box Grading Kasar</th>
                                        <th scope="col" class="text-center">Nomor BSTB</th>
                                        <th scope="col" class="text-center">ID Box Raw Material</th>
                                        <th scope="col" class="text-center">Nomor Batch</th>
                                        <th scope="col" class="text-center">Nomor Nota Internal</th>
                                        <th scope="col" class="text-center">Nama Supplier</th>
                                        <th scope="col" class="text-center">Jenis Raw Material</th>
                                        {{-- <th scope="col" class="text-center">Kadar Air</th> --}}
                                        <th scope="col" class="text-center">Jenis Kirim</th>
                                        <th scope="col" class="text-center">Berat Kirim</th>
                                        <th scope="col" class="text-center">Pcs Kirim</th>
                                        {{-- <th scope="col" class="text-center">Tujuan Kirim</th> --}}
                                        <th scope="col" class="text-center">Modal</th>
                                        <th scope="col" class="text-center">Total Modal</th>
                                        {{-- <th scope="col" class="text-center">Sisa Berat</th> --}}
                                        {{-- <th scope="col" class="text-center">Sisa Berat</th> --}}
                                        <th scope="col" class="text-center">Operator Flek & Kompresor</th>
                                        <th scope="col" class="text-center">Operator Flek & Poles</th>
                                        <th scope="col" class="text-center">Operator Cutter</th>
                                        <th scope="col" class="text-center">Kuningan</th>
                                        <th scope="col" class="text-center">Sterofoam</th>
                                        <th scope="col" class="text-center">Karat</th>
                                        <th scope="col" class="text-center">Rontokan Fisik</th>
                                        <th scope="col" class="text-center">Rontokan Bahan</th>
                                        <th scope="col" class="text-center">Rontokan Serabut</th>
                                        <th scope="col" class="text-center">WS-0-0-0</th>
                                        <th scope="col" class="text-center">Berat Pre Cleaning</th>
                                        <th scope="col" class="text-center">Pcs</th>
                                        <th scope="col" class="text-center">Susut</th>
                                        <th scope="col" class="text-center">User Created</th>
                                        <th scope="col" class="text-center">User Updated</th>
                                        <th scope="col" class="text-center">Created At</th>
                                        <th scope="col" class="text-center">Updated At</th>
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($pre_cleaning_outputs as $PCO)
                                        <tr>
                                            <td class="text-center">{{ $i++ }}</td>
                                            {{-- <td class="text-center">{{ $PCO->doc_no }}</td> --}}
                                            <td class="text-center">{{ $PCO->nomor_job }}</td>
                                            <td class="text-center">{{ $PCO->id_box_grading_kasar }}</td>
                                            <td class="text-center">{{ $PCO->nomor_bstb }}</td>
                                            <td class="text-center">{{ $PCO->id_box_raw_material }}</td>
                                            <td class="text-center">{{ $PCO->nomor_batch }}</td>
                                            <td class="text-center">{{ $PCO->nomor_nota_internal }}</td>
                                            <td class="text-center">{{ $PCO->nama_supplier }}</td>
                                            <td class="text-center">{{ $PCO->jenis_raw_material }}</td>
                                            {{-- <td class="text-center">{{ $PCO->kadar_air }}</td> --}}
                                            <td class="text-center">{{ $PCO->jenis_kirim }}</td>
                                            {{-- <td class="text-center">{{ $PCO->berat_kirim }}</td> --}}
                                            <td class="text-center">{{ number_format($PCO->berat_kirim, 0, ',', '.') }}
                                            </td>
                                            {{-- <td class="text-center">{{ $PCO->pcs_kirim }}</td> --}}
                                            <td class="text-center">{{ number_format($PCO->pcs_kirim, 0, ',', '.') }}</td>
                                            {{-- <td class="text-center">{{ $PCO->tujuan_kirim }}</td> --}}
                                            {{-- <td class="text-center">{{ $PCO->modal }}</td> --}}
                                            <td class="text-center">{{ number_format($PCO->modal, 2, ',', '.') }}</td>
                                            {{-- <td class="text-center">{{ $PCO->total_modal }}</td> --}}
                                            <td class="text-center">{{ number_format($PCO->total_modal, 2, ',', '.') }}
                                            </td>
                                            <td class="text-center">{{ $PCO->operator_sikat_n_kompresor }}</td>
                                            <td class="text-center">{{ $PCO->operator_flek_n_poles }}</td>
                                            <td class="text-center">{{ $PCO->operator_cutter }}</td>
                                            {{-- <td class="text-center">{{ $PCO->kuningan }}</td> --}}
                                            <td class="text-center">{{ number_format($PCO->kuningan, 0, ',', '.') }}</td>
                                            {{-- <td class="text-center">{{ $PCO->sterofoam }}</td> --}}
                                            <td class="text-center">{{ number_format($PCO->sterofoam, 0, ',', '.') }}</td>
                                            {{-- <td class="text-center">{{ $PCO->karat }}</td> --}}
                                            <td class="text-center">{{ number_format($PCO->karat, 0, ',', '.') }}</td>
                                            {{-- <td class="text-center">{{ $PCO->rontokan_fisik }}</td> --}}
                                            <td class="text-center">{{ number_format($PCO->rontokan_flek, 0, ',', '.') }}
                                            </td>
                                            {{-- <td class="text-center">{{ $PCO->rontokan_bahan }}</td> --}}
                                            <td class="text-center">{{ number_format($PCO->rontokan_bahan, 0, ',', '.') }}
                                            </td>
                                            {{-- <td class="text-center">{{ $PCO->rontokan_serabut }}</td> --}}
                                            <td class="text-center">
                                                {{ number_format($PCO->rontokan_serabut, 0, ',', '.') }}</td>
                                            {{-- <td class="text-center">{{ $PCO->ws_0_0_0 }}</td> --}}
                                            <td class="text-center">{{ number_format($PCO->ws_0_0_0, 0, ',', '.') }}</td>
                                            {{-- <td class="text-center">{{ $PCO->berat_pre_cleaning }}</td> --}}
                                            <td class="text-center">
                                                {{ number_format($PCO->berat_pre_cleaning, 0, ',', '.') }}</td>
                                            {{-- <td class="text-center">{{ $PCO->pcs_pre_cleaning }}</td> --}}
                                            <td class="text-center">
                                                {{ number_format($PCO->pcs_pre_cleaning, 0, ',', '.') }}</td>
                                            {{-- <td class="text-center">{{ $PCO->susut }}</td> --}}
                                            <td class="text-center">{{ number_format($PCO->susut, 0, ',', '.') }}</td>
                                            <td class="text-center">{{ $PCO->user_created }}</td>
                                            <td class="text-center">{{ $PCO->user_updated }}</td>
                                            <td class="text-center">{{ $PCO->created_at }}</td>
                                            <td class="text-center">
                                                {{ $PCO->created_at != $PCO->updated_at ? $PCO->updated_at : '' }}
                                            </td>
                                            <td class="text-center">
                                                <div class="form-button-action">
                                                    <form style="display: flex" id="deleteForm{{ $PCO->id }}"
                                                        action="{{ route('PreCleaningOutput.destroy', $PCO->id) }}"
                                                        method="POST">
                                                        <a href="{{ route('PreCleaningOutput.show', $PCO->id) }}"
                                                            class="btn btn-link" title="View"
                                                            data-original-title="View">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-link"
                                                            data-original-title="Remove"
                                                            onclick="confirmDelete({{ $PCO->id }})">
                                                            <i class="bi bi-trash3 text-danger"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <div class="alert alert-danger">
                                            Data Pre Cleaning Output belum Tersedia.
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
@section('script')
    <script>
        function redirectToPage() {
            window.location.href = "{{ url('/pre_cleaning_output/create') }}";
        }

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
@endsection
