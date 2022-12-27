<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link" style="text-decoration: none">
      <img src="{{ asset('img/favicon.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">PinjamKendaraan</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <?php
            $foto = asset('uploads/user/'.Auth::user()->foto_user);
            $fotoDefault = asset('img/avatar4.png');
            if(empty(Auth::user()->foto_user)){
              echo "<img src='$fotoDefault' class='img-circle elevation-2' alt='User Image'>";
            }else{
              echo "<img src='$foto' class='img-circle elevation-2' alt='User Image'>";
            }
          ?>
        </div>
        <div class="info">
          <a style="text-decoration: none" href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <?php 
                $user = "superuser";
                $user2 = "admin";
                if((Auth::user()->role) == $user || (Auth::user()->role) == $user2 ){
                  $link =  route('transaksikendaraan');
                  echo "<li class='nav-item'> 
                          <a href='$link' class='nav-link'>
                            <i class='nav-icon fa-solid fa-right-left'></i>
                            <p>
                            Peminjaman dan Pengembalian Kendaraan
                            <span class='badge badge-info right'>$kendaraan</span>
                            </p>
                          </a>
                        </li>";
                }else{
                  echo "";
                }
          ?>

          <li class="nav-item">
            <a href="{{ route('historikendaraan') }}" class="nav-link">
               <i class="nav-icon fas fa-book"></i>
               <p>Histori Kendaraan</p>
            </a>
          </li>

          <?php 
            $user2 = "admin";
            $link = route('informasiuser');
            if((Auth::user()->role) == $user2 ){
              echo "<li class='nav-item'>
                      <a href='$link' class='nav-link'>
                         <i class='nav-icon fas fa-user'></i>
                         <p>Informasi User</p>
                      </a>
                    </li>";
            }else{
              echo "";
            }
           ?>

          <li <?php 

            $user = "superuser";
            if((Auth::user()->role) == $user){
              echo "<li class='nav-item'";
            }else{
              echo "class='nav-item visually-hidden-focusable'";
            }
           ?>>
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Data User
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li <?php $user = (Auth::user()->role);
              print($user == "superuser" ? "class=nav-item" : "class=visually-hidden-focusable") ?>>
                <a href="{{ route('formuser') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Form User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('informasiuser') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Informasi User</p>
                </a>
              </li>
            </ul>
          </li>

          <?php 
                $user = "user";
                if((Auth::user()->role) == $user){
                  $link =  route('informasikendaraan');
                  echo "<li class='nav-item'> 
                          <a href='$link' class='nav-link'>
                            <i class='nav-icon fas fa-car'></i>
                            <p>
                            Informasi Kendaraan
                            </p>
                          </a>
                        </li>";
                }else{
                  echo "";
                }
          ?>

          <li <?php 

            $user = "superuser";
            $user2 = "admin";
            if((Auth::user()->role) == $user || (Auth::user()->role) == $user2){
              echo "class='nav-item'";
            }else{
              echo "class='nav-item visually-hidden-focusable'";
            }
           ?>>
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-car"></i>
              <p>
                Data Kendaraan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('formkendaraan') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Form Kendaraan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('informasikendaraan') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Informasi Kendaraan</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- Data Kendaraan -->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
