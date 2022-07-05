@extends('layout')

@section('title', $title)
@section('content')
<div class="row">
    <div class="col-sm-4">
      {!! $sidemenu !!}
    </div>
    <div class="col-sm-8">
<h3>Uploader</h3>
<p class="lead">A Laravel library to provide file upload utilities. A Javascript library builds a
  complete file upload widget with upload button, drag-and-drop zone, progress bar
  and result builder. A controller is available to manage uploaded files.
  Current version: {{ config('versions.uploader')}}.
  <a rel="noopener noreferrer" target="_blank" href="https://github.com/seblhaire/uploader">Project on GitHub</a>.
  <a rel="noopener noreferrer" target="_blank" href="https://packagist.org/packages/seblhaire/uploader">Project on Packagist</a>.
  This demosite sources available <a rel="noopener noreferrer" target="_blank" href="https://github.com/seblhaire/demoseb">here</a>.
</p>
<p>On this site, you can only upload files up to {{ $maxsize }} and having extensions {{ $extensions }}.
  Files will be destroyed after {{ $filelife }} minutes.</p>
@switch($type)
  @case('basic')
    @include('uploader.basic')
    @break
  @case('complete')
    @include('uploader.complete')
    @break
  @case('hidden')
    @include('uploader.hidden')
    @break
  @case('functions')
      @include('uploader.functions')
      @break
  @default
    @include('uploader.simple')
@endswitch
  </div>
</div>
@endsection
