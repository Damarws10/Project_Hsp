@extends('layouts.master')

@section('content')

<!-- Main content -->
<section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Home</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">{{ Breadcrumbs::render('home') }}</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
</section>
  <?php
    if(Auth::user()->role == "superuser" || Auth::user()->role == "admin"){
      echo "<div class='container-fluid'>
        <div class='row'>
          <div class='col-lg-3 col-6'>
            <div class='small-box bg-info'>
              <div class='inner'>
                <h3>$userJumlah</h3>

                <p>Jumlah User</p>
              </div>
              <div class='icon'>
                <i class='ion ion-person-add'></i>
              </div>
              <a href='#' class='small-box-footer'><i class='fas fa-arrow-circle-right'></i></a>
            </div>
          </div>
          
          <div class='col-lg-3 col-6'>

            <div class='small-box bg-success'>
              <div class='inner'>
                <h3>$kendaraanJumlah</h3>

                <p>Jumlah Kendaraan</p>
              </div>
              <div class='icon'>
                <i class='ion ion-stats-bars'></i>
              </div>
              <a href='#' class='small-box-footer'><i class='fas fa-arrow-circle-right'></i></a>
            </div>
          </div>

          <div class='col-lg-3 col-6'>

            <div class='small-box bg-warning'>
              <div class='inner'>
                <h3>$kendaraanTerpakai</h3>

                <p>Kendaraan Terpakai</p>
              </div>
              <div class='icon'>
                <i class='ion ion-person'></i>
              </div>
              <a href='#' class='small-box-footer'><i class='fas fa-arrow-circle-right'></i></a>
            </div>
          </div>

          <div class='col-lg-3 col-6'>

            <div class='small-box bg-danger'>
              <div class='inner'>
                <h3>";
                $jumlah = $kendaraanJumlah - $kendaraanTerpakai;
                echo $jumlah;
                echo "</h3>

                <p>Kendaraan Tidak Terpakai</p>
              </div>
              <div class='icon'>
                <i class='ion ion-pie-graph'></i>
              </div>
              <a href='#' class='small-box-footer'><i class='fas fa-arrow-circle-right'></i></a>
            </div>
          </div>
        </div>
      </div>";
    }else{
      echo "";
    }
?>
      <br>

        <div class="container-fluid">
          <div class="row justify-content-between">
          <div class="col-6 col-sm-4">
            <select id="myInput" class="form-select form-select-lg mb-3" aria-label="Default select example">
              <option selected disabled>Filter Kendaraan</option>
              <option value="Tidak Dipakai">Tidak Dipakai</option>
              <option value="Request">Request</option>
            </select>
          </div>
          <div class="col-6 col-sm-4">
            {{ csrf_field() }}
            <form class="d-flex" method="get" action="{{ route('search_kendaraan') }}">
              <input name="search" class="form-control me-2" type="search" placeholder="Cari dari no plat" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            </div>
          </div>
        </div>

        <div class="container">
          <div id="myDIV" class="row">
          @foreach($kendaraan as $p)
          <div class="col-lg-2">
          <div class="card">
            <img class="card-img-top" src="{{ asset('uploads/kendaraan/'.$p->foto) }}" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-text" style="text-align: center;">{{ $p->no_plat }}</h5>
              <h4 class="card-text">{{ $p->nama_kendaraan }}</h4>
              <p class="card-text">Merek     : {{ $p->mrk_kendaraan  }}</p>
              <p class="card-text text-sm-left">Status    : {{ $p->statusPinjam  }}</p>
              <?php
                if(Auth::user()->role == "user" && $p->statusPinjam == "Tidak Dipakai"){
                  echo "<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#create-modal$p->id_kendaraan' >
                  Pinjam kendaraan
                  </button>";
                }else if(Auth::user()->role == "user" && $p->statusPinjam == "Request"){
                  echo "";
                }else{
                   echo "";
                }
              ?>
            </div>
          </div>
          </div>
          @endforeach
          </div>
        </div>
        <!-- Main content -->

        <br>

      <div class="pagination" style="justify-content: right; margin-right: 10px;">
      {{ $kendaraan->links('vendor.pagination.bootstrap-4') }}
      </div>
    <!-- /.content -->


@foreach($kendaraan as $p)
<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="create-modal{{ $p->id_kendaraan }}" tabindex="-1" role="dialog" aria-labelledby="create-modalLabel" aria-hidden="true">
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
               <input type="text" value="{{$p->no_plat}}" id="n" name="noPlat" class="form-control" disabled>
               <input type="hidden" value="{{$p->no_plat}}" id="n" name="no_plat" class="form-control">
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
@endforeach
@endsection
