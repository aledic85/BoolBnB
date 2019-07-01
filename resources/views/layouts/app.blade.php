<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
      <div class="nav-bar">
          <i class="fas fa-bars fa-2x" style="color:#7d7d7d;"></i>
          <div class="appM" style="display: none;">
            <span><a href="{{route('home')}}">HOME</a></span>
            <span>MARE</span>
            <span>MONTAGNA</span>
            <span>ESPERIENZE</span>
          </div>
          <div class="nav-bar-left">
            <a href="{{route('home')}}"><h1>BoolBnB</h1></a>
          </div>
          <div class="nav-bar-right">
            <span><a href="{{route('home')}}">HOME</a></span>
            <span>MARE</span>
            <span>MONTAGNA</span>
            <span>ESPERIENZE</span>
            <div class="diventa_login">
              @guest
                <a id="login" href="{{ route('login') }}"><span>{{ __('Login') }}</span></a>
                @if (Route::has('register'))
                  <a id="newHost" href="{{ route('register') }}"><span>{{ __('Diventa un Host') }}</span></a>
                @endif
              @else
                <li class="nav-item dropdown">
                  <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                  </a>

                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                  </a>
                  <a class="dropdown-item" href="{{ route('dashboard') }}">
                    {{ __('Dashboard') }}
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                  </form>
                </div>
              </li>
             @endguest
            </div>
          </div>
      </div>

      <main class="py-4">
          @yield('content')
      </main>

      <div class="footer">
        <div class="footer-left">
            <p class ="footer">© 2019 BoolBnB.com, Inc.<a href="#">Terms and Conditions</a><a href="#">Privacy</a></p>
        </div>
        <div class="footer-rigth">
          <i class="fab fa-facebook"></i>
          <i class="fab fa-twitter"></i>
          <i class="fab fa-linkedin-in"></i>
          <i class="fab fa-youtube"></i>
          <i class="fab fa-instagram"></i>
        </div>
      </div>
    </div>
    <script>

      var hambIcon = $('.fas.fa-bars');
      hambIcon.click(function() {

        var menuMobile = $('.appM');
        menuMobile.slideToggle();
      });

    </script>
</body>
</html>
