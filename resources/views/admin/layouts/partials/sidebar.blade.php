<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{url('/dashboard')}}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">Membership</span>
                <i class="menu-arrow"></i>
            </a>
            @can('isAdmin')
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('plans.index')}}">Plans</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('plans.create')}}">Add Plan</a></li>
                </ul>
            </div>
            @endcan
            @can('isUser')
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{url('/all-plans')}}">Available Plans</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{url('/myplans')}}/{{ Auth::user()->id }}">My Plans</a></li>
                    {{-- <li class="nav-item"> <a class="nav-link" href="{{url('/create-plan')}}">Register</a></li> --}}
                    {{-- <li class="nav-item"> <a class="nav-link" href="{{url('/create-plan')}}">My plans</a></li> --}}
                </ul>
            </div>
            @endcan
        </li>
        @can('isAdmin')
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <i class="icon-head menu-icon"></i>
                <span class="menu-title">User</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('users.index')}}">Registered Users</a></li>
                    {{-- <li class="nav-item"> <a class="nav-link" href="admin/pages/samples/register.html">Membership Users</a></li> --}}
                </ul>
            </div>
        </li>
        @endcan
    </ul>
</nav>
