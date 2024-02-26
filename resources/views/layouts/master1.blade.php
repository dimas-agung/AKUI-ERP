<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="./assets/compiled/svg/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon"
        href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACEAAAAiCAYAAADRcLDBAAAEs2lUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iWE1QIENvcmUgNS41LjAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIgogICAgeG1sbnM6ZXhpZj0iaHR0cDovL25zLmFkb2JlLmNvbS9leGlmLzEuMC8iCiAgICB4bWxuczp0aWZmPSJodHRwOi8vbnMuYWRvYmUuY29tL3RpZmYvMS4wLyIKICAgIHhtbG5zOnBob3Rvc2hvcD0iaHR0cDovL25zLmFkb2JlLmNvbS9waG90b3Nob3AvMS4wLyIKICAgIHhtbG5zOnhtcD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLyIKICAgIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIgogICAgeG1sbnM6c3RFdnQ9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZUV2ZW50IyIKICAgZXhpZjpQaXhlbFhEaW1lbnNpb249IjMzIgogICBleGlmOlBpeGVsWURpbWVuc2lvbj0iMzQiCiAgIGV4aWY6Q29sb3JTcGFjZT0iMSIKICAgdGlmZjpJbWFnZVdpZHRoPSIzMyIKICAgdGlmZjpJbWFnZUxlbmd0aD0iMzQiCiAgIHRpZmY6UmVzb2x1dGlvblVuaXQ9IjIiCiAgIHRpZmY6WFJlc29sdXRpb249Ijk2LjAiCiAgIHRpZmY6WVJlc29sdXRpb249Ijk2LjAiCiAgIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiCiAgIHBob3Rvc2hvcDpJQ0NQcm9maWxlPSJzUkdCIElFQzYxOTY2LTIuMSIKICAgeG1wOk1vZGlmeURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiCiAgIHhtcDpNZXRhZGF0YURhdGU9IjIwMjItMDMtMzFUMTA6NTA6MjMrMDI6MDAiPgogICA8eG1wTU06SGlzdG9yeT4KICAgIDxyZGY6U2VxPgogICAgIDxyZGY6bGkKICAgICAgc3RFdnQ6YWN0aW9uPSJwcm9kdWNlZCIKICAgICAgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWZmaW5pdHkgRGVzaWduZXIgMS4xMC4xIgogICAgICBzdEV2dDp3aGVuPSIyMDIyLTAzLTMxVDEwOjUwOjIzKzAyOjAwIi8+CiAgICA8L3JkZjpTZXE+CiAgIDwveG1wTU06SGlzdG9yeT4KICA8L3JkZjpEZXNjcmlwdGlvbj4KIDwvcmRmOlJERj4KPC94OnhtcG1ldGE+Cjw/eHBhY2tldCBlbmQ9InIiPz5V57uAAAABgmlDQ1BzUkdCIElFQzYxOTY2LTIuMQAAKJF1kc8rRFEUxz9maORHo1hYKC9hISNGTWwsRn4VFmOUX5uZZ36oeTOv954kW2WrKLHxa8FfwFZZK0WkZClrYoOe87ypmWTO7dzzud97z+nec8ETzaiaWd4NWtYyIiNhZWZ2TvE946WZSjqoj6mmPjE1HKWkfdxR5sSbgFOr9Ll/rXoxYapQVik8oOqGJTwqPL5i6Q5vCzeo6dii8KlwpyEXFL519LjLLw6nXP5y2IhGBsFTJ6ykijhexGra0ITl5bRqmWU1fx/nJTWJ7PSUxBbxJkwijBBGYYwhBgnRQ7/MIQIE6ZIVJfK7f/MnyUmuKrPOKgZLpEhj0SnqslRPSEyKnpCRYdXp/9++msneoFu9JgwVT7b91ga+LfjetO3PQ9v+PgLvI1xkC/m5A+h7F32zoLXug38dzi4LWnwHzjeg8UGPGbFfySvuSSbh9QRqZ6H+Gqrm3Z7l9zm+h+iafNUV7O5Bu5z3L/wAdthn7QIme0YAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAJTSURBVFiF7Zi9axRBGIefEw2IdxFBRQsLWUTBaywSK4ubdSGVIY1Y6HZql8ZKCGIqwX/AYLmCgVQKfiDn7jZeEQMWfsSAHAiKqPiB5mIgELWYOW5vzc3O7niHhT/YZvY37/swM/vOzJbIqVq9uQ04CYwCI8AhYAlYAB4Dc7HnrOSJWcoJcBS4ARzQ2F4BZ2LPmTeNuykHwEWgkQGAet9QfiMZjUSt3hwD7psGTWgs9pwH1hC1enMYeA7sKwDxBqjGnvNdZzKZjqmCAKh+U1kmEwi3IEBbIsugnY5avTkEtIAtFhBrQCX2nLVehqyRqFoCAAwBh3WGLAhbgCRIYYinwLolwLqKUwwi9pxV4KUlxKKKUwxC6ZElRCPLYAJxGfhSEOCz6m8HEXvOB2CyIMSk6m8HoXQTmMkJcA2YNTHm3congOvATo3tE3A29pxbpnFzQSiQPcB55IFmFNgFfEQeahaAGZMpsIJIAZWAHcDX2HN+2cT6r39GxmvC9aPNwH5gO1BOPFuBVWAZue0vA9+A12EgjPadnhCuH1WAE8ivYAQ4ohKaagV4gvxi5oG7YSA2vApsCOH60WngKrA3R9IsvQUuhIGY00K4flQG7gHH/mLytB4C42EgfrQb0mV7us8AAMeBS8mGNMR4nwHamtBB7B4QRNdaS0M8GxDEog7iyoAguvJ0QYSBuAOcAt71Kfl7wA8DcTvZ2KtOlJEr+ByyQtqqhTyHTIeB+ONeqi3brh+VgIN0fohUgWGggizZFTplu12yW8iy/YLOGWMpDMTPXnl+Az9vj2HERYqPAAAAAElFTkSuQmCC"
        type="image/png">

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('./assets/compiled/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('./assets/compiled/css/app-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('./assets/compiled/css/iconly.css') }}">
    {{-- SweetAlert --}}
    <link rel="stylesheet" href="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.css') }}">
    {{-- Choice --}}
    <link rel="stylesheet" href="{{ asset('assets/extensions/select2/css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/extensions/choices.js/public/assets/styles/choices.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/extensions/choices.js/public/assets/styles/choices.min.css') }}">
    {{-- DataTable --}}
    <link rel="stylesheet" href="{{ asset('https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css') }}">
    <style>
        .dataTables_wrapper {
            overflow-x: hidden;
        }
    </style>
