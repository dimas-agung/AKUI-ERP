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
                        <form action="{{ route('logout') }}" method="POST">
                            @method('POST')
                            {{ csrf_field() }}
                            <button type="submit">LOGOUT</button>
                        </form>
                    </li>
                    <li class="sidebar-item  {{ Request::is('/') ? 'active' : '' }} ">
                        <a href="{{ route('home') }}" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-title">Master</li>
                    <li
                        class="sidebar-item  has-sub {{ Request::is('perusahaan*', 'workstation*', 'unit*', 'biayahpp*', 'master_supplier_raw_material*', 'master_jenis_raw_material*', 'master_tujuan_kirim_raw_material*', 'master_jenis_grading_kasar*', 'master_tujuan_kirim_grading_kasar*', 'master_operator*', 'master_ongkos_cuci*', 'master_jenis_grading_halus*') ? 'active' : '' }}">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-stack"></i>
                            <span>Master</span>
                        </a>
                        <ul class="submenu">
                            <li class="submenu-item {{ Request::is('perusahaan*') ? 'active' : '' }}">
                                <a href="{{ route('Perusahaan.index') }}" class="submenu-link">Master
                                    Perusahaan</a>
                            </li>
                            <li class="submenu-item  {{ Request::is('workstation*') ? 'active' : '' }} ">
                                <a href="{{ route('Workstation.index') }}" class="submenu-link">Workstation</a>
                            </li>
                            <li class="submenu-item {{ Request::is('unit*') ? 'active' : '' }}">
                                <a href="{{ route('Unit.index') }}" class="submenu-link">Master Unit</a>
                            </li>
                            <li class="submenu-item {{ Request::is('biaya_hpp*') ? 'active' : '' }}">
                                <a href="{{ route('BiayaHpp.index') }}" class="submenu-link">Master Biaya HPP</a>
                            </li>
                            <li
                                class="submenu-item {{ Request::is('master_supplier_raw_material*') ? 'active' : '' }}">
                                <a href="{{ route('MasterSupplierRawMaterial.index') }}"
                                    class="submenu-link">Master Supplier Raw Material</a>
                            </li>
                            <li
                                class="submenu-item {{ Request::is('master_jenis_raw_material*') ? 'active' : '' }}">
                                <a href="{{ route('MasterJenisRawMaterial.index') }}" class="submenu-link">Master
                                    Jenis
                                    Raw Material</a>
                            </li>
                            <li
                                class="submenu-item {{ Request::is('master_tujuan_kirim_raw_material*') ? 'active' : '' }}">
                                <a href="{{ route('MasterTujuanKirimRawMaterial.index') }}"
                                    class="submenu-link">Master Tujuan Kirim Raw Material</a>
                            </li>
                            <li
                                class="submenu-item {{ Request::is('master_tujuan_kirim_grading_halus*') ? 'active' : '' }}">
                                <a href="{{ route('MasterTujuanKirimGradingHalus.index') }}"
                                    class="submenu-link">Master Tujuan Kirim Grading Halus</a>
                            </li>
                            <li class="submenu-item {{ Request::is('master_ongkos_cuci*') ? 'active' : '' }}">
                                <a href="{{ route('MasterOngkosCuci.index') }}" class="submenu-link">Master
                                    Ongkos Cuci</a>
                            </li>
                            <li
                                class="submenu-item {{ Request::is('master_jenis_grading_kasar*') ? 'active' : '' }}">
                                <a href="{{ route('MasterJenisGradingKasar.index') }}"
                                    class="submenu-link">Master Jenis Grading Kasar</a>
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
                            <li class="submenu-item  {{ Request::is('master_ongkos_cuci*') ? 'active' : '' }} ">
                                <a href="{{ route('MasterOngkosCuci.index') }}" class="submenu-link">Master <br>
                                    Ongkos Cuci</a>
                            </li>
                            <li
                                class="submenu-item  {{ Request::is('master_jenis_grading_halus*') ? 'active' : '' }} ">
                                <a href="{{ route('MasterJenisGradingHalus.index') }}"
                                    class="submenu-link">Master Jenis<br>Grading Halus
                                </a>
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
                        class="sidebar-item has-sub {{ Request::is('stock_transit_raw_material*', 'grading_kasar_input*', 'grading_kasar_hasil*', 'grading_kasar_stock*', 'grading_kasar_output*', 'stock_transit_grading_kasar*', 'pre_cleaning_input*', 'pre_cleaning_stock*', 'pre_cleaning_output*', 'transit_pre_cleaning_stock*', 'pre_grading_halus_input*', 'pre_grading_halus_stock*', 'pre_grading_halus_adding*', 'pre_grading_halus_adding_stock*', 'grading_halus_stock*', 'grading_halus_adjustment_adding*', 'grading_halus_adjustment_stock*', 'grading_halus_adjustment_input*') ? 'active' : '' }}">
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
                                    {{-- <li
                                        class="submenu-item {{ Request::is('pre_cleaning_stock*') ? 'active' : '' }}">
                                        <a href="{{ route('PreCleaningStock.index') }}"
                                            class="submenu-link">Pre-Cleaning Stock</a>
                                    </li> --}}
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
                                class="submenu-item has-sub {{ Request::is('transit_pre_cleaning_stock*', 'pre_grading_halus_input*', 'pre_grading_halus_stock*', 'pre_grading_halus_adding*', 'pre_grading_halus_adding_stock*', 'adjustment_adding*', 'adjustment_stock*', 'adjustment_input*', 'grading_halus_input*', 'grading_halus_stock*', 'grading_halus_output*') ? 'active' : '' }}">
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
                                        class="submenu-item {{ Request::is('grading_halus_input*') ? 'active' : '' }}">
                                        <a href="{{ route('GradingHalusInput.index') }}"
                                            class="submenu-link">Grading Halus Input</a>
                                    </li>
                                    <li
                                        class="submenu-item {{ Request::is('grading_halus_stock*') ? 'active' : '' }}">
                                        <a href="{{ route('GradingHalusStock.index') }}"
                                            class="submenu-link">Grading Halus Stock</a>
                                    </li>
                                    <li
                                        class="submenu-item {{ Request::is('adjustment_adding') ? 'active' : '' }}">
                                        <a href="{{ route('GradingHalusAdjustmentAdding.index') }}"
                                            class="submenu-link">Adjustment Adding</a>
                                    </li>
                                    <li
                                        class="submenu-item {{ Request::is('grading_halus_adjustment_stock*') ? 'active' : '' }}">
                                        <a href="{{ route('GradingHalusAdjustmentStock.index') }}"
                                            class="submenu-link">Adjustment Stock</a>
                                    </li>
                                    <li
                                        class="submenu-item {{ Request::is('grading_halus_adjustment_input*') ? 'active' : '' }}">
                                        <a href="{{ route('GradingHalusAdjustmentInput.index') }}"
                                            class="submenu-link">Adjustment Input</a>
                                    </li>
                                    <li
                                        class="submenu-item {{ Request::is('grading_halus_output*') ? 'active' : '' }}">
                                        <a href="{{ route('GradingHalusOutput.index') }}"
                                            class="submenu-link">Grading Halus Output</a>
                                    </li>
                                    <li
                                        class="submenu-item {{ Request::is('transit_grading_halus*') ? 'active' : '' }}">
                                        <a href="{{ route('TransitGradingHalus.index') }}"
                                            class="submenu-link">Transit Grading Halus</a>
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
            <nav class="navbar navbar-expand navbar-light navbar-top">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <a href="#" class="burger-btn d-block d-xl-none">
                            <i class="bi bi-justify fs-3"></i>
                        </a>
                        <ul class="navbar-nav ms-auto mb-lg-0">
                        </ul>
                        <div class="dropdown-end">
                            <a href="#" data-bs-toggle="dropdown" aria-expanded="false"
                                class="dropdown-toggle">
                                <div class="user-menu d-flex align-items-center">
                                    <div class="user-name text-end me-3">
                                        <h6 class="mb-0 text-gray-600" style="text-align: center">
                                            {{ Auth::user()->username }}</h6>
                                    </div>
                                    <div class="user-img d-flex align-items-center">
                                        <div class="avatar avatar-md">
                                            <img src="{{ asset('/assets/compiled/jpg/1.jpg') }}">
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton"
                                style="min-width: 11rem;">
                                <li>
                                    <h6 class="dropdown-header">Hello, {{ Auth::user()->username }}!</h6>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><button class="dropdown-item" data-bs-toggle="modal"
                                        data-bs-target="#resetForm"><i class="icon-mid bi bi-gear me-2"></i>
                                        Rubah Kata
                                        Sandi</button></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @method('POST')
                                        {{ csrf_field() }}<button type="submit" class="dropdown-item"
                                            href="#"><i class="icon-mid bi bi-box-arrow-left me-2"></i>
                                            Logout

                                        </button></form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
            <div class="card-body" style="overflow: auto">
                <div class="modal fade text-left border border-primary border-3" id="resetForm" role="dialog"
                    aria-labelledby="myModalLabel33" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                        <div class="modal-content border border-primary border-3">
                            <div class="modal-header">
                                <h5 class="modal-title" id="myModalLabel33">
                                    <span class="fw-mediumbold">
                                        Update</span>
                                    <span class="fw-light">
                                        Password
                                    </span>
                                </h5>
                                <button type="button" class="close" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('reset.create') }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group form-group-default">
                                                <label>Password Lama</label>
                                                <input type="text"
                                                    class="form-control @error('current_password') is-invalid @enderror"
                                                    name="current_password"
                                                    value="{{ old('current_password') }}"
                                                    placeholder="Masukkan password">

                                                <!-- error message untuk title -->
                                                @error('current_password')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group form-group-default">
                                                <label>Password Baru</label>
                                                <input type="password"
                                                    class="form-control @error('new_password') is-invalid @enderror"
                                                    name="new_password" value="{{ old('new_password') }}"
                                                    placeholder="Masukkan Password Baru">

                                                <!-- error message untuk title -->
                                                @error('new_password')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group form-group-default">
                                                <label>Konfirmasi Password Baru</label>
                                                <input type="password"
                                                    class="form-control @error('new_password_confirmation') is-invalid @enderror"
                                                    name="new_password_confirmation"
                                                    value="{{ old('new_password_confirmation') }}"
                                                    placeholder="Konfirmasi Password Baru">

                                                <!-- error message untuk title -->
                                                @error('new_password_confirmation')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer no-bd">
                                    <button type="submit" class="btn btn-primary">Ubah Password</button>
                                    <button type="button" class="btn btn-danger"
                                        data-bs-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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