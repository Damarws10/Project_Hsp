@extends('layouts.master')

@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Informasi User</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">{{ Breadcrumbs::render('informasiuser') }}</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
</section>

<div class="notify"></div>

<br>

<div class="card mx-auto col-10">
    <div class="card-header" style="background-color: transparent;">
        <!-- Button trigger modal -->
        <h2>Database</h2>
    </div>
        <div class="card-body">
            <div class="table-responsive">    
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Jabatan</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php $no=1; ?>
                      @foreach($user as $p)
                      <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $p->name }}</td>
                        <td>{{ $p->email }}</td>
                        <td>{{ $p->nama_jabatan }}</td>
                        <td>{{ $p->role }}</td>
                        <td>
                            <button <?php 
                              $id_user = 1;
                              if(($p->id) == $id_user){
                                echo "disabled";
                              }
                            ?> type="button" class="btn btn-warning edit" data-toggle="modal" data-target="#create-modal{{ $p->id }}">
                              Edit </button>
                            <button <?php 
                              $id_user = 1;
                              if(($p->id) == $id_user){
                                echo "disabled";
                              }
                            ?> type="button" class="btn btn-danger delete" data-toggle="modal" data-target="#destroy-modal{{ $p->id }}">
                              Delete </button>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>
        </div>
</div>
@foreach($user as $p)
<!-- Modal Create -->
<div class="modal fade" id="create-modal{{ $p->id }}" tabindex="-1" role="dialog" aria-labelledby="create-modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="create-modalLabel">Update Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{ route('update') }}">
          {{ csrf_field() }}

          <input type="hidden" id="n" name="id_gue" class="form-control" value="{{ $p->id }}" required>
          <div class="row">
            <div class="form-group col-md-6 mb-2">
                <label for="n">Name</label>
                <input type="text" id="n" name="nama" class="form-control" value="{{ $p->name }}" required>
            </div>
            <div class="form-group col-md-6 mb-2">
                <label for="e">Email</label>
                <input type="text" value="{{ $p->email }}" id="e" name="email" class="form-control" disabled>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-12 mb-1">
                <label for="p">No Telepon</label>
                <input type="text" value="{{ $p->no_tlpn }}" id="e" name="no_tlpn" class="form-control" required>
            </div>
          </div>
          <div class="form-group">
              <label for="p">alamat</label>
              <input type="text" id="p" name="alamat" class="form-control" value="{{ $p->alamat }}" required>
          </div>
          <div class="row">
          <div class="form-group col-md-6 mb-2">
              <label for="r">Jabatan</label>
              <select name="jabatan" id="r" class="form-select">
          @foreach($jabatan as $r)
                  <option <?php
                    $jabat = ($r->id_jabatan);
                    echo "value='$jabat'";
                    if($jabat == ($p->id_jabatan)){
                      echo "selected='selected'";
                    }
                  ?>>{{ $r->nama_jabatan }}</option>
          @endforeach
              </select>
          </div>

          <div class="form-group col-md-6 mb-2">
              <label for="r">Jenis Kelamin</label>
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
          <div class="form-group">
              <label for="r">Role</label>
              <select name="role" id="role" class="form-select">
                  <option disabled="">- PILIH ROLE -</option>
                  <option <?php $val="user"; 
                              echo "value='$val'"; 
                              if(($p->role)==$val){ 
                              echo "selected='selected'";}
                              ?>>user</option>;
                  <option  <?php $val="admin"; echo "value='$val'"; 
                  if(($p->role)==$val) echo "selected='selected'";?>>admin</option>
                  <option <?php $val="superuser"; echo "value='$val'"; 
                  if(($p->role)==$val) echo "selected='selected'";?>>superuser</option>
              </select>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary btn-store">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal Create -->
@endforeach

<!-- Destroy Modal -->
@foreach($user as $p)
<div class="modal fade" id="destroy-modal{{ $p->id }}" tabindex="-1" role="dialog" aria-labelledby="destroy-modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="destroy-modalLabel">Yakin Hapus ? {{ $p->name }}</h5>
        <form method="post" action="{{ route('delete') }}">
          {{ csrf_field() }}
          <input type="hidden" id="n" name="id_gue" class="form-control" value="{{ $p->id }}" required>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-danger btn-destroy">Delete</button>
      </div>
        </form>
    </div>
  </div>
</div>
@endforeach
@endsection 