</head>

<body>
    <script src="assets/static/js/initTheme.js"></script>
    <div id="app">
        <div id="sidebar">
            <div class="sidebar-wrapper border-end border-primary border-3 active">
                <div class="sidebar-header position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="logo">
                            {{-- <a href="/"><img src="./assets/compiled/svg/logo.svg" alt="Logo" srcset=""></a> --}}
                            <a href="{{ url('/') }}"><img src="{{ asset('assets/compiled/png/akui.png') }}"
                                    alt="Logo" srcset=""><span style="font-size: 15px">AKUI-ERP</span></a>
                        </div>
                        <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                aria-hidden="true" role="img" class="iconify iconify--system-uicons" width="20"
                                height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                                <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path
                                        d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2"
                                        opacity=".3"></path>
                                    <g transform="translate(-210 -1)">
                                        <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                                        <circle cx="220.5" cy="11.5" r="4"></circle>
                                        <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2">
                                        </path>
                                    </g>
                                </g>
                            </svg>
                            <div class="form-check form-switch fs-6">
                                <input class="form-check-input  me-0" type="checkbox" id="toggle-dark"
                                    style="cursor: pointer">
                                <label class="form-check-label"></label>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                aria-hidden="true" role="img" class="iconify iconify--mdi" width="20"
                                height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z">
                                </path>
                            </svg>
                        </div>
                        <div class="sidebar-toggler  x">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i
                                    class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                {{-- <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item active ">
                            <a href="/" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>


                        </li>

                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-stack"></i>
                                <span>Master</span>
                            </a>

                            <ul class="submenu ">

                                <li class="submenu-item  ">
                                    <a href="{{ url('/master_jenis_raw_material') }}" class="submenu-link">Master
                                        Jenis</a>

                                </li>

                            </ul>

                        </li>
                        <li class="sidebar-item  has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-stack"></i>
                                <span>Purchasing & Exim</span>
                            </a>

                            <ul class="submenu ">

                                <li class="submenu-item  ">
                                    <a href="{{ url('/purchasing_exim/prm_raw_material_input') }}"
                                        class="submenu-link">PRM INPUT</a>

                                </li>

                            </ul>

                        </li>

                    </ul>
                </div> --}}
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-item  {{ Request::is('/') ? 'active' : '' }} ">
                            <a href="{{ route('home') }}" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-title">Master</li>
                        <li
                            class="sidebar-item  has-sub {{ Request::is('perusahaan*', 'workstation*', 'unit*', 'biayahpp*', 'master_supplier_raw_material*', 'master_jenis_raw_material*', 'master_tujuan_kirim_raw_material*', 'master_jenis_grading_kasar*', 'master_tujuan_kirim_grading_kasar*', 'master_operator*') ? 'active' : '' }}">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-stack"></i>
                                <span>Master</span>
                            </a>
                            <ul class="submenu ">
                                <li class="submenu-item  {{ Request::is('perusahaan*') ? 'active' : '' }} ">
                                    <a href="{{ route('Perusahaan.index') }}" class="submenu-link">Perusahaan</a>
                                </li>
                                <li class="submenu-item  {{ Request::is('workstation*') ? 'active' : '' }} ">
                                    <a href="{{ route('Workstation.index') }}" class="submenu-link">Workstation</a>
                                </li>
                                <li class="submenu-item  {{ Request::is('unit*') ? 'active' : '' }} ">
                                    <a href="{{ route('Unit.index') }}" class="submenu-link">Unit</a>
                                </li>
                                <li class="submenu-item  {{ Request::is('biayahpp*') ? 'active' : '' }} ">
                                    <a href="{{ route('BiayaHpp.index') }}" class="submenu-link">Biaya HPP</a>
                                </li>
                                <li
                                    class="submenu-item  {{ Request::is('MasterSupplierRawMaterial*') ? 'active' : '' }} ">
                                    <a href="{{ route('MasterSupplierRawMaterial.index') }}"
                                        class="submenu-link">Supplier
                                        Raw Material</a>
                                </li>
                                <li
                                    class="submenu-item  {{ Request::is('MasterJenisRawMaterial*') ? 'active' : '' }} ">
                                    <a href="{{ route('MasterJenisRawMaterial.index') }}" class="submenu-link">Jenis
                                        Raw
                                        Material</a>
                                </li>
                                <li
                                    class="submenu-item  {{ Request::is('MasterTujuanKirimRawMaterial*') ? 'active' : '' }} ">
                                    <a href="{{ route('MasterTujuanKirimRawMaterial.index') }}"
                                        class="submenu-link">Tujuan
                                        Kirim Raw Material</a>
                                </li>
                                <li
                                    class="submenu-item  {{ Request::is('MasterJenisGradingKasar') ? 'active' : '' }} ">
                                    <a href="{{ route('MasterJenisGradingKasar.index') }}"
                                        class="submenu-link">Master
                                        Jenis
                                        <br>
                                        Grading Kasar</a>
                                </li>
                                <li
                                    class="submenu-item  {{ Request::is('master_tujuan_kirim_grading_kasar*') ? 'active' : '' }} ">
                                    <a href="{{ route('MasterTujuanKirimGradingKasar.index') }}"
                                        class="submenu-link">Master Tujuan<br>Kirim
                                        Grading<br>Kasar</a>
                                </li>
                                <li class="submenu-item  {{ Request::is('master_operator*') ? 'active' : '' }} ">
                                    <a href="{{ route('MasterOperator.index') }}" class="submenu-link">Master
                                        Operator</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-title">Purchasing & EXIM</li>
                        <li
                            class="sidebar-item  has-sub {{ Request::is('prm_raw_material_input*', 'prm_raw_material_stock*', 'prm_raw_material_output*', 'stock_transit_raw_material*') ? 'active' : '' }}">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-collection-fill"></i>
                                <span>Purchasing & EXIM</span>
                            </a>
                            <ul class="submenu ">
                                <li
                                    class="submenu-item {{ Request::is('prm_raw_material_input*') ? 'active' : '' }} ">
                                    <a href="{{ route('PrmRawMaterialInput.index') }}" class="submenu-link">Prm
                                        Raw Material Input</a>
                                </li>
                                <li
                                    class="submenu-item  {{ Request::is('prm_raw_material_stock*') ? 'active' : '' }} ">
                                    <a href="{{ route('PrmRawMaterialStock.index') }}" class="submenu-link">Prm
                                        Raw Material Stock</a>
                                </li>
                                <li
                                    class="submenu-item  {{ Request::is('prm_raw_material_output*') ? 'active' : '' }} ">
                                    <a href="{{ route('PrmRawMaterialOutput.index') }}" class="submenu-link">Prm Raw
                                        Material Output</a>
                                </li>
                                <li
                                    class="submenu-item  {{ Request::is('stock_transit_raw_material*') ? 'active' : '' }} ">
                                    <a href="{{ route('StockTransitRawMaterial.index') }}" class="submenu-link">Stock
                                        Transit Raw Material</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-title">Production</li>
                        <li
                            class="sidebar-item has-sub {{ Request::is('stock_transit_raw_material*', 'grading_kasar_input*', 'grading_kasar_hasil*', 'grading_kasar_stock*', 'grading_kasar_output*', 'stock_transit_grading_kasar*', 'pre_cleaning_input*', 'pre_cleaning_stock*', 'pre_cleaning_output*', 'transit_pre_cleaning_stock*', 'pre_grading_halus_input*', 'pre_grading_halus_stock*', 'pre_grading_halus_adding*', 'pre_grading_halus_adding_stock*') ? 'active' : '' }}">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-three-dots"></i>
                                <span>Bahan Baku</span>
                            </a>
                            <ul class="submenu">
                                <li
                                    class="submenu-item has-sub {{ Request::is('stock_transit_raw_material*', 'grading_kasar_input*', 'grading_kasar_hasil*', 'grading_kasar_stock*', 'grading_kasar_output*', 'stock_transit_grading_kasar*') ? 'active' : '' }}">
                                    <a href="#" class='submenu-link'>
                                        <i class="bi bi-grid-1x2-fill"></i>
                                        <span>Grading Kasar</span>
                                    </a>
                                    <ul class="submenu ">
                                        <li
                                            class="submenu-item {{ Request::is('stock_transit_raw_material*') ? 'active' : '' }}">
                                            <a href="{{ route('StockTransitRawMaterial.index') }}"
                                                class="submenu-link">Stock Transit Raw Material</a>
                                        </li>
                                        <li
                                            class="submenu-item {{ Request::is('grading_kasar_input*') ? 'active' : '' }}">
                                            <a href="{{ route('GradingKasarInput.index') }}"
                                                class="submenu-link">Grading Kasar Input</a>
                                        </li>
                                        <li
                                            class="submenu-item {{ Request::is('grading_kasar_hasil*') ? 'active' : '' }}">
                                            <a href="{{ route('GradingKasarHasil.index') }}"
                                                class="submenu-link">Grading Kasar Hasil</a>
                                        </li>
                                        <li
                                            class="submenu-item {{ Request::is('grading_kasar_stock*') ? 'active' : '' }}">
                                            <a href="{{ route('GradingKasarStock.index') }}"
                                                class="submenu-link">Grading Kasar Stock</a>
                                        </li>
                                        <li
                                            class="submenu-item {{ Request::is('grading_kasar_output*') ? 'active' : '' }}">
                                            <a href="{{ route('GradingKasarOutput.index') }}"
                                                class="submenu-link">Grading Kasar Output</a>
                                        </li>
                                        <li
                                            class="submenu-item {{ Request::is('stock_transit_grading_kasar*') ? 'active' : '' }}">
                                            <a href="{{ route('StockTransitGradingKasar.index') }}"
                                                class="submenu-link">Stock Transit Grading Kasar</a>
                                        </li>
                                    </ul>
                                </li>
                                <li
                                    class="submenu-item has-sub {{ Request::is('stock_transit_grading_kasar*', 'pre_cleaning_input*', 'pre_cleaning_stock*', 'pre_cleaning_output*', 'transit_pre_cleaning_stock*') ? 'active' : '' }}">
                                    <a href="#" class='submenu-link'>
                                        <i class="bi bi-grid-1x2-fill"></i>
                                        <span>Pre Cleaning</span>
                                    </a>
                                    <ul class="submenu ">
                                        <li
                                            class="submenu-item {{ Request::is('stock_transit_grading_kasar*') ? 'active' : '' }}">
                                            <a href="{{ route('StockTransitGradingKasar.index') }}"
                                                class="submenu-link">Stock
                                                Transit Grading Kasar</a>
                                        </li>
                                        {{-- <li class="submenu-item  {{ Request::is('pre_cleaning_output') ? 'active' : '' }} ">
                                    <a href="{{ route('pre_cleaning_output.index') }}" class="submenu-link">Pre
                                        Cleaning<br>Input</a>
                                </li> --}}
                                        <li
                                            class="submenu-item  {{ Request::is('pre_cleaning_stock*') ? 'active' : '' }} ">
                                            <a href="{{ route('PreCleaningStock.index') }}" class="submenu-link">Pre
                                                Cleaning<br>Stock</a>
                                        </li>
                                        <li
                                            class="submenu-item {{ Request::is('pre_cleaning_input*') ? 'active' : '' }}">
                                            <a href="{{ route('PreCleaningInput.index') }}"
                                                class="submenu-link">Pre-Cleaning Input</a>
                                        </li>
                                        <li
                                            class="submenu-item {{ Request::is('pre_cleaning_stock*') ? 'active' : '' }}">
                                            <a href="{{ route('PreCleaningStock.index') }}"
                                                class="submenu-link">Pre-Cleaning Stock</a>
                                        </li>
                                        <li
                                            class="submenu-item {{ Request::is('pre_cleaning_output*') ? 'active' : '' }}">
                                            <a href="{{ route('PreCleaningOutput.index') }}" class="submenu-link">Pre
                                                Cleaning Output</a>
                                        </li>
                                        <li
                                            class="submenu-item {{ Request::is('transit_pre_cleaning_stock*') ? 'active' : '' }}">
                                            <a href="{{ route('TransitPreCleaningStock.index') }}"
                                                class="submenu-link">Transit Pre Cleaning Stock</a>
                                        </li>
                                    </ul>
                                </li>
                                <li
                                    class="submenu-item has-sub {{ Request::is('transit_pre_cleaning_stock*', 'pre_grading_halus_input*', 'pre_grading_halus_stock*', 'pre_grading_halus_adding*', 'pre_grading_halus_adding_stock*') ? 'active' : '' }}">
                                    <a href="#" class='submenu-link'>
                                        <span>Pre-Grading Halus</span>
                                    </a>
                                    <ul class="submenu">
                                        <li
                                            class="submenu-item {{ Request::is('transit_pre_cleaning_stock*') ? 'active' : '' }}">
                                            <a href="{{ route('TransitPreCleaningStock.index') }}"
                                                class="submenu-link">Transit Pre Cleaning Stock</a>
                                        </li>
                                        <li
                                            class="submenu-item {{ Request::is('pre_grading_halus_adding') ? 'active' : '' }}">
                                            <a href="{{ route('PreGradingHalusAdding.index') }}"
                                                class="submenu-link">Pre Grading Halus Adding</a>
                                        </li>
                                        <li
                                            class="submenu-item {{ Request::is('pre_grading_halus_adding_stock') ? 'active' : '' }}">
                                            <a href="{{ route('PreGradingHalusAddingStock.index') }}"
                                                class="submenu-link">Pre Grading Halus Adding Stock</a>
                                        </li>
                                        <li
                                            class="submenu-item {{ Request::is('pre_grading_halus_input*') ? 'active' : '' }}">
                                            <a href="{{ route('PreGradingHalusInput.index') }}"
                                                class="submenu-link">Pre-Grading Halus Input</a>
                                        </li>
                                        <li
                                            class="submenu-item {{ Request::is('pre_grading_halus_stock*') ? 'active' : '' }}">
                                            <a href="{{ route('PreGradingHalusStock.index') }}"
                                                class="submenu-link">Pre-Grading Halus Stock</a>
                                        </li>
                                        <li
                                            class="submenu-item {{ Request::is('pre_grading_halus_adding') ? 'active' : '' }}">
                                            <a href="{{ route('PreGradingHalusAdding.index') }}"
                                                class="submenu-link">Pre Grading Halus Adding</a>
                                        </li>
                                        <li
                                            class="submenu-item {{ Request::is('pre_grading_halus_adding_stock') ? 'active' : '' }}">
                                            <a href="{{ route('PreGradingHalusAddingStock.index') }}"
                                                class="submenu-link">Pre Grading Halus Adding Stock</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-title">Cleaning</li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="main" class="position:relative">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>@yield('menu')</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Content --}}
            <div class="page-content">
                @yield('content')
            </div>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2023 &copy; Mazer</p>
                    </div>
                    <div class="float-end">
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart-fill icon-mid"></i></span>
                            by <a href="https://saugi.me">Saugi</a></p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/static/js/components/dark.js') }}"></script>
    <script src="{{ asset('assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>

    <script src="{{ asset('assets/compiled/js/app.js') }}"></script>

    {{-- Date --}}
    <script src="{{ asset('assets/extensions/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/static/js/pages/date-picker.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <!-- Need: Apexcharts -->
    {{-- <script src="{{ asset('assets/extensions/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/static/js/pages/dashboard.js') }}"></script> --}}
    {{-- Choice --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('assets/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
    <script src="{{ asset('assets/static/js/pages/form-element-select.js') }}"></script>
    {{-- SweetAlert --}}
    <script src="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/static/js/pages/sweetalert2.js') }}"></script>
    {{-- DataTable --}}
    {{-- <script src="{{ asset('https://code.jquery.com/jquery-3.7.0.js') }}"></script> --}}
    <script src="{{ asset('https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js') }}"></script>
    <!-- Tautan ke file DataTables FixedHeader JS -->
    <script src="https://cdn.datatables.net/fixedheader/3.2.0/js/dataTables.fixedHeader.min.js"></script>
    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js') }}"></script>
    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js') }}"></script>
    <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js') }}"></script>
    <script src="{{ asset('https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });

        // SweetAler
        function goBack() {
            window.history.back();
        }

        $(document).ready(function() {
            $('.select2').select2();
        });

        $(document).ready(function() {
            // Menambahkan gaya CSS langsung di dalam JavaScript
            var style = document.createElement('style');
            style.innerHTML = `
            th {
                white-space: nowrap;
                text-align: center;
                background-color: #435ebe;
                color:white;
            }

            td {
                white-space: nowrap;
                text-align: center;
            }

            table.dataTable {
                border-collapse: collapse;
                border-spacing: 0;
                border-radius: 10px; /* Menambahkan tepi yang membulat */
                overflow: hidden; /* Memastikan tidak ada overflow */
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.15); /* Menambahkan bayangan */
            }`;
            document.head.appendChild(style);
            $('#table1').DataTable({
                dom: '<"row"<"col-md-2"l><"col-md-6"B><"col-md-4"f>>tip',
                buttons: [
                    'csv', 'excel', 'print', 'copy'
                ],
                paging: true,
                scrollCollapse: true,
                scrollX: true,
                scrollY: '100vh',
                fixedHeader: true,
                columnDefs: [{
                    "targets": '_all',
                    "className": 'nowrap'
                }]
            });
        });

        @if (session('success'))
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000 // Durasi tampilan SweetAlert dalam milidetik
            });
        @endif
        // Dapatkan notifikasi dari session
        var notification = @json(session('notification'));

        // Cek apakah notifikasi ada
        if (notification) {
            // Gunakan SweetAlert untuk menampilkan notifikasi
            Swal.fire({
                icon: notification.type,
                title: notification.title,
                text: notification.text,
            });
        }

        // allow Select2 Changes
        document.addEventListener('DOMContentLoaded', function() {
            // Inisialisasi Choices pada semua elemen dengan class "choices"
            const selectElements = document.querySelectorAll('.choices');

            selectElements.forEach((select) => {
                new Choices(select, {
                    // ... Opsi lainnya ...
                    allowHTML: true, // Atur allowHTML ke true untuk merender HTML
                });
            });
        });

        // DataTables
        $(document).ready(function() {
            // $('#table1').DataTable({
            //     dom: '<"row"<"col-md-2"l><"col-md-6"B><"col-md-4"f>>tip',
            //     buttons: [
            //         'csv', 'excel', 'print', 'copy'
            //     ],
            //     scrollX: true,
            // });
        });
    </script>
    @yield('script')
</body>

</html>
