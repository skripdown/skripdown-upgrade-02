@extends('template')

@section('app_subname')
    Dashboard
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white pt-3" style="margin-bottom: -1.5em">
                    <h3 class="card-title">Beranda Skripsi {JURUSAN}</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="default_order" class="table table-striped table-bordered display no-wrap">
                            <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Penulis</th>
                                <th>Nilai</th>
                                <th>Kata Kunci</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $user)
                                <tr>
                                    <td>
                                        <a href="{{$user->doc_link}}" class="text-black-50">
                                            {!! $user->doc_title !!}
                                        </a>
                                    </td>
                                    <td>{{$user->nim}}</td>
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
@endsection

@section('script-body')
    <script>
    </script>
@endsection
