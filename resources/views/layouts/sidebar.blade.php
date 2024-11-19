
<div class="sidebar" >
  <!-- Sidebar user (optional) -->
  <!-- SidebarSearch Form -->

  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <li class="nav-item ">
        <a href="{{url('/dashboard')}}" class="nav-link  {{request()->is('dashboard')?'active' : ''}}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
        </a>
      </li>

     <li class="nav-item ">
          <a href="#" class="nav-link">
          <i class="nav-icon fas fa-solid fa fa-bars"></i>
            <p >
              CRUD
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-solid fa fa-users"></i>
                  <p>User Management</p>
              </a>
            </li> 
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-solid fa fa-check"></i>
                  <p>Pemeriksaan</p>
              </a>
            </li> 
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-solid fa fa-pen"></i>
                  <p>Pemeliharaan</p>
              </a>
            </li> 
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-solid fa fa-toolbox"></i>
                  <p>Jenis Peralatan</p>
              </a>
            </li> 
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-solid fa fa-hammer"></i>
                  <p>Peralatan Telemetri</p>
              </a>
            </li> 
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-solid fa fa-puzzle-piece"></i>
                  <p>Komponen</p>
              </a>
            </li> 
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-solid fa fa-paperclip"></i>
                  <p>Settings</p>
              </a>
            </li> 
          </ul>
        </li>
    </ul>
  </nav>
  <!-- /.sidebar-menu -->
</div>
