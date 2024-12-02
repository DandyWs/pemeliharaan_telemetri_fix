<div class="sidebar">
    <!-- Sidebar user (optional) -->
    <!-- SidebarSearch Form -->

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <li class="nav-item">
                <a href="{{ url('/dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>

            @if (Auth::user()->role == 'admin')
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-solid fa-bars"></i>
                        <p>CRUD</p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('/user') }}" class="nav-link">
                                <i class="nav-icon fas fa-solid fa-users"></i>
                                <p>User Management</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/pemeriksaan') }}" class="nav-link">
                                <i class="nav-icon fas fa-solid fa-check"></i>
                                <p>Pemeriksaan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/pemeliharaans') }}" class="nav-link">
                                <i class="nav-icon fas fa-solid fa-pen"></i>
                                <p>Pemeliharaan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/jenisalat') }}" class="nav-link">
                                <i class="nav-icon fas fa-solid fa-toolbox"></i>
                                <p>Jenis Peralatan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/alat') }}" class="nav-link">
                                <i class="nav-icon fas fa-solid fa-hammer"></i>
                                <p>Peralatan Telemetri</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/komponen') }}" class="nav-link">
                                <i class="nav-icon fas fa-solid fa-puzzle-piece"></i>
                                <p>Komponen</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/detail_componen') }}" class="nav-link">
                                <i class="nav-icon fas fa-solid fa-microchip"></i>
                                <p>Detail Komponen</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/setting') }}" class="nav-link">
                                <i class="nav-icon fas fa-solid fa-paperclip"></i>
                                <p>Settings</p>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            @if (Auth::user()->role == 'manager')
                <li class="nav-item">
                    <a href="{{ url('/pemeriksaan') }}" class="nav-link">
                        <i class="nav-icon fas fa-solid fa-pen"></i>
                          <p>Pemeriksaan</p>
                    </a>
                </li> 
            @endif

            @if (Auth::user()->role == 'mekanik')
                <li class="nav-item">
                    <a href="{{ url('/pemeliharaans') }}" class="nav-link">
                        <i class="nav-icon fas fa-solid fa-pen"></i>
                          <p>Pemeliharaan</p>
                    </a>
                </li>
            @endif

        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>