@extends('layouts.master1')
@section('menu')
   Produktivitas Cabut Bulu
@endsection
@section('title')
   Produktivitas Cabut Bulu Hancuran
@endsection
@section('content')
    <div class="section">
        <div class="card border border-primary border-3">
            <div class="card-header">
                <h5 class="card-title">
                    <div class="col-sm-12 d-flex justify-content-between">
                        Data Produktivitas Cabut Bulu Hancuran
                        <div style="position: absolute;right: 0px;">

                            <a class="btn btn-outline-warning rounded-pill" style="margin-right: 10px" onclick="toggleFilter()">
                                <strong>Filter</strong>
                            </a>
                            
                        </div>
                    </div>
                </h5>
                
            </div>
            <div class="card-body" style="overflow: auto;">
                <div id="filterRow" class="row mb-5 mt-3">
                    <div class="col-4">
                        <label class="form-label">Plant</label>
                        <div class="input-group">
                           <select class="select2 form-select" style="width: 100%;" name="plant" id="plant">
                                @foreach ($data_plant as $plant )
                                    <option value="{{$plant->plant}}">{{$plant->nama}}</option>
                                @endforeach
                           </select>
                        </div>
                    </div>
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
                                <th class="text-center" scope="col">Tanggal</th>

                                <th class="text-center">nip</th>
                                <th class="text-center">gram</th>
                                <th class="text-center" scope="col">NmBrg</th>
                                <th class="text-center" scope="col">NoJob</th>
                                <th class="text-center">Insentif</th>
                                <th class="text-center">Upah Bersih</th>
                                <th class="text-center"> Lama Pengerjaan (Menit)</th>
                                <th class="text-center">Plant</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($cabut_bulu_stock as $item)
                                @php
                                    $berat_bersih = $item->berat * 0.12;
                                    // $upah_bersih = $item->upah_operator /$item->berat_job * $berat_bersih;
                                    $date = $item->created_at;

                                @endphp
                                <tr>
                                    
                                    <td class="text-center">{{ $date->format('Y-m-d') }}</td>
                                  
                                    
                                    <td class="text-center">{!! $item->nip_operator !!}</td>
                                    <td class="text-center">{!! $berat_bersih !!}</td>
                                    <td class="text-center">{{ $item->jenis_rambang }}</td>
                                    <td class="text-center">{{ $item->nomor_job }}</td>
                                    <td class="text-center">{!! 0 !!}</td>
                                    <td class="text-center">{{ floor($item->upah_operator) }}</td>
                                    <td class="text-center">{{floor(($item->lama_pengerjaan) / 60)}}</td>
                                    <td class="text-center">{{ $plant_filter }}</td>
                                   
                                    
                                   
                                </tr>
                            @empty
                                {{-- <div class="alert alert-danger">
                                    Data Produktivitas Cabut Bulu belum Tersedia.
                                </div> --}}
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
        toggleFilter();
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
            plant:$('#plant').val()
        };
        var url = '{{ route("ProduktivitasCabutBuluHancuran.index") }}';
    
        // url = url.replace(':slug', slug);
         url = url+'?start_date='+start_date+'&end_date='+end_date+'&plant='+$('#plant').val() ;
        window.location.href=url;
    
    }
    </script>
    
@endsection
