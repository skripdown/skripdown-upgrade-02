@extends('template')

@section('app_subname')
    Riwayat Bimbingan
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
    {{url('/bimbingan')}}
@endsection

@section('page-breadcrumb')
    Riwayat Bimbingan
@endsection

@section('sub-breadcrumb')
    Halaman Riwayat Bimbingan Skripsi
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-white pt-3" style="margin-bottom: -1.5em">
                    <h3 class="card-title">Riwayat Bimbingan
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
                                <th style="width: 150px">Nilai</th>
                                <th style="width: 100px">Kata Kunci</th>
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
                                    <td>{{$user->nim}}</td>
                                    <td>{{$user->nim}}</td>
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
    <script src="{{asset(env('JS_PATH').'rotateable.js')}}"></script>
@endsection
