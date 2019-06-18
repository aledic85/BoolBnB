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
          <div class="nav-bar-left">
            <a href="{{route('home')}}"><h1>BoolBnB</h1></a>    
          </div>
          <div class="nav-bar-right">
              <a href=""></a>
              <span>Salvati</span>
              <span>Viaggi</span>
              <span>Messaggi</span>
              <span>Aiuto</span>
              @guest
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                @if (Route::has('register'))
                  <a id="long" class="nav-link" href="{{ route('register') }}">{{ __('Diventa un Host') }}</a>
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

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                  </form>
                </div>
              </li>
            @endguest
          </div>
      </div>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
