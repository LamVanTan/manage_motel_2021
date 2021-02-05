      <!-- Footer -->
      <footer class="footer">
        <div class="row align-items-center justify-content-xl-between">
          <div class="col-xl-6">
            <div class="copyright text-center text-xl-left text-muted">
              &copy; 2020 <a href="https://www.creative-tim.com" class="font-weight-bold ml-1" target="_blank">Creative Tim</a>
            </div>
          </div>
          <div class="col-xl-6">
            <ul class="nav nav-footer justify-content-center justify-content-xl-end">
              <li class="nav-item">
                <a href="https://www.creative-tim.com" class="nav-link" target="_blank">Creative Tim</a>
              </li>
              <li class="nav-item">
                <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About Us</a>
              </li>
              <li class="nav-item">
                <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
              </li>
              <li class="nav-item">
                <a href="https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md" class="nav-link" target="_blank">MIT License</a>
              </li>
            </ul>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!--   Core   -->
  
  <script src="http://localhost/Motel/public/templates/admin/js/plugins/jquery/dist/jquery.min.js"></script>
  <script src="http://localhost/Motel/public/templates/admin/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!--   Optional JS   -->
  <script src="http://localhost/Motel/public/templates/admin/js/plugins/chart.js/dist/Chart.min.js"></script>
  <script src="http://localhost/Motel/public/templates/admin/js/plugins/chart.js/dist/Chart.extension.js"></script>
  <!--   Argon JS   -->
  <script src="http://localhost/Motel/public/templates/admin/js/argon-dashboard.min.js?v=1.1.2"></script>
  <script src="http://localhost/Motel/public/templates/admin/js/customs.js"></script>
  <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  
  <script>
    window.TrackJS &&
      TrackJS.install({
        token: "ee6fab19c5a04ac1a32a645abde4613a",
        application: "argon-dashboard-free"
      });
  </script>
  <script>
    $('.carousel').carousel({
      interval: 2000
    })
  </script>
  
  @if(Session::has('warning'))
    @php 
      $warning = Session::get('warning');
    @endphp
    <script type="text/javascript">
        swal("","<?php echo $warning; ?>", "warning");
    </script>
  @endif

  @if(Session::has('messages'))
    @php 
      $message = Session::get('messages');
    @endphp
    <script type="text/javascript">
        swal("","<?php echo $message; ?>", "success");
    </script>
  @endif

  @if(Session::has('thanhToanTien'))
   @php 
     $message = Session::get('thanhToanTien');
   @endphp
      <script type="text/javascript">
          swal("","<?php echo $message; ?>", "success");	
      </script>
  @endif

</body>

</html>