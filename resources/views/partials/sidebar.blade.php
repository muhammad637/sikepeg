 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion text-black" id="accordionSidebar" style="background: #2D7430">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center my-4" href="index.html">
                <div class="sidebar-brand-icon mr-1">
                    <img src="{{asset('./tampilan-sikepeg/img/putihLogo.png')}}" alt="" width="60">
                </div>
                <img src="{{asset('./tampilan-sikepeg/img/SiKep.png ')}}" alt="" width="75" class="sidebar-brand-text">
            </a>            

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="#">
                   <i class="fas fa-hamburger"></i>
                    <span>Dashboard</span></a>
            </li>
            <li class="nav-item {{Request::is('pegawai*') ? 'active' : ''}}">
                <a class="nav-link" href="{{route('pegawai.index')}}">
                    <i class="fas fa-address-card"></i>
                    <span>Personal File</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Mutasi.html">
                    <i class="fas fa-compress-alt"></i>
                    <span>Mutasi</span></a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="diklat.html">
                   <i class="fas fa-chalkboard-teacher"></i>
                    <span>Diklat</span></a>
            </li> 
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#CutiCollapse"
                    aria-expanded="true" aria-controls="CutiCollapse">
                    <i class="fas fa-calendar-day"></i>
                    <span>Cuti</span>
                </a>
                <div id="CutiCollapse" class="collapse {{(Request::is('cuti*') || Request::is('histori-cuti*')) ? 'show' : ''}}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Menu Cuti</h6>
                        <a class="collapse-item {{Request::is('cuti*') ? 'active' : ''}}" href="buttons.html">Data Cuti Akif</a>
                        <a class="collapse-item {{Request::is('histori-cuti*') ? 'active' : ''}}" href="cards.html">Histori Cuti</a>
                    </div>
                </div>
            </li>
                        
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#STRdanSIP"
                    aria-expanded="true" aria-controls="STRdanSIP">
                    <i class="fas fa-calendar-day"></i>
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
            {{-- <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div> --}}


            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>            

        </ul>