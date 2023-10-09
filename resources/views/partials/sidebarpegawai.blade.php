 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion text-black" id="accordionSidebar"
     style="background: #2D7430">

     <!-- Sidebar - Brand -->
     <a class="sidebar-brand d-flex align-items-center justify-content-center my-4" href="index.html">
         <div class="sidebar-brand-icon mr-1">
             <img src="{{ asset('./tampilan-sikepeg/img/putihLogo.png') }}" alt="" width="60">
         </div>
         <img src="{{ asset('./tampilan-sikepeg/img/SiKep.png ') }}" alt="" width="75"
             class="sidebar-brand-text">
     </a>
     <!-- Nav Item - Dashboard -->
     {{-- <li class="nav-item {{ Request::is('pegawai/home') ? 'active' : '' }}">
         <a class="nav-link " href="{{ route('pegawai.home',) }}">
             <i class="fas fa-tachometer-alt"></i>
             <span>Dashboard</span></a>
     </li> --}}
     <li class="nav-item">
     {{-- <li class="nav-item {{ Request::is('pegawai/personalfile') ? 'active' : '' }}"> --}}
            <a class="nav-link" href="#">
         {{-- <a class="nav-link" href="{{ route('pegawai.personal') }}"> --}}
             <i class="fas fa-address-card"></i>
             <span>Personal File</span></a>
     </li>
     <div class="text-center d-none d-md-inline">
         <button class="rounded-circle border-0" id="sidebarToggle"></button>
     </div>

 </ul>
