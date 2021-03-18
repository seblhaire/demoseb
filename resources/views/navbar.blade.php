<!-- Fixed navbar -->
<header id="header">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
  <a class="navbar-brand" href="{{ \Config::get('app.url')}}">Sébastien L'haire</a> -
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarSupportedContent"
  aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarCollapse">
    <ul class="navbar-nav mr-auto">
      @foreach (config('menu') as $idx => $item)
        <li id="{!! $idx !!}" class="nav-item{!! $idx == $menu ? ' active' : '' !!}"><a class="nav-link"
          {!! (strpos($item['target'], 'https') !== false) ? 'target="_blank"' : '' !!}
          href="{!! $item['target'] !!}" title="{{ isset($item['icon']) ? $item['title'] : '' }}">
        @if (isset($item['icon']))
          {!! $item['icon'] !!}
        @else
          {{ $item['title'] }}
        @endif
        </a></li>
      @endforeach
    </ul>
  </div>
</nav>
</header>
