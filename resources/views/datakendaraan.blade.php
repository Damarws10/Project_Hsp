@extends('layouts.master')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
  
                <div class="card-body">
                    You are a Manager User.
                </div>
            </div>
        </div>
    </div>
</div>

<form class="needs-validation" novalidate>
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="validationCustom01">Nama Plat</label>
      <input type="text" class="form-control" id="validationCustom01" placeholder="B xxxx xxx" required>
      <div class="valid-feedback">
        Tolong diperhatikan!
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationCustom02">Nama kendaraan</label>
      <input type="text" class="form-control" id="validationCustom02" placeholder="Last name" required>
      <div class="valid-feedback">
        Good job!
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationCustom02">Foto</label>
      <input type="file" class="form-control" id="validationCustom02" placeholder="Last name" required>
      <div class="valid-feedback">
        Good job!
      </div>
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="validationCustom03">Tahun Pembuatan</label>
      <input type="text" class="form-control" id="validationCustom03" placeholder="City" required>
      <div class="invalid-feedback">
        Please provide a valid number.
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationCustom04">Warna Kendaraan</label>
      <input type="text" class="form-control" id="validationCustom04" placeholder="State" required>
      <div class="invalid-feedback">
        Please provide a valid Color.
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationCustom05">Tipe Kendaraan</label>
      <input type="text" class="form-control" id="validationCustom05" placeholder="Zip" required>
      <div class="invalid-feedback">
        Please provide a valid Type.
      </div>
    </div>
  </div>

  <br>

  <button class="btn btn-primary" type="submit">Submit</button>
</form>

@endsection