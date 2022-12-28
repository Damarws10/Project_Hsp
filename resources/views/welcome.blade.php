<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>HSP | Pinjam Kendaraan</title>
        <link rel="icon" href="{{ asset('img/favicon.png') }}?v={{ date('YmdHis') }}">
        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

         <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
        <!-- icheck bootstrap -->
        <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{asset('/css/adminlte.min.css')}}">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
                margin-top: 10%;
                background-image: url({{url('img/background-1.jpg')}});
                background-attachment: fixed;
                background-size: cover;
            }
        </style>
    </head>
    <body class="mt-0">
        <!-- Section: Design Block -->
                <section class="">
                  <!-- Jumbotron -->
                  <div class="px-4 py-5 px-md-5 text-center text-lg-start">
                    <div class="container">
                      <div class="row gx-lg-5 align-items-center">
                        <div class="col-lg-6 mb-5 mb-lg-0">
                          <h1 class="my-5 display-3 fw-bold ls-tight">
                            Pinjam Kendaraan <br />
                            <span class="text-primary">PT HSP Net</span>
                          </h1>
                          <p style="color: black">
                            Pinjam kendaraan adalah e-transaksi untuk melakukan transaksi kendaraan keluar maupun masuk dan mendata kendaraan secara real-time.
                          </p>
                        </div>

                        <div class="col-lg-6 mb-5 mb-lg-0">
                          <div class="card">
                            <div class="card-body py-5 px-md-5">
                                <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
                            @if (Route::has('login'))
                                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                                    @auth
                                        <a href="{{ url('/home') }}" style="width: 100%;" class="btn btn-primary">Home</a>
                                    @else
                                        <div class="register-box mx-auto">
                                          <div class="card card-outline card-primary">
                                            <div class="card-header text-center">
                                              <img style="margin: 0 auto; width: 10em; box-sizing:border-box;" src="{{ asset('img/hsp.png') }}" alt="error">

                                              <a href="#" class="h3"><b>Pinjam</b>Kendaraan</a>
                                            </div>
                                            <div class="card-body">
                                              <p class="login-box-msg">Register Member Baru</p>

                                              <form action="{{ route('register') }}" method="post">
                                                @csrf

                                                <div class="input-group mb-3">
                                                  <input id="name" name="name" type="text" class="form-control" placeholder="Full name">
                                                  <div class="input-group-append">
                                                    <div class="input-group-text">
                                                      <span class="fas fa-user"></span>
                                                    </div>
                                                  </div>
                                                </div>
                                                <div class="input-group mb-3">
                                                  <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" required autocomplete="email" autofocus>
                                                  <div class="input-group-append">
                                                    <div class="input-group-text">
                                                      <span class="fas fa-envelope"></span>
                                                    </div>
                                                  </div>
                                                   @error('email')
                                                      <span class="invalid-feedback" role="alert">
                                                          <strong>{{ $message }}</strong>
                                                      </span>
                                                   @enderror
                                                </div>
                                                <div class="input-group mb-3">
                                                  <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required autocomplete="new-password">
                                                  <div class="input-group-append">
                                                    <div class="input-group-text">
                                                      <span class="fas fa-lock"></span>
                                                    </div>
                                                  </div>

                                                   @error('password')
                                                      <span class="invalid-feedback" role="alert">
                                                          <strong>{{ $message }}</strong>
                                                      </span>
                                                   @enderror
                                                </div>
                                                <div class="input-group mb-3">
                                                  <input id="password-confirm" name="password_confirmation" type="password" class="form-control" placeholder="Retype password" required autocomplete="new-password">
                                                  <div class="input-group-append">
                                                    <div class="input-group-text">
                                                      <span class="fas fa-lock"></span>
                                                    </div>
                                                  </div>
                                                </div>
                                                <div class="row">
                                                  <!-- /.col -->
                                                  <div class="col-12">
                                                    <button type="submit" class="btn btn-primary btn-block">Register</button>
                                                  </div>
                                                  <!-- /.col -->
                                                </div>
                                              </form>
                                            </div>
                                            <!-- /.form-box -->
                                          </div><!-- /.card -->
                                        </div>

                                        <br>

                                        <a href="{{ route('login') }}" style="width: 100%;" class="btn btn-primary">Sudah Punya Akun?</a>

                                        <!-- @if (Route::has('register'))
                                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                                        @endif -->
                                    @endauth
                                </div>
                            @endif
                        </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Jumbotron -->
                </section>
      <!-- Section: Design Block -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

      <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
      <!-- Bootstrap 4 -->
      <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
      <!-- AdminLTE App -->
      <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    </body>
</html>
