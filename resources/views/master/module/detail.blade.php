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
                                <a href="{{ route('master.lab.show.module', $module->lab) }}"
                                    class="btn btn-link col-md-2"><i class="fas fa-arrow-left"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('master.module.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" disabled class="form-control" name="name"
                                            value="{{ $module->name }}">
                                        @error('name')
                                            <small class="text-danger">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Lab</label>
                                    <div class="col-sm-10">
                                        <input type="text" disabled class="form-control" value="{{ $module->lab->name }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-6 ">
                                        <label for="staticEmail" class="col-sm-2 col-form-label">Gambar</label>
                                        <div class="col-sm-10">
                                            <img src="{{ asset('storage/berkas/' . $module->path_image) }}" width="300">
                                        </div>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="staticEmail" class="col-sm-3 col-form-label">Dokumen</label>
                                        <div class="col-sm-10">
                                            @if ($module->path_file)

                                                <i class="fas fa-file-pdf" style="font-size: 64pt;color:red"></i><br>
                                                <a class="btn btn-primary"
                                                    href="{{ asset('storage/berkas/dokumen/' . $module->path_file) }}"
                                                    target="_new">Read more</a>

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
                        <h5 class="card-title col-md-10"><i class="fas fa-indent"></i> History</h5>
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
                                    <input type="hidden" name="module_id" value="{{ $module->id}}">

                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover">

                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Nama</th>
                                        <th>Jurusan</th>
                                        <th>Kelas</th>
                                        <th>Corrective</th>
                                        <th>Preventive</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($history as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->date)->format('d/m/Y') }}</td>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ $item->prodi->name }}</td>
                                            <td>{{ $item->prodi ? $item->prodi->name : '-'}}</td>
                                            <td>{{ $item->class_name}}</td>
                                            <td>{{ $item->corrective }}</td>
                                            <td>{{ $item->preventive }}</td>

                                        </tr>
                                    @endforeach

                                </tbody>
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