@extends('template')

@section('app_subname')
    Ujian & Plagiasi
@endsection

@section('response-area')
    @php
    if (isset($data)) {
        $response = $data;
        $dept = $response[0];
        $data = $response[1];
        $std  = $response[2];
        $exm  = $response[3];
        $lec  = $response[4];
        $amt  = $response[5];
    }
    @endphp
@endsection

@section('style-head')
    <style>
        .btn-danger-2 {
            transition: background-color 100ms!important;
        }
        .btn-danger-2:hover {
            transition: background-color 100ms!important;
            background-color: #EC7063;
            border-color: #EC7063;
        }

        .clicked-row {
            background-color: rgba(235, 245, 251, 1);
        }
        .clickable-row tr {
            cursor: pointer;
            transition: background-color 300ms;
        }
        .clickable-row tr:hover {
            transition: background-color 300ms;
            background-color: rgba(235, 245, 251, 0.5);
        }
        /* width */
        ::-webkit-scrollbar {
            width: 10px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #888;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>
@endsection

@section('header-button')
    <a href="{{url('/pengaturan')}}" class="dropdown-item">
        <i data-feather="settings" class="svg-icon mr-2 ml-1"></i>
        Pengaturan
    </a>
@endsection

@section('sidebar-menu')
    <li class="sidebar-item">
        <a class="sidebar-link sidebar-link" href="{{url('/ujianPlagiasi')}}" aria-expanded="false">
            <i data-feather="clock" class="feather-icon"></i>
            <span class="hide-menu">Ujian dan Plagiasi</span>
        </a>
    </li>
@endsection

@section('page_focus')
    {{url('/ujianPlagiasi')}}
@endsection

@section('page-breadcrumb')
    Ujian dan Plagiasi
@endsection

@section('sub-breadcrumb')
    Halaman Cek Plagiarisme dan Ujian Skripsi Program Studi {{$dept}}
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white pt-3" style="margin-bottom: -1.5em">
                    <h3 class="card-title">Plagiasi Skripsi
                        <button type="button" class="btn btn-light btn-sm ml-4 rotateable">
                            <i class="ti-arrow-up"></i>
                        </button>
                    </h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="default_order" class="table table-striped table-bordered display no-wrap">
                            <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Penulis</th>
                                <th>BAB I</th>
                                <th>BAB II</th>
                                <th>BAB III</th>
                                <th>BAB IV</th>
                                <th>BAB V</th>
                            </tr>
                            </thead>
                            <tbody class="clickable-row">
                            @foreach($data as $datum)
                                <tr data-toggle="modal"
                                    data-target="#popup_cek_plagiarisme"
                                    data-title="{{$datum->doc_title}}"
                                    data-author="{{$datum->identity}}"
                                    data-doc_url="{{$datum->doc_url}}"
                                    data-score-b1="0"
                                    data-score-b2="0"
                                    data-score-b3="0"
                                    data-score-b4="0"
                                    data-score-b5="0"
                                >
                                    <td>
                                        {{$datum->doc_title}}
                                    </td>
                                    <td>{{$datum->name}}</td>
                                    <td>
                                        <span class="text-muted">belum</span>
                                    </td>
                                    <td>
                                        <span class="text-muted">belum</span>
                                    </td>
                                    <td>
                                        <span class="text-muted">belum</span>
                                    </td>
                                    <td>
                                        <span class="text-muted">belum</span>
                                    </td>
                                    <td>
                                        <span class="text-muted">belum</span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white pt-3" style="margin-bottom: -1.5em">
                    <h3 class="card-title">Ujian Skripsi
                        <button type="button" class="btn btn-light btn-sm ml-4 rotateable">
                            <i class="ti-arrow-up"></i>
                        </button>
                    </h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered display no-wrap">
                            <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Penulis</th>
                                <th>Penguji</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($exm as $item)
                                <tr>
                                    <td>
                                        {{$item->doc_title}}
                                    </td>
                                    <td>{{$item->author}}</td>
                                    <td data-amount-examiner="0"
                                        data-identity="{{$item->author_id}}">
                                        <button
                                            class="btn btn-secondary btn-info active-row-add"
                                            data-toggle="modal"
                                            data-target="#popup_pilih_penguji"
                                        >
                                            <i class="ti-plus"></i>
                                        </button>
                                    </td>
                                    <td class="text-center">
                                        <button
                                            class="btn btn-success opacity-7 active-row-sbm"
                                            data-doc_url="{{$item->doc_url}}"
                                            data-examiner=""
                                            data-clickable="0"
                                            data-identity="{{$item->author_id}}">
                                            submit
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('popup')
    <div class="modal fade" id="popup_cek_plagiarisme" tabindex="-1" role="dialog" aria-hidden="true" data-submitable="0">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Cek Plagiarisme</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <p>
                                Judul
                            </p>
                            <p>
                                oleh NAMA
                            </p>
                        </div>
                    </div>
                    <form action="">
                        <div class="form-group">
                            <label for="in-bab-i" class="d-none"></label>
                            <label for="in-bab-ii" class="d-none"></label>
                            <label for="in-bab-iii" class="d-none"></label>
                            <label for="in-bab-iv" class="d-none"></label>
                            <label for="in-bab-v" class="d-none"></label>
                            <h6><code>BAB I </code></h6>
                            <div class="row">
                                <div class="col-4">
                                    <input type="text" id="in-bab-i" class="form-control form-control-sm plag-form" placeholder="bab i">
                                </div>
                                <div class="col-4">
                                    <button class="btn btn-info btn-sm">
                                        salin
                                        <i class="ti-clipboard"></i>
                                    </button>
                                </div>
                            </div>
                            <h6><code>BAB II </code></h6>
                            <div class="row">
                                <div class="col-4">
                                    <input type="text" id="in-bab-ii" class="form-control form-control-sm plag-form" placeholder="bab ii">
                                </div>
                                <div class="col-4">
                                    <button class="btn btn-info btn-sm">
                                        salin
                                        <i class="ti-clipboard"></i>
                                    </button>
                                </div>
                            </div>
                            <h6><code>BAB III </code></h6>
                            <div class="row">
                                <div class="col-4">
                                    <input type="text" id="in-bab-iii" class="form-control form-control-sm plag-form" placeholder="bab iii">
                                </div>
                                <div class="col-4">
                                    <button class="btn btn-info btn-sm">
                                        salin
                                        <i class="ti-clipboard"></i>
                                    </button>
                                </div>
                            </div>
                            <h6><code>BAB IV </code></h6>
                            <div class="row">
                                <div class="col-4">
                                    <input type="text" id="in-bab-iv" class="form-control form-control-sm plag-form" placeholder="bab iv">
                                </div>
                                <div class="col-4">
                                    <button class="btn btn-info btn-sm">
                                        salin
                                        <i class="ti-clipboard"></i>
                                    </button>
                                </div>
                            </div>
                            <h6 class="mt-2"><code>BAB V </code></h6>
                            <div class="row">
                                <div class="col-4">
                                    <input type="text" id="in-bab-v" class="form-control form-control-sm plag-form" placeholder="bab v">
                                </div>
                                <div class="col-4">
                                    <button class="btn btn-info btn-sm">
                                        salin
                                        <i class="ti-clipboard"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="float-right d-block">
                        <div>
                            <button class="btn btn-primary btn-sm btn-info">batal</button>
                            <button id="submit-plag" class="btn btn-primary btn-sm btn-danger">submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="popup_setuju_submit" tabindex="-1" role="dialog" aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Submit pilih penguji</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <p>
                                Apakah anda yakin ingin melakukan submit ujian skripsi?
                            </p>
                        </div>
                    </div>
                    <div class="float-right d-block">
                        <form action="">
                            <button class="btn btn-primary btn-danger">batal</button>
                            <input type="submit" value="submit" class="btn btn-primary btn-info">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="popup_pilih_penguji" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Pilih Penguji</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table no-wrap v-middle mb-0">
                            <thead>
                            <tr class="border-0">
                                <th class="border-0 font-14 font-weight-medium text-center">Profil</th>
                                <th class="border-0 font-14 font-weight-medium text-center">Info</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="table-responsive" style="max-height: 60vh;overflow-y: auto;">
                        <table class="table no-wrap v-middle mb-0">
                            <tbody id="examiner-list" class="clickable-row active-row">
                            </tbody>
                        </table>
                    </div>
                    <div class="float-right d-block pt-4">
                        <form action="">
                            <button class="btn btn-primary btn-danger">batal</button>
                            <input type="submit" value="pilih" id="pilih-penguji-sbmt" class="btn btn-primary btn-info opacity-7" data-clickable="0">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script-body')
    <script src="{{asset(env('JS_PATH').'rotateable.js')}}"></script>
    <script src="{{asset(env('JS_PATH').'plagiarism.js')}}"></script>
    <script src="{{asset(env('JS_PATH').'thesisExam.js')}}"></script>
    <script>
        window.exam_link        = '{{url('initexam')}}';
        window.examiner_amount  = parseInt({!! $amt.'' !!});
        window.std_bab_i        = parseFloat({!! $std->bab_i.'' !!});
        window.std_bab_ii       = parseFloat({!! $std->bab_ii.'' !!});
        window.std_bab_iii      = parseFloat({!! $std->bab_iii.'' !!});
        window.std_bab_iv       = parseFloat({!! $std->bab_iv.'' !!});
        window.std_bab_v        = parseFloat({!! $std->bab_v.'' !!});
        window.dosens           = [
        @foreach ($lec as $item)
            new Dosen(
                '{!! $item->photo_url.'' !!}',
                '{!! $item->name.'' !!}',
                '{!! $item->identity.'' !!}',
                {!! $item->tot_bimbingan.'' !!},
            ),
        @endforeach
        ];
    </script>
@endsection
