<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('show.AllGyms') }}" class="nav-link">
        <i class="nav-icon fas fa-table"></i>
        <p>
        Gyms
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('show.cities') }}" class="nav-link">
        <i class="nav-icon fas fa-table"></i>
        <p>
        Cities
        </p>
    </a>
</li>

<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-table"></i>
        <p>
        Users
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('gymmanagers.index') }}" class="nav-link {{ Request::is('gymmanagers') ? 'active' : '' }}">
        <i class="nav-icon fas fa-table"></i>
        <p>Gym Managers</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('citymanagers.index') }}" class="nav-link {{ Request::is('citymanagers') ? 'active' : '' }}">
        <i class="nav-icon fas fa-table"></i>
        <p>City Managers</p>
    </a>
</li>
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-table"></i>
        <p>
        Coaches
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-table"></i>
        <p>
        Attendance
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-table"></i>
        <p>
        Revenue
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('attendance.index') }}" class="nav-link {{ Request::is('attendance') ? 'active' : '' }}">
        <i class="nav-icon fas fa-street"></i>
        <p>Attendance</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('coaches.index') }}" class="nav-link {{ Request::is('coaches') ? 'active' : '' }}">
        <i class="nav-icon fas fa-street"></i>
        <p>Coaches</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('clients.index') }}" class="nav-link {{ Request::is('clients') ? 'active' : '' }}">
        <i class="nav-icon fas fa-street"></i>
        <p>Clients</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('packages.index') }}" class="nav-link {{ Request::is('packages') ? 'active' : '' }}">
        <i class="nav-icon fas fa-table"></i>
        <p>Training Packages</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('trainingSessions.index') }}" class="nav-link {{ Request::is('trainingSessions') ? 'active' : '' }}">
        <i class="nav-icon fas fa-table"></i>
        <p>Training Sessions</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('orders.index') }}" class="nav-link {{ Request::is('orders') ? 'active' : '' }}">
        <i class="nav-icon fas fa-table"></i>
        <p>Orders History</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('profile.info') }}" class="nav-link {{ Request::is('profile') ? 'active' : '' }}">
        <i class="nav-icon fas fa-street"></i>
        <p>profile info</p>
    </a>
</li>

