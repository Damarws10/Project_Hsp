<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ 'home' }}" class="brand-link" style="text-decoration: none">
      <img src="../../img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">PinjamVichle</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../../img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a style="text-decoration: none" href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         <li class="nav-item">
            <a href="{{ 'home' }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>


          <li class="nav-item">
            <a href="{{ 'historikendaraan' }}" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                History Kendaraan
              </p>
            </a>
          </li>

          <li>
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Transaksi Kendaraan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ 'formuser' }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Form User</p>
                </a>
              </li>
            </ul>
          </li>



          <li <?php 

            $user = "superuser";
            $user2 = "admin";
            if((Auth::user()->role) == $user || (Auth::user()->role) == $user2 ){
              echo "class='nav-item'";
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
              <li class="nav-item">
                <a href="{{ 'formuser' }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Form User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ 'informasiuser' }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Informasi User</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-car"></i>
              <p>
                Data Kendaraan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li <?php 

            $user = "superuser";
            $user2 = "admin";
            if((Auth::user()->role) == $user || (Auth::user()->role) == $user2 ){
              echo "class='nav-item'";
            }else{
              echo "class='nav-item visually-hidden-focusable'";
            }
           ?>>
                <a href="{{ 'formkendaraan' }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Form Kendaraan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ 'informasikendaraan' }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Informasi Kendaraan</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
