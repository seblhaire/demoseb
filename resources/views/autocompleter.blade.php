@extends('layout')

@section('title', 'Autocompleter')
@section('content')
<h1>Autocompleter</h1>
<p class="lead">A Laravel library with Javascript JQuery script to add input with auto-completer.
<a rel="noopener noreferrer" target="_blank" href="https://github.com/seblhaire/autocompleter">Project on GitHub</a>.
<a rel="noopener noreferrer" target="_blank" href="https://packagist.org/packages/seblhaire/autocompleter">Project on Packagist</a>.
This demosite sources available <a rel="noopener noreferrer" target="_blank" href="https://github.com/seblhaire/demoseb">here</a>.</p>
<p>Type some characters to select a country. Results will be added to above list.</p>
{!! $ac !!}
<script type="text/javascript">
var output = function(data){ //function called after an element is selected in list
  jQuery('#result').val(
    (jQuery('#result').val().length > 0 ? jQuery('#result').val()   + "\n#"  : '#' )
    + data.{!! $options['id_field'] !!} + ': ' + data.country
  );
}
</script>
<form  action="return false;">
  <h3>Results</h3>
<div class="form-group">
  <label>Selected items</label>
  <textarea class="form-control" id="result" name="result" style="height:500px"></textarea>
</div>
</form>
<br/><br/><br/>
@endsection
