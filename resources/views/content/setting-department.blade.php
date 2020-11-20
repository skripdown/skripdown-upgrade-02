<!DOCTYPE html>
<html lang="{{env('APP_LANG')}}" dir="{{env('APP_DIR')}}">
<head>
    <meta charset="{{env('APP_CHARSET')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="{{env('APP_VIEWPORT')}}">
    <meta name="description" content="{{env('APP_DESCRIPTION')}}">
    <meta name="author" content="{{env('APP_AUTHOR')}}">
    <!--SAMPLE:tab-icon-->
    <link rel="icon" type="image/png" href="{{asset(env('ICON_PATH'))}}">
    <link rel="stylesheet" href="{{asset(env('LIB_PATH').'extra/c3/c3.min.css')}}">
    <link rel="stylesheet" href="{{asset(env('LIB_PATH').'core/chartist/dist/chartist.min.css')}}">
    <link rel="stylesheet" href="{{asset(env('LIB_PATH').'extra/jvector/jquery-jvectormap-2.0.2.css')}}">
    <link rel="stylesheet" href="{{asset(env('LIB_PATH').'extra/prism/prism.css')}}">
    <link rel="stylesheet" href="{{asset(env('LIB_PATH').'extra/datatables.net-bs4/css/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset(env('CSS_PATH').'style.min.css')}}">
    <script src="{{asset(env('LIB_PATH').'extra/html5shiv/html5shiv.js')}}"></script>
    <script src="{{asset(env('LIB_PATH').'extra/respond/respond.js')}}"></script>
    <title>Pengaturan - {{}}</title>
</head>
<body>
<div class="preloader">
    <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
    </div>
