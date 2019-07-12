
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
    <script src="./assets/vendor/jquery/jquery.min.js"></script>
    <script src="./assets/vendor/popper.js/umd/popper.min.js"> </script>
    <script src="./assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="./assets/vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="./assets/vendor/chart.js/Chart.min.js"></script>
    <script src="./assets/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="./assets/vendor/sweetalert2/sweetalert2.min.js"></script>
    <script src="./assets/vendor/jquery.touch/jquery.touch.min.js"></script>
    <script src="./assets/vendor/jquery.dataTables/jquery.dataTables.min.js"></script>
    <script src="./assets/vendor/jquery.dataTables/dataTables.bootstrap4.min.js"></script>
    <script src="./assets/vendor/jquery.dataTables/dataTables.responsive.min.js"></script>
    <script src="./assets/vendor/jquery.dataTables/responsive.bootstrap4.min.js"></script>
    <script src="./assets/js/charts-home.js"></script>
    <script src="./assets/js/front.js"></script>
    <?php 

    if(isset($script)){
      if(is_array($script)){
        foreach ($script as $file_path) {
          echo "<script src='$file_path'></script>";
        }
      }
      else{ 
        echo "<script src='$script'></script>";
      }
    }

    ?>
  </body>
</html>