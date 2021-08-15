<!-- Fixed navbar -->
<header id="header">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ \Config::get('app.url')}}">Sébastien L'haire</a> -
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        @foreach (config('menu') as $idx => $item)
          <li id="{!! $idx !!}" class="nav-item">
            @if ($idx == $menu)
              <a class="nav-link active" aria-current="page"
            @else
              <a class="nav-link"
            @endif
            {!! (strpos($item['target'], 'https') !== false) ? 'target="_blank" rel="noopener noreferrer"' : '' !!}
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
  </div>
</nav>
</header>
