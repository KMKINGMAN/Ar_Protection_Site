<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container">
        <a class="navbar-brand" href="index.html">
            <img src="{{ asset('images/logo.png') }}" alt="logo" class="logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-bars" aria-hidden="true" style="color: #fff;"></i>
        </button>

        <div class="collapse navbar-collapse text-right" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('welcome') }}" target="_blank">الرئيسيه</a>
                </li>
                <li class="nav-item {{ str_contains(url()->current(), 'issues') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('issues.index') }}">السجلات</a>
                </li>
                <li class="nav-item {{ str_contains(url()->current(), 'home') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('home') }}">الأداره</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('check-players') }}">فحص الاعب</a>
                </li>

                <li class="nav-item">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();"
                       class="nav-link btn btn-danger btn-sm text-white" style="padding: 10px 5px 0;line-height: 10px;">
                        <p>
                            تسجيل الخروج
                        </p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
