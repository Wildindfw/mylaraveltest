<a class="profile-button" href='/u/{{ request()->user()->profile->handle }}'>
    <img 
        src="{{
            request()->user()->profile->icon ? 
            request()->user()->profile->icon : 
            'https://i.redd.it/130am13nj6201.png'
            }}" 
        alt="User profile image"
    >
    <div class="profile-button-text">
        <span class="welcome-text">Welcome, {{ request()->user()->name }}</span> 
        <span class="handle-text">u/{{ request()->user()->profile->handle}}</span>
    </div>
</a>

<a class="edit-button" href="/edit_profile">Edit Profile</a>

{{-- Adapted from Laravel layouts.app.blade.php --}}
<div>
    <a class="logout-button" href="{{ route('logout') }}"
        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
        {{ __('Logout') }}
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>
