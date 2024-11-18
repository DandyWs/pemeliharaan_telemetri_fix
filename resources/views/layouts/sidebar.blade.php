
<div class="sidebar" >
  <!-- Sidebar user (optional) -->
  <!-- SidebarSearch Form -->
 
  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
      <li class="nav-item ">
        <a href="{{url('/dashboard')}}" class="nav-link  {{request()->is('dashboard')?'active' : ''}}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
       
     <li class="nav-item ">
          <a href="{{url('/nasabah')}}" class="nav-link  {{request()->is('nasabah')?'active' : ''}}">
            <i class="nav-icon fas fa-solid fa fa-users "></i>
            <p >
              Nasabah
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{url('/sopir')}}" class="nav-link {{request()->is('sopir')?'active' : ''}}">
            <i class="nav-icon fa fa-id-card"></i>
            <p>
              Sopir
            </p>
          </a>
        </li>
        <li class="nav-item">
          
          <a href="{{url('/sampah')}}" class="nav-link {{request()->is('sampah')?'active' : ''}}">
            <i class="nav-icon fa fa-trash"></i>
            <p>
              Jenis Sampah
            </p>
          </a>
          
        </li>
        <li class="nav-item">
          <a href="{{url('/jadwal')}}" class="nav-link {{request()->is('jadwal')?'active' : ''}}">
            <i class="nav-icon fa fa-calendar"></i>
            <p>
              Jadwal
            </p>
          </a>
        </li>
        
        <li class="nav-item">
          <a href="{{url('/laporan')}}" class="nav-link {{request()->is('laporan')?'active' : ''}}">
            <i class="nav-icon fa fa-sticky-note"></i>
            <p>
              Laporan
            </p>
          </a>
        </li> 
    </ul>
  </nav>
  <!-- /.sidebar-menu -->
</div>