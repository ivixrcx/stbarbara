<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <base href="<?php echo base_url();?>"/>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="./node_modules/font-awesome/css/font-awesome.min.css">
    <!-- Sweet Alert 2 CSS-->
    <link rel="stylesheet" href="./node_modules/sweetalert2/dist/sweetalert2.min.css">
    <!-- Custom Font Icons CSS-->
    <link rel="stylesheet" href="./assets/css/font.css">
    <!-- Google fonts - Muli-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="./assets/css/style.default.css" id="theme-stylesheet">
    <link rel="stylesheet" href="./assets/css/style.sea.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="./assets/css/custom.css">
    <link rel="stylesheet" href="./assets/css/custom_media.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="./assets/img/favicon.ico">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body style="height: 100vh !important">
    <div class="login-page">
      <div class="container-fluid align-items-center">
        <div class="row">
        <div class="form-holder">
          <div class="row">
            <!-- Logo & Information Panel-->
            <div class="col-lg-6 dashboard-panel">
              <div class="info d-flex align-items-center">
                <div class="content">
                  <div class="logo">
                    <h1>Dashboard</h1>
                  </div>
                  <p>St. Barbara Builders Civil Engineering Construction</p>
                </div>
              </div>
            </div>
            <!-- Form Panel    -->
            <div class="col-lg-6 login-panel">
              <div class="form d-flex align-items-center">
                <div class="content">
                  <form method="post" class="form-validate mb-4">
                    <div class="form-group">
                      <input id="login-username" type="text" name="user_name" value="livil" required data-msg="Please enter your username" class="input-material">
                      <label for="login-username" class="label-material">User Name</label>
                    </div>
                    <div class="form-group">
                      <input id="login-password" type="password" name="password" value="password" required data-msg="Please enter your password" class="input-material">
                      <label for="login-password" class="label-material">Password</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                  </form>
                  <a href="#" class="forgot-pass">Forgot Password?</a><br>
                </div>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
    </div>
    <!-- JavaScript files-->

    <script src="./node_modules/jquery/dist/jquery.min.js"></script>
    <script src="./node_modules/popper.js/dist/umd/popper.min.js"> </script>
    <script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="./node_modules/chart.js/dist/Chart.min.js"></script>
    <script src="./node_modules/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="./node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="./assets/js/front.js"></script>
    <script src="./scripts/login.js"></script>
  </body>
</html>