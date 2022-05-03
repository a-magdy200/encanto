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
    <a href="{{ route('show.addCity') }}" class="nav-link">
        <i class="nav-icon fas fa-table"></i>
        <p>
        Add City
        </p>
    </a>
</li>
