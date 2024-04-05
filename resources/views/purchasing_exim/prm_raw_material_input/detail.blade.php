@extends('layouts.master1')
@section('menu')
    Purchasing & EXIM
@endsection
@section('title')
    Purchasing Raw Material Input
@endsection
@section('content')
    <div class="col-md-12">
        <div class="card mt-2 border border-primary border-3">
            <div class="card-body">
                <div class="card">
                    {{-- card header --}}
                    <div class="card-header">
                        <h5 class="card-title">
                            <div class="col-sm-12 d-flex justify-content-between">
                                Detail Data Purchasing Input Item
                            </div>
                        </h5>
                    </div>
                    {{-- card body --}}
                    <div class="card-body" style="overflow: auto;">
                        <div class="table-responsive">
                            <table id="table1" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-center">No</th>
                                        <th scope="col" class="text-center">No Doc</th>
                                        <th scope="col" class="text-center">Nomor Batch</th>
                                        <th scope="col" class="text-center">Nomor Nota Supplier</th>
                                        <th scope="col" class="text-center">Nomor Nota Internal</th>
                                        <th scope="col" class="text-center">Nama Supplier</th>
                                        <th scope="col" class="text-center">Jenis</th>
                                        <th scope="col" class="text-center">Berat Nota</th>
                                        <th scope="col" class="text-center">Berat kotor</th>
                                        <th scope="col" class="text-center">Berat Bersih</th>
                                        <th scope="col" class="text-center">Selisih Berat</th>
                                        <th scope="col" class="text-center">Kadar Air</th>
                                        <th scope="col" class="text-center">Id Box</th>
                                        <th scope="col" class="text-center">Harga Nota</th>
                                        <th scope="col" class="text-center">Total Harga Nota</th>
                                        <th scope="col" class="text-center">Harga Deal</th>
                                        <th scope="col" class="text-center">Keterangan</th>
                                        <th scope="col" class="text-center">User Created</th>
                                        <th scope="col" class="text-center">User Updated</th>
                                        <th scope="col" class="text-center">Created At</th>
                                        <th scope="col" class="text-center">Updated At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($prm_raw_material_inputs as $prmRawMaterialInput)
                                        @foreach ($prmRawMaterialInput->prmRawMaterialInputItem as $prmRawMaterialInputItem)
                                            <tr>
                                                <td class="text-center">{{ $i++ }}</td>
                                                <td class="text-center">{{ $prmRawMaterialInput->doc_no }}</td>
                                                <td class="text-center">{{ $prmRawMaterialInput->nomor_batch }}</td>
                                                <td class="text-center">{{ $prmRawMaterialInput->nomor_nota_supplier }}</td>
                                                <td class="text-center">{{ $prmRawMaterialInput->nomor_nota_internal }}</td>
                                                <td class="text-center">{{ $prmRawMaterialInput->nama_supplier }}</td>
                                                <!-- Menampilkan data dari relasi -->
                                                <td class="text-center">{{ $prmRawMaterialInputItem->jenis }}</td>
                                                <td class="text-center">{{ $prmRawMaterialInputItem->berat_nota }}</td>
                                                <td class="text-center">{{ $prmRawMaterialInputItem->berat_kotor }}</td>
                                                <td class="text-center">{{ $prmRawMaterialInputItem->berat_bersih }}</td>
                                                <td class="text-center">{{ $prmRawMaterialInputItem->selisih_berat }}</td>
                                                <td class="text-center">{{ $prmRawMaterialInputItem->kadar_air }}</td>
                                                <td class="text-center">{{ $prmRawMaterialInputItem->id_box }}</td>
                                                <td class="text-center">
                                                    {{ number_format($prmRawMaterialInputItem->harga_nota, 2, ',', '.') }}
                                                </td>
                                                <td class="text-center">
                                                    {{ number_format($prmRawMaterialInputItem->total_harga_nota, 2, ',', '.') }}
                                                </td>
                                                <td class="text-center">
                                                    {{ number_format($prmRawMaterialInputItem->harga_deal, 2, ',', '.') }}
                                                </td>
                                                <td class="text-center">{{ $prmRawMaterialInputItem->keterangan }}</td>
                                                <td class="text-center">{{ $prmRawMaterialInputItem->user_created }}</td>
                                                <td class="text-center">{{ $prmRawMaterialInputItem->user_updated }}</td>
                                                <td class="text-center">{{ $prmRawMaterialInputItem->created_at }}</td>
                                                <td class="text-center">
                                                    {{ $prmRawMaterialInputItem->created_at != $prmRawMaterialInputItem->updated_at ? $prmRawMaterialInputItem->updated_at : '' }}
                                                </td>
                                                <!-- Menampilkan kolom lainnya dari prmRawMaterialInputItem sesuai kebutuhan -->
                                        @endforeach
                                        </tr>
                                    @empty
                                        <div class="alert alert-danger">
                                            Detail Data Purchasing Input Item belum Tersedia.
                                        </div>
                                    @endforelse
                                </tbody>

                            </table>
                        </div>
                        <div class=" d-flex justify-content-end model-footer no-bd">
                            <a href="{{ route('PrmRawMaterialInput.index') }}" type="button" class="btn btn-danger mt-3"
                                data-dismiss="modal">Close</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection