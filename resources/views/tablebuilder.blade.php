@extends('layout')

@section('title', $title)
@section('content')
<div class="row">
    <div class="col-sm-4">
      {!! $sidemenu !!}
    </div>
    <div class="col-sm-8">
<h3>{{ $title }}</h3>
<p class="lead">A Laravel library to build tables easily, which interacts with a lightweight js builder and builds data from Eloquent Object-Relational Mapping
  with database tables. Table can also load static data. Current version: {{ config('versions.tablebuilder')}}.
  <a rel="noopener noreferrer" target="_blank" href="https://github.com/seblhaire/tablebuilder">Project on GitHub</a>.
  <a rel="noopener noreferrer" target="_blank" href="https://packagist.org/packages/seblhaire/tablebuilder">Project on Packagist</a>.
  This demosite sources available <a rel="noopener noreferrer" target="_blank" href="https://github.com/seblhaire/demoseb">here</a>.
</p>
@if ($type == 'dynamic')
  @include('tables.dynamic')
@elseif ($type == 'static')
  @include('tables.static')
@elseif ($type == 'staticsimple')
  @include('tables.staticsimple')
@endif
  </div>
</div>
@endsection
