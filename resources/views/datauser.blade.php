@extends('layouts.master')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
  
                <div class="card-body">
                    You are a Admin User.
                </div>
            </div>
        </div>
    </div>
</div>
<form>
  <div class="form-row">
    <div class="form-group col-md-6 email">
      <label for="inputEmail4">Email</label>
      <input type="email" class="form-control" id="inputEmail" placeholder="Email">
    </div>

    <div class="form-group col-md-6">
      <label for="inputPassword4">Password</label>
      <input type="password" class="form-control" id="inputPassword" placeholder="Password">
      <small id="passwordHelpInline" class="text-muted">
        Must be 8-20 characters long.
      </small>
    </div>

  </div>

    <div class="form-group">
        <label for="inputAddress">Nama</label>
        <input type="text" class="form-control" id="nama" placeholder="risxxx xxx">
    </div>

    <div class="form-group">
        <label for="inputAddress">Alamat</label>
        <input type="text" class="form-control" id="alamat" placeholder="1234 Main St">
    </div>
  
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputCity">jabatan</label>
            <input type="text" class="form-control" id="inputCity">
    </div>

    <div class="form-group col-md-4">
      <label for="inputState">Jenis Kelamin</label>
      <select id="inputState" class="form-control">
        <option selected>Laki-Laki</option>
        <option>Perempuan</option>
      </select>
    </div>

    <div class="form-group col-md-2">
      <label for="inputState">Level</label>
      <select id="inputState" class="form-control">
        <option selected>guest</option>
        <option>admin</option>
        <option>super admin</option>
      </select>
    </div>
    
  </div>
  <button type="submit" class="btn btn-primary">Create</button>
</form>
@endsection