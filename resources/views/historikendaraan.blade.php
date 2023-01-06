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
            <li class="breadcrumb-item">{{ Breadcrumbs::render('historikendaraan') }}</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
</section>
<div class="notify"></div>

<div class="card mx-auto col-11">
    <div class="card-header" style="background-color: transparent;">
        <!-- Button trigger modal -->
        <h2 style="text-align: center;">Histori Kendaraan</h2>
    </div>
        <div class="card-body">
            <div class="table-responsive">    
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <?php
                              if(!(Auth::user()->role == "superuser" || Auth::user()->role == "admin")){
                              echo "<th>Nama Peminjam</th>";
                              echo "<th>No Plat</th>";
                              echo "<th>Tanggal Request</th>";
                              echo "<th>Tanggal Approve Request</th>";
                              echo "<th>Tanggal Pengembalian</th>";
                              echo "<th>Tanggal Approve Pengembalian</th>";
                              }else{
                                echo "<th>No Plat</th>
                                      <th>Nama Kendaraan</th>
                                      <th>Merek Kendaraan</th>";
                              }
                            ?>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php $no=1; ?>
                      @foreach($histori as $histori)
                      <td>{{ $no++ }}</td>
                      <?php print(!(Auth::user()->role == "superuser" || Auth::user()->role == "admin") ? "<td> <a data-bs-toggle='modal' data-bs-target='#detail-modal$histori->id' >$histori->name </a> </td>" : "")?>
                      <td>{{ $histori->no_plat }}</td>
                      <?php

                      if(Auth::user()->role == "superuser" || Auth::user()->role == "admin"){
                          echo "<td>$histori->nama_kendaraan</td>
                                <td>$histori->mrk_kendaraan</td>";
                        }else{
                          echo "";
                        }
                      ?>

                      <?php

                      if(!(Auth::user()->role == "superuser" || Auth::user()->role == "admin")){
                        $tanggal = date('l,d M Y', strtotime($histori->tanggal_request));
                        
                          echo "<td> $tanggal </td>";

                        }else{
                          echo "";
                        }
                      ?>
                      <?php
                      if(!(Auth::user()->role == "superuser" || Auth::user()->role == "admin")){
                      $time = ($histori->approve_request);
                      $tanggal = date('l,d M Y', strtotime($histori->approve_request));
                         if(empty($time) && empty($histori->keterangan)){
                          echo "<td>Menunggu</td>";
                         }else if($histori->keterangan == 10){
                          echo "<td>DiTolak</td>";
                         }else{
                          echo "<td>$tanggal</td>";
                         } 
                      }else{
                        echo "";
                      }
                       ?>

                      <?php

                      if(!(Auth::user()->role == "superuser" || Auth::user()->role == "admin")){
                        $tanggal = date('l,d M Y', strtotime($histori->tanggal_pengembalian));
                        
                          echo "<td> $tanggal </td>";

                        }else{
                          echo "";
                        }
                      ?>

                      <?php

                      if(!(Auth::user()->role == "superuser" || Auth::user()->role == "admin")){
                      $time = ($histori->approve_pengembalian);
                      $tanggal = date('l,d M Y', strtotime($histori->approve_pengembalian));
                         if(empty($time) && empty($histori->keterangan)){
                          echo "<td>Menunggu</td>";
                         }else if(empty($time) && $histori->keterangan == 9){
                          echo "<td>Menunggu</td>";
                         }else if($histori->keterangan == 10){
                          echo "<td>DiTolak</td>";
                         }else{
                          echo "<td>$tanggal</td>";
                         }
                      }else{
                        echo "";
                      }
                       ?>
                        <td>
                          <?php
                          if(!(Auth::user()->role == "superuser" || Auth::user()->role == "admin")){
                          echo"<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#detail-modal$histori->id'>
                              Detail 
                            </button>";
                          }else{
                            echo "<a href='detailkendaraan/$histori->no_plat' class='btn btn-primary' style='margin-right:10px;'>
                              Pemakaian 
                            </a>";

                            // echo"<button type='button' class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#staticBackdrop$histori->plat_id'>
                            //   Detail 
                            // </button>";
                          }
                          ?>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                </table>
            </div>
        </div>
</div>
  
<!-- Destroy Modal -->
@foreach($user_histori as $histori)
<div class="modal fade" data-bs-backdrop="static" id="detail-modal{{ $histori->id }}" tabindex="-1" role="dialog" aria-labelledby="destroy-modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="container my-5 pr-5">
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <div class="row">
          <div class="col-md-12 md-1">
            <h4 style="margin-left: 1.2rem;">Latest News</h4>
            <ul class="timeline-3">
              <li>
                <a href="#!">Pengajuan Request</a>
                <!-- diambil dari tabel transaksi -->
                <a href="#!" class="float-end">{{ date('l,d M Y', strtotime($histori->tanggal_request)) }}</a>
                <p class="mt-2"><?php
                  // diambil dari tabel tanggal yg nilainya tidak empty
                  $nilai=($histori->approve_request);
                  if(empty($nilai)){
                    echo "Mohon Tunggu Sedang Di request ke admin";
                  }else{
                    echo "Sudah diproses";
                  }
                ?></p>
              </li>
              <li>
                <a href="#!">Pengajuan Approved</a>
                <a href="#!" class="float-end">
                  <?php
                    $waktu_utama = ($histori->approve_request); 
                    $waktu = date('l,d M Y', strtotime($histori->approve_request));
                    if(!empty($waktu_utama)){
                      echo "$waktu";
                    }else{
                      echo "Menunggu";
                    }

                  ?>
                </a>
                <p class="mt-2">
                  <?php
                  // diambil dari tabel tanggal yg nilainya tidak empty
                  $nilai=($histori->approve_request);
                  $waktu = date('H : i', strtotime($nilai));

                  if(empty($nilai)){
                    echo "Not approved";
                  }else{
                    echo "Approved";
                    echo "<ul>
                            <li>Nama Aprroved   : $histori->name </li>
                            <li>Waktu Approved  : $waktu </li>
                          </ul>";
                    echo "Terimakasih Sudah Menunggu dan Melakukan Transaksi :)";
                  }
                ?>
                </p>
              </li>
              <li>
                <a href="#!">Approved Pengembalian</a>
                <a href="#!" class="float-end">
                  <?php
                    $waktu_utama = ($histori->approve_pengembalian); 
                    $waktu = date('l,d M Y', strtotime($waktu_utama));
                    if(!empty($waktu_utama)){
                      echo "$waktu";
                    }else{
                      echo "Belum Dikembalikan";
                    }

                  ?>
                </a>
                <p class="mt-2">
                  <?php
                    // diambil dari tabel tanggal yg nilainya tidak empty
                    $nilai=($histori->approve_pengembalian);
                    $waktu = date('H : i', strtotime($nilai));
                    if(empty($nilai)){
                      echo "Not approved";
                    }else{
                      echo "Approved";
                      echo "<ul>
                              <li>Nama Penerima   : $histori->name</li>
                              <li>Waktu Diterima  : $waktu</li>
                            </ul>";
                     echo "Terimakasih Sudah Meminjam dan Melakukan Pengembalian :)";
                    }
                  ?>
                </p>
              </li>
            </ul>
          </div>
        </div>
      </div>  
    </div>
  </div>
</div>
@endforeach

@foreach($detail_histori as $histori)
<div class="modal fade" id="staticBackdrop{{ $histori->id_plat }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Detail</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>No Plat : {{$histori->no_plat}}</p>
        <p>Nama Kendaraan : {{}}</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Understood</button>
      </div>
    </div>
  </div>
</div>
@endforeach

@endsection 