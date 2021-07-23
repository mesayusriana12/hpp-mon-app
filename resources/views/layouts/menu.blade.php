<li class="c-sidebar-nav-title">Dashboard</li>
<li class="c-sidebar-nav-item">
    <a class="c-sidebar-nav-link" href="{{ route('dashboard') }}">
        <i class="c-sidebar-nav-icon cil-home"></i> <strong>Dashboard</strong> 
    </a>
</li>

<li class="c-sidebar-nav-title">Menu</li>

<li class="c-sidebar-nav-dropdown">
    <a class="c-sidebar-nav-dropdown-toggle" href="#">
        <i class="c-sidebar-nav-icon cil-spreadsheet"></i>Data Monitoring
    </a>
    <ul class="c-sidebar-nav-dropdown-items">
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{route('viewSunData')}}">
                <i class="c-sidebar-nav-icon cil-sun"></i>Matahari
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{route('viewWindData')}}">
                <i class="c-sidebar-nav-icon fa fa-wind"></i>Angin
            </a>
        </li>
    </ul>
</li>

<li class="c-sidebar-nav-dropdown">
    <a class="c-sidebar-nav-dropdown-toggle" href="#">
        <i class="c-sidebar-nav-icon cil-graph"></i>Grafik Monitoring
    </a>
    <ul class="c-sidebar-nav-dropdown-items">
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{route('viewGraphSun')}}">
                <i class="c-sidebar-nav-icon cil-sun"></i>Matahari
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{route('viewGraphWind')}}">
                <i class="c-sidebar-nav-icon fa fa-wind"></i>Angin
            </a>
        </li>
    </ul>
</li>

<li class="c-sidebar-nav-item">
    <a class="c-sidebar-nav-link" href="{{ route('report') }}">
        <i class="c-sidebar-nav-icon fa fa-download"></i>Pelaporan
    </a>
</li>

{{-- admin area --}}
@if (Auth::user()->role_id == 1)
    <li class="c-sidebar-nav-title">Admin Area</li>
    <li class="c-sidebar-nav-dropdown">
        <a class="c-sidebar-nav-dropdown-toggle" href="#">
            <i class="c-sidebar-nav-icon fa fa-users"></i>Data Staff
        </a>
        <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{route('datastaff.list')}}">
                    <i class="c-sidebar-nav-icon cil-people"></i>Lihat Staff
                </a>
            </li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{route('datastaff.create')}}">
                    <i class="c-sidebar-nav-icon fa fa-user-plus"></i>Tambah Staff
                </a>
            </li>
        </ul>
    </li>

    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="#">
            <i class="c-sidebar-nav-icon fa fa-paperclip"></i>Log
        </a>
    </li>
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="{{route('setting')}}">
            <i class="c-sidebar-nav-icon cil-settings"></i>Pengaturan
        </a>
    </li>
@endif