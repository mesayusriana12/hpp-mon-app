<button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar"
        data-class="c-sidebar-show">
    <i class="c-icon c-icon-lg cil-menu"></i>
</button>
<button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar"
        data-class="c-sidebar-lg-show" responsive="true">
    <i class="c-icon c-icon-lg cil-menu"></i>
</button>
<ul class="c-header-nav mfs-auto">
</ul>
<ul class="c-header-nav">
    <li class="c-header-nav-item mr-4">
        <span class="badge {{(Auth::user()->role_id == 1 ? 'badge-danger' : 'badge-primary')}}" style="cursor: default">{{(Auth::user()->role_id == 1 ? 'Admin' : 'Staff')}}</span>
    </li>
</ul>
<ul class="c-header-nav">
    <li class="c-header-nav-item dropdown mr-4">
        <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button"
            aria-haspopup="true" aria-expanded="false">
            <div class="c-avatar">
                <img class="c-avatar-img" src="{{asset('images/profile_picture/' . Auth::user()->profile_picture)}}" alt="pp">
            </div>
            <i class="cil-caret-bottom ml-2 "></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right pt-0">
            <div class="dropdown-header bg-light py-2"><strong>{{Auth::user()->fullname}}</strong></div>
            <a class="dropdown-item" href="{{route('viewProfile')}}">
                <i class="c-icon mfe-2 cil-user"></i>Profile
            </a>
            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="c-icon mfe-2 cil-account-logout"></i>Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </li>
</ul>
<div class="c-subheader justify-content-between px-3">
    @yield('breadcrumb')
</div>
