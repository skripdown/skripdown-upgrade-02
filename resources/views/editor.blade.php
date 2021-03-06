<!DOCTYPE html>
<html lang="{{env('APP_LANG')}}">
<head>
    <title>editor | {{env('APP_NAME')}}</title>
    <meta name="viewport" content="{{env('APP_VIEWPORT')}}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="skripd_read_message" content="{{url('post_read_message')}}">
    <meta name="skripd_propose_advisor" content="{{url('post_propose_advisor')}}">
    <meta name="skripd_submit_repository" content="{{url('post_submit_repository')}}">
    <meta name="skripd_submit_revision" content="{{url('post_submit_revision')}}">
    <meta name="skripd_editor_update" content="{{url('post_editor_update')}}">
    <meta name="skripd_f_words" content="{{url('post_foreign_words')}}">
    <meta name="skripd_autosave" content="{{url('submit_autosave')}}">
    <meta name="skripd_token" content="{{csrf_token()}}">
    <link rel="icon" type="image/png" sizes="{{env('ICON_SIZE')}}" href="{{asset(env('ICON_PATH'))}}">
    <link rel="stylesheet" href="{{asset(env('LIB_PATH').'extra/c3/c3.min.css')}}">
    <link rel="stylesheet" href="{{asset(env('LIB_PATH').'core/chartist/dist/chartist.min.css')}}">
    <link rel="stylesheet" href="{{asset(env('LIB_PATH').'extra/jvector/jquery-jvectormap-2.0.2.css')}}">
    <link rel="stylesheet" href="{{asset(env('LIB_PATH').'extra/prism/prism.css')}}">
    <link rel="stylesheet" href="{{asset(env('LIB_PATH').'extra/datatables.net-bs4/css/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset(env('CSS_PATH').'style.min.css')}}">
    <link rel="stylesheet" href="{{asset(env('CSS_PATH').'added.css')}}">
    <link rel="stylesheet" href="{{asset(env('LIB_PATH').'core/skripdown/preview-style.css')}}">
    <!--suppress CssUnusedSymbol -->
    <style>
        .muted {
            opacity: 0.3;
        }
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-button {
            width: 8px;
            height:5px;
        }
        ::-webkit-scrollbar-track {
            background:white;
        }
        ::-webkit-scrollbar-thumb {
            background:darkgray;
            border: thin solid gray;
            border-radius:10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background:#7d7d7d;
        }
    </style>
    <script src="{{asset(env('LIB_PATH').'extra/html5shiv/html5shiv.js')}}"></script>
    <script src="{{asset(env('LIB_PATH').'extra/respond/respond.js')}}"></script>
</head>
<body>
<div class="preloader">
    <div class="lds-ripple">
        <div class="lds-pos"></div>
        <div class="lds-pos"></div>
    </div>
