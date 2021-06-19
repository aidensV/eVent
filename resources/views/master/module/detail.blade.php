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
            
              <h5 class="card-title col-md-10"><i class="fas fa-info-circle"></i> General</h5>
              <a  href="{{route('master.lab.show.module',$module->lab)}}" class="btn btn-link col-md-2"><i class="fas fa-arrow-left"></i></a>
            </div>
          </div>
          <div class="card-body">
            <form action="{{route('master.module.store')}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                  <input type="text" disabled class="form-control" name="name" value="{{$module->name}}">
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
                  <input type="text" disabled class="form-control"  value="{{$module->lab->name}}">
                </div>
              </div>
              
              <div class="row">
              <div class="form-group col-6 ">
                <label for="staticEmail" class="col-sm-2 col-form-label">Gambar</label>
                <div class="col-sm-10">
                  <img src="{{asset('storage/berkas/'.$module->path_image)}}" width="300">
                </div>
              </div>
              <div class="form-group col-6">
                <label for="staticEmail" class="col-sm-3 col-form-label">Dokumen</label>
                <div class="col-sm-10">
                  @if($module->path_file)
                  
                    <i class="fas fa-file-pdf" style="font-size: 64pt;color:red"></i><br>
                    <a class="btn btn-primary" href="{{asset('storage/berkas/dokumen/'.$module->path_file)}}" target="_new">Read more</a>
                  
                  @else
                  <i class="fas fa-file-pdf" style="font-size: 64pt;color:red"></i>
                  @endif
                </div>
                
              </div>
              </div>
            
            </form>
          </div>
        </div>

        <!-- /.card -->
      </div>
      <div class="col-lg-10">

        <div class="card">
          <div class="card-header">
            <h5 class="card-title col-md-10"><i class="fas fa-indent"></i> History</h5>
            
          </div>
          <div class="card-body">
            <table class="table table-hover">
              <thead>
                @foreach ($history as $key=> $item)
                <tr>
                  <th scope="col">{{$key+1}}</th>
                  <th scope="col">{{$item->user->name}}</th>
                  <th scope="col">{{$item->desc_1}} <br>{{$item->desc_2}}</th>
                  <th scope="col">{{$item->date}}</th>
                </tr>    
                @endforeach
                
              </thead>
            </table>
          </div>
        </div>
      </div>

      <!-- /.col-md-6 -->

      <!-- /.col-md-6 -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
@endsection