@extends('layouts.master')

@section('content')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Transaksi Kendaraan</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">{{ Breadcrumbs::render('transaksikendaraan') }}</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
</section>

<div class="notify"></div>

<div class="card">
        <div class="card-body">  
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>No Plat</th>
                            <th>Foto</th>
                            <th>Tanggal Peminjaman</th>
                            <th>Keterangan</th>
                            <th>Status Approved</th>
                            <th>Tanggal Pengembalian</th>
                            <th>Status Approved</th>
                            <?php
                            if(Auth::user()->role == "superuser" || Auth::user()->role == "admin"){
                              echo "<th class='text-center'>Status</th>";
                                }
                             ?>
                        </tr>
                    </thead>
                    <tbody>
                      <?php $no=1; ?>
                      @foreach($histori as $p)
                      <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $p->name }}</td>
                        <td>{{ $p->no_plat }}</td>
                        <td>
                          <img src="{{ asset('uploads/kendaraan/'.$p->foto) }}" class="rounded" style="width: 150px">
                        </td>
                        <td>{{ date('l,d M Y', strtotime($p->tgl_peminjaman)) }}</td>
                        <td>{{ $p->statpinjam }}</td>
                        <td>
                        <?php
                        if(empty($p->statapprove)){
                          echo "Menunggu Di approve";
                          if(Auth::user()->role == "admin" && empty($p->statapprove)){
                            echo "<a href='transaksikendaraan/approvekendaraan/$p->id_transaksi' class='btn btn-info' style='margin-right:10px' role='button'>Approve</a>";
                          }
                        }else{
                          echo $p->statapprove;
                        }
                        ?></td>
                        <td>{{ date('l,d M Y', strtotime($p->tgl_pengembalian)) }}</td>
                        <td>
                          <?php
                          if(empty($p->statapprove)){
                            echo "Belum Approve dipakai";
                          }else if($p->statpengembalian == "Dikembalikan"){
                            echo $p->statpengembalian;
                          }else if($p->statpengembalian != "Tidak Disetujui"){
                            echo "Sedang Digunakan";
                            if(Auth::user()->role == "admin"){
                            echo "<a href='/transaksikendaraan/approvekendaraankembali/$p->id_transaksi' class='btn btn-success' role='button'>Klik Terima Pengembalian</a>";
                            } 
                          }
                          ?>
                        </td>

                        <?php

                        if(Auth::user()->role == "superuser"){
                          echo"<td>";

                          echo "<button type='button' style='margin-bottom: 10px; width: 100%' class='btn btn-warning edit' data-bs-toggle='modal' data-bs-target='#edit-modal$p->id_transaksi'>
                                Edit </button>";

                          echo "<button type='button' style='margin-bottom: 10px; width: 100%' class='btn btn-danger delete' data-bs-toggle='modal' data-bs-target='#destroy-modal$p->id_transaksi'>
                              Delete </button>";

                          echo "</td>";
                        }else if(Auth::user()->role == "admin"){
                          echo"<td>";
                          if($p->statapprove == "Disetujui" ){
                            echo "";
                          }else{
                            echo "<button type='button' style='margin-bottom: 10px; width: 100%' class='btn btn-danger delete' data-bs-toggle='modal' data-bs-target='#destroy-modal$p->id_transaksi'>Batalkan Transaksi</button>";
                          }
                          echo "</td>";
                        }

                        ?>
                        </tr>
                      @endforeach
                    </tbody>
                </table> 
        </div>
</div>

@foreach($histori as $p)
<div class="modal fade"
        id="exampleModal{{ $p->id_transaksi }}"
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

<!-- Modal Create -->
<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="create-modal" tabindex="-1" role="dialog" aria-labelledby="create-modalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="create-modalLabel">Create Data</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{ route('store_transaksi') }}">
          {{ csrf_field() }}

          <div class="form-group">
              <input type="hidden" value="{{Auth::user()->id}}" id="n" name="id" class="form-control" required>
              <label for="n">Name</label>
              <input type="text" value="{{Auth::user()->name}}" id="n" name="name" class="form-control" disabled>
          </div>
          <div class="form-group">
              <label for="e">No Plat</label>
                  <select name="no_plat" id="r" class="form-select" required>
                  @foreach($kendaraan as $r)
                      <option value="{{ $r->no_plat }}">{{ $r->no_plat }}</option>
                  @endforeach
                  </select>
                  @if($errors->has('no_plat'))
                    <div class="text-danger">
                      {{ $errors->first('no_plat')}}
                    </div>
                  @endif
          </div>
          <div class="row">  
            <div class="form-group col-md-6">
                <label for="birthdaytime">Tanggal Pinjam :</label>
                <input type="datetime-local" id="tgl_pinjam" name="tgl_pinjam" class="form-control" required>
                @if($errors->has('tgl_pinjam'))
                      <div class="text-danger">
                        {{ $errors->first('tgl_pinjam')}}
                      </div>
                @endif
            </div>

            <div class="form-group col-md-6">
                <label for="birthdaytime">Tanggal Pengembalian :</label>
                <input type="datetime-local" id="tgl_pengembalian" name="tgl_pengembalian" class="form-control" required>
                @if($errors->has('tgl_pengembalian'))
                      <div class="text-danger">
                        {{ $errors->first('tgl_pengembalian')}}
                      </div>
                @endif
            </div>
          </div>
          <div class="form-group">
              <label for="p">Keterangan</label>
              <select class="form-select" name="keter" id="validationCustom04" required>
                  <option value="8">Pengajuan Peminjaman</option>
                  <option value="7">Pengajuan Diservice</option>
              </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btn-store">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal Create -->

