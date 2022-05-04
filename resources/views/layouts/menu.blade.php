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
    <a href="{{ route('show.gymForm') }}" class="nav-link">
        <i class="nav-icon fas fa-table"></i>
        <p>
        Add Gym
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
    <a href="{{ route('show.addCity') }}" class="nav-link {{ Request::is('cities') ? 'active' : '' }}">
        <i class="nav-icon fas fa-table"></i>
        <p>
        Add City
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('citymanagers.index') }}" class="nav-link {{ Request::is('citymanagers') ? 'active' : '' }}">
        <i class="nav-icon fas fa-street"></i>
        <p>City Managers</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('packages.index') }}" class="nav-link {{ Request::is('packages') ? 'active' : '' }}">
        <i class="nav-icon fas fa-street"></i>
        <p>Training Packages</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('trainingSessions.index') }}" class="nav-link {{ Request::is('trainingSessions') ? 'active' : '' }}">
        <i class="nav-icon fas fa-street"></i>
        <p>Training Sessions</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('orders.index') }}" class="nav-link {{ Request::is('orders') ? 'active' : '' }}">
        <i class="nav-icon fas fa-street"></i>
        <p>Orders History</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('profiles.info') }}" class="nav-link {{ Request::is('profiles') ? 'active' : '' }}">
        <i class="nav-icon fas fa-street"></i>
        <p>profile info</p>
    </a>
</li>

