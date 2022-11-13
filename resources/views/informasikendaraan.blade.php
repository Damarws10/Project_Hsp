@extends('layouts.master')

@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Informasi</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">{{ Breadcrumbs::render('informasikendaraan') }}</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
</section>
<div class="notify"></div>

<div class="card mx-auto col-11">
    <div class="card-header" style="background-color: transparent;">
        <!-- Button trigger modal -->
        <h2 style="text-align: center;">Database Kendaraan</h2>
    </div>
        <div class="card-body">
            <div class="table-responsive">    
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Plat</th>
                            <th>Nama Kendaraan</th>
                            <th>Merek Kendaraan</th>
                            <th>Foto</th>
                            <th>Tahun Buat</th>
                            <th>Warna</th>
                            <th>Tipe Kendaraan</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php $no=1; ?>
                      @foreach($kendaraan as $p)
                      <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $p->no_plat }}</td>
                        <td>{{ $p->nama_kendaraan }}</td>
                        <td>{{ $p->mrk_kendaraan }}</td>
                        <td> <button type="button"
                              class="btn btn-primary"
                              data-toggle="modal"
                              data-target="#exampleModal{{ $p->id_kendaraan }}">
                              Show</button>
                        </td>
                        <!-- <td><img src="{{ Storage::url('public/').$p->foto }}" class="rounded" style="width: 150px"></td> -->
                        <td>{{ $p->thn_buat }}</td>
                        <td>{{ $p->warna }}</td>
                        <td>{{ $p->tp_kendaraan }}</td>
                        <td>{{ $p->status }}</td>
                        <td>
                          <button type="button" style="margin-bottom: 10px; width: 100%" class="btn btn-warning edit" data-toggle="modal" data-target="#edit-modal{{ $p->id_kendaraan }}">
                              Edit </button>
                          <br>
                          <button type="button" class="btn btn-danger delete" data-toggle="modal" data-target="#destroy-modal{{ $p->id_kendaraan }}">
                              Delete </button>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>
        </div>
</div>
  
@foreach($kendaraan as $p)
<div class="modal fade"
        id="exampleModal{{ $p->id_kendaraan }}"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true">
         
        <div class="modal-dialog" role="document">
            <div class="modal-content">
             
                <!-- Add image inside the body of modal -->
                <div class="modal-body">
                    <img id="image" src="{{ Storage::url('public/').$p->foto }}" class="rounded" style="width: 100%"
                        alt="Click on button" />
                </div>
 
                <div class="modal-footer">
                    <button type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal">
                        Close
                </button>
                </div>
            </div>
        </div>
    </div>
@endforeach

