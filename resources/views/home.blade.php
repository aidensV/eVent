@extends('layout.main')
@section('content')
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> Home<small></small></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <!-- <li class="breadcrumb-item"><a href="#"></a></li>
                              <li class="breadcrumb-item active"></li> -->
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container">
            <div class="carousel slide" style="margin-bottom:8px " data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('images/images_banner.png') }}" width="100%">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box bg-gradient-info">
                        <span class="info-box-icon"><i class="fas fa-city"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Data Prodi</span>
                            <span class="info-box-number">{{ $prodis }}</span>

                            <div class="progress">
                                <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <span class="progress-description">
                                Total daftar prodi
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box bg-gradient-success">
                        <span class="info-box-icon"><i class="fas fa-place-of-worship"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Data Lab</span>
                            <span class="info-box-number">{{ $labs }}</span>

                            <div class="progress">
                                <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <span class="progress-description">
                                Total daftar lab
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box bg-gradient-warning">
                        <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Modul</span>
                            <span class="info-box-number">{{ $modules }}</span>

                            <div class="progress">
                                <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <span class="progress-description">
                                Total daftar modul
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>

                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box bg-gradient-danger">
                        <span class="info-box-icon"><i class="fas fa-user"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Users</span>
                            <span class="info-box-number">{{ $users }}</span>

                            <div class="progress">
                                <div class="progress-bar" style="width: 100%"></div>
                            </div>
                            <span class="progress-description">
                                Total pengguna yang terdaftar
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <h5 class="mb-2">Riwayat Peminjaman Bulan {{Carbon\Carbon::now()->format('F')}}</h5>
            <div class="card">
                <div class="card-header">
                    <form method="POST" action="{{ route('report.history') }}">
                        @csrf
                        <input type="hidden" name="type" id="export_type" value="excel">
                        <div class="d-flex flex-row-reverse">

                            <div class="p-2">
                                <div class="btn-group">
                                    <button type="submit" class="btn btn-danger" id="btn_export">Pdf</button>
                                    <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="sr-only">Pilih Format</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="changeButton('P')">Pdf</a>
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="changeButton('E')">Excel</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="p-2">
                                <select class="form-control" name="range">
                                    <option value="1" selected>1 Hari</option>
                                    <option value="7">7 Hari</option>
                                    <option value="30">30 Hari</option>
                                </select>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Nama</th>
                                <th>Jurusan</th>
                                <th>Corrective</th>
                                <th>Preventive</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($reports as $key => $report)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ \Carbon\Carbon::parse($report->date)->format('d/m/Y') }}</td>
                                    <td>{{ $report->user->name }}</td>
                                    <td>{{ $report->prodi->name }}</td>
                                    <td>{{ $report->corrective }}</td>
                                    <td>{{ $report->preventive }}</td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <h5 class="mb-2">Profile</h5>
            <div class="card card-success">
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-12 col-lg-6 col-xl-6">
                            <div class="card ">
                                <div class="mapouter">
                                    <div class="gmap_canvas"><iframe width="100%" height="100%" id="gmap_canvas"
                                            src="https://maps.google.com/maps?q=poltekbang&t=&z=13&ie=UTF8&iwloc=&output=embed"
                                            frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a
                                            href="https://putlocker-is.org">putlocker</a>
                                        <style>
                                            .mapouter {
                                                position: relative;
                                                text-align: right;
                                                height: 100%;
                                                width: 100%;
                                            }

                                        </style><a href="https://www.embedgooglemap.net">google iframe</a>
                                        <style>
                                            .gmap_canvas {
                                                overflow: hidden;
                                                background: none !important;
                                                height: 100%;
                                                width: 100%;
                                            }

                                        </style>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6 col-xl-6">
                            <div class="card ">
                                <iframe width="100%" height="100%" src="https://www.youtube.com/embed/nGpP2hdISNg"
                                    title="YouTube video player" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection
@push('scripts')
    <script>
        function changeButton(params) {
            if (params == 'P') {
                document.getElementById("btn_export").classList.add('btn-danger');
                document.getElementById("btn_export").classList.remove('btn-info');
                document.getElementById('btn_export').innerHTML = "Pdf";
                document.getElementById("export_type").value = "pdf";
            } else {
                document.getElementById("btn_export").classList.add('btn-info');
                document.getElementById("btn_export").classList.remove('btn-danger');
                document.getElementById('btn_export').innerHTML = "Excel";
                document.getElementById("export_type").value = "excel";

            }

        }

    </script>
@endpush
