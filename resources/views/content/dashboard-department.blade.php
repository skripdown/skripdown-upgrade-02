@extends('template')

@section('app_subname')
    Dashboard
@endsection

@section('response-area')
    @php
        if (isset($data)) {
            $dptname  = $data[0];
            $thesis   = $data[1];
            $advisors = $data[2];
        }
    @endphp
@endsection

@section('header-button')
    <!--suppress JSUnfilteredForInLoop -->
    <a href="javascript:void(0)" class="dropdown-item">
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
    {{url('/dashboard')}}
@endsection

@section('page-breadcrumb')
    Dashboard
@endsection

@section('sub-breadcrumb')
    Beranda Manajemen Skripsi Program Studi {{$dptname}}
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white pt-3" style="margin-bottom: -1.5em">
                    <h3 class="card-title">Data Skripsi
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
                                <th style="width: 150px">Pembimbing I</th>
                                <th style="width: 150px">Pembimbing II</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($thesis as $item)
                                <tr>
                                    <td>{{$item->title}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->lec_1}}</td>
                                    <td>{{$item->lec_2}}</td>
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
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                        <h3 class="card-title">Data Pembimbing
                            <button type="button" class="btn btn-light btn-sm ml-4 rotateable">
                                <i class="ti-arrow-up"></i>
                            </button>
                        </h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table no-wrap v-middle mb-0">
                            <thead>
                            <tr class="border-0">
                                <th class="border-0 font-14 font-weight-medium text-muted">Profil
                                </th>
                                <th class="border-0 font-14 font-weight-medium text-muted">Mahasiswa Bimbingan</th>
                                <th class="border-0 font-14 font-weight-medium text-muted text-center">
                                    Total
                                </th>
                                <th class="border-0 font-14 font-weight-medium text-muted">Bidang Sering Diambil</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($advisors as $item)
                                <tr>
                                    <td class="px-2 py-4">
                                        <div class="d-flex no-block align-items-center">
                                            <div class="mr-3"><img
                                                    src="{{$item->photo_url}}"
                                                    alt="user" class="rounded-circle" width="45"
                                                    height="45" /></div>
                                            <div class="">
                                                <h5 class="text-dark mb-0 font-16 font-weight-medium">
                                                    {{$item->name}}
                                                </h5>
                                                <span class="text-muted font-14">{{$item->identity}}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-2 py-4">
                                        @foreach($item->advising as $item2)
                                            <div class="popover-icon">
                                                <a class="btn btn-primary rounded-circle btn-circle font-12"
                                                   href="javascript:void(0)">DS</a>
                                            </div>
                                        @endforeach
                                        @if ($item->advising_total > 5)
                                                <a class="btn btn-success text-white rounded-circle btn-circle font-20"
                                                   href="javascript:void(0)"
                                                   data-identity="{{$item->identity}}"
                                                >+</a>
                                        @endif
                                    </td>
                                    <td class="text-center text-muted font-weight-medium px-2 py-4">{{$item->advising_total}}</td>
                                    <td class="font-weight-medium text-dark px-2 py-4">$85K</td>
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
    <div class="modal fade" id="popup_detail_bimbingan" tabindex="-1" role="dialog" aria-hidden="true">
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
                                <th class="border-0 font-14 font-weight-medium text-center">Judul</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="table-responsive" style="max-height: 60vh;overflow-y: auto;">
                        <table class="table no-wrap v-middle mb-0">
                            <tbody id="student-list">
                            </tbody>
                        </table>
                    </div>
                    <div class="float-right d-block pt-4">
                        <button class="btn btn-primary btn-danger">tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script-body')
    <script src="{{asset(env('JS_PATH').'rotateable.js')}}"></script>
    <script>
        window.advisor_data = {
            @foreach($advisors as $advisor)
                '{{$advisor->identity}}' : {
                    nama : '{{$advisor->name}}',
                    advising : {
                        @foreach($advisor->advising as $advising)
                            nama : '{{$advising->name}}',
                            identity : '{{$advising->identity}}',
                            title : '{{$advising->doc_title}}',
                            photo_url : '{{$advising->photo_url}}',
                            doc_url : '{{$advising->doc_url}}',
                        @endforeach
                    }
                },
            @endforeach
        };
        $('#popup_detail_bimbingan').on('show.bs.modal',e=>{
            const advisor_id = $(e.relatedTarget).data('identity');
            const student_data = window.advisor_data[advisor_id].advising;
            let tbody = '';
            for (const key in student_data) {
                const student = student_data[`${key}`];
                tbody +=
                    '<tr><td class="border-top-0 px-2"><div class="d-flex no-block align-items-center">' +
                    '<div class="mr-3"><img src="'+student['photo_url']+'" alt="user" class="rounded-circle" ' +
                    'width="45" height="45"/></div><div class=""><h5 class="text-dark mb-0 font-16 font-weight-medium">' +
                    student['nama']+'</h5><a class="font-14" href="">'+student['identity']+'</a></div></div></td>' +
                    '<td class="border-top-0 px-2"><div class="opacity-7 text-muted text-center">' +
                    '<a href="'+student['doc_url']+'" target="_blank">'+student['title']+'</a></div></td></tr>';
            }
            $(e.currentTarget).find('#student-list').html(tbody);
        });
    </script>
@endsection
