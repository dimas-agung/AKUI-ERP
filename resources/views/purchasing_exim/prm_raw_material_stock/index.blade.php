@extends('layouts.master1')
@section('menu')
    Purchasing & EXIM
@endsection
@section('title')
    Purchasing Raw Material Stock
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
                                Data Purchasing Raw Material Stock
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
                                        <th scope="col" class="text-center">Id Box</th>
                                        <th scope="col" class="text-center">Nomor Nota Internal</th>
                                        <th scope="col" class="text-center">Nomor Batch</th>
                                        <th scope="col" class="text-center">Nama Supplier</th>
                                        <th scope="col" class="text-center">Jenis</th>
                                        <th scope="col" class="text-center" id="berat_masuk_header">Berat Masuk</th>
                                        <th scope="col" class="text-center" id="berat_keluar_header">Berat Keluar</th>
                                        <th scope="col" class="text-center" id="sisa_berat_header">Sisa Berat</th>
                                        <th scope="col" class="text-center" id="avg_kadar_air_header">Avg Kadar Air</th>
                                        <th scope="col" class="text-center" id="modal_header">Modal</th>
                                        <th scope="col" class="text-center" id="total_modal_header">Total Modal</th>
                                        <th scope="col" class="text-center">Keterangan</th>
                                        <th scope="col" class="text-center">User Created</th>
                                        <th scope="col" class="text-center">User Updated</th>
                                        <th scope="col" class="text-center">Created At</th>
                                        <th scope="col" class="text-center">Updated At</th>
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $iteration = 1; @endphp
                                    @forelse ($PrmRawMaterialStock as $item)
                                        @if ($item->sisa_berat != 0)
                                            <tr>
                                                <td class="text-center">{{ $iteration }}</td>
                                                <td class="text-center">{{ $item->id_box }}</td>
                                                <td class="text-center">{{ $item->nomor_nota_internal }}</td>
                                                <td class="text-center">{{ $item->nomor_batch }}</td>
                                                <td class="text-center">{{ $item->nama_supplier }}</td>
                                                <td class="text-center">{{ $item->jenis }}</td>
                                                <td class="text-center berat_masuk">
                                                    {{ $item->berat_masuk }}</td>
                                                <td class="text-center berat_keluar">
                                                    {{ $item->berat_keluar }}</td>
                                                <td class="text-center sisa_berat">
                                                    {{ $item->sisa_berat }}</td>
                                                <td class="text-center avg_kadar_air">
                                                    {{ $item->avg_kadar_air }}</td>
                                                <td class="text-center modal1">
                                                    {{ number_format($item->modal, 2, ',', '.') }}
                                                </td>
                                                <td class="text-center total_modal">
                                                    {{ number_format($item->total_modal, 2, ',', '.') }}</td>
                                                <td class="text-center">{{ $item->keterangan }}</td>
                                                <td class="text-center">{{ $item->user_created }}</td>
                                                <td class="text-center">{{ $item->user_updated }}</td>
                                                <td class="text-center">{{ $item->created_at }}</td>
                                                <td class="text-center">
                                                    {{ $item->created_at != $item->updated_at ? $item->updated_at : '' }}
                                                </td>
                                                <td class="text-center">
                                                    <div class="form-button-action">
                                                        <form>
                                                            <a href="{{ route('PrmRawMaterialStock.show', $item->id_box) }}"
                                                                class="btn btn-link" title="View"
                                                                data-original-title="View">
                                                                <i class="bi bi-eye"></i>
                                                            </a>
                                                            @csrf
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            @php $iteration++; @endphp
                                        @endif
                                    @empty
                                        <div class="alert alert-danger">
                                            Data Purchasing Raw Material Stock belum Tersedia.
                                        </div>
                                    @endforelse
                                </tbody>
                                <tfoot id="tfoot">
                                    <tr>
                                        <th scope="col" class="text-center"></th>
                                        <th scope="col" class="text-center"></th>
                                        <th scope="col" class="text-center"></th>
                                        <th scope="col" class="text-center"></th>
                                        <th scope="col" class="text-center"></th>
                                        <th scope="col" class="text-center"></th>
                                        <th scope="col" class="text-center" id="berat_masuk_footer"></th>
                                        <th scope="col" class="text-center" id="berat_keluar_footer"></th>
                                        <th scope="col" class="text-center" id="sisa_berat_footer"></th>
                                        <th scope="col" class="text-center" id="avg_kadar_air_footer"></th>
                                        <th scope="col" class="text-center" id="modal_footer"></th>
                                        <th scope="col" class="text-center" id="total_modal_footer"></th>
                                        <th scope="col" class="text-center"></th>
                                        <th scope="col" class="text-center"></th>
                                        <th scope="col" class="text-center"></th>
                                        <th scope="col" class="text-center"></th>
                                        <th scope="col" class="text-center"></th>
                                        <th scope="col" class="text-center"></th>
                                    </tr>
                                </tfoot>
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

        $(document).ready(function() {
            // Inisialisasi total berat masuk
            let totalBeratMasuk = 0;

            // SUM Berat Masuk
            // Loop melalui setiap elemen berat masuk dan tambahkan ke total
            $('.berat_masuk').each(function() {
                totalBeratMasuk += parseFloat($(this).text());
            });

            // Tampilkan total berat masuk pada bagian footer
            $('#berat_masuk_footer').text(totalBeratMasuk);


            // SUM Berat Keluar
            // Inisialisasi total berat keluar
            let totalBeratKeluar = 0;
            // Loop melalui setiap elemen berat masuk dan tambahkan ke total
            $('.berat_keluar').each(function() {
                totalBeratKeluar += parseFloat($(this).text());
            });

            // Tampilkan total berat masuk pada bagian footer
            $('#berat_keluar_footer').text(totalBeratKeluar);

            // SUM Sisa Berat
            // Inisialisasi total sisa berat
            let totalSisaBerat = 0;
            // Loop melalui setiap elemen berat masuk dan tambahkan ke total
            $('.sisa_berat').each(function() {
                totalSisaBerat += parseFloat($(this).text());
            });

            // Tampilkan total berat masuk pada bagian footer
            $('#sisa_berat_footer').text(totalSisaBerat);


            // AVG KADAR AIR
            // Menghitung jumlah elemen "Avg Kadar Air"
            let count = $('.avg_kadar_air').length;

            // Inisialisasi total nilai "Avg Kadar Air"
            let totalAvgKadarAir = 0;

            // Loop melalui setiap elemen "Avg Kadar Air" dan tambahkan ke total
            $('.avg_kadar_air').each(function() {
                totalAvgKadarAir += parseFloat($(this).text());
            });

            // Hitung rata-rata
            let avgKadarAir = totalAvgKadarAir / count;

            // Tampilkan rata-rata pada bagian footer
            $('#avg_kadar_air_footer').text(avgKadarAir.toFixed(2));


            // AVG Modal
            // Menghitung jumlah elemen "Modal"
            let countModal = $('.modal1').length;
            console.log("Jumlah elemen 'Modal': " + countModal);

            // Inisialisasi total nilai "Modal"
            let totalModal = 0;

            // Loop melalui setiap elemen "Modal" dan tambahkan ke total
            $('.modal1').each(function() {
                // Mengambil teks dari elemen
                let modalText = $(this).text();
                console.log("Teks elemen 'Modal': " + modalText);
                // Menghapus tanda titik dan koma sebagai separator ribuan
                modalText = modalText.replace(/\./g, '').replace(',', '.');
                console.log("Teks elemen 'Modal' setelah penghapusan tanda: " + modalText);
                // Mengonversi teks ke angka
                let modalValue = parseFloat(modalText);
                console.log("Nilai 'Modal' setelah parsing: " + modalValue);
                // Jika nilai modal adalah angka yang valid, tambahkan ke total
                if (!isNaN(modalValue)) {
                    totalModal += modalValue;
                }
            });
            console.log("Total 'Modal': " + totalModal);

            // Hitung rata-rata
            let avgModal = totalModal / countModal;
            console.log("Rata-rata 'Modal': " + avgModal);

            // Tampilkan rata-rata pada bagian footer
            $('#modal_footer').text(avgModal.toFixed(2));

            // SUM Total Modal
            // Inisialisasi total nilai "Total Modal"
            let totalTotalModal = 0;

            // Loop melalui setiap elemen "Total Modal" dan tambahkan ke total
            $('.total_modal').each(function() {
                // Mengambil teks dari elemen
                let totalModalText = $(this).text();
                // Menghapus tanda titik dan koma sebagai separator ribuan
                totalModalText = totalModalText.replace(/\./g, '').replace(',', '.');
                // Mengonversi teks ke angka
                let totalModalValue = parseFloat(totalModalText);
                // Jika nilai modal adalah angka yang valid, tambahkan ke total
                if (!isNaN(totalModalValue)) {
                    totalTotalModal += totalModalValue;
                }
            });

            // Tampilkan total modal pada bagian footer
            $('#total_modal_footer').text(totalTotalModal.toFixed(2));
        });
    </script>
@endsection
