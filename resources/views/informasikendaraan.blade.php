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
        <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                        <tr>
                            <th>No</th>
                            <th>No Plat</th>
                            <th>Nama Kendaraan</th>
                            <th>Merek Kendaraan</th>
                            <th>Foto</th>
                            <th>Tipe Kendaraan</th>
                            <th>Pajak/Tahun</th>
                            <th>Status</th>
                            <th>Keterangan Kendaraan</th>
                            <?php  if(Auth::user()->role == "superuser" || Auth::user()->role == "admin"){
                              echo "<th>
                                    Action
                                    </th>";
                            }else{
                              echo "";
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                      <?php $no=1; ?>
                      @foreach($kendaraan as $p)
                      <tr id="user_id_{{ $p->id_kendaraan }}" disabled>
                        <td>{{ $no++ }}</td>
                        <td>{{ $p->no_plat }}</td>
                        <td>{{ $p->nama_kendaraan }}</td>
                        <td>{{ $p->mrk_kendaraan }}</td>
                        <td>
                         
                          <img id="myImg{{ $p->id_kendaraan }}" class="MyImg" src="{{ asset('uploads/kendaraan/'.$p->foto) }}" alt="{{ $p->nama_kendaraan }}" style="width:100px;max-width:300px">

                        </td>
                        <td>{{ $p->tipe }}</td>
                        <td>
                          <?php
    
                              date_default_timezone_set('Asia/Jakarta');

                              $tgl_pjk = $p->tgl_pajak;
                              
                              $oke = date('Y-m-d');
                              
                              $datetime1 = strtotime($tgl_pjk);
                              $datetime2 = strtotime($oke);
                              $secs = $datetime1 - $datetime2;// == return sec in difference
                              $days = $secs / 86400;

                              $hari = floor($days);

                              if($hari == 0 || $hari < 0){
                                echo "<p class='text-danger'>expired Segera Perbarui Pajak</p>";
                              }else if($hari >= 1 && $hari <= 10 ){
                                echo "<p class='text-warning'>$hari hari lagi expired</p>";
                              }else{
                                echo ($hari." hari lagi");
                              }
                              
                          ?> 
                        </td>
                        <td>{{ $p->status }}</td>
                        <td>{{ $p->statusPinjam }}</td>
                          <?php 

                            if(Auth::user()->role == "superuser" || Auth::user()->role == "admin")
                            {
                            echo "<td>";
                            echo "<button type='button' style='margin-bottom: 10px; width: 100%' class='btn btn-warning edit' data-bs-toggle='modal' data-bs-target='#edit-modal$p->id_kendaraan'>
                              Edit </button>";

                            echo "<br>";
                              if($p->statusPinjam == "Request" || $p->statusPinjam == "Digunakan"){
                                echo "";
                              }else{
                                echo "<button type='button' style='margin-bottom: 10px; width: 100%' class='btn btn-danger delete' data-bs-toggle='modal' data-bs-target='#destroy-modal$p->id_kendaraan'>
                                  Delete </button>";
                              }

                              echo "</td>";
                            }else{
                              echo "";
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



<div id="myModal" class="modal">

  <!-- The Close Button -->
  <span class="close">&times;</span>

  <!-- Modal Content (The Image) -->
  <img class="modal-content" id="img01">

  <!-- Modal Caption (Image Text) -->
  <div id="caption"></div>
</div>

<!-- javascript onclick -->
@foreach($kendaraan as $p)
<script> 
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var img = document.getElementById("myImg{{$p->id_kendaraan}}");
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");
    img.onclick = function(){
      modal.style.display = "block";
      modalImg.src = this.src;
      captionText.innerHTML = this.alt;
    }

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
      modal.style.display = "none";
    }
</script>
@endforeach

@foreach($kendaraan as $p)
<!-- Modal Edit -->
<div class="modal fade" data-bs-backdrop="static" id="edit-modal{{ $p->id_kendaraan }}" tabindex="-1" role="dialog" aria-labelledby="edit-modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="edit-modalLabel">Edit Data</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
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
                <div class="col-md-6 mb-1">
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
                <div class="col-md-6 mb-1">
                  <label for="validationCustom05">Tipe Kendaraan</label>
                    <select name="tipe_kendaraan" id="r" class="form-select" required>
                      <option disabled="">- Tipe -</option>
                      <option <?php 
                      if(($p->tipe) == "Mobil"){
                        echo "selected='selected'";
                      }else{
                        echo "";
                      } 
                      ?> value="1">Mobil</option>
                      <option
                      <?php 
                      if(($p->tipe) == "Motor"){
                        echo "selected='selected'";
                      }else{
                        echo "";
                      } 
                      ?>
                       value="2">Motor</option>
                    </select>
                </div>
                  @if($errors->has('tipe_kendaraan'))
                    <div class="text-danger">
                      {{ $errors->first('tipe_kendaraan')}}
                    </div>
                  @endif
                  <div class="invalid-feedback">
                    Please provide a valid Tipe.
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
                  <label for="validationCustom05">Kendaraan</label>
                  <select name="tipe" id="r" class="form-select" required>
                      <option disabled="">- Tipe -</option>
                      @foreach($tipe as $q)
                      <option <?php 
                        $tipe_kendaraan =  ($p->tp_kendaraan);
                        if($tipe_kendaraan ==  ($q->tp_kendaraan)){
                          echo "selected='selected'";
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
                <div class="row">
                <div class="form-group col-md-12">
                  <label>Tanggal Perpanjang STNK :</label>
                  <input type="datetime-local" id="tgl_stnk" name="tgl_stnk" class="form-control" value="{{ $p->tgl_pajak }}">
                  @if($errors->has('tgl_stnk'))
                        <div class="text-danger">
                          {{ $errors->first('tgl_stnk')}}
                        </div>
                  @endif
                </div>                
              </div>
              </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
<div class="modal fade" data-bs-backdrop="static" id="destroy-modal{{ $p->id_kendaraan }}" tabindex="-1" role="dialog" aria-labelledby="destroy-modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="destroy-modalLabel">Yakin Hapus ? Kendaraan : {{ $p->no_plat }}, {{ $p->nama_kendaraan }}</h5>
        <form method="post" action="{{ route('delete_kendaraan') }}">
          {{ csrf_field() }}
          <input type="hidden" id="n" name="id_gue" class="form-control" value="{{ $p->id_kendaraan }}" required>
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