@extends('layout.main')
@section('content')
<div class="content-header">
  <div class="container">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0"> Management Users<small></small></h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Management User</a></li>
          <li class="breadcrumb-item active">Create</li>
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


      <div class="col-lg-10">

        <div class="card">
          <div class="card-header">
            
            <div class="row">
            <i class="fas fa-info-circle"></i>
              <h5 class="card-title col-md-10">General</h5>

            </div>
          </div>
          <div class="card-body">
            <form action="{{route('master.users.store')}}" method="POST">
              @csrf
              <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="name" placeholder="Nama ...">
                  @error('name')
                  <small class="text-danger">
                    {{$message}}
                  </small>
                  @enderror
                </div>
              </div>
              <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="email" placeholder="Masukan email">
                </div>
              </div>
              <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Nomor Telepon</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="phone" placeholder="Masukan nomor telepon">
                </div>
              </div>
              <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Program Studi</label>
                <div class="col-sm-10">
                  <select class="form-control" name="prodi">
                    <option disabled selected>Pilih program studi</option>
                    @foreach($prodi as $dataProdi)
                    <option value="{{$dataProdi->id}}">{{$dataProdi->name}}</option>
                    @endforeach
                  </select>
                  @error('prodi')
                  <small class="text-danger">
                    {{$message}}
                  </small>
                  @enderror
                </div>
              </div>
              <div class="row">
              <i class="fas fa-info-circle"></i>
              <h5 class="card-title col-md-10">Registration</h5> 
              </div>
              <hr>
              <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="username" placeholder="Masukan username">
                  @error('username')
                  <small class="text-danger">
                    {{$message}}
                  </small>
                  @enderror
                </div>
              </div>
              <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Type</label>
                <div class="col-sm-2">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="type" id="admin" value="admin" checked>

                    <label class="form-check-label" for="admin">
                      Admin
                    </label>
                  </div>
                </div>
                <div class="col-sm-2">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="type" id="general" value="general">
                    <label class="form-check-label" for="general">
                      General
                    </label>
                  </div>
                </div>
                <div>
                  @error('type')
                  <small class="text-danger">
                    {{$message}}
                  </small>
                  @enderror
                </div>
              </div>
              <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="staticEmail" name="password" placeholder="Masukan password">
                  <small id="passwordHelpInline" class="text-muted">
                    jika password kosong, password otomatis sama dengan username
                  </small>
                </div>

              </div>
              <div class="text-right">
              <a href="{{route('master.users')}}" class="btn btn-sencondary">Kembali</a>
              &nbsp;
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </form>
          </div>
        </div>

        <!-- /.card -->
      </div>

      <!-- /.col-md-6 -->

      <!-- /.col-md-6 -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
@endsection