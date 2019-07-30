<!DOCTYPE html>
<html>
  <head> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>St. Barbara</title>
    <base href="<?php echo base_url() ?>"/>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">
    <!-- DataTables Bootstrap 4 stylesheet-->
    <link rel="stylesheet" href="./node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <!-- DataTables Responsive stylesheet-->
    <link rel="stylesheet" href="./node_modules/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="./node_modules/font-awesome/css/font-awesome.min.css">
    <!-- sweetalert2 stylesheet-->
    <link rel="stylesheet" href="./node_modules/sweetalert2/dist/sweetalert2.min.css">
    <!-- autocomplete stylesheet-->
    <link rel="stylesheet" href="./vendor/iviarco/jquery-autocomplete/autocomplete.css">
    <!-- Google fonts - Muli-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
    <!-- Custom Font Icons CSS-->
    <link rel="stylesheet" href="./assets/css/font.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="./assets/css/style.default.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="./assets/css/style.green.css">
    <!-- Custom stylesheet -->
    <link rel="stylesheet" href="./assets/css/custom.css">
    <!-- Custom Media stylesheet -->
    <link rel="stylesheet" href="./assets/css/custom_media.css">
    <?php 
    if(isset($style)){
      if(is_array($style)){
        foreach ($style as $k => $path) {
          echo "<link rel='stylesheet' href='$path'/>";
        }
      }
      else{
          echo "<link rel='stylesheet' href='$style'/>";
      }
    }
    ?>
    </head>
    <!-- Favicon-->
    <!-- <link rel="shortcut icon" href="./assets/img/favicon.ico"> -->
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body style="height: 100vh !important">
    <header class="header">   
      <nav class="navbar navbar-expand-lg">
        <div class="search-panel">
          <div class="search-inner d-flex align-items-center justify-content-center">
            <div class="close-btn">Close <i class="fa fa-close"></i></div>
            <form id="searchForm" action="#">
              <div class="form-group">
                <input type="search" name="search" placeholder="What are you searching for...">
                <button type="submit" class="submit">Search</button>
              </div>
            </form>
          </div>
        </div>
        <div class="container-fluid d-flex align-items-center justify-content-between">
          <div class="navbar-header">
            <!-- Navbar Header--><a href="index.html" class="navbar-brand">
              <div class="brand-text brand-big visible text-uppercase"><strong class="text-primary">St.</strong><strong>Barbara</strong></div>
              <div class="brand-text brand-sm"><strong class="text-primary">S</strong><strong>B</strong></div></a>
            <!-- Sidebar Toggle Btn-->
            <button class="sidebar-toggle"><i class="fa fa-long-arrow-left"></i></button>
          </div>
          <div class="right-menu list-inline no-margin-bottom">    
            <div class="list-inline-item"><a href="#" class="search-open nav-link"><i class="icon-magnifying-glass-browser"></i></a></div>
            <!-- Log out               -->
            <div class="list-inline-item logout">
              <a id="logout" href="<?php echo base_url() . 'account/logout'?>" class="nav-link"> <span class="d-none d-sm-inline">Logout </span><i class="icon-logout"></i></a>
            </div>
          </div>
        </div>
      </nav>
    </header>
    <div class="d-flex align-items-stretch">
         <!-- Sidebar Navigation--> 
        <nav id="sidebar">
            <!-- Sidebar Header-->
            <div class="sidebar-header d-flex align-items-center">
                <div class="avatar"><img src="./assets/images/default-user.jpg" alt="..." class="img-fluid rounded-circle"></div>
                <div class="title">
                <h1 class="h5"><?php echo ucwords($login_data->full_name) ?></h1>
                <p><?php echo ucwords($login_data->user_type) ?></p>
                </div>
            </div>
            <!-- Sidebar Navidation Menus-->
            <ul class="list-unstyled">
                <li class="<?php if(isset($nav_home)) echo $nav_home; ?>"><a href="home"></i>Home </a></li>
                <li class="<?php if(isset($nav_po)) echo $nav_po; ?> system-module" style="display:none"><a href="purchase-orders" data-module="purchaseorder/purchase_order_view">Purchase Orders</a></li>
                <li class="<?php if(isset($nav_users)) echo $nav_users; ?> system-module" style="display:none"><a href="users" data-module="account/users">Users</a></li>
                <li class="<?php if(isset($nav_usermodule)) echo $nav_usermodule; ?> system-module" style="display:none"><a href="module-category" data-module="usermodulecategory/list_view">Modules</a></li>
                <li class="<?php if(isset($nav_projects)) echo $nav_projects; ?> system-module" style="display:none"><a href="projects" data-module="project/list_view">Project</a></li>
                <li class="<?php if(isset($nav_suppliers)) echo $nav_suppliers; ?> system-module" style="display:none"><a href="suppliers" data-module="supplier/list_view">Supplier</a></li>
                <li class="<?php if(isset($nav_houses)) echo $nav_houses; ?> system-module" style="display:none"><a href="houses" data-module="house/list_view">House</a></li>
                <li class="<?php if(isset($nav_warehouses)) echo $nav_warehouses; ?> system-module" style="display:none"><a href="warehouses" data-module="warehouse/list_view">Warehouses</a></li>
                <!-- <li><a href="charts.html"> <i class="fa fa-bar-chart"></i>Charts </a></li>
                <li><a href="forms.html"> <i class="icon-padnote"></i>Forms </a></li>
                <li><a href="#exampledropdownDropdown" aria-expanded="true" data-toggle="collapse"> <i class="icon-windows"></i>Example dropdown </a>
                <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
                    <li><a href="#">Page</a></li>
                    <li><a href="#">Page</a></li>
                    <li><a href="#">Page</a></li>
                </ul>
                </li> -->
            </ul>
            <!--  <span class="heading">Extras</span>
            <ul class="list-unstyled">
                <li> <a href="#"> <i class="icon-settings"></i>Demo </a></li>
                <li> <a href="#"> <i class="icon-writing-whiteboard"></i>Demo </a></li>
                <li> <a href="#"> <i class="icon-chart"></i>Demo </a></li>
            </ul> -->
        </nav>
        <!-- Sidebar Navigation end  -->

        <?php
        if(!isset($title)){
            $title = '';
        }
        ?>

        <div class="page-content">
            <div class="page-header">
            <div class="container-fluid">
                <h2 class="h5 no-margin-bottom"><?php echo $title ?></h2>
            </div>
            </div>

            