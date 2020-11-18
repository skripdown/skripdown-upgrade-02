@extends('template')

@section('app_subname')
    Ujian & Plagiasi
@endsection

@section('response-area')
    @php
    if (isset($response)) {
        $data = $response[0];
        $std  = $response[1];
    }
    @endphp
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
    Halaman Cek Plagiarisme dan Ujian Skripsi Program Studi {Jurusan}
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
@endsection

@section('script-body')
    <script src="{{asset(env('JS_PATH').'rotateable.js')}}"></script>
    <script src="{{asset(env('JS_PATH').'plagiarism.js')}}"></script>
    <script>
        window.std_bab_i   = parseFloat({!! $std->bab_i.'' !!});
        window.std_bab_ii  = parseFloat({!! $std->bab_ii.'' !!});
        window.std_bab_iii = parseFloat({!! $std->bab_iii.'' !!});
        window.std_bab_iv  = parseFloat({!! $std->bab_iv.'' !!});
        window.std_bab_v   = parseFloat({!! $std->bab_v.'' !!});
    </script>
@endsection
