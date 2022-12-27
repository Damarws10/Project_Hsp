<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">
  
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('/plugins/fontawesome-free/css/all.min.css')}}">
  <link rel="stylesheet" href="{{asset('/plugins/fontawesome-free/css/brands.css')}}">
  <link rel="stylesheet" href="{{asset('/plugins/fontawesome-free/css/solid.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{asset('/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('/plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('/plugins/select2/css/select2.min.css')}}">
  
  <link rel="stylesheet" href="{{asset('/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('/plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('/plugins/summernote/summernote-bs4.min.css')}}">

  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link rel="icon" href="{{ asset('img/favicon.png') }}?v={{ date('YmdHis') }}">
    <title>HSP | Pinjam Kendaraan</title>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="../../img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- navbar header -->
    @include('partials.header')

    <!-- Navbari-side -->
    @include('partials.navbarside')

    <div class="content-wrapper">


     @if(Session::has('success'))
      <div class="alert alert-success alert-dismissible">
      <h5><i class="icon fas fa-check"></i> Alert!</h5>
          {{Session::get('success')}}
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      </div>
     @endif

     @if(Session::has('info'))
      <div class="alert alert-warning alert-dismissible">
      <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
       {{Session::get('info')}}
       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      </div>
     @endif

     @if(Session::has('delete'))
      <div class="alert alert-danger alert-dismissible">
      <h5><i class="icon fas fa-ban"></i> Alert!</h5>
       {{Session::get('delete')}}
       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      </div>
     @endif
      <!-- Main content -->
        @yield('content')
      <!-- /.content -->
    </div>

    <!-- footer -->
    @include('partials.footer')

  </div>

  <!-- javascript -->
    <!-- Bootstrap core Javascript -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
   
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
   
<!-- jQuery -->
<script src="{{asset('/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="{{asset('/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="{{asset('/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('/plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset('/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('/plugins/moment/moment.min.js')}}"></script>

<script src="{{asset('/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('/js/adminlte.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/script.js')}}"></script>
<script src="{{asset('/js/jquery.countdown/jquery.countdown.js')}}"></script>
<script src="{{asset('/js/jquery.countdown/jquery.countdown.min.js')}}"></script>
<!-- DataTables  & Plugins -->
<script src="{{asset('/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "excel", "pdf", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });

    $(document).ready(function(){
          $("#myInput").on("change", function() {
            var value = $(this).val().toLowerCase();
            $("#myDIV .card").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
          });
      });
    });
  });
</script>

</body>
</html>