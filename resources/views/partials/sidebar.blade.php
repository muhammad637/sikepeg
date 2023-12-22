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
     <li class="nav-item {{ Request::routeIs('admin.dashboard.*') || Request::routeIs('admin.home.*') ? 'active' : '' }}">
         <a class="nav-link " href="{{ route('admin.dashboard.index') }}">
             <i class="fas fa-tachometer-alt"></i>
             <span>Dashboard</span></a>
     </li>

     <li class="nav-item {{ Request::routeIs('admin.pegawai.*') ? 'active' : '' }}">
         <a class="nav-link" href="{{ route('admin.pegawai.index') }}">
             <i class="fas fa-address-card"></i>
             <span>Personal File</span></a>
     </li>


     <li class="nav-item {{ Request::routeIs('admin.mutasi.*') ? 'active' : '' }}">
         <a class="nav-link " href="{{ route('admin.mutasi.index') }}">
             <i class="fas fa-compress-alt"></i>
             <span>Mutasi</span></a>
     </li>

     <li class="nav-item  {{ Request::routeIs('admin.diklat.*') ? 'active' : '' }}">
         <a class="nav-link" href="{{ route('admin.diklat.index') }}">
             <i class="fas fa-chalkboard-teacher"></i>
             <span>Diklat</span></a>
     </li>
     <li class="nav-item  {{ Request::routeIs('admin.kenaikan-pangkat.*') ? 'active' : '' }}">
         <a class="nav-link " href="{{ route('admin.kenaikan-pangkat.index') }}">
             <i class="fas fa-calendar-day"></i>
             <span>Kenaikan Pangkat</span></a>
     </li>
     {{-- <li class="nav-item">
        <a class="nav-link collapsed {{ Request::routeIs('admin.jabatan.*') ? 'font-weight-bold text-white' : '' }}" href="#" data-toggle="collapse" data-target="#jabatanCollapse"
            aria-expanded="true" aria-controls="CuetiCollapse">
            <i class="fas fa-regular fa-id-card"></i>
            <span>Jabatan</span>
        </a>
        <div id="jabatanCollapse"
            class="collapse "
            aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Menu Jabatan</h6>
                <a class="collapse-item {{ Request::routeIs('admin.jabatan.demosi.*') ? 'active' : '' }}"
                    href="{{ route('admin.jabatan.demosi.index') }}">Demosi</a>
                <a class="collapse-item {{ Request::routeIs('admin.jabatan.promosi.*') ? 'active' : '' }}"
                    href="{{route('admin.jabatan.promosi.index')}}">Promosi</a>
            </div>
        </div>
    </li> --}}
    <li class="nav-item  {{ Request::routeIs('admin.jabatan.*') ? 'active' : '' }}">
        <a class="nav-link " href="{{ route('admin.jabatan.index') }}">
            <i class="fas fa-regular fa-id-card"></i>
            <span>Jabatan</span></a>
    </li>
    {{-- <li class="nav-item  {{ Request::routeIs('admin.jabatan.*') ? 'active' : '' }}">
        <a class="nav-link " href="{{ route('admin.jabatan.demosi.index') }}">
            <i class="fas fa-regular fa-id-card"></i>
            <span>Jabatan</span></a>
    </li>
     <li class="nav-item">
         <a class="nav-link collapsed {{ Request::routeIs('admin.cuti.*') || Request::routeIs('admin.histori-cuti.*') ? 'font-weight-bold text-white' : '' }}" href="#" data-toggle="collapse" data-target="#CutiCollapse"
             aria-expanded="true" aria-controls="CuetiCollapse">
             <i class="fas fa-calendar-week {{ Request::routeIs('admin.cuti*') || Request::routeIs('admin.histori-cuti*') ? 'text-white' : '' }}"></i>
             <span>Cuti</span>
         </a>
         <div id="CutiCollapse"
             class="collapse "
             aria-labelledby="headingTwo" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <h6 class="collapse-header">Menu Cuti</h6>
                 <a class="collapse-item {{ Request::routeIs('admin.cuti.data-cuti-aktif.*') ? 'active' : '' }}"
                     href="{{ route('admin.cuti.data-cuti-aktif.index') }}">Data Cuti Akif</a>
                 <a class="collapse-item {{ Request::routeIs('admin.cuti.histori-cuti.*') ? 'active' : '' }}"
                     href="{{ route('admin.cuti.histori-cuti.index') }}">Histori Cuti</a>
             </div>
         </div>
     </li> --}}

     <li class="nav-item">
         <a class="nav-link collapsed {{ Request::routeIs('admin.str.*') || Request::routeIs('admin.sip.*') ? 'font-weight-bold text-white' : '' }}" href="#" data-toggle="collapse" data-target="#STRdanSIP"
             aria-expanded="true" aria-controls="STRdanSIP">
             <i class="fas fa-folder-plus  {{ Request::routeIs('admin.str.*') || Request::routeIs('admin.sip.*') ? 'text-white' : '' }}"></i>
             <span>STR dan SIP</span>
         </a>
         <div id="STRdanSIP" class="collapse"
             aria-labelledby="headingTwo" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <h6 class="collapse-header">Menu Cuti</h6>
                 <a class="collapse-item {{ Request::routeIs('admin.str.*') ? 'active' : '' }}"
                     href="{{ route('admin.str.index') }}">STR</a>
                 <a class="collapse-item {{ Request::routeIs('admin.sip.*') ? 'active' : '' }}"
                     href="{{ route('admin.sip.index') }}">SIP</a>
             </div>
         </div>
     </li>
     {{-- masterData --}}
     <li class="nav-item ">
         <a class="nav-link collapsed {{Request::routeIs('admin.master-data.*') ? 'font-weight-bold text-white' : ''}}" href="#" data-toggle="collapse" data-target="#masterData"
             aria-expanded="true" aria-controls="STRdanSIP">
             <i class="fas fa-database {{Request::routeIs('admin.master-data.*') ? 'font-weight-bold text-white' : ''}}"></i>
             <span class="">Master Data</span>
         </a>
         <div id="masterData" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <a class="collapse-item {{Request::routeIs('admin.master-data.pangkat.*') ? 'active' : ''}}" href="{{route('admin.master-data.pangkat.index')}}">Pangkat</a>
                 <a class="collapse-item {{Request::routeIs('admin.master-data.golongan.*') ? 'active' : ''}}" href="{{route('admin.master-data.golongan.index')}}">Golongan</a>
                 <a class="collapse-item {{Request::routeIs('admin.master-data.ruangan.*') ? 'active' : ''}}" href="{{route('admin.master-data.ruangan.index')}}">Ruangan</a>
                 <a class="collapse-item {{Request::routeIs('admin.master-data.hari-besar.*') ? 'active' : ''}}" href="{{ route('admin.master-data.hari-besar.index') }}">Hari Besar</a>
                 <a class="collapse-item {{Request::routeIs('admin.master-data.cuti-pegawai.*') ? 'active' : ''}}" href="{{ route('admin.master-data.cuti-pegawai.index') }}">Cuti Pegawai</a>
                 <a class="collapse-item {{Request::routeIs('admin.master-data.kenaikan-pangkat.*') ? 'active' : ''}}" href="{{ route('admin.master-data.kenaikan-pangkat.index') }}">Kenaikan Pangkat</a>
             </div>
         </div>
     </li>
     {{-- <hr class="sidebar-divider">
            <div class="sidebar-heading">Master Data</div> --}}

     {{-- <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div> --}}

     <!-- Sidebar Toggler (Sidebar) -->
     <div class="text-center d-none d-md-inline">
         <button class="rounded-circle border-0" id="sidebarToggle"></button>
     </div>

 </ul>
