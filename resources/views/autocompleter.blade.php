@extends('layout')
@section('title', 'Autocompleter')
@section('description', "Demo site of Laravel package Autocompleter, developped by Sébastien L'haire")
@section('content')
<h3>Autocompleter</h3>
<p class="lead">A Laravel library with Javascript JQuery script to add input
  with auto-completer. Current version: {{ config('versions.autocompleter')}}.
<a rel="noopener noreferrer" target="_blank" href="https://github.com/seblhaire/autocompleter">Project on GitHub</a>.
<a rel="noopener noreferrer" target="_blank" href="https://packagist.org/packages/seblhaire/autocompleter">Project on Packagist</a>.
This demosite sources available <a rel="noopener noreferrer" target="_blank" href="https://github.com/seblhaire/demoseb">here</a>.</p>
<pre>
<code>
$ac = AutocompleterHelper::init(
  'autocompleter1', //id
  'Countries', //label
  route('autocompletesearch'), // route called when typing in input
  [
    'callback' => 'output', // js callback called after selecting element
    'id_included' => false, // id column not added in item list
  ]
);
return view('template', ['ac' => $ac]);
</code>
</pre>
<p>Then print your autocompleter by inserting <code>@{!! $ac !!}</code> in your template. Javascript code to be inserted in blade template:</p>
<pre>
<code>
&lt;script type="text/javascript"&gt;
var output = function(data){ //function called after an element is selected in list
  jQuery('#result').val(
    (jQuery('#result').val().length > 0 ? jQuery('#result').val()   + "\n#"  : '#' )
    + data.id + ': ' + data.country
  );
}
&lt;/script&gt;
</code>
</pre>
<h2>Demo</h2>
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
