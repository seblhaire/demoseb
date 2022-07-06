@extends('layout')
@section('title', $title)
@section('content')
<div class="row">
  <div class="col-sm-3">
			{!! $sidemenu !!}
		</div>
		<div class="col-sm-9">
      <h3>{{ $title }}</h3>
<p class="lead">A Laravel library to to build menus and tabs navigation utilities,
  based on Boostrap 5 CSS Framework. Current version: {{ config('versions.menuandtabutils')}}.
  <a rel="noopener noreferrer" target="_blank" href="https://github.com/seblhaire/menuandtabutils">Project on GitHub</a>.
  <a rel="noopener noreferrer" target="_blank" href="https://packagist.org/packages/seblhaire/menuandtabutils">Project on Packagist</a>.
  This demosite sources available <a rel="noopener noreferrer" target="_blank" href="https://github.com/seblhaire/demoseb">here</a>.
</p>
@if ($type == 'simplenav')
  @include('menus.simple')
@elseif ($type == 'verticalnav')
  @include('menus.vertical')
@elseif ($type == 'htmltab')
  @include('tabs.htmltab')
@elseif ($type == 'viewtab')
  @include('tabs.viewtab')
@elseif ($type == 'editortab')
  @include('tabs.editortab')
@endif
<br/>
</div>
</div>
@endsection
