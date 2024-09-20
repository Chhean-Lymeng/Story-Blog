<nav class="sidebar">
    <div class="sidebar-header">
        <img src="{{asset('assets/images/logos.png')}}" style="width: 25%;" alt="">
        <a href="#" class="sidebar-brand">
            {{ env('APP_NAME') }} <span>CMS</span>
        </a>
        <div class="sidebar-toggler">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item">
                <a href="{{ url('home') }}" class="nav-link">
                    <i class="link-icon" data-feather="home"></i>
                    <span class="link-title">Home</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#setting" role="button" aria-expanded="false"
                    aria-controls="advancedUI">
                    <i class="link-icon" data-feather="settings"></i>
                    <span class="link-title">Settings</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="setting">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ url('categories') }}" class="nav-link">Categories</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('news') }}" class="nav-link">News</a>
                        </li>
                    </ul>
                </div>
            </li>   
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#user" role="button" aria-expanded="false"
                    aria-controls="advancedUI">
                    <i class="link-icon" data-feather="user-plus"></i>
                    <span class="link-title">Manage Account</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="user">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ url('permissions') }}" class="nav-link">Permissions</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('roles') }}" class="nav-link">Roles</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('users') }}" class="nav-link">Users</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>

<nav class="settings-sidebar">
    <div class="sidebar-body">
        <a href="#" class="settings-sidebar-toggler">
            <i data-feather="settings"></i>
        </a>
        <div class="theme-wrapper">
            <h6 class="text-muted mb-2">Light Theme</h6>
            <a class="theme-item active" href="#"
                @auth
                    onclick="toggleTheme({{ auth()->user()->id }}, {{ 0 }});"
                @else
                    onclick="alert('You need to log in to change the theme.');"
                @endauth>
                <img src="{{ asset('assets/images/theme/light.jpg') }}" alt="light theme">
            </a>
            <h6 class="text-muted mb-2">Dark Theme</h6>
            <a class="theme-item" href="#"
                @auth
                    onclick="toggleTheme({{ auth()->user()->id }}, {{ 1 }});"
                @else
                    onclick="alert('You need to log in to change the theme.');"
                @endauth>
                <img src="{{ asset('assets/images/theme/dark.jpg') }}" alt="dark theme">
            </a>
        </div>
    </div>
</nav>
