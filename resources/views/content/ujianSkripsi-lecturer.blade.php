@extends('template')

@section('app_subname')
    Ujian Skripsi
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
    {{url('/ujianSkripsi')}}
@endsection

@section('page-breadcrumb')
    Ujian Skripsi
@endsection

@section('sub-breadcrumb')
    Halaman Ujian Skripsi
@endsection

@section('response-area')
    @php
        if (isset($data)) {
            $exams = $data[0];
        }
    @endphp
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white pt-3" style="margin-bottom: -1.5em">
                    <h3 class="card-title">Ujian Skripsi<button type="button" class="btn btn-light btn-sm ml-4 rotateable"><i
                                class="ti-arrow-up"></i></button></h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered display no-wrap">
                            <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Penulis</th>
                                <th style="width: 150px">Status</th>
                                <th style="width: 100px">Lulus</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($exams as $exam)
                                <tr>
                                    <td>{{$exam->doc_title}}</td>
                                    <td>{{$exam->author}}</td>
                                    @if ($exam->status == 0)
                                        <td class="text-danger">{{$exam->status}}</td>
                                    @else
                                        <td class="text-info">{{$exam->status}}</td>
                                    @endif
                                    <td class="text-center">
                                        <a href="javascript:void(0)"
                                           class="btn btn-primary btn-sm btn-info"
                                           data-toggle="modal"
                                           data-author-id="{{$exam->author_id}}"
                                           data-title="{{$exam->doc_title}}"
                                           data-target="#popup_lulus"
                                        >lulus</a>
                                        <a href="javascript:void(0)"
                                           class="btn btn-primary btn-sm btn-danger"
                                           data-toggle="modal"
                                           data-author-id="{{$exam->author_id}}"
                                           data-title="{{$exam->doc_title}}"
                                           data-target="#popup_gagal"
                                        >tidak</a>
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
    <div class="modal fade" id="popup_lulus" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Lulus Ujian</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <p>Apakah anda yakin ingin menandai <span class="text-info">lulus</span> skripsi dengan judul
                                <strong><span id="judul_for_lulus">judul skripsi ini</span> ?</strong>.
                            </p>
                        </div>
                    </div>
                    <div class="float-right d-block">
                        <button class="btn btn-primary btn-sm btn-danger">tidak</button>
                        <button id="submit_lulus" class="btn btn-primary btn-sm btn-info">iya</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="popup_gagal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tidak Lulus Ujian</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <p>Apakah anda yakin ingin menandai <span class="text-danger">tidak lulus</span> skripsi dengan judul
                                <strong><span id="judul_for_gagal">judul skripsi ini</span> ?</strong>.
                            </p>
                        </div>
                    </div>
                    <div class="float-right d-block">
                        <button class="btn btn-primary btn-sm btn-info">tidak</button>
                        <button id="submit_gagal" class="btn btn-primary btn-sm btn-danger">iya</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="notif_sukses_lulus" tabindex="-1" role="dialog" aria-hidden="true">
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
                                Skripsi sudah ditandai lulus!
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="notif_sukses_tidak_lulus" tabindex="-1" role="dialog" aria-hidden="true">
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
                                Skripsi sudah ditandai tidak lulus!
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script-body')
    <script src="{{asset(env('JS_PATH').'rotateable.js')}}"></script>
    <script>
        window.focus_row = '';
        window.focus_par = '';
        window.focus_id  = '';
        $('#popup_lulus').on('show.bs.modal',e=>{
            window.focus_row = e.relatedTarget.parentNode;
            window.focus_par = window.focus_row.parentNode;
            window.focus_id  = $(e.relatedTarget).data('author-id');
            $(e.currentTarget).find('#judul_for_lulus').html($(e.relatedTarget).data('title'));
        });
        $('#popup_gagal').on('show.bs.modal',e=>{
            window.focus_row = e.relatedTarget.parentNode;
            window.focus_par = window.focus_row.parentNode;
            window.focus_id  = $(e.relatedTarget).data('author-id');
            $(e.currentTarget).find('#judul_for_gagal').html($(e.relatedTarget).data('title'));
        });
        $('#submit_lulus').click(()=>{
            $.ajax({
                type :  'POST',
                url  :  '{{url('accthesis')}}',
                data :  {_token:'{{csrf_token()}}',author_id:window.focus_id},
                success : ()=>{
                    const node = window.focus_par.children[2];
                    $(node).html('<span class="text-muted">sudah dinilai</span>');
                    $(window.focus_row).html('<span class="text-success">ditandai lulus</span>');
                    $('#notif_sukses_lulus').modal('show');
                }
            });
        });
        $('#submit_gagal').click(()=>{
            $.ajax({
                type :  'POST',
                url  :  '{{url('rejthesis')}}',
                data :  {_token:'{{csrf_token()}}',author_id:window.focus_id},
                success : ()=>{
                    const node = window.focus_par.children[2];
                    $(node).html('<span class="text-muted">sudah dinilai</span>');
                    $(window.focus_row).html('<span class="text-danger">ditandai gagal</span>');
                    $('#notif_sukses_tidak_lulus').modal('show');
                }
            });
        })
    </script>
@endsection
