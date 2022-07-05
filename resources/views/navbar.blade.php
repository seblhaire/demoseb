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
