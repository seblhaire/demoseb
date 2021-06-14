@extends('layout')

@section('title', 'Autocompleter')
@section('content')
<h1>Autocompleter</h1>
{!! $ac !!}
<script type="text/javascript">
var output = function(data){
  jQuery('#result').val(
    (jQuery('#result').val().length > 0 ? jQuery('#result').val()   + "\n#"  : '#' )
    + data.id + ': ' + data.firstname + ' ' + data.lastname
  );
}
</script>
<form  action="return false;">
<div class="form-group">
  <label>Selected items</label>
  <textarea class="form-control" id="result" name="result" style="height:500px"></textarea>
</div>
</form
<br/><br/><br/>
@endsection
