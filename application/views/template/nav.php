<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar  sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="<?php echo base_url(); ?>public/admin/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Geo Dashboard</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo base_url(); ?>public/admin/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Admin</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?php site_url()?>/GPS/dashboard" class="nav-link" id='sidebar_header'>
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
           
          
          <li class="nav-item">
            <a href="<?php site_url()?>/GPS/dashboard/track" class="nav-link" id='sidebar_live'>
              <i class="nav-icon fas fa-motorcycle"></i>
              <p>
               Live Tracking
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php site_url()?>/GPS/dashboard/trips" class="nav-link" id='sidebar_history'>
              <i class="nav-icon fas  fa-motorcycle"></i>
              <p>
               Trip History
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php site_url()?>/GPS/dashboard/bikes" class="nav-link" id='sidebar_bikes'>
              <i class="nav-icon fas  fa-motorcycle"></i>
              <p>
                Bikes
                <i class="right fas fa-angle-right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php site_url()?>/GPS/dashboard/bikes" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bikes</p>
                </a>
              </li>
               
              <li class="nav-item">
                <a href="<?php site_url()?>/GPS/dashboard/new_bike" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>New Bike</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php site_url()?>/GPS/dashboard/new_trip" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>New Trip</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="<?php site_url()?>/GPS/dashboard/users" class="nav-link" id='sidebar_users'>
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
                <i class="right fas fa-angle-right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php site_url()?>/GPS/dashboard/users" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Users</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php site_url()?>/GPS/dashboard/new_user" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>New User</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="<?php site_url()?>/GPS/login/logout" class="nav-link" id='sidebar_users'>
              <i class="nav-icon fas fa-sign-out"></i>
              <p>
                Logout
              </p>
            </a>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
