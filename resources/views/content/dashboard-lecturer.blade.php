@extends('template')

@section('app_subname')
    Lecturer
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white pt-3" style="margin-bottom: -1.5em">
                    <h3 class="card-title">Bimbingan Skripsi</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="default_order" class="table table-striped table-bordered display no-wrap">
                            <thead>
                            <tr>
                                <th style="width: 150px">NIM</th>
                                <th>Judul</th>
                                <th style="width: 150px">Status Terakhir</th>
                                <th style="width: 100px">Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $user)
                                <tr>
                                    <td>{{$user->nim}}</td>
                                    <td>
                                        <a href="{{$user->doc_link}}" class="text-black-50">
                                            {!! $user->doc_title !!}
                                        </a>
                                    </td>
                                    @if ($user->status == -1)
                                        <td class="text-danger">belum disetujui</td>
                                    @elseif($user->status == 0)
                                        <td class="text-warning">belum ada progres</td>
                                    @elseif($user->status == 1)
                                        <td>progres pertama</td>
                                    @elseif($user->status == 2)
                                        <td>progres kedua</td>
                                    @elseif($user->status == 3)
                                        <td>progres ketiga</td>
                                    @elseif($user->status == 4)
                                        <td>progres keempat</td>
                                    @elseif($user->status == 5)
                                        <td>progres kelima</td>
                                    @elseif($user->status == 6)
                                        <td>progres keenam</td>
                                    @elseif($user->status == 7)
                                        <td>progres ketujuh</td>
                                    @elseif($user->status == 8)
                                        <td>progres kedelapan</td>
                                    @elseif($user->status == 9)
                                        <td>progres kesembilan</td>
                                    @elseif($user->status == 10)
                                        <td>progres kesepuluh</td>
                                    @else
                                        <td>progres ke-{{$user->status}}</td>
                                    @endif
                                    <td class="text-center">
                                        @if ($user->status == -1)
                                            <form action="{{url('/agreethesis')}}" method="post" class="d-inline-block">
                                                @csrf
                                                <input type="hidden" value="{{$user->doc_id}}" name="doc_id">
                                                <input type="hidden" value="{{$user->id}}" name="user_id">
                                                <input type="submit" class="btn btn-primary btn-sm btn-info" value="setujui">
                                            </form>
                                            <a href="javascript:void(0)"
                                               class="btn btn-primary btn-sm btn-danger"
                                               data-toggle="modal"
                                               data-target="#popup_tolak"
                                               data-user-id="{{$user->id}}"
                                               data-doc-id="{{$user->doc_id}}"
                                            >tolak</a>
                                        @else
                                            @if ($user->progres == 1)
                                                <a href="javascript:void(0)"
                                                   class="btn btn-primary btn-sm btn-info"
                                                   data-toggle="modal"
                                                   data-target="#popup_progres"
                                                   data-user-id="{{$user->id}}"
                                                   data-doc-id="{{$user->doc_id}}"
                                                >progres</a>
                                            @endif
                                        @endif
                                            <a href="{{url('parse/'.$user->doc_url)}}"
                                               class="btn btn-primary btn-sm btn-info"
                                               target="_blank"
                                            >progres</a>
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
    <div class="modal fade" id="popup_tolak" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Peringatan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <p>
                        Apakah anda yakin ingin menolak proposal skripsi dengan judul <span class="text-dark">JUDUL SKRIPSIKU</span> ?
                    </p>
                    <div class="d-block">
                        <form action="{{url('rejectthesis')}}">
                            @csrf
                            <input type="hidden" value="" name="doc_id" id="doc_id">
                            <input type="hidden" value="" name="user_id" id="user_id">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12">
                                        <label for="alasan" class="d-none"></label>
                                        <input id="alasan" type="text" class="form-text" name="alasan" placeholder="alasan">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <a href="javascript:void(0)" class="btn btn-primary btn-sm btn-info float-right">kembali</a>
                                <input type="submit" value="tolak" class="btn btn-primary btn-sm btn-danger float-right">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="popup_progres" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Progres</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form action="{{url('progresthesis')}}" method="post">
                        @csrf
                        <input type="hidden" value="" name="doc_id" id="progres_doc_id">
                        <input type="hidden" value="" name="user_id" id="progres_user_id">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12">
                                    <label for="alasan" class="d-none"></label>
                                    <input id="alasan" type="text" value="tolak" class="form-text" name="alasan" placeholder="alasan">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <a href="javascript:void(0)" class="btn btn-primary btn-sm btn-info float-right">kembali</a>
                            <input type="submit" value="submit" class="btn btn-primary btn-sm btn-success float-right">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script-body')
    <script>
        $('#popup_tolak').on('show.bs.modal', e=>{
           $(e.currentTarget).find('#doc_id').val(e.relatedTarget.data('doc-id'));
           $(e.currentTarget).find('#user_id').val(e.relatedTarget.data('user-id'));
        });
        $('#popup_progres').on('show.bs.modal', e=>{
            $(e.currentTarget).find('#progres_doc_id').val(e.relatedTarget.data('doc-id'));
            $(e.currentTarget).find('#progres_user_id').val(e.relatedTarget.data('user-id'));
        });
    </script>
@endsection
