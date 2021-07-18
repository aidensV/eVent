@extends('layout.main')
@section('content')
<div class="content-header">
  <div class="container">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0"> Management Module<small></small></h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Management Module</a></li>
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
            <form action="{{route('master.module.store')}}" method="POST" enctype="multipart/form-data">
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
                <label for="staticEmail" class="col-sm-2 col-form-label">Lab</label>
                <div class="col-sm-10">
                  <input type="text" disabled class="form-control" value="{{$lab->name}}">
                </div>
              </div>
              <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10">
                  <input type="hidden" class="form-control" name="lab_id" value="{{$lab->id}}">
                </div>
              </div>
              <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Gambar</label>
                <div class="col-sm-10">
                  <input type="file" class="form-control" name="image_file" >
                </div>
              </div>
              <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Dokumen</label>
                <div class="col-sm-10">
                  <input type="file" class="form-control" accept="application/pdf" name="doc_file" >
                </div>
              </div>
           
              <div class="text-right">
              <a href="{{route('master.lab.show.module',$lab->id)}}" class="btn btn-sencondary">Kembali</a>
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