<!-- Fixed navbar -->
<header id="header">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
  <a class="navbar-brand" href="{{ \Config::get('app.url')}}">Sébastien L'haire</a> -
  <div class="collapse navbar-collapse" id="navbarCollapse">
    <ul class="navbar-nav mr-auto">
      @foreach (config('menu') as $idx => $item)
        <li id="{!! $idx !!}" class="nav-item{!! $idx == $menu ? ' active' : '' !!}"><a class="nav-link" href="{!! $item['target'] !!}" title="{{ isset($item['icon']) ? $item['title'] : '' }}">
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
