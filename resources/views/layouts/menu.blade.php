<li class="c-sidebar-nav-item">
    <a class="c-sidebar-nav-link c-active" href="{{ route('home') }}">
        <i class="c-sidebar-nav-icon cil-home"></i>Dashboard
    </a>
</li>


<li class="c-sidebar-nav-dropdown">
    <a class="c-sidebar-nav-dropdown-toggle" href="#">
        <i class="c-sidebar-nav-icon cil-people loadMe"></i>Admin
    </a>
    <ul class="c-sidebar-nav-dropdown-items">
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('admin.users.index') }}">
                <i class="c-sidebar-nav-icon cil-user loadMe"></i>  User Management
            </a>
        </li>
        @can('is-admin')
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('admin.schoolYear.index') }}">
                <i class="c-sidebar-nav-icon cil-cog loadMe"></i>  New School Year Setup
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('admin.subjectGroup.index') }}">
                <i class="c-sidebar-nav-icon cil-cog loadMe"></i>  New Subject Group Setup
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('admin.paymentScheme.index') }}">
                <i class="c-sidebar-nav-icon cil-cash loadMe"></i>  Payment Profile Management
            </a>
        </li>
        @endcan
    </ul>
</li>


@can('tab-registrar')
<li class="c-sidebar-nav-dropdown">
    <a class="c-sidebar-nav-dropdown-toggle" href="#">
        <i class="c-sidebar-nav-icon cil-contact"></i>Student
    </a>
    <ul class="c-sidebar-nav-dropdown-items">
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('registrar.student.index') }}">
                <i class="c-sidebar-nav-icon cil-color-border loadMe"></i>  Register New Student
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('registrar.student.create') }}">
                <i class="c-sidebar-nav-icon cil-magnifying-glass loadMe"></i>  Search
            </a>
        </li>
    </ul>
</li>
@endcan

@can('tab-records')
<li class="c-sidebar-nav-dropdown">
    <a class="c-sidebar-nav-dropdown-toggle" href="#">
        <i class="c-sidebar-nav-icon cil-education"></i>Student Records
    </a>
    <ul class="c-sidebar-nav-dropdown-items">
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('registrar.student.studentClassRecordIndex') }}">
                <i class="c-sidebar-nav-icon cil-magnifying-glass loadMe"></i> Records By Class
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('registrar.student.studentRecordIndex') }}">
                <i class="c-sidebar-nav-icon cil-magnifying-glass loadMe"></i> Records By Student
            </a>
        </li>
    </ul>
</li>
@endcan

@can('tab-cashier')
<li class="c-sidebar-nav-dropdown">
    <a class="c-sidebar-nav-dropdown-toggle" href="#">
        <i class="c-sidebar-nav-icon cil-cart"></i>Cashier
    </a>
    <ul class="c-sidebar-nav-dropdown-items">
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('cashier.student.index') }}">
                <i class="c-sidebar-nav-icon cil-credit-card loadMe"></i>  Payment
            </a>
        </li>
    </ul>
</li>
@endcan

@can('tab-reports')
<li class="c-sidebar-nav-dropdown">
    <a class="c-sidebar-nav-dropdown-toggle" href="#">
        <i class="c-sidebar-nav-icon cil-bar-chart"></i>Reports
    </a>
    <ul class="c-sidebar-nav-dropdown-items">
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('report.enrollment.index') }}">
                <i class="c-sidebar-nav-icon cil-clipboard loadMe"></i>  Enrollment Records
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('report.transaction.index') }}">
                <i class="c-sidebar-nav-icon cil-magnifying-glass loadMe"></i>  Transaction Records
            </a>
        </li>
    </ul>
</li>
@endcan