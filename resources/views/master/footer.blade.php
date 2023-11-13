<div id="loader">
    <img src="{{URL('/')}}/custom/loader.gif" alt="Loading...">
</div>
<footer class="main-footer">
    <strong>Copyright &copy; @php date('Y') @endphp <a href="#">CRM</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{URL('/')}}/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{URL('/')}}/adminlte/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{URL('/')}}/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<!-- <script src="{{URL('/')}}/adminlte/plugins/chart.js/Chart.min.js"></script> -->
<!-- Sparkline -->
<!-- <script src="{{URL('/')}}/adminlte/plugins/sparklines/sparkline.js"></script> -->
<!-- JQVMap -->
<!-- <script src="{{URL('/')}}/adminlte/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="{{URL('/')}}/adminlte/plugins/jqvmap/maps/jquery.vmap.usa.js"></script> -->
<!-- jQuery Knob Chart -->
<!-- <script src="{{URL('/')}}/adminlte/plugins/jquery-knob/jquery.knob.min.js"></script> -->
<!-- daterangepicker -->
<!-- <script src="{{URL('/')}}/adminlte/plugins/moment/moment.min.js"></script>
<script src="{{URL('/')}}/adminlte/plugins/daterangepicker/daterangepicker.js"></script> -->
<!-- Tempusdominus Bootstrap 4 -->
<!-- <script src="{{URL('/')}}/adminlte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script> -->
<!-- Summernote -->
<!-- <script src="{{URL('/')}}/adminlte/plugins/summernote/summernote-bs4.min.js"></script> -->
<!-- overlayScrollbars -->
<!-- <script src="{{URL('/')}}/adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script> -->
<!-- AdminLTE App -->
<script src="{{URL('/')}}/adminlte/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="{{URL('/')}}/adminlte/dist/js/demo.js"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="{{URL('/')}}/adminlte/dist/js/pages/dashboard.js"></script> -->
<!-- Toastr -->
<!-- <script src="{{URL('/')}}/adminlte/plugins/toastr/toastr.min.js"></script> -->
<!-- Choosen -->
<!-- <script src="{{URL('/')}}/adminlte/plugins/inputmask/jquery.inputmask.min.js"></script> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script>
  $(document).ready(function () {
    $('#example').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "info": true,
      "autoWidth": false,

      "ordering": false // Disable initial sorting

    });
  });
</script>


