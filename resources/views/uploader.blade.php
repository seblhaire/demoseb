@extends('layout')

@section('title', $title)
@section('description', "Demo site of Laravel package Uploader, developped by Sébastien L'haire")
@section('content')
<div class="row">
    <div class="col-sm-3">
      {!! $sidemenu !!}
    </div>
    <div class="col-sm-9">
<h3>Uploader</h3>
<p class="lead">A Laravel library to provide file upload utilities. A Javascript library builds a
  complete file upload widget with upload button, drag-and-drop zone, progress bar
  and result builder. A controller is available to manage uploaded files.
  Current version: {{ config('versions.uploader')}}.
  <a rel="noopener noreferrer" target="_blank" href="https://github.com/seblhaire/uploader">Project on GitHub</a>.
  <a rel="noopener noreferrer" target="_blank" href="https://packagist.org/packages/seblhaire/uploader">Project on Packagist</a>.
  This demosite sources available <a rel="noopener noreferrer" target="_blank" href="https://github.com/seblhaire/demoseb">here</a>.
</p>
<p>On this site, you can only upload files up to {{ $maxsize }} and having extensions {{ str_replace(',', ', ', $extensions) }}.
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
  @case('displayinit')
      @include('uploader.displayinit')
      @break
  @case('functions')
      @include('uploader.functions')
      @break
  @case('resultprocessor')
      @include('uploader.resultprocessor')
      @break
  @default
    @include('uploader.simple')
@endswitch
@switch($type)
  @case('basic')
  @case('complete')
  @case('hidden')
  @case('displayinit')
  @case('simple')
  <h4>Uploader results</h4>
  <textarea class="form-control" id="upres" name="result" style="height:500px"></textarea>
  <script type="text/javascript">
      var writeinarea = function(str){
        jQuery('#upres').val(
          (jQuery('#upres').val().length > 0 ? jQuery('#upres').val()   + "\n"  : '' )
          + str
        );
      }
      var writeinupres = function(res){
        var proc = {!! $uploader->getresultprocessor() !!}
        text = (jQuery('#upres').val().length > 0 ? "\n\n"  : '') +
          'files uploaded: ' + proc.countFiles() + "\n";
        for (var i in proc.filelist){
          text += i + ": " + proc.filelist[i].filename + ' ' + proc.filelist[i].size + ' bytes. id: ' + proc.filelist[i].file_id + "\n";
        }
        writeinarea(text);
      }
  </script>
      @break
  @default
@endswitch
  </div>
</div>
@endsection