</div>
<div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-boxed-layout="full">
    <header class="topbar" style="background-color: rgba(234, 250, 241, 0.25)">
        <nav class="navbar top-navbar navbar-expand">
            <div class="navbar-nav pl-4" style="max-width: 10vw;min-width: 10vw;overflow-x: hidden">
                <img src="{{asset(env('ICON_PATH'))}}" alt="" style="height: 80px">
            </div>
            <div class="navbar-nav mr-auto ml-auto" style="opacity: 0">
                <div class="btn-group dropdown">
                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <strong>Heading</strong>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">BAB I</a>
                        <a class="dropdown-item" href="#">BAB II</a>
                        <a class="dropdown-item" href="#">BAB III</a>
                        <a class="dropdown-item" href="#">BAB IV</a>
                        <a class="dropdown-item" href="#">BAB V</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">sub 1.1</a>
                        <a class="dropdown-item" href="#">sub 1.1.1</a>
                        <a class="dropdown-item" href="#">sub 1.1.1.1</a>
                        <a class="dropdown-item" href="#">sub 1.1.1.1.1</a>
                        <a class="dropdown-item" href="#">sub 1.1.1.1.1.1</a>
                    </div>
                </div>
                <div class="btn-list">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-lg"><i class="fa fa-bold"></i></button>
                        <button type="button" class="btn btn-lg"><i class="fa fa-italic"></i></button>
                        <button type="button" class="btn btn-lg"><i class="fa fa-underline"></i></button>
                    </div>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-lg"><i class="fa fa-table"></i></button>
                        <button type="button" class="btn btn-lg"><i class="fa fa-image"></i></button>
                        <button type="button" class="btn btn-lg"><i class="fa fa-list-ol"></i></button>
                        <button type="button" class="btn btn-lg"><i class="fa fa-list-ul"></i></button>
                        <button type="button" class="btn btn-lg"><i class="fa fa-bookmark"></i></button>
                    </div>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-lg"><i class="fa fa-book"></i></button>
                        <button type="button" class="btn btn-lg"><i class="fa fa-print"></i></button>
                    </div>
                </div>
            </div>
            <div class="navbar-nav">
                <div class="btn-list">
                    <div class="btn-group" role="group">
                        @if ($doc != null)
                            <div class="mb-2" id="connection-status"><span>inisialisasi...</span></div>
                        @else
                            <div class="mb-2" id="connection-status"><span>inisialisasi...</span></div>
                            <a id="save" type="button" class="btn btn-lg btn-success" style="color: white">simpan</a>
                        @endif
                    </div>
                </div>
            </div>
            <ul class="navbar-nav float-right" >
                <li class="nav-item d-none" id="display-warning">
                    <a href="javascript:void(0)" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true">
                        <span class="d-none d-inline-block">
                            <span class="text-danger">
                                <i data-feather="alert-triangle" class="svg-icon"></i>
                                <span id="total-warning" class="font-weight-bold"></span>
                            </span>
                        </span>
                    </a>
                    <div id="warning-list" class="dropdown-menu dropdown-menu-right">
                    </div>
                </li>
                <li class="nav-item">
                    <a id="display-code" href="javascript:void(0)" class="nav-link d-none">
                            <span class="d-none d-lg-inline-block">
                                    <span class="text-dark">
                                        <i data-feather="code" class="svg-icon">code</i>
                                    </span>
                                </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a id="display-rendered" href="javascript:void(0)" class="nav-link d-none">
                            <span class="d-none d-lg-inline-block">
                                    <span class="text-dark">
                                        <i data-feather="file-text" class="svg-icon">rendered</i>
                                    </span>
                                </span>
                    </a>
                </li>
                <li class="nav-item dropdown"  id="btn-setting" >
                    <a href="javascript:void(0)" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true">
                            <span class="d-none d-lg-inline-block">
                                    <span class="text-dark">
                                        <i data-feather="settings" class="svg-icon mr-2">settings</i>
                                    </span>
                                </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                        <a href="javascript:void(0)" class="dropdown-item d-none" id="sub-rev-1">
                            <i data-feather="share" class="svg-icon mr-2 ml-1"></i>
                            Submit Revisi Pembimbing 1
                        </a>
                        <a href="javascript:void(0)" class="dropdown-item d-none" id="sub-rev-2">
                            <i data-feather="share" class="svg-icon mr-2 ml-1"></i>
                            Submit Revisi Pembimbing 2
                        </a>
                        <a href="javascript:void(0)" class="dropdown-item d-none" id="rev" data-toggle="modal" data-target="#popup_revisi">
                            <i data-feather="flag" class="svg-icon mr-2 ml-1"></i>
                            Revisi <span id="message-amount" class="text-danger">0</span>
                        </a>
                        <a href="javascript:void(0)" class="dropdown-item d-none" id="sub-rep">
                            <i data-feather="book" class="svg-icon mr-2 ml-1"></i>
                            Submit Repositori
                        </a>
                        <a href="{{url('/parse/'.$doc->url)}}" class="dropdown-item" target="_blank">
                            <i data-feather="printer" class="svg-icon mr-2 ml-1"></i>
                            Parse
                        </a>
                        <a href="javascript:void(0)" id="btn-font-up" class="dropdown-item">
                            <i data-feather="zoom-in" class="svg-icon mr-2 ml-1"></i>
                            Perbesar
                        </a>
                        <a href="javascript:void(0)" id="btn-font-down" class="dropdown-item">
                            <i data-feather="zoom-out" class="svg-icon mr-2 ml-1"></i>
                            Perkecil
                        </a>
                        <a href="javascript:void(0)" id="btn-display-live" class="dropdown-item">
                            <i data-feather="credit-card" class="svg-icon mr-2 ml-1"></i>
                            Mode Live
                        </a>
                        <a href="javascript:void(0)" id="btn-display-code" class="dropdown-item d-none">
                            <i data-feather="code" class="svg-icon mr-2 ml-1"></i>
                            Mode Kode
                        </a>
                        <a href="javascript:void(0)" id="btn-progres-i" class="dropdown-item d-none">
                             <i data-feather="code" class="svg-icon mr-2 ml-1"></i>
                             Progres Dosen I
                        </a>
                        <a href="javascript:void(0)" id="btn-progres-i" class="dropdown-item d-none">
                            <i data-feather="code" class="svg-icon mr-2 ml-1"></i>
                            Progres Dosen II
                        </a>
                        <a href="{{url('logout')}}" class="dropdown-item">
                            <i data-feather="power" class="svg-icon mr-2 ml-1"></i>
                            Keluar
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
    </header>
    <div>
        <div class="container-fluid">
            <form id="form" action="{{url('submit_text')}}" method="POST" enctype="multipart/form-data" hidden>
                @csrf
                @if ($doc != null)
                    <input type="hidden" name="title" id="title-val" value="{{$doc->title}}">
                    <input type="hidden" name="author" id="author-val" value="{{$doc->author}}">
                    <input type="hidden" name="id_" id="id-val" value="{{$doc->id}}">
                    <input type="hidden" name="abstract" id="abstract-val" value="{{$doc->abstract}}">
                    <input type="hidden" name="abstract_key" id="abstract-key-val" value="{{$doc->abstract_key}}">
                    <input type="hidden" name="text" id="text-val" value="{{$doc->text}}">
                    <input type="hidden" name="university" id="university-val" value="{{$doc->university}}">
                    <input type="hidden" name="department" id="department-val" value="{{$doc->department}}">
                    <input type="hidden" name="faculty" id="faculty-val" value="{{$doc->faculty}}">
                    <input type="hidden" name="parse" id="parse-val" value="{{$doc->parse}}">
                    <input type="hidden" name="url" id="url-val" value="{{$doc->url}}">
                    <input type="hidden" name="conf_font" id="conf-font-val" value="{{$doc->conf_font}}">
                    <input type="hidden" name="l1_id" id="lec1-val" value="{{$doc->conf_font}}">
                    <input type="hidden" name="l1_name" id="lec1-name-val" value="{{$doc->conf_font}}">
                    <input type="hidden" name="l2_id" id="lec2-val" value="{{$doc->conf_font}}">
                    <input type="hidden" name="l2_name" id="lec2-name-val" value="{{$doc->conf_font}}">
                @endif
            </form>
            <div class="row">
                <div class="col-12">
                    <div class="row mt5 bg-white border-top" style="height: 86.5vh;">
                        <div id="panel-1" class="col-xl-12 col-lg-12 col-m-12 mr-auto ml-auto" style="height: 86.5vh; overflow-y: auto">
                            <div id="meta-info" class="d-none">
                                {!! $doc->meta !!}
                            </div>
                            <div id="skrip" class="container pl-5 pr-5"
                                 data-font-editor="{{$doc->conf_font}}"
                                 contenteditable="true"
                                 spellcheck="false"
                                 style="padding: 3vh; min-height: 80vh;font-size: {{$doc->conf_font}}pt"
                            >
                                {!! $doc->text !!}
                            </div>
                        </div>
                        <div id="panel-2" class="d-none col-6"  style="overflow-y: auto; border-left: solid 2px #eee;height: 86.5vh;">
                            <div id="preview-skrip">

                            </div>
                            <div id="preview-code" class="d-none" style="font-family: 'Courier New',serif">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mt5 bg-light border-top d-flex justify-content-between" style="height: 5vh">
                    <div class="d-flex align-items-center font-20 ml-3">

                    </div>
                    <div class="d-flex align-items-center font-20 mr-3 text-black-50">

                    </div>
                </div>
            </div>
            <div class="modal fade" id="popup_revisi" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Pesan Revisi</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered display no-wrap" id="no_search">
                                            <thead class="thead-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Oleh</th>
                                                <th>Pesan</th>
                                            </tr>
                                            </thead>
                                            <tbody id="message-container">
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset(env('LIB_PATH').'core/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset(env('LIB_PATH').'core/skripdown/parser.js')}}"></script>
<script src="{{asset(env('LIB_PATH').'core/popper.js/dist/umd/popper.min.js')}}"></script>
<script src="{{asset(env('LIB_PATH').'core/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset(env('JS_PATH').'app-style-switcher.js')}}"></script>
<script src="{{asset(env('JS_PATH').'feather.min.js')}}"></script>
<script src="{{asset(env('LIB_PATH').'core/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')}}"></script>
<script src="{{asset(env('JS_PATH').'sidebarmenu.js')}}"></script>
<script src="{{asset(env('JS_PATH').'custom.min.js')}}"></script>
<script src="{{asset(env('LIB_PATH').'extra/c3/d3.min.js')}}"></script>
<script src="{{asset(env('LIB_PATH').'extra/c3/c3.min.js')}}"></script>
<script src="{{asset(env('JS_PATH').'pages/dashboards/dashboard1.min.js')}}"></script>
<script src="{{asset(env('LIB_PATH').'extra/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset(env('JS_PATH').'pages/datatable/datatable-basic.init.js')}}"></script>
<script src="{{asset(env('LIB_PATH').'extra/prism/prism.js')}}"></script>
<script src="{{asset(env('JS_PATH').'editor.js')}}"></script>
</body>
</html>
