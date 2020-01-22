<div class="navbar-dark text-white">
    <div class="container">
        <nav class="navbar px-0 navbar-expand-lg navbar-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup"
                            aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    @if(request()->is('admin*'))
                        <a href="{{ route('admin.dashboard') }}" class="pl-md-0 p-3 text-light">Dashboard</a>
                        @guest
                            <a href="{{ route('admin.login') }}" class="p-3 text-decoration-none text-light">{{ __('Login') }}</a>
                        @else
                            <a class="p-3 text-decoration-none text-light"
                                    href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endguest
                    @else
                        <a href="{{ route('home') }}" class="pl-md-0 p-3 text-decoration-none text-light">Home</a>
                        <a href="{{ route('user.challenges') }}" class="p-3 text-decoration-none text-light">{{ __('Challenges') }}</a>
                        @guest
                            <a href="{{ route('login') }}" class="p-3 text-decoration-none text-light">{{ __('Login') }}</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="p-3 text-decoration-none text-light">{{ __('Register') }}</a>
                            @endif
                        @else
                            <a class="p-3 text-decoration-none text-light"
                                    href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endguest
                    @endif
                </div>
            </div>
        </nav>
    </div>
</div>