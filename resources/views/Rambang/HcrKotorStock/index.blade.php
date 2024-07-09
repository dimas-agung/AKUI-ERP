@extends('layouts.master1')
@section('menu')
    Rambang
@endsection
@section('title')
    Hcr Kotor Stock
@endsection
@section('content')
    <div class="section">
        <div class="card border border-primary border-3">
            <div class="card-header">
                <div class="col-sm-12 d-flex justify-content-between">
                    <h4 class="card-title">Data Hcr Kotor Stock</h4>
                    <div style="position: absolute;right: 0px;">

                        <a class="btn btn-outline-warning rounded-pill" style="margin-right: 10px" onclick="toggleFilter()">
                            <strong>Filter</strong>
                        </a>
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
                <div class="table-responsive">
                    <table id="table1" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">No</th>
                                <th class="text-center" scope="col">ID Box Hcr Kotor</th>
                                <th class="text-center" scope="col">Tanggal Cabut</th>
                                <th class="text-center" scope="col">Jenis Hcr Kotor</th>
                                <th class="text-center" scope="col">Berat Masuk</th>
                                <th class="text-center" scope="col">Berat Keluar</th>
                                <th class="text-center" scope="col">Sisa Berat</th>
                                <th class="text-center" scope="col">Created At</th>
                                <th class="text-center" scope="col">Update At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($CBPenerimaan as $item)
                                <tr>
                                    <td class="text-center">{{ $i++ }}</td>
                                    <td class="text-center">{!! $item->id_box_hcr_kotor !!}</td>
                                    <td class="text-center">{!! $item->tanggal_cabut !!}</td>
                                    <td class="text-center">{!! $item->jenis_hcr_kotor !!}</td>
                                    <td class="text-center">{!! $item->berat_masuk !!}</td>
                                    <td class="text-center">{!! $item->berat_keluar !!}</td>
                                    <td class="text-center">{!! $item->sisa_berat !!}</td>
                                    <td class="text-center">{{ $item->created_at }}</td>
                                    <td class="text-center">
                                        {{ $item->created_at != $item->updated_at ? $item->updated_at : '' }}
                                    </td>
                                </tr>
                            @empty
                                <div class="alert alert-danger">
                                    Data Stock Hcr Kotor belum Tersedia.
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
    function applyFilter() {

    const start_date = document.getElementById('filterInputStartDate').value;
    const end_date = document.getElementById('filterInputEndDate').value;

    const filters = {
        start_date: start_date,
        end_date: end_date,
    };
    var url = '{{ route("StockHcrKotor.index") }}';

    // url = url.replace(':slug', slug);
    url = url+'?start_date='+start_date+'&end_date='+end_date ;
    window.location.href=url;

    }
</script>
@endsection
