@extends('layouts.master')

@section('content')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Form Kendaraan</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">{{ Breadcrumbs::render('formkendaraan') }}</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
</section>

<div class="col-md-12 d-flex justify-content-center">
    <div class="card card-secondary">
      <div class="card-header">
      <h3 class="card-title">Data Kendaraan</h3>
      </div>
      <div class="card-body">
          <form method="POST" action="{{ route('store_kendaraan') }}" enctype="multipart/form-data" >
             {{ csrf_field() }}

             <input type="hidden" id="n" name="id_user" class="form-control" value="{{ Auth::user() -> id }}" required>

              <div class="row">
                <div class="col-md-4 mb-3">
                  <label for="validationCustom01">No Plat</label>
                  <input type="text" class="form-control" name="no_plat" id="validationCustom01" placeholder="B xxxx xxx">
                  @if($errors->has('no_plat'))
                    <div class="text-danger">
                      {{ $errors->first('no_plat')}}
                    </div>
                  @endif
                  <div class="valid-feedback">
                    Tolong diperhatikan!
                  </div>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="validationCustom02">Nama kendaraan</label>
                  <input type="text" class="form-control" name="nama_kendaraan" id="validationCustom02" placeholder="Nama Kendaraan">
                  @if($errors->has('nama_kendaraan'))
                    <div class="text-danger">
                      {{ $errors->first('nama_kendaraan')}}
                    </div>
                  @endif
                  <div class="valid-feedback">
                    Good job!
                  </div>
                </div>
                <div class="col-md-4 mb-3">
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
                  <input type="text" class="form-control" name="thn_pembuatan" id="validationCustom03" placeholder="year">
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
                  <input type="text" class="form-control" name="warna" id="validationCustom04" placeholder="color">
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
                    @foreach($tipe as $p)
                      <option value="{{ $p->tp_kendaraan }}">{{ $p->tp_kendaraan }}</option>
                    @endforeach  
                  </select>
                </div>

                <div class="col-md-4 mb-3">
                  <label for="validationCustom05">Merek Kendaraan</label>
                  <select name="merek_kendaraan" id="r" class="form-select" required>
                      <option disabled="">- Merek -</option>
                    @foreach($model as $p)
                      <option value="{{ $p->mrk_kendaraan }}">{{ $p->mrk_kendaraan }}</option>
                    @endforeach  
                  </select>
                </div>

                <div class="col-md-4 mb-3">
                  <label for="validationCustom05">Status</label>
                    <select name="status" id="r" class="form-select" required=>
                      <option disabled="">- Status -</option>
                      <option value="1">Perpanjang STNK</option>
                      <option value="2">Balik Nama BPKB</option>
                      <option value="3">Pembuatan STNK</option>
                      <option value="4">Perpanjang STNK & Ganti Plat</option>
                    </select>
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Create</button>
          </form>
      </div>
    </div>
</div>
@endsection 