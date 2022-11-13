@extends('layouts.master')

@section('content')

<section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Form user</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">{{ Breadcrumbs::render('formuser') }}</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
</section>

<form method="post" action="{{ route('post') }}">
   {{ csrf_field() }}
    <div class="col-md-12 d-flex justify-content-center">
      <div class="card card-secondary">
      <div class="card-header">
        <h3 class="card-title">Data user</h3> 
      </div>
        <div class="card-body">

    <div class="row">
      <div class="form-group col-md-6 email">
        <label for="inputEmail4">Email</label>
        <input type="email" class="form-control" name="email" id="email" placeholder="Email">
         @if($errors->has('email'))
            <div class="text-danger">
              {{ $errors->first('email')}}
            </div>
          @endif
 
      </div>
  
      <div class="form-group col-md-6">
        <label for="inputPassword4">Password</label>
        <input type="password" class="form-control" name="inputPassword" id="inputPassword" placeholder="Password">
         @if($errors->has('inputPassword'))
              <div class="text-danger">
                  {{ $errors->first('inputPassword')}}
              </div>
          @endif
 
        <small id="passwordHelpInline" class="text-muted">
          Must be 8-20 characters long.
        </small>
      </div>
  
    </div>
  
      <div class="form-group">
          <label for="inputAddress">Nama</label>
          <input type="text" class="form-control" name="nama" id="nama" placeholder="risxxx xxx">
           @if($errors->has('nama'))
              <div class="text-danger">
                  {{ $errors->first('nama')}}
              </div>
          @endif
 
      </div>

      <div class="form-group">
          <label for="inputAddress">No Telfon</label>
          <input type="text" class="form-control" name="no_tlpn" id="no_tlpn" placeholder="08 xxx">
           @if($errors->has('no_tlpn'))
                <div class="text-danger">
                    {{ $errors->first('no_tlpn')}}
                </div>
            @endif
 
      </div>
  
      <div class="form-group">
          <label for="inputAddress">Alamat</label>
          <input type="text" class="form-control" name="alamat" id="alamat" placeholder="1234 Main St">
           @if($errors->has('alamat'))
                <div class="text-danger">
                    {{ $errors->first('alamat')}}
                </div>
            @endif
 
      </div>
    
      <div class="row">
     <div class="form-group col-md-5">
              <label for="inputCity">jabatan</label>
              <select class="form-select" name="jabatan" id="validationCustom04" required>
              @foreach($user as $p)
              <option value="{{ $p->id_jabatan }}">{{ $p->nama_jabatan }}</option>
              @endforeach
            </select>
          </div>
  
          <div class="form-group col-md-4">
            <label for="inputCity">jenis kelamin</label>
            <select class="form-select" name="jns_klmn" id="validationCustom04" required>
              <option value="laki-laki">laki-laki</option>
              <option value="perempuan">perempuan</option>
            </select>
          </div>

  
        <div class="form-group col-md-3">
          <label for="inputState">Level</label>
          <select class="form-select" name="role" id="validationCustom04" required>
            <option value="user">user</option>
            <option value="admin">admin</option>
            <option value="superuser">superuser</option>
          </select>
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Create</button>
    </div>
  </div>
</div>
    <br>
</form>

@endsection