 <!-- Sidebar Navigation--> 
<nav id="sidebar">
  <!-- Sidebar Header-->
  <div class="sidebar-header d-flex align-items-center">
    <div class="avatar"><img src="./assets/img/avatar-6.jpg" alt="..." class="img-fluid rounded-circle"></div>
    <div class="title">
      <h1 class="h5"><?php echo ucwords($full_name) ?></h1>
      <p><?php echo ucwords($user_type) ?></p>
    </div>
  </div>
  <!-- Sidebar Navidation Menus-->
  <ul class="list-unstyled">
    <li class="active"><a href="index.html"> <i class="icon-home"></i>Home </a></li>
    <li><a href="tables.html"> <i class="icon-grid"></i>Tables </a></li>
    <li><a href="charts.html"> <i class="fa fa-bar-chart"></i>Charts </a></li>
    <li><a href="forms.html"> <i class="icon-padnote"></i>Forms </a></li>
    <li><a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse"> <i class="icon-windows"></i>Example dropdown </a>
      <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
        <li><a href="#">Page</a></li>
        <li><a href="#">Page</a></li>
        <li><a href="#">Page</a></li>
      </ul>
    </li>
    <li><a href="login.html"> <i class="icon-logout"></i>Login page </a></li>
  </ul><span class="heading">Extras</span>
  <ul class="list-unstyled">
    <li> <a href="#"> <i class="icon-settings"></i>Demo </a></li>
    <li> <a href="#"> <i class="icon-writing-whiteboard"></i>Demo </a></li>
    <li> <a href="#"> <i class="icon-chart"></i>Demo </a></li>
  </ul>
</nav>
<!-- Sidebar Navigation end  -->