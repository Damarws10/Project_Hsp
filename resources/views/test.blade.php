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
      <div class="col-xl-4">

        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

            <img src="public/img/user4-128x128.jpg" style="width:100px;cursor:pointer" onclick="onClick(this)" class="w3-hover-opacityalt=Profile">
          
            <div class="social-links mt-2">
              <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
        </div>

      </div>
  
      <div class="col-xl-7">
        <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">
            @foreach($user as $p)
              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview{{ $p->id }}">Overview</button>
              </li>
              @endforeach

              @foreach($user as $p)
              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit{{ $p->id }}">Edit Profile</button>
              </li>
              @endforeach

              @foreach($user as $p)
              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password{{ $p->id }}">Change Password</button>
              </li>
              @endforeach
            </ul>
            @foreach($user as $p)
            <!-- overviw -->
            <div class="tab-content pt-3">
              <div class="tab-pane fade show active profile-overview" id="profile-overview{{ $p->id }}">
                <h5 class="card-title">Profile Details</h5><br><br>
                <form method="post" action="#">
                {{ csrf_field() }}
                <input type="hidden" id="n" name="id_gue" class="form-control" value="{{ $p->id }}" required>

                
                <div class="row">
              <div class="col-lg-3 col-md-4 label ">Foto</div>
            <div class="col-lg-9 col-md-8"name="fotoprofil" type="image" id="foto_user" value="foto">
            <img src="#" style="width:100px;cursor:pointer" onclick="onClick(this)" class="w3-hover-opacityalt=Profile">
            </div>
                </div>
            
                <div class="row">
              <div class="col-lg-3 col-md-4 label ">Full Name</div>
            <div class="col-lg-9 col-md-8"name="nama" type="text" id="nama" value="{{ $p->name }}">Muhamad Damar Wahyu Suseno</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">email</div>
                  <div class="col-lg-9 col-md-8"name="email" type="email"id="email" value="{{ $p->email }}">muhamaddamar10@gmail.com</div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">No Telepon</div>
                  <div class="col-lg-9 col-md-8" name="no_tlpn" type="text" id="no_tlpn" value="{{ $p->no_tlpn }}">
                  0895636181447
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Alamat</div>
                  <div class="col-lg-9 col-md-8"name="alamat" type="text" id="alamat" value="{{ $p->alamat }}">
                    Pasar Kemis
                  </div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Jenis Kelamin</div>
                  <div class="col-lg-9 col-md-8"name="jns_klmn" type="text" class="form-control" id="jns_klmn" value="{{ $p->jns_klmn }}">
                  laki-laki
                  </div>a
                </div>
              </div>
              </form>
              
              @endforeach

            @foreach($user as $p)
            <!-- Profile Edit Form -->
              <div class="tab-pane fade profile-edit pt-3" id="profile-edit{{ $p->id }}">
              <form method="post" action="#">
                 {{ csrf_field() }}
                  <input type="hidden" id="n" name="id_gue" class="form-control" value="{{ $p->id }}" required>
                  
                   <div class="row mb-3">
                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                    <div class="col-md-8 col-lg-9">
                    <input type="file" class="form-control" name="fotoprofil" placeholder="Foto">
                    @if($errors->has('foto_user'))
                    <div class="text-danger">
                      {{ $errors->first('foto_user')}}
                    </div>
                  @endif
                  <div class="valid-feedback">
                    Good job!
                  </div>
                      <div class="pt-2"></div>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="nama" type="text" class="form-control" id="nama" value="{{ $p->name }}">
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="email" type="email" class="form-control" id="email" value="{{ $p->email }}">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="no_tlpn" class="col-md-4 col-lg-3 col-form-label">No Telepon</label>
                    <div class="col-md-8 col-lg-9">
                    <input type="contact" value="{{ $p->no_tlpn }}" id="e" name="no_tlpn" class="form-control" required>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="alamat" class="col-md-4 col-lg-3 col-form-label">Alamat</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="alamat" type="text" class="form-control" id="alamat" value="{{ $p->alamat }}">
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
                    if(($p->jns_klmn) == $jns_klmn){
                      echo "selected='selected'";
                    }
                   ?>
                  >laki-laki</option>
                  <option <?php 
                    $jns_klmn = "perempuan";
                    echo "value='$jns_klmn'";
                    if(($p->jns_klmn) == $jns_klmn){
                      echo "selected='selected'";
                    }
                  ?>
                  >perempuan</option>
                  </select>
                </div>
                </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                  </div>
                </form><!-- End Profile Edit Form -->
              </div>
            @endforeach
               <!-- Change Password Form -->
              
                <div class="tab-pane fade pt-3" id="profile-change-password{{ $p->id }}">
              <form method="post" action="#">
                 {{ csrf_field() }}
                  <input type="hidden" id="n" name="idgue" class="form-control" value="{{ $p->id }}" required>
                      

                  <div class="row mb-3">
                    <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="newpassword" type="password" class="form-control" id="newPassword">
                      @if($errors->has('password'))
                    <div class="text-danger">
                      {{ $errors->first('password')}}
                    </div>
                  @endif
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="renewpassword" type="password" class="form-control" id="renewPassword" >
                       @if($errors->has('password'))
                    <div class="text-danger">
                      {{ $errors->first('password')}}
                    </div>
                  @endif
                    </div>
                  </div>

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Change Password</button>
                    <a class="btn btn-danger" href="{{ 'home' }}">Back</a>
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