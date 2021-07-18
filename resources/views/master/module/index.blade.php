@extends('layout.main')
@section('content')
<div class="content-header">
  <div class="container">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0"> Management module<small></small></h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Management Module</a></li>
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
            @if(session()->has('success'))
            <div class="alert alert-success alert-flash">
              {{ session()->get('success') }}
            </div>
            @elseif(session()->has('error'))
            <div class="alert alert-danger alert-flash">
              {{ session()->get('error') }}
            </div>
            @endif
            <div class="row">
              <h5 class="card-title col-md-10">Data Module</h5>
              <a href="{{route('master.module.create',request()->route('id'))}}" class="btn btn-success col-md-2">Tambah</a>
            </div>
          </div>
          <div class="card-body">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Name</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                @forelse($module as $key =>$data)
                <tr>
                  <th scope="row">{{$key+1}}</th>
                  <td> {{$data->name}}</td>
                  <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                    
                    <form action="{{route('master.module.delete',$data->id)}}" method="post">
                      @csrf
                      {{ method_field('DELETE') }}
                      <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></button>
                    </form>
                    <a href="{{route('master.module.detail',$data->id)}}" class="btn btn-sm btn-info"><i class="fas fa-arrow-circle-right"></i></a>
                    <button type="button" class="btn btn-secondary btn-sm" onclick="showQr({{json_encode($data->path_qr)}})"><i class="fas fa-qrcode"></i></button>
                    </div>

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

<!-- Modal -->
<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Qr Code</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body align-self-center">
          <img id="image-qr" src="" alt="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <a id="link-qr" href="" download="" class="btn btn-primary">Simpan</a>
      </div>
      
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script>
  function showQr(params) {
    var img_src = "{{asset('storage/berkas/qr-code/')}}"+'/'+params;
    $('#image-qr').attr('src',img_src);
    $("#link-qr").attr("href", img_src);
    $('#create').modal('show');
  }
</script>
@endpush