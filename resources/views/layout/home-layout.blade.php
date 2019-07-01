<!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <meta charset="utf-8">
     <meta name="csrf-token" content="{{ csrf_token() }}">
     <script src="https://cdn.jsdelivr.net/npm/places.js@1.16.4"></script>
     <link rel="stylesheet" href="{{ mix('css/app.css') }}">
     <link rel="shortcut icon" href="{{ asset('/img/red.ico')}}">
     <link rel='stylesheet' type='text/css' href='{{ asset('/sdk/map.css') }}'/>
     <script src="{{ mix('js/app.js') }}" charset="utf-8"></script>
     <script src='{{ asset('/sdk/tomtom.min.js')}}'></script>
     <script src="https://js.braintreegateway.com/web/dropin/1.8.1/js/dropin.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.1.0/handlebars.min.js" charset="utf-8"></script>
     <script id="template" type="text/x-handlebars-template">
       <div class="homeP">
         <div class="box-apartments">
           <div class="box-apartment rounded-bottom">
             <a class="dets" href="@{{showApart id }}">
               <div class="box-image">
                 @{{containsHttp img_path}}
               </div>
               <div class="box-data @{{isSponsored sponsored}}">
                 <h3>@{{ title }}</h3>
                 <p class="descr">@{{ description }}</p>
                 <p class="addr">@{{ address }}</p>
               </div>
             </a>
          </div>
         </div>
       </div>
     </script>
     <title>@yield('title', 'BoolBnB')</title>
   </head>
   <body>
     <div class="nav-bar">
         <i class="fas fa-bars fa-2x" style="color:#7d7d7d;"></i>
         <div class="hidden-nav-bar">
          <i class="fas fa-times fa-2x"></i>
          <div class="hidden-container">
            <span id="home" ><a href="{{route('home')}}">HOME</a></span>
            <span id="mare" >MARE</span>
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

                  <div id="dropdown" class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a id="dropdown-item1" class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                  </a>
                  <a id="dropdown-item2" class="dropdown-item" href="{{ route('dashboard') }}">
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

      <div class="container-fluid mx-auto  h-100 p-0">
        <div class="row  mx-auto h-100 w-100 flex-column align-items-center justify-content-center">
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
          @if (session('success'))
            <div class="alert alert-success">
              <div class="container">
                {{ session('success') }}
              </div>
            </div>
          @endif

          @yield('content')

        </div>
      </div>

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
   </body>
 </html>
