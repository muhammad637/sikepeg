 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion text-black" id="accordionSidebar" style="background: #2D7430">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center my-4" href="index.html">
                <div class="sidebar-brand-icon mr-1">
                    <img src="{{asset('./tampilan-sikepeg/img/putihLogo.png')}}" alt="" width="60">
                </div>
                <img src="{{asset('./tampilan-sikepeg/img/SiKep.png ')}}" alt="" width="75" class="sidebar-brand-text">
            </a>            

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{Request::is('dashboard*') ? 'active' : ''}}">
                <a class="nav-link " href="{{route('dashboard.index')}}">
                  <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            
            <li class="nav-item {{Request::is('pegawai*') ? 'active' : ''}}">
                <a class="nav-link" href="{{route('pegawai.index')}}">
                    <i class="fas fa-address-card"></i>
                    <span>Personal File</span></a>
            </li>


            <li class="nav-item {{Request::is('mutasi*') ? 'active' : ''}}">
                <a class="nav-link " href="{{route('mutasi.index')}}">
                    <i class="fas fa-compress-alt"></i>
                    <span>Mutasi</span></a>
            </li>
            
            <li class="nav-item  {{Request::is('diklat*') ? 'active' : ''}}">
                <a class="nav-link" href="{{route('diklat.index')}}">
                   <i class="fas fa-chalkboard-teacher"></i>
                    <span>Diklat</span></a>
            </li> 
            <li class="nav-item {{Request::is('kenaikanPangkat*') ? 'active' : ''}}">
                <a class="nav-link " href="{{route('kenaikan_pangkat.index')}}">
                 <i class="fas fa-calendar-day"></i>
                    <span>Kenaikan Pangkat</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#CutiCollapse"
                    aria-expanded="true" aria-controls="CuetiCollapse">
                   <i class="fas fa-calendar-week"></i>
                    <span>Cuti</span>
                </a>
                <div id="CutiCollapse" class="collapse {{(Request::is('cuti*') || Request::is('histori-cuti*')) ? 'show' : ''}}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Menu Cuti</h6>
                        <a class="collapse-item {{Request::is('cuti/data-cuti-aktif*') ? 'active' : ''}}" href="{{route('data-cuti-aktif.index')}}">Data Cuti Akif</a>
                        <a class="collapse-item {{Request::is('cuti/histori-cuti*') ? 'active' : ''}}" href="{{route('histori-cuti.index')}}">Histori Cuti</a>
                    </div>
                </div>
            </li>
                        
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#STRdanSIP"
                    aria-expanded="true" aria-controls="STRdanSIP">
                    <i class="fas fa-folder-plus"></i>
                    <span>STR dan SIP</span>
                </a>
                <div id="STRdanSIP" class="collapse {{(Request::is('str*') || Request::is('sip*')) ? 'show' : ''}}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Menu Cuti</h6>
                        <a class="collapse-item {{Request::is('str*') ? 'active' : ''}}" href="{{route('str.index')}}">STR</a>
                        <a class="collapse-item {{Request::is('sip*') ? 'active' : ''}}" href="{{route('sip.index')}}">SIP</a>
                    </div>
                </div>
            </li> 
             {{-- masterData --}}
             <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#masterData"
                    aria-expanded="true" aria-controls="STRdanSIP">
                    <i class="fas fa-database"></i>
                    <span>Master Data</span>
                </a>
                <div id="masterData" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="#">Pangkat</a>
                        <a class="collapse-item" href="#">Golongan</a>
                        <a class="collapse-item" href="#">Ruangan</a>
                        <a class="collapse-item" href="#">Hari Besar</a>
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