@foreach($kendaraan as $p)
<!-- Modal Edit -->
<div class="modal fade" id="edit-modal{{ $p->id_kendaraan }}" tabindex="-1" role="dialog" aria-labelledby="edit-modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="edit-modalLabel">Edit Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
          <form method="POST" action="{{ route('update_kendaraan') }}" enctype="multipart/form-data">
            {{ csrf_field() }}

            <input type="hidden" id="n" name="id_user" class="form-control" value="{{ Auth::user() -> id }}" required>

            <input type="hidden" id="n" name="id_gue" class="form-control" value="{{ $p->id_kendaraan }}" required>
            <div class="row">
                <div class="col-md-6 mb-2">
                  <label for="validationCustom01">No Plat</label>
                  <input type="text" class="form-control" value="{{ $p->no_plat }}" name="no_plat" id="validationCustom01" placeholder="B xxxx xxx">
                  @if($errors->has('no_plat'))
                    <div class="text-danger">
                      {{ $errors->first('no_plat')}}
                    </div>
                  @endif
                  <div class="valid-feedback">
                    Tolong diperhatikan!
                  </div>
                </div>
                <div class="col-md-6 mb-2">
                  <label for="validationCustom02">Nama kendaraan</label>
                  <input type="text" class="form-control" value="{{ $p->nama_kendaraan }}" name="nama_kendaraan" id="validationCustom02" placeholder="Nama Kendaraan">
                  @if($errors->has('nama_kendaraan'))
                    <div class="text-danger">
                      {{ $errors->first('nama_kendaraan')}}
                    </div>
                  @endif
                  <div class="valid-feedback">
                    Good job!
                  </div>
                </div>
              </div>
              <div class="row"> 
                <div class="col-md-12 mb-1">
                  <label for="validationCustom02">Foto</label>
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
            <div class="row">
                <div class="col-md-6 mb-2">
                  <label for="validationCustom03">Tahun Pembuatan</label>
                  <input type="text" class="form-control" value="{{$p->thn_buat}}" name="thn_pembuatan" id="validationCustom03" placeholder="year">
                  @if($errors->has('thn_pembuatan'))
                    <div class="text-danger">
                      {{ $errors->first('thn_pembuatan')}}
                    </div>
                  @endif
                  <div class="invalid-feedback">
                    Please provide a valid number.
                  </div>
                </div>
                <div class="col-md-6 mb-2">
                  <label for="validationCustom04">Warna Kendaraan</label>
                  <input type="text" class="form-control" value="{{$p->warna}}" name="warna" id="validationCustom04" placeholder="color">
                  @if($errors->has('warna'))
                    <div class="text-danger">
                      {{ $errors->first('warna')}}
                    </div>
                  @endif
                  <div class="invalid-feedback">
                    Please provide a valid Color.
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4 mb-3">
                  <label for="validationCustom05">Tipe Kendaraan</label>
                  <select name="tipe" id="r" class="form-select" required>
                      <option disabled="">- Tipe -</option>
                      @foreach($tipe as $q)
                      <option <?php 
                        $tipe_kendaraan =  ($p->tp_kendaraan);
                        if($tipe_kendaraan ==  ($q->tp_kendaraan)){
                          echo "selected='selected'";;
                        }
                      ?>
                      >{{ $q->tp_kendaraan }}</option>
                      @endforeach
                  </select>
                </div>

                <div class="col-md-4 mb-3">
                  <label for="validationCustom05">Merek Kendaraan</label>
                  <select name="merek_kendaraan" id="r" class="form-select" required>
                      <option disabled="">- Merek -</option>
                      @foreach($model as $r)
                      <option <?php 
                      $model_kendaraan = ($p->mrk_kendaraan);
                      if($model_kendaraan == ($r->mrk_kendaraan)){
                        echo "selected='selected'";
                      }
                      ?>
                      >{{ $r->mrk_kendaraan }}</option>
                      @endforeach
                  </select>
                </div>

                <div class="col-md-4 mb-3">
                  <label for="validationCustom05">Status</label>
                    <select name="status" id="r" class="form-select" required>
                      <option disabled="">- Status -</option>
                      <option <?php
                      $status = 1;
                      echo "value='$status'";
                      if (($p->status) == "Perpanjang STNK") {
                        echo "selected='selected'";
                      }
                      ?>
                      >Perpanjang STNK</option>
                      <option <?php
                      $status = 2;
                      echo "value='$status'";
                      if (($p->status) == "Balik Nama BPKB") {
                        echo "selected='selected'";
                      }
                      ?> >Balik Nama BPKB</option>
                      <option <?php
                      $status = 3;
                      echo "value='$status'";
                      if (($p->status) == "Pembuatan STNK") {
                        echo "selected='selected'";
                      }
                      ?> >Pembuatan STNK</option>
                      <option <?php
                      $status = 4;
                      echo "value='$status'";
                      if (($p->status) == "Perpanjang STNk & Ganti Plat") {
                        echo "selected='selected'";
                      }
                      ?> >Perpanjang STNk & Ganti Plat</option>
                    </select>
                </div>
              </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary btn-update">Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endforeach
<!-- Modal Edit -->

<!-- Destroy Modal -->
@foreach($kendaraan as $p)
<div class="modal fade" id="destroy-modal{{ $p->id_kendaraan }}" tabindex="-1" role="dialog" aria-labelledby="destroy-modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="destroy-modalLabel">Yakin Hapus ? Kendaraan : {{ $p->no_plat }}, {{ $p->nama_kendaraan }}</h5>
        <form method="post" action="{{ route('delete_kendaraan') }}">
          {{ csrf_field() }}
          <input type="hidden" id="n" name="id_gue" class="form-control" value="{{ $p->id_kendaraan }}" required>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-danger btn-destroy">Hapus</button>
      </div>
    </form>
    </div>
  </div>
</div>
@endforeach
@endsection 