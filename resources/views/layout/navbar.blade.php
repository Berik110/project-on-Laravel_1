<nav class="navbar navbar-expand-lg navbar-light" style="background-color: white; font-family: Arial;">
    <a href="{{'/'}}" class="navbar-brand">
                    <img src="{{asset('logo2.png')}}" width="100px">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto">
            <li class="nav-item mr-3">
                <a href="{{'/'}}" class="nav-link">Главная страница</a>
            </li>
            <li class="nav-item mr-3">
                <a href="{{url('/rental')}}" class="nav-link">Аренда</a>
            </li>
            <li class="nav-item mr-3">
                <a href="{{url('/sell')}}" class="nav-link">Продажа</a>
            </li>
            <li class="nav-item mr-3">
                <a href="{{url('/parts')}}" class="nav-link">Запасные части</a>
            </li>
            @auth
                <li class="nav-item">
                    <a href="{{route('adv')}}" class="nav-link">Разместить объявление</a>
                </li>
            @else
                <li class="nav-item">
                    <a href="#" class="nav-link" data-toggle="modal" data-target="#loginModal">Разместить объявление</a>
                </li>
            @endauth
        </ul>
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-toggle="modal" data-target="#loginModal">{{ __('Login') }}</a>
                    </li>
                @endif

                @if (Route::has('register'))
                    <li class="nav-item">
                        <a href="#" class="nav-link" data-toggle="modal" data-target="#registerModal">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        @if(\Illuminate\Support\Facades\Auth::user()->name=='admin')
                            <a class="dropdown-item" href="{{ route('admin.index') }}">Admin page</a>
                        @else
                            <a class="dropdown-item" href="{{ route('profile') }}">Profile</a>
                        @endif
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
    </div>
</nav>
