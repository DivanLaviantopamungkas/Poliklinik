<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-seedling"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Poliklinik</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Dashboard -->
    <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Data Pasien Menu -->
    <div class="sidebar-heading">Data Pasien</div>

    <li class="nav-item {{ request()->routeIs('data.pasien') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('data.pasien') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Data Pasien</span>
        </a>
    </li>

    <!-- Data Dokter Menu -->
    <div class="sidebar-heading">Data Dokter</div>

    <li class="nav-item {{ request()->routeIs('data.dokter') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('data.dokter') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Data Dokter</span>
        </a>
    </li>

    <!-- Periksa Menu -->
    <div class="sidebar-heading">Periksa</div>

    <li class="nav-item {{ request()->routeIS('periksa') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('periksa') }}">
            <i class="fas fa-fw fa-stethoscope"></i>
            <span>Periksa</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

</ul>
