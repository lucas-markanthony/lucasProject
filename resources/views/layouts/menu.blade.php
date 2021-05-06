<li class="c-sidebar-nav-item">
    <a class="c-sidebar-nav-link c-active" href="{{ route('home') }}">
        <i class="c-sidebar-nav-icon cil-home"></i>Dashboard
    </a>
</li>

@can('is-admin')
<li class="c-sidebar-nav-dropdown">
    <a class="c-sidebar-nav-dropdown-toggle" href="#">
        <i class="c-sidebar-nav-icon cil-people"></i>Admin
    </a>
    <ul class="c-sidebar-nav-dropdown-items">
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('admin.users.index') }}">
                <i class="c-sidebar-nav-icon cil-user"></i>  User Management
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('admin.paymentScheme.index') }}">
                <i class="c-sidebar-nav-icon cil-library-add"></i>  Payment Profile Management
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="icons/coreui-icons-free.html">
                <i class="c-sidebar-nav-icon cil-library-add"></i>  Menu Management
            </a>
        </li>
    </ul>
</li>
@endcan

<li class="c-sidebar-nav-dropdown">
    <a class="c-sidebar-nav-dropdown-toggle" href="#">
        <i class="c-sidebar-nav-icon cil-people"></i>Student
    </a>
    <ul class="c-sidebar-nav-dropdown-items">
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('registrar.student.index') }}">
                <i class="c-sidebar-nav-icon cil-library-add"></i>  Register New Student
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('registrar.student.create') }}">
                <i class="c-sidebar-nav-icon cil-magnifying-glass"></i>  Search
            </a>
        </li>
    </ul>
</li>

<li class="c-sidebar-nav-dropdown">
    <a class="c-sidebar-nav-dropdown-toggle" href="#">
        <i class="c-sidebar-nav-icon cil-people"></i>Cashier
    </a>
    <ul class="c-sidebar-nav-dropdown-items">
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('cashier.student.index') }}">
                <i class="c-sidebar-nav-icon cil-cash"></i>  Payment
            </a>
        </li>
    </ul>
</li>

<li class="c-sidebar-nav-item">
    <a class="c-sidebar-nav-link" href="{{ route('admin.users.index') }}">
        <i class="c-sidebar-nav-icon  cil-user"></i>Reports
    </a>
</li>