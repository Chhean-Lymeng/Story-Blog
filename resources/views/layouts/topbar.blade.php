<nav class="navbar">
    <a href="#" class="sidebar-toggler">
        <i data-feather="menu"></i>
    </a>
    <div class="navbar-content">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="ms-1 me-1 d-none d-md-inline-block">
                        @if (app()->getLocale() == 'kh')
                            <i class="flag-icon flag-icon-kh" title="kh" id="kh"></i>
                        @elseif(app()->getLocale() == 'en')
                            <i class="flag-icon flag-icon-gb" title="us" id="us"></i>
                        @endif
                        Language
                    </span>
                </a>
                <div class="dropdown-menu" aria-labelledby="languageDropdown">
                    <a href="{{ route('change.locale', ['lang' => 'en']) }}" onclick="toggleLang({{ auth()->user()->id }}, 0)" class="dropdown-item py-2">
                        <i class="flag-icon flag-icon-gb" title="us" id="us"></i>
                        <span class="ms-1"> EN </span>
                    </a>
                    <a href="{{ route('change.locale', ['lang' => 'kh']) }}" onclick="toggleLang({{ auth()->user()->id }}, 1)" class="dropdown-item py-2">
                        <i class="flag-icon flag-icon-kh" title="kh" id="kh"></i>
                        <span class="ms-1"> KH </span>
                    </a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle position-relative" href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i data-feather="bell"></i>
                    <div class="indicator">
                        <div class="badge bg-primary position-absolute top-0 start-100 translate-middle rounded-circle d-flex justify-content-center align-items-center" 
                        style="width: 14px; height: 14px;">3</div>
                    </div>
                </a>
                <div class="dropdown-menu p-0" aria-labelledby="notificationDropdown">
                    <div class="p-1" id="notificationItems">
                    </div>
                    <div class="px-3 py-2 d-flex align-items-center justify-content-center border-top">
                        <a style="font-size: 12px;" href="{{ url('feedbacks') }}">View All</a>
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="wd-30 ht-30 rounded-circle" src="{{ asset('assets/images/user.png')}}"
                        alt="profile">
                </a>
                <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
                    <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
                        <div class="mb-3">
                            <img class="wd-80 ht-80 rounded-circle" src="{{ asset('assets/images/user.png')}}" alt="">
                        </div>
                        <div class="text-center">
                            <p class="tx-16 fw-bolder">{{ auth()->user()->name }}</p>
                            <p class="tx-12 text-muted">{{ auth()->user()->email }}</p>
                        </div>
                    </div>
                    <ul class="list-unstyled p-1">
                        <li class="dropdown-item py-2">
                            <a href="{{ url('profile')}}" class="text-body disable">
                                <i class="me-2 icon-md" data-feather="edit"></i>
                                <span>Edit Profile</span>
                            </a>
                        </li>
                        <li class="dropdown-item py-2">
                            <a href="{{ route('logout') }}" class="text-body" onclick="event.preventDefault();  document.getElementById('logout-form').submit();">
                                <i class="me-2 icon-md" data-feather="log-out"></i>
                                <span>Logout</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</nav>
