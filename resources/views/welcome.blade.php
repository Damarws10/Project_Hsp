<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link rel="icon" href="{{ asset('img/favicon.png') }}?v={{ date('YmdHis') }}">
        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
                margin-top: 10%;
            }
        </style>
    </head>
    <body class="antialiased">
        <!-- Section: Design Block -->
                <section class="">
                  <!-- Jumbotron -->
                  <div class="px-4 py-5 px-md-5 text-center text-lg-start" style="background-color: hsl(0, 0%, 96%)">
                    <div class="container">
                      <div class="row gx-lg-5 align-items-center">
                        <div class="col-lg-6 mb-5 mb-lg-0">
                          <h1 class="my-5 display-3 fw-bold ls-tight">
                            Pinjam Kendaraan <br />
                            <span class="text-primary">PT HSP Net</span>
                          </h1>
                          <p style="color: hsl(217, 10%, 50.8%)">
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
                                        <a href="{{ route('login') }}" style="width: 100%;" class="btn btn-primary">Masuk Log in</a>

                                       <!--  @if (Route::has('register'))
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
    </body>
</html>