<!-- Modal Edit -->
@foreach($histori as $p)
<div class="modal fade" data-bs-backdrop="static" id="edit-modal{{ $p->id_transaksi }}" tabindex="-1" role="dialog" aria-labelledby="create-modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="create-modalLabel">Create Data</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{ route('update_transaksiKendaraan') }}">
          {{ csrf_field() }}

          <input type="hidden" id="n" name="id_gue" class="form-control" value="{{ $p->id_transaksi }}">

          <div class="form-group">
              <input type="hidden" value="{{$p->id_user}}" id="n" name="id" class="form-control" required>
              <label for="n">Name</label>
              <input type="text" value="{{$p->name}}" id="n" name="name" class="form-control" disabled>
          </div>
          <div class="form-group">
              <label for="e">No Plat</label>
                  <select name="no_plat" id="r" class="form-select" required>
                  @foreach($kendaraan as $r)
                      <option 
                      <?php 
                        $plat = ($p->no_plat);
                        if($plat == ($r->no_plat)){
                          echo "selected='selected'";
                        }
                       ?> value="{{ $r->no_plat }}">{{ $r->no_plat }}</option>
                  @endforeach
                  </select>
                  @if($errors->has('no_plat'))
                    <div class="text-danger">
                      {{ $errors->first('no_plat')}}
                    </div>
                  @endif
          </div>
          <div class="form-group">
              <label for="birthdaytime">Tanggal Pinjam :</label>
              <input type="datetime-local" value="{{ $p->tgl_peminjaman }}" id="tgl_pinjam" name="tgl_pinjam" class="form-control">
              @if($errors->has('tgl_pinjam'))
                    <div class="text-danger">
                      {{ $errors->first('tgl_pinjam')}}
                    </div>
              @endif
          </div>

          <div class="row">
            <div class="col-md-4 mb-3">
                <label for="e">Keterangan</label>
                    <select name="keter" id="r" class="form-select" required>
                      <option 
                        <?php 
                          $keter = "Pengajuan Diservice";
                          echo "value='7'";
                          if($keter == ($p->statpinjam)){
                            echo "selected='selected'";
                          }
                         ?>>Pengajuan Diservice
                      </option>
                      <option 
                        <?php 
                          $keter = "Pengajuan Peminjaman";
                          echo "value='8'";
                          if($keter == ($p->statpinjam)){
                            echo "selected='selected'";
                            echo "class='disabled'";
                          }
                         ?>>Pengajuan Peminjaman
                      </option>
                  </select>
            </div>

            <div class="col-md-4 mb-3">
                <label for="e">Status approve</label>
                  <select name="approve_stats" id="r" class="form-select">
                    <option value="">null</option>
                    <option 
                    <?php 
                    $nilai = "Disetujui";

                    if($nilai == $p->statapprove){
                       echo "selected='selected'";
                    }
                    ?> value="9">Disetujui</option>
                  </select>
            </div>

            <div class="col-md-4 mb-3">
                <label for="e">Status Pengembali</label>
                  <select name="approve_pengembalian" id="r" class="form-select">
                    <option value="">null</option>
                    <option value="11">Dikembalikan</option>
                  </select>
            </div> 
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btn-store">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endforeach

<!-- Destroy Modal -->
@foreach($histori as $p)
<div class="modal fade" data-bs-backdrop="static" id="destroy-modal{{ $p->id_transaksi }}" tabindex="-1" role="dialog" aria-labelledby="destroy-modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content"> 
      <div class="modal-header">
        <h5 class="modal-title" id="destroy-modalLabel">Batalkan Transaksi?</h5>
        <form method="post" action="{{ route('deleteTransaksi') }}">
          {{ csrf_field() }}
          <input type="hidden" id="n" name="id_gue" class="form-control" value="{{ $p->id_transaksi }}" required>
          <input type="hidden" id="n" name="no_plat" class="form-control" value="{{ $p->no_plat }}" required>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-danger btn-destroy">Hapus</button>
      </div>
    </form>
    </div>
  </div>
</div>
@endforeach
@endsection 
