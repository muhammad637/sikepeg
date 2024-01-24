@extends('main',['title' => 'Profile'])
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="font-weight-bold text-dark">Profil</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="https://bootdey.com/img/Content/avatar/avatar7.png"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{$admin->name}}</h3>

                <p class="text-muted text-center">{{$admin->username}}</p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Pengaturan</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Ubah Password</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="settings">
                    <form action="{{ route('admin.profile.update', ['admin' => auth()->user()->id])}}" method="POST" class="form-horizontal">
                      {{-- <form action=""></form> --}}
                      @csrf
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="nama" placeholder="Nama" name='name' value="{{auth()->user()->name}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="username" name="username" value="{{auth()->user()->username}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Kirim</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="tab-pane" id="timeline">
                    <!-- The timeline -->
                    <div class="timeline timeline-inverse">
                      <form action="{{ route('admin.profile.password', ['admin' => auth()->user()->id])}}" method="POST" class="form-horizontal">
                        {{-- <form action=""></form> --}}
                        @csrf
                      <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">Password Lama</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" id="password" name="password" placeholder="Password Lama">
                          <button class="btn" type="button" id="showPasswordBtn">
                            <i class="fas fa-eye-slash"></i>
                     </button>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">Password Baru</label>
                        
                        <div class="col-sm-10">
                          
                          <input type="password" class="form-control" id="newpassword" name="newPassword" placeholder="Password Baru">
                          <button class="btn" type="button" id="showPasswordBtn2">
                            <i class="fas fa-eye-slash"></i>
                          </button>
                          
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Ubah Password</button>
                        </div>
                      </div>
                  
                    </form>
                    </div>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection