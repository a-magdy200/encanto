<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('revenues.admin') }}" class="nav-link">
        <i class="nav-icon fas fa-money-bill"></i>
        <p>Revenues</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('profile.info') }}" class="nav-link {{ Request::is('profile') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user"></i>
        <p>Profile</p>
    </a>
</li>
@if(auth()->user()->hasRole('Super Admin'))
<li class="nav-item">
    <a href="{{ route('cities.index') }}" class="nav-link">
        <i class="nav-icon fas fa-city"></i>
        <p>Cities</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('city-managers.index') }}" class="nav-link {{ Request::is('city-managers') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user-alt"></i>
        <p>City Managers</p>
    </a>
</li>
@endif

@if(auth()->user()->hasAnyRole(['Super Admin', 'City Manager']))
<li class="nav-item">
    <a href="{{ route('gyms.index') }}" class="nav-link">
        <i class="nav-icon fas fa-building"></i>
        <p>Gyms</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('gym-managers.index') }}" class="nav-link {{ Request::is('gym-managers') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user-alt"></i>
        <p>Gym Managers</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('packages.index') }}" class="nav-link {{ Request::is('packages') ? 'active' : '' }}">
        <i class="nav-icon fas fa-list"></i>
        <p>Training Packages</p>
    </a>
</li>
@endif
<li class="nav-item">
    <a href="{{ route('attendance.index') }}" class="nav-link {{ Request::is('attendance') ? 'active' : '' }}">
        <i class="nav-icon fas fa-table"></i>
        <p>Attendance</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('coaches.index') }}" class="nav-link {{ Request::is('coaches') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user-alt"></i>
        <p>Coaches</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('clients.index') }}" class="nav-link {{ Request::is('clients') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user-alt"></i>
        <p>Clients</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('trainingSessions.index') }}" class="nav-link {{ Request::is('trainingSessions') ? 'active' : '' }}">
        <i class="nav-icon fas fa-list"></i>
        <p>Training Sessions</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('orders.index') }}" class="nav-link {{ Request::is('orders') ? 'active' : '' }}">
        <i class="nav-icon fas fa-table"></i>
        <p>Orders History</p>
    </a>
</li>


