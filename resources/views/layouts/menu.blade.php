<li class="c-sidebar-nav-item">
    <a class="c-sidebar-nav-link c-active" href="{{ route('home') }}">
        <i class="c-sidebar-nav-icon cil-home"></i>Dashboard
    </a>
</li>

@can('is-admin')
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
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('admin.paymentScheme.index') }}">
                <i class="c-sidebar-nav-icon cil-library-add loadMe"></i>  Payment Profile Management
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('admin.schoolYear.index') }}">
                <i class="c-sidebar-nav-icon cil-library-add loadMe"></i>  New School year Setup
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('admin.subjectGroup.index') }}">
                <i class="c-sidebar-nav-icon cil-library-add loadMe"></i>  New Subject Group Setup
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
                <i class="c-sidebar-nav-icon cil-library-add loadMe"></i>  Register New Student
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('registrar.student.create') }}">
                <i class="c-sidebar-nav-icon cil-magnifying-glass loadMe"></i>  Search
            </a>
        </li>
    </ul>
</li>

<li class="c-sidebar-nav-dropdown">
    <a class="c-sidebar-nav-dropdown-toggle" href="#">
        <i class="c-sidebar-nav-icon cil-people"></i>Student Records
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

<li class="c-sidebar-nav-dropdown">
    <a class="c-sidebar-nav-dropdown-toggle" href="#">
        <i class="c-sidebar-nav-icon cil-people"></i>Cashier
    </a>
    <ul class="c-sidebar-nav-dropdown-items">
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('cashier.student.index') }}">
                <i class="c-sidebar-nav-icon cil-cash loadMe"></i>  Payment
            </a>
        </li>
    </ul>
</li>

<li class="c-sidebar-nav-dropdown">
    <a class="c-sidebar-nav-dropdown-toggle" href="#">
        <i class="c-sidebar-nav-icon cil-people"></i>Reports
    </a>
    <ul class="c-sidebar-nav-dropdown-items">
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('report.enrollment.index') }}">
                <i class="c-sidebar-nav-icon cil-library-add loadMe"></i>  Enrollment Records
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('report.transaction.index') }}">
                <i class="c-sidebar-nav-icon cil-magnifying-glass loadMe"></i>  Transaction Records
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="{{ route('report.transaction.index') }}">
                <i class="c-sidebar-nav-icon cil-magnifying-glass loadMe"></i> Grades
            </a>
        </li>
    </ul>
</li>