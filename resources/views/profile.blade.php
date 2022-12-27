@extends('layouts.master')

@section('content')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Profile</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">{{ Breadcrumbs::render('profile') }}</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
</section>

  <section class="section profile">
    <div class="row">
        <div class="col-lg-4">
          <div class="card mb-4">
            <div class="card-body text-center">
               @foreach($foto_user as $foto)
               <?php
                  $foto = asset('uploads/user/'.$foto);
                  $fotoDefault = asset('img/avatar4.png');
                  if(empty(Auth::user()->foto_user)){
                    echo "<img src='$fotoDefault' alt='avatar' class='rounded-circle img-fluid' style='width: 150px;'>";
                  }else{
                    echo "<img src='$foto' alt='avatar' class='rounded-circle img-fluid' style='width: 150px;'>";
                  }
                ?>
              <h5 class="my-3">{{ Auth::user()->name }}</h5>            
               @endforeach
            </div>
          </div>
        </div>

      <div class="col-xl-8">

        <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">

              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit{{ Auth::user()->id }}">Edit Profile</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
              </li>

            </ul>
            <div class="tab-content pt-3">

              @foreach($user as $user)
              <div class="tab-pane fade show active profile-overview" id="profile-overview">
                <h5 class="card-title">Profile Details</h5><br><br>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Full Name</div>
                  <div class="col-lg-9 col-md-8">{{ $user->name }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Job</div>
                  <div class="col-lg-9 col-md-8">{{ $user->nama_jabatan }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Address</div>
                  <div class="col-lg-9 col-md-8">{{ $user->alamat }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Phone</div>
                  <div class="col-lg-9 col-md-8">{{ $user->no_tlpn }}</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Email</div>
                  <div class="col-lg-9 col-md-8">{{ $user->email }}</div>
                </div>
              </div>
              @endforeach

              <!-- Profile Edit Form -->
              @foreach($user2 as $user)
              <div class="tab-pane fade profile-edit pt-3" id="profile-edit{{ Auth::user()->id }}">
              <form method="post" action="{{ route('profileUpdate') }}" enctype="multipart/form-data">

                 {{ csrf_field() }}

                  <input type="hidden" id="n" name="id_gue" class="form-control" value="{{ $user->id }}" required>
                  
                   <div class="row mb-3">
                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                    <div class="col-md-8 col-lg-9">
                      <input type="file" class="form-control" name="foto" placeholder="Foto">
                      @if($errors->has('foto'))
                        <div class="text-danger">
                          {{ $errors->first('foto')}}
                        </div>
                      @endif
                      <div class="valid-feedback">
                        Good job!
                      </div>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="nama" type="text" class="form-control" id="nama" value="{{ $user->name }}">
                      @if($errors->has('nama'))
                        <div class="text-danger">
                          {{ $errors->first('nama')}}
                        </div>
                      @endif
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="email" type="email" class="form-control" id="email" value="{{ $user->email }}">
                      @if($errors->has('email'))
                        <div class="text-danger">
                          {{ $errors->first('email')}}
                        </div>
                      @endif
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="no_tlpn" class="col-md-4 col-lg-3 col-form-label">No Telepon</label>
                    <div class="col-md-8 col-lg-9">
                    <input type="contact" value="{{ $user->no_tlpn }}" id="e" name="no_tlpn" class="form-control">
                      @if($errors->has('no_tlpn'))
                        <div class="text-danger">
                          {{ $errors->first('no_tlpn')}}
                        </div>
                      @endif
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="alamat" class="col-md-4 col-lg-3 col-form-label">Alamat</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="alamat" type="text" class="form-control" id="alamat" value="{{ $user->alamat }}">
                      @if($errors->has('alamat'))
                        <div class="text-danger">
                          {{ $errors->first('alamat')}}
                        </div>
                      @endif
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="r"class="col-md-4 col-lg-3 col-form-label">Jenis Kelamin</label>
                    <div class="col-md-8 col-lg-9">
                     <select name="jns_klmn" id="r" class="form-select">
                  <option disabled="">- Jenis Kelamin -</option>
                  <option 
                  <?php
                    $jns_klmn = "laki-laki";
                    echo "value='$jns_klmn'";
                    if(($user->jns_klmn) == $jns_klmn){
                      echo "selected='selected'";
                    }
                   ?>
                  >laki-laki</option>
                  <option <?php 
                    $jns_klmn = "perempuan";
                    echo "value='$jns_klmn'";
                    if(($user->jns_klmn) == $jns_klmn){
                      echo "selected='selected'";
                    }
                  ?>
                  >perempuan</option>
                  </select>
                </div>
                </div>
                  <div class="text-right">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                  </div>
                </form><!-- End Profile Edit Form -->
              </div>
              @endforeach

              <div class="tab-pane fade pt-3" id="profile-change-password">
                <!-- Change Password Form -->

                 @if (session('message'))
                    <h5 class="alert alert-success mb-2">{{ session('message') }}</h5>
                @endif

                @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                    <li class="text-danger">{{ $error }}</li>
                    @endforeach
                </ul>
                @endif

                <form action="{{ route('changePassword') }}" method="POST">
                  @csrf

                  <div class="mb-3">
                      <label>New Password</label>
                        <input type="password" name="password" class="form-control" />
                      </div>
                      <div class="mb-3">
                        <label>Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" />
                      </div>
                      <div class="mb-3 text-end">
                        <hr>
                        <button type="submit" class="btn btn-primary">Update Password</button>
                      </div>
                </form><!-- End Change Password Form -->
              </div>
            </div><!-- End Bordered Tabs -->
          </div>
        </div>

      </div>
    </div>
  </section>
@endsection