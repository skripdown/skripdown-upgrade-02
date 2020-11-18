@extends('template')

@section('app_subname')
    Dashboard
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
    Beranda Manajemen Skripsi Program Studi 'Jurusan'
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
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>2016103703XXX</td>
                                <td>System Architect</td>
                                <td>System Architect</td>
                                <td>System Architect</td>
                                <td>System Architect</td>
                            </tr>
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
                            <tr>
                                <td class="border-top-0 px-2 py-4">
                                    <div class="d-flex no-block align-items-center">
                                        <div class="mr-3"><img
                                                src="../assets/images/users/widget-table-pic1.jpg"
                                                alt="user" class="rounded-circle" width="45"
                                                height="45" /></div>
                                        <div class="">
                                            <h5 class="text-dark mb-0 font-16 font-weight-medium">Hanna
                                                Gover</h5>
                                            <span class="text-muted font-14">hgover@gmail.com</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="border-top-0 px-2 py-4">
                                    <div class="popover-icon">
                                        <a class="btn btn-primary rounded-circle btn-circle font-12"
                                           href="javascript:void(0)">DS</a>
                                        <a class="btn btn-danger rounded-circle btn-circle font-12 popover-item"
                                           href="javascript:void(0)">SS</a>
                                        <a class="btn btn-cyan rounded-circle btn-circle font-12 popover-item"
                                           href="javascript:void(0)">RP</a>
                                        <a class="btn btn-success text-white rounded-circle btn-circle font-20"
                                           href="javascript:void(0)">+</a>
                                    </div>
                                </td>
                                <td
                                    class="border-top-0 text-center font-weight-medium text-muted px-2 py-4">
                                    35
                                </td>
                                <td class="font-weight-medium text-dark border-top-0 px-2 py-4 text-wrap">$96K
                                </td>
                            </tr>
                            <tr>
                                <td class="px-2 py-4">
                                    <div class="d-flex no-block align-items-center">
                                        <div class="mr-3"><img
                                                src="../assets/images/users/widget-table-pic2.jpg"
                                                alt="user" class="rounded-circle" width="45"
                                                height="45" /></div>
                                        <div class="">
                                            <h5 class="text-dark mb-0 font-16 font-weight-medium">Daniel
                                                Kristeen
                                            </h5>
                                            <span class="text-muted font-14">Kristeen@gmail.com</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-2 py-4">
                                    <div class="popover-icon">
                                        <a class="btn btn-primary rounded-circle btn-circle font-12"
                                           href="javascript:void(0)">DS</a>
                                        <a class="btn btn-danger rounded-circle btn-circle font-12 popover-item"
                                           href="javascript:void(0)">SS</a>
                                        <a class="btn btn-success text-white rounded-circle btn-circle font-20"
                                           href="javascript:void(0)">+</a>
                                    </div>
                                </td>
                                <td class="text-center text-muted font-weight-medium px-2 py-4">32</td>
                                <td class="font-weight-medium text-dark px-2 py-4">$85K</td>
                            </tr>
                            <tr>
                                <td class="px-2 py-4">
                                    <div class="d-flex no-block align-items-center">
                                        <div class="mr-3"><img
                                                src="../assets/images/users/widget-table-pic3.jpg"
                                                alt="user" class="rounded-circle" width="45"
                                                height="45" /></div>
                                        <div class="">
                                            <h5 class="text-dark mb-0 font-16 font-weight-medium">Julian
                                                Josephs
                                            </h5>
                                            <span class="text-muted font-14">Josephs@gmail.com</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-2 py-4">
                                    <div class="popover-icon">
                                        <a class="btn btn-primary rounded-circle btn-circle font-12"
                                           href="javascript:void(0)">DS</a>
                                        <a class="btn btn-danger rounded-circle btn-circle font-12 popover-item"
                                           href="javascript:void(0)">SS</a>
                                        <a class="btn btn-cyan rounded-circle btn-circle font-12 popover-item"
                                           href="javascript:void(0)">RP</a>
                                        <a class="btn btn-success text-white rounded-circle btn-circle font-20"
                                           href="javascript:void(0)">+</a>
                                    </div>
                                </td>
                                <td class="text-center text-muted font-weight-medium px-2 py-4">29</td>
                                <td class="font-weight-medium text-dark px-2 py-4">$81K</td>
                            </tr>
                            <tr>
                                <td class="px-2 py-4">
                                    <div class="d-flex no-block align-items-center">
                                        <div class="mr-3"><img
                                                src="../assets/images/users/widget-table-pic4.jpg"
                                                alt="user" class="rounded-circle" width="45"
                                                height="45" /></div>
                                        <div class="">
                                            <h5 class="text-dark mb-0 font-16 font-weight-medium">Jan
                                                Petrovic
                                            </h5>
                                            <span class="text-muted font-14">hgover@gmail.com</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-2 py-4">
                                    <div class="popover-icon">
                                        <a class="btn btn-primary rounded-circle btn-circle font-12"
                                           href="javascript:void(0)">DS</a>
                                        <a class="btn btn-success text-white font-20 rounded-circle btn-circle"
                                           href="javascript:void(0)">+</a>
                                    </div>
                                </td>
                                <td class="text-center text-muted font-weight-medium px-2 py-4">23</td>
                                <td class="font-weight-medium text-dark px-2 py-4">$80K</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('popup')
@endsection

@section('script-body')
    <script src="{{asset(env('JS_PATH').'rotateable.js')}}"></script>
@endsection
