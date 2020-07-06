
        <footer class="footer">
          <div class="footer__block block no-margin-bottom">
            <div class="container-fluid text-center">
              <p class="no-margin-bottom"><?php echo date('Y') ?> &copy; St. Barbara Management System. Design by <a href="https://www.arttechcebu.com/">Art Tech Media & I.T Solutions</a>.</p>
            </div>
          </div>
        </footer>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="./node_modules/jquery/dist/jquery.min.js"></script>
    <script src="./node_modules/popper.js/dist/umd/popper.min.js"> </script>
    <script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="./node_modules/chart.js/dist/Chart.min.js"></script>
    <script src="./node_modules/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="./node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="./node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="./node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="./node_modules/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="./node_modules/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <script src="./vendor/iviarco/jquery-touch/jquery-touch.js"></script>
    <!-- <script src="./vendor/iviarco/jquery-autocomplete/autocomplete.js?v=<?php echo time()?>"></script> -->
    <script src="./assets/js/jquery-autocomplete/autocomplete.js"></script>
    <!-- <script src="./assets/js/charts-home.js"></script> -->
    <script src="./assets/js/front.js"></script>
    <script src="./scripts/useraccess.js?v=<?php echo time()?>"></script>

    <?php 
    
    if(isset($script)){
      if(is_array($script)){
        foreach ($script as $file_path) {
          echo '<script src="' . $file_path . '?v=' . time() . '"></script>';
        }
      }
      else{ 
        echo '<script src="' . $script . '?v=' . time() . '"></script>';
      }
    }

    ?>
  </body>
</html>