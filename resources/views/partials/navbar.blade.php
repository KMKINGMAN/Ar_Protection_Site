<!-- ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    ---------------------------------------------Start navbar  ------------------------------------------
    ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->

<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('welcome') }}">
            <img src="{{ asset('images/logo.png') }}" alt="logo" class="logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-bars" aria-hidden="true" style="color: #fff;"></i>
        </button>

        <div class="collapse navbar-collapse text-right" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">لوحة التحكم</a>
                    </li>
                @endauth

                <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('welcome') }}">الرئيسيه</a>
                </li>
                <li class="nav-item {{ str_contains(url()->current(), 'check-players') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('check-players') }}">فحص الاعب</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://discord.gg/fuERe6VD" target="_blank">
                        الديسكورد
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- ||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
---------------------------------------------end navbar  ------------------------------------------
||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->
