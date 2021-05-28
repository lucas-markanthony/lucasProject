<button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar"
        data-class="c-sidebar-show">
    <i class="c-icon c-icon-lg cil-menu"></i>
</button>
<a class="c-header-brand d-lg-none c-header-brand-sm-up-center" href="#">
    <img src="{{url('images/lbmhs_logo(250x750)-red.png')}}" width="125" alt="Brand Logo">
</a>
<button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar"
        data-class="c-sidebar-lg-show" responsive="true">
    <i class="c-icon c-icon-lg cil-menu"></i>
</button>

    <ul class="c-header-nav mfs-auto">
        
    </ul>

<ul class="c-header-nav">
    <li class="c-header-nav-item dropdown">
        <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button"
           aria-haspopup="true" aria-expanded="false">
            <div class="c-avatar">
                <i class="cil-user"></i> 
            </div>
        </a>
        <div class="dropdown-menu dropdown-menu-right pt-0 mx-2 w-auto">
            <div class="dropdown-header bg-light py-2"><strong>Account</strong></div>
            <div class="mx-2">
                <h3>Welcome, {{ Auth::user()->name }}</h3>
            </div>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('admin.users.show', Auth::id()) }}">
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
