<ul class="nav nav-pills flex-column nav-fill">
    <li class="nav-item">
        <a class="nav-link {{request()->is('profile') ? 'active' : ''}}" href="{{ route('home') }}">Profile</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{request()->is('profile/password') ? 'active' : ''}}" href="{{ route('password.index') }}">Change password</a>
    </li> 
    @can('admin')
    <li class="nav-item">
        <a class="nav-link {{request()->is('admin/index') ? 'active' : ''}}" href="{{ route('admin.index') }}">Make user admin</a>
    </li>
    @endcan
</ul>

