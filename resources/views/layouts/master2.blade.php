<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title> {{ env('APP_TITLE') }} @yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    {{-- <link rel="icon" href="../assets/img/icon.ico" type="image/x-icon" /> --}}
    <link rel="icon" href="{{ asset('img/icon.ico') }}" type="image/x-icon" />

    <!-- Fonts and icons -->
    {{-- <script src="../../assets/js/plugin/webfont/webfont.min.js"></script> --}}
    <script src="{{ asset('../../assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Lato:300,400,700,900"]
            },
            custom: {
                families: ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
                    "simple-line-icons"
                ],
                // urls: ["../../assets/css/fonts.min.css"]
                urls: ["{{ asset('../../assets/css/fonts.min.css') }}"]
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->
    {{-- <link rel="stylesheet" href="../../assets/css/bootstrap.min.css" /> --}}
    <link rel="stylesheet" href="{{ asset('../../assets/css/bootstrap.min.css') }}" />
    {{-- <link rel="stylesheet" href="../../assets/css/atlantis.min.css" /> --}}
    <link rel="stylesheet" href="{{ asset('../../assets/css/atlantis.min.css') }}" />

    {{-- Select2 CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script> --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <!-- Or for RTL support -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />


    <!-- jQuery -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> --}}
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-tagsinput/1.3.6/jquery.tagsinput.min.css">
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery-tagsinput/1.3.6/jquery.tagsinput.min.js"></script>
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('js/jquery-customselect.js') }}"></script>
    <link href="{{ asset('css/jquery-customselect.css') }}" rel='stylesheet' />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.0.0-rc.4/dist/js/tom-select.complete.min.js"></script>

    {{-- Select 2 --}}
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <!-- Scripts -->
    {{-- <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>


</head>

<body>
    <div class="wrapper">
        <div class="main-header">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="blue">
                <a href="{{ asset('../index.html') }}" class="logo">
                    <img src="{{ asset('assets/img/logo akui.png') }}" alt="navbar brand"
                        class="avatar-img navbar-brand" style="width: 100px; height: 50px;">
                </a>
                <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
                    data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <i class="icon-menu"></i>
                    </span>
                </button>
                <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
                <div class="nav-toggle">
                    <button class="btn btn-toggle toggle-sidebar">
                        <i class="icon-menu"></i>
                    </button>
                </div>
            </div>
            <!-- End Logo Header -->

            <!-- Navbar Header -->
            <nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
                <div class="container-fluid">
                    <div class="collapse" id="search-nav">
                        <form class="navbar-left navbar-form nav-search mr-md-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="submit" class="btn btn-search pr-1">
                                        <i class="fa fa-search search-icon"></i>
                                    </button>
                                </div>
                                <input type="text" placeholder="Search ..." class="form-control">
                            </div>
                        </form>
                    </div>
                    <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                        <li class="nav-item dropdown hidden-caret">
                            <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bell"></i>
                                <span class="notification">4</span>
                            </a>
                            <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                                <li>
                                    <div class="dropdown-title">You have 4 new notification</div>
                                </li>
                                <li>
                                    <div class="notif-center">
                                        <a href="#">
                                            <div class="notif-icon notif-primary"> <i class="fa fa-user-plus"></i>
                                            </div>
                                            <div class="notif-content">
                                                <span class="block">
                                                    New user registered
                                                </span>
                                                <span class="time">5 minutes ago</span>
                                            </div>
                                        </a>
                                        <a href="#">
                                            <div class="notif-icon notif-success"> <i class="fa fa-comment"></i>
                                            </div>
                                            <div class="notif-content">
                                                <span class="block">
                                                    Rahmad commented on Admin
                                                </span>
                                                <span class="time">12 minutes ago</span>
                                            </div>
                                        </a>
                                        <a href="#">
                                            <div class="notif-img">
                                                <img src="{{ asset('../../assets/img/profile2.jpg') }}"
                                                    alt="Img Profile">
                                            </div>
                                            <div class="notif-content">
                                                <span class="block">
                                                    Reza send messages to you
                                                </span>
                                                <span class="time">12 minutes ago</span>
                                            </div>
                                        </a>
                                        <a href="#">
                                            <div class="notif-icon notif-danger"> <i class="fa fa-heart"></i> </div>
                                            <div class="notif-content">
                                                <span class="block">
                                                    Farrah liked Admin
                                                </span>
                                                <span class="time">17 minutes ago</span>
                                            </div>
                                        </a>
                                    </div>
                                </li>
                                <li>
                                    <a class="see-all" href="javascript:void(0);">See all notifications<i
                                            class="fa fa-angle-right"></i> </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown hidden-caret">
                            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                            <ul class="dropdown-menu dropdown-user animated fadeIn">
                                <div class="dropdown-user-scroll scrollbar-outer">
                                    <li>
                                        <div class="user-box">
                                            <div class="avatar-lg"><img
                                                    src="{{ asset('../../assets/img/profile.jpg') }}"
                                                    alt="image profile" class="avatar-img rounded"></div>
                                            <div class="u-text">
                                                <h4>Hizrian</h4>
                                                <p class="text-muted">hello@example.com</p><a href="profile.html"
                                                    class="btn btn-xs btn-secondary btn-sm">View Profile</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Account Setting</a>
                                        <div class="dropdown-divider"></div>
                                        {{-- <form method="POST" action="{{ route('logout') }}">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button class="dropdown-item" type="submit"
                                                onclick="confirm('Apakah Anda Yakin ingin logout?')">Logout</button>
                                        </form> --}}
                                        {{-- <a class="dropdown-item" href="">Logout</a></li> --}}
                                    </li>
                                </div>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- End Navbar -->
        </div>

        <!-- Sidebar -->
        <div class="sidebar sidebar-style-2">
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <ul class="nav nav-primary">
                        <li class="nav-item active">
                            <a data-toggle="collapse" href="{{ url('/') }}" class="collapsed"
                                aria-expanded="false">
                                <i class="fas fa-home" style="margin-right: 10px"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="fa fa-ellipsis-h"></i>
                            </span>
                            <h4 class="text-section">Menu</h4>
                        </li>
                        <li class="nav-item">
                            <a data-toggle="collapse" href="#base">
                                <i class="fas fa-layer-group" style="margin-right: 10px"></i>
                                <p>Master</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="base">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="{{ url('/unit') }}">
                                            <span class="sub-item">Unit</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/work') }}">
                                            <span class="sub-item">Workstation</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/biayahpp') }}">
                                            <span class="sub-item">Biaya HPP</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/master_supplier_raw_material') }}">
                                            <span class="sub-item">Supplier Raw
                                                Material</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/master_jenis_raw_material') }}">
                                            <span class="sub-item">Jenis Raw
                                                Material</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/master_tujuan_kirim_raw_material') }}">
                                            <span class="sub-item">Tujuan
                                                Kirim Raw Material</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a data-toggle="collapse" href="#sidebarLayouts">
                                <i class="fas fa-th-list" style="margin-right: 10px"></i>
                                <p>Purchasing & EXIM</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="sidebarLayouts">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="{{ url('/purchasing_exim/prm_raw_material_input') }}">
                                            <span class="sub-item">Prm Raw Material Input</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/purchasing_exim/prm_raw_material_stock') }}">
                                            <span class="sub-item">Prm Raw Material Stock</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/PrmRawMaterialOutput') }}">
                                            <span class="sub-item">Prm Raw Material Output</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/StockTransitGradingKasar') }}">
                                            <span class="sub-item">Stock Transit Grading Kasar</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="mx-4 mt-2">
                            <a href="https://instagram.com/ael_ahyar" class="btn btn-primary btn-block"><span
                                    class="btn-label mr-2"> <i class="fa fa-heart"></i> </span>Revisi</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="content">
                <div class="page-inner">
                    <div class="page-header">
                        <h4 class="page-title">@yield('Menu')</h4>
                        <ul class="breadcrumbs">
                            <li class="nav-home">
                                <a href="{{ url('/') }}">
                                    <i class="flaticon-home"></i>
                                </a>
                            </li>
                            <li class="separator">
                                <i class="flaticon-right-arrow"></i>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/') }}">@yield('title')</a>
                            </li>
                            <li class="separator">
                                <i class="flaticon-right-arrow"></i>
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        @yield('content')
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <nav class="pull-left">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link" href="https://www.themekita.com"> ThemeKita </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"> Help </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"> Licenses </a>
                            </li>
                        </ul>
                    </nav>
                    <div class="copyright ml-auto">2018, made with <i class="fa fa-heart heart text-danger"></i> by <a
                            href="https://www.themekita.com">ThemeKita</a></div>
                </div>
            </footer>
        </div>

        <!-- Custom template | don't include it in your project! -->
        <div class="custom-template">
            <div class="title">Settings</div>
            <div class="custom-content">
                <div class="switcher">
                    <div class="switch-block">
                        <h4>Logo Header</h4>
                        <div class="btnSwitch">
                            <button type="button" class="changeLogoHeaderColor" data-color="dark"></button>
                            <button type="button" class="selected changeLogoHeaderColor" data-color="blue"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="purple"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="light-blue"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="green"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="orange"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="red"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="white"></button>
                            <br />
                            <button type="button" class="changeLogoHeaderColor" data-color="dark2"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="blue2"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="purple2"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="light-blue2"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="green2"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="orange2"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="red2"></button>
                        </div>
                    </div>
                    <div class="switch-block">
                        <h4>Navbar Header</h4>
                        <div class="btnSwitch">
                            <button type="button" class="changeTopBarColor" data-color="dark"></button>
                            <button type="button" class="changeTopBarColor" data-color="blue"></button>
                            <button type="button" class="changeTopBarColor" data-color="purple"></button>
                            <button type="button" class="changeTopBarColor" data-color="light-blue"></button>
                            <button type="button" class="changeTopBarColor" data-color="green"></button>
                            <button type="button" class="changeTopBarColor" data-color="orange"></button>
                            <button type="button" class="changeTopBarColor" data-color="red"></button>
                            <button type="button" class="changeTopBarColor" data-color="white"></button>
                            <br />
                            <button type="button" class="changeTopBarColor" data-color="dark2"></button>
                            <button type="button" class="selected changeTopBarColor" data-color="blue2"></button>
                            <button type="button" class="changeTopBarColor" data-color="purple2"></button>
                            <button type="button" class="changeTopBarColor" data-color="light-blue2"></button>
                            <button type="button" class="changeTopBarColor" data-color="green2"></button>
                            <button type="button" class="changeTopBarColor" data-color="orange2"></button>
                            <button type="button" class="changeTopBarColor" data-color="red2"></button>
                        </div>
                    </div>
                    <div class="switch-block">
                        <h4>Sidebar</h4>
                        <div class="btnSwitch">
                            <button type="button" class="selected changeSideBarColor" data-color="white"></button>
                            <button type="button" class="changeSideBarColor" data-color="dark"></button>
                            <button type="button" class="changeSideBarColor" data-color="dark2"></button>
                        </div>
                    </div>
                    <div class="switch-block">
                        <h4>Background</h4>
                        <div class="btnSwitch">
                            <button type="button" class="changeBackgroundColor" data-color="bg2"></button>
                            <button type="button" class="changeBackgroundColor selected" data-color="bg1"></button>
                            <button type="button" class="changeBackgroundColor" data-color="bg3"></button>
                            <button type="button" class="changeBackgroundColor" data-color="dark"></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="custom-toggle">
                <i class="flaticon-settings"></i>
            </div>
        </div>
        <!-- End Custom template -->
    </div>
    <!--   Core JS Files   -->
    {{-- <script src="../../assets/js/core/jquery.3.2.1.min.js"></script> --}}
    <script src="{{ asset('../../assets/js/core/jquery.3.2.1.min.js') }}"></script>
    {{-- <script src="../../assets/js/core/popper.min.js"></script> --}}
    <script src="{{ asset('../../assets/js/core/popper.min.js') }}"></script>
    {{-- <script src="../../assets/js/core/bootstrap.min.js"></script> --}}
    <script src="{{ asset('../../assets/js/core/bootstrap.min.js') }}"></script>

    <!-- jQuery UI -->
    {{-- <script src="../../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script> --}}
    <script src="{{ asset('../../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
    {{-- <script src="../../assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script> --}}
    <script src="{{ asset('../../assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>

    <!-- jQuery Scrollbar -->
    {{-- <script src="../../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script> --}}
    <script src="{{ asset('../../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

    <!-- Chart JS -->
    <script src="../../assets/js/plugin/chart.js/chart.min.js"></script>

    <!-- jQuery Sparkline -->
    {{-- <script src="../../assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script> --}}
    <script src="{{ asset('../../assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- Chart Circle -->
    {{-- <script src="../../assets/js/plugin/chart-circle/circles.min.js"></script> --}}
    <script src="{{ asset('../../assets/js/plugin/chart-circle/circles.min.js') }}"></script>

    <!-- Datatables -->
    {{-- <script src="../../assets/js/plugin/datatables/datatables.min.js"></script> --}}
    <script src="{{ asset('../../assets/js/plugin/datatables/datatables.min.js') }}"></script>

    <!-- Bootstrap Notify -->
    {{-- <script src="../../assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script> --}}

    <!-- jQuery Vector Maps -->
    {{-- <script src="../../assets/js/plugin/jqvmap/jquery.vmap.min.js"></script> --}}
    <script src="{{ asset('../../assets/js/plugin/jqvmap/jquery.vmap.min.js') }}"></script>
    {{-- <script src="../../assets/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script> --}}
    <script src="{{ asset('../../assets/js/plugin/jqvmap/maps/jquery.vmap.world.js') }}"></script>

    <!-- Sweet Alert -->
    {{-- <script src="../../assets/js/plugin/sweetalert/sweetalert.min.js"></script> --}}
    <script src="{{ asset('../../assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

    <!-- Atlantis JS -->
    {{-- <script src="../../assets/js/atlantis.min.js"></script> --}}
    <script src="{{ asset('../../assets/js/atlantis.min.js') }}"></script>

    {{-- Setingan --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>

    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('assets/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('assets/demo/chart-bar-demo.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
    <script src="{{ asset('js/multi-input.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/core/jquery.3.2.1.min.js') }}"></script> --}}
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/chart.js/chart.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/chart-circle/circles.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/datatables/datatables.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script> --}}
    <script src="{{ asset('assets/js/plugin/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/jqvmap/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/js/atlantis.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
    {{-- Select2 --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script>
        function goBack() {
            window.history.back();
        }

        // Select2
        $(document).ready(function() {
            $('#basic-datatables').DataTable({});

            $('#multi-filter-select').DataTable({
                "pageLength": 10,
                initComplete: function() {
                    this.api().columns().every(function() {
                        var column = this;
                        var select = $(
                                '<select class="form-control"><option value=""></option></select>'
                            )
                            .appendTo($(column.footer()).empty())
                            .on('change', function() {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );

                                column
                                    .search(val ? '^' + val + '$' : '', true, false)
                                    .draw();
                            });

                        column.data().unique().sort().each(function(d, j) {
                            select.append('<option value="' + d + '">' + d +
                                '</option>')
                        });
                    });
                }
            });

            // Add Row
            $('#add-row').DataTable({
                "pageLength": 10,
            });

            var action =
                '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

            $('#addRowButton').click(function() {
                $('#add-row').dataTable().fnAddData([
                    $("#addName").val(),
                    $("#addPosition").val(),
                    $("#addOffice").val(),
                    action
                ]);
                $('#addRowModal').modal('hide');

            });
        });


        $('#basic-usage').select2({
            theme: "bootstrap-5",
            width: '100%',
            placeholder: $(this).data('placeholder'),
            maximumSelectionLength: 1, // Batasi pemilihan hanya satu opsi
        });
    </script>

    @yield('script')
</body>

</html>
