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


      <div class="col-lg-10">

        <div class="card">
          <div class="card-header">
            <div class="row">
              <h5 class="card-title col-md-10">Data Users</h5>
              <a href="{{route('master.users.add')}}" class="btn btn-success col-md-2">Tambah</a>
            </div>
          </div>
          <div class="card-body">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Username</th>
                  <th scope="col">Name</th>
                  <th scope="col">Phone</th>
                  <th scope="col">Prodi</th>
                  <th scope="col">Type</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @forelse($user as $key =>$data)
                <tr>
                  <th scope="row">{{$key+1}}</th>
                  <td>{{$data->username}}</td>
                  <td>{{$data->name}}</td>
                  <td>{{$data->phone}}</td>
                  <td>
                    @if($data->type == 'admin' )
                    -
                    @else
                    {{$data->prodis->name}}
                    @endif
                    
                  </td>
                  <td>{{$data->type}}</td>
                  <td>
                    <form action="{{route('master.users.delete',$data->id)}}" method="post">
                      @csrf
                      {{ method_field('DELETE') }}
                      <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></button>
                    </form>

                  </td>
                </tr>
                @empty
                <tr class="text-center">
                  <th scope="row" colspan="6">Tidak ada Data</th>
                </tr>

                @endforelse
              </tbody>
            </table>
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