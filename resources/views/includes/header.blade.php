<nav class="navbar navbar-expand-md navbar-light bg-light">
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

                <li class="nav-item">
                    <a href="{{ route('register') }}" class="nav-link {{ active_link('register*') }}" aria-current="page">
                        {{ __('Регистрация') }}
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('login') }}" class="nav-link {{ active_link('login*')}}" aria-current="page">
                        {{ __('Вход') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
