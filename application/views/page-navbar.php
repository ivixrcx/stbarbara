 <!-- Sidebar Navigation--> 
<nav id="sidebar">
  <!-- Sidebar Header-->
  <div class="sidebar-header d-flex align-items-center">
    <div class="avatar"><img src="./assets/img/default-user.jpg" alt="..." class="img-fluid rounded-circle"></div>
    <div class="title">
      <h1 class="h5"><?php echo ucwords($login_data->full_name) ?></h1>
      <p><?php echo ucwords($login_data->user_type) ?></p>
    </div>
  </div>
  <!-- Sidebar Navidation Menus-->
  <ul class="list-unstyled">
    <li class="<?php if(isset($nav_home)) echo $nav_home; ?>"><a href="home"></i>Home </a></li>
    <li class="<?php if(isset($nav_po)) echo $nav_po; ?>"><a href="purchaseorder/purchase_order_view">Purchase Orders</a></li>
    <li class="<?php if(isset($nav_users)) echo $nav_users; ?>"><a href="account/users">Users</a></li>
    <li class="<?php if(isset($nav_projects)) echo $nav_projects; ?>"><a href="project/list_view">Project</a></li>
    <li class="<?php if(isset($nav_suppliers)) echo $nav_suppliers; ?>"><a href="supplier/list_view">Supplier</a></li>
    <li class="<?php if(isset($nav_houses)) echo $nav_houses; ?>"><a href="house/list_view">House</a></li>
    <li class="<?php if(isset($nav_warehouses)) echo $nav_warehouses; ?>"><a href="warehouse/list_view">Warehouses</a></li>
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