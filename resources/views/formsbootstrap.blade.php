@extends('layout')

@section('title', $title)
@section('content')
<div class="row">
  <div class="col-sm-3">
			{!! $sidemenu !!}
		</div>
		<div class="col-sm-9">
      <h3>{{ $title }}</h3>
  		<p class="lead">A Laravel library to generate forms based on
  			<a rel="noopener noreferrer" target="_blank" href="https://laravelcollective.com/">Laravel Collective</a> Forms
  			& HTML, Boostrap 5 CSS Framework, RichText editor, and Icons provided by FontAwesome.
        Current version: {{ config('versions.formsbootstrap')}}.
  			<a rel="noopener noreferrer" target="_blank" href="https://github.com/seblhaire/formsbootstrap">Project on GitHub</a>.
  			<a rel="noopener noreferrer" target="_blank" href="https://packagist.org/packages/seblhaire/formsbootstrap">Project on Packagist</a>.
        Manages also results inputs of packages <a href="{{ route('daterangepicker')}}">DateRangePickerHelper</a>,
        <a href="{{ route('uploader')}}">Uploader</a>, and <a href="{{ route('tagsinput')}}">Tags input</a>. Includes form management and validation.
  			This demosite sources available <a rel="noopener noreferrer" target="_blank" href="https://github.com/seblhaire/demoseb">here</a>.
  		</p>
@if ($type == 'form')
  @include('formsbootstrap.form')
@elseif ($type == 'hidden')
  @include('formsbootstrap.hidden')
@elseif ($type == 'text')
  @include('formsbootstrap.text')
@elseif ($type == 'email')
  @include('formsbootstrap.email')
@elseif ($type == 'password')
  @include('formsbootstrap.password')
@elseif ($type == 'textarea')
  @include('formsbootstrap.textarea')
@elseif ($type == 'select')
  @include('formsbootstrap.select')
@elseif ($type == 'checkbox')
  @include('formsbootstrap.checkbox')
@elseif ($type == 'colorpicker')
  @include('formsbootstrap.colorpicker')
@elseif ($type == 'range')
  @include('formsbootstrap.range')
@elseif ($type == 'editor')
  @include('formsbootstrap.editor')
@elseif ($type == 'complete')
  @include('formsbootstrap.complete')
@endif
@if ($type != 'hidden')
    <br/><br/>
    <div id="resdiv">
      <h3>Results</h3>
      <div class="form-group">
        <label>Data sent to script</label>
        <textarea class="form-control" id="result" name="result" style="height:500px"></textarea>
      </div>
      <br/>
      <input type="button" id="emptyResults" class="btn btn-danger" value="Empty results" />
    </div>
    <script>
      var processform = function(data){
        oldres = jQuery('#result').val() + (jQuery('#result').val() != '' ? "\n\n" : "");
        jQuery('#result').val(oldres + data.formcontent);
        return data.message;
      };
      jQuery('#emptyResults').on('click', function(){ jQuery('#result').val(''); });
    </script>
@endif
  </div>
</div>
@endsection
