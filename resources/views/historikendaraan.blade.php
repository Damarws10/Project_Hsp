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
            <li class="breadcrumb-item">{{ Breadcrumbs::render('historikendaraan') }}</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
</section>

<div class="notify"></div>

<div class="card">
    <div class="card-header">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create-modal">
          Tambah Data
        </button>
    </div>
        <div class="card-body">
            <div class="table-responsive">    
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>No Plat</th>
                            <th>Foto</th>
                            <th>Tanggal Peminjaman</th>
                            <th>Keterangan</th>
                            <th>action</th>
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
                         <!--  <button type="button"
                                class="btn btn-primary"
                                data-toggle="modal"
                                data-target="#exampleModal{{ $p->id_transaksi }}">
                                Show
                          </button> -->
                          <img src="{{ Storage::url('public/').$p->foto }}" class="rounded" style="width: 150px">
                        </td>
                        <td>{{ date('l,d M Y', strtotime($p->tgl_peminjaman)) }}</td>
                        <td>{{ $p->status }}</td>
                        <td>
                            <button type="button" style="margin-bottom: 10px; width: 100%" class="btn btn-warning edit" data-toggle="modal" data-target="#edit-modal{{ $p->id_transaksi }}">
                                Edit </button>
                            <br>
                            <button type="button" style="width: 100%" class="btn btn-danger delete" data-toggle="modal" data-target="#destroy-modal{{ $p->id_transaksi }}">
                                Delete </button>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>
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
<div class="modal fade" id="create-modal" tabindex="-1" role="dialog" aria-labelledby="create-modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="create-modalLabel">Create Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
          <div class="form-group">
              <label for="birthdaytime">Tanggal Pinjam :</label>
              <input type="datetime-local" id="tgl_pinjam" name="tgl_pinjam" class="form-control">
              @if($errors->has('tgl_pinjam'))
                    <div class="text-danger">
                      {{ $errors->first('tgl_pinjam')}}
                    </div>
              @endif
          </div>
          <div class="form-group">
              <label for="p">Keterangan</label>
              <input type="text" value="Pengajuan" name="keter"  id="p" class="form-control" disabled>
              <input type="hidden" value="8" name="keter"  id="p" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btn-store">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal Create -->

<!-- Modal Edit -->
@foreach($histori as $p)
<div class="modal fade" id="edit-modal{{ $p->id_transaksi }}" tabindex="-1" role="dialog" aria-labelledby="create-modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="create-modalLabel">Create Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="{{ route('update_transaksiKendaraan') }}">
          {{ csrf_field() }}

          <input type="hidden" id="n" name="id_gue" class="form-control" value="{{ $p->id_transaksi }}">

          <div class="form-group">
              <input type="hidden" value="{{Auth::user()->id}}" id="n" name="id" class="form-control" required>
              <label for="n">Name</label>
              <input type="text" value="{{Auth::user()->name}}" id="n" name="name" class="form-control" disabled>
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

          <div class="form-group">
              <label for="e">Keterangan</label>
                  <select name=keter id="r" class="form-select" required>
                    <option 
                      <?php 
                        $keter = "Dipakai";
                        echo "value='5'";
                        if($keter == ($p->status)){
                          echo "selected='selected'";
                        }
                       ?>>Dipakai
                    </option>
                    <option 
                      <?php 
                        $keter = "Tidak Dipakai";
                        echo "value='6'";
                        if($keter == ($p->status)){
                          echo "selected='selected'";
                        }
                       ?>>Tidak Dipakai
                    </option>
                    <option 
                      <?php 
                        $keter = "Diservice";
                        echo "value='7'";
                        if($keter == ($p->status)){
                          echo "selected='selected'";
                        }
                       ?>>Diservice
                    </option>
                    <option 
                      <?php 
                        $keter = "Pengajuan";
                        echo "value='8'";
                        if($keter == ($p->status)){
                          echo "selected='selected'";
                        }
                       ?>>Pengajuan
                    </option>
                  </select>
                  @if($errors->has('no_plat'))
                    <div class="text-danger">
                      {{ $errors->first('no_plat')}}
                    </div>
                  @endif
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btn-store">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endforeach

<!-- Destroy Modal -->
@foreach($histori as $p)
<div class="modal fade" id="destroy-modal{{ $p->id_transaksi }}" tabindex="-1" role="dialog" aria-labelledby="destroy-modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="destroy-modalLabel">Yakin Hapus ?</h5>
        <form method="post" action="{{ route('deleteTransaksi') }}">
          {{ csrf_field() }}
          <input type="hidden" id="n" name="id_gue" class="form-control" value="{{ $p->id_transaksi }}" required>
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