</div>
<div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">

    <header class="topbar" data-navbarbg="skin6">
        <nav class="navbar top-navbar navbar-expand-md">
            <div class="navbar-header" data-logobg="skin6">

                <a href="javascript:void(0)" class="nav-toggler waves-effect waves-light d-block d-md-none">
                    <i class="ti-menu ti-close"></i>
                </a>
                <div class="navbar-brand">
                    <a href="{{url('/pengaturan')}}">
                        <b class="logo-icon">
                            <img src="{{asset(env('ICON_PATH'))}}" alt="homepage" class="dark-logo" style="width: 5.5em;margin-top: 1em;margin-left: 1em">
                            <img src="{{asset(env('ICON_PATH'))}}" alt="homepage" class="light-logo" style="width: 5.5em;margin-top: 1em;margin-left: 1em">
                        </b>
                        <span class="logo-text" >
                        </span>
                    </a>
                </div>
                <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="ti-more"></i>
                </a>
            </div>
            <div class="navbar-collapse collapse" id="navbarSupportedContent">
                <!--COMPONENT:header-nav-->
                <ul class="navbar-nav float-left mr-auto ml-3 pl-1">
                </ul>
                <!--COMPONENT:header-nav-right-->
                <ul class="navbar-nav float-right">
                    <!--COMPONENT:user-profile-->
                    <li class="nav-item dropdown">
                        <a href="javascript:void(0)" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <!--COMPONENT:user-profile-name-->
                            <span class="ml-2 d-none d-lg-inline-block">
                                    <span class="text-dark">
                                        Profil
                                        <i data-feather="chevron-down" class="svg-icon"></i>
                                    </span>
                                </span>
                        </a>
                        <!--COMPONENT:user-profile-menu-->
                        <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                            <a href="javascript:void(0)" class="dropdown-item">
                                <i data-feather="power" class="svg-icon mr-2 ml-1"></i>
                                Keluar
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <aside class="left-sidebar" data-sidebarbg="skin6">
        <div class="scroll-sidebar" data-sidebarbg="skin6">
            <nav class="sidebar-nav">
                <ul id="sidebarnav">
                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="{{url('/dashboard')}}" aria-expanded="false">
                            <i data-feather="home" class="feather-icon"></i>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link sidebar-link" href="{{url('/ujianPlagiasi')}}" aria-expanded="false">
                            <i data-feather="clock" class="feather-icon"></i>
                            <span class="hide-menu">Ujian dan Plagiasi</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </aside>
    <div class="page-wrapper">
        <!--COMPONENT:main-content-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-header bg-white pt-3" style="margin-bottom: -1.5em">
                            <h3 class="card-title">Pengaturan</h3>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title opacity-7">Plagiasi dan Ujian</h4>
                            <hr>
                            <div class="row pb-3">
                                <div class="col-4 text-right">
                                    <h6 class="card-title opacity-7" style="height: 100%">
                                        <span style="position: relative;top: 35%">BAB I</span>
                                    </h6>
                                </div>
                                <div class="col-5">
                                    <label for="setting-in-bab-i" class="d-none"></label>
                                    <input id="setting-in-bab-i" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col-4 text-right">
                                    <h6 class="card-title opacity-7" style="height: 100%">
                                        <span style="position: relative;top: 35%">BAB II</span>
                                    </h6>
                                </div>
                                <div class="col-5">
                                    <label for="setting-in-bab-ii" class="d-none"></label>
                                    <input id="setting-in-bab-ii" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col-4 text-right">
                                    <h6 class="card-title opacity-7" style="height: 100%">
                                        <span style="position: relative;top: 35%">BAB III</span>
                                    </h6>
                                </div>
                                <div class="col-5">
                                    <label for="setting-in-bab-iii" class="d-none"></label>
                                    <input id="setting-in-bab-iii" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col-4 text-right">
                                    <h6 class="card-title opacity-7" style="height: 100%">
                                        <span style="position: relative;top: 35%">BAB IV</span>
                                    </h6>
                                </div>
                                <div class="col-5">
                                    <label for="setting-in-bab-iv" class="d-none"></label>
                                    <input id="setting-in-bab-iv" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col-4 text-right">
                                    <h6 class="card-title opacity-7" style="height: 100%">
                                        <span style="position: relative;top: 35%">BAB V</span>
                                    </h6>
                                </div>
                                <div class="col-5">
                                    <label for="setting-in-bab-v" class="d-none"></label>
                                    <input id="setting-in-bab-v" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col-4 text-right"></div>
                                <div class="col-5">
                                    <p class="text-muted font-1 ">
                                        <span class="text-dark font-weight-bolder font-16">* </span>
                                        Mengatur standar nilai plagiarisme skripsi untuk setiap bab
                                    </p>
                                </div>
                            </div>
                            <div class="row pb-3 pt-3">
                                <div class="col-9 text-right">
                                    <button class="btn btn-info btn-primary" id="btn-sub-std">simpan</button>
                                </div>
                            </div>
                            <h4 class="card-title opacity-7">Akun</h4>
                            <hr>
                            <div class="row pb-3">
                                <div class="col-4 text-right">
                                    <h6 class="card-title opacity-7" style="height: 100%">
                                        <span style="position: relative;top: 35%">sandi lama</span>
                                    </h6>
                                </div>
                                <div class="col-5">
                                    <label for="setting-in-old-pass" class="d-none"></label>
                                    <input id="setting-in-old-pass" type="password" class="form-control">
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col-4 text-right">
                                    <h6 class="card-title opacity-7" style="height: 100%">
                                        <span style="position: relative;top: 35%">sandi baru</span>
                                    </h6>
                                </div>
                                <div class="col-5">
                                    <label for="setting-in-new-pass" class="d-none"></label>
                                    <input id="setting-in-new-pass" type="password" class="form-control">
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col-4 text-right">
                                    <h6 class="card-title opacity-7" style="height: 100%">
                                        <span style="position: relative;top: 35%">konfirmasi</span>
                                    </h6>
                                </div>
                                <div class="col-5">
                                    <label for="setting-in-confirm" class="d-none"></label>
                                    <input id="setting-in-confirm" type="password" class="form-control">
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col-4 text-right"></div>
                                <div class="col-5">
                                    <p class="text-muted font-1 ">
                                        <span class="text-dark font-weight-bolder font-16">* </span>
                                        Mengatur informasi keamanan akun dengan mengganti kata sandi
                                    </p>
                                </div>
                            </div>
                            <div class="row pb-3 pt-3">
                                <div class="col-9 text-right">
                                    <button class="btn btn-info btn-primary" id="btn-sub-pass">simpan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3"></div>
            </div>
        </div>
        <!--COMPONENT:main-footer-->
        <footer class="footer text-center text-muted">
            {{env('APP_NAME').' v'.env('APP_VERSION').' '.env('APP_DEV_STATUS').'.'}}
        </footer>
    </div>
