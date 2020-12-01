@extends('template')

@section('app_subname')
    Dashboard
@endsection

@section('sidebar-menu')
    <li class="sidebar-item">
        <a class="sidebar-link sidebar-link" href="{{url('/bimbingan')}}" aria-expanded="false">
            <i data-feather="clock" class="feather-icon"></i>
            <span class="hide-menu">Riwayat Bimbingan</span>
        </a>
    </li>
    <li class="sidebar-item">
        <a class="sidebar-link sidebar-link" href="{{url('/ujian')}}" aria-expanded="false">
            <i data-feather="file-text" class="feather-icon"></i>
            <span class="hide-menu">Ujian Skripsi</span>
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
    Beranda Manajemen Bimbingan Skripsi
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white pt-3" style="margin-bottom: -1.5em">
                    <h3 class="card-title">Bimbingan Skripsi
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
                                <th style="width: 150px">Status</th>
                                <th style="width: 100px">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                if (isset($data)) {
                                    $identity = $data[0];
                                    $data = $data[1];
                                }
                            @endphp
                            @foreach($data as $user)
                                @php
                                    $progres = null;
                                    $status = null;
                                    $status_sec = null;
                                    $request_revision = null;
                                    $request_submit = null;
                                    if (isset($user) && isset($identity)) {
                                        if ($identity == $user->identity_l1) {
                                            $status = $user->status_1;
                                            $status_sec = $user->status_2;
                                            $progres = $user->lec_1_revision;
                                            $request_revision = $user->l1_request_revision;
                                            if ($user->l1_agrement != null) {
                                                if ($user->l1_agrement) {
                                                    $request_submit = true;
                                                }
                                            }
                                            else
                                                $request_submit = false;
                                        }
                                        else {
                                            $status = $user->status_2;
                                            $status_sec = $user->status_1;
                                            $progres = $user->lec_2_revision;
                                            $request_revision = $user->l2_request_revision;
                                            $request_submit = $user->l2_agrement;
                                            if ($user->l2_agrement != null) {
                                                if ($user->l2_agrement) {
                                                    $request_submit = true;
                                                }
                                            }
                                            else
                                                $request_submit = false;
                                        }
                                    }
                                @endphp
                                <tr>
                                    <td>
                                        <a href="/parse/{{$user->doc_link}}" class="text-black-50" target="_blank">
                                            {!! $user->doc_title !!}
                                        </a>
                                    </td>
                                    <td>{{$user->name}}</td>
                                    @if ($status == -1)
                                        <td class="text-danger">belum disetujui</td>
                                    @else
                                        @if ($progres == 0)
                                            <td class="text-warning">belum ada progres</td>
                                        @elseif($progres == 1)
                                            <td>progres pertama</td>
                                        @elseif($progres == 2)
                                            <td>progres kedua</td>
                                        @elseif($progres == 3)
                                            <td>progres ketiga</td>
                                        @elseif($progres == 4)
                                            <td>progres keempat</td>
                                        @elseif($progres == 5)
                                            <td>progres kelima</td>
                                        @elseif($progres == 6)
                                            <td>progres keenam</td>
                                        @elseif($progres == 7)
                                            <td>progres ketujuh</td>
                                        @elseif($progres == 8)
                                            <td>progres kedelapan</td>
                                        @elseif($progres == 9)
                                            <td>progres kesembilan</td>
                                        @else
                                            <td>progres ke-{{$progres}}</td>
                                        @endif
                                    @endif
                                    <td class="text-center">
                                        @if ($status == -1)
                                            <a href="javascript:void(0)"
                                               class="btn btn-primary btn-sm btn-info"
                                               data-toggle="modal"
                                               data-target="#popup_setuju_proposal"
                                               data-title="{!! $user->doc_title !!}"
                                               data-author_id="{{$user->identity}}"
                                               data-status-sec="{{$status_sec}}"
                                            >setuju</a>
                                            <a href="javascript:void(0)"
                                               class="btn btn-primary btn-sm btn-danger"
                                               data-toggle="modal"
                                               data-target="#popup_tolak_proposal"
                                               data-title="{!! $user->doc_title !!}"
                                               data-author_id="{{$user->identity}}"
                                               data-status-sec="{{$status_sec}}"
                                            >tolak</a>
                                        @else
                                            @if ($request_revision == 1)
                                                <a href="javascript:void(0)"
                                                   class="btn btn-primary btn-sm btn-info"
                                                   data-toggle="modal"
                                                   data-target="#popup_revisi"
                                                   data-title="{!! $user->doc_title !!}"
                                                   data-author_id="{{$user->identity}}"
                                                   data-status-sec="{{$status_sec}}"
                                                   data-message=""
                                                >revisi</a>
                                            @else
                                                @if ($request_submit)
                                                    <a href="javascript:void(0)"
                                                       class="btn btn-primary btn-sm btn-info"
                                                       data-toggle="modal"
                                                       data-target="#popup_setuju_submit"
                                                       data-title="{!! $user->doc_title !!}"
                                                       data-author_id="{{$user->identity}}"
                                                       data-status-sec="{{$status_sec}}"
                                                       data-score=""
                                                    >submit</a>
                                                    <a href="javascript:void(0)"
                                                       class="btn btn-primary btn-sm btn-danger"
                                                       data-toggle="modal"
                                                       data-target="#popup_tolak_submit"
                                                       data-title="{!! $user->doc_title !!}"
                                                       data-author_id="{{$user->identity}}"
                                                       data-status-sec="{{$status_sec}}"
                                                    >tolak</a>
                                                @else
                                                    <span class="text-muted">
                                                        tidak ada permintaan revisi
                                                    </span>
                                                @endif
                                            @endif
                                        @endif
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
    <div class="modal" id="popup_tolak_proposal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tolak Proposal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <p>Apakah anda yakin ingin menolak proposal tugas akhir dengan judul
                                <strong><span id="judul_for_tolak_proposal">judul skripsi ini</span></strong>.
                            </p>
                        </div>
                    </div>
                    <div class="float-right d-block">
                        <form>
                            <input type="hidden" id="popup_tolak_proposal_author_id" name="author_id">
                        </form>
                        <button class="btn btn-primary btn-sm btn-info" type="button" data-dismiss="modal" aria-hidden="true">tidak</button>
                        <button class="btn btn-primary btn-sm btn-danger" id="submit-tolak-proposal">iya</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="popup_setuju_proposal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Setuju Proposal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <p>Apakah anda yakin menyetujui pengajuan proposal tugas akhir dengan judul
                                <strong><span id="judul_for_setuju_proposal">judul skripsi ini</span></strong>.
                            </p>
                        </div>
                    </div>
                    <div class="float-right d-block">
                        <form>
                            <input type="hidden" id="popup_setuju_proposal_author_id" name="author_id">
                        </form>
                        <button class="btn btn-primary btn-sm btn-danger" type="button" data-dismiss="modal" aria-hidden="true">tidak</button>
                        <button class="btn btn-primary btn-sm btn-info" id="submit-setuju-proposal">iya</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="popup_setuju_submit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Setuju Submit</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <p>Apakah anda yakin untuk menyetujui submit tugas akhir tentang
                                <strong><span id="judul_for_setuju_submit">judul skripsi ini</span></strong>.
                            </p>
                        </div>
                        <div class="col-12">
                            <h6 class="card-subtitle">nilai akhir <span class="text-muted">(0 - 100)</span></h6>
                            <form class="mt-4">
                                <div class="form-group">
                                    <label for="score-input" class="d-none"></label>
                                    <input type="number" class="form-control" value="0" id="score-input" min="0" max="100">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="float-right d-block">
                        <form>
                            <input type="hidden" id="popup_setuju_submit_author_id" name="author_id">
                            <input type="hidden" name="score" id="thesis-score">
                        </form>
                        <button class="btn btn-primary btn-sm btn-danger" type="button" data-dismiss="modal" aria-hidden="true">tidak</button>
                        <button class="btn btn-primary btn-sm btn-info" id="submit-setuju-submit">iya</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="popup_tolak_submit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tolak Submit</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <p>Apakah anda yakin untuk menolak submit tugas akhir tentang
                                <strong><span id="judul_for_tolak_submit">judul skripsi ini</span></strong>.
                            </p>
                        </div>
                    </div>
                    <div class="float-right d-block">
                        <form action="{{url('rejsubmit')}}" method="post">
                            <input type="hidden" id="popup_tolak_submit_author_id" name="author_id">
                        </form>
                        <button class="btn btn-primary btn-sm btn-info" type="button" data-dismiss="modal" aria-hidden="true">tidak</button>
                        <button class="btn btn-primary btn-sm btn-danger" id="submit-tolak-submit">iya</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="popup_revisi" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Pesan Revisi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <form>
                                <div class="form-group">
                                    <label for="pesan-revisi" class="d-none"></label>
                                    <textarea id="pesan-revisi" class="form-control" rows="3" placeholder="Pesan. . ."></textarea>
                                    <small id="textHelp" class="form-text text-muted">Kosongkan jika tidak ada revisi</small>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="float-right d-block">
                        <form>
                            <input type="hidden" id="popup_revisi_author_id" name="author_id">
                            <input type="hidden" name="pesan_revisi" id="form-pesan-revisi">
                        </form>
                        <button class="btn btn-primary btn-sm btn-danger" type="button" data-dismiss="modal" aria-hidden="true">batal</button>
                        <button class="btn btn-primary btn-sm btn-info" id="submit-revisi">kirim</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="notification_tolak_proposal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Notifikasi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <p>
                                sukses menolak proposal!
                            </p>
                        </div>
                    </div>
                    <div class="float-right d-block">
                        <button class="btn btn-primary btn-sm btn-info" type="button" data-dismiss="modal" aria-hidden="true">tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="notification_setuju_proposal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Notifikasi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <p>
                                sukses menyetujui proposal!
                            </p>
                        </div>
                    </div>
                    <div class="float-right d-block">
                        <button class="btn btn-primary btn-sm btn-info" type="button" data-dismiss="modal" aria-hidden="true">tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="notification_setuju_submit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Notifikasi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <p>
                                sukses menyetujui submit ke repository!
                            </p>
                        </div>
                    </div>
                    <div class="float-right d-block">
                        <button class="btn btn-primary btn-sm btn-info" type="button" data-dismiss="modal" aria-hidden="true">tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="notification_tolak_submit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Notifikasi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <p>
                                sukses menolak permintaan submit ke repository!
                            </p>
                        </div>
                    </div>
                    <div class="float-right d-block">
                        <button class="btn btn-primary btn-sm btn-info" type="button" data-dismiss="modal" aria-hidden="true">tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="notification_revisi" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Notifikasi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <p>
                                sukses mengirim pesan revisi!
                            </p>
                        </div>
                    </div>
                    <div class="float-right d-block">
                        <button class="btn btn-primary btn-sm btn-info" type="button" data-dismiss="modal" aria-hidden="true">tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script-body')
    <script src="{{asset(env('JS_PATH').'rotateable.js')}}"></script>
    <script>
        window.obj_ = '';
        window.focus_row = '';
        window.focus_col = '';
        window.focus_parent = '';
        window.status_sec = '';
        $('#popup_tolak_proposal').on('show.bs.modal',e=>{
            $(e.currentTarget).find('#popup_tolak_proposal_author_id').val($(e.relatedTarget).data('author_id'));
            $(e.currentTarget).find('#judul_for_tolak_proposal').html($(e.relatedTarget).data('title'));
            window.focus_col = e.relatedTarget.parentElement;
            window.focus_row = window.focus_col.parentElement;
            window.focus_parent = window.focus_row.parentElement;
            window.status_sec = $(e.relatedTarget).data('status-sec');
        });
        $('#popup_setuju_proposal').on('show.bs.modal',e=>{
           $(e.currentTarget).find('#popup_setuju_proposal_author_id').val($(e.relatedTarget).data('author_id'));
           $(e.currentTarget).find('#judul_for_setuju_proposal').html($(e.relatedTarget).data('title'));
           window.focus_col = e.relatedTarget.parentElement;
           window.focus_row = window.focus_col.parentElement;
           window.focus_parent = window.focus_row.parentElement;
           window.status_sec = $(e.relatedTarget).data('status-sec');
        });
        $('#popup_tolak_submit').on('show.bs.modal',e=>{
            $(e.currentTarget).find('#popup_tolak_submit_author_id').val($(e.relatedTarget).data('author_id'));
            $(e.currentTarget).find('#judul_for_tolak_submit').html($(e.relatedTarget).data('title'));
            window.focus_col = e.relatedTarget.parentElement;
            window.focus_row = window.focus_col.parentElement;
            window.focus_parent = window.focus_row.parentElement;
            window.status_sec = $(e.relatedTarget).data('status-sec');
        });
        $('#popup_setuju_submit').on('show.bs.modal',e=>{
            $(e.currentTarget).find('#popup_setuju_submit_author_id').val($(e.relatedTarget).data('author_id'));
            $(e.currentTarget).find('#judul_for_setuju_submit').html($(e.relatedTarget).data('title'));
            window.focus_col = e.relatedTarget.parentElement;
            window.focus_row = window.focus_col.parentElement;
            window.focus_parent = window.focus_row.parentElement;
            window.status_sec = $(e.relatedTarget).data('status-sec');
            const score = $(e.relatedTarget).data('score');
            if (score !== '')
                $(e.currentTarget).find('score-input').val(parseInt(score));
        }).on('hidden.bs.modal',e=>{
            $(e.relatedTarget).data('score',$(e.currentTarget).find('#score-input').val());
            $(e.currentTarget).find('#score-input').val(0);
        });
        $('#popup_revisi').on('show.bs.modal',e=>{
            $(e.currentTarget).find('#popup_revisi_author_id').val($(e.relatedTarget).data('author_id'));
            window.obj_ = e.relatedTarget;
            window.focus_col = e.relatedTarget.parentElement;
            window.focus_row = window.focus_col.parentElement;
            window.focus_parent = window.focus_row.parentElement;
            const message = $(e.relatedTarget).data('message');
            if (message !== '')
                $(e.currentTarget).find('#pesan-revisi').val(message);
        }).on('hidden.bs.modal',e=>{
            $(window.obj_).data('message',$(e.currentTarget).find('#pesan-revisi').val());
            $(e.currentTarget).find('#pesan-revisi').val('');
            window.status_sec = $(e.relatedTarget).data('status-sec');
        });
        $('#submit-tolak-proposal').click(function () {
            const author_id = $('#popup_tolak_proposal_author_id').val();
            $.ajax({
                url     : '{{url('rejthesis')}}',
                type    : 'POST',
                data    : {_token:'{{csrf_token()}}',author_id:author_id},
                success : (e)=>{
                    console.log(e);
                    const status = parseInt(window.status_sec);
                    if (status > 1)
                        $(window.focus_col).html('<span class="text-muted">proposal ditolak</span>');
                    else
                        window.focus_parent.removeChild(window.focus_row);
                    $('#popup_tolak_proposal').modal('hide');
                    $('#notification_tolak_proposal').modal('show');
                }
            });
        });
        $('#submit-setuju-proposal').click(function () {
            const author_id = $('#popup_setuju_proposal_author_id').val();
            $.ajax({
                url     : '{{url('accthesis')}}',
                type    : 'POST',
                data    : {_token:'{{csrf_token()}}',author_id:author_id},
                success : (e)=>{
                    console.log(e);
                    const status = parseInt(window.status_sec);
                    if (status < 1)
                        $(window.focus_col).html('<span class="text-muted">menunggu persetujuan pembimbing lain</span>');
                    else
                        window.focus_parent.removeChild(window.focus_row);
                    $('#popup_setuju_proposal').modal('hide');
                    $('#notification_setuju_proposal').modal('show');
                }
            });
        });
        $('#submit-setuju-submit').click(function () {
            const author_id = $('#popup_setuju_submit_author_id').val();
            const score     = $('#thesis-score').val();
            $.ajax({
                url     : '{{url('accsubmit')}}',
                type    : 'POST',
                data    : {_token:'{{csrf_token()}}',author_id:author_id,score:parseFloat(score)},
                success : (e)=>{
                    console.log(e);
                    const status = parseInt(window.status_sec);
                    if (status < 2)
                        $(window.focus_col).html('<span class="text-muted">menunggu persetujuan pembimbing lain</span>');
                    else
                        window.focus_parent.removeChild(window.focus_row);
                    $('#popup_setuju_submit').modal('hide');
                    $('#notification_setuju_submit').modal('show');
                }
            });
        });
        $('#submit-tolak-submit').click(function () {
            const author_id = $('#popup_tolak_submit_author_id').val();
            $.ajax({
                url     : '{{url('rejsubmit')}}',
                type    : 'POST',
                data    : {_token:'{{csrf_token()}}',author_id:author_id},
                success : (e)=>{
                    console.log(e);
                    const status = parseInt(window.status_sec);
                    if (status > 1)
                        $(window.focus_col).html('<span class="text-muted">permintaan submit ditolak</span>');
                    else
                        window.focus_parent.removeChild(window.focus_row);
                    $('#popup_tolak_submit').modal('hide');
                    $('#notification_tolak_submit').modal('show');
                }
            });
        });
        $('#submit-revisi').click(function () {
            const author_id = $('#popup_revisi_author_id').val();
            const msg       = $('#pesan-revisi').val();
            console.log('message : '+msg);
            $.ajax({
                url     : '{{url('progthesis')}}',
                type    : 'POST',
                data    : {_token:'{{csrf_token()}}',author_id:author_id,message:msg},
                success : (e)=>{
                    console.log(e);
                    $(window.focus_col).html('<span class="text-muted">tidak ada permintaan revisi</span>');
                    $('#popup_revisi').modal('hide');
                    $('#notification_revisi').modal('show');
                }
            });
        });
    </script>
@endsection
