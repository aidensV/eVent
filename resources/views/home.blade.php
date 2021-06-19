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
        
        <div class="row">
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-gradient-info">
              <span class="info-box-icon"><i class="fas fa-city"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Data Prodi</span>
                <span class="info-box-number">{{$prodis}}</span>

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
                <span class="info-box-number">{{$labs}}</span>

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
                <span class="info-box-number">{{$modules}}</span>

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
                <span class="info-box-number">{{$users}}</span>

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
        <div class="card">
          <div class="card-header">
          
            <div class="row">
              <h5 class="card-title col-md-10">Riwayat Peminjaman</h5>
              
            </div>
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
            
            @foreach($reports as $key => $report)
            <tr>
              <td>{{ $key+1 }}</td>
              <td>{{\Carbon\Carbon::parse($report->date)->format('d/m/Y')}}</td>
              <td>{{$report->user->name}}</td>
              <td>{{$report->user->prodis->name}}</td>
              <td>{{$report->corrective}}</td>
              <td>{{$report->preventive}}</td>
            
            </tr>
            @endforeach
          </tbody>
        </table>
        </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
@endsection