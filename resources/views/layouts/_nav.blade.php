<nav class="navbar navbar-expand-lg navbar-light fixed-top bg-light">
    <div class="container">

        <a class="navbar-brand" href="{{ route('home') }}">
            <span class="text-primary">{{ config('app.name') }}</span>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-navbar-collapse" aria-controls="main-navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="main-navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{ active(['forum', 'threads*', 'thread']) }}"><a class="nav-link" href="{{ route('forum') }}">Forum</a></li>
                <li class="nav-item {{ active(['members']) }}"><a class="nav-link" href="{{ route('members') }}">Members</a></li>
                {{--<li><a href="https://paste.developers.mv">Pastebin</a></li>--}}
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Chat <span class="caret"></span></a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="https://t.me/mvdevelopers">Telegram</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Community <span class="caret"></span></a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="https://github.com/MaldivianDevelopers"><i class="fa fa-github"></i> Github</a>
                        <a class="dropdown-item" href="https://twitter.com/mvdevelopers"><i class="fa fa-twitter"></i> Twitter</a>
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav navbar-right">
                @if (Auth::guest())
                    <li class="nav-item {{ active('login') }}"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item {{ active('register') }}"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                @else
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle" src="{{ Auth::user()->gravatarUrl(60) }}" width="30"> <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu">
                            <div class="dropdown-item">
                                <span>
                                    <strong>{{ Auth::user()->name() }}</strong><br>
                                    {{ '@'.Auth::user()->username() }}
                                </span>
                            </div>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item {{ active('profile') }}" href="{{ route('profile', Auth::user()->username()) }}"><i class="fa fa-user-circle-o dropdown-icon" aria-hidden="true"></i>Profile</a>
                            <a class="dropdown-item {{ active('dashboard') }}" href="{{ route('dashboard') }}"><i class="fa fa-home dropdown-icon" aria-hidden="true"></i>Dashboard</a>
                            <a class="dropdown-item {{ active('settings.*') }}" href="{{ route('settings.profile') }}"> <i class="fa fa-cog dropdown-icon" aria-hidden="true"></i>Settings</a>

                            @can(App\Policies\UserPolicy::ADMIN, App\User::class)
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item {{ active('admin*') }}" href="{{ route('admin') }}"><i class="fa fa-shield dropdown-icon" aria-hidden="true"></i>Admin</a>
                            @endcan

                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"><i class="fa fa-sign-out dropdown-icon" aria-hidden="true"></i>Logout</a>
                        </div>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