</div>
<script src="{{asset(env('LIB_PATH').'core/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset(env('LIB_PATH').'core/popper.js/dist/umd/popper.min.js')}}"></script>
<script src="{{asset(env('LIB_PATH').'core/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset(env('JS_PATH').'app-style-switcher.js')}}"></script>
<script src="{{asset(env('JS_PATH').'feather.min.js')}}"></script>
<script src="{{asset(env('LIB_PATH').'core/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')}}"></script>
<script src="{{asset(env('JS_PATH').'sidebarmenu.js')}}"></script>
<script src="{{asset(env('JS_PATH').'custom.min.js')}}"></script>
<script src="{{asset(env('LIB_PATH').'extra/c3/d3.min.js')}}"></script>
<script src="{{asset(env('LIB_PATH').'extra/c3/c3.min.js')}}"></script>
<script src="{{asset(env('LIB_PATH').'core/chartist/dist/chartist.min.js')}}"></script>
<script src="{{asset(env('LIB_PATH').'core/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js')}}"></script>
<script src="{{asset(env('LIB_PATH').'extra/jvector/jquery-jvectormap-2.0.2.min.js')}}"></script>
<script src="{{asset(env('LIB_PATH').'extra/jvector/jquery-jvectormap-world-mill-en.js')}}"></script>
<script src="{{asset(env('JS_PATH').'pages/dashboards/dashboard1.min.js')}}"></script>
<script src="{{asset(env('LIB_PATH').'extra/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset(env('JS_PATH').'pages/datatable/datatable-basic.init.js')}}"></script>
<script src="{{asset(env('LIB_PATH').'extra/prism/prism.js')}}"></script>
<script>
    let standard_bi,
        standard_bii,
        standard_biii,
        standard_biv,
        standard_bv,
        inp_bi,
        inp_bii,
        inp_biii,
        inp_biv,
        inp_bv,
        sub_std,
        sub_pass,
        inp_old_pass,
        inp_new_pass,
        submitable_pass,
        inp_conf_pass;
    $(document).ready(()=>{
        submitable_pass = false;
        inp_bi          = $('#in-bab-i').get(0);
        inp_bii         = $('#in-bab-ii').get(0);
        inp_biii        = $('#in-bab-iii').get(0);
        inp_biv         = $('#in-bab-iv').get(0);
        inp_bv          = $('#in-bab-v').get(0);
        sub_std         = $('#btn-sub-std').get(0);
        sub_pass        = $('#btn-sub-pass').get(0);
        inp_old_pass    = $('#setting-in-old-pass').get(0);
        inp_new_pass    = $('#setting-in-new-pass').get(0);
        inp_conf_pass   = $('#setting-in-confirm').get(0);
        $.ajax({
            type    : 'POST',
            url     : '{{url('getplag')}}',
            data    : {_token:'csrf_token() here'},
            success : (data)=>{
                standard_bi     = data.b_i;
                standard_bii    = data.b_ii;
                standard_biii   = data.b_iii;
                standard_biv    = data.b_iv;
                standard_bv     = data.b_v;
            }
        });
        $(inp_old_pass).keyup(function () {
            $(inp_old_pass).removeClass('border-danger');
            check();
        });
        $(inp_new_pass).keyup(check);
        $(inp_conf_pass).keyup(check);
        $(sub_std).click(function () {
            if (std_form_check) {
                $.ajax({
                    type    : 'POST',
                    url     : '{{url('plagconf')}}',
                    data    : {
                        _token:'{{csrf_token()}}',
                        bi:$(inp_bi).val(),
                        bii:$(inp_bii).val(),
                        biii:$(inp_biii).val(),
                        biv:$(inp_biv).val(),
                        bv:$(inp_bv).val(),
                    },
                    success : (data)=>{
                        console.log(data);
                    }
                });
            }
        });
        $(sub_pass).click(function () {
            if ($(inp_old_pass).val() !== '' && submitable_pass) {
                $.ajax({
                    type    : 'POST',
                    url     : '{{url('deptpass')}}',
                    data    : {
                        _token:'{{csrf_token()}}',
                        old_pass:$(inp_old_pass).val(),
                        new_pass:$(inp_new_pass).val()
                    },
                    success : (data)=>{
                        if (data.status === '0') {
                            $(inp_old_pass).addClass('border-danger');
                        }
                        else {
                            $(inp_old_pass).val('');
                            $(inp_new_pass).val('');
                            $(inp_conf_pass).val('');
                        }
                    }
                    //password configuration
                    //return nothing if success
                    //border-danger if old pass wrong
                });
            }
        });
        function check() {
            const newPass = $(inp_new_pass).val();
            const cnfPass = $(inp_conf_pass).val();
            if (newPass === '') {
                if (cnfPass === '') {
                    $(inp_new_pass).removeClass('border-danger');
                    $(inp_conf_pass).removeClass('border-danger');
                    submitable_pass = true;
                }
                else {
                    $(inp_new_pass).removeClass('border-danger');
                    $(inp_conf_pass).addClass('border-danger');
                    submitable_pass = false;
                }
            }
            else {
                if (cnfPass === '') {
                    $(inp_new_pass).removeClass('border-danger');
                    $(inp_conf_pass).removeClass('border-danger');
                    submitable_pass = true;
                }
                else {
                    $(inp_new_pass).removeClass('border-danger');
                    $(inp_conf_pass).addClass('border-danger');
                    submitable_pass = false;
                }
            }
        }
        function std_form_check() {
            let valid   = true;
            const bi_   = $(inp_bi).val();
            const bii_  = $(inp_bii).val();
            const biii_ = $(inp_biii).val();
            const biv_  = $(inp_biv).val();
            const bv_   = $(inp_bv).val();
            if (/^(100(\.0+)?|\d{1,2}(\.\d+)?)$/m.exec(bi_) == null) {$(inp_bi).addClass('border-danger');valid = false;}
            else $(inp_bi).removeClass('border-danger');
            if (/^(100(\.0+)?|\d{1,2}(\.\d+)?)$/m.exec(bii_) == null) {$(inp_bii).addClass('border-danger');valid = false;}
            else $(inp_bii).removeClass('border-danger');
            if (/^(100(\.0+)?|\d{1,2}(\.\d+)?)$/m.exec(biii_) == null) {$(inp_biii).addClass('border-danger');valid = false;}
            else $(inp_biii).removeClass('border-danger');
            if (/^(100(\.0+)?|\d{1,2}(\.\d+)?)$/m.exec(biv_) == null) {$(inp_biv).addClass('border-danger');valid = false;}
            else $(inp_biv).removeClass('border-danger');
            if (/^(100(\.0+)?|\d{1,2}(\.\d+)?)$/m.exec(bv_) == null) {$(inp_bv).addClass('border-danger');valid = false;}
            else $(inp_bv).removeClass('border-danger');
            return valid;
        }
    });
</script>
</body>
</html>
