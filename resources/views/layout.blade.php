<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="ROBOTS" content="INDEX, FOLLOW" />
    <meta name="Content-Language" content="{{ str_replace('_', '-', app()->getLocale()) }}"/>
    <meta name="Publisher" content="Sébastien L&#039;haire"/>
    <meta name="Reply-To" content="sebastien@lhaire.org"/>
    <meta name="description" content="@yield('description')"/>
    <script src="{{ mix('js/app.js')}}"></script>
    <!--[if IE]><link rel="shortcut icon" type="image/x-icon" href="favicon.ico" /><![endif]-->

    <title>Sébastien L'haire - Laravel packages demo site - @yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ mix('css/app.css')}}" rel="stylesheet"/>
  </head>
  <body>
    <!-- Fixed navbar -->
    <header id="header" class="navbar navbar-expand-md navbar-light fixed-top">
    <nav class="container flex-wrap flex-md-nowrap">
        <a class="navbar-brand" href="{{ \Config::get('app.url')}}">Sébastien L'haire</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          {!! $mainmenu !!}
          <hr class="d-md-none text-white-50">
          {!! $rightmenu !!} 
        </div>
    </nav>
    </header>
    <main role="main" class="container">
        @yield('content')
    </main> <!-- /container -->
    <footer>
        <div class="container">
          <br/><br/>
          <address>
                  Last modified: {!! config('versions.lastmodif') !!}.<br/>
                  Laravel v{{ Illuminate\Foundation\Application::VERSION }}
                  (PHP v{{ PHP_VERSION }}).
                  jQuery: v. {!! config('versions.jquery') !!}.
                  Bootstrap: v. {!! config('versions.bootstrap') !!}.
                  FontAwesome: v. {!! config('versions.fontawesome') !!}.
          </address>
          <br/><br/>
        </div>
        <a id="back-to-top" href="#" class="btn btn-danger btn-lg back-to-top" role="button" title="Retour en haut" data-toggle="tooltip" data-placement="left">
        <svg class="bi bi-chevron-up" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
        </svg>
      </a>
    </footer>
  </body>
</html>
