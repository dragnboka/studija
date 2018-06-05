<ul class="nav nav-pills flex-column nav-fill justify-content-center align-items-center">
    {{-- <li class="{{ return_if(on_page('account'), 'active') }}">
        <a href="{{ route('account.index') }}">Account overview</a>
    </li>
    <li class="{{ return_if(on_page('account/profile'), 'active') }}">
        <a href="{{ route('account.profile.index') }}">Profile</a>
    </li> --}}
    {{-- <li class="{{ return_if(on_page('account/password'), 'active') }}">
        <a href="{{ route('password.index') }}">Change password</a>
    </li> --}}
    <li class="nav-item">
        <a class="nav-link" href="{{ route('home') }}">Profile</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{request()->is('password')}} ? ' active' : ''" href="{{ route('password.index') }}">Change password</a>
    </li>
    {{-- <li class="{{ return_if(on_page('account/deactivate'), 'active') }}">
        <a href="{{ route('account.deactivate.index') }}">Deactivate account</a>
    </li> --}}
    
</ul>

