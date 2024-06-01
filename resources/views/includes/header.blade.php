<nav class="navbar navbar-expand-md navbar-light">
    <div class="container">
        <a href="{{ route('shop') }}" class="navbar-brand">
            {{ config('app.name') }}
        </a>

        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar-collapse" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
{{--                <li class="nav-item">--}}
{{--                    <a href="{{ route('home') }}" class="nav-link {{ active_link('home*') }}" aria-current="page">--}}
{{--                        {{ __('Главная') }}--}}
{{--                    </a>--}}
{{--                </li>--}}

                <li class="nav-item">
                    <a href="{{ route('shop') }}" class="nav-link {{ active_link('shop*') }}" aria-current="page">
                        {{ __('Товары') }}
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto mb-2 mb-md-0">

                <li class="nav-item">
                    <a class="btn btn-outline-dark" href="{{ route('shopping.cart') }}">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> Корзина <span class="badge text-bg-danger">{{ count((array) session('cart')) }}</span>
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user-circle" style="font-size: 1.5em;"></i> <!-- Это пример иконки из Font Awesome -->
                        @auth
                            {{ Auth::user()->email }}
                        @endauth
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @guest
                        <a class="dropdown-item {{ active_link('register*') }}" href="{{ route('register') }}">
                            {{ __('Регистрация') }}
                        </a>
                        <a class="dropdown-item {{ active_link('login*')}}" href="{{ route('login') }}">
                            {{ __('Вход') }}
                        </a>
                        @else
                        <a class="dropdown-item" href="#" onclick="document.getElementById('logout-form').submit();">
                            {{ __('Выйти') }}
                        </a>

                        <a class="dropdown-item" href="{{ route('password-reset') }}">
                            {{ __('Изменить пароль') }}
                         </a>
                        @endguest

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                    </div>
                </li>

            </ul>
        </div>
    </div>
</nav>
