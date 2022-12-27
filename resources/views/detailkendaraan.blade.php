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
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('historikendaraan') }}">Histori Kendaraan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Histori Kendaraan</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
</section>

<div class="card mx-auto">
    <div class="card-header" style="background-color: transparent;">
        <!-- Button trigger modal -->
        <h2 style="text-align: center;">Detail Histori Kendaraan : {{ $NomerPlat }}</h2>
    </div>
        <div class="card-body">
          <div class="container">

            <h5 class="mt-4 mb-2">
            </h5>
              <div class="row">

                <div class="col-lg-6 col-sm-6 col-12">
                  <div class="info-box bg-info">
                    <span class="info-box-icon"><i class="far fa-bookmark"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text">Request saat ini</span>
                      <span class="info-box-number">{{ $hitungpemakaian }}</span>

                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-lg-6 col-sm-6 col-12">
                  <div class="info-box bg-success">
                    <span class="info-box-icon"><i class="far fa-thumbs-up"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text">Tanggal Terakhir diPakai</span>
                      <span class="info-box-number">
                     
                      <?php 
                      $tanggal = date('l, d M Y/H:i', strtotime($tanggalBaru));

                      if(empty($tanggalBaru)){
                        echo "";
                      }else{
                        echo $tanggal;
                      }
                      ?>
                      </span>

                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-lg-6 col-sm-6 col-12">
                  <div class="info-box bg-warning">
                    <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text">Nama Terakhir request</span>
                      <span class="info-box-number">{{ $userhistori }}</span>

                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-lg-6 col-sm-6 col-12">
                  <div class="info-box bg-danger">
                    <span class="info-box-icon"><i class="fas fa-comments"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text">Approve By</span>
                      <span class="info-box-number">{{ $CreatedByhistori }}</span>

                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>
                <!-- /.col -->
              </div>
            </div>
          </div>
</div>

<div class="card">
  <div class="card-header">
      <h3 class="card-title">DataTable</h3>
  </div>
    <!-- /.card-header -->
  <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>No</th>
        <th>Nama User</th>
        <th>Tanggal Request</th>
        <th>Approve Request</th>
        <th>Tanggal Pengembalian</th>
        <th>Approve Pengembalian</th>
        <th>Keterangan</th>
        <th>Updated</th>
      </tr>
      </thead>
      <tbody>
        <?php $no=1; ?>
        @foreach($ShowDetailKendaraan as $detail)
        <tr>
          <td>{{ $no++ }}</td>
          <td>{{ $detail->userName }}</td>
          <td>{{ date('l, d M Y', strtotime($detail->tanggal_request)) }}</td>
          <td>
            <?php 
              $tanggal = date('l, d M Y/H:i', strtotime($detail->approve_request));

                if(empty($detail->approve_request)){
                    echo "";
                }else{
                    echo $tanggal;
                }
          ?>
          </td>
          <td>{{ date('l, d M Y/H:i', strtotime($detail->tanggal_pengembalian)) }}</td>
          <td>
            <?php 
              $tanggal = date('l, d M Y', strtotime($detail->approve_pengembalian));

                if(empty($detail->approve_pengembalian)){
                    echo "";
                }else{
                    echo $tanggal;
                }
          ?>
          </td>
          <td>{{ $detail->keteranganStats }}</td>
          <td>{{ $detail->updateName }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>
@endsection 
