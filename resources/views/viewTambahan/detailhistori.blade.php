@extends('layouts.master')

@section('content')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Detail Histori</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">{{ Breadcrumbs::render('detailhistori') }}</li>
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
            <img src="public/img/user4-128x128.jpg" class="w3-hover-opacityalt=Profile">
          </div>
        </div>
      </div>
  
      <div class="col-xl-6">
        <div class="card">
          <div class="card-body pt-3">
          <div class="container-fluid">
        <!-- Small boxes (Stat box) -->

        <div class="row">
          <div class="col-lg-6 col-4">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>150</h3>
                <p>New Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <!-- ./col -->
          <div class="col-lg-6 col-4">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>53<sup style="font-size: 20px">%</sup></h3>
                <p>Bounce Rate</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>

          <!-- ./col -->
          <div class="row">
          <div class="col-lg-6 col-4">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>44</h3>
                <p>User</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-6 col-4">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>65</h3>
                <p>Unique</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
         </div>
        </div>
         </div><!-- End Bordered Tabs -->
         </div>
        </div>

        <div class="col-xl-4">
      </div>
      <div class="col-xl-6">
        <div class="card">
          <div class="card-body pt-3">
          <div class="container-fluid">
            <h3>Deskripsi</h3>
        </div>
        </div>
        </div>
        </div>
      </div>
    </div>
  </section>
  @endsection
