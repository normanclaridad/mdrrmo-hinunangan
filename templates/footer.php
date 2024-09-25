<?php
    $uri = $_SERVER['REQUEST_URI'];
?>
<!-- partial:partials/_footer.html -->
            <footer class="footer">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2023 <a href="https://www.bootstrapdash.com/" target="_blank">BootstrapDash</a>. All rights reserved.</span>
                    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i></span>
                </div>
            </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="<?php echo BASE_URL ?>/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="<?php echo BASE_URL ?>/assets/vendors/chart.js/chart.umd.js"></script>
    <script src="<?php echo BASE_URL ?>/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?php echo BASE_URL ?>/assets/js/off-canvas.js"></script>
    <script src="<?php echo BASE_URL ?>/assets/js/misc.js"></script>
    <script src="<?php echo BASE_URL ?>/assets/js/settings.js"></script>
    <script src="<?php echo BASE_URL ?>/assets/js/todolist.js"></script>
    <script src="<?php echo BASE_URL ?>/assets/js/jquery.cookie.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <?php if($uri == '/') { ?>
        <script src="<?php echo BASE_URL ?>/assets/js/dashboard.js"></script>
    <?php } ?>
    <!-- End custom js for this page -->
    
    <script src="<?php echo BASE_URL ?>/assets/vendors/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo BASE_URL ?>/assets/vendors/datatables/dataTables.bootstrap4.min.js"></script>

    
    <script src="<?php echo BASE_URL ?>/assets/js/parsley.js"></script>