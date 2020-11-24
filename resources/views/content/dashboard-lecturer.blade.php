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
        <a class="sidebar-link sidebar-link" href="{{url('/riwayat')}}" aria-expanded="false">
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
                                    $request_revision = null;
                                    $request_submit = null;
                                    if (isset($user) && isset($identity)) {
                                        if ($identity == $user->identity_l1) {
                                            $status = $user->status_1;
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
                                        <a href="{{$user->doc_link}}" class="text-black-50">
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
                                               data-author_id="{{$user->identity}}"
                                            >setuju</a>
                                            <a href="javascript:void(0)"
                                               class="btn btn-primary btn-sm btn-danger"
                                               data-toggle="modal"
                                               data-target="#popup_tolak_proposal"
                                               data-author_id="{{$user->identity}}"
                                            >tolak</a>
                                        @else
                                            @if ($request_revision)
                                                <a href="javascript:void(0)"
                                                   class="btn btn-primary btn-sm btn-info"
                                                   data-toggle="modal"
                                                   data-target="#popup_revisi"
                                                   data-author_id="{{$user->identity}}"
                                                   data-message=""
                                                >revisi</a>
                                            @else
                                                @if ($request_submit)
                                                    <a href="javascript:void(0)"
                                                       class="btn btn-primary btn-sm btn-info"
                                                       data-toggle="modal"
                                                       data-target="#popup_setuju_submit"
                                                       data-author_id="{{$user->identity}}"
                                                       data-score=""
                                                    >submit</a>
                                                    <a href="javascript:void(0)"
                                                       class="btn btn-primary btn-sm btn-danger"
                                                       data-toggle="modal"
                                                       data-target="#popup_tolak_submit"
                                                       data-author_id="{{$user->identity}}"
                                                    >tolak</a>
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
    <div class="modal fade" id="popup_tolak_proposal" tabindex="-1" role="dialog" aria-hidden="true">
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
                                <strong><span>judul skripsi ini</span></strong>.
                            </p>
                        </div>
                    </div>
                    <div class="float-right d-block">
                        <form action="{{url('rejthesis')}}" method="post">
                            @csrf
                            <input type="hidden" id="popup_tolak_proposal_author_id" name="author_id">
                            <button class="btn btn-primary btn-sm btn-info">tidak</button>
                            <input type="submit" value="iya" class="btn btn-primary btn-sm btn-danger">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="popup_setuju_proposal" tabindex="-1" role="dialog" aria-hidden="true">
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
                                <strong><span>judul skripsi ini</span></strong>.
                            </p>
                        </div>
                    </div>
                    <div class="float-right d-block">
                        <form action="{{url('accthesis')}}" method="post">
                            @csrf
                            <input type="hidden" id="popup_setuju_proposal_author_id" name="author_id">
                            <button class="btn btn-primary btn-sm btn-danger">tidak</button>
                            <input type="submit" value="iya" class="btn btn-primary btn-sm btn-info">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="popup_setuju_submit" tabindex="-1" role="dialog" aria-hidden="true">
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
                                <strong><span>judul skripsi ini</span></strong>.
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
                        <form action="{{url('accsubmit')}}" method="post">
                            @csrf
                            <input type="hidden" id="popup_setuju_submit_author_id" name="author_id">
                            <input type="hidden" name="score" id="thesis-score">
                            <button class="btn btn-primary btn-sm btn-danger">tidak</button>
                            <input type="submit" value="iya" class="btn btn-primary btn-sm btn-info">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="popup_tolak_submit" tabindex="-1" role="dialog" aria-hidden="true">
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
                                <strong><span>judul skripsi ini</span></strong>.
                            </p>
                        </div>
                    </div>
                    <div class="float-right d-block">
                        <form action="{{url('rejsubmit')}}" method="post">
                            @csrf
                            <input type="hidden" id="popup_tolak_submit_author_id" name="author_id">
                            <button class="btn btn-primary btn-sm btn-info">tidak</button>
                            <input type="submit" value="iya" class="btn btn-primary btn-sm btn-danger">
                        </form>
                    </div>
                </div>
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
                        <form action="{{url('progthesis')}}" method="post">
                            @csrf
                            <input type="hidden" id="popup_revisi_author_id" name="author_id">
                            <input type="hidden" name="pesan-revisi" id="form-pesan-revisi">
                            <button class="btn btn-primary btn-sm btn-danger">batal</button>
                            <input type="submit" value="submit" class="btn btn-primary btn-sm btn-info">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script-body')
    <script src="{{asset(env('JS_PATH').'rotateable.js')}}"></script>
    <script>
        $('#popup_tolak_proposal').on('show.bs.modal',e=>{
            $(e.currentTarget).find('#popup_tolak_proposal_author_id').val($(e.relatedTarget).data('author_id'));
        });
        $('#popup_setuju_proposal').on('show.bs.modal',e=>{
           $(e.currentTarget).find('#popup_setuju_proposal_author_id').val($(e.relatedTarget).data('author_id'));
        });
        $('#popup_tolak_submit').on('show.bs.modal',e=>{
            $(e.currentTarget).find('#popup_tolak_submit_author_id').val($(e.relatedTarget).data('author_id'));
        });
        $('#popup_setuju_submit').on('show.bs.modal',e=>{
            $(e.currentTarget).find('#popup_setuju_submit_author_id').val($(e.relatedTarget).data('author_id'));
            const score = $(e.relatedTarget).data('score');
            if (score !== '')
                $(e.currentTarget).find('score-input').val(parseInt(score));
        }).on('hidden.bs.modal',e=>{
            $(e.relatedTarget).data('score',$(e.currentTarget).find('#score-input').val());
            $(e.currentTarget).find('#score-input').val(0);
        });
        $('#popup_revisi').on('show.bs.modal',e=>{
            $(e.currentTarget).find('#popup_revisi_author_id').val($(e.relatedTarget).data('author_id'));
            const message = $(e.relatedTarget).data('message');
            if (message !== '')
                $(e.currentTarget).find('#pesan-revisi').val(message);
        }).on('hidden.bs.modal',e=>{
            $(e.relatedTarget).data('message',$(e.currentTarget).find('#pesan-revisi').val());
            $(e.currentTarget).find('#pesan-revisi').val('');
        });
    </script>
@endsection
